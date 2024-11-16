<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_barangs')->insert([
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi' => 'Barang-barang elektronik seperti kamera, laptop, dll.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Furnitur',
                'deskripsi' => 'Berbagai macam furnitur rumah tangga.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Kendaraan',
                'deskripsi' => 'Sepeda, sepeda motor, dan kendaraan lainnya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
