<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class platformAfiliate extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    function produkAfiliasi() {
        return $this->hasMany(produkAfiliate::class,'platformAfiliate_id');
    }
}
