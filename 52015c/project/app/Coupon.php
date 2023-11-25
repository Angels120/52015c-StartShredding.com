<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Coupon extends Model
{
    protected $fillable = ['code', 'type', 'value', 'expiry_date', 'status'];

    public static $rules = [
        'code' => 'required|unique:coupons|max:10',
        'type' => 'required|in:fixed,percent',
        'value' => 'required|numeric',
        'expiry_date' => 'nullable|date',
        'status' => 'required',
    ];

    public static function findByCode ($code)
    {
        return self::where('code', $code);
    }

    public static function calculateDiscount ($coupon, $total)
    {
        if (!is_null($coupon->expiry_date)) {
            $today = new DateTime(date('Y-m-d'));
            $expiry_date = new DateTime($coupon->expiry_date);
            if ($today > $expiry_date) {
                session()->forget('coupon');
                return 0;
            }
        }

        if ($coupon->type == 'fixed') {
            return $coupon->value > $total ? $total : $coupon->value;
        } elseif ($coupon->type == 'percent') {
            return ($coupon->value / 100) * $total;
        } else {
            return 0;
        }
    }
}
