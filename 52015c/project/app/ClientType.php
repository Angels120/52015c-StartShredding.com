<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    protected $table = 'client_type';
    protected $fillable = ['type'];
    public $timestamps = false;
}
