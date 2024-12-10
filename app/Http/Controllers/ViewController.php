<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        JOIN kategori_barangs k ON b.id_kategori = k.id_kategori');

        return view('pages.auth.home', compact('barang', 'kategori'));
    }

    public function locationview()
    {
        return view('pages.auth.location');
    }

    public function penyewaan()
    {
        $userId = auth()->id();
        $keranjangs = DB::select('SELECT
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
        WHERE k.id_user = ?', [$userId]);

        return view('pages.auth.penyewaan', compact('keranjangs'));
    }

    public function blogview()
    {
        return view('pages.auth.blog');
    }

    public function dashboard()
    {
        return view('pages.auth.dashboard');
    }

    public function barangview()
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
        JOIN kategori_barangs k ON b.id_kategori = k.id_kategori');

        return view('pages.auth.barang', compact('kategori', 'barang'));
    }

    /**
     * Menampilkan profil pengguna yang sedang login.
     */
    public function userprofil()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('pages.auth.userprofil', compact('user'));
    }

    /**
     * Memproses pembaruan data profil pengguna.
     */
    public function editprofil(Request $request)
{
    // Validasi data input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . Auth::user()->id_user . ',id_user',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto opsional
    ]);

    // Mendapatkan data pengguna yang sedang login
    $user = Auth::user();
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Jika ada file foto yang diupload
    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($user->photo && \Storage::exists('public/' . $user->photo)) {
            \Storage::delete('public/' . $user->photo);
        }

        // Simpan foto baru
        $photo = $request->file('photo');
        $photoPath = $photo->store('profile_photos', 'public'); // Simpan foto ke direktori storage/app/public/profile_photos
        $user->photo = $photoPath;
    }

    $user->save(); // Simpan perubahan ke database

    return redirect()->route('userprofil')->with('success', 'Profil berhasil diperbarui!');
}

}
