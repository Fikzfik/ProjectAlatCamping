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
        return view('pages.auth.home');
    }
    public function locationview(): view
    {
        return view('pages.auth.location');
    }
    public function blogview(): view
    {
        return view('pages.auth.blog');
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
