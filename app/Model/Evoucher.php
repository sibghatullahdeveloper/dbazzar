<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evoucher extends Model
{

    protected $table = 'e_voucher';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'image',
        'description',
        'discount_type',
        'discount_percentage',
        'discount_amount',
        'status',
        'entity_id',
        'uuid'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

}
