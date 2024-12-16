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


        public function userprofil()
        {
            // Ambil data pengguna yang sedang login
            $user = Auth::user();
    
            // Pastikan data dikirim ke view
            return view('pages.auth.userprofil', compact('user'));
        }
    
        public function updateprofil(Request $request)
        {
            // Validasi input
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'phone' => 'nullable|string|max:15',
                'street' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'zip_code' => 'nullable|string|max:10',
                'photo' => 'nullable|image|max:2048',
            ]);
    
            // Ambil data user yang sedang login
            $user = Auth::user();
    
            // Update data user
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
            ]);
    
            // Update foto jika diunggah
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('profile_photos', 'public');
                $user->update(['photo' => $path]);
            }
    
            return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
        }
}

