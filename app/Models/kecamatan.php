<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;
    public function kab_kota()
    {
        return $this->belongsTo(kab_kota::class);
    }
    public function kelurahan()
    {
        return $this->hasMany(kelurahan::class);
    }
}
