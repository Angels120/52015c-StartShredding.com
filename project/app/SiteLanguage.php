<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteLanguage extends Model
{
    protected $table = "site_language";
    protected $fillable = ['home','dashboard','blog','pickup_details','ship_to_another', 'update_profile','top_category', 'change_password', 'login_as', 'logout', 'description','enter_shipping', 'order_details', 'shipping_cost', 'order_now', 'submit', 'name', 'review_details','street_address', 'phone', 'email', 'fax','search_result', 'no_result', 'contact_us_today', 'filter_option', 'all_categories', 'load_more', 'sort_by_latest', 'sort_by_oldest', 'sort_by_highest', 'sort_by_lowest','featured_products', 'latest_products', 'popular_products', 'share_in_social', 'about_us', 'contact_us', 'faq', 'search', 'vendor', 'my_account', 'my_cart', 'view_cart', 'checkout', 'continue_shopping', 'proceed_to_checkout', 'empty_cart', 'product_name', 'unit_price', 'subtotal', 'total', 'quantity', 'add_to_cart', 'out_of_stock', 'available', 'reviews', 'related_products', 'return_policy', 'no_review', 'write_a_review', 'subscription', 'subscribe', 'sign_in', 'address', 'added_to_cart','view_details','quick_review'];
    public $timestamps = false;
}
