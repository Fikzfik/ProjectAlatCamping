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
        Log::info('Full Midtrans Response: Index ' . json_encode($request->all()));

        try {
            $userId = Auth::user()->id_user;

            // Ambil data barang yang dipilih dari request
            $selectedData = $request->input('items');
            $totalHarga = $request->input('total_pembayaran'); // Total pembayaran yang dikirim frontend

            if (empty($selectedData)) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Tidak ada barang yang dipilih.',
                    ],
                    400,
                );
            }

            // Ambil tanggal_sewa dan tanggal_kembali dari item pertama
            $firstItem = $selectedData[0]; // Ambil item pertama dari array selectedData
            $tanggalSewa = $firstItem['tanggal_sewa']; // Tanggal sewa dari item pertama
            $tanggalKembali = $firstItem['tanggal_kembali']; // Tanggal kembali dari item pertama

            // Buat penyewaan baru dengan tanggal_sewa dan tanggal_kembali dari request
            $idPenyewaan = DB::table('penyewaans')->insertGetId([
                'id_user' => Auth::user()->id_user,
                'tanggal_sewa' => $tanggalSewa, // Menggunakan tanggal_sewa dari item pertama
                'tanggal_kembali' => $tanggalKembali, // Menggunakan tanggal_kembali dari item pertama
                'status_sewa' => 'dalam proses',
                'total_harga' => $totalHarga,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $calculatedTotal = 0; // Hitung total yang sesuai

            // Buat detail penyewaan berdasarkan barang yang dipilih
            foreach ($selectedData as $item) {
                // Mengambil id_barang berdasarkan id_keranjang
                $keranjang = DB::table('keranjangs')
                    ->where('id_keranjang', $item['id_keranjang'])
                    ->first();
                $idBarang = $keranjang->id_barang ?? null; // Mengambil id_barang dari keranjang

                // Jika id_barang tidak ditemukan, lanjutkan ke item berikutnya
                if (!$idBarang) {
                    continue;
                }

                // Menghitung subtotal berdasarkan jumlah hari sewa
                $startDate = new \DateTime($item['tanggal_sewa']);
                $endDate = new \DateTime($item['tanggal_kembali']);
                $diffDays = $endDate->diff($startDate)->days;

                Log::info('Id keranjang : ' . $item['id_keranjang']);
                $subtotal = $item['harga_sewa'] * $item['jumlah'] * $diffDays;

                // Menambahkan subtotal ke total yang dihitung
                $calculatedTotal += $subtotal;

                // Masukkan detail penyewaan ke dalam tabel
                DB::table('detail_penyewaans')->insert([
                    'id_penyewaan' => $idPenyewaan,
                    'id_barang' => $idBarang, // Gunakan id_barang dari keranjang
                    'id_keranjang' => $item['id_keranjang'],
                    'jumlah_barang' => $item['jumlah'],
                    'harga_sewa' => $item['harga_sewa'],
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Update stok barang setelah penyewaan
                $stokBarang = DB::table('stok_barangs')->where('id_barang', $idBarang)->first();
                if ($stokBarang && $stokBarang->jumlah_stok >= $item['jumlah']) {
                    // Kurangi stok sesuai jumlah yang disewa
                    DB::table('stok_barangs')
                        ->where('id_barang', $idBarang)
                        ->decrement('jumlah_stok', $item['jumlah']);
                } else {
                    // Jika stok tidak mencukupi, rollback transaksi
                    DB::rollBack();
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Stok tidak cukup untuk barang dengan ID: ' . $idBarang,
                        ],
                        400,
                    );
                }
            }

            // Pastikan calculatedTotal sesuai dengan totalHarga
            if ($calculatedTotal != $totalHarga) {
                Log::error("Gross amount mismatch: calculated $calculatedTotal, received $totalHarga");
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Total harga tidak sesuai.',
                    ],
                    400,
                );
            }

            // Format item untuk Midtrans
            $items = [];
            foreach ($selectedData as $item) {
                $items[] = [
                    'id' => $item['id_keranjang'],
                    'price' => $item['harga_sewa'],
                    'quantity' => $item['jumlah'],
                    'name' => $item['nama_barang'],
                ];
            }

            // Pastikan `gross_amount` sesuai dengan totalHarga yang dihitung
            $grossAmount = $calculatedTotal;

            // Payload untuk Midtrans
            $orderId = Str::uuid()->toString();
            $transactionData = [
                'payment_type' => 'credit_card', // Sesuaikan dengan metode pembayaran yang ingin digunakan
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $orderId, // Unique order ID
                    'gross_amount' => $grossAmount, // Total price for the transaction
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name ?? 'Penyewa', // Customer's name, fallback to 'Penyewa'
                    'email' => Auth::user()->email ?? 'penyewa@example.com', // Customer's email, fallback to a default one
                ],
                'item_details' => $items, // Array of items, should contain 'id', 'price', 'quantity', 'name'
                'callbacks' => [
                    'finish' => 'https://abd9-103-47-133-70.ngrok-free.app/api/finish', // Custom callback URL after payment
                ],
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

            // Simpan data pembayaran ke tabel pembayarans
            DB::table('pembayarans')->insert([
                'order_id' => 'ORDER-' . $orderId,
                'id_penyewaan' => $idPenyewaan,
                'tanggal_pembayaran' => now(),
                'jumlah_pembayaran' => $grossAmount,
                'metode_pembayaran' => 'credit_card', // Sesuaikan dengan metode pembayaran yang dipilih
                'status_pembayaran' => 'pending',
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
                    'token' => $responseBody['token'], // Token yang diterima dari Midtrans
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
        Log::info('Webhook payload:', $request->all());

        try {
            // Ambil order_id dari request
            $orderId = $request->input('order_id');
            Log::info('Order ID : ' . $orderId);

            if (empty($orderId)) {
                return response()->json(['success' => false, 'message' => 'Order ID tidak ditemukan'], 400);
            }

            // Ambil status transaksi dari Midtrans
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode(env('MIDTRANS_SERVER_KEY') . ':'),
                'Content-Type' => 'application/json',
            ])->get("https://api.sandbox.midtrans.com/v2/$orderId/status");

            $responseBody = json_decode($response->body(), true);

            if (!$response->successful()) {
                Log::error('Error mendapatkan status dari Midtrans', $responseBody);
                return response()->json(['success' => false, 'message' => 'Gagal mengambil status dari Midtrans'], 500);
            }

            // Cari data pembayaran
            $pembayaran = DB::table('pembayarans')->where('order_id', $orderId)->first();

            if (!$pembayaran) {
                Log::warning('Pembayaran tidak ditemukan: ' . $orderId);
                return response()->json(['success' => false, 'message' => 'Pembayaran tidak ditemukan'], 404);
            }

            // Cari data penyewaan yang terkait dengan pembayaran
            $penyewaan = DB::table('penyewaans')
                ->join('detail_penyewaans', 'penyewaans.id_penyewaan', '=', 'detail_penyewaans.id_penyewaan')
                ->join('keranjangs', 'keranjangs.id_keranjang', '=', 'detail_penyewaans.id_keranjang')
                ->where('penyewaans.id_penyewaan', $pembayaran->id_penyewaan)
                ->first();

            if ($penyewaan) {
                $userId = $penyewaan->id_user;
                Log::info('User ID terkait dengan penyewaan: ' . $userId);
            } else {
                Log::warning('User terkait dengan pembayaran tidak ditemukan.');
                return response()->json(['success' => false, 'message' => 'User terkait dengan pembayaran tidak ditemukan'], 404);
            }

            // Update status pembayaran
            $transactionStatus = $responseBody['transaction_status'];
            $status = match ($transactionStatus) {
                'capture' => 'capture',
                'settlement' => 'settlement',
                'pending' => 'pending',
                'deny' => 'deny',
                'expire' => 'expire',
                'cancel' => 'cancel',
                default => null,
            };

            if (!$status) {
                return response()->json(['success' => false, 'message' => 'Status transaksi tidak valid'], 400);
            }

            DB::table('pembayarans')
                ->where('order_id', $orderId)
                ->update(['status_pembayaran' => $status, 'updated_at' => now()]);

            // Ubah status penyewaan jika "settlement"
            if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                DB::table('penyewaans')
                    ->where('id_penyewaan', $pembayaran->id_penyewaan)
                    ->update(['status_sewa' => 'tersewa', 'updated_at' => now()]);

                // Hapus keranjang yang tidak ada di detail_penyewaans
                DB::table('keranjangs')->join('detail_penyewaans', 'keranjangs.id_keranjang', '=', 'detail_penyewaans.id_keranjang')->where('keranjangs.id_user', $userId)->delete();

                Log::info('Keranjang yang tidak ada di detail_penyewaans berhasil dihapus untuk user: ' . $userId);
            } else {
                Log::info('Status transaksi tidak valid');
            }

            return response()->json(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui']);
        } catch (\Exception $e) {
            Log::error('Error pada webhook: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }

    public function finish(Request $request)
    {
        Log::info('Finish payload:', $request->all());
        $orderId = $request->input('order_id');
        Log::info('test');

        try {
            Log::info('test1');

            // Ambil status transaksi terbaru dari Midtrans
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode(env('MIDTRANS_SERVER_KEY') . ':'),
                'Content-Type' => 'application/json',
            ])->get("https://api.sandbox.midtrans.com/v2/$orderId/status");

            Log::info('test2');
            $responseBody = json_decode($response->body(), true);

            if (!$response->successful()) {
                Log::info('Response dari Midtrans: ' . $response->body());

                return redirect()->route('home')->with('error', 'Gagal mengambil status dari Midtrans');
            }

            Log::info('test4');

            $transactionStatus = $responseBody['transaction_status'];
            Log::info('Transaction Status: ' . $transactionStatus);

            // Lanjutkan logika berdasarkan status transaksi
            if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
                DB::table('keranjangs')
                    ->where('id_user', auth()->user()->id_user)
                    ->delete();

                return redirect()->route('home')->with('notif', 'Pembayaran berhasil, silahkan ambil barang');
            }
            Log::info('test4');

            return redirect()->route('home')->with('error', 'Pembayaran gagal atau status tidak valid');
        } catch (\Exception $e) {
            Log::error('Error pada finish: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Terjadi kesalahan, silahkan coba lagi');
        }
    }
    public function notfinish(Request $request)
    {
        Log::info('Full Midtrans Response: notfinish');
        try {
            // Ambil order_id dari query string
            $orderId = $request->input('order_id');

            // Validasi order_id
            if (empty($orderId)) {
                return redirect()->route('home')->with('error', 'Order ID tidak ditemukan');
            }

            // Cek apakah data pembayaran ada di database
            $pembayaran = DB::table('pembayarans')->where('order_id', $orderId)->first();

            if (!$pembayaran) {
                return redirect()->route('home')->with('error', 'Pembayaran tidak ditemukan');
            }

            // Update status pembayaran menjadi batal
            DB::table('pembayarans')
                ->where('order_id', $orderId)
                ->update([
                    'status_pembayaran' => 'batal',
                    'updated_at' => now(),
                ]);

            // Redirect ke halaman home dengan pesan notifikasi
            return redirect()->route('home')->with('notif', 'Pembayaran tidak diselesaikan. Silakan coba lagi!');
        } catch (\Exception $e) {
            // Log error jika ada
            Log::error('Error pada notfinish: ' . $e->getMessage());

            // Redirect dengan pesan error
            return redirect()->route('home')->with('error', 'Terjadi kesalahan saat memproses pembatalan pembayaran.');
        }
    }
}
