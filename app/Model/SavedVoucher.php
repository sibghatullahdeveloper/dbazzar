<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavedVoucher extends Model
{

    protected $table = 'savedvoucher';
    public $timestamps = false;

    protected $fillable = [
        'voucher_id',
        'user_id',
        'entity_id',
        'status'
    ];


   
     public function evoucher(){
        return $this->hasOne('App\Model\Evoucher', 'id', 'voucher_id');
    }
}
