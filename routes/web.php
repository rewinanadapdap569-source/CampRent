<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController as AdminDashboard;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\Customer\KatalogController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PaymentController;

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
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Panel
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('pages.dashboard');
        
        Route::resource('alat', AlatController::class);
        Route::resource('kategori', KategoriController::class);
        
        // Rental Admin
        Route::get('/rentals', [RentalController::class, 'indexAdmin'])->name('admin.rental.index');
        Route::get('/rentals/create', [RentalController::class, 'createAdmin'])->name('admin.rental.create');
        Route::post('/rentals/store', [RentalController::class, 'storeAdmin'])->name('admin.rental.store');
        Route::patch('/rentals/{id}/status', [RentalController::class, 'updateStatus'])->name('admin.rental.status');
        Route::get('/rentals/{id}/edit', [RentalController::class, 'editAdmin'])->name('admin.rental.edit');
        Route::put('/rentals/{id}', [RentalController::class, 'updateAdmin'])->name('admin.rental.update');

        // Return
        Route::get('/returns', [RentalController::class, 'indexReturn'])->name('return.index');
        Route::patch('/returns/{id}/process', [RentalController::class, 'processReturn'])->name('return.process');

        // Pembayaran (Sudah digabung ke dalam prefix admin)
        Route::get('/pembayaran', [PaymentController::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/create', [PaymentController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran', [PaymentController::class, 'store'])->name('pembayaran.store'); 
    });

    // Customer Panel
    Route::middleware(['role:customer'])->prefix('customer')->group(function () {
        Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('customer.dashboard');
        Route::get('/katalog', [KatalogController::class, 'index'])->name('customer.katalog');
    });
});