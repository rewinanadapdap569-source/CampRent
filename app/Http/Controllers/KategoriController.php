<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // 1. Menampilkan Semua Kategori
    public function index()
    {
        $daftarKategori = Kategori::latest()->get();
        return view('admin.categories.index', compact('daftarKategori'));
    }

    // 2. Menampilkan Form Tambah Kategori
    public function create()
    {
        return view('admin.categories.create');
    }

    // 3. Menyimpan Kategori Baru ke Database
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

    // 4. Menampilkan Form Edit Kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.categories.edit', compact('kategori'));
    }

    // 5. Memperbarui Data Kategori di Database
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->id,
            'deskripsi'     => 'nullable|string|max:500',
            'ikon'          => 'required|string|max:100',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
            'ikon'          => $request->ikon,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil diperbarui!');
    }

    // 6. Menghapus Kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}