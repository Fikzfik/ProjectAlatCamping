<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected $adminEmail = 'admin@gmail.com';

    protected function setUp(): void
    {
        parent::setUp();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->insert([
            ['id_user' => 1, 'name' => 'Admin User', 'email' => $this->adminEmail, 'password' => bcrypt('password123'), 'id_role' => 1]
        ]);

        DB::table('kategori_barangs')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'Elektronik', 'deskripsi' => 'Alat listrik']
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }


    private function loginAsAdmin()
    {
        $this->actingAs(User::where('email', $this->adminEmail)->first());
    }
    #[Test]
    private function createKategori($nama = 'Elektronik', $deskripsi = 'Kategori barang elektronik')
    {
        DB::beginTransaction(); // Pastikan transaksi berjalan
        $id = DB::table('kategori_barangs')->insertGetId([
            'nama_kategori' => $nama,
            'deskripsi' => $deskripsi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::commit(); // Commit agar data tersedia
        return $id;
    }

    #[Test]
    public function test_store_kategori()
    {
        $this->loginAsAdmin();

        // Data yang akan dikirim
        $data = [
            'nama_kategori' => 'Laptop',
            'deskripsi' => 'Kategori laptop',
        ];

        // Kirim request untuk menyimpan kategori
        $response = $this->postJson('/kategori/store', $data);

        // Pastikan response memiliki status 200 (karena kamu tidak mengatur status 201 dalam controller)
        $response->assertStatus(200)->assertJson(['message' => 'Kategori berhasil ditambahkan!']);

        // Pastikan data benar-benar ada di database
        $this->assertDatabaseHas('kategori_barangs', $data);
    }
    #[Test]

    public function test_update_kategori()
    {
        $id = $this->createKategori('Gadget', 'Kategori gadget');
        $this->loginAsAdmin();

        // Kirim permintaan untuk mengupdate kategori
        $response = $this->putJson("/kategori/$id", [
            'nama_kategori' => 'Smartphone',
            'deskripsi' => 'Kategori smartphone',
        ]);

        // Debugging untuk melihat respons API sebelum assertion

        // Pastikan respons sesuai harapan
        $response->assertStatus(200)->assertJson(['message' => 'Kategori berhasil diperbarui!']);

        // Debugging untuk melihat apakah data sudah terupdate di database

        // Pastikan data di database sudah diperbarui
        $this->assertDatabaseHas('kategori_barangs', ['nama_kategori' => 'Smartphone']);
    }
    #[Test]
    public function test_destroy_kategori()
    {
        $id = $this->createKategori('Audio', 'Kategori audio');
        $this->loginAsAdmin();


        // Kirim permintaan untuk menghapus kategori
        $response = $this->deleteJson("/kategori/$id");

        // Debugging untuk melihat respons API sebelum assertion

        // Pastikan respons sesuai harapan
        $response->assertStatus(200)->assertJson(['message' => 'Kategori berhasil dihapus!']);

        // Debugging setelah penghapusan

        // Pastikan data benar-benar hilang dari database
        $this->assertDatabaseMissing('kategori_barangs', ['id_kategori' => $id]);

    }
    
}
