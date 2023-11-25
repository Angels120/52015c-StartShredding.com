<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientStatus extends Model
{
    protected $table = 'client_status';
    protected $fillable = ['status'];
    public $timestamps = false;
}
