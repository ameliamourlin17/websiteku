<?php

use App\Http\Controllers\PemantauanController;
use Illuminate\Support\Facades\Route;

// Halaman utama = formulir kosong
Route::redirect('/', '/pemantauan/create');
Route::redirect('/pemantauan', '/pemantauan/create');

// Daftar formulir yang sudah tersimpan
Route::get('/riwayat', [PemantauanController::class, 'index'])->name('pemantauan.index');

Route::resource('pemantauan', PemantauanController::class)->except('index');
