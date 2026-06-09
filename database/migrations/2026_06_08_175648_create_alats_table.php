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
       Schema::create('alats', function (Blueprint $table) {
        $table->id();
        $table->string('nama_alat');
        // Pilihan kategori sesuai di gambar mockup kamu
        $table->enum('kategori', ['Tenda', 'Carrier', 'Sleeping Bag', 'Kompor', 'Lampu', 'Matras']);
        $table->decimal('harga_sewa', 10, 2); // Contoh: 35000.00
        $table->integer('stok');
        $table->enum('status', ['Tersedia', 'Habis'])->default('Tersedia');
        $table->string('gambar')->nullable(); // Untuk menyimpan nama file foto alat camping
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
