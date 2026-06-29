<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar semua pelanggan beserta jumlah sewa (rental)
     */
   public function index()
{
    // Memanggil 'rentals' sesuai nama fungsi di Model
    $pelanggans = \App\Models\Pelanggan::withCount('rentals')->latest()->get();
    
    return view('admin.pelanggan.index', compact('pelanggans'));
}

    /**
     * Menampilkan form untuk tambah pelanggan
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Menyimpan data pelanggan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_identitas' => 'required|unique:pelanggans,no_identitas',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Data pelanggan berhasil disimpan!');
    }

    /**
     * Menampilkan form edit pelanggan
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Menyimpan perubahan data pelanggan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'no_identitas' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    /**
     * Menghapus data pelanggan
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Data pelanggan berhasil dihapus!');
    }
}