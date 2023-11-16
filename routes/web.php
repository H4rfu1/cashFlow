<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::resource('kategori', KategoriController::class)->middleware('auth');
Route::resource('transaksi', TransaksiController::class)->middleware('auth');
// Rute tambahan untuk permintaan AJAX
Route::get('/get-kategori/{jenis_transaksi}', [App\Http\Controllers\KategoriController::class, 'getKategori'])->name('get-kategori');
