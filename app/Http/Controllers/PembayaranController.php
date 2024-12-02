<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

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

            // Payload untuk Midtrans
            $transactionData = [
                'payment_type' => $paymentType,
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $idPenyewaan,
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
            $response = $client->post('https://api.sandbox.midtrans.com/v2/charge', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(env('MIDTRANS_SERVER_KEY') . ':'),
                    'Content-Type' => 'application/json',
                ],
                'json' => $transactionData,
            ]);

            // Jika response tidak OK, lakukan rollback
            if ($response->getStatusCode() != 200) {
                Log::error('Midtrans Error: ' . $response->getBody());
                DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Terjadi kesalahan saat memproses pembayaran.',
                        'error' => 'Midtrans response error: ' . $response->getBody(),
                    ],
                    500,
                );
            }

            // Jika tidak ada error, commit transaksi
            DB::commit();

            $responseBody = json_decode($response->getBody(), true);
            Log::info('Response from Midtrans: ' . json_encode($responseBody));

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat!',
                'data' => $responseBody,
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
}
