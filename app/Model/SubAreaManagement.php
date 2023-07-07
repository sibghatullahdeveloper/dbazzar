<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubAreaManagement extends Model
{

    protected $table = 'sub_area_management';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('area_manager_id', 'name','status','uuid');

    public function AreaManagement(){
        return $this->hasOne('App\Model\AreaManagement', 'id', 'area_manager_id');
    }
}
