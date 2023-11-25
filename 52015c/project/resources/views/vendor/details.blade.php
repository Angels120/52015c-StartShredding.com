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
$totalAmount = 0;
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
<style>
	@media only screen and (max-width: 767px) {
	  .mb_left {
			text-align: left !important;
			margin: 25px 0;
		}
	}
</style>
<div class="row">
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
		<div class="row">
			
			<div class="bg-white" style="padding-top: 50px;padding-bottom: 50px;">
                <div class="card-body p-0">
                	
                	  
                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4"><strong>Client Information</strong></p>
                            <p class="mb-1"><?=$order->customer_name?></p>
                            <p><?=$order->customer_email?></p>
                            <p class="mb-1"><?=$order->customer_city?>, <?=$order->customer_address?> <?=$order->customer_zip?></p>
                            <p class="mb-1"><?=$order->customer_phone?></p>
							<button class="btn btn-sucess" type="button" data-toggle="modal" data-target="#exampleModal">
								<i class="fa fa-upload"></i>
								<span>UPLOAD</span>
							</button>
                        </div>

                        <div class="col-md-6 text-right mb_left">
                            <p class="font-weight-bold mb-4"><strong>Payment Details</strong></p>
                            <p class="mb-1"><span class="text-muted">Total Amount: </span> $<?=$order->pay_amount?></p>
                            <p class="mb-1"><span class="text-muted">Order number: </span> <?=$order->order_number?></p>
                            <p class="mb-1"><span class="text-muted">Payment Status: </span> <?=$order->payment_status?></p>
                            <p class="mb-1"><span class="text-muted">Payment Method: </span> <?=$order->method?></p>
							<div class="row">
								<div class="col-md-4">
									<a class="btn btn-primary btn-cons m-b-10 btn-block"
										onclick="printPage( '{{route('home.order.print', ['id' => $order->id])}}' )"
										href="javascript:void(0);"><i class="fa fa-print"></i> <span class="bold">PRINT</span></a>
								</div>
								<div class="col-md-4">
									<button id="download-btn"
											class="btn btn-success btn-cons m-b-10 btn-block p-l-10"
											type="button"><i class="fa fa-download"></i> <span class="bold">DOWNLOAD</span>
									</button>
								</div>
								<div class="col-md-4">
									<button class="btn btn-warning btn-cons m-b-10 btn-block" type="button" title="SERVICE AGREEMENT">
										<i class="fa fa-file"></i> 
										<span class="bold">S. AGREEMENT</span>
									</button>
								</div>
							</div>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row p-5">
                        <div class="col-md-12">
                           <div class="table-responsive">
	                           	 <table class="table">
	                                <thead>
	                                    <tr>
	                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
	                                        <th class="border-0 text-uppercase small font-weight-bold">Product</th>
	                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>                                        
	                                        <th class="border-0 text-uppercase small font-weight-bold">Date</th>
	                                        <th class="border-0 text-uppercase small font-weight-bold">Price</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                	<?php
											if(count($model)>0){
												$count=1;
												foreach($model as $orderDD){
												?>
												<tr> 
													<td><?php echo $count;?></td>
													<td><?php 
													$productDetails=DB::select("select * from products where id='".$orderDD->productid."' limit 1");
													if($productDetails!=null){
														foreach($productDetails as $product){
															echo $product->title;	
														}
													}
													?></td>
													<td><?php echo $orderDD->quantity;?></td>
													<td><?php echo $orderDD->created_at;?></td>
													<td>
													<?php 
													$totalAmount = $totalAmount+$orderDD->cost;
													echo "$".$orderDD->cost;
													?>
													</td>
													
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
                           </div>
                        </div>
                    </div>
                    
                    <hr class="my-5">

                    <div class="row">
                    	 <div class="col-md-6 text-left">
                            <p class="font-weight-bold mb-1">Order ID #<?=$order->id?></p>
                            <p class="text-muted">Date: <?=$order->booking_date?></p>
                       </div> 
                        <div class="col-md-6 text-right mb_left">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light" style="color: #000;margin: 5px 0">$<?=$totalAmount?></div>
                        </div>
                    </div>
                </div>
            </div>
									
			
		</div>
	</div>
</div>

<div class="col-md-12">
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Upload Document</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('upload.document',['id' => $order->id]) }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<?php
							if (!function_exists('code')) {
								function code(
									$length=8
								) 
								{
									$mycode = mt_rand(10000000, 99999999);
									$count = mb_strlen($code);
									$result = $code;
							
									for ($i=0; $i < $length; $i++) { 
										$index = rand(0, $count - 1);
										$result .= mb_substr($index, 1);
									}
									return $mycode;
								}
							}
							
							$docID = code();
						?>
						<input type="hidden" name="id" value="{{ $order->id }}">
						<div class="form-group">
							<label class="label-control" for="doc_id">Document ID</label>
							<input class="form-control" type="text" name="doc_id" id="" value="{{ $docID }}" readonly>
						</div>
						<div class="form-group">
							<label class="label-control" for="order_number">Order Number</label>
							<input class="form-control" type="text" name="order_number" id="" value="{{ $order->order_number }}">
						</div>
						<div class="form-group">
							<label class="label-control" for="booking_date">Order Date</label>
							<input class="form-control" type="text" name="booking_date" id="" value="{{ $order->booking_date }}">
						</div>
						<div class="form-group">
							<label class="label-control" for="booking_date">Complete Date</label>
							<input class="form-control" type="date" name="complete_date" id="" value="">
						</div>
						<div class="form-group">
							<label class="label-control" for="sa_document">Document Upload</label>
							<input class="form-control" type="file" name="sa_document" id="sa_document">
						</div>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@stop

@section('footer')

@stop