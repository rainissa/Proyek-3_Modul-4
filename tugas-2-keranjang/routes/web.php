<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BarangController::class, 'index']);
Route::get('/index', [BarangController::class, 'index'])->name('barang.index');

Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/kurang/{id}', [KeranjangController::class, 'kurang'])->name('keranjang.kurang');
Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
Route::post('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])->name('keranjang.kosongkan');