<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchPictures extends Model
{

    protected $table = 'entitybranch_pictures';
    public $timestamps = false;
    protected $fillable = array('branch_id', 'picture', 'type');

}
