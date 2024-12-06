<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KeranjangController extends Controller
{
    public function keranjangview()
    {
        $userId = Auth::user()->id_user;

        $keranjang = DB::select(
            'SELECT
            k.id_keranjang,
            k.jumlah_barang,
            b.nama_barang,
            b.harga_sewa,
            b.link_foto,
            b.deskripsi
        FROM keranjangs k
        JOIN barangs b ON k.id_barang = b.id_barang
        WHERE k.id_user = ?',
            [$userId],
        );

        // Tambahkan URL lengkap untuk `link_foto`
        $keranjang = collect($keranjang)->map(function ($item) {
            $item->link_foto = asset('storage/' . $item->link_foto);
            return $item;
        });

        return response()->json($keranjang); // Mengembalikan data dalam format JSON
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'id_barang' => 'required|exists:barangs,id_barang',
                'jumlah_barang' => 'required|integer|min:1',
            ]);

            // Ambil ID user yang login
            $userId = Auth::id();
            \Log::info('User ID'. $userId);
            // Cek apakah barang sudah ada di keranjang
            $existingItem = DB::table('keranjangs')
                ->where('id_user', $userId)
                ->where('id_barang', $request->id_barang)
                ->first();

            if ($existingItem) {
                // Jika barang sudah ada, update jumlahnya
                DB::table('keranjangs')
                    ->where('id_user', $userId)
                    ->where('id_barang', $request->id_barang)
                    ->update([
                        'jumlah_barang' => $existingItem->jumlah_barang + $request->jumlah_barang,
                        'updated_at' => now(),
                    ]);
            } else {
                // Jika barang belum ada, tambahkan baru ke keranjang
                DB::table('keranjangs')->insert([
                    'id_user' => $userId, // Mengambil ID user yang login
                    'id_barang' => $request->id_barang,
                    'jumlah_barang' => $request->jumlah_barang,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Barang berhasil ditambahkan ke keranjang!',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal menambahkan barang ke keranjang.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
    public function increaseQuantity(Request $request)
    {
        \Log::info('Masuk ke increaseQuantity controller. Data: ', $request->all());
        try {
            $request->validate([
                'id_keranjang' => 'required|exists:keranjangs,id_keranjang',
            ]);

            // Tambahkan jumlah barang
            DB::table('keranjangs')
                ->where('id_keranjang', $request->id_keranjang)
                ->increment('jumlah_barang');

            // Ambil jumlah barang terbaru
            $updatedItem = DB::table('keranjangs')
                ->where('id_keranjang', $request->id_keranjang)
                ->first();

            return response()->json([
                'success' => true,
                'message' => 'Jumlah barang berhasil ditambah!',
                'jumlah_barang' => $updatedItem->jumlah_barang, // Kirim jumlah terbaru
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal menambah jumlah barang.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function decreaseQuantity(Request $request)
    {
        \Log::info('Masuk ke decreaseQuantity controller. Data: ', $request->all());
        try {
            $request->validate([
                'id_keranjang' => 'required|exists:keranjangs,id_keranjang',
            ]);

            // Ambil data keranjang untuk memastikan jumlah barang > 1
            $item = DB::table('keranjangs')
                ->where('id_keranjang', $request->id_keranjang)
                ->first();

            if (!$item) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data keranjang tidak ditemukan!',
                    ],
                    404,
                );
            }

            if ($item->jumlah_barang > 1) {
                // Kurangi jumlah barang
                DB::table('keranjangs')
                    ->where('id_keranjang', $request->id_keranjang)
                    ->decrement('jumlah_barang');

                // Ambil jumlah barang terbaru
                $updatedItem = DB::table('keranjangs')
                    ->where('id_keranjang', $request->id_keranjang)
                    ->first();

                return response()->json([
                    'success' => true,
                    'message' => 'Jumlah barang berhasil dikurangi!',
                    'jumlah_barang' => $updatedItem->jumlah_barang, // Kirim jumlah terbaru
                ]);
            } else {
                // Hapus jika jumlah barang <= 1
                DB::table('keranjangs')
                    ->where('id_keranjang', $request->id_keranjang)
                    ->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Barang dihapus dari keranjang!',
                    'jumlah_barang' => 0, // Barang dihapus, kirim jumlah sebagai 0
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal mengurangi jumlah barang.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
