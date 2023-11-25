<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class AddressMultiple extends Model
{
    public $table = "multiple_address";
    protected $fillable = [
        'address_alias', 'user_id', 'address', 'city','zip','province','street','longitude', 'latitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
