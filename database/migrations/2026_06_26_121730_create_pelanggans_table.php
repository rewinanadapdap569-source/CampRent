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
    Schema::create('pelanggans', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('no_identitas')->unique(); // Untuk KTP
        $table->string('no_hp');
        $table->text('alamat');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
