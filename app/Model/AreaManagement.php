<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaManagement extends Model
{

    protected $table = 'area_management';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'country_id', 'city_id' ,'uuid' ,'status');

    public function City(){
        return $this->hasOne('App\Model\City', 'id', 'city_id');
    }
    public function Countires(){
        return $this->hasOne('App\Model\Countires', 'id', 'country_id');
    }


}
