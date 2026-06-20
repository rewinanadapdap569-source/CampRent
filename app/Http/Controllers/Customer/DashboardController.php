<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Penting untuk perhitungan tanggal

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Hitung jumlah alat yang sedang disewa
        $sewaBerjalan = Rental::where('user_id', $userId)->where('status', 'disewa')->count();

        // 2. Hitung jumlah transaksi yang menunggu pembayaran
        $menungguBayar = Rental::where('user_id', $userId)->where('status', 'pending')->count();

        // 3. Cari kapan jatuh tempo terdekat
        $jatuhTempo = Rental::where('user_id', $userId)
                            ->where('status', 'disewa')
                            ->orderBy('end_date', 'asc')
                            ->first();
        
        $sisaHari = $jatuhTempo ? Carbon::parse($jatuhTempo->end_date)->diffInDays(Carbon::now()) : null;

        // 4. Ambil aktivitas terbaru
        $transaksiTerbaru = Rental::with('alat')
                                  ->where('user_id', $userId)
                                  ->orderBy('created_at', 'desc')
                                  ->take(5)
                                  ->get();

        return view('customer.dashboard', compact('sewaBerjalan', 'menungguBayar', 'sisaHari', 'transaksiTerbaru'));
    }
}