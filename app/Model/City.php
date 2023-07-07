<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{

    protected $table = 'city';
    public $timestamps = false;


    protected $fillable = array('name', 'country_id');

}
