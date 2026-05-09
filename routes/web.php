<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Data Siswa (Students)
    Route::resource('siswa', SiswaController::class);

    // Nilai (Grades)
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/{siswa}/edit', [NilaiController::class, 'edit'])->name('nilai.edit');
    Route::put('/nilai/{siswa}', [NilaiController::class, 'update'])->name('nilai.update');

    // Data Lembaga (Institution)
    Route::get('/lembaga', [LembagaController::class, 'index'])->name('lembaga.index');
    Route::post('/lembaga', [LembagaController::class, 'store'])->name('lembaga.store');

    // Cetak (Print)
    Route::get('/cetak', [CetakController::class, 'index'])->name('cetak.index');
    Route::get('/cetak/buku-induk/{siswa}', [CetakController::class, 'bukuInduk'])->name('cetak.buku-induk');
});
