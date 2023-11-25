<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendors extends Authenticatable
{
    use Notifiable;
    protected $table = "vendor_profiles";
    protected $fillable = [
        'name', 'gender', 'email', 'shop_name', 'photo', 'remember_token', 'phone', 'password', 'fax', 'address', 'city', 'zip', 'current_balance','tax_rate','shipping_fee','late_fee','discount','pickup_fee','minimum_order','zone','plant','account_manager','delivery_service','start_time','end_time','notes', 'status', 'created_at', 'updated_at', 'is_activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
}
