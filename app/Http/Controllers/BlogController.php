<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Tampilkan semua blog
    public function addblogview()
    {
        $blogs = DB::table('blogs')->latest()->paginate(10); // Mengambil semua blog dengan pagination
        return view('pages.auth.addblog', compact('blogs'));
    }

    // Form tambah blog
    public function create()
    {
        return view('blogs.create');
    }

    // Simpan blog baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Menyimpan foto jika ada
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('uploads/blogs', 'public');
        }

        // Menyimpan data blog ke database
        DB::table('blogs')->insert([
            'judul' => $validatedData['judul'],
            'konten' => $validatedData['konten'],
            'tanggal' => $validatedData['tanggal'],
            'foto' => $validatedData['foto'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('pages.auth.addblog')->with('success', 'Blog berhasil ditambahkan.');
    }

    // Form edit blog
    public function edit($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first(); // Mengambil data blog berdasarkan ID
        if (!$blog) {
            return redirect()->route('blogs.index')->with('error', 'Blog tidak ditemukan.');
        }

        return view('blogs.edit', compact('blog'));
    }

    // Update blog
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $blog = DB::table('blogs')->where('id', $id)->first();
        if (!$blog) {
            return redirect()->route('blogs.index')->with('error', 'Blog tidak ditemukan.');
        }

        // Menghapus foto lama jika ada dan mengganti dengan foto baru
        if ($request->hasFile('foto')) {
            if ($blog->foto) {
                Storage::disk('public')->delete($blog->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('uploads/blogs', 'public');
        }

        // Mengupdate data blog
        DB::table('blogs')->where('id', $id)->update([
            'judul' => $validatedData['judul'],
            'konten' => $validatedData['konten'],
            'tanggal' => $validatedData['tanggal'],
            'foto' => $validatedData['foto'] ?? $blog->foto,
            'updated_at' => now(),
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog berhasil diperbarui.');
    }

    // Hapus blog
    public function destroy($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        if (!$blog) {
            return redirect()->route('blogs.index')->with('error', 'Blog tidak ditemukan.');
        }

        // Menghapus foto blog jika ada
        if ($blog->foto) {
            Storage::disk('public')->delete($blog->foto);
        }

        // Menghapus data blog
        DB::table('blogs')->where('id', $id)->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog berhasil dihapus.');
    }
}
