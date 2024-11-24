<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [ViewController::class, 'loginview'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [ViewController::class, 'registerview'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/register', function () {
        return view('pages.register');
    });
    Route::get('/dashboard', function () {
        return view('pages.auth.dashboard');
    });
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/stock', [ViewController::class, 'stockview'])->name('stock');

    Route::get('/barang', [ViewController::class, 'barangview'])->name('barang');
    Route::post('barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::get('barang/{id}', [BarangController::class, 'updateModal'])->name('barang.showmodal');
    Route::delete('barang/destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/detailbarang/{id}', [BarangController::class, 'show'])->name('detailbarang');

    Route::get('/kategori', [ViewController::class, 'kategoriview'])->name('kategori');
    Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::post('kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('kategori/{id}', [KategoriController::class, 'updateModal'])->name('kategori.showmodal');
    Route::delete('kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::post('/keranjang/store', [KeranjangController::class, 'store'])->name('keranjang.store');

    Route::get('/menu', [ViewController::class, 'menuview'])->name('menu');
    Route::get('/settingmenu', [ViewController::class, 'settingmenuview'])->name('settingmenu');
    Route::get('/blog', [ViewController::class, 'blogview'])->name('blog');
    Route::get('/home', [ViewController::class, 'homeview'])->name('home');
    Route::get('/location', [ViewController::class, 'locationview'])->name('location');
});
