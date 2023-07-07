<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{

    protected $table = 'status';
    public $timestamps = false;



    protected $fillable = array('name', 'type');




}
