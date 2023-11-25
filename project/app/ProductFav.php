<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFav extends Model
{
    protected $table = 'fav_products';
    protected $fillable = ['id', 'product_id', 'user_id', 'orders', 'status'];

    public function product ()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
