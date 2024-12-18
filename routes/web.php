<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
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

    Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('storeFeedback');

    Route::get('/return', [ViewController::class, 'return'])->name('return');
    Route::post('/penyewaan/return', [HistoryController::class, 'store'])->name('submit.return');
    // Barang
    Route::get('/barang', [ViewController::class, 'barangview'])->name('barang');
    Route::post('barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('barang/destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('barang/{id}', [BarangController::class, 'updateModal'])->name('barang.showmodal');
    Route::get('/barang-by-kategori', [BarangController::class, 'getBarangByKategori'])->name('barang.by.kategori');
    Route::get('/barang/filter/harga', [BarangController::class, 'filterByPrice'])->name('barang.by.price');
    Route::put('/barang/{id}/update-stock', [BarangController::class, 'updateStock']);
    Route::post('/pengembalian', [HistoryController::class, 'store']);
    Route::get('/barang/filter-by-stock', [BarangController::class, 'filterByStock'])->name('barang.filter.stock');
    Route::get('/barang/filter-out-of-stock', [BarangController::class, 'filterOutOfStock'])->name('barang.filter.outOfStock');

    Route::get('/kategoris', [BarangController::class, 'index'])->name('kategori.index');

    Route::get('/detailbarang/{id}', [BarangController::class, 'show'])->name('detailbarang');

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'kategoriview'])->name('kategori');
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

    // Blog
    Route::get('/addblog', [BlogController::class, 'addblogview'])->name('addblog');
    Route::post('addblog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::put('/add/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('addblog/{id}', [BlogController::class, 'updateModal'])->name('blog.showmodal');
    Route::delete('addblog/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::put('/editprofil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/test', [ViewController::class, 'test'])->name('test');
});
