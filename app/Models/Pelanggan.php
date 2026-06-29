<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = ['user_id', 'nama', 'no_hp', 'alamat'];

    // Harus bernama 'rentals' agar withCount('rentals') tidak error
    public function rentals() 
    {
        return $this->hasMany(Rental::class, 'pelanggan_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}