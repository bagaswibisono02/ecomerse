<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function media()
    {
        return $this->hasMany(media_produk::class);
    }
    public function kategory()
    {
        return $this->belongsTo(kategory::class);
    }
    public function thumbnail()
    {
        return $this->hasMany(media_produk::class)->orderBy('updated_at', 'ASC')->first();
    }

    public function pesanan()
    {
        return $this->hasMany(pesanan::class);
    }
    public function supplier()
    {
        return $this->hasMany(supplier::class);
    }
    public function provinsi()
    {
        return $this->belongsToMany(provinsi::class, 'free_ongkirs', 'produk_id', 'daerah_id');
    }

    function varian()  {
        return $this->hasMany(varian::class);
    }
    public function scopeParameter($query, $parameter = null)
    {
        if ($parameter) {
            return $query->where('nama', 'LIKE', '%' . $parameter . '%');
        }

        return $query;
    }
    public function scopeKategory($query, $kategoriId = null)
    {
        if ($kategoriId) {
            return $query->where('kategory_id', $kategoriId);
        }

        return $query;
    }

    function users()  {
        return $this->belongsToMany(User::class, 'produk_users')
        ->withPivot('times')
        ->withTimestamps();;
    }

    function review() {
        return $this->hasMany(reviewProduk::class);
    }

}
