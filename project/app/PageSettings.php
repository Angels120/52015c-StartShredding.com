<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageSettings extends Model
{
    protected $table = "page_settings";

    protected $fillable = ['contact', 'contact_email', 'about', 'faq','large_banner', 'banner_link', 'c_status', 'a_status', 'f_status','slider_status', 'category_status', 'sbanner_status', 'latestpro_status', 'featuredpro_status', 'lbanner_status', 'popularpro_status', 'blogs_status', 'testimonial_status', 'brands_status', 'subscribe_status'];

    public $timestamps = false;

//    public function getA_statusAttribute($data)
//    {
//        if ($data == 1){
//            $check = "checked";
//        }
//        else{
//            $check = "";
//        }
//        return $check;
//    }
}
