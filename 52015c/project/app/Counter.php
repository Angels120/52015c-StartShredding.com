<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $table = 'counter';

    protected $fillable = ['referral', 'total_count', 'todays_count', 'today'];

    public $timestamps = false;
}
