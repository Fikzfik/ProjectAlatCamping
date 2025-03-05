<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
class ViewTest extends TestCase
{
    use RefreshDatabase;

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
   
    public function it_displays_home_page_correctly()
    {
        $this->loginAs('admin@gmail.com');

        $response = $this->get('/home');
        $response->assertStatus(200);
        $response->assertViewIs('pages.auth.home');
    }

    #[Test]
    public function it_displays_location_page_correctly()
    {
        $this->loginAs('admin@gmail.com');

        $response = $this->get('/location');
        $response->assertStatus(200);
        $response->assertViewIs('pages.auth.location');
    }
    #[Test]
    public function it_displays_penyewaan_page_for_logged_in_user()
    {
        $this->loginAs('admin@gmail.com');

        $response = $this->get('/penyewaan');
        $response->assertStatus(200);
        $response->assertViewIs('pages.auth.penyewaan');
    }
    #[Test]
    public function it_displays_user_profile_page()
    {
        $this->loginAs('admin@gmail.com');

        $response = $this->get('/userprofil');
        $response->assertStatus(200);
        $response->assertViewIs('pages.auth.userprofil');
    }
    #[Test]
    public function it_displays_blog_page()
    {
        $this->loginAs('admin@gmail.com');

        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertViewIs('pages.auth.blog');
    }
    #[Test]
    public function it_displays_return_page_correctly()
    {
        $this->loginAs('admin@gmail.com');

        $response = $this->get('/return');
        
        $response->assertStatus(200);
        $response->assertViewIs('pages.auth.return');
        $response->
        assertViewHas('groupedPenyewaan');
    }
    #[Test]
    public function it_displays_stock_page_correctly()
    {
        $this->loginAs('admin@gmail.com');

        $response = $this->get('/stock');
        
        $response->assertStatus(200);
        $response->assertViewIs('pages.auth.stock');
        $response->assertViewHas(['barang', 'categories']);
    }
}
