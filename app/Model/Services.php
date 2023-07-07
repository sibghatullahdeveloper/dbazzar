<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{

    protected $table = 'services';
    public $timestamps = false;


    protected $fillable = array('name', 'type');


}
