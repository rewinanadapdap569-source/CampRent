<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    /**
     * DISPLAY (READ): Menampilkan tabel daftar alat di halaman Admin.
     * Sesuai dengan gambar mockup kanan-tengah milikmu.
     */
    public function index()
    {
        // Ambil semua data alat camping dari database
        $daftarAlat = Alat::all();
        
        // Arahkan ke file blade admin kamu
        return view('admin.gears.index', compact('daftarAlat'));
    }

    /**
     * CREATE: Menampilkan halaman form tambah alat camping baru.
     */
    public function create()
    {
        return view('admin.gears.create');
    }

    /**
     * STORE: Memproses data dari form tambah alat dan menyimpannya ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan form agar data wajib diisi dengan benar
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kategori'    => 'required|in:Tenda,Carrier,Sleeping Bag,Kompor,Lampu,Matras',
            'harga_sewa'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // 2. Handle upload gambar jika ada
        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Menyimpan ke folder 'public/images/alat' di dalam storage
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/alat'), $namaGambar);
        }

        // 3. Simpan data ke database tabel 'alats'
        Alat::create([
            'nama_alat'  => $request->nama_alat,
            'kategori'   => $request->kategori,
            'harga_sewa' => $request->harga_sewa,
            'stok'       => $request->stok,
            'status'     => $request->stok > 0 ? 'Tersedia' : 'Habis',
            'gambar'     => $namaGambar
        ]);

        // Redirect kembali ke tabel daftar alat dengan pesan sukses
        return redirect()->route('alat.index')->with('success', 'Alat camping baru berhasil ditambahkan!');
    }

    /**
     * EDIT: Menampilkan halaman form untuk mengubah data alat camping.
     */
    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        return view('admin.gears.edit', compact('alat'));
    }

    /**
     * UPDATE: Memproses perubahan data dari form edit ke database.
     */
    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kategori'    => 'required|in:Tenda,Carrier,Sleeping Bag,Kompor,Lampu,Matras',
            'harga_sewa'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cek jika admin mengganti gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama di folder public jika ada
            if ($alat->gambar && file_exists(public_path('images/alat/' . $alat->gambar))) {
                unlink(public_path('images/alat/' . $alat->gambar));
            }
            
            // Upload gambar baru
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/alat'), $namaGambar);
            $alat->gambar = $namaGambar;
        }

        // Update kolom lainnya
        $alat->nama_alat  = $request->nama_alat;
        $alat->kategori   = $request->kategori;
        $alat->harga_sewa = $request->harga_sewa;
        $alat->stok       = $request->stok;
        $alat->status     = $request->stok > 0 ? 'Tersedia' : 'Habis';
        $alat->save();

        return redirect()->route('alat.index')->with('success', 'Data alat camping berhasil diperbarui!');
    }

    /**
     * DESTROY (DELETE): Menghapus data alat camping dari database.
     */
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);

        // Hapus file gambar dari penyimpanan lokal sebelum menghapus datanya
        if ($alat->gambar && file_exists(public_path('images/alat/' . $alat->gambar))) {
            unlink(public_path('images/alat/' . $alat->gambar));
        }

        $alat->delete();

        return redirect()->route('alat.index')->with('success', 'Alat camping berhasil dihapus!');
    }

    /**
     * JALUR CUSTOMER: Menampilkan Katalog Produk untuk Sisi User.
     * Sesuai dengan gambar mockup kiri-bawah milikmu.
     */
    public function katalogUser()
    {
        // Menampilkan semua alat camping yang stoknya di atas 0 agar bisa disewa pelanggan
        $katalogAlat = Alat::where('stok', '>', 0)->get();

        return view('landing.katalog', compact('katalogAlat'));
    }
}