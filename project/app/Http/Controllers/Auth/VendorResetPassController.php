<?php

namespace App\Http\Controllers\Auth;

use App\Clients;
use App\Vendors;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UserPassResetMail;
use App\Mail\VendorPassResetMail;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mail;

class VendorResetPassController extends Controller
{
    //Show Forgot Password Form
    public function showForgotForm()
    {
        return view('forgotvendor');
    }

    //Reset Users Profile Password
    public function resetPass(Request $request)
    {
        if (Vendors::where('email', '=', $request->email)->count() > 0) {
            // user found
            $user = Vendors::where('email', '=', $request->email)->firstOrFail();
            $token = str_random(20);

            PasswordReset::create([
                'user_id' => $user->id,
                'token' => $token,
                'created_at' => Carbon::now(),
                'expired_at' => date("Y-m-d H:i:s", strtotime("+15 minutes"))
            ]);

            $EmailSubject = EmailSubject::where('token', 'ZbSYRvJL')->first();
            $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();

            Mail::to($user->email)->send(new VendorPassResetMail($token, $EmailSubject['subject'], $EmailTemplate));
            return view('vendor.forgotpasswordnotice');
        } else {
            // user not found
            Session::flash('error', 'No Account Found With This Email.');
            return redirect(route('vendor.forgotpass'));
        }
    }
}
