<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPenyewaanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('detail_penyewaans')->insert([
            [
                'jumlah_barang' => 1,
                'harga_sewa' => 100000.00,
                'subtotal' => 100000.00,
                'id_barang' => 1, // Tenda 2 Orang
                'id_penyewaan' => 1,
                'id_keranjang' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jumlah_barang' => 1,
                'harga_sewa' => 80000.00,
                'subtotal' => 80000.00,
                'id_barang' => 7, // Lampu Senter LED
                'id_penyewaan' => 1,
                'id_keranjang' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jumlah_barang' => 2,
                'harga_sewa' => 150000.00,
                'subtotal' => 150000.00,
                'id_barang' => 2, // Tenda 4 Orang
                'id_penyewaan' => 2,
                'id_keranjang' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jumlah_barang' => 1,
                'harga_sewa' => 80000.00,
                'subtotal' => 80000.00,
                'id_barang' => 5, // Carrier 60L
                'id_penyewaan' => 2,
                'id_keranjang' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
