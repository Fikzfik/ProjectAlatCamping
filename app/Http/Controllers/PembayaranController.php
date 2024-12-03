<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        DB::beginTransaction(); // Mulai transaksi database

        try {
            $userId = Auth::user()->id_user;

            // Ambil data keranjang user yang sedang login
            $keranjang = DB::table('keranjangs')->join('barangs', 'keranjangs.id_barang', '=', 'barangs.id_barang')->where('keranjangs.id_user', $userId)->select('keranjangs.id_keranjang', 'barangs.nama_barang', 'keranjangs.jumlah_barang', 'barangs.harga_sewa', DB::raw('keranjangs.jumlah_barang * barangs.harga_sewa as subtotal'))->get();

            if ($keranjang->isEmpty()) {
                Log::info('Keranjang kosong untuk user dengan ID: ' . $userId);
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Keranjang kosong! Tidak ada barang untuk dibayar.',
                    ],
                    400,
                );
            }

            // Hitung total harga dari keranjang
            $totalHarga = $keranjang->sum('subtotal');

            // Ambil payment_type dari request
            $paymentType = $request->input('payment_method');

            // Buat penyewaan baru
            $idPenyewaan = DB::table('penyewaans')->insertGetId([
                'tanggal_sewa' => now(),
                'tanggal_kembali' => now()->addDays(7), // Contoh durasi sewa 7 hari
                'status_sewa' => 'dalam proses',
                'total_harga' => $totalHarga,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Buat detail penyewaan berdasarkan keranjang
            foreach ($keranjang as $item) {
                DB::table('detail_penyewaans')->insert([
                    'id_penyewaan' => $idPenyewaan,
                    'id_keranjang' => $item->id_keranjang,
                    'jumlah_barang' => $item->jumlah_barang,
                    'harga_sewa' => $item->harga_sewa,
                    'subtotal' => $item->subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Format item untuk Midtrans
            $items = [];
            foreach ($keranjang as $item) {
                $items[] = [
                    'id' => $item->id_keranjang,
                    'price' => $item->harga_sewa,
                    'quantity' => $item->jumlah_barang,
                    'name' => $item->nama_barang,
                ];
            }

            Log::info('Payment Method: ' . $paymentType);
            Log::info('Total Harga: ' . $totalHarga);
            $orderId = Str::uuid()->toString();
            // Payload untuk Midtrans
            $transactionData = [
                'payment_type' => $paymentType,
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $orderId,
                    'gross_amount' => $totalHarga,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name ?? 'Penyewa',
                    'email' => Auth::user()->email ?? 'penyewa@example.com',
                ],
                'item_details' => $items,
            ];

            // Kirim request ke Midtrans
            $client = new Client();
            $response = $client->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(env('MIDTRANS_SERVER_KEY') . ':'),
                    'Content-Type' => 'application/json',
                ],
                'json' => $transactionData,
            ]);

            // Parsing respons
            $responseBody = json_decode($response->getBody(), true);
            Log::info('Full Midtrans Response: ' . json_encode($responseBody));

            // Periksa apakah respons dari Midtrans mengandung token dan redirect_url
            if (!isset($responseBody['token']) || empty($responseBody['token'])) {
                Log::error('Midtrans Error: Token tidak ditemukan');
                DB::rollBack(); // Rollback transaksi jika tidak ada token
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Terjadi kesalahan saat memproses pembayaran.',
                        'error' => 'Token tidak ditemukan.',
                    ],
                    500,
                );
            }

            // Pastikan actions[1]['url'] ada dalam respons
            if (isset($responseBody['redirect_url'])) {
                $checkoutLink = $responseBody['redirect_url']; // Deeplink URL
            } else {
                Log::error('Midtrans Error: redirect_url tidak ditemukan');
                DB::rollBack(); // Rollback transaksi jika tidak ada redirect_url
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Terjadi kesalahan saat memproses pembayaran.',
                        'error' => 'Redirect URL tidak ditemukan.',
                    ],
                    500,
                );
            }

            // Simpan data pembayaran ke tabel pembayarans
            DB::table('pembayarans')->insert([
                'checkout_link' => $checkoutLink,
                'order_id' => 'ORDER-' . $orderId,
                'id_penyewaan' => $idPenyewaan,
                'tanggal_pembayaran' => now(),
                'jumlah_pembayaran' => $totalHarga,
                'metode_pembayaran' => $paymentType,
                'status_pembayaran' => 'belum lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Commit transaksi
            DB::commit();

            // Response berhasil
            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat!',
                'data' => [
                    'redirect_url' => $checkoutLink, // Pastikan field ini ada
                ],
            ]);
        } catch (\Exception $e) {
            // Jika terjadi error, rollback transaksi
            DB::rollBack();
            Log::error('Error: ' . $e->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
    public function webhook(Request $request)
    {
        try {
            // Ambil order_id dari request
            $orderId = $request->input('order_id');

            // Validasi jika order_id kosong
            if (empty($orderId)) {
                return response()->json(['success' => false, 'message' => 'Order ID tidak ditemukan'], 400);
            }

            // Ambil status transaksi dari Midtrans
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode(env('MIDTRANS_SERVER_KEY') . ':'),
                'Content-Type' => 'application/json',
            ])->get("https://api.sandbox.midtrans.com/v2/$orderId/status");

            // Parsing response dari Midtrans
            $responseBody = json_decode($response->body(), true);

            if (!$response->successful()) {
                Log::error('Error mendapatkan status dari Midtrans', $responseBody);
                return response()->json(['success' => false, 'message' => 'Gagal mengambil status dari Midtrans'], 500);
            }

            // Cari data pembayaran berdasarkan order_id di database
            $pembayaran = DB::table('pembayarans')->where('order_id', $orderId)->first();

            // Validasi jika pembayaran tidak ditemukan
            if (!$pembayaran) {
                Log::warning('Pembayaran dengan Order ID tidak ditemukan: ' . $orderId);
                return response()->json(['success' => false, 'message' => 'Pembayaran tidak ditemukan'], 404);
            }

            // Perbarui status pembayaran berdasarkan status transaksi dari Midtrans
            $transactionStatus = $responseBody['transaction_status'];
            $status = null;

            if ($transactionStatus === 'capture') {
                $status = 'capture';
            } elseif ($transactionStatus === 'settlement') {
                $status = 'settlement';
            } elseif ($transactionStatus === 'pending') {
                $status = 'pending';
            } elseif ($transactionStatus === 'deny') {
                $status = 'deny';
            } elseif ($transactionStatus === 'expire') {
                $status = 'expire';
            } elseif ($transactionStatus === 'cancel') {
                $status = 'cancel';
            }

            if (!$status) {
                Log::error('Status transaksi tidak valid: ' . $transactionStatus);
                return response()->json(['success' => false, 'message' => 'Status transaksi tidak valid'], 400);
            }

            // Update status pembayaran di database
            DB::table('pembayarans')
                ->where('order_id', $orderId)
                ->update(['status_pembayaran' => $status, 'updated_at' => now()]);

            // Jika status adalah settlement, ubah status penyewaan menjadi "aktif"
            if ($transactionStatus === 'settlement') {
                DB::table('penyewaans')
                    ->where('id_penyewaan', $pembayaran->id_penyewaan)
                    ->update(['status_sewa' => 'aktif', 'updated_at' => now()]);
            }

            Log::info('Status pembayaran berhasil diperbarui', [
                'order_id' => $orderId,
                'status' => $status,
            ]);

            return response()->json(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui']);
        } catch (\Exception $e) {
            Log::error('Error pada webhook: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }
}
