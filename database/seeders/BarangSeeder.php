<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barangs')->insert([
            [
                'nama_barang' => 'Laptop Gaming',
                'link_foto' => 'https://example.com/laptop-gaming.jpg',
                'deskripsi' => 'Laptop high-end untuk kebutuhan gaming.',
                'harga_sewa' => 150000.00,
                'status' => 'tersedia',
                'id_kategori' => 1, // Elektronik
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Kamera DSLR',
                'link_foto' => 'https://example.com/kamera-dslr.jpg',
                'deskripsi' => 'Kamera DSLR untuk fotografi profesional.',
                'harga_sewa' => 100000.00,
                'status' => 'tersedia',
                'id_kategori' => 1, // Elektronik
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Sofa Minimalis',
                'link_foto' => 'https://example.com/sofa-minimalis.jpg',
                'deskripsi' => 'Sofa minimalis modern untuk ruang tamu.',
                'harga_sewa' => 75000.00,
                'status' => 'tidak tersedia',
                'id_kategori' => 2, // Furnitur
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
