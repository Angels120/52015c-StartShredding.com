<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zones extends Model
{
    protected $table = 'zones';
    protected $fillable = ['zone_category', 'zone_name','postal_codes'];
    public $timestamps = false;
}
