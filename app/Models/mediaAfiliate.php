<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mediaAfiliate extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function AfiliateProduk()
    {
        return $this->belongsToMany(mediaAfiliate::class, 'produkAfiliate_mediaAfiliate', 'produkAfiliate_id', 'mediaAfiliate_id');
    }
}
