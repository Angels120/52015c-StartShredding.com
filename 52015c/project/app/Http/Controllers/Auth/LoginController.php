<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
        $this->middleware('guest:profile', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('admin.index');
    }

    public function signIn($type)
    {
        if ($type == 'vendor' || $type == 'plant' || $type == 'user') {
            return view('auth.login')->with(['type' => $type]);
        } else {
            echo 'No Page Found.';
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $cart = Session::get('uniqueid');

        $this->guard()->logout();

        $request->session()->invalidate();

        Session::put('uniqueid', $cart);

        return redirect('/');
    }
}
