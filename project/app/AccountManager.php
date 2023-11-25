<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountManager extends Model
{
    protected $table = 'account_manager';
    protected $fillable = ['name', 'email'];
    public $timestamps = false;
}
