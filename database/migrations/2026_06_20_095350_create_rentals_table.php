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
    Schema::create('rentals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('alat_id')->constrained('alats')->onDelete('cascade');
        $table->date('tgl_sewa');
        $table->date('tgl_kembali');
        $table->integer('jumlah_set');
        $table->decimal('total_harga', 12, 2);
        $table->enum('status', ['Pending', 'Disetujui', 'Disewa', 'Selesai', 'Ditolak'])->default('Pending');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
