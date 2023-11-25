<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCreditCard extends Model
{
    protected $table = 'client_credit_card';
    protected $fillable = ['id', 'customerid', 'card_holder_name', 'card_number', 'exp_month', 'exp_year','ccv',];
    public $timestamps = false;
	
	public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    function maskNum()
    {
        return str_repeat('*', strlen(preg_replace('/\D/', '', $this->card_number)) - 4)
            .substr($this->card_number, -4);
    }
}
