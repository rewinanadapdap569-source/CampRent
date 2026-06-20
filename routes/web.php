<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Gunakan alias agar tidak bentrok
use App\Http\Controllers\DashboardController as AdminDashboard;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\RentalController;

// Halaman Utama
Route::get('/', function () { return view('welcome'); })->name('welcome');

// Kelompok Rute Tamu
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Kelompok Rute yang Wajib Login
Route::middleware(['auth'])->group(function () {
    
    // Admin Panel
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('pages.dashboard');
        Route::resource('alat', AlatController::class);
        Route::resource('kategori', KategoriController::class);
    });

    // Customer Panel
    Route::middleware(['role:customer'])->prefix('customer')->group(function () {
        Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('customer.dashboard');
        Route::get('/katalog', [AlatController::class, 'katalogUser'])->name('customer.katalog');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
