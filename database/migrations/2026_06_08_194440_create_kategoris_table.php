<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('ikon')->default('fa-tags'); // Menyimpan class FontAwesome
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
// public function index()
// {
//     $daftarKategori = Kategori::all();
//     dd($daftarKategori); // <--- TAMBAHKAN BARIS INI SEMENTARA
//     return view('admin.categories.index', compact('daftarKategori'));
// };
