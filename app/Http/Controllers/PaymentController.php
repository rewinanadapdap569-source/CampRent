<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('admin.payment.index', compact('payments'));
    }

  public function create()
{
    // Mengambil semua data sewa yang belum selesai
    $rentals = \App\Models\Rental::all(); 
    return view('admin.payment.create', compact('rentals'));
}

    public function store(Request $request)
    {
        $request->validate([
            'rental_id' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
        ]);

        Payment::create([
            'rental_id' => $request->rental_id,
            'amount' => $request->amount,
            'payment_date' => now(),
            'payment_method' => $request->payment_method,
            'status' => 'Verified'
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan!');
    }
}