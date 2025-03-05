<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::statement("INSERT INTO users (id_user, name, email, password, id_role) VALUES 
        (1, 'Test User', 'testuser@gmail.com', '" . bcrypt('password123') . "', 2),
        (2, 'Admin User', 'admin@gmail.com', '" . bcrypt('qwe123') . "', 1)");
    }

    private function loginAs($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->fail("User dengan email $email tidak ditemukan di database.");
        }

        $this->actingAs($user);
    }
    #[Test]
    public function test_user_can_register()
    {
        $userData = [
            'email' => 'testuser2@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $userData);

        // Cek apakah user berhasil terdaftar di database
        $this->assertDatabaseHas('users', [
            'email' => 'testuser2@example.com',
        ]);

        // Cek apakah user diarahkan ke halaman yang benar setelah register
        $response->assertRedirect('/home');
    }
    #[Test]
    public function test_login_user()
    {
        $this->loginAs('admin@gmail.com');

        // **Pastikan user sudah terautentikasi**
        $this->assertAuthenticated();
    }
    #[Test]
    public function test_user_can_logout()
    {
        // **Login sebagai admin**
        $this->loginAs('admin@gmail.com');

        // **Pastikan user sudah terautentikasi**
        $this->assertAuthenticated();

        // **Kirim request POST ke endpoint logout**
        $response = $this->post('/logout');

        // **Pastikan user menjadi guest (logout berhasil)**
        $this->assertGuest();

        // **Pastikan diarahkan ke halaman login**
        $response->assertRedirect('/login');
    }
    #[Test]
    public function test_user_can_update_profile_after_login()
    {
        // Login sebagai admin
        $this->loginAs('admin@gmail.com');

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
