<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->insert([
            ['id_user' => 1, 'name' => 'Test User', 'email' => 'testuser@gmail.com', 'password' => bcrypt('password123'), 'id_role' => 2],
            ['id_user' => 2, 'name' => 'Admin User', 'email' => 'admin@gmail.com', 'password' => bcrypt('password123'), 'id_role' => 1],
        ]);
        
        DB::table('barangs')->insert([
            ['id_barang' => 1, 'nama_barang' => 'Laptop Gaming', 'harga_sewa' => 50000, 'link_foto' => 'laptop.jpg', 'deskripsi' => 'Laptop untuk gaming', 'id_kategori' => 1],
            ['id_barang' => 2, 'nama_barang' => 'Keyboard Mechanical', 'harga_sewa' => 10000, 'link_foto' => 'keyboard.jpg', 'deskripsi' => 'Keyboard mekanikal premium', 'id_kategori' => 2],
        ]);
        
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
    public function test_user_can_add_item_to_cart()
    {
        $this->loginAs('testuser@gmail.com');

        $response = $this->postJson('/keranjang/store', [
            'id_barang' => 1,
            'jumlah_barang' => 2,
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => true,
            'message' => 'Barang berhasil ditambahkan ke keranjang!',
        ]);
    }
    #[Test]
    public function test_user_can_view_cart()
    {
        $this->loginAs('testuser@gmail.com');
        
        DB::table('keranjangs')->insert([
            ['id_keranjang' => 1, 'id_user' => 1, 'id_barang' => 1, 'jumlah_barang' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $response = $this->getJson('/keranjang');

        $response->assertStatus(200)->assertJsonStructure([
            '*' => ['id_keranjang', 'jumlah_barang', 'nama_barang', 'harga_sewa', 'link_foto', 'deskripsi']
        ]);
    }
    #[Test]
    public function test_user_can_increase_quantity()
    {
        $this->loginAs('testuser@gmail.com');

        DB::table('keranjangs')->insert([
            ['id_keranjang' => 1, 'id_user' => 1, 'id_barang' => 1, 'jumlah_barang' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $response = $this->postJson('/keranjang/increase', [
            'id_keranjang' => 1,
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => true,
            'message' => 'Jumlah barang berhasil ditambah!'
        ]);
    }
    #[Test]
    public function test_user_can_decrease_quantity()
    {
        $this->loginAs('testuser@gmail.com');

        DB::table('keranjangs')->insert([
            ['id_keranjang' => 1, 'id_user' => 1, 'id_barang' => 1, 'jumlah_barang' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $response = $this->postJson('/keranjang/decrease', [
            'id_keranjang' => 1,
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => true,
            'message' => 'Jumlah barang berhasil dikurangi!'
        ]);
    }
}
