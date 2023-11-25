<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class GiftCode extends Model
{
    protected $fillable = ['code', 'first_name', 'last_name', 'sender_message', 'sender_email', 'credit_amount', 'recipient_emails', 'count', 'expire_date'];

    public static $rules = [
        'code' => 'required|max:6',
        'first_name' => 'required|max:191',
        'last_name' => 'required|max:191',
        'sender_message' => 'required|max:600',
        'sender_email' => 'email',
        'credit_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        'recipient_emails' => 'email',
        'count' => 'required|numeric',
        'expire_date' => 'required',
    ];

    public static function codeValidation ($code) {
        $giftcode = self::where('code', $code)->first();

        if (is_null($giftcode)) {
            return ["error" => true, "msg" => "Invalid gift code."];
        }

        $date = new DateTime('now');
        if ($giftcode['expire_date'] < $date->format('Y-m-d')) {
            return ["error" => true, "msg" => " Gift code has been expired."];
        }

        return ["error" => false, "data" => $giftcode];
    }
}
