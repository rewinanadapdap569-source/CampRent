<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Alat extends Model
{
use HasFactory;
protected $table = 'alats';
protected $fillable = [
    'nama_alat',
    'kategori_id',
    'harga_sewa',
    'stok',
    'status',
    'gambar'
];
public function kategori()
{
    return $this->belongsTo(Kategori::class,'kategori_id');
}
}