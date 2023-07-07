<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{

    protected $table = 'usercart';
    public $timestamps = false;


    protected $fillable = array('user_id', 'cookie_token','product_id','addons','quantity','comments','total_price','entity_id');

}
