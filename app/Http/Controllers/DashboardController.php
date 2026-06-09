<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat; // Impor model Alat agar bisa menghitung jumlah stok secara otomatis

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data riil dari database untuk dipajang di card statistik dashboard
        $totalAlat = Alat::count();
        $alatTersedia = Alat::where('status', 'Tersedia')->sum('stok');
        
        // Variabel penampung transaksi sewa (bisa kamu hubungkan jika tabel sewa sudah dibuat nanti)
        $sewaAktif = 0; 
        $totalPelanggan = 0;
        $recentRentals = [];

        // SOLUSI: Mengubah dari 'pages.dashboard' menjadi 'admin.dashboard'
        return view('pages.Dashboard', compact('totalAlat', 'alatTersedia', 'sewaAktif', 'totalPelanggan', 'recentRentals'));
    }
}