<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PembayaranTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Insert role
        DB::insert("INSERT INTO roles (id_role, nama_role) VALUES (?, ?)", [1, 'Admin']);

        // Insert user dan login otomatis
        $userId = DB::table('users')->insertGetId([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'id_role' => 1,
        ]);
        Auth::loginUsingId($userId);

        // Insert kategori barang
        DB::insert("INSERT INTO kategori_barangs (id_kategori, nama_kategori, deskripsi) VALUES (?, ?, ?)", 
            [1, 'Elektronik', 'Alat listrik']
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    #[Test]
    public function test_pembayaran_sukses()
    {
        $barangId = DB::table('barangs')->insertGetId([
            'nama_barang' => 'Laptop Gaming',
            'link_foto' => 'laptop.jpg',
            'deskripsi' => 'Laptop gaming',
            'harga_sewa' => 50000, // Harga sewa per item
            'status' => 1,
            'id_kategori' => 1,
        ]);

        DB::table('stok_barangs')->insert([
            'id_barang' => $barangId,
            'jumlah_stok' => 10,
        ]);

        $keranjangId = DB::table('keranjangs')->insertGetId([
            'id_user' => Auth::id(),
            'id_barang' => $barangId,
            'jumlah_barang' => 2, // Jumlah barang yang dipesan
        ]);

        // Ambil harga barang dari database agar lebih akurat
        $hargaSewa = DB::table('barangs')->where('id_barang', $barangId)->value('harga_sewa');

        // Hitung total harga berdasarkan jumlah barang
        $totalHarga = $hargaSewa * 2; 

        $payload = [
            'items' => [
                [
                    'id_keranjang' => $keranjangId,
                    'jumlah' => 2,
                    'harga_sewa' => $hargaSewa, // Ambil dari database
                    'tanggal_sewa' => '2025-03-01',
                    'tanggal_kembali' => '2025-03-03',
                    'nama_barang' => 'Laptop Gaming',
                ]
            ],
            'total_pembayaran' => $totalHarga, // Sesuaikan dengan jumlah barang
        ];

        $response = $this->postJson(route('pembayaran.index'), $payload);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat!',
            ]);
    }
}
