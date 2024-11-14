<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Password dienkripsi
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'id_role' => 1, // Pastikan id_role ini ada di tabel 'roles'
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'id_role' => 2, // Pastikan id_role ini ada di tabel 'roles'
            ],
        ]);
    }
}
