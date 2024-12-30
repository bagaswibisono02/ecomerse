<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konfirmasiPembayaran extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    function pesanan() {
        return $this->belongsTo(pesanan::class);
    }
}
