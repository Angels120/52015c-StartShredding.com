<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getUserBilling()
    {
        return view('new_pages.user_billing_setting');
    }

    public function getUserAccountAddress()
    {
        return view('new_pages.user_account_address');
    }
    public function getUserFavourites()
    {
        return view('new_pages.user_favourites');
    }

}
