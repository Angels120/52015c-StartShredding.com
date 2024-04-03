<?php

namespace App\Http\Controllers;

use App\Mail\AdminStatusUpdate;
use App\Mail\AdminStatusUpdateCustom;
use App\Mail\OrderComplete;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\Order;
use App\OrderedProducts;
use App\OrderInquiry;
use App\Product;
use App\Clients;
use App\ClientType;
use App\Vendors;
use App\Zones;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $order_status_array = array(0 =>'Scheduled',1 =>'In Transit',2 =>'At Plant',3 =>'On Delivery',4 =>'At_Plant Completed',5 =>'Completed',6 =>'Completed At Store');
        $order_status_mails = array();
        foreach ($order_status_array as $row)
        {
            if($row == 'In Transit')
            {
                $email_templates =  EmailTemplate:: join('email_subjects','email_contents.subject_id','=','email_subjects.id')
                    ->where('email_subjects.token','=','ZpBz6RGv')
                    ->first();
                array_push($order_status_mails,[
                    'status' => $row,
                    'email_body' => $email_templates->content,
                    'email_subject' => $email_templates->subject,
                ]);
            }
            elseif($row == 'On Delivery')
            {
                $email_templates =  EmailTemplate:: join('email_subjects','email_contents.subject_id','=','email_subjects.id')
                    ->where('email_subjects.token','=','DhJr5fPO')
                    ->first();
                array_push($order_status_mails,[
                    'status' => $row,
                    'email_body' => $email_templates->content,
                    'email_subject' => $email_templates->subject,
                ]);
            }
            elseif ($row == 'Completed')
            {
                $email_templates =  EmailTemplate:: join('email_subjects','email_contents.subject_id','=','email_subjects.id')
                    ->where('email_subjects.token','=','Rwnup5tt')
                    ->first();
                array_push($order_status_mails,[
                    'status' => $row,
                    'email_body' => $email_templates->content,
                    'email_subject' => $email_templates->subject,
                ]);
            }
            else
            {
                array_push($order_status_mails,[
                    'status' => $row,
                    'email_body' => null,
                    'email_subject' => null,
                ]);
            }
        }
        $orders = Order::leftjoin('clients', 'orders.customerid', '=', 'clients.id')->orderBy('id', 'desc')
            ->select('orders.*','clients.latitude','clients.longitude')->get();
        $customer_array = [];
        foreach ($orders as $customer){
        if(!empty($customer->customer_name)) {
            $temp = [];
            $temp[0] = $customer->customer_name;
            $temp[1] = (string)$customer->latitude;
            $temp[2] = (string)$customer->longitude;
            $temp[3] = $customer->customer_address;
            $temp[4] = $customer->customer_email;
            $temp[5] = $customer->customer_phone;
            $temp[6] = (string)$customer->order_number;
            $temp[7] = (string)$customer->subtotal;
            $temp[8] = $customer->method;
            $temp[9] = $customer->customer_city;
            $customer_array[] = $temp;
            }else{
                continue;
            }
        }
        $customer_array = json_encode($customer_array);
		$vendors = Vendors::where('status', 1)
            ->distinct('shop_name')
            ->get();
        $client_types = ClientType::all();
        $zones = Zones::all();
        return view('admin.orderlist',compact('orders','order_status_mails','customer_array','vendors','client_types','zones','order_status_array'));
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $products = OrderedProducts::where('orderid', $id)->get();
        $cus_details = Clients::where('id', $order->customerid)->first();
        $order_inquiry = OrderInquiry::where('order_id', $id)->first();

        return view('admin.orderdetails', compact('order', 'products', 'cus_details', 'order_inquiry'));
    }

    public function sendBulkEmail(Request $request)
    {
        $template = array();
        $order_status = $request->template;
        $order_ids = $request->email_multi_select;
        $order_ids = str_replace("undefined,", "", $order_ids);
        $order_ids = str_replace("undefined", "", $order_ids);
        $mail_subject = $request->email_subject;
        $mail_body = $request->email_body;
        array_push($template, [
            'content' => $mail_body
        ]);
        $mail_subject = explode(",", $mail_subject);
        $orders = Order::whereIn('id', $order_ids)
            ->get();
        foreach ($orders as $payee) {
            if (isset($payee->customer_email) && $payee->customer_email != null) {
                try {
                    $stat['status'] = strtolower($order_status);
                    $mainorder = Order::findOrFail($payee->id);
                    // return $mainorder->status;
                    if ($mainorder->status != "completed") {
                        $user = Clients::where('id', $mainorder['customerid'])->first();
                        if ($order_status == 'In Transit') {
                            $orders2 = OrderedProducts::where('orderid', $payee->id)->get();

                            foreach ($orders2 as $payee2) {
                                $order = OrderedProducts::findOrFail($payee2->id);
                                $sts['status'] = "in_transit";
                                $order->update($sts);
                            }

                            Mail::to($payee->customer_email)->send(new AdminStatusUpdate($user->first_name, $mail_subject[0], $template[0], $order_status));

                        } elseif ($order_status == 'On Delivery') {
                            $orders2 = OrderedProducts::where('orderid', $payee->id)->get();

                            foreach ($orders2 as $payee2) {
                                $order = OrderedProducts::findOrFail($payee2->id);
                                $sts['status'] = "on_delivery";
                                $order->update($sts);
                            }
                            Mail::to($payee->customer_email)->send(new AdminStatusUpdate($user->first_name, $mail_subject[0], $template[0], $order_status));
                        } elseif ($order_status == 'Completed') {
                            $orders2 = OrderedProducts::where('orderid', $payee->id)->get();

                            foreach ($orders2 as $payee2) {
                                $order = OrderedProducts::findOrFail($payee2->id);

                                if ($order->owner == "vendor") {
                                    $vendor = Vendors::findOrFail($payee2->vendorid);
                                    $balance['current_balance'] = $vendor->current_balance + $payee2->cost;
                                    $vendor->update($balance);
                                }
                                $sts['paid'] = "yes";
                                $sts['status'] = "completed";
                                $order->update($sts);
                            }

                            Mail::to($payee->customer_email)->send(new OrderComplete($user->first_name, $mail_subject[0], $template[0]));
                        } elseif ($order_status == 'Scheduled') {
                            $orders2 = OrderedProducts::where('orderid', $payee->id)->get();

                            foreach ($orders2 as $payee2) {
                                $order = OrderedProducts::findOrFail($payee2->id);
                                $sts['status'] = "scheduled";
                                $order->update($sts);
                            }

                            Mail::to($payee->customer_email)->send(new AdminStatusUpdateCustom($mail_subject[0], $mail_body));
                        } elseif ($order_status == 'At Plant') {
                            $orders2 = OrderedProducts::where('orderid', $payee->id)->get();

                            foreach ($orders2 as $payee2) {
                                $order = OrderedProducts::findOrFail($payee2->id);
                                $sts['status'] = "at_plant";
                                $order->update($sts);
                            }

                            Mail::to($payee->customer_email)->send(new AdminStatusUpdateCustom($mail_subject[0], $mail_body));

                        } elseif ($order_status = 'At Plant Completed') {
                            $orders2 = OrderedProducts::where('orderid', $payee->id)->get();

                            foreach ($orders2 as $payee2) {
                                $order = OrderedProducts::findOrFail($payee2->id);
                                $sts['status'] = "at_plant_completed";
                                $order->update($sts);
                            }

                            Mail::to($payee->customer_email)->send(new AdminStatusUpdateCustom($mail_subject[0], $mail_body));

                        } elseif ($order_status == 'Completed At Store') {
                            $orders2 = OrderedProducts::where('orderid', $payee->id)->get();

                            foreach ($orders2 as $payee2) {
                                $order = OrderedProducts::findOrFail($payee2->id);
                                $sts['status'] = "completed_at_store";
                                $order->update($sts);
                            }

                            Mail::to($payee->customer_email)->send(new AdminStatusUpdateCustom($mail_subject[0], $mail_body));

                        }
                        $mainorder->update($stat);
                        sleep(5);
                    }

                } catch (Exception $e) {
                    return redirect('admin/orders');
                }
            }
        }
        return redirect('admin/orders');
    }

    public function status($id, $status)
    {


        $stat['status'] = $status;
        $mainorder = Order::findOrFail($id);
        $user = Clients::where('id', $mainorder['customerid'])->first();

        if ($mainorder->status == "completed") {
            return redirect('admin/orders')->with('message', 'This Order is Already Completed');
        } else {


            if ($status == "completed") {
                $orders = OrderedProducts::where('orderid', $id)->get();

                foreach ($orders as $payee) {
                    $order = OrderedProducts::findOrFail($payee->id);

                    if ($order->owner == "vendor") {
                        $vendor = Vendors::findOrFail($payee->vendorid);
                        $balance['current_balance'] = $vendor->current_balance + $payee->cost;
                        $vendor->update($balance);
                    }
                    $sts['paid'] = "yes";
                    $sts['status'] = "completed";
                    $order->update($sts);
                }
                //user mail
                $EmailSubject = EmailSubject::where('token', 'Rwnup5tt')->first();
                $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();
                Mail::to($user->email)->send(new OrderComplete($user->first_name, $EmailSubject['subject'], $EmailTemplate));
            }
            if ($status == "in transit") {

                $orders = OrderedProducts::where('orderid', $id)->get();

                foreach ($orders as $payee) {
                    $order = OrderedProducts::findOrFail($payee->id);
                    $sts['status'] = "in_transit";
                    $order->update($sts);
                }
                $EmailSubject = EmailSubject::where('token', 'ZpBz6RGv')->first();
                $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();
                Mail::to($user->email)->send(new AdminStatusUpdate($user->first_name, $EmailSubject['subject'], $EmailTemplate, $status));
            }
            if ($status == "at plant") {

                $orders = OrderedProducts::where('orderid', $id)->get();

                foreach ($orders as $payee) {
                    $order = OrderedProducts::findOrFail($payee->id);
                    $sts['status'] = "at_plant";
                    $order->update($sts);
                }
            }
            if ($status == "at plant completed") {

                $orders = OrderedProducts::where('orderid', $id)->get();

                foreach ($orders as $payee) {
                    $order = OrderedProducts::findOrFail($payee->id);
                    $sts['status'] = "at_plant_completed";
                    $order->update($sts);
                }
            }
            if ($status == "on delivery") {

                $orders = OrderedProducts::where('orderid', $id)->get();

                foreach ($orders as $payee) {
                    $order = OrderedProducts::findOrFail($payee->id);
                    $sts['status'] = "on_delivery";
                    $order->update($sts);
                }
                //user mail
                $EmailSubject = EmailSubject::where('token', 'DhJr5fPO')->first();
                $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();
                Mail::to($user->email)->send(new AdminStatusUpdate($user->first_name, $EmailSubject['subject'], $EmailTemplate, $status));
            }
            if ($status == "completed at store") {

                $orders = OrderedProducts::where('orderid', $id)->get();

                foreach ($orders as $payee) {
                    $order = OrderedProducts::findOrFail($payee->id);
                    $sts['status'] = "completed_at_store";
                    $order->update($sts);
                }
            }
            if ($status == "scheduled") {

                $orders = OrderedProducts::where('orderid', $id)->get();

                foreach ($orders as $payee) {
                    $order = OrderedProducts::findOrFail($payee->id);
                    $sts['status'] = "scheduled";
                    $order->update($sts);
                }
            }


        }
        //return $stat;
        $mainorder->update($stat);


        return redirect('admin/orders')->with('message', 'Order Status Updated Successfully');
    }

    public function email($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.sendmail', compact('order'));
    }

    public function sendemail(Request $request)
    {
        mail($request->to, $request->subject, $request->message);
        return redirect('admin/orders')->with('message', 'Email Send Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
	
   public function destroy($id)
   {
       //
   }
   //City autoload
   public function getCities()
   {
       $city = $_GET['keyword'];
       if (!empty($city)) {
           $cities = Order::where('customer_city', 'LIKE', '%' . $city . '%')
               ->distinct('customer_city')
               ->get(['customer_city']);
           if (count($cities) > 0) {
               foreach ($cities as $cit) {
                   $name = "'$cit->customer_city'";
                   echo '<li onclick="selectCity(' . $name . ');"><b>' . $cit->customer_city . '</b></li>';
               }
           } else {
               echo "No results found";
           }
       }
   }
   
   public function searchResults()
   {
       $store = empty($_POST['store']) ? "" : $_POST['store'];
       $status = empty($_POST['status']) ? "" : $_POST['status'];
       $clientType = empty($_POST['client_type']) ? "" : $_POST['client_type'];
       $zone = empty($_POST['zone']) ? "" : $_POST['zone'];
       $city = empty($_POST['city']) ? "" : $_POST['city'];
       $order_status_array = array(0 => 'Scheduled', 1 => 'In Transit', 2 => 'At Plant', 3 => 'On Delivery', 4 => 'At_Plant Completed', 5 => 'Completed', 6 => 'Completed At Store');
       $order_status_mails = array();
       foreach ($order_status_array as $row) {
           if ($row == 'In Transit') {
               $email_templates =  EmailTemplate::join('email_subjects', 'email_contents.subject_id', '=', 'email_subjects.id')
                   ->where('email_subjects.token', '=', 'ZpBz6RGv')
                   ->first();
               array_push($order_status_mails, [
                   'status' => $row,
                   'email_body' => $email_templates->content,
                   'email_subject' => $email_templates->subject,
               ]);
           } elseif ($row == 'On Delivery') {
               $email_templates =  EmailTemplate::join('email_subjects', 'email_contents.subject_id', '=', 'email_subjects.id')
                   ->where('email_subjects.token', '=', 'DhJr5fPO')
                   ->first();
               array_push($order_status_mails, [
                   'status' => $row,
                   'email_body' => $email_templates->content,
                   'email_subject' => $email_templates->subject,
               ]);
           } elseif ($row == 'Completed') {
               $email_templates =  EmailTemplate::join('email_subjects', 'email_contents.subject_id', '=', 'email_subjects.id')
                   ->where('email_subjects.token', '=', 'Rwnup5tt')
                   ->first();
               array_push($order_status_mails, [
                   'status' => $row,
                   'email_body' => $email_templates->content,
                   'email_subject' => $email_templates->subject,
               ]);
           } else {
               array_push($order_status_mails, [
                   'status' => $row,
                   'email_body' => null,
                   'email_subject' => null,
               ]);
           }
       }
       $orders = DB::table('orders')
           ->join('ordered_products', 'orders.id', '=', 'ordered_products.orderid')
           ->join('clients', 'orders.customerid', '=', 'clients.id')
           ->when($store, function ($orders) use ($store) {
               return $orders->where('ordered_products.vendorid', $store);
           })
           ->when($status, function ($orders) use ($status) {
               return $orders->where('orders.status', $status);
           })
           ->when($clientType, function ($orders) use ($clientType) {
               return $orders->where('clients.client_type', $clientType);
           })
           ->when($clientType, function ($orders) use ($clientType) {
               return $orders->where('clients.zone_id', $zone);
           })
           ->when($city, function ($orders) use ($city) {
               return $orders->where('orders.customer_city', $city);
           })
           ->get(['orders.*','clients.latitude','clients.longitude']);
       $vendors = Vendors::where('status', 1)
           ->distinct('shop_name')
           ->get();
       $client_types = ClientType::all();
       $zones = Zones::all();
       $customer_array = [];
       foreach ($orders as $customer){
       if(!empty($customer->customer_name)) {
           $temp = [];
           $temp[0] = $customer->customer_name;
           $temp[1] = (string)$customer->latitude;
           $temp[2] = (string)$customer->longitude;
           $temp[3] = $customer->customer_address;
           $temp[4] = $customer->customer_email;
           $temp[5] = $customer->customer_phone;
           $temp[6] = (string)$customer->order_number;
           $temp[7] = (string)$customer->subtotal;
           $temp[8] = $customer->method;
           $temp[9] = $customer->customer_city;
           $customer_array[] = $temp;
           }else{
               continue;
           }
       }
       $customer_array = json_encode($customer_array);
       return view('admin.orderlist', compact('orders', 'order_status_mails', 'order_status_array', 'vendors', 'client_types', 'zones', 'store', 'city', 'status', 'clientType', 'zone', 'customer_array'));
   }

}
