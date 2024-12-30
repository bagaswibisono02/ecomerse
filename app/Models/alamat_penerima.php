<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alamat_penerima extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    function  kelurahan()  {
        return $this->belongsTo(kelurahan::class);
    }
    
}
