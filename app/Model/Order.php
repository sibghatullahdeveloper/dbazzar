<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;

    protected $fillable = [
        'payment_id',
        'branch_id',
        'payment_mode',
        'consumer_id',
        'consumer_address_id',
        'tax',
        'total_amount',
        'number',
        'name',
        'discount_amount',
        'order_status_id',
        'delivery_instruction'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

    public function orderdetails(){
        return $this->hasMany('App\Model\OrderDetail','order_id','id');
    }

    public function orderstatus()
    {
        return $this->hasOne('App\Model\OrderStatus','id','order_status_id');
    }

    public function entitybranch()
    {
        return $this->hasOne('App\Model\EntityBranch','id','branch_id');
    }

    public function consumer()
    {
        return $this->hasOne('App\Model\ConsumerUser','id','consumer_id');
    }

    public function ConsumerAddress(){
         return $this->hasOne('App\Model\ConsumerAddressess','id','consumer_address_id');
    }

}
