<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{

    protected $table = 'order_status';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'status',
        'uuid'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

}