<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->unique();
            $table->string('deskripsi')->nullable(); // Penjelasan singkat kategori alat
            $table->string('ikon')->nullable(); // Menyimpan class FontAwesome (misal: fa-tent)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
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
