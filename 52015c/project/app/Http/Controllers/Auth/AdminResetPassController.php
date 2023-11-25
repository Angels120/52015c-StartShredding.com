<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AdminPassResetMail;
use App\User;
use App\Mail\UserPassResetMail;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mail;

class AdminResetPassController extends Controller
{
    public function showForgotForm()
    {
        return view('admin.forgotform');
    }

    //Reset Admin Password
    public function resetPass(Request $request)
    {
        if (User::where('email', '=', $request->email)->count() > 0) {
            // user found
            $admin = User::where('email', '=', $request->email)->firstOrFail();
            $token = str_random(20);

            PasswordReset::create([
                'user_id' => $admin->id,
                'token' => $token,
                'created_at' => Carbon::now(),
                'expired_at' => date("Y-m-d H:i:s", strtotime("+15 minutes"))
            ]);

            $EmailSubject = EmailSubject::where('token', 'ZbSYRvJL')->first();
            $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();

            Mail::to($admin->email)->send(new AdminPassResetMail($token, $EmailSubject['subject'], $EmailTemplate));
            return view('admin.adminforgotpasswordnotice');
        } else {
            // user not found
            Session::flash('error', 'No Account Found With This Email.');
            return redirect(route('admin.forgotpass'));
        }
    }
}
