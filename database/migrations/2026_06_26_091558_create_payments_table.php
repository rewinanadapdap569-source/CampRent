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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel rentals
        $table->foreignId('rental_id')->constrained('rentals')->onDelete('cascade');
        $table->decimal('amount', 15, 2); // Jumlah bayar
        $table->date('payment_date');
        $table->string('payment_method'); // Transfer, Tunai, dll
        $table->string('proof_of_payment')->nullable(); // Bukti foto
        $table->enum('status', ['Pending', 'Verified', 'Rejected'])->default('Pending');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
