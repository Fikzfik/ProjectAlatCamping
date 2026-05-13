<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenyewaanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penyewaans')->insert([
            [
                'tanggal_sewa' => Carbon::now()->subDays(10),
                'tanggal_kembali' => Carbon::now()->subDays(7),
                'status_sewa' => 'selesai',
                'total_harga' => 180000.00,
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_sewa' => Carbon::now()->subDays(5),
                'tanggal_kembali' => Carbon::now()->subDays(2),
                'status_sewa' => 'selesai',
                'total_harga' => 230000.00,
                'id_user' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
