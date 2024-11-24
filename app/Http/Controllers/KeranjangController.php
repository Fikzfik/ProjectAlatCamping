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
        WHERE k.id_user = ?
    ',
            [$userId],
        );

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

            // Simpan data ke tabel keranjangs menggunakan Query Builder
            DB::table('keranjangs')->insert([
                'id_user' => Auth::id(), // Mengambil ID user yang login
                'id_barang' => $request->id_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

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
