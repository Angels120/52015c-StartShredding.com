<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistrationMail;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\ReferralProgram;
use App\Clients;
use App\PasswordReset;
use App\User;
use App\Vendors;
use Illuminate\Foundation\Auth\ResetsPasswords;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function userActivation($token)
    {
        $check = DB::table('user_activations')->where('token', $token)->first();

        if (!is_null($check)) {
            $user = Clients::find($check->id_user);
            if ($user->is_activated == 1) {
                return redirect()->to('signin/user')->with('success', "user is already actived.");
            }

            $user->update(['is_activated' => 1]);
            DB::table('user_activations')->where('token', $token)->delete();

            // user email
            $EmailSubject = EmailSubject::where('token', 'iZT8XCzm')->first();

            $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();
            $signUpBonus = ReferralProgram::where('name', '=', 'Sign-up Bonus')->first()->amount;
            $gift_card_value = 25;
            Mail::to($user->email)->queue(new UserRegistrationMail($user->first_name, $EmailSubject['subject'], $EmailTemplate, $gift_card_value, $signUpBonus));
            return redirect()->to('signin/user')->with('success', "user active successfully.");
        } else {
            return redirect()->to('signin/user')->with('warning', "your token is invalid");
        }
    }

    public function adminActivation($token)
    {
        $check = DB::table('user_activations')->where('token', $token)->first();

        if (!is_null($check)) {
            $admin = User::find($check->id_user);
            if ($user->is_activated == 1) {
                return redirect()->to('/admin')->with('success', "Admin account is already active.");
            }

            $admin->update(['is_activated' => 1]);
            DB::table('user_activations')->where('token', $token)->delete();

            return redirect()->to('/admin')->with('success', "Admin account is now active.");
        } else {
            return redirect()->to('/admin')->with('warning', "your token is invalid.");
        }
    }

    public function vendorActivation($token)
    {
        $check = DB::table('user_activations')->where('token', $token)->first();

        if (!is_null($check)) {
            $vendor = Vendors::find($check->id_user);
            if ($vendor->is_activated == 1) {
                return redirect()->to('/vendor')->with('success', "Vendor account is already active.");
            }

            $vendor->update(['is_activated' => 1]);
            DB::table('user_activations')->where('token', $token)->delete();

            return redirect()->to('/vendor')->with('success', "Vendor account is now active.");
        } else {
            return redirect()->to('/vendor')->with('warning', "your token is invalid.");
        }
    }

    public function vendorResetPassword($token)
    {
        $user = PasswordReset::where('token', $token)->first();
        $curDateTime = date('Y-m-d H:i:s');
        $id = $user['user_id'];

        if($curDateTime > $user['expired_at']) {
            return view('vendor.token_expired');
        } else {
            return view('vendor.change_password', compact('id'));
        }
    }

    public function vendorChangePassword(Request $request) {
        $id = $request->vendor_id;

        $this->validator($request->all())->validate();

        $vendor = Vendors::find($id);
        $vendor->password = Hash::make($request->password);
        $vendor->save();

        return redirect()->to('/vendor')->with('success', "Password successfully changed."); 
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function userResetPass($token)
    {
        $user = PasswordReset::where('token', $token)->first();
        $curDateTime = date('Y-m-d H:i:s');
        $id = $user['user_id'];

        if($curDateTime > $user['expired_at']) {
            return view('user_token_expired');
        } else {
            return view('user_change_password', compact('id'));
        }
    }

    public function userChangePass(Request $request) {
        $id = $request->user_id;

        $this->validator($request->all())->validate();

        $user = Clients::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->to('/signin/user')->with('success', "Password successfully changed."); 
    }

    public function adminResetPassword($token)
    {
        $admin = PasswordReset::where('token', $token)->first();
        $curDateTime = date('Y-m-d H:i:s');
        $id = $admin['user_id'];

        if($curDateTime > $admin['expired_at']) {
            return view('admin.token_expired');
        } else {
            return view('admin.admin_change_password', compact('id'));
        }
    }

    public function adminChangePassword(Request $request) {
        $id = $request->admin_id;

        $this->validator($request->all())->validate();

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->to('/admin')->with('success', "Password successfully changed."); 
    }
}
