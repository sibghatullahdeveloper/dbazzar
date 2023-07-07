<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategories extends Model
{

    protected $table = 'product_categories';
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'status', 
        'start_time', 
        'end_time',
        'order_by',
        'entity_id'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

}
