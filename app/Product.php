<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'images',
        'price',
        'status',
        'url'
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
