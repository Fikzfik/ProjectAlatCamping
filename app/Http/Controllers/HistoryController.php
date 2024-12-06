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

        // Query untuk barang dengan status "tersewa"
        $barangTersewa = DB::table('detail_penyewaans as dp')->join('barangs as b', 'dp.id_barang', '=', 'b.id_barang')->join('penyewaans as p', 'dp.id_penyewaan', '=', 'p.id_penyewaan')->where('p.status_sewa', 'tersewa')->where('p.id_user', $idUser)->select('dp.id_barang', 'b.nama_barang', 'dp.jumlah_barang', 'dp.harga_sewa', 'dp.subtotal', 'p.tanggal_sewa', 'p.tanggal_kembali')->get();

        // Query untuk barang dengan status "selesai"
        $barangSelesai = DB::table('detail_penyewaans as dp')->join('barangs as b', 'dp.id_barang', '=', 'b.id_barang')->join('penyewaans as p', 'dp.id_penyewaan', '=', 'p.id_penyewaan')->where('p.status_sewa', 'selesai')->where('p.id_user', $idUser)->select('dp.id_barang', 'b.nama_barang', 'dp.jumlah_barang', 'dp.harga_sewa', 'dp.subtotal', 'p.tanggal_sewa', 'p.tanggal_kembali')->get();

        // Kirim data ke view
        return view('pages.auth.history', [
            'barangTersewa' => $barangTersewa,
            'barangSelesai' => $barangSelesai,
        ]);
    }
}
