<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerController extends Controller
{
    // Tampilan Katalog Utama Alat Camping
    public function katalog()
    {
        $daftarAlat = Alat::where('stok', '>', 0)->get();
        return view('customer.katalog', compact('daftarAlat'));
    }

    // Menampilkan form pemesanan sewa alat tertentu
    public function formSewa($id)
    {
        $alat = Alat::findOrFail($id);
        return view('customer.form_sewa', compact('alat'));
    }

   public function prosesSewa(Request $request)
{
    $request->validate([
        'alat_id' => 'required|exists:alats,id',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
        'jumlah_sewa' => 'required|integer|min:1',
    ]);

    $alat = Alat::findOrFail($request->alat_id);

    if ($request->jumlah_sewa > $alat->stok) {
        return back()->withErrors(['jumlah_sewa' => 'Stok alat tidak mencukupi!']);
    }

    // Hitung total hari sewa
    $startDate = Carbon::parse($request->start_date);
    $endDate = Carbon::parse($request->end_date);
    $totalHari = $startDate->diffInDays($endDate);
    if($totalHari == 0) $totalHari = 1; // Minimal 1 hari sewa

    $totalHarga = $alat->harga_sewa * $request->jumlah_sewa * $totalHari;

    // SIMPAN MENGGUNAKAN NAMA KOLOM TABEL RENTALS KAMU YANG SUDAH ADA
    Rental::create([
        'user_id' => Auth::id(),
        'alat_id' => $request->alat_id,
        'tgl_sewa' => $request->start_date,      // Menyesuaikan ke tgl_sewa
        'tgl_kembali' => $request->end_date,    // Menyesuaikan ke tgl_kembali
        'jumlah_set' => $request->jumlah_sewa,   // Menyesuaikan ke jumlah_set
        'total_harga' => $totalHarga,
        'status' => 'Diproses',                  // Otomatis berstatus Diproses agar di-approve Admin
    ]);

    // Kurangi stok alat camping milik admin
    $alat->decrement('stok', $request->jumlah_sewa);

    return redirect()->route('customer.dashboard')->with('success', 'Pesanan rental berhasil dibuat! Menunggu konfirmasi admin.');
}

    // Menampilkan riwayat transaksi milik customer tersebut (READ)
    public function riwayatSewa()
    {
        $riwayat = Rental::where('user_id', Auth::id())->with('alat')->latest()->get();
        return view('customer.riwayat', compact('riwayat'));
    }

    // Membatalkan pesanan sewa jika status masih 'Diproses' (DELETE)
    public function batalkanSewa($id)
    {
        $rental = Rental::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($rental->status == 'Diproses') {
            // Kembalikan stok alat camping
            $alat = Alat::find($rental->alat_id);
            if ($alat) {
                $alat->increment('stok', $rental->jumlah_sewa);
            }

            $rental->delete();
            return redirect()->route('customer.riwayat')->with('success', 'Pesanan rental berhasil dibatalkan.');
        }

        return redirect()->route('customer.riwayat')->with('error', 'Pesanan yang sedang dibawa atau selesai tidak bisa dibatalkan.');
    }
}