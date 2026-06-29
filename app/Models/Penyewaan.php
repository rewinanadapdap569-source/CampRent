<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alat_id',
        'start_date',
        'end_date',
        'duration',
        'guarantee_type',
        'document_path',
        'subtotal',
        'deposit',
        'total_due',
        'status'
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
}
