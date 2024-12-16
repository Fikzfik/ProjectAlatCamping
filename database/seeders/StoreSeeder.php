<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $faker = Faker::create();

        // Membuat 10 data store dummy
        foreach (range(1, 9) as $index) {
            DB::table('stores')->insert([
                'name' => $faker->company, // Nama perusahaan sebagai nama store
                'address' => $faker->address, // Alamat random
                'phone_number' => $faker->phoneNumber, // Nomor telepon random
                'email' => $faker->email, // Email random
                'latitude' => $faker->latitude, // Latitude random
                'longitude' => $faker->longitude, // Longitude random
                'image_url' => $faker->imageUrl(640, 480, 'business'), // URL gambar random
                'is_active' => $faker->boolean(80), // Status aktif (80% kemungkinan aktif)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}