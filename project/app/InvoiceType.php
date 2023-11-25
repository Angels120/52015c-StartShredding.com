<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceType extends Model
{
    protected $table = 'invoice_type';
    protected $fillable = ['type'];
    public $timestamps = false;
}
