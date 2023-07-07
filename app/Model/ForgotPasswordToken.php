<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class ForgotPasswordToken extends Model {

    protected $table = 'forgot_password_tokens';
    
    protected $fillable = [
        'user_id',
        'ip_address',
        'token',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    use SoftDeletes;
    
}