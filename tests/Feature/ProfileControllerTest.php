<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase; // Reset database sebelum setiap test dijalankan

    protected function setUp(): void
    {
        parent::setUp();

        // Jalankan seeder agar data default tersedia setelah refresh database
        $this->seed(DatabaseSeeder::class);
    }

    public function test_user_can_update_profile_after_login(): void 
    {
        // Buat user menggunakan factory
        $user = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('qwe123'),
            'id_role' => 1, // Pastikan ini sesuai dengan seeder
        ]);

        // Login dengan akun yang sudah ada
        $loginData = [
            'email' => 'admin@gmail.com',
            'password' => 'qwe123',
        ];

        // Kirim request POST ke endpoint login
        $response = $this->post(route('login.post'), $loginData);

        // Pastikan user diarahkan ke halaman home setelah login
        $response->assertRedirect(route('home'));

        // Pastikan user sudah terautentikasi
        $this->assertAuthenticated();

        // Data untuk update profil
        $updateData = [
            'name' => 'New Admin Name',
            'email' => 'newadmin@gmail.com',
        ];

        // Kirim request PUT ke endpoint update profil
        $response = $this->put(route('profile.update'), $updateData);

        // Pastikan redirect setelah update profil
        $response->assertRedirect(route('userprofil'));

        // Pastikan data di database sudah diperbarui
        $this->assertDatabaseHas('users', [
            'email' => 'newadmin@gmail.com',
            'name' => 'New Admin Name',
        ]);
    }
}
