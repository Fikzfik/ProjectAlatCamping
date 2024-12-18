<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokBarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stok_barangs')->insert([
            [
                'jumlah_stok' => 10,
                'id_barang' => 1, // Laptop Gaming
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jumlah_stok' => 5,
                'id_barang' => 2, // Kamera DSLR
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jumlah_stok' => 2,
                'id_barang' => 3, // Sofa Minimalis
                'created_at' => now(),
                'updated_at' => now(),
            ],  [
                'jumlah_stok' => 2,
                'id_barang' => 4, // Sofa Minimalis
                'created_at' => now(),
                'updated_at' => now(),
            ],  [
                'jumlah_stok' => 2,
                'id_barang' => 5, // Sofa Minimalis
                'created_at' => now(),
                'updated_at' => now(),
            ],  [
                'jumlah_stok' => 2,
                'id_barang' => 6, // Sofa Minimalis
                'created_at' => now(),
                'updated_at' => now(),
            ],  [
                'jumlah_stok' => 2,
                'id_barang' => 7, // Sofa Minimalis
                'created_at' => now(),
                'updated_at' => now(),
            ],  [
                'jumlah_stok' => 2,
                'id_barang' => 8, // Sofa Minimalis
                'created_at' => now(),
                'updated_at' => now(),
            ],  [
                'jumlah_stok' => 2,
                'id_barang' => 9, // Sofa Minimalis
                'created_at' => now(),
                'updated_at' => now(),
            ],  [
                'jumlah_stok' => 2,
                'id_barang' => 10, // Sofa Minimalis
                'created_at' => now(),
                'updated_at' => now(),
            ],  [
                'jumlah_stok' => 2,
                'id_barang' => 11, // Sofa Minimalis
                'created_at' => now(),
                'updated_at' => now(),
            ],  [
                'jumlah_stok' => 2,
                'id_barang' => 12, // Sofa Minimalis
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
