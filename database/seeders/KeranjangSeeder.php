<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeranjangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('keranjangs')->insert([
            [
                'id_user' => 1,
                'id_barang' => 1,
                'jumlah_barang' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_barang' => 3,
                'jumlah_barang' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
