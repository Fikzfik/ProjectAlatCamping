<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectDummySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Clear existing dummy data to avoid duplicates if needed
        // DB::table('detail_penyewaans')->delete();
        // DB::table('penyewaans')->delete();

        // 2. Insert Premium Barangs if they don't exist
        $tentId = DB::table('barangs')->insertGetId([
            'nama_barang' => 'Tenda Eiger Guardian 4P',
            'link_foto' => 'barang_foto/tent.png',
            'deskripsi' => 'Tenda premium berkapasitas 4 orang dengan perlindungan cuaca maksimal.',
            'harga_sewa' => 125000,
            'status' => 'tersedia',
            'id_kategori' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $carrierId = DB::table('barangs')->insertGetId([
            'nama_barang' => 'Osprey Aether 60L',
            'link_foto' => 'barang_foto/carrier.png',
            'deskripsi' => 'Carrier ergonomis untuk pendakian jarak jauh.',
            'harga_sewa' => 85000,
            'status' => 'tersedia',
            'id_kategori' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $stoveId = DB::table('barangs')->insertGetId([
            'nama_barang' => 'Jetboil Flash Cooking System',
            'link_foto' => 'barang_foto/stove.png',
            'deskripsi' => 'Alat masak portable super cepat dan efisien.',
            'harga_sewa' => 45000,
            'status' => 'tersedia',
            'id_kategori' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Get first user or create one if none exists
        $user = DB::table('users')->first();
        if (!$user) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $userId = $user->id_user;
        }

        // 4. Create Booked Rental (Future date)
        $rentalBookedId = DB::table('penyewaans')->insertGetId([
            'id_user' => $userId,
            'tanggal_sewa' => Carbon::now()->addDays(5)->format('Y-m-d'),
            'tanggal_kembali' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'total_harga' => 250000,
            'status_sewa' => 'booked',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('detail_penyewaans')->insert([
            'id_penyewaan' => $rentalBookedId,
            'id_barang' => $tentId,
            'jumlah_barang' => 2,
            'harga_sewa' => 125000,
            'subtotal' => 250000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 5. Create Active Rental (Current date)
        $rentalActiveId = DB::table('penyewaans')->insertGetId([
            'id_user' => $userId,
            'tanggal_sewa' => Carbon::now()->subDays(1)->format('Y-m-d'),
            'tanggal_kembali' => Carbon::now()->addDays(2)->format('Y-m-d'),
            'total_harga' => 85000,
            'status_sewa' => 'tersewa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('detail_penyewaans')->insert([
            'id_penyewaan' => $rentalActiveId,
            'id_barang' => $carrierId,
            'jumlah_barang' => 1,
            'harga_sewa' => 85000,
            'subtotal' => 85000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 6. Create History Rental (Past date)
        $rentalHistoryId = DB::table('penyewaans')->insertGetId([
            'id_user' => $userId,
            'tanggal_sewa' => Carbon::now()->subDays(10)->format('Y-m-d'),
            'tanggal_kembali' => Carbon::now()->subDays(7)->format('Y-m-d'),
            'total_harga' => 45000,
            'status_sewa' => 'selesai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('detail_penyewaans')->insert([
            'id_penyewaan' => $rentalHistoryId,
            'id_barang' => $stoveId,
            'jumlah_barang' => 1,
            'harga_sewa' => 45000,
            'subtotal' => 45000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
