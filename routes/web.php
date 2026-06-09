<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatController;

// Halaman Utama / Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Kelompok Rute untuk Tamu (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Kelompok Rute yang Wajib Login (Auth)
Route::middleware(['auth'])->group(function () {
    
    // PANEL UTAMA ADMIN (Dilindungi Middleware Role & Prefix URL)
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard');
        Route::resource('alat', AlatController::class);
    });

    // PANEL UTAMA CUSTOMER
    Route::middleware(['role:customer'])->group(function () {
        Route::get('/katalog', [AlatController::class, 'katalogUser'])->name('customer.katalog');
    });

    // Fitur Keluar / Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::middleware(['auth'])->group(function () {
    
    // PROTEKSI UTAMA ADMIN PANEL
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard');
        Route::resource('alat', AlatController::class);
        
        // Tambahan Rute CRUD Otomatis Kategori
        Route::resource('kategori', KategoriController::class);
    });
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
     });