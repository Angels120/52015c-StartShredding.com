@extends('includes.newmaster')

@section('content')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .dashboard-content * {
            visibility: visible;
        }
        .print-order-btn,.edit-account-info-div .back-btn{
            visibility: hidden;
        }
        .dashboard-content {
            position: absolute;
            margin-top: -100px;
            width: 100%;
        }
    }
</style>
<div class="home-wrapper">
    <!-- Starting of Account Dashboard area -->
    <div class="section-padding dashboard-account-wrapper wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('includes.usermenu')
                </div>
                <div class="col-md-9">
                    <div class="dashboard-content">
                        <div class="view-order-page">
                            <h3>Order# {{$order->order_number}} [{{$order->status}}]</h3>
                            <div class="print-order text-right">
                                <button type="button" onclick="window.print();" class="print-order-btn">
                                    <i class="fa fa-print"></i> Print Order
                                </button>
                            </div>
                            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, tempore.</p>--}}
                            <p class="order-date">Order Date: {{$order->booking_date}}</p>

                            <div class="shipping-add-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if($order->shipping == "shipto")
                                            <h5>Shipping Address</h5>
                                            <address>
                                                Name: {{$order->shipping_name}}<br>
                                                Email: {{$order->shipping_email}}<br>
                                                Phone: {{$order->shipping_phone}}<br>
                                                Address: {{$order->shipping_address}}<br>
                                                {{$order->shipping_city}}-{{$order->shipping_zip}}
                                            </address>
                                        @else
                                            <h5>PickUp Location</h5>
                                            <address>
                                                Address: {{$order->pickup_location}}<br>
                                            </address>
                                        @endif

                                    </div>
                                    <div class="col-md-6">
                                        <h5>Shipping Method</h5>
                                        @if($order->shipping == "shipto")
                                            <p>Ship To Address</p>
                                        @else
                                            <p>Pick Up</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="billing-add-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Billing Address</h5>
                                        <address>
                                            Name: {{$order->customer_name}}<br>
                                            Email: {{$order->customer_email}}<br>
                                            Phone: {{$order->customer_phone}}<br>
                                            Address: {{$order->customer_address}}<br>
                                            {{$order->customer_city}}-{{$order->customer_zip}}
                                        </address>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Payment Method</h5>
                                        <p>{{$order->method}}</p>

                                        @if($order->method != "Cash On Delivery")
                                            @if($order->method=="Stripe")
                                                {{$order->method}} Charge ID: <p>{{$order->charge_id}}</p>
                                            @endif
                                                {{$order->method}} Transaction ID: <p>{{$order->txnid}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered veiw-details-table">
                                    <h5>Ordered Products:</h5>
                                    <tr class="veiw-details-row">
                                        <td>Product Name</td>
                                        <td>Price</td>
                                        <td>Quantity</td>
                                        <td>Subtotal</td>
                                    </tr>
                                    <tr>
                                    	<?php
                                    	$getOrderProducts = DB::select("select * from ordered_products where orderid='$order->id'");
                                    	if(is_array($getOrderProducts) && count($getOrderProducts)>0){
                                    		foreach ($getOrderProducts as $orderDetails) { 
												if($orderDetails!=null){
												$productDetail = \App\Product::findOrFail($orderDetails->productid);
												?>
												<tr>
		                                            <td>{{$productDetail->title}}</td>
		                                            <td>{{$settings[0]->currency_sign}}{{$orderDetails->cost}}</td>
		
		                                            <td>{{$orderDetails->quantity}}</td>
		                                            <td>{{$settings[0]->currency_sign}}{{$orderDetails->cost * $orderDetails->quantity}}</td>
		                                        </tr>
												<?php	
											}
											}
                                    	}
                                    	?>
                                    
                                    <tr style="font-weight: 600;">
                                        <td colspan="3" style="text-align: right">{{$language->total}}</td>
                                        <td>{{$settings[0]->currency_sign}}{{$order->pay_amount}}</td>
                                    </tr>
                                </table>

                                <div class="edit-account-info-div">
                                    <div class="form-group">
                                        <a class="btn btn-md back-btn" href="{{route('user.orders')}}">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ending of Account Dashboard area -->
</div>

@stop

@section('footer')

@stop