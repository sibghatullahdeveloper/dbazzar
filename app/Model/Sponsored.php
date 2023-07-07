<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsored extends Model
{

    protected $table = 'sponsored';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('status', 'start_date', 'end_date','uuid', 'entity_branch_id');

    public function entity()
    {
        return $this->hasOne('App\Model\Entities','id', 'entity_id');
    }

    public function entitybranches()
    {
        return $this->hasOne('App\Model\EntityBranch','id', 'entity_branch_id');
    }

//    public function Category(){
//        return $this->hasOne('App\Model\Categories', 'id', 'entity_cat');
//    }


}
