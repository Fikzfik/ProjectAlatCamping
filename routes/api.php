<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembayaranController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/webhook', [PembayaranController::class, 'webhook'])->name('webhook');
Route::get('/finish', [PembayaranController::class, 'finish'])->name('finish');
Route::get('/notfinish', [PembayaranController::class, 'notfinish'])->name('notfinish');