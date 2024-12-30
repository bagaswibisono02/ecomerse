<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelurahan extends Model
{
    use HasFactory;
    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }
    public function alamatPenerima()
    {
        return $this->hasMany(alamat_penerima::class);
    }
}
