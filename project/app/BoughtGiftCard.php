<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoughtGiftCard extends Model
{
    protected $fillable = ['gift_card_id', 'bought_by_id', 'is_payment_completed', 'payment_id', 'payment_token', 'current_owner_id', 'is_redeemed', 'redeemed_by_id', 'is_gifted', 'auth_code'];

    public static $rules = [
        'gift_card_id' => 'required|exists:gift_cards,id',
        'bought_by_id' => 'required|exists:clients,id',
        'is_payment_completed' => 'required',
        'payment_id' => 'required',
        'payment_token' => 'required',
        'current_owner_id' => 'required|exists:clients,id',
        'is_redeemed' => 'required',
        'redeemed_by_id' => 'exists:clients,id',
        'is_gifted' => 'required',
        'auth_code' => 'required',
    ];

    public function gift_card()
    {
        return $this->belongsTo('App\GiftCard', 'gift_card_id', 'id');
    }

    public function bought_by()
    {
        return $this->belongsTo('App\Clients', 'bought_by_id');
    }

    public function current_owner()
    {
        return $this->belongsTo('App\Clients', 'current_owner_id');
    }

    public function redeemed_by()
    {
        return $this->belongsTo('App\Clients', 'redeemed_by_id');
    }
}
