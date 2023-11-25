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

class ClientOrderController extends Controller
{

    public function __construct()
    {
     //   $this->middleware('auth:profile');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_items = Product::orderBy('title')->get();
        return view('clientorder',compact('order_items'));
    }

    public function getAJAXProduct() {
      $product_id = Input::get('id');
        // $product_id = "453";
        $product = Product::where('id',$product_id)->first();
        echo json_encode($product);
    }

    public function getAJAXProductname() {
      $product_id = Input::get('id');
        // $product_id = "453";
        $product = Product::select('title')->where('id',$product_id)->first();
        echo json_encode($product);
    }

    public function ClientorderAdd(Request $request)
    {

      // step 1
      $address = $request->input('address');
      $street_no = $request->input('street_no');
      $add_street = $address.',street-'.$street_no;
      $unit = $request->input('unit');
      $province = $request->input('state');
      $city = $request->input('city');
      $zip = $request->input('zip');
      $country = $request->input('country');

      // step 2
      $product_Arr = $request->input('cmb_order_item');
      $product = implode(',',$product_Arr);
      $quantitie = array_sum($request->input('txt_qty'));
      $qty_Arr = $request->input('txt_qty');
      $base_price = $request->input('hf_base_price');
      $grandtotal = $request->input('hf_grandtotal');

      //  step 3
      $company = $request->input('company');
      $firstname = $request->input('firstname');
      $lastname = $request->input('lastname');
      $email = $request->input('email');
      $phone = $request->input('phone');
      $pass = $request->input('password');
      $password = Hash::make($pass);




      if ($pass == "") {
           return redirect()->back()->withErrors(['password' => 'The Password field is required.']);
       }

       $client_id = DB::table('clients')
          ->insertGetId(array(
            /* step 1 */
          'ADDRESS' => $add_street,
          'CITY' => $city,
          'zip' => $zip,
          'unit_no' => $unit,
          // 'Province'=> $province, // store only integer value
          'country' => $country,

          /* step 3 */
          'password' => $password,
          'BUSINESS_NAME'=>$company,
          'first_name' => $firstname,
          'last_name' => $lastname,
          'EMAIL' => $email,
          'phone' => $phone,
          'password' => $password,

          'latitude' => '43.615503',
          'longitude' => '-79.526231',
          'balance' => isset($data['balance']) ? $data['balance'] : 0,
         ));

         $token = Str::random(30);
         $store_token = DB::table('user_activations')
            ->insertGetId(array(
            'id_user' => $client_id,
            'token' => $token,
           ));


      $orders_id = DB::table('orders')
      ->insertGetId(array(
        'customerid' => $client_id,
        'products' => $product,
        'quantities' => $quantitie,
        'pay_amount' => $grandtotal,
      ));

      foreach ($product_Arr as $key => $value) {
        DB::table('ordered_products')
        ->insert(array(
          'productid' => $value,
          'quantity' => $qty_Arr[$key],
          'orderid' => $orders_id,
          'cost' => $base_price[$key],
        ));
      }

      $name = $firstname." ".$lastname;
      $usertoken =  $token;
      // Client email
      try {
              Mail::to($email)->send(new ClientOrderPlaced($name ,$usertoken));
          } catch (\Exception $e) {
                return $e->getMessage();
          }


      return redirect('clientorder')->with('flash_message', 'Your order added successfully Please check your email.');

    }

    function user_activate(Request $request){
              $token = $request->takn;
              $ord_id = $request->ord_id;

              if ($token != "")
                  {
                    $find_user = DB::table('user_activations')->where('token',$token)->first();
                   $chk_user_pass = DB::table('clients')->where('id',$find_user->id_user)->first();
                    Session::put('user_id', $find_user->id_user);
                    Session::put("ord_id",$ord_id);

                    if ($token == $find_user->token) {
                      DB::table('clients')
                          ->where('id', $find_user->id_user)
                          ->update(['is_activated' => '1']);

                          if ($chk_user_pass->password != "") {
                              return redirect()->to('/newclientorderconfirm');
                          }else {
                            return view('login_pass');
                        }
                    }else {
                      echo "User Not Found";
                    }
                }
               
    }
    function client_user_activate(Request $request){

      $token = $request->takn;
      if ($token != "")
          {
            $find_user = DB::table('user_activations')->where('token',$token)->first();
            $chk_user_pass = DB::table('clients')->where('id',$find_user->id_user)->first();
            if ($token == $find_user->token) {
              DB::table('clients')
                  ->where('id', $find_user->id_user)
                  ->update(['is_activated' => '1']);
                      return redirect()->to('/user-dashboard');
            }else {
              echo "User Not Found";
            }
        }
    }
    function vendor_user_change_pass(Request $request){

      $u_id = Session::get('user_id');
      $pass = $request->input('password');
      $password = Hash::make($pass);
      DB::table('clients')
              ->where('id',$u_id)
              ->update(['password' => $password]);

      return redirect()->to('/newclientorderconfirm')->with(['success' => 'Password Set successfully!']);

    }

    function orders_details_mail($id){

      $order = Order::findOrFail($id);
      $ord_id=$id;
      if($order!=null){
      }
          $user_data = DB::table('clients')->where("id",$order->customerid)->get();
          $order_details =DB::table('ordered_products')->where("orderid",$id)->get();
          $email = $user_data[0]->EMAIL;
          $token = Str::random(30);
          $store_token = DB::table('user_activations')
             ->insert(array(
             'id_user' => $user_data[0]->id,
             'token' => $token,
            ));

          try {
              Mail::to($email)->send(new OrderConfirm($user_data ,$order_details,$order,$token,$ord_id));
          } catch (\Exception $e) {
                    return $e->getMessage();
              }
    return redirect()->to('vendor/orders')->with(['message' => 'Email Send successfully!']);
  }
  
}
