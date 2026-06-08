<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlatController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
<<<<<<< HEAD
    Route::post('/login', [AuthController::class, 'login']);
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
=======
    Route::post('/login', [AuthController::class, 'login'])->name('login.post'); // Tambahkan ->name() di sini
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
>>>>>>> 8981f4fd7d359b4b47379f1de60e5c28284b37c4
