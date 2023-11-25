<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    protected $table = 'tax_rates';
    protected $fillable = ['tax_name', 'tax_rate'];
    public $timestamps = false;
}
