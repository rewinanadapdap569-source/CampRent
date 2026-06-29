<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke user yang menyewa
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Menghubungkan ke alat yang disewa
            $table->foreignId('alat_id')->constrained('alats')->onDelete('cascade'); 
            
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration');
            $table->string('guarantee_type'); // KTP, SIM, dll
            $table->string('document_path')->nullable(); // Foto jaminan
            
            $table->decimal('subtotal', 12, 2);
            $table->decimal('deposit', 12, 2);
            $table->decimal('total_due', 12, 2);
            
            $table->string('status')->default('Aktif'); // Aktif, Selesai, Terlambat
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};