<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{

    protected $table = 'order_details';
    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'product_id',
        'description',
        'quantity',
        'amount',
        'addons'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

    public function order(){
        return $this->belongsTo('App\Model\Order', 'order_id', 'id');
    }

    public function product()
    {
        return $this->hasOne('App\Model\FoodItems','id','product_id');
    }

}
