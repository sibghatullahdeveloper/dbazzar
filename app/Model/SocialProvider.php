<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $fillable = ['provider_id','provider','consumer_user_id'];


    function user()
    {
        return $this->belongsTo('App\Model\ConsumerUser' ,'consumer_user_id', 'id');
    }
}

?>