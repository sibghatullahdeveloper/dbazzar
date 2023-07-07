<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddOns extends Model
{

    protected $table = 'product_options';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'image',
        'order_by',
        'status',
        'price'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

}
