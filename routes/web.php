<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\BarangController;
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
    Route::post('barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::get('barang/{id}', [BarangController::class, 'updateModal'])->name('barang.showmodal');
    Route::delete('barang/destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/kategori', [ViewController::class, 'kategoriview'])->name('kategori');
    Route::post('/kategori', [ViewController::class, 'kategorstore'])->name('kategori.store');
    Route::get('/menu', [ViewController::class, 'menuview'])->name('menu');
    Route::get('/settingmenu', [ViewController::class, 'settingmenuview'])->name('settingmenu');
    Route::get('/blog', [ViewController::class, 'blogview'])->name('blog');
    Route::get('/home', [ViewController::class, 'homeview'])->name('home');
    Route::get('/location', [ViewController::class, 'locationview'])->name('location');
});
