<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
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
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan barang ke keranjang.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
