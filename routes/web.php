<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create');
Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
Route::get('/aspirasi/thankyou', [AspirasiController::class, 'selesai'])->name('aspirasi.selesai');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/admin/dashboard', [AspirasiController::class, 'adminIndex'])->name('admin.dashboard');
Route::get('/admin/aspirasi/{id}/edit', [AspirasiController::class, 'edit'])->name('admin.aspirasi.edit');
Route::post('/admin/aspirasi/{id}', [AspirasiController::class, 'update'])->name('admin.aspirasi.update');

Route::get('/admin/kategoris', [KategoriController::class, 'index'])->name('admin.kategoris.index');
Route::post('/admin/kategoris', [KategoriController::class, 'store'])->name('admin.kategoris.store');

Route::get('/siswa/history', [AspirasiController::class, 'siswaHistory'])->name('siswa.history');
