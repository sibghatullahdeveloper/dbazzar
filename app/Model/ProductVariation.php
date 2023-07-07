<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{

    protected $table = 'products_variation';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'status',
        'price',
        'discount',
        'image',
        'addons_ids',
        'p_cat_id'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

}
