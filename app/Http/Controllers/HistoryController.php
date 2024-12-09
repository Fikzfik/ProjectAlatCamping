<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function history(): view
    {
        $idUser = Auth::id();
        $currentDate = date('Y-m-d');

        // Query untuk barang yang sudah dibooking
        $barangBooked = DB::select(
            "
    SELECT dp.id_barang, b.nama_barang, dp.jumlah_barang, dp.harga_sewa, dp.subtotal,
           p.tanggal_sewa, p.tanggal_kembali, b.link_foto, k.nama_kategori
    FROM detail_penyewaans dp
    JOIN barangs b ON dp.id_barang = b.id_barang
    JOIN kategori_barangs k ON b.id_kategori = k.id_kategori
    JOIN penyewaans p ON dp.id_penyewaan = p.id_penyewaan
    WHERE p.tanggal_sewa > ? AND p.id_user = ?
",
            [$currentDate, $idUser],
        );

        // Query untuk barang yang sedang disewa
        $barangRented = DB::select(
            "
    SELECT dp.id_barang, b.nama_barang, dp.jumlah_barang, dp.harga_sewa, dp.subtotal,
           p.tanggal_sewa, p.tanggal_kembali, b.link_foto, k.nama_kategori
    FROM detail_penyewaans dp
    JOIN barangs b ON dp.id_barang = b.id_barang
    JOIN kategori_barangs k ON b.id_kategori = k.id_kategori
    JOIN penyewaans p ON dp.id_penyewaan = p.id_penyewaan
    WHERE p.tanggal_sewa <= ? AND p.tanggal_kembali >= ? AND p.id_user = ?
",
            [$currentDate, $currentDate, $idUser],
        );

        // Query untuk barang yang sudah selesai disewa (History)
        $barangHistory = DB::select(
            "
    SELECT dp.id_barang, b.nama_barang, dp.jumlah_barang, dp.harga_sewa, dp.subtotal,
           p.tanggal_sewa, p.tanggal_kembali, b.link_foto, k.nama_kategori
    FROM detail_penyewaans dp
    JOIN barangs b ON dp.id_barang = b.id_barang
    JOIN kategori_barangs k ON b.id_kategori = k.id_kategori
    JOIN penyewaans p ON dp.id_penyewaan = p.id_penyewaan
    WHERE p.tanggal_kembali < ? AND p.id_user = ?
",
            [$currentDate, $idUser],
        );
        // Kirim data ke view
        return view('pages.auth.history', compact('barangBooked', 'barangRented', 'barangHistory'));
    }
}
