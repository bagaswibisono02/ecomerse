<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Return_;

class reviewProduk extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    function mediaReview() {
        return $this->hasMany(mediaReview::class,'mediaReview_id');
    }
    function user(){
        return $this->belongsTo(user::class);
    }
}
