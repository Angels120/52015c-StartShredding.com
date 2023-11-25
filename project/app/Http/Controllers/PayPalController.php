<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Credit;
use App\Order;
use App\OrderedProducts;
use App\Product;
use App\Settings;
use App\Transactions;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderPlaced;
use App\Mail\OrderPlacedAdmin;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\Mail\CreditConfirmationMail;
use App\Clients;
use Mail;

class PayPalController extends Controller
{
    public $options;

    public function __construct()
    {
        $this->middleware('auth:profile');
        $this->options = [
            'BRANDNAME' => Settings::first()['title'],
            'LOGOIMG' => url('/') . '/assets/img/icon.png',
            'CHANNELTYPE' => 'Merchant'
        ];
        $this->provider = new ExpressCheckout;
    }
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {

        $user = Auth::guard('profile')->user();

        if ($user->is_activated == 0) {
            return redirect()->back()->with('confirm_email_message', 'You must confirm your account before Purchese ! please check your emails.')
                ->withInput();
        }

        $settings = Settings::findOrFail(1);

        // order data
        // $item_name = $settings->title . " Order";
        $item_number = str_random(4) . time();
        $item_amount = $request->total;

        //cart data
        $cart_items = Cart::select('cart.id', 'cart.uniqueid', 'cart.product', 'cart.title', 'cart.quantity', 'cart.size', 'cart.cost', 'products.feature_image')
            ->join('products', 'cart.product', '=', 'products.id')->where('cart.uniqueid', Session::get('uniqueid'))->get();

        $data = [];

        $subtotal = 0;
        foreach ($cart_items as $key => $cart_item) {
            $data['items'][$key]['name'] = $cart_item['title'];
            $data['items'][$key]['price'] = number_format((float) $cart_item->cost * $cart_item->quantity, 2, '.', '');
            $data['items'][$key]['currency'] = 'CAD';
            $data['items'][$key]['qty'] = $cart_item['quantity'];

            $subtotal += $cart_item->cost * $cart_item->quantity;

            if ($cart_items->count() - 1 == $key) {
                $data['items'][$key + 1]['name'] = 'Delivery';
                $data['items'][$key + 1]['price'] = number_format((float) $settings->delivery_fee, 2, '.', '');
                $data['items'][$key + 1]['currency'] = 'CAD';
                $data['items'][$key + 1]['qty'] = 1;

                $data['items'][$key + 2]['name'] = 'Tax(13%)';
                $data['items'][$key + 2]['price'] = number_format((float) ($subtotal + $settings->delivery_fee) * 13 / 100, 2, '.', '');
                $data['items'][$key + 2]['currency'] = 'CAD';
                $data['items'][$key + 2]['qty'] = 1;
            }
        }

        // $data['invoice_id'] = $item_number;
        // $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        // $data['return_url'] = route('payment.success');
        // $data['cancel_url'] = route('payment.cancel');
        // $data['currency'] = 'CAD';
        // $data['total'] = number_format((float) $item_amount, 2, '.', '');

        //checkout
        // $provider = new ExpressCheckout;

        // $response = $provider->setExpressCheckout($data);

        // if ($response['ACK'] == "Success") {
        //save order details
        $order = new Order();
        // $order['token'] = $response['TOKEN'];
        $order['products'] = $request->products;
        $order['quantities'] = $request->quantities;
        $order['customerid'] = $request->customer;
        $order['discount'] = $request->discount;
        $order['discount_type'] = $request->discount_type;
        $order['subtotal'] = $request->subtotal;
        $order['discount_amount'] = $request->discount_amount;
        $order['delivery'] = $request->delivery;
        $order['tax'] = $request->tax;
        $order['make_it_count'] = $request->make_it_count;
        $order['sizes'] = $request->sizes;
        $order['pay_amount'] = $item_amount;
        $order['method'] = "Paypal";
        $order['booking_date'] = date('Y-m-d H:i:s');
        $order['order_number'] = $item_number;
        $order['shipping'] = 'shipto';
        $order['pickup_location'] = '';
        $order['customer_email'] = $user->email;
        $order['customer_name'] = $user->first_name . ' ' . $user->last_name;
        $order['customer_phone'] = $user->phone;
        $order['customer_address'] = $user->address;
        $order['customer_city'] = $user->city;
        $order['customer_zip'] = $user->zip;
        $order['shipping_email'] = $user->email;
        $order['shipping_name'] = $user->name;
        $order['shipping_phone'] = $user->phone;
        $order['shipping_address'] = $user->address;
        $order['shipping_city'] = $user->city;
        $order['shipping_zip'] = $user->zip;
        $order['order_note'] = 'note';
        $order['payment_status'] = "Pending";
        $order->save();
        $orderid = $order->id;

        $pdata = explode(',', $request->products);
        $qdata = explode(',', $request->quantities);
        // $sdata = explode(',', $request->sizes);


        foreach ($pdata as $data => $product) {
            $proorders = new OrderedProducts();

            $productdet = Product::find($product);
            $proorders['orderid'] = $orderid;
            $proorders['owner'] = $productdet->owner;
            $proorders['vendorid'] = $productdet->vendorid;
            $proorders['productid'] = $product;
            $proorders['quantity'] = $qdata[$data];
            // $proorders['size'] = $sdata[$data];
            $proorders['payment'] = "pending";
            $proorders['cost'] = $productdet->price * $qdata[$data];
            $proorders->save();

            $stocks = $productdet->stock - $qdata[$data];
            if ($stocks < 0) {
                $stocks = 0;
            }
            $quant['stock'] = $stocks;
            $productdet->update($quant);
        }

        if ($order) {

            //save data to transactions table
            $transactions = new Transactions;
            $transactions['user_id'] = $user['id'];
            $transactions['reference_id'] = $item_number;
            $transactions['type'] = 'purchase';
            $transactions['type_id'] = $orderid;
            $transactions['amount'] = $item_amount;

            $transactions->save();

            $odata['payment_status'] = 'Completed';
            $order->update($odata);

            $proorders = OrderedProducts::where('orderid', $order->id);
            $datas['payment'] = "completed";
            $proorders->update($datas);

            Cart::where('uniqueid', Session::get('uniqueid'))->delete();

            $UserBalance = Clients::where('id', $user->id)->first()['balance'];
            Clients::where('id', $user->id)->update(['balance' => $UserBalance - $item_amount]);

            // customer email
            $EmailSubjectCustomer = EmailSubject::where('token', 'Kc0zS251')->first();
            $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubjectCustomer['id'])->first();
            Mail::to($user->email)->send(new OrderPlaced($user->first_name, $order, $EmailSubjectCustomer['subject'], $EmailTemplate));

            // admin email
            $EmailSubjectAdmin = EmailSubject::where('token', 'YkngeRnr')->first();
            $EmailTemplateAdmin = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubjectAdmin['id'])->first();
            Mail::to('john@ubeclean.com')->send(new OrderPlacedAdmin($order, $EmailSubjectAdmin['subject'], $EmailTemplateAdmin));

            // vendor email
            $EmailSubjectVendor = EmailSubject::where('token', '840M3AKN')->first();
            $EmailTemplateAdmin = EmailTemplate::where('domain', 1)->where('subject_id', $EmailSubjectVendor['id'])->first();
            Mail::to('john@ubeclean.com')->send(new OrderPlacedAdmin($order, $EmailSubjectVendor['subject'], $EmailTemplateAdmin));

            session()->forget('coupon');
            Session::put('order1', $order);
            return redirect(route('order.confirmed'))->with(['order' => $order]);
            //return view('order-confirmed')->with(['order' => $order]);
        }
        return redirect()->back();
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        return redirect(route('static.packages'));
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Respons
     */
    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $user = Auth::guard('profile')->user();

        $response = $provider->getExpressCheckoutDetails($request->token);
        // dd($response);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            $order = Order::where('token', $response['TOKEN'])
                ->where('order_number', $response['INVNUM'])->first();
            // $data['txnid'] = $_POST['txn_id'];
            $data['payment_status'] = 'Completed';
            $order->update($data);

            $proorders = OrderedProducts::where('orderid', $order->id);
            $datas['payment'] = "completed";
            $proorders->update($datas);

            Cart::where('uniqueid', Session::get('uniqueid'))->delete();
            $EmailSubject = EmailSubject::where('subject', 'New Order - Customer')->first();
            $EmailTemplate = EmailTemplate::where('domain', 1)->where('subject_id', $EmailSubject['id'])->first();

            Mail::to($user->email)->send(new OrderPlaced($user->first_name, $order, $EmailSubject['subject'], $EmailTemplate));

            Session::put('order1', $order);
            return redirect(route('order.confirmed'));
            //return view('order-confirmed')->with(['order' => $order]);
        }

        dd('Something is wrong.');
    }

    public function BuyCredits(Request $request)
    {
        // dd($request->all());
        $user = Auth::guard('profile')->user();
        if ($user->is_activated == 0) {
            return redirect()->back()->with('confirm_email_message', 'You must confirm your account before Purchese ! please check your emails.')
                ->withInput();
        }

        // $data = [];
        $credits = number_format((float) 25, 2, '.', '');
        $price = number_format((float) 25, 2, '.', '');
        $item_number = str_random(4) . time();

        if ($request->select == 1) {
            $data['items'][0]['name'] = 'Trial Credit Package';
            $data['items'][0]['price'] = number_format((float) 25, 2, '.', '');
            $data['items'][0]['currency'] = 'CAD';
            $data['items'][0]['qty'] = 1;
        } else if ($request->select == 2) {
            $data['items'][0]['name'] = 'BASIC Credit Package';
            $data['items'][0]['price'] = number_format((float) 50, 2, '.', '');
            $data['items'][0]['currency'] = 'CAD';
            $data['items'][0]['qty'] = 1;
            $credits = number_format((float) 55, 2, '.', '');
            $price = number_format((float) 50, 2, '.', '');
        } else if ($request->select == 3) {
            $data['items'][0]['name'] = 'DIVA Credit Package';
            $data['items'][0]['price'] = number_format((float) 100, 2, '.', '');
            $data['items'][0]['currency'] = 'CAD';
            $data['items'][0]['qty'] = 1;
            $credits = number_format((float) 115, 2, '.', '');
            $price = number_format((float) 100, 2, '.', '');
        } else if ($request->select == 4) {
            $data['items'][0]['name'] = 'FASHIONISTA Credit Package';
            $data['items'][0]['price'] = number_format((float) 200, 2, '.', '');
            $data['items'][0]['currency'] = 'CAD';
            $data['items'][0]['qty'] = 1;
            $credits = number_format((float) 275, 2, '.', '');
            $price = number_format((float) 200, 2, '.', '');
        } else {
            return redirect()->back();
        }
        // dd($data);
        $data['invoice_id'] = $item_number;
        $data['invoice_description'] = "Credits - #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.credits.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['currency'] = 'CAD';
        $data['total'] = number_format((float) $price, 2, '.', '');

        // $data = $this->getCreditPackage($request->all());
        //checkout
        $provider = new ExpressCheckout;

        $response = $provider->addOptions($this->options)->setExpressCheckout($data, true);

        // dd($response);
        if ($response['ACK'] == "Success") {
            Credit::create([
                'user_id' => $user->id,
                'invoice_id' => $item_number,
                'token' => $response['TOKEN'],
                'amount' => $credits
            ]);

            return redirect($response['paypal_link']);
        }

        return redirect()->back();
    }


    public function getCreditPackages($request)
    {
        $data = [];
        $credits = number_format((float) 25, 2, '.', '');
        $price = number_format((float) 25, 2, '.', '');
        $item_number = str_random(4) . time();

        if ($request['L_PAYMENTREQUEST_0_NAME0'] == 'Trial Credit Package') {
            $data['items'][0]['name'] = 'Trial Credit Package';
            $data['items'][0]['price'] = number_format((float) 25, 2, '.', '');
            $data['items'][0]['currency'] = 'CAD';
            $data['items'][0]['qty'] = 1;
        } else if ($request['L_PAYMENTREQUEST_0_NAME0'] == 'BASIC Credit Package') {
            $data['items'][0]['name'] = 'BASIC Credit Package';
            $data['items'][0]['price'] = number_format((float) 50, 2, '.', '');
            $data['items'][0]['currency'] = 'CAD';
            $data['items'][0]['qty'] = 1;
            $credits = number_format((float) 55, 2, '.', '');
            $price = number_format((float) 50, 2, '.', '');
        } else if ($request['L_PAYMENTREQUEST_0_NAME0'] == 'DIVA Credit Package') {
            $data['items'][0]['name'] = 'DIVA Credit Package';
            $data['items'][0]['price'] = number_format((float) 100, 2, '.', '');
            $data['items'][0]['currency'] = 'CAD';
            $data['items'][0]['qty'] = 1;
            $credits = number_format((float) 115, 2, '.', '');
            $price = number_format((float) 100, 2, '.', '');
        } else if ($request['L_PAYMENTREQUEST_0_NAME0'] == 'FASHIONISTA Credit Package') {
            $data['items'][0]['name'] = 'FASHIONISTA Credit Package';
            $data['items'][0]['price'] = number_format((float) 200, 2, '.', '');
            $data['items'][0]['currency'] = 'CAD';
            $data['items'][0]['qty'] = 1;
            $credits = number_format((float) 275, 2, '.', '');
            $price = number_format((float) 200, 2, '.', '');
        } else {
            return response('error');
        }
        // dd($data);
        $data['invoice_id'] = $item_number;
        $data['invoice_description'] = "Credits - #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.credits.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['currency'] = 'CAD';
        $data['total'] = number_format((float) $price, 2, '.', '');

        return $data;
    }
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function creditSuccess(Request $request)
    {
        $provider = new ExpressCheckout;
        $user = Auth::guard('profile')->user();

        $response = $provider->getExpressCheckoutDetails($request->token);
        // dd($response);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            $Credit = Credit::where('token', $response['TOKEN'])->update(['status' => 1]);

            $CreditRequests = Credit::where('token', $response['TOKEN'])->get();
            // dd($Credit && $CreditRequests->count() == 1); 
            if ($Credit && $CreditRequests->count() == 1) {
                // if (!$CreditRequests->count() > 1) {
                $Cbalance = Credit::where('token', $response['TOKEN'])->first();
                $UserBalance = Clients::where('id', $user->id)->first()['balance'];

                // Doing actual payment
                $do_response = $provider->doExpressCheckoutPayment($this->getCreditPackages($response), $request->token, $response['PAYERID']);
                // dd(in_array(strtoupper($do_response['ACK']), ['SUCCESS']));
                if (in_array(strtoupper($do_response['ACK']), ['SUCCESS'])) {
                    $transactions = new Transactions;
                    $transactions['user_id'] = $user['id'];
                    $transactions['reference_id'] = $Cbalance['invoice_id'];
                    $transactions['type'] = 'deposit';
                    $transactions['type_id'] = $Cbalance['id'];
                    $transactions['amount'] = $Cbalance['amount'];

                    $transactions->save();
                    /************************** End-save data to transactions table***************/

                    $data = Clients::where('id', $user->id)->first()->update(['balance' => $UserBalance + $Cbalance['amount']]);
                    // dd($data, $Cbalance);
                    //$balance = $UserBalance + $Cbalance;
                    $balance = $Cbalance['amount'];
                    Session::flash('success', 'Credit Loaded Successfully.');
                    $EmailSubject = EmailSubject::where('token', 'JNGmWi9K')->first();
                    $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();
                    Mail::to($user->email)->send(new CreditConfirmationMail($user->first_name, $EmailSubject['subject'], $EmailTemplate, $balance, $transactions));
                }
                /************************** save data to transactions table***************/
                else {
                    return redirect(url('buy-credits'));
                }

                // }
            }

            return redirect(route('order.confirm'));
        }

        dd('Something is wrong.');
    }
}
