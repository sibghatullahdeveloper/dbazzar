<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entities extends Model
{

    protected $table = 'entities';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('uuid', 'name', 'entity_cat','status' );


    public function Category(){
        return $this->hasOne('App\Model\Categories', 'id', 'entity_cat');
    }

    public function user(){

    	return $this->hasOne('App\User','entity_id','id');
    }
}
