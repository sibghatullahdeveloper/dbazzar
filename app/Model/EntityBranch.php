<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntityBranch extends Model
{

    protected $table = 'entity_branches';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('uuid', 'slug','title','phone', 'contact','address','cuisines','service_id','publish_merchant','status_id','entity_id','delivery_type','entity_lat','entity_long','geofencing','about','tags','delivery_charge','affiliate_id');


    public function Entity(){
        return $this->hasOne('App\Model\Entities', 'id', 'entity_id');
    }
    public function Service(){
        return $this->hasOne('App\Model\Services', 'id', 'service_id');
    }
    public function Pictures(){
        return $this->hasMany('App\Model\BranchPictures', 'branch_id', 'id');
    }
    public function Timmings(){
        return $this->hasMany('App\Model\BranchTimmings', 'branch_id', 'id');
    }
     public function Affiliate(){
        return $this->hasOne('App\Model\Affiliate', 'id', 'affiliate_id');
    }
    public function tags(){
        return $this->hasMany('App\Model\Tags', 'tags', 'id');
    }
    public function EntitySettings(){
        return $this->hasOne('App\Model\EntitiesSettings', 'entity_id', 'entity_id');
    }
    public function Sponsored(){
        return $this->hasOne('App\Model\Sponsored','entity_branch_id','id');
    }
}
