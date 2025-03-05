<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function loginview()
    {
        return view('pages.login');
    }

    public function registerview()
    {
        return view('pages.register');
    }

    public function homeview()
    {
        $kategori = DB::select('SELECT * FROM kategori_barangs');
        $barang = DB::select('SELECT
            b.id_barang,
            b.nama_barang,
            b.link_foto,
            b.deskripsi,
            b.harga_sewa,
            b.status,
            b.id_kategori,
            k.nama_kategori
            FROM barangs b
            JOIN kategori_barangs k
            ON b.id_kategori = k.id_kategori
        ');

        return view('pages.auth.home', compact('barang', 'kategori'));
    }
    public function locationview(): view
    {
        $stores = DB::select('SELECT * FROM stores');
        return view('pages.auth.location', compact('stores'));
    }
    public function penyewaan(): View
    {
        $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login

        $keranjangs = DB::select(
            'SELECT
            k.id_keranjang,
            b.id_barang,
            b.nama_barang,
            b.link_foto,
            b.deskripsi,
            b.harga_sewa,
            b.status,
            kb.id_kategori,
            kb.nama_kategori,
            k.jumlah_barang
            FROM keranjangs k
            JOIN barangs b ON k.id_barang = b.id_barang
            JOIN kategori_barangs kb ON b.id_kategori = kb.id_kategori
            JOIN users u on u.id_user = k.id_user
            WHERE k.id_user = ?
        ',
            [$userId],
        );

        return view('pages.auth.penyewaan', compact('keranjangs'));
    }

    public function barangview()
    {
        $kategori = DB::select('SELECT * FROM kategori_barangs');
        $barang = DB::select(
            'SELECT
            b.id_barang,
            b.nama_barang,
            b.link_foto,
            b.deskripsi,
            b.harga_sewa,
            b.status,
            kb.id_kategori,
            kb.nama_kategori,
            k.jumlah_barang
            FROM keranjangs k
            JOIN barangs b ON k.id_barang = b.id_barang
            JOIN kategori_barangs kb ON b.id_kategori = kb.id_kategori
            JOIN users u on u.id_user = k.id_user
            WHERE k.id_user = ?
        ',
            [$userId],
        );

        return view('pages.auth.penyewaan', compact('keranjangs'));
    }

    public function userprofil()
    {
        $user = Auth::user();
        return view('pages.auth.userprofil', compact('user'));
    }

    public function blogview()
    {
        $user = Auth::user();
        return view('pages.auth.blog', compact('user'));
    }
    

    public function return(): view
    {
        $penyewaanSelesai = DB::select("
      SELECT
    p.id_penyewaan,
    p.tanggal_sewa,
    p.tanggal_kembali,
    b.nama_barang,
    b.link_foto,
    b.deskripsi,
    dp.id_detail_penyewaan,
    dp.jumlah_barang,
    dp.harga_sewa,
    dp.subtotal,
    (dp.jumlah_barang - COALESCE(
        (SELECT SUM(dp2.jumlah_pengembalian)
         FROM detail_pengembalians dp2
         WHERE dp2.id_detail_penyewaan = dp.id_detail_penyewaan
        ), 0)) AS sisa_barang
FROM penyewaans p
JOIN detail_penyewaans dp
    ON p.id_penyewaan = dp.id_penyewaan
JOIN barangs b
    ON dp.id_barang = b.id_barang
LEFT JOIN detail_pengembalians dpg
    ON dp.id_detail_penyewaan = dpg.id_detail_penyewaan
WHERE p.status_sewa = 'selesai'
HAVING sisa_barang > 0;

    ");
        // @dd($penyewaanSelesai);
        // Kelompokkan penyewaan berdasarkan id_penyewaan
        $groupedPenyewaan = collect($penyewaanSelesai)->groupBy('id_penyewaan');
        // @dd($groupedPenyewaan);
        // Kembalikan hasil ke tampilan
        return view('pages.auth.return', compact('groupedPenyewaan'));
    }

    public function stockview(): view
    {
        $categories = DB::select('SELECT * FROM kategori_barangs');
        $barang = DB::select('SELECT
            b.id_barang,
            b.nama_barang,
            b.link_foto,
            b.deskripsi,
            b.harga_sewa,
            b.status,
            b.id_kategori,
            k.nama_kategori,
            sb.jumlah_stok
        FROM barangs b
        JOIN kategori_barangs k ON b.id_kategori = k.id_kategori
        LEFT JOIN stok_barangs sb ON b.id_barang = sb.id_barang
    ');
        return view('pages.auth.stock', compact('barang', 'categories'));
    }
}
