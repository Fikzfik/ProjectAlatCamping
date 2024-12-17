<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KategoriController extends Controller
{
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
    
        \Log::info('Request Data:', $request->all());

        try {
            DB::table('kategori_barangs')
                ->where('id_kategori', $id)
                ->update([
                    'nama_kategori' => $request->input('nama_kategori'),
                    'deskripsi' => $request->input('deskripsi'),
                    'updated_at' => now(),
                ]);

            return response()->json(
                [
                    'message' => 'Kategori berhasil diperbarui!',
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => 'Gagal memperbarui kategori.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
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
