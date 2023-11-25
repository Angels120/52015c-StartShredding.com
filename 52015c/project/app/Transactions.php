<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'trasactions';
    protected $fillable = ['user_id', 'reference_id	','type', 'type_id','amount','created_at','updated_at'];
}
