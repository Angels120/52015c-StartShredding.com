<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'category', 'tags', 'description','short_description','sizes', 'price', 'plant_cost', 'previous_price', 'stock', 'feature_image', 'policy', 'featured', 'views', 'created_at', 'updated_at', 'status','is_tiers','tiers'];

    public static $withoutAppends = false;


    public function getCategoryAttribute($category)
    {
        if (self::$withoutAppends) {
            return $category;
        }
        return explode(',', $category);
    }

    public static function Cost($id)
    {
        $product = Product::findOrFail($id);
        $fees = Settings::findOrFail(1);
        $finalcost = $product->price + (($fees->dynamic_commission / 100) * $product->price) + (($fees->tax / 100) * $product->price) + $fees->fixed_commission;
        return round($finalcost, 2);
    }

    public static function Filter($price)
    {
        $fees = Settings::findOrFail(1);
        $finalcost = $price - (($fees->dynamic_commission / 100) * $price) - (($fees->tax / 100) * $price) - $fees->fixed_commission;
        return ceil($finalcost);
    }

    public function fav_products ()
    {
        return $this->hasMany('App\ProductFav', 'product_id');
    }

    public static function getPriceById($id)
    {
        $product = Product::findOrFail($id);
        return round($product->price , 2);
    }

    public static function getShortDescriptionById($id)
    {
        $product = Product::findOrFail($id);
        return $product->short_description;
    }
}
