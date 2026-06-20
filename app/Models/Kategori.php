<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'kategoris';

    // Mendaftarkan kolom yang boleh diisi
    protected $fillable = ['nama_kategori', 'deskripsi', 'ikon'];

    // Relasi: Satu kategori bisa dipakai oleh banyak Alat Camping
    public function alats()
    {
        return $this->hasMany(Alat::class, 'kategori_id');
    }
}