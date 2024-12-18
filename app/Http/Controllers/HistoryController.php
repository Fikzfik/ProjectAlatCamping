<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function history(): view
    {
        $idUser = Auth::id();
        $currentDate = date('Y-m-d');

        // Ambil semua id_penyewaan milik user
        $idPenyewaanUser = DB::table('penyewaans')->where('id_user', $idUser)->pluck('id_penyewaan');

        // Update status menjadi "booked" jika tanggal_sewa > hari ini
        DB::table('penyewaans')
            ->whereIn('id_penyewaan', $idPenyewaanUser)
            ->where('tanggal_sewa', '>', $currentDate)
            ->update(['status_sewa' => 'booked']);

        // Update status menjadi "tersewa" jika tanggal_sewa <= hari ini dan tanggal_kembali >= hari ini
        DB::table('penyewaans')
            ->whereIn('id_penyewaan', $idPenyewaanUser)
            ->where('tanggal_sewa', '<=', $currentDate)
            ->where('tanggal_kembali', '>=', $currentDate)
            ->update(['status_sewa' => 'tersewa']);

        // Update status menjadi "selesai" jika tanggal_kembali < hari ini
        DB::table('penyewaans')
            ->whereIn('id_penyewaan', $idPenyewaanUser)
            ->where('tanggal_kembali', '<', $currentDate)
            ->update(['status_sewa' => 'selesai']);

        // Query untuk barang yang sudah dibooking
        $barangBooked = DB::select(
            "
        SELECT dp.id_barang, b.nama_barang, dp.jumlah_barang, dp.harga_sewa, dp.subtotal,
               p.tanggal_sewa as tanggal_booking, p.tanggal_kembali, b.link_foto, k.nama_kategori
        FROM detail_penyewaans dp
        JOIN barangs b ON dp.id_barang = b.id_barang
        JOIN kategori_barangs k ON b.id_kategori = k.id_kategori
        JOIN penyewaans p ON dp.id_penyewaan = p.id_penyewaan
        WHERE p.tanggal_sewa > ? AND p.id_user = ?
    ",
            [$currentDate, $idUser],
        );

        // Query untuk barang yang sedang disewa
        $barangRented = DB::select(
            "
        SELECT dp.id_barang, b.nama_barang, dp.jumlah_barang, dp.harga_sewa, dp.subtotal,
               p.tanggal_sewa, p.tanggal_kembali, b.link_foto, k.nama_kategori
        FROM detail_penyewaans dp
        JOIN barangs b ON dp.id_barang = b.id_barang
        JOIN kategori_barangs k ON b.id_kategori = k.id_kategori
        JOIN penyewaans p ON dp.id_penyewaan = p.id_penyewaan
        WHERE p.tanggal_sewa <= ? AND p.tanggal_kembali >= ? AND p.id_user = ?
    ",
            [$currentDate, $currentDate, $idUser],
        );

        // Query untuk barang yang sudah selesai disewa (History)
        $barangHistory = DB::select(
            "
        SELECT dp.id_barang, b.nama_barang, dp.jumlah_barang, dp.harga_sewa, dp.subtotal,
               p.tanggal_sewa, p.tanggal_kembali, b.link_foto, k.nama_kategori,
               f.id_feedback, p.id_penyewaan
        FROM detail_penyewaans dp
        JOIN barangs b ON dp.id_barang = b.id_barang
        JOIN kategori_barangs k ON b.id_kategori = k.id_kategori
        JOIN penyewaans p ON dp.id_penyewaan = p.id_penyewaan
        LEFT JOIN feedbacks f ON dp.id_barang = f.id_barang AND dp.id_penyewaan = f.id_penyewaan
        WHERE p.tanggal_kembali < ? AND p.id_user = ?
    ",
            [$currentDate, $idUser],
        );

        // Kirim data ke view
        return view('pages.auth.history', compact('barangBooked', 'barangRented', 'barangHistory'));
    }
    public function store(Request $request)
    {
        // Log data request untuk debugging
        Log::info('Request Data: ', $request->all());

        // Ambil id_user dari user yang sedang login
        $idUser = Auth::user()->id_user;
        Log::info('ID User: ' . $idUser);

        // Data input
        $idPenyewaan = $request->input('id_penyewaan');
        $items = $request->input('items');

        // Log input sebelum proses penyimpanan
        Log::info('Input Data ID Penyewaan: ' . $idPenyewaan);
        Log::info('Items: ', $items);

        DB::beginTransaction();
        try {
            // Simpan data ke tabel pengembalians
            $idPengembalian = DB::table('pengembalians')->insertGetId([
                'tanggal_pengembalian' => now(),
                'id_user' => $idUser,
                'id_penyewaan' => $idPenyewaan,
                'denda_keterlambatan' => 0, // Default denda 0
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('ID Pengembalian yang disimpan: ' . $idPengembalian);

            // Loop untuk menyimpan data ke tabel detail_pengembalians
            foreach ($items as $item) {
                Log::info('Menyimpan detail pengembalian: ', $item);
                DB::table('detail_pengembalians')->insert([
                    'id_pengembalian' => $idPengembalian,
                    'id_detail_penyewaan' => $item['id_detail_penyewaan'],
                    'kondisi_barang' => $item['kondisi_barang'],
                    'jumlah_pengembalian' => $item['jumlah_pengembalian'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            Log::info('Pengembalian berhasil disimpan.');

            return response()->json(['message' => 'Pengembalian berhasil disimpan.'], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error
            Log::error('Error saat menyimpan pengembalian: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            return response()->json(
                [
                    'message' => 'Terjadi kesalahan saat menyimpan pengembalian.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
