<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function deals()
    {
        return view('static.deals');
    }

    public function packages()
    {
        return view('static.packages');
    }

    public function locations()
    {
        return view('static.locations');
    }

    public function dropOff()
    {
        return view('static.drop-off');
    }

    public function requestPickup()
    {
        return view('static.request-pickup');
    }
    public function rewards()
    {
        return view('static.rewards');
    }
}
