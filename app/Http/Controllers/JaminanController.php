<?php

namespace App\Http\Controllers;

use App\Models\Jaminan;
use Illuminate\Http\Request;

class JaminanController extends Controller
{
    public function index()
    {
        // Mengambil data jaminan dan relasi ke rental
        $jaminans = Jaminan::with('rental')->latest()->get();
        
        return view('admin.jaminan.index', compact('jaminans'));
    }

    public function create()
    {
        // Logika untuk menampilkan form tambah jaminan
        return view('admin.jaminan.create');
    }
}