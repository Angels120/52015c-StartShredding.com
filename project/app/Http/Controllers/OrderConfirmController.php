<?php

namespace App\Http\Controllers;

use App\AddressMultiple;
use App\Cart;
use App\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderConfirmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:profile');
    }

    public function index()
    {
        $response = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'cart.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
            ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();

            $user = Clients::find(Auth::user()->id);

          $multiple_address = AddressMultiple::where('user_id', $user->id)
            ->where('address_alias',"Default")
            ->first();

        return view('order-confirm', compact('response', 'user','multiple_address'));
    }

    public function confirmed()
    {
        return view('order-confirmed');
    }
}
