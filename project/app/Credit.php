<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = 'credits';
    protected $fillable = ['user_id', 'invoice_id', 'token', 'amount', 'status'];
}
