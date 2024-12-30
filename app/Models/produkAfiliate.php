<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produkAfiliate extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    protected static function boot()
    {
        parent::boot(); // Pastikan ini ditulis dengan benar

        static::deleting(function ($produkAfiliate) {
            // Hapus data pivot di tabel produk_afiliate_media_afiliates
            $produkAfiliate->media()->detach();
        });
    }


    function media() {
        return $this->belongsToMany(mediaAfiliate::class,'produk_afiliate_media_afiliates','produk_afiliate_id', 'media_afiliate_id');
    }
}
