<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan Tabel Kategori
    public function index()
    {
        // SOLUSI: Mengambil semua data baris dari tabel kategoris secara urut terbaru
        $daftarKategori = Kategori::latest()->get(); 
        
        // Kirim variabel dengan nama 'daftarKategori' ke halaman view
        return view('admin.categories.index', compact('daftarKategori'));
    }

    // Memproses data kiriman form tambah
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
            'deskripsi'     => 'nullable|string|max:500',
            'ikon'          => 'required|string|max:100',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
            'ikon'          => $request->ikon,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }
}