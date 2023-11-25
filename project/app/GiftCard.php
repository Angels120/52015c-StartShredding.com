<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    protected $fillable = ['title', 'description', 'purchase_price', 'credit_amount', 'status', 'code', 'expiry_date', 'image'];

    public static $rules = [
        'title' => 'required|max:191',
        'description' => 'required|max:600',
        'purchase_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        'credit_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        'is_deleted' => 'required',
        'status' => 'required',
        'code' => 'required|max:6',
        'expiry_date' => 'nullable|date'
    ];

    public function bought_gift_cards()
    {
        return $this->hasMany('App\BoughtGiftCard', 'gift_card_id');
    }
}
