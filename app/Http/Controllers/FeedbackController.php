<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'id_penyewaan' => 'required|exists:penyewaans,id_penyewaan',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:255',
        ]);

        // Cek apakah feedback sudah ada
        $cekFeedback = DB::table('feedbacks')
            ->where('id_barang', $request->id_barang)
            ->where('id_penyewaan', $request->id_penyewaan)
            ->exists();

        if ($cekFeedback) {
            return back()->with('error', 'Feedback sudah pernah diberikan!');
        }

        // Simpan feedback
        DB::table('feedbacks')->insert([
            'id_barang' => $request->id_barang,
            'id_penyewaan' => $request->id_penyewaan,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'tanggal_feedback' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Feedback berhasil disimpan!');
    }
}
