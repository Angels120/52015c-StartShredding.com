<?php

namespace App\Http\Controllers;

use App\AddressMultiple;
use App\Clients;
use App\Order;
use App\ServiceAgreement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ServiceAgreementController extends Controller {

    public function __construct()
    {
        Session::put('tab', 'client_info');
        $this->middleware('auth:profile', ['except' => 'checkout', 'cashondelivery']);
    }

    public function view($id) {
        $user = Clients::find(Auth::user()->id);

        $order = Order::findOrFail($id);


        $userAddressSplitted = explode(", ", $order->customer_address, 1); 
        $shippingAddressSplitted = $order->shipping_address? 
            explode(", ", $order->shipping_address, 1): $userAddressSplitted;

        // Filling with default values if not exist a service agreement for a order
        $serviceAgreement = ServiceAgreement::firstOrCreate([
            "company_name" => $user->business_name ? $user->business_name : "",
            "contact_name" => $user->name,
            "phone_number" => $user->phone,
            "email" => $user->email,
            "billing_address_1" => $userAddressSplitted[0],
            "billing_address_2" => count($userAddressSplitted)>1? $userAddressSplitted[1] : "",
            "billing_city" => $order->customer_city,
            "billing_state" => $user->Province_State,
            "billing_postal_code" => $order->customer_zip,
            "billing_phone" => $order->customer_phone,
            "billing_email" => $order->customer_email,
            "shipping_address_1" => $shippingAddressSplitted[0],
            "shipping_address_2" => count($shippingAddressSplitted)>1? $shippingAddressSplitted[1] : "",
            "shipping_city" => $order->shipping_city ? $order->shipping_city: $order->customer_city,
            "shipping_state" => "",
            "shipping_postal_code" => $order->shipping_zip? $order->shipping_zip: $order->customer_zip,
            "shipping_phone" => $order->shipping_phone ? $order->shipping_phone : $order->customer_phone,
            "shipping_email" => $order->shipping_email ? $order->shipping_email : $order->customer_email,
        ],[
            "order_id" => $order->getKey(),
        ]);


        return view('new_pages.service_agreement',compact('user','order','multiple_address', 'serviceAgreement'));
    }
}
