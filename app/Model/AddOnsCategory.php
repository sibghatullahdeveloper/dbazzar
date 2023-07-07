<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddOnsCategory extends Model
{

    protected $table = 'product_options_sub';
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'status', 
        'description',
        'addons_id',
        'entity_id',
        'order_by',
        'selection_type',
        'max_selection',
        'min_selection',
        'required'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

}
