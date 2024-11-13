<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.login');
});

Route::get('/dashboard', function () {
    return view('pages.auth.dashboard');
});
Route::get('/home', function () {
    return view('pages.auth.home');
});