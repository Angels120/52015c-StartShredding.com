<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use App\GiftCard;
use App\Mail\GiftCardMail;
use App\BoughtGiftCard;
use App\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;

class GiftCardValidateController extends Controller
{
    public function validate($id, $auth_code)
    {
        $boughtgiftcard = BoughtGiftCard::findOrFail($id);

        if (!$boughtgiftcard->is_gifted || $boughtgiftcard->auth_code !== $auth_code) {
            return redirect('user/gift-cards')->withErrors('Gift Card validation fail.');
        }

        if ($boughtgiftcard->is_redeemed) {
            return redirect('user/gift-cards')->withErrors('Gift Card already used.');
        }

        $boughtgiftcard->current_owner_id = Auth::user()->id;
        $boughtgiftcard->auth_code = null;
        $boughtgiftcard->update();

        return redirect('user/gift-cards')->with('message', 'Received Gift Card Added Successfully.');
    }
}
