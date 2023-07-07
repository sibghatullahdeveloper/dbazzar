<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countires extends Model
{

    protected $table = 'countries';
    public $timestamps = false;


    protected $fillable = array('code', 'country');

}
