<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    // public function keuangan()
    // {
    //     return $this->belongsTo(keuangan::class);
    // }
    public function scopeFilter($query, $filter)
    {
        if ($filter == 'keranjang') {
            return $query->where('status', 'keranjang');
        } elseif ($filter == 'selesai') {
            return $query->where('status', 'selesai');
        } elseif ($filter == 'diproses') {
            return $query->where('status', 'diproses');
        } elseif ($filter == 'Berhasil') {
            return $query->where('status', 'Berhasil');
        } elseif ($filter == 'batal') {
            return $query->where('status', 'batal');
        } elseif ($filter == 'tunggubayar') {
            return $query->where('status', 'tunggubayar');
        }
        return $query;
    }
    public function produk()
    {
        return $this->belongsTo(produk::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterId($query, $filter)
    {
        if (!empty($filter)) {
            return $query->where('id', $filter);
        }

    }

    public function scopeFilterTanggal(Builder $query, $start_date, $end_date)
    {
        if ($start_date && $end_date) {
            return $query->whereBetween('created_at', [$start_date, $end_date]);
        }
    }
    public function scopeFilterStatus(Builder $query, $status)
    {
        if ($status == 'tunggubayar') {
            return $query->where('status', $status);
        } elseif ($status == 'perluresi') {
            return $query->whereNull('resi') // Untuk memeriksa jika resi bernilai null
                ->orWhere('resi', '');
        } elseif ($status == 'adaresi') {
            return $query->where('resi', '!=', '');
        } elseif ($status == 'Berhasil') {
            return $query->where('status', 'Berhasil', );
        } elseif ($status == 'selesai') {
            return $query->where('status', $status);
        } elseif ($status == 'batal') {
            return $query->where('status', $status);
        }
    }
    public function alamatPenerima()
    {
        return $this->belongsTo(alamat_penerima::class);
    }
    function pengiriman(){
        return $this->hasMany(pengiriman::class);
    }
    function konfirmasiPembayaran()  {
        return $this->hasOne(konfirmasiPembayaran::class);
    }

}
