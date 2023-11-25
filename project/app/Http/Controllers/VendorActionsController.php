<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Vendors;
use App\Helper;
use App\Withdraw;
use App\Order;
use App\OrderedProducts;
use App\Product;
use App\PickupRequests;
use App\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorActionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }
	
    public function requestpickup()
    {
        if(isset($_POST['submit']) && isset($_POST['order_product']) && is_array($_POST['order_product']) && $_POST['submit']=="request_pickup" && count($_POST['order_product'])>0 ){
        	$totalRequestSents = 0;
        	foreach ($_POST['order_product'] as $orderProductId) {
    			$findOrderItem = OrderedProducts::where('vendorid',Auth::user()->id)->where('id',$orderProductId)->first();
				if($findOrderItem!=null){ 
					$insert = PickupRequests::create([
						'vendor_id'=>Auth::user()->id,
						'order_id'=>$findOrderItem->orderid,
						'order_product_id'=>$findOrderItem->productid,
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s'),
					]);
					$totalRequestSents++;
					
					
					$subject = "New Pickup request received";
					$msg = "<p>New Pickup request is recived. Vendor details are given below:</p>
						<p>Vendor name: ".Auth::user()->name."</p>
						<p>Vendor shop name: ".Auth::user()->shop_name."</p>
						<p>Order ID : ".$findOrderItem->orderid."</p>
						<p>Requested Date : ".date('Y-m-d H:i:s')."</p>
					";
					 
					Helper::sendMail('john@backpocket.ca',$subject,$msg);
					
				}		
			}
			
			if($totalRequestSents>0){
				return redirect()->back()->with('message','Request has been sent for pickup of '.$totalRequestSents.' product(s).')->withInput();
			}else{
				return redirect()->back()->with('error','Failed to send request for pickup.')->withInput();
			}
			
        }
		return redirect()->back()->with('error','Select Orders to request pickup')->withInput();
    }
	   
	
	public function batchnotify(){
		
		if(isset($_POST['submit']) && isset($_POST['order_product']) && is_array($_POST['order_product']) && $_POST['submit']=="notify_client" && count($_POST['order_product'])>0 ){
        	$totalRequestSents = 0;
        	foreach ($_POST['order_product'] as $orderProductId) {
    			$findOrderItem = OrderedProducts::where('vendorid',Auth::user()->id)->where('id',$orderProductId)->first();
				if($findOrderItem!=null){
							
					$getOrder = Order::where('id',$findOrderItem->orderid)->first();						
					if($getOrder!=null){
																
						$getProduct = Product::where('id',$findOrderItem->productid)->first();
						$getCustomer = Clients::where('id',$getOrder->customerid)->first();
						
						if($getProduct!=null && $getCustomer!=null){
							$orderStatus = $statusKey = "constants.status_".$findOrderItem->status;	
							$subject = "Order #".$findOrderItem->orderid." Status";
							$msg = "Status of your product ".$getProduct->title." currently is ".config($orderStatus)."";
																	 
							Helper::sendMail($getCustomer->email,$subject,$msg);
							$totalRequestSents++;
						}
					}
					
				}		
			}
			
			if($totalRequestSents>0){
				return redirect()->back()->with('message','Notification has been sent to '.$totalRequestSents.' client(s).')->withInput();
			}else{
				return redirect()->back()->with('error','Failed to send notification.')->withInput();
			}
			
        }
		
		if(isset($_POST['submit']) && isset($_POST['order_product']) && is_array($_POST['order_product']) && $_POST['submit']=="mark_complete" && count($_POST['order_product'])>0 ){
        	$totalUpdates = 0;
        	foreach ($_POST['order_product'] as $orderProductId) {
    			$findOrderItem = OrderedProducts::where('vendorid',Auth::user()->id)->where('id',$orderProductId)->first();
				if($findOrderItem!=null){
							
					$getOrder = Order::where('id',$findOrderItem->orderid)->first();						
					if($getOrder!=null){
																
						$getProduct = Product::where('id',$findOrderItem->productid)->first();
						$getCustomer = Clients::where('id',$getOrder->customerid)->first();
						
						if($getProduct!=null && $getCustomer!=null){
							$stat = array();
							$stat['status'] = 6;
        					$findOrderItem->update($stat);
							$totalUpdates++;
						}
					}
					
				}		
			}
			
			if($totalUpdates>0){
				return redirect()->back()->with('message','Order item(s) has been marked as completed.')->withInput();
			}else{
				return redirect()->back()->with('error','Failed to complete your request.')->withInput();
			}
			
        }
		
		if(isset($_POST['submit']) && isset($_POST['order_product']) && is_array($_POST['order_product']) && $_POST['submit']=="request_delivery" && count($_POST['order_product'])>0 ){
			$totalAsked = 0;
        	foreach ($_POST['order_product'] as $orderProductId) {
    			$findOrderItem = OrderedProducts::where('vendorid',Auth::user()->id)->where('id',$orderProductId)->first();
				if($findOrderItem!=null){
							
					$getOrder = Order::where('id',$findOrderItem->orderid)->first();						
					if($getOrder!=null){
																
						$getProduct = Product::where('id',$findOrderItem->productid)->first();
						$getCustomer = Clients::where('id',$getOrder->customerid)->first();
						
						if($getProduct!=null && $getCustomer!=null){
							/*
							$insert = PickupRequests::create([
								'vendor_id'=>Auth::user()->id,
								'order_id'=>$getOrder->id,
								'order_product_id'=>$findOrderItem->productid,
								'created_at'=>date('Y-m-d H:i:s'),
								'updated_at'=>date('Y-m-d H:i:s'),
							]);*/


							$subject = "New Delivery request received";
							$msg = "<p>New Delivery request is received. Vendor details are given below:</p>
								<p>Vendor name: ".Auth::user()->name."</p>
								<p>Vendor shop name: ".Auth::user()->shop_name."</p>
								<p>Order ID : ".$findOrderItem->orderid."</p>
								<p>Order Item ID : ".$findOrderItem->id."</p>
								<p>Requested Date : ".date('Y-m-d H:i:s')."</p>
							";

							Helper::sendMail('john@backpocket.ca',$subject,$msg);
							
							$totalAsked++;
						}
					}
					
				}		
			}
			
			if($totalAsked>0){
				return redirect()->back()->with('message','Request for delivery email has been sent for '.$totalAsked." item(s).")->withInput();
			}else{
				return redirect()->back()->with('error','Failed to complete your request.')->withInput();
			}
		}
		
		return redirect()->back()->with('error','Select Orders to send notfications to clients')->withInput();
	}

	
	public function sendnotification(){
		if(isset($_GET['id']) && $_GET['id']!="" && is_numeric($_GET['id'])){
			$orderProductId = $_GET['id'];
			$findOrderItem = OrderedProducts::where('vendorid',Auth::user()->id)->where('id',$orderProductId)->first();
			if($findOrderItem!=null){
						
				$getOrder = Order::where('id',$findOrderItem->orderid)->first();						
				if($getOrder!=null){
															
					$getProduct = Product::where('id',$findOrderItem->productid)->first();
					$getCustomer = Clients::where('id',$getOrder->customerid)->first();
					
					if($getProduct!=null && $getCustomer!=null){
						$orderStatus = $statusKey = "constants.status_".$findOrderItem->status;	
						$subject = "Order #".$findOrderItem->orderid." Status";
						$msg = "Status of your product ".$getProduct->title." currently is ".config($orderStatus)."";			 
						Helper::sendMail($getCustomer->email,$subject,$msg);
						
						return redirect()->back()->with('message','Notification has been sent to client.')->withInput();
						
					}
				}
				
			}	
		}
		return redirect()->back()->with('error','Failed to send notification.')->withInput();
	}

}
