<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
{
    Schema::table('rentals', function (Blueprint $table) {
        // Menambahkan kolom pelanggan_id agar bisa berelasi
        $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('rentals', function (Blueprint $table) {
        $table->dropColumn('pelanggan_id');
    });
}
};
