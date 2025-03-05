<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class BarangTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::statement("INSERT INTO users (id_user, name, email, password, id_role) VALUES 
        (1, 'Test User', 'testuser@gmail.com', '" . bcrypt('password123') . "', 2),
        (2, 'Admin User', 'admin@gmail.com', '" . bcrypt('password123') . "', 1)");

        DB::statement("INSERT INTO kategori_barangs (id_kategori, nama_kategori, deskripsi) VALUES 
            (1, 'Elektronik','Alat listrik')");

        DB::statement("INSERT INTO barangs (id_barang, nama_barang, link_foto, deskripsi, harga_sewa, status, id_kategori) VALUES 
            (1, 'Laptop', 'laptop.jpg', 'Laptop gaming', 50000, 1, 1)");

        DB::statement("INSERT INTO stok_barangs (id_barang, jumlah_stok, created_at, updated_at) VALUES 
            (1, 10, NOW(), NOW())");

        DB::statement("INSERT INTO keranjangs (id_keranjang, id_user, id_barang, jumlah_barang) VALUES 
            (1, 1, 1, 2)");

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
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
    public function it_can_update_stock()
    {
        $this->loginAs('admin@gmail.com');

        $token = 'test_token'; // Simulasi token

        $response = $this->json('PUT', '/barang/1/update-stock/', ['new_stock' => 20], ['Authorization' => 'Bearer ' . $token]);

        // Assert response
        $response->assertStatus(200);
        $this->assertDatabaseHas('stok_barangs', ['id_barang' => 1, 'jumlah_stok' => 20]);
    }
    #[Test]
    public function it_can_filter_by_price()
    {
        $this->loginAs('admin@gmail.com');

        // Call API
        $response = $this->json('GET', '/barang/filter/harga?min_price=20000&max_price=60000');

        // Assert response
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }
    #[Test]
    public function test_store_barang()
    {
        $this->loginAs('admin@gmail.com');
        $file = UploadedFile::fake()->image('barang.jpg');

        $data = [
            'nama_barang' => 'Laptop Gaming',
            'id_kategori' => 1,
            'harga_sewa' => 500000,
            'status' => 'tersedia',
            'deskripsi' => 'Laptop gaming dengan spesifikasi tinggi',
            'link_foto' => $file,
        ];

        $response = $this->postJson(route('barang.store'), $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Barang berhasil ditambahkan dengan stok default 0!']);
    }

    #[Test]

    public function test_get_barang_by_kategori()
    {
        $this->loginAs('admin@gmail.com');
        $kategori = DB::table('kategori_barangs')->insertGetId([
            'nama_kategori' => 'Elektronik',
            'deskripsi' => 'Kategori elektronik',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('barangs')->insert([
            'nama_barang' => 'Smartphone',
            'id_kategori' => $kategori,
            'harga_sewa' => 200000,
            'status' => 'tersedia',
            'deskripsi' => 'Smartphone terbaru',
            'link_foto' => 'path/to/image.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->getJson('/barang-by-kategori?kategori_id=' . $kategori);
        $response->assertStatus(200);
    }

    #[Test]

    public function test_filter_by_stock()
    {
        $this->loginAs('admin@gmail.com');
        $response = $this->getJson('/barang/filter-by-stock');
        $response->assertStatus(200);
    }
    #[Test]
    public function test_filter_out_of_stock()
    {
        $this->loginAs('admin@gmail.com');
        $response = $this->getJson('/barang/filter-out-of-stock');
        $response->assertStatus(200);
    }
}
