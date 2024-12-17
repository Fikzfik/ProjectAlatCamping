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

    public function editprofil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id_user . ',id_user',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->hasFile('photo')) {
            if ($user->photo && \Storage::exists('public/' . $user->photo)) {
                \Storage::delete('public/' . $user->photo);
            }

            $photo = $request->file('photo');
            $photoPath = $photo->store('profile_photos', 'public');
            $user->photo = $photoPath;
        }

        $user->save();

        return redirect()->route('userprofil')->with('success', 'Profil berhasil diperbarui!');
    }

    // Menampilkan semua data sto

    public function sempak(): view
    {
        return view('pages.auth.sempak');
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
