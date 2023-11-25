<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';
    protected $fillable = ['user_id', 'token','created_at', 'expired_at'];
    public $timestamps = false;
}
