<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\DB;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Insert role
        DB::insert("INSERT INTO roles (id_role, nama_role) VALUES (?, ?)", [1, 'Admin']);

        // Insert user ke database
        $userId = DB::table('users')->insertGetId([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'id_role' => 1,
        ]);

        $this->user = User::find($userId);
        Auth::login($this->user);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
    #[Test]
    public function it_can_display_the_blog_list()
    {
        DB::table('blogs')->insert([
            'judul' => 'Judul Blog 1',
            'konten' => 'Isi blog pertama.',
            'tanggal' => now(),
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->user)->get(route('addblog'));

        $response->assertStatus(200);
        $response->assertSee('Judul Blog 1');
    }
    #[Test]
    public function it_can_store_a_new_blog()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('blog.jpg');

        $response = $this->actingAs($this->user)->post(route('blog.store'), [
            'judul' => 'Blog Baru',
            'konten' => 'Ini konten blog baru.',
            'tanggal' => now()->toDateString(),
            'foto' => $file,
        ]);

        $response->assertRedirect(route('addblog'));
        $this->assertDatabaseHas('blogs', ['judul' => 'Blog Baru']);

        // Menggunakan Storage::exists()
        $this->assertTrue(Storage::disk('public')->exists('uploads/blogs/' . $file->hashName()));
    }
    #[Test]
    public function it_can_update_a_blog()
    {
        $blogId = DB::table('blogs')->insertGetId([
            'judul' => 'Blog Lama',
            'konten' => 'Isi blog lama.',
            'tanggal' => now(),
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->user)->put(route('blog.update', $blogId), [
            'judul' => 'Blog Baru',
            'konten' => 'Konten diperbarui.',
            'tanggal' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('addblog')); // Perbaikan redirect
        $this->assertDatabaseHas('blogs', ['judul' => 'Blog Baru']);
    }
    #[Test]
    public function it_can_delete_a_blog()
    {
        $blogId = DB::table('blogs')->insertGetId([
            'judul' => 'Blog Hapus',
            'konten' => 'Konten blog untuk dihapus.',
            'tanggal' => now(),
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->user)->delete(route('blog.destroy', $blogId));

        $response->assertRedirect(route('addblog')); // Perbaikan redirect
        $this->assertDatabaseMissing('blogs', ['id' => $blogId]);
    }
}
