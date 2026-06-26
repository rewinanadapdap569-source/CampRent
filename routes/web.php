<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Gunakan alias agar tidak bentrok
use App\Http\Controllers\DashboardController as AdminDashboard;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\KatalogController; // Dipanggil biasa tanpa alias
use App\Http\Controllers\RentalController;

// Halaman Utama
Route::get('/', function () { return view('welcome'); })->name('welcome');

// Kelompok Rute Tamu (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Kelompok Rute yang Wajib Login (Semua Role)
Route::middleware(['auth'])->group(function () {
    
    // Rute Global Bersama (Bisa diakses Admin maupun Customer)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Panel
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('pages.dashboard');
        Route::resource('alat', AlatController::class);
        Route::resource('kategori', KategoriController::class);
        // PERBAIKAN: Tambahkan 'admin.' di setiap ->name() rute rental berikut
        Route::get('/rentals', [RentalController::class, 'indexAdmin'])->name('admin.rental.index');
        Route::get('/rentals/create', [RentalController::class, 'createAdmin'])->name('admin.rental.create');
        Route::post('/rentals/store', [RentalController::class, 'storeAdmin'])->name('admin.rental.store');
        Route::patch('/rentals/{id}/status', [RentalController::class, 'updateStatus'])->name('admin.rental.status');
        Route::get('/rentals/{id}/edit', [RentalController::class, 'editAdmin'])->name('admin.rental.edit');
        Route::put('/rentals/{id}', [RentalController::class, 'updateAdmin'])->name('admin.rental.update');

        Route::get('/returns', [RentalController::class, 'indexReturn'])->name('return.index');
        Route::patch('/returns/{id}/process', [RentalController::class, 'processReturn'])->name('return.process');
    });

    // Customer Panel
    Route::middleware(['role:customer'])->prefix('customer')->group(function () {
        Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('customer.dashboard');
        
        // Perbaikan: Memanggil 'KatalogController' sesuai use di atas, gunakan method 'index' atau sesuaikan dengan isi controllermu
        Route::get('/katalog', [KatalogController::class, 'index'])->name('customer.katalog');

        Route::get('/sewa/{id}', [RentalController::class,'create'])->name('customer.form_sewa');
    });
    
});