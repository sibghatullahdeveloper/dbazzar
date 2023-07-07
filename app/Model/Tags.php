<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tags extends Model
{

    protected $table = 'tags';
    public $timestamps = false;




    protected $fillable = array('name', 'status');




}
