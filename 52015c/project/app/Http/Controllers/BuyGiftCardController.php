<?php

namespace App\Http\Controllers;

use App\Models\EmailSubject;
use DB;
use Mail;
use DateTime;
use App\GiftCard;
use App\BoughtGiftCard;
use App\Clients;
use App\Transactions;
use App\Settings;
use App\Mail\GiftCardMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;

class BuyGiftCardController extends Controller
{
    public $options;

    public function __construct()
    {
        $this->middleware('auth:profile', ['except' => 'checkout', 'cashondelivery']);
        $this->options = [
            'BRANDNAME' => Settings::first()['title'],
            'LOGOIMG' => url('/') . '/assets/img/icon.png',
            'CHANNELTYPE' => 'Merchant'
        ];
        $this->provider = new ExpressCheckout;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $date = new DateTime();
        $giftcards = GiftCard::where('is_deleted', 0)
            ->where('status', 1)
            ->where('expiry_date', '>', $date)
            ->orderBy('id', 'desc')->get();
        $boughtgiftcards = BoughtGiftCard::
            with('bought_by')
            ->where('is_redeemed', 0)
            ->where('is_payment_completed', 1)
            ->where('current_owner_id', $user_id)
            ->orderBy('updated_at', 'desc')->get();
        $redeemedgiftcards = BoughtGiftCard::
            with('bought_by')
            ->where('is_redeemed', 1)
            ->where('redeemed_by_id', $user_id)
            ->orderBy('updated_at', 'desc')->get();
        return view('new_pages.giftcards', compact('user_id', 'giftcards', 'boughtgiftcards', 'redeemedgiftcards'));
    }

    public function buy($id)
    {
        $giftcard = GiftCard::find($id);
        $paymentdata['items'][0]['name'] = "Buy a gift card - " . $giftcard->title;
        $paymentdata['items'][0]['price'] = number_format((float) $giftcard->purchase_price, 2, '.', '');
        $paymentdata['items'][0]['currency'] = 'CAD';
        $paymentdata['items'][0]['qty'] = 1;
        $paymentdata['invoice_id'] = str_random(4) . time();
        $paymentdata['invoice_description'] = "Gift card Invoice - #" . $paymentdata['invoice_id'];
        $paymentdata['return_url'] = route('user.giftcardspayment.complete');
        $paymentdata['cancel_url'] = route('user.giftcardspayment.fail');
        $paymentdata['currency'] = 'CAD';
        $paymentdata['total'] = number_format((float) $giftcard->purchase_price, 2, '.', '');

        $response = $this->provider->addOptions($this->options)->setExpressCheckout($paymentdata, true);

        if ($response['ACK'] == "Success") {
            $data = [
                'gift_card_id' => $id,
                'bought_by_id' => Auth::user()->id,
                'current_owner_id' => Auth::user()->id,
                'is_redeemed' => 0,
                'is_gifted' => 0,
                'is_payment_completed' => 0,
                'payment_id' => $paymentdata['invoice_id'],
                'payment_token' => $response['TOKEN']
            ];
            // $this->validate($data, BoughtGiftCard::$rules);

            $boughtgiftcard = new BoughtGiftCard();
            $boughtgiftcard->fill($data);
            $boughtgiftcard->save();

            return redirect($response['paypal_link']);
        }
        return redirect()->back();
        // return redirect('user/gift-cards')->with('message','Gift Card Purchased Successfully.');
    }

    public function paymentFail()
    {
        $token = !empty($_GET['token']) ? $_GET['token'] : null;
        $boughtgiftcard = BoughtGiftCard::where('payment_token', $token)->first();

        if ($token !== $boughtgiftcard->payment_token) {
            return redirect('user/gift-cards')->withErrors('Payment authentication fail.');
        }

        return redirect('user/gift-cards')->withErrors('Payment has been canceled.');
    }

    public function giftData($id)
    {
        $giftcard = GiftCard::find($id);
        $paymentdata['items'][0]['name'] = "Buy a gift card - " . $giftcard->title;
        $paymentdata['items'][0]['price'] = number_format((float) $giftcard->purchase_price, 2, '.', '');
        $paymentdata['items'][0]['currency'] = 'CAD';
        $paymentdata['items'][0]['qty'] = 1;
        $paymentdata['invoice_id'] = str_random(4) . time();
        $paymentdata['invoice_description'] = "Gift card Invoice - #" . $paymentdata['invoice_id'];
        $paymentdata['return_url'] = route('user.giftcardspayment.complete');
        $paymentdata['cancel_url'] = route('user.giftcardspayment.fail');
        $paymentdata['currency'] = 'CAD';
        $paymentdata['total'] = number_format((float) $giftcard->purchase_price, 2, '.', '');

        return $paymentdata;
    }

    public function paymentComplete(Request $request)
    {
        // dd($request->token);
        $response = $this->provider->getExpressCheckoutDetails($request->token);
     
        // $token = !empty($_GET['token']) ? $_GET['token'] : null;
        $boughtgiftcard = BoughtGiftCard::with('gift_card')->where('payment_token', $request->token)->first();

        // if ($token !== $boughtgiftcard->payment_token) {
        //     return redirect('user/gift-cards')->withErrors('Payment authentication fail.');
        // }
        // dd($request->token,$boughtgiftcard->payment_token); 
        $GiftCard = GiftCard::find($boughtgiftcard->gift_card_id);
        $do_response = $this->provider->doExpressCheckoutPayment($this->giftData($boughtgiftcard->gift_card_id), $request->token, $response['PAYERID']);
            // dd($do_response);
        if (in_array(strtoupper($do_response['ACK']), ['SUCCESS'])) {
            if (!$boughtgiftcard->is_payment_completed) {
                $boughtgiftcard->is_payment_completed = 1;
                $boughtgiftcard->update();

                $transactions = new Transactions;
                $transactions->user_id = $boughtgiftcard->bought_by_id;
                $transactions->reference_id = $boughtgiftcard->payment_id;
                $transactions->type = 'purchase';
                $transactions->type_id = $boughtgiftcard->id;
                $transactions->amount = $boughtgiftcard->gift_card->credit_amount;
                $transactions->save();

                return redirect('user/gift-cards')->with('message', 'Gift Card Purchased Successfully.');
            }

            return redirect('user/gift-cards')->withErrors('Gift Card Payment already Updated.');
        }


        return redirect('user/gift-cards')->withErrors('Payment authentication fail.');
    }

    public function redeem($id)
    {
        $Clients = Clients::findOrFail(Auth::user()->id);
        $boughtgiftcard = BoughtGiftCard::with('gift_card')->findOrFail($id);

        $Clients->balance += $boughtgiftcard->gift_card->credit_amount;
        if ($Clients->update()) {
            $boughtgiftcard->is_redeemed = 1;
            $boughtgiftcard->redeemed_by_id = Auth::user()->id;
            $boughtgiftcard->update();

            $transactions = new Transactions;
            $transactions->user_id = $boughtgiftcard->redeemed_by_id;
            $transactions->reference_id = str_random(4) . time();
            $transactions->type = 'bonus';
            $transactions->type_id = $boughtgiftcard->id;
            $transactions->amount = $boughtgiftcard->gift_card->credit_amount;
            $transactions->save();
        }

        return redirect('user/gift-cards')->with('message', 'Gift Card Redeemed Successfully.');
    }

    public function send(Request $request, $id)
    {
        $baseurl = url('/');
        $Clients = Clients::findOrFail(Auth::user()->id);
        $settings = DB::select('select * from settings where id=?', [1]);

        $boughtgiftcard = BoughtGiftCard::with('gift_card')->with('bought_by')->findOrFail($id);
        $boughtgiftcard->current_owner_id = null;
        $boughtgiftcard->is_gifted = 1;
        $auth_code = uniqid(str_replace(" ", "_", strtolower($boughtgiftcard->gift_card->title)) . "_", true);
        $boughtgiftcard->auth_code = $auth_code;
        $template = EmailSubject::join('email_contents', 'email_subjects.id', '=', 'email_contents.subject_id')
            ->where('email_subjects.token', '=', 'sqIcnDBo')
            ->first();

        Mail::to($request->to_email)->send(new GiftCardMail($template, $baseurl, $request->sender_msg, $settings, $Clients, $boughtgiftcard, $auth_code));

        $boughtgiftcard->update();
        return redirect('user/gift-cards')->with('message', 'Gift Card Send Successfully.');
    }

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
