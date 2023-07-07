<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AffiliateLedger extends Model
{

    protected $table = 'affiliate_ledger';
    public $timestamps = true;

    protected $fillable = [
        'transaction_no', 
        'type',
        'affiliate_id',
        'amount'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;


}
