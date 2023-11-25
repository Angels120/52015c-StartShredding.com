<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZipCodes extends Model
{
    protected $table = 'zip_codes';
    protected $fillable = ['zip_code', 'primary_city','state'];
    public $timestamps = false;
}
