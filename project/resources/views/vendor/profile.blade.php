<?php 
use App\Order;
use App\OrderedProducts;
use Illuminate\Support\Facades\DB;

$fullUrlCurrent = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$status = array(
	'pending'=>0,
	'in_transit'=>0,
	'at_plan_rece'=>0,
	'at_plan_com'=>0,
	'on_deliver'=>0,
	'completed_deliver'=>0,
	'completed_in_store'=>0,
);
$startTime = date('Y-m-d 00:00:00');
$endTime = date('Y-m-d 23:59:59');

$urlTime = "";

?> 
@extends('vendor.includes.master-vendor')

@section('content')
<div class="row">
	@if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('error') }}
        </div>
    @endif
</div>
<div class="row">
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
		<div class="row">
			
			<div class="bg-white">
				<div class="row">
					<div class="col-md-12 col-xs-12">						 
						<div class="panel panel-default">
							<div class="panel-heading"> 
								<div class="top-title">
									<h3>User Details</h3>
								</div>
							</div>
							<div class="panel-body">
								<?php
								foreach($userDetails as $detail){
									?>
									<div class="row">
										<div class="col-md-4">
											<p><strong>Name:</strong></p>
											<p><?php echo $detail->name;?></p>
										</div>
										<div class="col-md-4">
											<p><strong>Phone:</strong></p>
											<p><?php echo $detail->phone;?></p>
										</div>
										<div class="col-md-4">
											<p><strong>Email:</strong></p>
											<p><?php echo $detail->email;?></p>
										</div>
										
										<div class="col-md-12">
											<p><strong>Address:</strong></p>
											<p><?php echo $detail->address.", ".$detail->city.", Zip: ".$detail->zip;?></p>
										</div>
									</div>
									<?php
								}
								?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
									
			<div class="bg-white">
				<div class="row">
					<div class="col-md-12 col-xs-12">
						 
							<div class="panel panel-default">
								<div class="panel-heading"> 
									<div class="top-title">
										<h3>Orders</h3>
									</div>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table cellpadding="0" cellspacing="0" id="table_1" class="table table-striped table-bordered data-table">
											<thead>
											<tr>
												<th style="width: 10px"></th>
												<th>Date</th>												
												
												<th>Payment Method</th>
												<th>Pay Amount</th>
												<th>Date</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
												<?php
												if(count($totalOrders)>0){
													$count=1;
													foreach($totalOrders as $order){
													?>
													<tr> 
														<td><?php echo $count;?></td>
														<td><?php echo $order->booking_date?></td>
														<td><?=$order->method?></td>
														
														<td><?php echo "$".$order->pay_amount;?></td>
														<td><?php echo $order->booking_date;?></td>
														<td><a href="{!! url('vendor/details/'.$order->id) !!}">View Details</a></td>
													</tr>
													<?php
													$count++;
													}
												}
												else{
													echo '<td colspan="4" style="text-align:center">No Results Found</td>';
												}
													
												?>
												
											</tbody>
										</table>
										<?php
										/*
										?>
										<table cellpadding="0" cellspacing="0" id="table_1" class="table table-striped table-bordered data-table">
											<thead>
											<tr>
												<th style="width: 10px"></th>
												<th>Product</th>
												<th>Quantity</th>
												<th>Cost</th>
												<th>Date</th>
											</tr>
											</thead>
											<tbody>
												<?php
												if(count($totalOrders)>0){
													$count=1;
													foreach($totalOrders as $order){
													?>
													<tr> 
														<td><?php echo $count;?></td>
														<td><?php 
														$productDetails=DB::select("select * from products where id='".$order->productid."' limit 1");
														if($productDetails!=null){
															foreach($productDetails as $product){
																echo $product->title;	
															}
														}
														?></td>
														<td><?php echo $order->quantity;?></td>
														<td><?php echo "$".$order->cost;?></td>
														<td><?php echo $order->created_at;?></td>
													</tr>
													<?php
													$count++;
													}
												}
												else{
													echo '<td colspan="5" style="text-align:center">No Results Found</td>';
												}
													
												?>
												
											</tbody>
										</table>
										 * <?php
										 */
										 ?>
									</div>
									
								</div>
							</div>
						
					</div>			
					
				</div> 
				
						
			</div>
		</div>
	</div>
</div>



@stop

@section('footer')

@stop