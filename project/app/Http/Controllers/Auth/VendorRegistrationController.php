<?php

namespace App\Http\Controllers\Auth;


use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\VendorRegisterVerification;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\Profile;
use App\Clients;
use App\Vendors;
use App\VendorUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class VendorRegistrationController extends Controller
{

    protected $redirectTo = '/dashboard';


    public function __construct()
    {
        $this->middleware('guest:vendor');
    }


    public function showRegistrationForm()
    {
        return view('registervendor');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $vendor = $this->create($request->all());

        $token = str_random(30);

        DB::table('user_activations')->insert([
            'id_user' => $vendor->id,
            'token' => $token
        ]);
        
        $EmailSubject = EmailSubject::where('token', 'sBg24ka5')->first();
        $EmailTemplate = EmailTemplate::where('domain', 1)->where('subject_id', $EmailSubject['id'])->first();

        Mail::to($vendor->email)->queue(new VendorRegisterVerification($vendor->name, $token, $EmailSubject['subject'], $EmailTemplate));

        event(new Registered($user));

        return view('user_welcome');

        // if ($request->has('page') && $request->page == 'summary') {

        //     $this->guard()->login($user);

        //     if ($request->uniqueid) {
        //         Session::put('uniqueid', $request->uniqueid);
        //     }

        //     return redirect(route('order.confirm'));
        // }
        // if ($request->has('page') && $request->page == 'register') {
        //     return view('user_welcome');
        // }

        // return redirect()->back()
        //     ->with('message', 'Registration Completed Successfully.');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('vendor');
    }

    protected function registered(Request $request, $user)
    {
        //
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'shop_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:vendor_profiles',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
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
        return Vendors::create([
            'name' => $data['name'],
            'shop_name' => $data['shop_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'remember_token' => str_random(60),
            'status' => 1,
            'is_activated' => 0
        ]);
    }
}
