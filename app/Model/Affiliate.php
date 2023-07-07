<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliate extends Model
{

    protected $table = 'affiliates';
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'status',
        'address',
        'email',
        'contact',
        'status',
        'affiliate_post_type',
        'uuid',
        'parent_id',
        'area_id',
        'sub_area_id'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

   public function user(){
        return $this->hasOne('App\User', 'affiliate_id', 'id');
    }

     public function Area(){
        return $this->hasOne('App\Model\AreaManagement', 'id', 'area_id');
    }
    public function SubArea(){
        return $this->hasOne('App\Model\SubAreaManagement', 'id', 'sub_area_id');
    }
}
