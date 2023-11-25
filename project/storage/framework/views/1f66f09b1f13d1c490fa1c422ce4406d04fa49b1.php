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


<?php $__env->startSection('content'); ?>
<div class="row">
	<?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('error')); ?>

        </div>
    <?php endif; ?>
</div>
<style>
	@media  only screen and (max-width: 767px) {
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
                        </div>

                        <div class="col-md-6 text-right mb_left">
                            <p class="font-weight-bold mb-4"><strong>Payment Details</strong></p>
                            <p class="mb-1"><span class="text-muted">Total Amount: </span> $<?=$order->pay_amount?></p>
                            <p class="mb-1"><span class="text-muted">Order number: </span> <?=$order->order_number?></p>
                            <p class="mb-1"><span class="text-muted">Payment Status: </span> <?=$order->payment_status?></p>
                            <p class="mb-1"><span class="text-muted">Payment Method: </span> <?=$order->method?></p>
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



<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.includes.master-vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>