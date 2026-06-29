<?php
namespace App\Http\Controllers;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
class AlatController extends Controller
{
    /**
     * Menampilkan daftar alat admin
     */
    public function index()
    {
        $daftarAlat = Alat::with('kategori')->get();
        return view(
            'admin.gears.index',
            compact('daftarAlat')
        );
    }
    /**
     * Form tambah alat
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view(
            'admin.gears.create',
            compact('kategori')
        );
    }
    /**
     * Simpan alat baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga_sewa' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);
        $namaGambar = null;
        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $namaGambar = time().'_'.$file->getClientOriginalName();
            $file->move(
                public_path('images/alat'),
                $namaGambar
            );
        }
        Alat::create([
            'nama_alat' => $request->nama_alat,
            'kategori_id' => $request->kategori_id,
            'harga_sewa' => $request->harga_sewa,
            'stok' => $request->stok,
            'status' => $request->stok > 0 
                        ? 'Tersedia' 
                        : 'Habis',
            'gambar' => $namaGambar
        ]);
        return redirect()
            ->route('alat.index')
            ->with(
                'success',
                'Alat camping berhasil ditambahkan!'
            );
    }
    /**
     * Form edit alat
     */
    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategori = Kategori::all();
        return view(
            'admin.gears.edit',
            compact('alat','kategori')
        );
    }
    /**
     * Update alat
     */
    public function update(Request $request,$id)
    {
        $alat = Alat::findOrFail($id);
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga_sewa' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);
        if($request->hasFile('gambar')){
            if(
                $alat->gambar &&
                file_exists(
                    public_path('images/alat/'.$alat->gambar)
                )
            ){
                unlink(
                    public_path('images/alat/'.$alat->gambar)
                );
            }
            $file = $request->file('gambar');
            $namaGambar =
            time().'_'.$file->getClientOriginalName();
            $file->move(
                public_path('images/alat'),
                $namaGambar
            );
            $alat->gambar = $namaGambar;
        }
        $alat->nama_alat = $request->nama_alat;
        $alat->kategori_id = $request->kategori_id;
        $alat->harga_sewa = $request->harga_sewa;
        $alat->stok = $request->stok;
        $alat->status = $request->stok > 0
                        ? 'Tersedia'
                        : 'Habis';
        $alat->save();
        return redirect()
            ->route('alat.index')
            ->with(
                'success',
                'Data alat berhasil diperbarui!'
            );
    }
    /**
     * Hapus alat
     */
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        if(
            $alat->gambar &&
            file_exists(
                public_path('images/alat/'.$alat->gambar)
      )
        ){
            unlink(
                public_path('images/alat/'.$alat->gambar)
            );
        }
        $alat->delete();
        return redirect()
            ->route('alat.index')
            ->with(
                'success',
                'Alat berhasil dihapus!'
            );
    }

    public function katalogUser()
    {
        $katalogAlat = Alat::with('kategori')
            ->where('stok','>',0)
            ->get();
        return view(
            'landing.katalog',
            compact('katalogAlat')
        );
    }
}