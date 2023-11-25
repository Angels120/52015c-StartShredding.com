<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderSummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:profile');
    }

    public function index()
    {
        $response = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'cart.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
            ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();

        return view('order-summary', compact('response'));
    }
}
