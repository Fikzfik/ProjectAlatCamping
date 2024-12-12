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
        $stores = DB::select('SELECT * FROM stores');
        return view('pages.auth.location',compact('stores'));
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
    public function penyewaan1(): View
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

        return view('pages.auth.penyewaan1', compact('keranjangs'));
    }

    public function blogview(): view
    {
        return view('pages.auth.blog');
    }
    public function dashboard(): view
    {
        return view('pages.auth.dashboard');
    }
    public function test(): view
    {
        return view('pages.auth.test');
    }
    public function sempak(): view
    {
        return view('pages.auth.sempak');
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

    public function userprofil()
{
    $user = Auth::user(); // Mengambil data pengguna yang sedang login
    return view('pages.auth.userprofil', compact('user')); // Menampilkan profil pengguna
}


     // Memproses pembaruan data profil
     public function editprofil(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,' . Auth::id(),
         ]);
 
         $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
         $user->name = $request->input('name');
         $user->email = $request->input('email');
         $user->save(); // Simpan perubahan ke database
 
         return redirect()->route('editprofil')->with('success', 'Profil berhasil diperbarui!');
     }
}
