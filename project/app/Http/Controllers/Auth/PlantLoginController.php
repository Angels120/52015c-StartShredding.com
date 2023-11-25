<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlantLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:plant');
    }

    public function showLoginFrom(){
        return view('plantlogin');
    }

    public function login(Request $request){

        if (Auth::guard('plant')->attempt(['email' => $request->email,'password' => $request->password], false)){
            if (Auth::guard('plant')->user()->status == 0) {
                Auth::guard('plant')->logout();
                return redirect()->back()
                    ->with('error','Your Account is not Active.');
            }
            return redirect()->intended(route('plant.dashboard'));
        }

        //return redirect()->back()->withInput($request->only('email'));
        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required',
        ]);
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

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }




}
