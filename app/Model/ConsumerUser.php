<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ConsumerUser extends Authenticatable
{

    protected $table = 'consumer_users';
    public $timestamps = true;

    protected $fillable = [
        'uuid',
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'contact_number',
        'user_type',
        'email_verified',
        'password_changed',
        'email_verified_token',
        'password_changed_token'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;

        function socialProviders()
    {
        return $this->hasMany('App\Model\SocialProvider' ,'consumer_user_id' , 'id');
    }
}
