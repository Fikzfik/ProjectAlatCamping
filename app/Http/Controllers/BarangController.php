<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    public function updateStock(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'new_stock' => 'required|integer',
        ]);

        // Cari barang berdasarkan ID dengan raw SQL
        $barang = DB::select('SELECT * FROM barangs WHERE id_barang = ?', [$id]);

        if (empty($barang)) {
            return response()->json(['message' => 'Barang tidak ditemukan.'], 404);
        }

        // Update stok barang menggunakan raw SQL
        $stokUpdated = DB::update('UPDATE stok_barangs SET jumlah_stok = ? WHERE id_barang = ?', [$request->new_stock, $id]);

        if ($stokUpdated) {
            return response()->json(['message' => 'Stok berhasil diperbarui.']);
        }

        return response()->json(['message' => 'Gagal memperbarui stok.'], 500);
    }

    public function getAllBarang()
    {
        // Ambil semua barang
        $barang = DB::select("
        SELECT
            b.id_barang,
            b.nama_barang,
            b.link_foto,
            b.deskripsi,
            b.harga_sewa,
            b.status,
            k.nama_kategori
        FROM
            barangs b
        INNER JOIN
            kategori_barangs k
        ON
            b.id_kategori = k.id_kategori
    ");

        return response()->json($barang); // Kirim data barang dalam format JSON
    }
    public function getBarangByKategori(Request $request)
    {
        $kategoriId = $request->input('kategori_id'); // ID kategori yang dipilih

        // Gunakan raw SQL untuk mengambil data barang berdasarkan kategori
        $barang = DB::select(
            "
        SELECT
            b.id_barang,
            b.nama_barang,
            b.link_foto,
            b.deskripsi,
            b.harga_sewa,
            b.status,
            k.nama_kategori
        FROM
            barangs b
        INNER JOIN
            kategori_barangs k
        ON
            b.id_kategori = k.id_kategori
        WHERE
            b.id_kategori = ?",
            [$kategoriId],
        );

        return response()->json($barang); // Kirim data barang dalam format JSON
    }
    public function index()
    {
        try {
            // Query raw SQL untuk mengambil kategori
            $categories = DB::select('SELECT id_kategori, nama_kategori, deskripsi FROM kategori_barangs');

            // Mengembalikan response dalam format JSON
            return response()->json([
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            // Jika terjadi error, kirimkan error message
            return response()->json(
                [
                    'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }
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
        \Log::info('All Request Data', ['data' => $request->all()]);

        // Ambil id_kategori berdasarkan nama_kategori
        $data = DB::select('SELECT id_kategori FROM kategori_barangs WHERE nama_kategori = ?', [$request->id_kategori]);
        \Log::info('id data', $data);

        try {
            $barang = DB::table('barangs')->where('id_barang', $id)->first();
            \Log::info('1');
            $fileName = $barang->link_foto;
            \Log::info('2');

            // Jika ada foto baru yang diupload, simpan foto tersebut
            if ($request->hasFile('link_foto')) {
                $file = $request->file('link_foto');
                $fileName = $file->storePublicly('barang_foto', 'public');
            }

            // Konversi harga_sewa menjadi integer
            $harga_sewa = intval($request->harga_sewa); // Pastikan ini angka integer
            \Log::info('Harga sewa:', [$harga_sewa]);

            // Update data barang
            DB::table('barangs')
                ->where('id_barang', $id) // Gunakan ID barang yang benar, tanpa array
                ->update([
                    'nama_barang' => $request->nama_barang, // Tidak perlu membungkus dalam array
                    'id_kategori' => $data[0]->id_kategori, // ID kategori yang diambil dari query
                    'harga_sewa' => $harga_sewa, // Pastikan harga_sewa adalah angka
                    'status' => $request->status, // Status langsung dari request
                    'deskripsi' => $request->deskripsi, // Deskripsi langsung dari request
                    'link_foto' => $fileName, // Nama file foto
                    'updated_at' => now(), // Timestamp update
                ]);

            \Log::info('berhasil');
            return response()->json(['message' => 'Barang berhasil diperbarui!'], 200);
        } catch (\Exception $e) {
            \Log::error('Error occurred during update:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack' => $e->getTraceAsString(),
            ]);

            return response()->json(
                [
                    'message' => 'Terjadi kesalahan saat memperbarui barang.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
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
    public function show($id)
    {
        $barang = DB::table('barangs')
            ->join('kategori_barangs', 'barangs.id_kategori', '=', 'kategori_barangs.id_kategori')
            ->where('barangs.id_barang', $id)
            ->select('barangs.*', 'kategori_barangs.nama_kategori') // Pilih kolom yang diinginkan
            ->first();
        $userId = Auth::user()->id_user;

        // Mengambil semua data keranjang milik user dengan PDO
        $keranjang = DB::select(
            'SELECT
            k.id_keranjang,
            k.jumlah_barang,
            b.nama_barang,
            b.harga_sewa,
            b.link_foto,
            b.deskripsi
            FROM keranjangs k
            JOIN barangs b ON k.id_barang = b.id_barang
            WHERE k.id_user = ?
            ',
            [$userId],
        );
        // @dd($keranjang);
        return view('pages.auth.detail', compact('barang'));
    }
}
