<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('jaminans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('rental_id')->constrained(); // Relasi ke penyewaan
        $table->string('jenis_jaminan'); // Contoh: KTP, SIM, Uang
        $table->string('foto_jaminan')->nullable(); // Jika ada bukti foto
        $table->string('status')->default('Ditahan'); // Ditahan atau Dikembalikan
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('jaminans');
    }
};
