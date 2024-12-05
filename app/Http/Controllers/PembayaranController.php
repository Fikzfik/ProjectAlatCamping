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
        Log::info('Full Midtrans Response: Index1');
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
    public function index1(Request $request)
    {
        DB::beginTransaction(); // Mulai transaksi database
        Log::info('Full Midtrans Response: Index');
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

            // Buat penyewaan baru
            $idPenyewaan = DB::table('penyewaans')->insertGetId([
                'tanggal_sewa' => now(),
                'tanggal_kembali' => now()->addDays(7), // Contoh durasi sewa 7 hari
                'status_sewa' => 'dalam proses',
                'total_harga' => $totalHarga,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Buat detail penyewaan berdasarkan barang yang dipilih
            foreach ($selectedData as $item) {
                // Menghitung subtotal berdasarkan jumlah hari sewa
                $startDate = new \DateTime($item['tanggal_sewa']);
                $endDate = new \DateTime($item['tanggal_kembali']);
                $diffDays = $endDate->diff($startDate)->days;

                Log::info('Id keranjang : ' . $item['id_keranjang']);
                $subtotal = $item['harga_sewa'] * $item['jumlah'] * $diffDays;

                DB::table('detail_penyewaans')->insert([
                    'id_penyewaan' => $idPenyewaan,
                    'id_keranjang' => $item['id_keranjang'],
                    'jumlah_barang' => $item['jumlah'],
                    'harga_sewa' => $item['harga_sewa'],
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Format item untuk Midtrans
            $items = [];
            foreach ($selectedData as $item) {
                // Log::info('itemsnya ' . $item['id_keranjang'] . ' ' . $item['harga_sewa'] . ' ' . $item['jumlah_barang'] . ' ' . $item['nama_barang']);

                $items[] = [
                    'id' => $item['id_keranjang'],
                    'price' => $item['harga_sewa'],
                    'quantity' => $item['jumlah'],
                    'name' => $item['nama_barang'],
                ];
            }

            // Payload untuk Midtrans
            $orderId = Str::uuid()->toString();
            $transactionData = [
                'payment_type' => 'credit_card', // Adjust with the payment method you want to use
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $orderId, // Unique order ID
                    'gross_amount' => $totalHarga, // Total price for the transaction
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
                'jumlah_pembayaran' => $totalHarga,
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
        Log::info('Full Midtrans Response: webhook');
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
            }

            return response()->json(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui']);
        } catch (\Exception $e) {
            Log::error('Error pada webhook: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }

    public function finish(Request $request)
    {
        Log::info('Full Midtrans Response: finish');
        try {
            // Ambil order_id dan status transaksi dari query string
            $orderId = $request->input('order_id');
            $statusCode = $request->input('status_code');
            $transactionStatus = $request->input('transaction_status');

            // Validasi order_id dan status transaksi
            if (empty($orderId)) {
                return redirect()->route('home')->with('error', 'Order ID tidak ditemukan');
            }

            // Cek apakah transaksi berhasil
            if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
                // Ambil data pembayaran berdasarkan order_id
                $pembayaran = DB::table('pembayarans')->where('order_id', $orderId)->first();

                // Validasi pembayaran
                if (!$pembayaran) {
                    return redirect()->route('home')->with('error', 'Pembayaran tidak ditemukan');
                }

                // Pembayaran berhasil, hapus keranjang user
                $userId = auth()->user()->id_user;
                DB::table('keranjangs')->where('user_id', $userId)->delete();

                // Perbarui status pembayaran di database
                DB::table('pembayarans')
                    ->where('order_id', $orderId)
                    ->update(['status_pembayaran' => 'settlement']);

                // Redirect ke halaman home dengan notifikasi pembayaran berhasil
                return redirect()->route('home')->with('notif', 'Pembayaran berhasil, silahkan ambil barang');
            }

            // Jika transaksi tidak berhasil, tampilkan pesan error
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
