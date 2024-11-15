<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
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
    Route::get('/blog', [ViewController::class, 'blogview'])->name('blog');
    Route::get('/home', function () {
        return view('pages.auth.home');
    });
    Route::get('/location', function () {
        return view('pages.auth.location');
    });
    Route::get('/blog', function () {
        return view('pages.auth.blog');
    });
    Route::get('/detail/barang', function () {
        return view('pages.auth.blog');
    });
});
Route::get('/detail', function () {
    return view('pages.auth.blog');
});
