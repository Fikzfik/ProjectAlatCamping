<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function store(Request $request)
    {
        // Validasi file yang di-upload
        $request->validate([
            'link_foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan barang
        $barang = DB::table('barangs')->insert([
            'nama_barang' => $request->nama_barang,
            'id_kategori' => $request->id_kategori,
            'harga_sewa' => $request->harga_sewa,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            // Simpan foto barang di storage/public/barang_foto
            'link_foto' => $request->file('link_foto') ? $request->file('link_foto')->storePublicly('barang_foto', 'public') : null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Cek apakah berhasil
        if ($barang) {
            return response()->json(['message' => 'Barang berhasil ditambahkan!']);
        }

        return response()->json(['message' => 'Gagal menambahkan barang.'], 500);
    }

    public function update(Request $request, $id)
    {
        // Update barang
        $filePath = $file->storeAs('public/barang_foto', $file->getClientOriginalName());
        $fileName = basename($filePath);
        $barang = DB::table('barangs')
            ->where('id_barang', $id)
            ->update([
                'nama_barang' => $request->nama_barang,
                'id_kategori' => $request->id_kategori,
                'harga_sewa' => $request->harga_sewa,
                'status' => $request->status,
                'deskripsi' => $request->deskripsi,
                'link_foto' => $filename,
                'updated_at' => now(),
            ]);

        return response()->json(['message' => 'Barang berhasil diperbarui!']);
    }
    public function updateModal($id)
    {
        // Mengambil data barang berdasarkan ID menggunakan Query Builder
        $barang = DB::table('barangs')->where('id_barang', $id)->first();

        // Cek apakah barang ditemukan
        if (!$barang) {
            return response()->json(['success' => false, 'message' => 'Barang tidak ditemukan']);
        }

        // Cek apakah barang memiliki link foto
        $fotoLink = $barang->link_foto ? asset('storage/' . $barang->link_foto) : asset('storage/barang_foto/default.jpg');

        // Mengembalikan data barang dalam format JSON
        return response()->json([
            'success' => true,
            'data' => [
                'id_barang' => $barang->id_barang,
                'nama_barang' => $barang->nama_barang,
                'id_kategori' => $barang->id_kategori,
                'harga_sewa' => $barang->harga_sewa,
                'status' => $barang->status,
                'deskripsi' => $barang->deskripsi,
            ],
            'link_foto' => $fotoLink, // Kirim URL lengkap foto barang
        ]);
    }
    public function destroy($id)
    {
        // Hapus barang
        DB::table('barangs')->where('id_barang', $id)->delete();

        return response()->json(['message' => 'Barang berhasil dihapus!']);
    }
}
