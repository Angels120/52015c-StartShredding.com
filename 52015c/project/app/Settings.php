<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public $table = "settings";
    protected $fillable = ['id', 'logo','delivery_fee', 'favicon', 'title', 'url', 'about', 'address', 'phone', 'fax', 'email', 'footer', 'background', 'theme_color', 'withdraw_fee', 'withdraw_charge', 'paypal_business', 'shipping_cost', 'stripe_key', 'stripe_secret', 'mobile_money', 'bank_wire', 'dynamic_commission', 'tax', 'fixed_commission', 'currency_sign', 'currency_code', 'popular_tags', 'css_file', 'stripe_status', 'paypal_status', 'mobile_status', 'bank_status', 'cash_status'];
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
}
