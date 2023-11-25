<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupRequests extends Model
{
    public $table = "pickup_requests";
    protected $fillable = [
        'vendor_id', 'order_id', 'order_product_id', 'created_at','updated_at','status'
    ];
}
