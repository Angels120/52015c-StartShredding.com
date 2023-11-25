<?php

namespace App\Http\Controllers\Auth;

use App\Clients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UserPassResetMail;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mail;

class ProfileResetPassController extends Controller
{
    //Show Forgot Password Form
    public function showForgotForm()
    {
        return view('forgotform');
    }

    //Reset Users Profile Password
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

            $EmailSubject = EmailSubject::where('token', 'ZbSYRvJL')->first();
            $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();

            Mail::to($user->email)->send(new UserPassResetMail($token, $EmailSubject['subject'], $EmailTemplate));
            return view('userforgotpasswordnotice');
        } else {
            // user not found
            Session::flash('error', 'No Account Found With This Email.');
            return redirect(route('user.forgotpass'));
        }
    }
}
