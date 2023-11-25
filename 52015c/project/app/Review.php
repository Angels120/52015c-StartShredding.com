<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['productid', 'name', 'email', 'review', 'rating', 'review_date'];
    public $timestamps = false;

    public static function ratings($productid){
        $stars = Review::where('productid',$productid)->avg('rating');
        $ratings = number_format((float)$stars, 1, '.', '')*20;
        return $ratings;
    }

    public static function reviewCount($productid){
        $total = Review::where('productid',$productid)->count();
        return $total;
    }
}
