<?php

namespace App\Http\Controllers;

use App\AddressMultiple;
use App\Credit;
use App\Order;
use App\Transactions;
use App\Clients;
use App\ProductFav;
use App\Product;
use App\Category;
use App\Mail\PromoRegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Session;
use Session;

class UserDetailController extends Controller
{
    public function __construct()
    {
        Session::put('tab', 'account_info');
        $this->middleware('auth:profile', ['except' => 'checkout', 'cashondelivery']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Clients::find(Auth::user()->id);
        $orders = Order::where('customerid', Auth::user()->id)->orderBy('booking_date', 'desc')->get();
       /* $credits_details = Credit::where('user_id', Auth::user()->id)->orderBy('id', 'desc')
            ->where('status', '=', 1)
            ->get();*/
        $credits_details = Transactions::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')
            ->get();
        //return $credits_details;
        return view('new_pages.user_dashboard', compact('user', 'orders', 'credits_details'));
    }

    //get user details
    public function accinfo()
    {
        $user = Clients::find(Auth::user()->id);
        $multiple_address = AddressMultiple::where('user_id', Auth::user()->id)->get();
        return view('new_pages.user_account_address', compact('user', 'multiple_address'));
    }

    //udate user details
    public function updateDetails(Request $request, $id)
    {
        Session::put('tab', 'account_info');
        $user = Clients::findOrFail($id);
        $input = $request->all();
        $user->update($input);
        return redirect()->back()->with('message', 'Account Information Updated Successfully.');
    }
    //user password change
    public function passChange(Request $request, $id)
    {
        //return $request;
        Session::put('tab', 'change_pass');
        $user = Clients::findOrFail($id);
        if ($request->oldpass) {
            if (Hash::check($request->oldpass, $user->password)) {

                if ($request->newpass == $request->renewpass) {

                    $input['password'] = Hash::make($request->newpass);
                } else {
                    Session::flash('error', 'Confirm Password Does not match.');
                    return redirect()->back();
                }
            } else {
                Session::flash('error', 'Current Password Does not match');
                return redirect()->back();
            }
        }
        $user->update($input);
        return redirect()->back()->with('message', 'Account Password Updated Successfully.');
    }
    //Add fav to table
    public function addFav(Request $request)
    {
        $user = Auth::guard('profile')->user();
        $products_fav = ProductFav::where('product_id', $request->product_id)
            ->where('user_id', $user->id)
            ->first();
        if (isset($products_fav)) {
            if ($products_fav->status == 1) {
                $products_fav->status = 0;
                $products_fav->save();
            } else {
                $products_fav->status = 1;
                $products_fav->save();
            }
        } else {
            $user = Clients::find(Auth::user()->id);
            $product_fav = new ProductFav;
            $product_fav['user_id'] = $user->id;
            $product_fav['product_id'] = $request->product_id;
            $product_fav['status'] = 1;

            $product_fav->save();
        }


        return response()->json(['msg' => "Sucessfully Added to Favourite"]);
    }
    //view product favourite page
    public function getFavProduct()
    {
        $uniqueid = Session::get('uniqueid');
        $user = Auth::guard('profile')->user();
        $categories = Category::select('id','name')->get();
        return view('new_pages.user_favourites', compact('uniqueid', 'user', 'categories'));
    }

    public function getFavProductAPI()
    {
        try {
            $user = Auth::guard('profile')->user();
            $limit = !empty($_GET['limit']) && intval($_GET['limit']) > 0 ? intval($_GET['limit']) : null;
            $page = !empty($_GET['page']) ? intval($_GET['page']) : 0;
            $search = !empty($_GET['search']) && $_GET['search'] !== "undefined" ? strtolower($_GET['search']) : null;

            if (is_null($limit)) {
                if (is_null($search)) {
                    $fav_products = ProductFav::with('product')
                        ->where('user_id', $user->id)
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->get();
                } else {
                    $fav_products = ProductFav::with('product')
                        ->where('user_id', $user->id)
                        ->where('status', 1)
                        ->where('products.title', 'LIKE', "%{$search}%")
                        ->orderBy('created_at', 'desc')
                        ->get();
                }
            } else {
                if (is_null($search)) {
                    $fav_products = ProductFav::with('product')
                        ->where('user_id', $user->id)
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->offset($page)
                        ->limit($limit)
                        ->get();
                } else {
                    $fav_products = ProductFav::with('product')
                        ->where('user_id', $user->id)
                        ->where('status', 1)
                        ->where('products.title', 'LIKE', "%{$search}%")
                        ->orderBy('created_at', 'desc')
                        ->offset($page)
                        ->limit($limit)
                        ->get();
                }
            }
            return json_encode(["error" => false, "data" => $fav_products]);
        } catch (Exception $e) {
            error_log(json_encode($e));
            return json_encode(["error" => true]);
        }
    }

    public function removeFavProductAPI($id)
    {
        try {
            if($this->productFavouriteRemove($id)) {
                return json_encode(["error" => false]);
            } else {
                return json_encode(["error" => true]);
            }
        } catch (Exception $e) {
            error_log(json_encode($e));
            return json_encode(["error" => true]);
        }
    }

    // //view user orders page
    // public function getOrders()
    // {
       
    //     return view('new_pages.user_orders');
    // }

    public function getOrders()
    {
        $user = Clients::find(Auth::user()->id);
        $orders = Order::where('customerid', Auth::user()->id)->orderBy('booking_date', 'desc')->get();
       /* $credits_details = Credit::where('user_id', Auth::user()->id)->orderBy('id', 'desc')
            ->where('status', '=', 1)
            ->get();*/
        $credits_details = Transactions::where('user_id', Auth::user()->id)->orderBy('id', 'desc')
            ->get();
        return view('new_pages.my_orders', compact('user', 'orders', 'credits_details'));
    }

    //remove product favourite
    public function productFavouriteRemove($id)
    {
        $product_fav = ProductFav::where('id', $id)->first();
        $product_fav->status = 0;
        $product_fav->save();
        return redirect()->back()->with('message', 'Favourite Product Remove Successfully.');
    }
    //Add multiple address
    public function addMultipleAddress(Request $request, $id)
    {
        Session::put('tab', 'saved_address');
        $address_multiple = new AddressMultiple;
        $address_multiple->fill($request->all());
        $address_multiple->user_id = $id;
        $address_multiple->save();

        return redirect()->back()->with('message1', 'Address Added Successfully.');
    }
    //remove multiple address
    public function multipleAddressRemove($id)
    {
        Session::put('tab', 'saved_address');
        $address_multiple = AddressMultiple::find($id);
        $address_multiple->delete();

        return redirect()->back()->with('message1', 'Address Remove Successfully.');
    }
    //edit multiple address
    public function multipleAddressEdit($id)
    {
        Session::put('tab', 'saved_address');
        $user = Clients::find(Auth::user()->id);
        $multiple_address = AddressMultiple::where('user_id', Auth::user()->id)->get();
        $edit_address = AddressMultiple::find($id);
        return view('new_pages.user_address_edit', compact('user', 'multiple_address', 'edit_address'));
    }
    //update multiple address
    public function updateMultipleAddress(Request $request, $id)
    {
        Session::put('tab', 'saved_address');
        if ($request->address == '') {
            $update_address = AddressMultiple::find($id);
            if ($request->address_alias == '') {
                $update_address->address_alias = "Default";
            } else {
                $update_address->address_alias = $request->address_alias;
            }

            $update_address->save();
        } else {
            $update_address = AddressMultiple::find($id);
            $input = $request->all();
            $update_address->update($input);
        }


        return redirect()->route('user.account-details');
    }
    //get order details page
    public function userOrderDetails($id)
    {
        $user = Clients::find(Auth::user()->id);

        $order = Order::findOrFail($id);
        $multiple_address = AddressMultiple::where('user_id', Auth::user()->id)
            ->where('address_alias','=','Default')
            ->first();
        return view('new_pages.order-details',compact('user','order','multiple_address'));
    }
    //user search
    public function searchData(Request $request)
    {
        if($request->data!=""){
            $products = Product::where('title', 'like', '%' . $request->data . '%')
                ->get();

            $orders = Order::where('customerid', Auth::user()->id)
                ->where('order_number', 'like', '%' . $request->data . '%')
                ->get();
        }
        
    
        return response()->json(['product' => $products, 'orders'=>$orders]);
    }

    public function referFriend()
    {
        return view('new_pages.refer-friend');
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
        //
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

    public function sendReferMail(Request $request)
    {      
        $referal_link = $request->link;
        $email = $request->email;
        $email_subject = \App\Models\EmailSubject::where('token','=','G9qRHuKU')
                                                ->first();
        $template = \App\Models\EmailTemplate::where('subject_id','=',$email_subject->id)->first();

        if(isset($referal_link) && isset($email))
        {
            $user = Auth::guard('profile')->user();
            try
            {
                \Illuminate\Support\Facades\Mail::to($email)->send(new PromoRegistrationMail($referal_link, $email_subject->subject, $template, $user->first_name, $user->last_name));

               \Illuminate\Support\Facades\Session::flash('status_type', "success");
                \Illuminate\Support\Facades\Session::flash('status', "Email sent Successfully !");
                return redirect()->back()->with('message_success','Email Sent Successfully !');
            }
            catch(Exception $e)
            {
                \Illuminate\Support\Facades\Session::flash('status_type', "danger");
                \Illuminate\Support\Facades\Session::flash('status', "Email didn't send !");
                return redirect()->back()->with('message_fail','Email didn\'t Send !');
            }
            
        }
        else{
            \Illuminate\Support\Facades\Session::flash('status_type', "danger");
             \Illuminate\Support\Facades\Session::flash('status', "Email didn\'t Send !");
             return redirect()->back()->with('message_fail','Email didn\'t Send !');
        }
            
    }
}
