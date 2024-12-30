<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    use HasFactory;
    public function kab_kota()
    {
        return $this->hasMany(kab_kota::class);
    }

    public function produk()
{
    return $this->belongsToMany(Produk::class, 'free_ongkirs', 'daerah_id', 'produk_id');
}
    
}

