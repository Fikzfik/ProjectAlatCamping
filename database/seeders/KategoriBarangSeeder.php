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
                'nama_kategori' => 'Tenda',
                'deskripsi' => 'Berbagai jenis tenda untuk kebutuhan camping.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Carrier',
                'deskripsi' => 'Berbagai jenis carrier untuk mendukung perjalanan camping.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Alat Masak',
                'deskripsi' => 'Peralatan untuk memasak di alam terbuka.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi' => 'Barang-barang elektronik untuk mendukung aktivitas outdoor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Penerangan',
                'deskripsi' => 'Alat penerangan untuk camping seperti lampu dan senter.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Perlengkapan Pribadi',
                'deskripsi' => 'Barang-barang pribadi yang dibutuhkan dalam perjalanan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Survival',
                'deskripsi' => 'Perlengkapan untuk bertahan hidup di alam bebas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Perlengkapan Tambahan',
                'deskripsi' => 'Barang-barang tambahan yang mendukung aktivitas camping.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Kids Series',
                'deskripsi' => 'Barang-barang camping yang cocok untuk anak-anak.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
