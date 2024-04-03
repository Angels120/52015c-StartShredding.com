<?php

namespace App\Http\Controllers;

use App\OrderInquiry;
use Auth;
use App\Coupon;
use App\AddressMultiple;
use App\Clients;
use App\UserProfile;
use App\Mail\QuoteRequestMail;
use App\Mail\ShopOrderPlaced;
use App\Mail\ShopOrderPlacedAdmin;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\Order;
use App\Cart;
use App\Settings;
use App\UserUsedCoupons;
use App\OrderedProducts;
use App\Product;
use Faker\Provider\Address;
use PDF;
use App\Transactions;
use App\PasswordReset;
use App\ReferralLink;
use App\VendorCustomers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DateTime;
use App\Mail\UserPassResetShopMail;
use App\Mail\QuoteRequestVendorMail;

class IndexController extends Controller
{
    public function showHome()
    {
        return view('home.index');
    }

    public function saveAddress(Request $request)
    {
        Session::put('shop_country', $request->country);
        Session::put('street_no', $request->street);
        Session::put('address', $request->address);
        Session::put('city', $request->city);
        Session::put('province', $request->province);
        Session::put('zip', $request->zip);
        Session::put('lontude', $request->lontude);
        Session::put('latitude', $request->latitude);
        Session::put('fullAddress', $request->fullAddress);
    }


    public function showCustomersPage()
    {
        $products = Product::where('vendorid', 43)
            ->where('approved', 'yes')
            ->whereIn('category', [84])
            ->orderBy('id', 'ASC')
            ->get();
        return view('home.customers', compact('products'));
    }

    public function showProductPage($id)
    {

        $products = Product::where('id', $id)
            ->where('approved', 'yes')
            ->whereIn('category', [84])
            ->orderBy('id', 'ASC')
            ->first();

            $quantity = 0;    
        $cartItem = Cart::where('uniqueid', Session::get('uniqueid'))->where('product', $id)->first();
        if ($cartItem != null) {
            $quantity = $cartItem->quantity;
        }

        return view('home.product', compact('products', 'quantity'));
    }


    public function showRequestQuote()
    {
        return view('home.quote_request.quote_request');
    }

    public function submitQuote(Request $request)
    {
        if ($request->standard_file_boxes != '') {
            $qty = $request->standard_file_boxes;
            $container_type = 'Standard File Boxes';
        }
        if ($request->garbage_bags) {
            $qty = $request->garbage_bags;
            $container_type = 'Garbage Bags';
        }
        if ($request->pallets) {
            $qty = $request->pallets;
            $container_type = 'Pallets';
        }

        $data = array(
            'address' => $request->address,
            'street_no' => $request->street_no,
            'unit' => $request->unit,
            'state' => $request->state,
            'service_type_RB' => $request->service_type_RB,
            'city' => $request->city,
            'zip' => $request->fsa1 . " " . $request->fsa2,
            'service_type' => $request->service_type,
            'qty' => $qty,
            'container_type' => $container_type,
            'service_preference' => $request->service_preference,
            'notes' => $request->notes,
            'idealstart_date' => $request->idealstart_date == '' ? 'NOW' : $request->idealstart_date,
            'specificpost_date' => $request->specificpost_date,
            'am_pm' => $request->am_pm,
            'company' => $request->company,
            'fname' => $request->firstname,
            'lname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'promocode' => ($request->validpromocode) ? $request->promocode : '',
        );

        $user = Clients::where('email', $request->email)->get();

        if ($user->count() < 1) {
            $user = Clients::create([
                'name' => $request->firstname . " " . $request->lastname,
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'phone' => $request->phone,
                'balance' => 0,
                'email' => $request->email,
                'password' => Hash::make("user123"),
                'address' => $request->address,
                'city' => $request->city,
                'Province_State' => $request->state,
                'Country' => $request->country,
                'fsa1' => $request->fsa1,
                'fsa2' => $request->fsa2,
                'zip' => $request->fsa1 . "" . $request->fsa2,
                'longitude' => $request->lontude,
                'latitude' => $request->latude,
                'unit_no' => $request->unit,
                'is_activated' => 0,
                'status' => 1,
                'business_name' => $request->company,
                'special_notes' => $request->notes,
            ]);

            VendorCustomers::create([
                'vendor_id' => 43,
                'customer_id' => $user->id,
                'phone' => $request->phone,
                'name' => $request->firstname . " " . $request->lastname,
                'business_name' => $request->company,
                'status' => 1,
            ]);

            AddressMultiple::create([
                'user_id' => $user->id,
                'address_alias' => "Default",
                'address' => $request->address,
                'city' => $request->city,
                'zip' => $request->fsa1 . "" . $request->fsa2,
                'province' => $request->state,
                'street' => $request->street_no,
                'longitude' => $request->lontude,
                'latitude' => $request->latude,
            ]);


        } else {
            $user = $user[0];
        }

        $item_number = str_random(4) . time();
        $order = Order::create([
            'order_type' => 3,
            'customerid' => $user->id,
            'quantities' => $request->quantity,
            'payment_status' => "Pending",
            'order_number' => $item_number,
            'customer_email' => $request->email,
            'customer_name' => $request->firstname . " " . $request->lastname,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'customer_city' => $request->city,
            'customer_zip' => $request->fsa1 . "" . $request->fsa2,
            'order_note' => $request->notes,
            'booking_date' => Carbon::now(),
            'status' => "scheduled"
        ]);


        OrderedProducts::create([
            'orderid' => $order->id,
            'owner' => 'admin',
            'vendorid' => 43,
            'productid' => 0,
            'quantity' => $request->quantity,
            'payment' => "pending",
            'cost' => 0

        ]);

        if ($request->idealstart_date == 'SPECIFIC') {
            $date = 'SPECIFIC ' . $request->specificpost_date . ' (' . $request->am_pm . ')';
        } elseif ($request->idealstart_date == 'NOW' || $request->idealstart_date == '') {
            $date = 'NOW';
        } else {
            $date = 'FLEXIBLE';
        }

        OrderInquiry::create([
            'order_id' => $order->id,
            'service_type' => $request->service_type,
            'shredding_type' => $request->service_preference,
            'packing_container' => $container_type,
            'quantity' => $qty,
            'additional_info' => $request->notes,
            'start_date' => $date,
            'promo_code' => $data['promocode']
        ]);


        $EmailSubject = EmailSubject::where('token', 'k7hjc7hl')->first();
        $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();
        Mail::to($user->email)->queue(new QuoteRequestMail($data, $order->id, $EmailSubject['subject'], $EmailTemplate));

        $EmailSubject = EmailSubject::where('token', 'dsk41ghf')->first();
        $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();
        Mail::to("info@startshredding.com")->queue(new QuoteRequestVendorMail($data, $order->id, $EmailSubject['subject'], $EmailTemplate));

        return view('home.quote_request.quote_welcome', compact('order'));
    }

    // public function applyCoupon(Request $request)
    // {
    //     $arr = array();
    //     $coupon = Coupon::where('code', $request->promocode)->first();
    //     if (!$coupon) {
    //         $arr['message'] = '<div class="alert alert-warning" role="alert">Invalid coupon code. Please try again.</div>';
    //         $arr['status'] = 0;
    //         return $arr;
    //     }

    //     if (!$coupon->status) {
    //         $arr['message'] = '<div class="alert alert-warning" role="alert">Coupon has been deactivated.</div>';
    //         $arr['status'] = 0;
    //         return $arr;
    //     }
    //     $today = new DateTime(date('Y-m-d'));
    //     $expiry_date = new DateTime($coupon->expiry_date);

    //     if ($today > $expiry_date) {
    //         $arr['message'] = '<div class="alert alert-warning" role="alert">Coupon has expired.</div>';
    //         $arr['status'] = 0;
    //         return $arr;
    //     }

    //     $arr['message'] = '<div class="alert alert-success" role="alert">Coupon has been applied.</div>';
    //     $arr['status'] = 1;
    //     return $arr;
    // }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return Redirect::back()->withErrors('Invalid coupon code. Please try again.');
        }

        if (!$coupon->status) {
            return Redirect::back()->withErrors('Coupon has been deactivated.');
        }

        $today = new DateTime(date('Y-m-d'));
        $expiry_date = new DateTime($coupon->expiry_date);

        if ($today > $expiry_date) {
            return Redirect::back()->withErrors('Coupon has expired.');
        }

        session()->put('coupon', $coupon);

        return Redirect::back()->with('message', 'Coupon has been applied.');
    }

    public function removeCoupon(Request $request)
    {
        session()->forget('coupon');
        return Redirect::back()->with('message', 'Coupon has been removed.');
    }

    public function user()
    {
        return view('home.shop.login');
    }

    public function showRegistrationForm()
    {
        return view('home.shop.registerUser');
    }

    public function login(Request $request)
    {
        if (Auth::guard('profile')->attempt(['email' => $request->email, 'password' => $request->password, 'is_activated' => 1], false)) {
            if ($request->has('page')) {
                $user = Clients::where('email', $request->email)->first();
                Session::put('user_id', $user->id);
                return redirect()->route('home.confirm');
            }
            return redirect()->intended(url('/'));
        }
        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username()))
            ->withErrors($errors);
    }

    public function username()
    {
        return 'email';
    }

    public function register(Request $request)
    {
        $validGiftCode = null;
        if ($request->has('signup_code')) {
            $ReferralLink = ReferralLink::whereCode($request->input('signup_code'))->first();
            if (!$ReferralLink) {
                \Illuminate\Support\Facades\Session::flash('status_type', "danger");
                \Illuminate\Support\Facades\Session::flash('status', "Referral code is invalid");
                return redirect()->back()
                    ->with('message', 'Referral code is invalid !')
                    ->withInput();
            } else {
                $referals_count = $ReferralLink->relationships->count();
                $referal_limit = $ReferralLink->program->limit;
                if ($referals_count >= $referal_limit) {
                    \Illuminate\Support\Facades\Session::flash('status_type', "danger");
                    \Illuminate\Support\Facades\Session::flash('status', "Referral code expired");
                    return redirect()->back()
                        ->with('message', 'Referral code expired !')
                        ->withInput();
                }
            }
        }

        if ($request->has('giftcode')) {
            $va = GiftCode::codeValidation($request->input('giftcode'));
            if ($va["error"]) {
                return redirect()->back()
                    ->with('message', $va["msg"])
                    ->withInput();
            } else {
                try {

                    $GiftCode = GiftCode::where('code', $request->input('giftcode'))->first();
                    // dd($GiftCode, $request->all());
                    $UserProfile = Clients::orderBy('id', 'desc')->first();

                    $GiftCard = new GiftCard();
                    $GiftCard->code = $GiftCode['code'];
                    $GiftCard->title = 'GiveAway ' . str_random(3);
                    $GiftCard->description = 'Giveaway Gift Card ' . $GiftCard->title;
                    $GiftCard->expiry_date = null;
                    $GiftCard->image = 'yuIv5m47TV.jpg';
                    $GiftCard->purchase_price = 25.00;
                    $GiftCard->credit_amount = 25.00;
                    $GiftCard->type = 2;
                    $GiftCard->status = 1;
                    $GiftCard->save();


                    $BoughtGiftCard = new BoughtGiftCard();
                    $BoughtGiftCard->gift_card_id = $GiftCard->id;
                    $BoughtGiftCard->bought_by_id = $user['id'];
                    $BoughtGiftCard->is_payment_completed = 1;
                    $BoughtGiftCard->payment_id = str_random(4) . time();
                    ;
                    $BoughtGiftCard->payment_token = 'EC-' . str_random(6) . time();
                    $BoughtGiftCard->current_owner_id = $user['id'];
                    $BoughtGiftCard->is_redeemed = 0;
                    $BoughtGiftCard->is_gifted = 1;
                    $BoughtGiftCard->auth_code = uniqid(str_replace(" ", "_", strtolower('gift')) . "_", true);
                    ;
                    $BoughtGiftCard->save();
                } catch (\Beanstream\Exception $e) {
                    return redirect()->back()->withErrors([$e->getMessage()]);
                }
            }
        }
        //referral module
        if ($request->has('signup_code')) {
            $referral = ReferralLink::whereCode($request->input('signup_code'))->first();
            event(new UserReferred($referral->id, $user));
        }
        try {


            if (!is_null($validGiftCode)) {
                $transactions = new Transactions;
                $transactions->user_id = $user['id'];
                $transactions->reference_id = str_random(4) . time();
                $transactions->type = 'bonus';
                $transactions->type_id = $validGiftCode['id'];
                $transactions->amount = $validGiftCode['credit_amount'];
                $transactions->save();

                $validGiftCode["count"] = $validGiftCode["count"] + 1;
                $validGiftCode->update();
            }

            $this->validator($request->all())->validate();
            $user = $this->create($request->all());
        } catch (\Beanstream\Exception $e) {
            //return redirect()->back()->withErrors([$e->getMessage()]);
        }

        return view('home.shop.user_welcome');
        return redirect()->back()->with('message', 'Registration Completed Successfully.');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $name = $data['first_name'] . " " . $data['last_name'];
        $session_address = Session::all();
        Session::flush();


        if (isset ($data['lat'])) {
            $user = Clients::create([
                'name' => $name,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'unit_no' => $data['unit_no'],
                'buzz_code' => $data['buzz_code'],
                'address' => isset ($data['address']) ? $data['address'] : '',
                'zip' => isset ($data['postal_code']) ? $data['postal_code'] : '',
                'city' => isset ($data['locality']) ? $data['locality'] : '',
                'latitude' => isset ($data['lat']) ? $data['lat'] : '',
                'longitude' => isset ($data['lng']) ? $data['lng'] : '',
                'balance' => isset ($data['balance']) ? $data['balance'] : 0,
                'password' => Hash::make($data['password']),
                'is_activated' => 1,
            ]);

            VendorCustomers::create([
                'vendor_id' => 43,
                'customer_id' => $user->id,
                'phone' => $data['phone'],
                'name' => $data['first_name'] . " " . $data['last_name'],
                'business_name' => '',
                'status' => 1,
            ]);

            AddressMultiple::create([
                'user_id' => $user->id,
                'address_alias' => "Default",
                'address' => isset ($data['address']) ? $data['address'] : '',
                'city' => isset ($data['locality']) ? $data['locality'] : '',
                'zip' => isset ($data['postal_code']) ? $data['postal_code'] : '',
                'province' => isset ($data['administrative_area_level_1']) ? $data['administrative_area_level_1'] : '',
                'street' => isset ($data['route']) ? $data['route'] : '',
                'longitude' => isset ($data['lng']) ? $data['lng'] : '',
                'latitude' => isset ($data['lat']) ? $data['lat'] : '',
            ]);



            //if address set for session
        } else if (isset ($session_address['lat'])) {
            $user = Clients::create([
                'name' => $name,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'unit_no' => $data['unit_no'],
                'buzz_code' => $data['buzz_code'],
                'address' => isset ($session_address['address']) ? $session_address['address'] : '',
                'zip' => isset ($session_address['postal_code']) ? $session_address['postal_code'] : '',
                'city' => isset ($session_address['locality']) ? $session_address['locality'] : '',
                'latitude' => isset ($session_address['lat']) ? $session_address['lat'] : '',
                'longitude' => isset ($session_address['lng']) ? $session_address['lng'] : '',
                'balance' => isset ($data['balance']) ? $data['balance'] : 0,
                'password' => Hash::make($data['password']),
                'is_activated' => 1,
            ]);

            AddressMultiple::create([
                'user_id' => $user->id,
                'address_alias' => "Default",
                'address' => isset ($session_address['address']) ? $session_address['address'] : '',
                'city' => isset ($session_address['locality']) ? $session_address['locality'] : '',
                'zip' => isset ($session_address['postal_code']) ? $session_address['postal_code'] : '',
                'province' => isset ($session_address['administrative_area_level_1']) ? $session_address['administrative_area_level_1'] : '',
                'street' => isset ($session_address['route']) ? $session_address['route'] : '',
                'longitude' => isset ($session_address['lng']) ? $session_address['lng'] : '',
                'latitude' => isset ($session_address['lat']) ? $session_address['lat'] : '',
            ]);
            VendorCustomers::create([
                'vendor_id' => 43,
                'customer_id' => $user->id,
                'phone' => $data['phone'],
                'name' => $data['first_name'] . " " . $data['last_name'],
                'business_name' => '',
                'status' => 1,
            ]);

        }

        return $user;
    }

    public function dashboard()
    {
        if (Auth::guard('profile')->guest()) {
            return redirect('/shop-signin');
        }
        $userInfo = Auth::guard('profile')->user();
        $user = Clients::find($userInfo->id);
        $orders = Order::where('customerid', $userInfo->id)->orderBy('booking_date', 'desc')->get();
        $credits_details = Transactions::where('user_id', $userInfo->id)->where('reference_id', '!=', '')->orderBy('created_at', 'desc')->get();
        return view('home.shop.user_dashboard', compact('user', 'orders', 'credits_details'));
    }

    public function referFriend()
    {
        if (Auth::guard('profile')->guest()) {
            return redirect('/shop-signin');
        }
        return view('home.shop.refer-friend');
    }

    public function sendReferMail(Request $request)
    {
        $referal_link = $request->link;
        $referal_link = str_replace('user/registration', 'shop-register', $referal_link);
        $email = $request->email;
        $email_subject = \App\Models\EmailSubject::where('token', '=', 'G9qRHttew')->first();
        $template = \App\Models\EmailTemplate::where('subject_id', '=', $email_subject->id)->first();
        if (isset ($referal_link) && isset ($email)) {
            $user = Auth::guard('profile')->user();
            try {
                \Illuminate\Support\Facades\Mail::to($email)->send(new PromoRegistrationMail($referal_link, $email_subject->subject, $template, $user->first_name, $user->last_name));
                \Illuminate\Support\Facades\Session::flash('status_type', "success");
                \Illuminate\Support\Facades\Session::flash('status', "Email sent Successfully !");
                return redirect()->back()->with('message_success', 'Email Sent Successfully !');
            } catch (Exception $e) {
                \Illuminate\Support\Facades\Session::flash('status_type', "danger");
                \Illuminate\Support\Facades\Session::flash('status', "Email didn't send !");
                return redirect()->back()->with('message_fail', 'Email didn\'t Send !');
            }
        } else {
            \Illuminate\Support\Facades\Session::flash('status_type', "danger");
            \Illuminate\Support\Facades\Session::flash('status', "Email didn\'t Send !");
            return redirect()->back()->with('message_fail', 'Email didn\'t Send !');
        }
    }

    public function getOrders()
    {
        if (Auth::guard('profile')->guest()) {
            return redirect('/shop-signin');
        }
        $userInfo = Auth::guard('profile')->user();
        $user = Clients::find($userInfo->id);
        $orders = Order::where('customerid', $userInfo->id)->orderBy('booking_date', 'desc')->get();
        $credits_details = Transactions::where('user_id', $userInfo->id)->orderBy('id', 'desc')->get();
        return view('home.shop.my_orders', compact('user', 'orders', 'credits_details'));
    }

    public function cart()
    {
        $sum = 0.00;
        $carts = new \stdClass();
        if (Session::has('uniqueid')) {
            $carts = Cart::where('uniqueid', Session::get('uniqueid'))->get();
            $sum = Cart::where('uniqueid', Session::get('uniqueid'))->sum('cost');
        }
        $response = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'products.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
            ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();
        return view('home.shop.cart', compact('carts', 'sum', 'response'));
    }

    public function promotionsPage()
    {
        $products = Product::where('vendorid', 3)
            ->where('approved', 'yes')->where('featured', 1)
            ->orderBy('id', 'ASC')
            ->get();
        return view('home.shop.promotions', compact('products'));
    }

    public function showMasksPage($vernder_id, $m_id, $s_id, $name)
    {
        $m_id = (int) $m_id;
        $s_id = (int) $s_id;
        $products = Product::where('vendorid', $vernder_id)->where('approved', 'yes')->where('category', 'like', '%' . $s_id . '%')->get();
        return view('home.shop.masks', ['products' => $products]);
    }

    public function productShop($id, $name)
    {
        $id = (int) $id;
        $user = Auth::guard('profile')->user();
        $productdata = Product::findOrFail($id);
        $data['views'] = $productdata->views + 1;
        $productdata->update($data);
        $relateds = Product::where('status', '1')->whereRaw('FIND_IN_SET(?,category)', [$productdata->category[0]])
            ->take(8)->get();
        $gallery = Gallery::where('productid', $id)->get();
        $reviews = Review::where('productid', $id)->get();

        $fav_product = null;

        if ($user) {
            $fav_product = ProductFav::where('product_id', $id)
                ->where('user_id', $user->id)
                ->where('status', 1)
                ->first();
        }
        $response = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'cart.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
            ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();
        // dd($gallery);
        return view('home.shop.product', compact('productdata', 'fav_product', 'gallery', 'reviews', 'relateds', 'response'));
    }

    public function orderSummary()
    {
        $response = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'products.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
            ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();
        $user = null;
        $cart = Cart::where('uniqueid', Session::get('uniqueid'))->get();
        $count = count($cart);
        if (Auth::guard('profile')->user()) {
            $user = Clients::find(Auth::user()->id);
            return redirect()->route('home.confirm')->with(['response' => $response, 'user' => $user]);
        } else if (Auth::guard('profile')->user() and !empty ($count)) {
            return redirect(url('/customers'));
        }
        return view('home.shop.order-summary', compact('response'));
    }

    public function orderConfirm(Request $request)
    {
        if ($request->isMethod('post')) {

            $user = Auth::guard('profile')->user();
            if ($user->is_activated == 0) {
                return redirect()->back()->with('confirm_email_message', 'You must confirm your account before Purchese ! please check your emails.')
                    ->withInput();
            }
            $settings = Settings::findOrFail(1);
            $cart_items = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'products.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
                ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();
            $data = [];
            $subtotal = 0;
            foreach ($cart_items as $key => $cart_item) {
                $data['items'][$key]['name'] = $cart_item['title'];
                $data['items'][$key]['price'] = number_format((float) $cart_item->cost * $cart_item->quantity, 2, '.', '');
                $data['items'][$key]['currency'] = 'CAD';
                $data['items'][$key]['qty'] = $cart_item['quantity'];

                $subtotal += $cart_item->cost * $cart_item->quantity;

                if ($cart_items->count() - 1 == $key) {
                    $data['items'][$key + 1]['name'] = 'Delivery';
                    $data['items'][$key + 1]['price'] = number_format((float) $settings->delivery_fee, 2, '.', '');
                    $data['items'][$key + 1]['currency'] = 'CAD';
                    $data['items'][$key + 1]['qty'] = 1;

                    $data['items'][$key + 2]['name'] = 'Tax(13%)';
                    $data['items'][$key + 2]['price'] = number_format((float) ($subtotal + $settings->delivery_fee) * 13 / 100, 2, '.', '');
                    $data['items'][$key + 2]['currency'] = 'CAD';
                    $data['items'][$key + 2]['qty'] = 1;
                }
            }
            return redirect(route('home.order.confirm'))->with(['order' => $order]);
        }
        $cart = Cart::select('cart.*', 'products.feature_image')
            ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();
        $user_id = Auth::guard('profile')->user()->id;
        $userProfile = UserProfile::find($user_id);
        $multiple_address = AddressMultiple::where('user_id', $user_id)->where('address_alias', "Default")->first();
        return view('home.shop.order-confirm', compact('cart', 'userProfile', 'multiple_address'));
    }


    public function payByCc(Request $request)
    {
        if ($request->isMethod('post')) {
            // Card validation ................................
            // $this->validate($request, [
            //     'name' => 'required',
            //     'card' => 'required|integer',
            //     'month' => 'required|between:1,12',
            //     'year' => 'required|integer',
            //     'cvv' => 'required',
            // ]);
            // place the order .......................................
            $user_id = Session::get('user_id');
            if (empty (Auth::guard('profile')->user())) {
                $user = Clients::where('id', $user_id)->first();
            } else {
                $user = Auth::guard('profile')->user();
            }

            $settings = Settings::findOrFail(1);
            $item_number = str_random(4) . time();
            $item_amount = $request->total;
            //cart data
            $cart_items = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'products.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
                ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();
            $data = [];
            $subtotal = 0;
            foreach ($cart_items as $key => $cart_item) {
                $data['items'][$key]['name'] = $cart_item['title'];
                $data['items'][$key]['price'] = number_format((float) $cart_item->cost * $cart_item->quantity, 2, '.', '');
                $data['items'][$key]['currency'] = 'CAD';
                $data['items'][$key]['qty'] = $cart_item['quantity'];

                $subtotal += $cart_item->cost * $cart_item->quantity;

                if ($cart_items->count() - 1 == $key) {
                    $data['items'][$key + 1]['name'] = 'Delivery';
                    $data['items'][$key + 1]['price'] = number_format((float) $settings->delivery_fee, 2, '.', '');
                    $data['items'][$key + 1]['currency'] = 'CAD';
                    $data['items'][$key + 1]['qty'] = 1;

                    $data['items'][$key + 2]['name'] = 'Tax(13%)';
                    $data['items'][$key + 2]['price'] = number_format((float) ($subtotal + $settings->delivery_fee) * 13 / 100, 2, '.', '');
                    $data['items'][$key + 2]['currency'] = 'CAD';
                    $data['items'][$key + 2]['qty'] = 1;
                }
            }
            $order = new Order();
            $order['products'] = $request->products;
            $order['quantities'] = $request->quantities;
            $order['customerid'] = ($request->customer) ? $request->customer : $user_id;
            $order['discount'] = $request->discount;
            $order['discount_type'] = $request->discount_type;
            $order['subtotal'] = $request->subtotal;
            $order['discount_amount'] = $request->discount_amount;
            $order['delivery'] = $request->delivery;
            $order['service'] = session::get('service');
            $order['tax'] = $request->tax;
            $order['make_it_count'] = $request->make_it_count;
            $order['sizes'] = $request->sizes;
            $order['pay_amount'] = $item_amount;
            $order['method'] = "CreditCard";
            $order['booking_date'] = date('Y-m-d H:i:s');
            $order['order_number'] = $item_number;
            $order['shipping'] = 'shipto';
            $order['pickup_location'] = '';
            $order['customer_email'] = $user->email;
            $order['customer_name'] = $user->first_name . ' ' . $user->last_name;
            $order['customer_phone'] = $user->phone;
            $order['customer_address'] = $user->address;
            $order['customer_city'] = $user->city;
            $order['customer_zip'] = $user->zip;
            $order['shipping_email'] = $user->email;
            $order['shipping_name'] = $user->name;
            $order['shipping_phone'] = $user->phone;
            $order['shipping_address'] = $user->address;
            $order['shipping_city'] = $user->city;
            $order['shipping_zip'] = $user->zip;
            $order['order_note'] = 'note';
            $order['payment_status'] = "Pending";
            $order->save();

            $orderid = $order->id;
            $pdata = explode(',', $request->products);
            $qdata = explode(',', $request->quantities);
            foreach ($pdata as $data => $product) {
                $proorders = new OrderedProducts();
                $productdet = Product::find($product);
                $proorders['orderid'] = $orderid;
                $proorders['owner'] = $productdet->owner;
                $proorders['vendorid'] = $productdet->vendorid;
                $proorders['productid'] = $product;
                $proorders['quantity'] = $qdata[$data];
                $proorders['payment'] = "pending";
                $proorders['cost'] = $productdet->price * $qdata[$data];
                $proorders->save();

                $stocks = $productdet->stock - $qdata[$data];
                if ($stocks < 0) {
                    $stocks = 0;
                }
                $quant['stock'] = $stocks;
                $productdet->update($quant);
            }

            // Card payment start .............................................................

            // $merchant_id = '378880029'; //INSERT MERCHANT ID (must be a 9 digit string)  Live
            // $api_key = '258a709e95134cAEBC997e5E4d1dD703'; //INSERT API ACCESS PASSCODE   Live 

            $merchant_id = '300206404'; //INSERT MERCHANT ID (must be a 9 digit string) Test
            $api_key = '04446E9287964AE2981Bd2997e380BA6'; //INSERT API ACCESS PASSCODE Test
            $api_version = 'v1'; //default
            $platform = 'api'; //default  

            //Create Beanstream Gateway
            $beanstream = new \Beanstream\Gateway($merchant_id, $api_key, $platform, $api_version);
            //Example Card Payment Data
            $name = $request->input('name');
            $card = $request->input('card');
            $month = $request->input('month');
            $year = $request->input('year');
            $cvv = $request->input('cvv');
            $payment_data = array(
                'order_number' => $orderid,
                'amount' => $item_amount,
                'payment_method' => 'card',
                'card' => array(
                    'name' => $name,
                    'number' => $card, //'4030000010001234',
                    'expiry_month' => $month,
                    'expiry_year' => $year,
                    'cvd' => $cvv
                )
            );
            $complete = TRUE; //set to FALSE for PA
            //Try to submit a Card Payment
            try {
                ///working here
                $result = $beanstream->payments()->makeCardPayment($payment_data, $complete);
                if ($result) {
                    if ($order) {

                        //save data to transactions table
                        $transactions = new Transactions;
                        $transactions['user_id'] = $user['id'];
                        $transactions['reference_id'] = $item_number;
                        $transactions['type'] = 'purchase';
                        $transactions['type_id'] = $orderid;
                        $transactions['amount'] = $item_amount;
                        $transactions['method'] = 'Beanstream';
                        $transactions->save();

                        $odata['payment_status'] = 'Completed';
                        $odata['txnid'] = $result['id'];
                        $order->update($odata);

                        $proorders = OrderedProducts::where('orderid', $order->id);
                        $datas['payment'] = "completed";
                        $proorders->update($datas);

                        Cart::where('uniqueid', Session::get('uniqueid'))->delete();

                        // customer email
                        $EmailSubjectCustomer = EmailSubject::where('token', 'j4jkhk81')->first();
                        $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubjectCustomer['id'])->first();
                        Mail::to($user->email)->send(new ShopOrderPlaced($user->first_name, $order, $EmailSubjectCustomer['subject'], $EmailTemplate));

                        //admin email
                        // $EmailSubjectAdmin = EmailSubject::where('token', 'Ykngeeey')->first();
                        // $EmailTemplateAdmin = EmailTemplate::where('domain', 4)->where('subject_id', $EmailSubjectAdmin['id'])->first();
                        // Mail::to('john@ubeclean.com')->send(new ShopOrderPlacedAdmin($order, $EmailSubjectAdmin['subject'], $EmailTemplateAdmin));

                        // vendor email
                        $EmailSubjectVendor = EmailSubject::where('token', 'l8hjc6hh')->first();
                        $EmailTemplateAdmin = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubjectVendor['id'])->first();
                        Mail::to('info@startshredding.com')->send(new ShopOrderPlacedAdmin($order, $EmailSubjectVendor['subject'], $EmailTemplateAdmin));


                        $code = Session::get('coupon');
                        if ($code) {
                            $usedCoupons = new UserUsedCoupons;
                            $usedCoupons['code'] = $code["code"];
                            $usedCoupons['user_id'] = $user['id'];
                            $usedCoupons->save();
                        }
                        Session::forget('product_id');
                        Session::forget('uniqueid');
                        Session::forget('order_type');
                        Session::forget('quantity');
                        session()->forget('service');
                        session()->forget('coupon');
                        Session::put('order1', $order);
                        return redirect(route('home.order.confirmed'))->with(['order' => $order]);
                    }
                }
            } catch (\Beanstream\Exception $e) {
                return redirect()->back()->withErrors([$e->getMessage()]);
            }
        }
        $response = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'cart.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
            ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();
        $user = UserProfile::find(Session::get('user_id'));
        $multiple_address = AddressMultiple::where('user_id', $user->id)
            ->where('address_alias', "Default")
            ->first();
        return view('home.shop.payment', compact('response', 'user', 'multiple_address'));
    }


    public function registerOrder(Request $request)
    {

        $this->validator($request->all())->validate();
        $user = $this->createUser($request->all());

        if (Auth::guard('profile')->attempt(['email' => $request->email, 'password' => $request->password, 'is_activated' => 1], false)) {
            return redirect()->route('home.confirm');
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function createUser(array $data)
    {

        $name = $data['first_name'] . " " . $data['last_name'];
        $session_address = Session::all();
        if (isset ($data['latitude'])) {
            $user = Clients::create([
                'name' => $name,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'address' => isset ($data['address']) ? $data['address'] : '',
                'zip' => isset ($data['zip']) ? $data['zip'] : '',
                'city' => isset ($data['city']) ? $data['city'] : '',
                'province' => isset ($data['province']) ? $data['province'] : '',
                'country' => isset ($data['country']) ? $data['country'] : '',
                'latitude' => isset ($data['latitude']) ? $data['latitude'] : '',
                'longitude' => isset ($data['lontude']) ? $data['lontude'] : '',
                'balance' => isset ($data['balance']) ? $data['balance'] : 0,
                'password' => Hash::make($data['password']),
                'is_activated' => 1
            ]);


            AddressMultiple::create([
                'user_id' => $user->id,
                'address_alias' => "Default",
                'address' => isset ($data['address']) ? $data['address'] : '',
                'city' => isset ($data['city']) ? $data['city'] : '',
                'zip' => isset ($data['zip']) ? $data['zip'] : '',
                'country' => isset ($data['country']) ? $data['country'] : '',
                'province' => isset ($data['province']) ? $data['province'] : '',
                'street' => isset ($data['street']) ? $data['street'] : '',
                'longitude' => isset ($data['lontude']) ? $data['lontude'] : '',
                'latitude' => isset ($data['latitude']) ? $data['latitude'] : '',
            ]);

            VendorCustomers::create([
                'vendor_id' => 43,
                'customer_id' => $user->id,
                'phone' => $data['phone'],
                'name' => $data['first_name'] . " " . $data['last_name'],
                'business_name' => '',
                'status' => 1,
            ]);


            //if address set for session
        } else if (isset ($session_address['latitude'])) {
            $user = Clients::create([
                'name' => $name,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'address' => isset ($data['address']) ? $data['address'] : '',
                'zip' => isset ($data['zip']) ? $data['zip'] : '',
                'city' => isset ($data['city']) ? $data['city'] : '',
                'province' => isset ($data['province']) ? $data['province'] : '',
                'country' => isset ($data['country']) ? $data['country'] : '',
                'latitude' => isset ($data['latitude']) ? $data['latitude'] : '',
                'longitude' => isset ($data['lontude']) ? $data['lontude'] : '',
                'balance' => isset ($data['balance']) ? $data['balance'] : 0,
                'password' => Hash::make($data['password']),
                'is_activated' => 1
            ]);

            VendorCustomers::create([
                'vendor_id' => 43,
                'customer_id' => $user->id,
                'phone' => $data['phone'],
                'name' => $data['first_name'] . " " . $data['last_name'],
                'business_name' => '',
                'status' => 1,
            ]);


            AddressMultiple::create([
                'user_id' => $user->id,
                'address_alias' => "Default",
                'address' => isset ($data['address']) ? $data['address'] : '',
                'city' => isset ($data['city']) ? $data['city'] : '',
                'zip' => isset ($data['zip']) ? $data['zip'] : '',
                'country' => isset ($data['country']) ? $data['country'] : '',
                'province' => isset ($data['province']) ? $data['province'] : '',
                'street' => isset ($data['street']) ? $data['street'] : '',
                'longitude' => isset ($data['lontude']) ? $data['lontude'] : '',
                'latitude' => isset ($data['latitude']) ? $data['latitude'] : '',
            ]);
        }

        Session()->put('user_id', $user->id);
        Session()->put('first_name', $data['first_name']);
        Session()->put('last_name', $data['last_name']);
        Session()->put('email_address', $data['email']);
        Session()->put('contact_no', $data['phone']);
        Session()->put('session_street', $data['address']);
        return $user;
    }


    public function userOrderDetails($id)
    {
        $order = Order::findOrFail($id);
        $user = Clients::findOrFail($order->customerid);
        // echo '<pre>';
        // print_r($order);die;
        $multiple_address = AddressMultiple::where('user_id', $user->id)->where('address_alias', '=', 'Default')->first();
        return view('home.shop.order-details', compact('user', 'order', 'multiple_address'));
    }

    public function makeItCount()
    {
        return view('home.shop.make-it-count');
    }


    public function showForgotForm()
    {
        return view('home.shop.forgotform');
    }

    public function resetPass(Request $request)
    {
        if (Clients::where('email', '=', $request->email)->where('status', 1)->count() > 0) {
            // user found
            $user = Clients::where('email', '=', $request->email)->firstOrFail();
            $token = str_random(20);
            PasswordReset::create([
                'user_id' => $user->id,
                'token' => $token,
                'created_at' => Carbon::now(),
                'expired_at' => date("Y-m-d H:i:s", strtotime("+15 minutes"))
            ]);
            $EmailSubject = EmailSubject::where('token', 'c4jkpk69')->first();
            $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();
            Mail::to($user->email)->send(new UserPassResetShopMail($token, $EmailSubject['subject'], $EmailTemplate));
            return view('home.shop.userforgotpasswordnotice');
        } else {
            // user not found
            Session::flash('error', 'No Account Found With This Email.');
            return redirect(route('home.shop.user-forgotpass'));
        }
    }

    public function userResetPass($token)
    {
        $user = PasswordReset::where('token', $token)->first();
        $curDateTime = date('Y-m-d H:i:s');
        $id = $user['user_id'];
        if ($curDateTime > $user['expired_at']) {
            return view('home.shop.user_token_expired');
        } else {
            return view('home.shop.user_change_password', compact('id'));
        }
    }

    public function userChangePass(Request $request)
    {
        $id = $request->user_id;
        $user = Clients::find($id);
        $user->password = Hash::make($request->password);
        $user->update();
        return redirect(url('home/shop-signin'))->with('success', "Password successfully changed.");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|max:255',
            'first_name' => 'required|max:500',
            'last_name' => 'required|max:500',
            'email' => 'required|email|max:255|unique:clients',
            'password' => 'required|min:6|confirmed',
            //            'address' => 'required',
            'phone' => 'required',

        ]);
    }

    public function confirmed()
    {
        return view('home.shop.order-confirmed');
    }


    public function corporate()
    {
        return view('home.shop.corporate');
    }

    public function packages()
    {
        return view('home.shop.packages');
    }

    public function accinfo()
    {
        if (Auth::guard('profile')->guest()) {
            return redirect('/shop-signin');
        }
        $user = Auth::guard('profile')->user();
        $user = Clients::find($user->id);
        $multiple_address = AddressMultiple::where('user_id', $user->id)->get();
        return view('home.shop.user_account_address', compact('user', 'multiple_address'));
    }

    public function updateDetails(Request $request, $id)
    {
        Session::put('tab', 'account_info');
        $user = Clients::findOrFail($id);
        $input = $request->all();
        $user->update($input);
        return redirect()->back()->with('message', 'Account Information Updated Successfully.');
    }

    public function multipleAddressEdit($id)
    {
        if (Auth::guard('profile')->guest()) {
            return redirect('/shop-signin');
        }
        $user = Auth::guard('profile')->user();
        Session::put('tab', 'saved_address');
        $user = Clients::find($user->id);
        $multiple_address = AddressMultiple::where('user_id', $user->id)->get();
        $edit_address = AddressMultiple::find($id);
        return view('home.shop.user_address_edit', compact('user', 'multiple_address', 'edit_address'));
    }

    public function multipleAddressRemove($id)
    {
        Session::put('tab', 'saved_address');
        $address_multiple = AddressMultiple::find($id);
        $address_multiple->delete();
        return redirect()->back()->with('message', 'Address Remove Successfully.');
    }

    //edit multiple address


    public function updateMultipleAddress(Request $request, $id)
    {

        Session::put('tab', 'saved_address');
        try {


            if ($request->address == '') {
                $update_address = AddressMultiple::find($id);
                if ($request->address_alias != '') {
                    $update_address->address_alias = $request->address_alias;
                    $update_address->save();
                }
            } else {
                $update_address = AddressMultiple::find($id);
                $input = $request->all();
                $update_address->update($input);
                $address = AddressMultiple::where('user_id', $update_address->user_id)->where('id', '!=', $id)->get();
                if ($address) {
                    foreach ($address as $addr) {
                        $addr->update(['address_alias' => '']);
                    }
                }
            }
            return redirect()->route('home.account-details')->with('message', 'Address Successfully Updated.');
        } catch (\Beanstream\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }


    public function getFavProduct()
    {
        if (Auth::guard('profile')->guest()) {
            return redirect('/shop-signin');
        }
        $uniqueid = Session::get('uniqueid');
        $user = Auth::guard('profile')->user();
        $categories = Category::select('id', 'name')->get();
        return view('home.shop.user_favourites', compact('uniqueid', 'user', 'categories'));
    }

    public function searchData(Request $request)
    {
        $userInfo = Auth::guard('profile')->user();
        if ($request->data != "") {
            $products = Product::where('title', 'like', '%' . $request->data . '%')->get();
            $orders = Order::where('customerid', $userInfo->id)->where('order_number', 'like', '%' . $request->data . '%')->get();
        }
        return response()->json(['product' => $products, 'orders' => $orders]);
    }


    public function orderDownload($id)
    {
        $order = Order::findOrFail($id);
        $user = Clients::find($order->customerid);
        $multiple_address = AddressMultiple::where('user_id', $order->customerid)->where('address_alias', '=', 'Default')->first();
        view()->share('user', $user);
        view()->share('order', $order);
        view()->share('multiple_address', $multiple_address);
        //return view('shop.order_pdf',compact('user','order','multiple_address'))->render();
        $pdf = PDF::loadView('home.shop.order_pdf');
        return $pdf->download('order' . $order->id . '_' . ucwords($user->first_name) . ucwords($user->last_name) . '.pdf');
    }

    public function orderPrint($id)
    {
        $order = Order::findOrFail($id);
        $user = Clients::find($order->customerid);
        $multiple_address = AddressMultiple::where('user_id', $order->customerid)->where('address_alias', '=', 'Default')->first();
        view()->share('user', $user);
        view()->share('order', $order);
        view()->share('multiple_address', $multiple_address);
        return view('home.shop.order_pdf_print');
        //        $pdf = PDF::loadView('shop.order_pdf_print');
        //        return $pdf->download('order'.$order->id.'_'.ucwords($user->first_name).ucwords($user->last_name).'.pdf');

    }


    public function getTransactions()
    {
        if (Auth::guard('profile')->guest()) {
            return redirect('/shop-signin');
        }
        $userInfo = Auth::guard('profile')->user();
        $transactions = Transactions::where('user_id', $userInfo->id)->where('reference_id', '!=', '')->orderBy('id', 'desc')->get();
        return view('home.shop.my_transactions', compact('transactions'));
    }


    public function userTransactionDetails($id)
    {
        $userInfo = Auth::guard('profile')->user();
        $transaction = Transactions::find($id);
        $user = Clients::find($userInfo->id);
        $order = Order::findOrFail($transaction->type_id);
        $multiple_address = AddressMultiple::where('user_id', $userInfo->id)->where('address_alias', '=', 'Default')->first();
        return view('home.shop.transaction-details', compact('user', 'order', 'multiple_address', 'transaction'));
    }


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

    public function addMultipleAddress(Request $request, $id)
    {
        try {
            if (Auth::guard('profile')->guest()) {
                return redirect('/shop-login');
            }
            Session::put('tab', 'saved_address');
            $address_multiple = new AddressMultiple;
            $address_multiple->fill($request->all());
            $address_multiple->user_id = $id;
            $address_multiple->save();
            return redirect()->back()->with('message', 'Address Added Successfully.');
        } catch (\Beanstream\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        $cart = Session::get('uniqueid');
        Auth::guard('profile')->logout();
        return redirect('/');
    }

    public function cartupdate(Request $request)
    {
        try {


            if ($request->isMethod('post')) {

                if (empty (Session::get('uniqueid'))) {

                    $cart = new Cart;
                    $cart->fill($request->all());
                    Session::put('uniqueid', $request->uniqueid);
                    $cart->save();
                } else {
                    Session::put('product_id', $request->product);
                    $cart = Cart::where('uniqueid', $request->uniqueid)
                        ->where('product', $request->product)->first();
                    if (count($cart) > 0) {
                        $data = $request->all();
                        // $data['cost'] *= $data['quantity'] + $cart['quantity'];
                        $data['quantity'] = $data['quantity'] + $cart['quantity'];
                        $cart->update($data);
                    } else {
                        $cartd = new Cart;
                        $cartd['uniqueid'] = $request->uniqueid;
                        $cartd['product'] = $request->product;
                        $cartd['title'] = $request->title;
                        $cartd['quantity'] = $request->quantity;
                        $cartd['cost'] = '0.00';
                        $cartd->save();
                        Session::put('uniqueid', $request->uniqueid);
                        // return response($cartd);
                    }
                }
                return response()->json(['response' => 'Successfully Added to Cart.', 'product' => $request->product]);
            }
        } catch (\Beanstream\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

        $getcart = Cart::where('uniqueid', Session::get('uniqueid'))->get();

        return response()->json(['response' => $getcart]);
    }

    public function cartdelete($id)
    {
        $cartproduct = Cart::where('uniqueid', Session::get('uniqueid'))
            ->where('product', $id)->first();
        $cartproduct->delete();
        Session::remove('product_id');
        session()->forget('product_id');
        $getcart = Cart::where('uniqueid', Session::get('uniqueid'))->get();
        return response()->json(['response' => $getcart]);
    }

    public function cartdeleteProduct($id)
    {
        $cartproduct = Cart::where('uniqueid', Session::get('uniqueid'))
            ->where('product', $id)->first();
        $cartproduct->delete();
        Session::remove('product_id');
        session()->forget('product_id');
        return redirect('/customers');
    }

    public function cartProductQtyUp($id)
    {
        $cartproduct = Cart::where('uniqueid', Session::get('uniqueid'))
            ->where('product', $id)->first();
        $cartproduct->quantity = $cartproduct->quantity + 1;
        $cartproduct->update();

        return redirect()->back();
    }

    public function cartProductQtyDown($id)
    {
        $cartproduct = Cart::where('uniqueid', Session::get('uniqueid'))
            ->where('product', $id)->first();
        $cartproduct->quantity = $cartproduct->quantity - 1;

        if ($cartproduct->quantity > 0) {
            $cartproduct->update();
        } else {
            $cartproduct->delete();
        }
        return redirect()->back();
    }

    public function getCartData()
    {
        $data = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'cart.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
            ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();

        return response($data);
    }

    public function updateAddress($id)
    {
        $edit_address = AddressMultiple::where('id', $id)->first();
        return view('home.shop.updateAddress', compact('user', 'edit_address'));
    }

    public function updateMultipleAddressPopup(Request $request, $id)
    {
        try {
            if ($request->address != '') {
                $update_address = AddressMultiple::findOrFail($id);
                $update_address->address = $request->address;
                $update_address->save();
            }
            return redirect()->route('home.confirm')->with('message', 'Address Successfully Updated.');
        } catch (\Beanstream\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function updateOrderDetails(Request $request, $id)
    {
        Session::put('product_id', $request->product_id);
        Session::put('order_type', $request->type);
        Session::put('quantity', $request->quantity);
        return redirect()->back()->with('message', 'Cart Successfully Updated.');
    }

    public function productDetailsUpdate(Request $request)
    {

        if (empty (Session::get('uniqueid'))) {

            $cart = new Cart();
            $cart->uniqueid = Str::random(4);
            $cart->product = $request->product_id;
            $cart->title = Product::where('id', $request->product_id)->first()->title;
            $cart->cost = $request->product_price;
            $cart->quantity = $request->product_quantity;
            $cart->service = $request->product_service;
            $cart->save();
            Session::put('product_id', $cart->product);
            Session::put('uniqueid', $cart->uniqueid);
        } else {
            $cart = Cart::where('uniqueid', Session::get('uniqueid'))->where('product', $request->product_id)->first();
            if (count($cart) > 0) {
                $cart->title = Product::where('id', $request->product_id)->first()->title;
                $cart->cost = $request->product_price;
                $cart->quantity = $request->product_quantity;
                $cart->service = $request->product_service;
                Session::put('product_id', $cart->product);
                $cart->update();
            } else {
                $cart = new Cart();
                $cart->uniqueid = Session::get('uniqueid');
                $cart->product = $request->product_id;
                Session::put('product_id', $cart->product);
                $cart->title = Product::where('id', $request->product_id)->first()->title;
                $cart->cost = $request->product_price;
                $cart->quantity = $request->product_quantity;
                $cart->service = $request->product_service;
                $cart->save();
            }
        }
        return 'ok';
    }


    public function addSession(Request $request)
    {

        Session::put('product_id', $request->product_id);
        Session::put('order_type', $request->type);
        Session::put('quantity', $request->quantity);
        return redirect()->route('home.order.product', $request->product_id);
    }
}
