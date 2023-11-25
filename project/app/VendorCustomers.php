<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorCustomers extends Model
{
    protected $table = 'vendor_customers';
    protected $fillable = ['vendor_id', 'customer_id', 'phone', 'name', 'business_name', 'status'];
    public $timestamps = false;
}
