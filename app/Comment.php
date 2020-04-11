<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $fillable = ['product_id','user_id','text'];

    public function user(){
      return $this->hasOne('App\User', 'id', 'user_id');
    }
}
