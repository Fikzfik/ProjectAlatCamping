<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectImageSyncSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Define Premium Data Mapping
        $premiumItems = [
            [
                'nama' => 'Tenda Eiger Guardian 4P',
                'foto' => 'barang_foto/tent.png',
                'desc' => 'Tenda premium berkapasitas 4 orang dengan perlindungan cuaca maksimal.',
                'harga' => 125000,
                'kategori' => 1
            ],
            [
                'nama' => 'Osprey Aether 60L',
                'foto' => 'barang_foto/carrier.png',
                'desc' => 'Carrier ergonomis untuk pendakian jarak jauh dengan ventilasi udara terbaik.',
                'harga' => 85000,
                'kategori' => 2
            ],
            [
                'nama' => 'Jetboil Flash Stove',
                'foto' => 'barang_foto/stove.png',
                'desc' => 'Alat masak portable super cepat, mampu mendidihkan air dalam 100 detik.',
                'harga' => 45000,
                'kategori' => 3
            ],
            [
                'nama' => 'Mammut Alpine Bag',
                'foto' => 'barang_foto/sleeping_bag.png',
                'desc' => 'Sleeping bag ultra-warm untuk suhu ekstrem hingga -10 derajat.',
                'harga' => 60000,
                'kategori' => 4
            ],
            [
                'nama' => 'Black Diamond Lantern',
                'foto' => 'barang_foto/lamp.png',
                'desc' => 'Lampu tenda LED dengan tingkat kecerahan tinggi dan daya tahan baterai lama.',
                'harga' => 25000,
                'kategori' => 5
            ],
            [
                'nama' => 'Helinox Chair One',
                'foto' => 'barang_foto/chair.png',
                'desc' => 'Kursi camping ultra-lightweight yang sangat kuat dan nyaman untuk bersantai.',
                'harga' => 35000,
                'kategori' => 6
            ],
        ];

        // 2. Logic to Sync or Insert
        foreach ($premiumItems as $item) {
            // Check if item already exists by name
            $exists = DB::table('barangs')->where('nama_barang', 'like', '%' . explode(' ', $item['nama'])[0] . '%')->first();

            if ($exists) {
                // Update existing item to look premium
                DB::table('barangs')->where('id_barang', $exists->id_barang)->update([
                    'nama_barang' => $item['nama'],
                    'link_foto' => $item['foto'],
                    'deskripsi' => $item['desc'],
                    'harga_sewa' => $item['harga'],
                    'updated_at' => now(),
                ]);
            } else {
                // Insert as new premium item
                DB::table('barangs')->insert([
                    'nama_barang' => $item['nama'],
                    'link_foto' => $item['foto'],
                    'deskripsi' => $item['desc'],
                    'harga_sewa' => $item['harga'],
                    'status' => 'tersedia',
                    'id_kategori' => $item['kategori'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        echo "Premium Image Sync Completed Successfully!\n";
    }
}
