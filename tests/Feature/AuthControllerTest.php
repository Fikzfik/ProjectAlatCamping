<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
{
    parent::setUp();

    // Tambahkan data roles ke tabel
    DB::table('roles')->insert([
        ['id_role' => 1, 'nama_role' => 'admin'],
        ['id_role' => 2, 'nama_role' => 'user'],
    ]);
}

    /** @test */
    public function testRegisterSuccessfully()
    {
        // Data untuk pendaftaran
        $data = [
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Kirim request POST ke endpoint register
        $response = $this->post('/register', $data);

        // Periksa apakah redirect ke halaman home
        $response->assertRedirect('/home');

        // Periksa apakah user berhasil disimpan di database
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
        ]);
    }

    /** @test */
    public function testRegisterFailsWhenEmailAlreadyExists()
    {
        // Buat user sebelumnya
        User::factory()->create(['email' => 'existinguser@example.com']);

        // Data untuk pendaftaran
        $data = [
            'email' => 'existinguser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Kirim request POST ke endpoint register
        $response = $this->post('/register', $data);

        // Periksa apakah ada error validasi
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function testLoginSuccessfully()
    {
        // Buat user terlebih dahulu
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password'),
        ]);

        // Data untuk login
        $data = [
            'email' => 'testuser@example.com',
            'password' => 'password',
        ];

        // Kirim request POST ke endpoint login
        $response = $this->post('/login', $data);

        // Periksa apakah redirect ke halaman home
        $response->assertRedirect('/home');

        // Periksa apakah user login
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function testLoginFailsWithWrongPassword()
    {
        // Buat user terlebih dahulu
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password'),
        ]);

        // Data untuk login
        $data = [
            'email' => 'testuser@example.com',
            'password' => 'paassword',
        ];

        // Kirim request POST ke endpoint login
        $response = $this->post('/login', $data);


        // Periksa apakah ada error
        $response->assertSessionHas('error', 'Password salah.');
    }

    /** @test */
    public function testLogoutSuccessfully()
    {
        // Buat dan login user terlebih dahulu
        $user = User::factory()->create();
        $this->actingAs($user);

        // Kirim request POST ke endpoint logout
        $response = $this->post('/logout');

        // Periksa apakah redirect ke halaman login
        $response->assertRedirect('/login');

        // Periksa apakah user berhasil logout
        $this->assertGuest();
    }
}