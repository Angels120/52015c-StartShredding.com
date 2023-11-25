<?php

namespace App\Http\Controllers;

use App\Counter;
use App\OrderedProducts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days = "";
        $sales = "";
        for($i = 0; $i < 30; $i++) {
            $days .= "'".date("d M", strtotime('-'. $i .' days'))."',";

            $sales .=  "'".OrderedProducts::whereDate('created_at', '=', date("Y-m-d", strtotime('-'. $i .' days')))->sum('quantity')."',";
        }

        $referrals = Counter::where('type','referral')->orderBy('total_count','desc')->take(5)->get();
        $browsers = Counter::where('type','browser')->orderBy('total_count','desc')->take(5)->get();
        return view('admin.dashboard',compact('referrals','browsers','days','sales'));
    }
}
