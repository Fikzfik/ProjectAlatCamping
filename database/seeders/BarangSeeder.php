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
                'nama_barang' => 'Tenda 2 Orang',
                'link_foto' => 'https://example.com/tenda-2-orang.jpg',
                'deskripsi' => 'Tenda camping untuk 2 orang, ringan dan mudah dipasang.',
                'harga_sewa' => 100000.0,
                'status' => 'tersedia',
                'id_kategori' => 1, // Tenda
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Tenda 4 Orang',
                'link_foto' => 'https://example.com/tenda-4-orang.jpg',
                'deskripsi' => 'Tenda camping untuk 4 orang, cocok untuk camping keluarga.',
                'harga_sewa' => 150000.0,
                'status' => 'tersedia',
                'id_kategori' => 1, // Tenda
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Tenda 6 Orang',
                'link_foto' => 'https://example.com/tenda-6-orang.jpg',
                'deskripsi' => 'Tenda besar untuk 6 orang, cocok untuk grup besar.',
                'harga_sewa' => 200000.0,
                'status' => 'tersedia',
                'id_kategori' => 1, // Tenda
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Carrier 40L',
                'link_foto' => 'https://example.com/carrier-40l.jpg',
                'deskripsi' => 'Carrier 40L, ideal untuk perjalanan ringan.',
                'harga_sewa' => 50000.0,
                'status' => 'tersedia',
                'id_kategori' => 2, // Carrier
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Carrier 60L',
                'link_foto' => 'https://example.com/carrier-60l.jpg',
                'deskripsi' => 'Carrier 60L, cocok untuk perjalanan jarak jauh.',
                'harga_sewa' => 75000.0,
                'status' => 'tersedia',
                'id_kategori' => 2, // Carrier
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Alat Masak Portable',
                'link_foto' => 'https://example.com/alat-masak-portable.jpg',
                'deskripsi' => 'Peralatan masak portable untuk memasak di luar ruangan.',
                'harga_sewa' => 30000.0,
                'status' => 'tersedia',
                'id_kategori' => 3, // Alat Masak
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Lampu Senter LED',
                'link_foto' => 'https://example.com/lampu-senter.jpg',
                'deskripsi' => 'Senter LED dengan cahaya terang untuk penerangan malam.',
                'harga_sewa' => 25000.0,
                'status' => 'tersedia',
                'id_kategori' => 4, // Penerangan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Lampu Camping Solar',
                'link_foto' => 'https://example.com/lampu-camping-solar.jpg',
                'deskripsi' => 'Lampu camping yang dapat diisi ulang menggunakan energi solar.',
                'harga_sewa' => 35000.0,
                'status' => 'tersedia',
                'id_kategori' => 4, // Penerangan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Pelindung Hujan Tas',
                'link_foto' => 'https://example.com/pelindung-hujan-tas.jpg',
                'deskripsi' => 'Pelindung hujan untuk carrier atau tas backpack.',
                'harga_sewa' => 15000.0,
                'status' => 'tersedia',
                'id_kategori' => 5, // Perlengkapan Pribadi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Peta Survival',
                'link_foto' => 'https://example.com/peta-survival.jpg',
                'deskripsi' => 'Peta survival untuk navigasi di alam terbuka.',
                'harga_sewa' => 20000.0,
                'status' => 'tersedia',
                'id_kategori' => 6, // Survival
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Kotak Pertolongan Pertama',
                'link_foto' => 'https://example.com/kotak-pertolongan-pertama.jpg',
                'deskripsi' => 'Kotak pertolongan pertama untuk keadaan darurat.',
                'harga_sewa' => 30000.0,
                'status' => 'tersedia',
                'id_kategori' => 6, // Survival
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Perlengkapan Tambahan Camping',
                'link_foto' => 'https://example.com/perlengkapan-tambahan.jpg',
                'deskripsi' => 'Barang-barang tambahan yang berguna dalam perjalanan camping.',
                'harga_sewa' => 20000.0,
                'status' => 'tersedia',
                'id_kategori' => 7, // Perlengkapan Tambahan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Sleeping Bag Anak',
                'link_foto' => 'https://example.com/sleeping-bag-anak.jpg',
                'deskripsi' => 'Sleeping bag khusus untuk anak-anak yang nyaman dan aman.',
                'harga_sewa' => 40000.0,
                'status' => 'tersedia',
                'id_kategori' => 8, // Kids Series
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Tenda Anak',
                'link_foto' => 'https://example.com/tenda-anak.jpg',
                'deskripsi' => 'Tenda khusus untuk anak-anak dengan desain menyenangkan.',
                'harga_sewa' => 80000.0,
                'status' => 'tersedia',
                'id_kategori' => 8, // Kids Series
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
