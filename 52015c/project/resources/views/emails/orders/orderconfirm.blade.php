
<style>

	  .mb_left {
			text-align: left !important;
			margin: 25px 0;
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
                            <p class="mb-1"><strong>Client Name :</strong> <?php echo $user_data[0]->first_name; ?>&nbsp; <?php echo $user_data[0]->last_name; ?></p>
                            <p><strong>Client Email :</strong><?php echo $user_data[0]->EMAIL; ?></p>
                            <p class="mb-1"><strong>Client Address :</strong><?php echo $user_data[0]->city; ?>, <?php echo $user_data[0]->address; ?>,<?php echo $user_data[0]->zip; ?></p>
                            <p class="mb-1"><strong>Client Phone :</strong><?php echo $user_data[0]->phone; ?></p>
                        </div>
												<hr>
                        <div class="col-md-6 text-right mb_left">
                            <p class="font-weight-bold mb-4"><strong>Payment Details</strong></p>
                            <p class="mb-1"><span class="text-muted"><strong>Total Amount : </strong> </span> $<?php echo $order->pay_amount; ?></p>
                            <p class="mb-1"><span class="text-muted"><strong>Order number : </strong> </span> <?php echo $order->order_number; ?></p>
                            <p class="mb-1"><span class="text-muted"><strong>Payment Status : </strong> </span> <?php echo $order->payment_status; ?></p>
                            <p class="mb-1"><span class="text-muted"><strong>Payment Method : </strong> </span> <?php echo $order->method ?></p>
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
																		@if(count($order_details)>0)
																		<?php $count=1;  ?>
																		@foreach ($order_details as $key => $order_detail)

																		<tr>
																			<td><?php echo $count; ?></td>
																			<td>


																			<?php	$pr_name =DB::table('products')->where("id",$order_detail->productid)->get();
													              echo $pr_name[0]->title;?>

																			</td>
																			<td><?php echo $order_detail->quantity; ?></td>
																			<td><?php echo $order_detail->created_at; ?></td>
																			<td><?php echo "$".$order_detail->cost; ?></td>
																		</tr>
																		<?php $count++; ?>
																		@endforeach
																		@else
																	 <td colspan="5" style="text-align:center">No Results Found</td>
																	 @endif
																	</tbody>
	                            </table>
                           </div>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row">
                    	 <div class="col-md-6 text-left">
                            <!-- <p class="font-weight-bold mb-1">Order ID #id</p> -->
                            <p class="text-muted">Date: <?php echo $order->booking_date; ?></p>
                       </div>
                        <div class="col-md-6 text-right mb_left">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light" style="color: #000;margin: 5px 0">$<?php echo $order->pay_amount; ?></div>
                        </div>
                    </div>

										<div class="row">

                        <div class="col-md-6 text-right mb_left">
                            <div class="mb-2"></div>
                            <div class="h2 font-weight-light" style="color: #000;margin: 5px 0"><?php echo $button; ?></div>
                        </div>
                    </div>

                </div>
            </div>


		</div>
	</div>
</div>
