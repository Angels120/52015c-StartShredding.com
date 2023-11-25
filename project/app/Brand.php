<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand_banner';
    protected $fillable = ['type', 'image', 'link', 'status'];
    public $timestamps = false;
}
