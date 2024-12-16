<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [ViewController::class, 'loginview'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'registerview'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    
    Route::get('/dashboard', [ViewController::class, 'dashboard'])->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/stock', [ViewController::class, 'stockview'])->name('stock');
    Route::get('/sempak', [ViewController::class, 'sempak'])->name('sempak');



    // Barang
    Route::get('/barang', [ViewController::class, 'barangview'])->name('barang');
    Route::post('barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::get('barang/{id}', [BarangController::class, 'updateModal'])->name('barang.showmodal');
    Route::delete('barang/destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/barang-by-kategori', [BarangController::class, 'getBarangByKategori'])->name('barang.by.kategori');

    Route::get('/kategoris', [BarangController::class, 'index'])->name('kategori.index');

    Route::get('/detailbarang/{id}', [BarangController::class, 'show'])->name('detailbarang');

    // Kategori
    Route::get('/kategori', [ViewController::class, 'kategoriview'])->name('kategori');
    Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    // Route::post('kategori/update/{id}', [KategoriController::class, 'updates'])->name('kategori.update');
    Route::get('kategori/{id}', [KategoriController::class, 'updateModal'])->name('kategori.showmodal');
    Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');

    // Keranjang
    Route::post('/keranjang/store', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::get('/keranjang', [KeranjangController::class, 'keranjangview'])->name('keranjang.view');
    Route::post('/keranjang/increase', [KeranjangController::class, 'increaseQuantity'])->name('keranjang.increase');
    Route::post('/keranjang/decrease', [KeranjangController::class, 'decreaseQuantity'])->name('keranjang.decrease');

    // Pembayaran
    Route::post('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

    // History
    Route::get('/history', [HistoryController::class, 'history'])->name('history');

    // Penyewaan
    Route::get('/penyewaan', [ViewController::class, 'penyewaan'])->name('penyewaan');
    Route::post('/penyewaan/store', [PenyewaanController::class, 'store'])->name('penyewaan.store');
    Route::get('/menu', [ViewController::class, 'menuview'])->name('menu');
    Route::get('/settingmenu', [ViewController::class, 'settingmenuview'])->name('settingmenu');
    Route::get('/blog', [ViewController::class, 'blogview'])->name('blog');
    Route::get('/home', [ViewController::class, 'homeview'])->name('home');
    Route::get('/location', [ViewController::class, 'locationview'])->name('location');
    Route::get('/userprofil', [ViewController::class, 'userprofil'])->name('userprofil');
    Route::put('/editprofil', [ViewController::class, 'editprofil'])->name('editprofil');
    Route::get('/test', [ViewController::class, 'test'])->name('test');
