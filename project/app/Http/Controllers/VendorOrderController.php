<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Product;


class VendorOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
        
        return view('vendor.order');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function status($id,$status)
    {
        $order = OrderedProducts::findOrFail($id);
        $stat['status'] = $status;
        $order->update($stat);
        return redirect('vendor/orders')->with('message','Order Status Updated Successfully');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAJAXProduct() {
        $product_id = Input::get('id');
        $product = DB::table('products')->where('id', '=',  $product_id)->first();
        echo json_encode($product);
    }


    public function orderAdd(Request $request) {
        $client_id = $request->get('hf_client_id');
       
        $items_array = $request->get('cmb_order_item');
        $qty_array = $request->get('txt_qty');
        $tax_array = $request->get('hf_tax');
        $base_price_array = $request->get('hf_base_price');
        $grandtotal = $request->get('hf_grandtotal');
        $products = implode(',',$items_array);
        $qty=  array_sum( $qty_array);
        $tax=  array_sum($tax_array);
        $grandtotal;
        $order = new Order();
        // $order['token'] = $response['TOKEN'];
        $order['products'] = $products;
        $order['quantities'] =  $qty;
        $order['customerid'] = $client_id;
        $order['discount'] = 0;
        $order['tax'] = $tax;
        $order['pay_amount'] = $grandtotal;
        $order['method'] = "Paypal";
        $order['booking_date'] = date('Y-m-d H:i:s');
        $order['shipping'] = 'shipto';
        $order['pickup_location'] = '';
      $user1  = DB::table('clients')->find($client_id);
        $order['customer_email'] = $user1->EMAIL;
        $order['customer_name'] = $user1->first_name . ' ' . $user1->last_name;
        $order['customer_phone'] = $user1->phone;
        $order['customer_address'] = $user1->address;
        $order['customer_city'] = $user1->city;
        $order['customer_zip'] = $user1->zip;
        $order['shipping_email'] = $user1->EMAIL;
        $order['shipping_name'] = $user1->name;
        $order['shipping_phone'] = $user1->phone;
        $order['shipping_address'] = $user1->address;
        $order['shipping_city'] = $user1->city;
        $order['shipping_zip'] = $user1->zip;
        $order['order_note'] = 'note';
        $order['payment_status'] = "Pending";
        $order->save();
        $orderid = $order->id;

        //   $pdata = explode(',', $products);
      //  $qdata = explode(',', $request->quantities);
        // $sdata = explode(',', $request->sizes);
        $pdata = $items_array;
        $qdata = $qty_array;

        foreach ($pdata as $data => $product) {
            $proorders = new OrderedProducts();

            $productdet = Product::find($product);
            $proorders['orderid'] = $orderid;
            $proorders['owner'] = "vendor";
            $proorders['vendorid'] = Auth::user()->id;
            $proorders['productid'] = $product;
            $proorders['quantity'] = $qdata[$data];
            // $proorders['size'] = $sdata[$data];
            $proorders['payment'] = "pending";
            $proorders['paid'] = "no";
            $proorders['cost'] = $productdet->price * $qdata[$data];
            $proorders->save();

           /* $stocks = $productdet->stock - $qdata[$data];
            if ($stocks < 0) {
                $stocks = 0;
            }
            $quant['stock'] = $stocks;
            $productdet->update($quant);*/
        }

        return redirect()->route('vendor.order_confirm', ['client_id' => $client_id,'orderid'=>$orderid]);
    }
    public function orderjobstatus(Request $request) {
        $id = $request->get('oid');
        $job_status= $request->get('job_status');
        $order = Order::findOrFail($id);
        DB::table('orders')
            ->where('id', $order->id)  // find your user by their email
            ->limit(1)  // optional - to ensure only one record is updated.
             ->update(array('job_status' => $job_status));
        return redirect('vendor/orders')->with('message','Order Status Updated Successfully');
    }
    public function confirmOrder() {
        return view('vendor.confirm_order');

        $this->checkStore($store_name);
        if (Session::get('user_id') == "" && Auth::id() == "") {
            //return redirect('/login');
            return view('auth/login');
        }
        
        $client_id = Input::get('client_id');
        $job_id = Input::get('job_id');
        $invoice_id = Input::get('invoice_id');
        $view = Input::get('view');

        $client = DB::table('CLIENT')->where('UID', '=', $client_id)->first();
        $job = DB::table('JOB')->where('UID', '=', $job_id)->first();
        $invoice = DB::table('INVOICE')->where('UID', '=', $invoice_id)->first();

        if (empty($client) || empty($job) || empty($invoice)) {
            return redirect()->route('customer', ['store_name' => Session::get('store_name')]);
        }

        $tax_result = DB::table('JOB')
                ->select('TAX_COMPONENTS')
                ->leftJoin('JOB_TYPE', 'JOB.LNK_JOB_TYPE', '=', 'JOB_TYPE.UID')
                ->leftJoin('PRODUCT_CAT_JOB_TYPE', 'PRODUCT_CAT_JOB_TYPE.JOB_TYPE', '=', 'JOB_TYPE.UID')
                ->leftJoin('PRODUCT_CAT', 'PRODUCT_CAT.UID', '=', 'PRODUCT_CAT_JOB_TYPE.PRODUCT_CATEGORY')
                ->leftJoin('TAX_GROUP', 'TAX_GROUP.UID', '=', 'PRODUCT_CAT.LNK_TAX_GROUP')
                ->where('JOB.UID', '=', $job_id)
                ->first();

        $tax_component_uids = array();
        foreach (explode('&', $tax_result->TAX_COMPONENTS) as $component) {
            list($trash, $tax_component_uids[]) = explode('=', $component);
        }

        $tax_component_string = implode(',', $tax_component_uids);

        $tax_components = DB::table('TAX_COMPONENT')
                ->select(DB::raw('SUM(PERCENTAGE) as TAX_AMOUNT'), DB::raw('COMPONENT_NAME as TAX_NAME'))
                ->whereIn('UID', explode(",", $tax_component_string))
                ->first();

        $job_tax = $tax_components->TAX_NAME . ' (' . intval($tax_components->TAX_AMOUNT) . '%)';

        return view('confirm_order', array('client' => $client, 'job' => $job, 'invoice' => $invoice, 'tax' => $job_tax, 'view' => $view));
    }

}
