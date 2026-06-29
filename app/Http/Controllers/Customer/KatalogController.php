<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Alat; // Pastikan model Alat sudah ada

class KatalogController extends Controller
{
    public function index()
    {
        // Ambil semua alat yang statusnya tersedia
        $alat = Alat::where('status', 'Tersedia')
                    ->where('stok', '>', 0)
                    ->get();
        return view('customer.katalog', compact('alat'));
    }
}