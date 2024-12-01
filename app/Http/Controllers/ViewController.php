<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function loginview(): view
    {
        return view('pages.login');
    }
    public function registerview(): view
    {
        return view('pages.register');
    }
    public function homeview(): view
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
        return view('pages.auth.location');
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

    public function blogview(): view
    {
        return view('pages.auth.blog');
    }
    public function dashboard(): view
    {
        return view('pages.auth.dashboard');
    }
    public function barangview(): view
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

        return view('pages.auth.barang', compact('kategori', 'barang'));
    }
}
