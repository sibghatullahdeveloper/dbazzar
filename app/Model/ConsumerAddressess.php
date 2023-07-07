<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsumerAddressess extends Model
{

    protected $table = 'consumers_addresses';
    public $timestamps = true;

    protected $fillable = [
        'address',
        'consumer_id',
        'latitude',
        'longitude'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

      
}
