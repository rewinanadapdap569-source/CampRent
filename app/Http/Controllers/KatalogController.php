<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alat;

class KatalogController extends Controller
{

    public function index()
    {

        $katalogAlat = Alat::with('kategori')
            ->where('stok', '>', 0)
            ->get();


        return view(
            'customer.katalog',
            compact('katalogAlat')
        );

    }

}