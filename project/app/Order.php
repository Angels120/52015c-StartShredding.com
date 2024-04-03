<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const REPEAT_ORDERS=3;
    protected $fillable = ['order_type','template_id','customerid', 'products', 'quantities', 'discount', 'discount_type', 'method', 'shipping', 'pickup_location', 'pay_amount', 'txnid', 'charge_id', 'order_number', 'payment_status', 'customer_email', 'customer_name', 'customer_phone', 'customer_address', 'customer_city', 'customer_zip', 'shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city', 'shipping_zip', 'order_note', 'booking_date', 'status','job_type', 'job_notes','job_status' ,'job_name','job_service_time','po_number'];


    public $timestamps = false;
    public static $withoutAppends = false;

    public function getProductsAttribute($products)
    {
        if (self::$withoutAppends) {
            return $products;
        }
        return explode(',', $products);
    }
    public function getQuantitiesAttribute($quantities)
    {
        if (self::$withoutAppends) {
            return $quantities;
        }
        return explode(',', $quantities);
    }
}
