<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori; // Pastikan model ini diimpor
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $daftarAlat = Alat::all();
        return view('admin.gears.index', compact('daftarAlat'));
    }

    public function create()
    {
        // MENGAMBIL DATA KATEGORI UNTUK DROPDOWN
        $kategoris = Kategori::all(); 
        return view('admin.gears.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kategori'    => 'required', 
            'harga_sewa'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/alat'), $namaGambar);
        }

        Alat::create([
            'nama_alat'   => $request->nama_alat,
            'kategori'    => $request->kategori,
            'harga_sewa'  => $request->harga_sewa,
            'stok'        => $request->stok,
            'status'      => $request->stok > 0 ? 'Tersedia' : 'Kosong',
            'gambar'      => $namaGambar
        ]);

        return redirect()->route('alat.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all(); // Tambahkan ini agar edit juga bisa ganti kategori
        return view('admin.gears.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kategori'    => 'required',
            'harga_sewa'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            if ($alat->gambar && file_exists(public_path('images/alat/' . $alat->gambar))) {
                unlink(public_path('images/alat/' . $alat->gambar));
            }
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/alat'), $namaGambar);
            $alat->gambar = $namaGambar;
        }

        $alat->update([
            'nama_alat'   => $request->nama_alat,
            'kategori'    => $request->kategori,
            'harga_sewa'  => $request->harga_sewa,
            'stok'        => $request->stok,
            'status'      => $request->stok > 0 ? 'Tersedia' : 'Habis',
        ]);

        return redirect()->route('alat.index')->with('success', 'Data diperbarui!');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        if ($alat->gambar && file_exists(public_path('images/alat/' . $alat->gambar))) {
            unlink(public_path('images/alat/' . $alat->gambar));
        }
        $alat->delete();
        return redirect()->route('alat.index')->with('success', 'Alat dihapus!');
    }
}