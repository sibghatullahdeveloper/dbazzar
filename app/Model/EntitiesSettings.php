<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntitiesSettings extends Model
{

    protected $table = 'entitiessettings';
    public $timestamps = true;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = array('entity_id', 'branch_id','uuid', 'order_type', 'commission', 'minimum_purchase', 'logo', 'header', 'About', 'status', 'status_message', 'packaging_type', 'packaging_charge', 'tax', 'delivery_time', 'menu_type');
    public function entity()
    {
        return $this->hasOne('App\Model\Entities','id', 'entity_id');
    }
}
