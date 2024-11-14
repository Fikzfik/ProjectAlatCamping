<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('pages.login');
});
Route::get('/register', function () {
    return view('pages.register');
});
Route::get('/dashboard', function () {
    return view('pages.auth.dashboard');
});
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
