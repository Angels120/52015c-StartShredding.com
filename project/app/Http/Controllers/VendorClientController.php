<?php

namespace App\Http\Controllers;
use App\Product;
use App\Order;
use App\Clients;
use App\AddressMultiple;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientOrderPlaced;
use App\Mail\OrderConfirm;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
// use App\Clients;

class VendorClientController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:profile');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$id=196;
       $u_id = Session::get('user_id');
       $id = Session::get("ord_id");
       $uniqueid=str_random(7);
       Session::put('uniqueid', $uniqueid);
       $pdata=DB::select("select * from ordered_products where orderid=".$id."");
        foreach ($pdata as $data) {
          $productdet = Product::findOrFail($data->productid);
          $cartd = new Cart;
          $cartd['uniqueid'] = $uniqueid;
          $cartd['product'] = $data->productid;
          $cartd['title'] = $productdet->title;
          $cartd['quantity'] = $data->quantity;
          $cartd['cost'] = $data->cost;
          $cartd->save();
        }
        $responsedet = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'cart.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
        ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', $uniqueid)->get();

        if (Auth::check())
        {
          $user = Clients::find(Auth::id());
        }
        $multiple_address = AddressMultiple::where('user_id', $user->id)
        ->where('address_alias',"Default")
        ->first();
         return view('new-order-confirm', compact('responsedet', 'user','multiple_address'));
    }
}
