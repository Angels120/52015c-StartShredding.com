<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use App\Review;
use App\Settings;
use App\Clients;
use App\PickUpLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:profile',['except' => 'checkout','cashondelivery']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Clients::find(Auth::user()->id);
        $orders = Order::where('customerid', Auth::user()->id)->orderBy('id','desc')->take(15)->get();
        return view('account',compact('user','orders'));
    }

    public function accinfo()
    {
        $user = Clients::find(Auth::user()->id);
        return view('accountedit',compact('user'));
    }

    public function userchangepass()
    {
        $user = Clients::find(Auth::user()->id);
        return view('userchangepass',compact('user'));
    }

    public function userorders()
    {
        $user = Clients::find(Auth::user()->id);
        $orders = Order::where('customerid', Auth::user()->id)->orderBy('id','desc')->get();
        return view('userorders',compact('user','orders'));
    }

    public function userorderdetails($id)
    {
        $user = Clients::find(Auth::user()->id);
        $order = Order::findOrFail($id);
        return view('orderdetails',compact('user','order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    //Submit Review
    public function checkout()
    {
    	    $pickups = PickUpLocations::all();
            $product = 0;
            $quantity = 0;
            $sizes = 0;
            $settings = Settings::findOrFail(1);
            $carts = Cart::where('uniqueid',Session::get('uniqueid'));
            $cartdata = $carts->get();
            if($carts->count() > 0){
                $total = $carts->sum('cost') + $settings->shipping_cost;
                foreach ($carts->get() as $cart){
                    if ($product==0 && $quantity==0){
                        $product = $cart->product;
                        $quantity = $cart->quantity;
                        $sizes = $cart->size;
                    }else{
                        $product = $product.",".$cart->product;
                        $quantity = $quantity.",".$cart->quantity;
                        $sizes = $sizes.",".$cart->size;
                    }
                }
                return view('checkout',compact('product','sizes','quantity','total','cartdata','user','pickups'));
            }

        return redirect()->route('user.cart')->with('message','You don\'t have any product to checkout.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Clients::findOrFail($id);
        $input = $request->all();
        $user->update($input);
        return redirect()->back()->with('message','Account Information Updated Successfully.');

    }

    public function passchange(Request $request, $id)
    {
        $user = Clients::findOrFail($id);
        $input = "";
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){

                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('error', 'Confirm Password Does not match.');
                    return redirect()->back();
                }
            }else{
                Session::flash('error', 'Current Password Does not match');
                return redirect()->back();
            }
        }
        $user->update($input);
        return redirect()->back()->with('message','Account Password Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
