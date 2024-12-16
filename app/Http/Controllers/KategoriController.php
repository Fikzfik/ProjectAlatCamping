<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function kategoriview()
{
    // Ambil data kategori dari database
    $kategori = DB::table('kategori_barangs');
    return view('pages.auth.kategori', compact('kategori'));
}

    public function store(Request $request)
    {
        $kategori = DB::table('kategori_barangs')->insert([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($kategori) {
            return response()->json(['message' => 'Kategori berhasil ditambahkan!']);
        }

        return response()->json(['message' => 'Gagal menambahkan kategori.'], 500);
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Update kategori
        $kategori = DB::table('kategori_barangs')
            ->where('id_kategori', $id)
            ->update([
                'nama_kategori' => $request->nama_kategori,
                'deskripsi' => $request->deskripsi,
                'updated_at' => now(),
            ]);

        if ($kategori) {
            return response()->json(['message' => 'Kategori berhasil diperbarui!']);
        }

        return response()->json(['message' => 'Gagal memperbarui kategori.'], 500);
    }

    public function updateModal($id)
    {
        // Mengambil data kategori berdasarkan ID
        $kategori = DB::table('kategori_barangs')->where('id_kategori', $id)->first();

        if (!$kategori) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan']);
        }

        return response()->json([
            'success' => true,
            'data' => $kategori,
        ]);
    }

    public function destroy($id)
    {
        // Hapus kategori
        $kategori = DB::table('kategori_barangs')->where('id_kategori', $id)->delete();

        if ($kategori) {
            return response()->json(['message' => 'Kategori berhasil dihapus!']);
        }

        return response()->json(['message' => 'Gagal menghapus kategori.'], 500);
    }
}
