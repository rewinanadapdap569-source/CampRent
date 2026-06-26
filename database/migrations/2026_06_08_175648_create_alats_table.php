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
        // Ubah dari enum ke string agar bisa menerima kategori baru
        $table->string('kategori'); 
        $table->decimal('harga_sewa', 10, 2);
        $table->integer('stok');
        $table->string('status')->default('Tersedia');
        $table->string('gambar')->nullable();
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
