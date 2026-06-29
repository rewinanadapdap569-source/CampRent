<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use App\Models\Alat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index()
    {
        $penyewaan = Penyewaan::with('alat')
           ->where('user_id', Auth::id())
            ->get();

        return view('customer.penyewaan', compact('penyewaan'));
    }

    // Proses simpan booking langsung
    public function store(Request $request)
    {
        // 1. Validasi Input yang Dikirim oleh Form Modal
        $request->validate([
            'alat_id'        => 'required|exists:alats,id',
            'start_date'     => 'required|date|after_or_equal:today',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'guarantee_type' => 'required|string',
            'gambar_jaminan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // 2. Ambil Data Alat untuk Menghitung Harga
        $alat = Alat::findOrFail($request->alat_id);

        // 3. Hitung Durasi Sewa Menggunakan Carbon
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $durasi = $start->diffInDays($end);
        
        // Minimal sewa dihitung 1 hari jika start_date dan end_date sama
        if ($durasi == 0) {
            $durasi = 1;
        }

        // 4. Hitung Finansial (Sesuai Logika Mockup Anda)
        $subtotal = $alat->harga_sewa * $durasi;
        $deposit = $subtotal * 0.5; // Contoh deposit: 50% dari subtotal
        $total_due = $subtotal + $deposit;

        // 5. Handle Upload Dokumen Jaminan
        $namaFileJaminan = null;
        if ($request->hasFile('gambar_jaminan')) {
            $file = $request->file('gambar_jaminan');
            $namaFileJaminan = time() . '_jaminan_' . $file->getClientOriginalName();
            $file->move(public_path('images/jaminan'), $namaFileJaminan);
        }

        // 6. Simpan ke Database
        Penyewaan::create([
            'user_id'        => Auth::id(),
            'alat_id'        => $request->alat_id,
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'duration'       => $durasi,
            'guarantee_type' => $request->guarantee_type,
            'document_path'  => $namaFileJaminan,
            'subtotal'       => $subtotal,
            'deposit'        => $deposit,
            'total_due'      => $total_due,
            'status'         => 'Aktif',
        ]);

        // 7. Kurangi Stok Alat Beresiko Habis
        $alat->decrement('stok', 1);
        if ($alat->stok <= 0) {
            $alat->update(['status' => 'Habis']);
        }

        return redirect()->route('penyewaan.index')->with('success', 'Booking berhasil dibuat!');
    }
}