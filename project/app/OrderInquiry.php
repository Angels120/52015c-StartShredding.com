<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderInquiry extends Model
{
    protected $fillable = ['order_id', 'service_type', 'shredding_type', 'packing_container', 'quantity', 'additional_info', 'start_date','promo_code'];
}
