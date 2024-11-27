<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
