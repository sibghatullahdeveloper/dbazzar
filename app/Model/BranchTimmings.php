<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchTimmings extends Model
{

    protected $table = 'branch_timmings';
    public $timestamps = false;


    protected $fillable = array('branch_id', 'day', 'start_time','end_time');

}
