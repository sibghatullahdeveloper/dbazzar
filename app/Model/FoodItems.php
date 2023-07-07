<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodItems extends Model
{

    protected $table = 'products';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'status',
        'price',
        'display_price',
        'discount',
        'image',
        'order_by',
        'addons_ids',
        'p_cat_id',
        'entity_id'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

}
