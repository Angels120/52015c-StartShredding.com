<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickUpLocations extends Model
{
    protected $table = "pickup_locations";
    protected $fillable = ['pickup_name','pickup_address','pickup_city','pickup_state','pickup_postal_code','status'];
    public $timestamps = false;
}
