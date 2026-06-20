<?php

namespace App\Http\Controllers;

use App\Models\Alat;   // Menggunakan model Alat sesuai proyekmu
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    // 1. Tampilkan Semua Transaksi di Admin
    public function indexAdmin()
    {
        // Menyinkronkan relasi ke 'gear' (bukan 'alat')
        $daftarSewa = Rental::with(['user', 'gear'])->latest()->get();
        return view('admin.rental.index', compact('daftarSewa'));
    }

    // 2. Form Tambah Transaksi Manual oleh Admin
    public function createAdmin()
    {
        $pelanggan = User::where('role', 'pelanggan')->get(); 
        $gears = Alat::where('stok', '>', 0)->get(); // Menggunakan $gears agar tidak Undefined di Blade
        return view('admin.rental.create', compact('pelanggan', 'gears'));
    }

    // 3. Simpan Transaksi Manual dari Admin
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'gear_id' => 'required|exists:gears,id',
            'tgl_sewa' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_sewa',
            'jumlah_set' => 'required|integer|min:1',
        ]);

        $gear = Alat::findOrFail($request->gear_id);
        if ($gear->stok < $request->jumlah_set) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi.');
        }

        $durasi = Carbon::parse($request->tgl_sewa)->diffInDays(Carbon::parse($request->tgl_kembali)) ?: 1;
        $totalHarga = $gear->harga_sewa * $durasi * $request->jumlah_set;

        Rental::create([
            'user_id' => $request->user_id,
            'gear_id' => $request->gear_id,
            'tgl_sewa' => $request->tgl_sewa,
            'tgl_kembali' => $request->tgl_kembali,
            'jumlah_set' => $request->jumlah_set,
            'total_harga' => $totalHarga,
            'status' => 'Disetujui'
        ]);

        return redirect()->route('admin.rental.index')->with('success', 'Penyewaan berhasil dicatat!');
    }

    // 4. Update Status Cepat & Manipulasi Stok Otomatis
    public function updateStatus(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);
        $gear = Alat::findOrFail($rental->gear_id);
        $statusBaru = $request->status;

        if ($statusBaru == 'Disewa' && $rental->status != 'Disewa') {
            if ($gear->stok < $rental->jumlah_set) {
                return redirect()->back()->with('error', 'Stok di gudang tidak cukup untuk proses check-out.');
            }
            $gear->decrement('stok', $rental->jumlah_set);
        }

        if ($statusBaru == 'Selesai' && $rental->status == 'Disewa') {
            $gear->increment('stok', $rental->jumlah_set);
        }

        $rental->update(['status' => $statusBaru]);
        return redirect()->back()->with('success', 'Status transaksi diperbarui!');
    }

    // 5. Form Edit Detail Transaksi (Tambahan agar Rute Tidak Error)
    public function editAdmin($id)
    {
        $rental = Rental::with(['user', 'gear'])->findOrFail($id);
        $gears = Alat::all();
        return view('admin.rental.edit', compact('rental', 'gears'));
    }

    // 6. Proses Perbarui Detail Transaksi (Tambahan agar Rute Tidak Error)
    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'gear_id' => 'required|exists:gears,id',
            'tgl_sewa' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_sewa',
            'jumlah_set' => 'required|integer|min:1',
        ]);

        $rental = Rental::findOrFail($id);
        $gear = Alat::findOrFail($request->gear_id);

        $durasi = Carbon::parse($request->tgl_sewa)->diffInDays(Carbon::parse($request->tgl_kembali)) ?: 1;
        $totalHarga = $gear->harga_sewa * $durasi * $request->jumlah_set;

        $rental->update([
            'gear_id' => $request->gear_id,
            'tgl_sewa' => $request->tgl_sewa,
            'tgl_kembali' => $request->tgl_kembali,
            'jumlah_set' => $request->jumlah_set,
            'total_harga' => $totalHarga,
        ]);

        return redirect()->route('admin.rental.index')->with('success', 'Detail transaksi berhasil diperbarui!');
    }


    // ==================== TAMBAHAN MODUL PENGEMBALIAN ====================

    // 7. Tampilkan Daftar Alat yang Sedang Disewa Pelanggan
    public function indexReturn()
    {
        // Menyaring data transaksi yang statusnya hanya 'Disewa'
        $daftarDisewa = Rental::with(['user', 'gear'])->where('status', 'Disewa')->latest()->get();
        return view('admin.return.index', compact('daftarDisewa'));
    }

    // 8. Proses Terima Pengembalian Fisik Alat dan Pemulihan Stok
    public function processReturn($id)
    {
        $rental = Rental::findOrFail($id);
        $gear = Alat::findOrFail($rental->gear_id); // Menggunakan model Alat sesuai proyekmu

        // Tambahkan kembali stok alat camping ke database
        $gear->increment('stok', $rental->jumlah_set);

        // Ubah status transaksi penyewaan dari 'Disewa' menjadi 'Selesai'
        $rental->update([
            'status' => 'Selesai'
        ]);

        return redirect()->route('admin.return.index')->with('success', 'Alat camping sukses dikembalikan! Stok gudang bertambah otomatis.');
    }
}