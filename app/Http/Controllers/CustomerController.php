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

    // Memproses data input sewa dan menyimpannya ke database (CREATE)
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

        // Hitung total harga
        $totalHarga = $totalHari * $alat->harga_sewa * $request->jumlah_sewa;

        // Simpan Transaksi Sewa
        Rental::create([
            'user_id' => Auth::id(),
            'alat_id' => $request->alat_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'jumlah_sewa' => $request->jumlah_sewa,
            'total_harga' => $totalHarga,
            'status' => 'Diproses',
        ]);

        // Kurangi stok alat camping
        $alat->decrement('stok', $request->jumlah_sewa);

        return redirect()->route('customer.riwayat')->with('success', 'Pesanan rental berhasil dibuat! Menunggu konfirmasi admin.');
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