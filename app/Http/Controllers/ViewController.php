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

    // Menampilkan semua data stok
    public function stockview()
    {
        $stocks = DB::table('stok_barangs')->get();
        return view('pages.auth.stock', compact('stocks'));
    }

    // Menyimpan data stok baru
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_stok' => 'required|integer',
            'id_barang' => 'required|integer',
        ]);

        StokBarang::create([
            'jumlah_stok' => $request->jumlah_stok,
            'id_barang' => $request->id_barang,
        ]);

        return redirect()->back()->with('success', 'Stok berhasil ditambahkan!');
    }

    // Mengupdate data stok
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_stok' => 'required|integer',
            'id_barang' => 'required|integer',
        ]);

        $stok = StokBarang::findOrFail($id);
        $stok->update([
            'jumlah_stok' => $request->jumlah_stok,
            'id_barang' => $request->id_barang,
        ]);

        return redirect()->back()->with('success', 'Stok berhasil diperbarui!');
    }

    // Menghapus data stok
    public function destroy($id)
    {
        $stok = StokBarang::findOrFail($id);
        $stok->delete();

        return redirect()->back()->with('success', 'Stok berhasil dihapus!');
    }
}
