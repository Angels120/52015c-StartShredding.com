<?php

namespace App\Http\Controllers\Auth;


use App\AddressMultiple;
use App\BoughtGiftCard;
use App\Cart;
use App\User;
use App\Category;
use App\Clients;
use App\Events\UserReferred;
use App\GiftCard;
use App\Http\Controllers\Controller;
use App\Mail\UserRegisterVerification;
use App\Profile;
use App\UserProfile;
use App\GiftCode;
use App\Transactions;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistrationMail;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\ReferralLink;
use App\ReferralProgram;
use Illuminate\Support\Facades\Cookie;
use Session;

// use Illuminate\Support\Facades\Session;

class ProfileRegistrationController extends Controller
{

    protected $redirectTo = '/account';


    public function __construct()
    {
        $this->middleware('guest:profile');
    }


    public function showRegistrationForm(Request $request)
    {
        return view('registeruser');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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



        // dd($request->all());
        //return $request;
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());

        if ($request->has('giftcode')) {
            $va = GiftCode::codeValidation($request->input('giftcode'));
            if ($va["error"]) {
                return redirect()->back()
                    ->with('message', $va["msg"])
                    ->withInput();
            } else {
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
                $BoughtGiftCard->payment_id = str_random(4) . time();;
                $BoughtGiftCard->payment_token = 'EC-' . str_random(6) . time();
                $BoughtGiftCard->current_owner_id = $user['id'];
                $BoughtGiftCard->is_redeemed = 0;
                $BoughtGiftCard->is_gifted = 1;
                $BoughtGiftCard->auth_code = uniqid(str_replace(" ", "_", strtolower('gift')) . "_", true);;
                $BoughtGiftCard->save();

                // $validGiftCode = $validation["data"];
                // $request['balance'] = (float) $validation["data"]["credit_amount"];
            }
        }

        //referral module
        if ($request->has('signup_code')) {
            $referral = ReferralLink::whereCode($request->input('signup_code'))->first();
            event(new UserReferred($referral->id, $user));
        }

        // dd('d');

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

        $user['link'] = str_random(30);

        DB::table('user_activations')->insert([
            'id_user' => $user['id'],
            'token' => $user['link']
        ]);
        $EmailSubject = EmailSubject::where('token', 'sBg24ka5')->first();
        $EmailTemplate = EmailTemplate::where('domain', 1)->where('subject_id', $EmailSubject['id'])->first();

        Mail::to($user->email)->queue(new UserRegisterVerification($user->first_name, $user['link'], $EmailSubject['subject'], $EmailTemplate));

        event(new Registered($user));

        if ($request->has('page') && $request->page == 'summary') {

            $this->guard()->login($user);

            if ($request->uniqueid) {
                Session::put('uniqueid', $request->uniqueid);
            }

            return redirect(route('order.confirm'));
        }
        if ($request->has('page') && $request->page == 'register') {
            return view('user_welcome');
            //return redirect()->to('signin/user')->with('success', "We sent activation code. Please check your mail.");
        }

        // Session::flash('success', 'Registration Completed Successfully.');
        return redirect()->back()
            ->with('message', 'Registration Completed Successfully.');
    }


    //get address to session
    public function getAddress(Request $request)
    {
        $address = array();

        Session::put('lat', $request->lat);
        Session::put('lng', $request->lng);
        Session::put('address', $request->address);
        Session::put('route', $request->route);
        Session::put('locality', $request->locality);
        Session::put('country', $request->country);
        Session::put('postal_code', $request->postal_code);
        Session::put('administrative_area_level_1', $request->administrative_area_level_1);

        //return redirect()->route('user.reg.submit');
        return redirect('/category/dry-clean-laundry');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('profile');
    }

    protected function registered(Request $request, $user)
    {
        //
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|max:255',
            'first_name' => 'required|max:500',
            'last_name' => 'required|max:500',
            'email' => 'required|email|max:255|unique:clients',
            'password' => 'required|min:6|confirmed',
            'address' => 'required',
            'phone' => 'required',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $name = $data['first_name'] . " " . $data['last_name'];
        $session_address = Session::all();
        Session::flush();
        if (isset($data['lat'])) {
            $user = Clients::create([
                'name' => $name,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'unit_no' => $data['unit_no'],
                'buzz_code' => $data['buzz_code'],
                'address' => isset($data['address']) ? $data['address'] : '',
                'zip' => isset($data['postal_code']) ? $data['postal_code'] : '',
                'city' => isset($data['locality']) ? $data['locality'] : '',
                'latitude' => isset($data['lat']) ? $data['lat'] : '',
                'longitude' => isset($data['lng']) ? $data['lng'] : '',
                'balance' => isset($data['balance']) ? $data['balance'] : 0,
                'password' => Hash::make($data['password']),
            ]);

            AddressMultiple::create([
                'user_id' => $user->id,
                'address_alias' => "Default",
                'address' => isset($data['address']) ? $data['address'] : '',
                'city' => isset($data['locality']) ? $data['locality'] : '',
                'zip' => isset($data['postal_code']) ? $data['postal_code'] : '',
                'province' => isset($data['administrative_area_level_1']) ? $data['administrative_area_level_1'] : '',
                'street' => isset($data['route']) ? $data['route'] : '',
                'longitude' => isset($data['lng']) ? $data['lng'] : '',
                'latitude' => isset($data['lat']) ? $data['lat'] : '',
            ]);

            //if address set for session
        } else if (isset($session_address['lat'])) {
            $user = Clients::create([
                'name' => $name,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'unit_no' => $data['unit_no'],
                'buzz_code' => $data['buzz_code'],
                'address' => isset($session_address['address']) ? $session_address['address'] : '',
                'zip' => isset($session_address['postal_code']) ? $session_address['postal_code'] : '',
                'city' => isset($session_address['locality']) ? $session_address['locality'] : '',
                'latitude' => isset($session_address['lat']) ? $session_address['lat'] : '',
                'longitude' => isset($session_address['lng']) ? $session_address['lng'] : '',
                'balance' => isset($data['balance']) ? $data['balance'] : 0,
                'password' => Hash::make($data['password']),
            ]);

            AddressMultiple::create([
                'user_id' => $user->id,
                'address_alias' => "Default",
                'address' => isset($session_address['address']) ? $session_address['address'] : '',
                'city' => isset($session_address['locality']) ? $session_address['locality'] : '',
                'zip' => isset($session_address['postal_code']) ? $session_address['postal_code'] : '',
                'province' => isset($session_address['administrative_area_level_1']) ? $session_address['administrative_area_level_1'] : '',
                'street' => isset($session_address['route']) ? $session_address['route'] : '',
                'longitude' => isset($session_address['lng']) ? $session_address['lng'] : '',
                'latitude' => isset($session_address['lat']) ? $session_address['lat'] : '',
            ]);
        }

        return $user;
    }
}
