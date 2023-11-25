<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\AdminRegisterVerification;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    public function showAdminRegistrationForm()
    {
        return view('admin.registerAdmin');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->uname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "Administrator",
            'remember_token' => Str::random(60),
            'status' => 1,
            'is_activated' => 0
        ]);

        $user['link'] = str_random(30);

        DB::table('user_activations')->insert([
            'id_user' => $user['id'],
            'token' => $user['link']
        ]);
        $EmailSubject = EmailSubject::where('token', 'sBg24ka5')->first();
        $EmailTemplate = EmailTemplate::where('domain', 1)->where('subject_id', $EmailSubject['id'])->first();

        Mail::to($user->email)->queue(new AdminRegisterVerification($user->first_name, $user['link'], $EmailSubject['subject'], $EmailTemplate));

        event(new Registered($user));

        return view('admin.admin_welcome');

        // if ($request->has('page') && $request->page == 'summary') {

        //     $this->guard()->login($user);

        //     if ($request->uniqueid) {
        //         Session::put('uniqueid', $request->uniqueid);
        //     }

        //     return redirect(route('order.confirm'));
        // }
        // if ($request->has('page') && $request->page == 'register') {

        // }

        // return redirect()->back()
        //     ->with('message', 'Registration Completed Successfully.');

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:500',
            'lname' => 'required|max:500',
            'uname' => 'required|max:500',
            'email' => 'required|email|max:255|unique:admin',
            'password' => 'required|min:6|confirmed'
        ]);
    }
}
