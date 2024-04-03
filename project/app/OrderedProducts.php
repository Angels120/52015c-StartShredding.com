<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedProducts extends Model
{
    public $table = "ordered_products";
    protected $fillable = [
        'orderid', 'owner', 'vendorid', 'productid','paid','payment', 'quantity', 'cost', 'created_at', 'updated_at', 'size', 'status'
    ];
    public static $withoutAppends = false;

    public function getProductidAttribute($productid)
    {
        if(self::$withoutAppends){
            return $productid;
        }
        $products=Product::where('id',$productid)->first();
        return (isset($products))?$products:'';
    }




}
