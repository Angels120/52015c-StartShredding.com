<?php 
use App\Order;
use App\OrderedProducts;
use Illuminate\Support\Facades\DB;
?> 
@extends('vendor.includes.master-vendor')

@section('content')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
		<div class="row">
			<div class="bg-white">
				
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="top-title">
									<h3><?=$text?></h3>
								</div>
								<?php if(count($filterStatus)>0){ ?>
								<form method="get" action="" id="filterModelCompleOrders">
									<select name="q" class="form-control title-select" onchange="document.getElementById('filterModelCompleOrders').submit();" >
										<option value="">All</option>
										<?php
										foreach ($filterStatus as $key => $value) {
											$statusKey = "constants.status_".$value;
											?>
											<option <?php if($q!=""){ if($q==$value){echo 'selected';} }?> value="<?=$value?>"><?=Config::get($statusKey)?></option>
											<?php
										}
										?>
									</select>
								</form>
								<?php } ?>
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table cellpadding="0" cellspacing="0" id="table_3" class="table table-striped table-bordered data-table">
										<thead>
											<tr>
												<th style="width: 10px"></th>
												<th>Complete Date</th>
												<th>Order#</th>
												<th>Clients</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if(count($orders)>0){
												foreach ($orders as $order) {
													$getOtherDetails = DB::select('SELECT * FROM `clients` WHERE id = (SELECT `customerid` FROM `orders` WHERE `id` = ?) ',[$order->orderid]);
													if($getOtherDetails!=null){
														$getOtherDetails = $getOtherDetails[0];
														$statusKey = "constants.status_".$order->status;
													?>
													<tr>
														<td align="center">
															<div class="checkbox-new">
															    <input value="<?=$order->id?>" class="float-left" id="order_pro_<?=$order->id?>" name="order.product[]" type="checkbox">
															    <label for="order_pro_<?=$order->id?>" class="float-left font_size_14"></label>
															</div>
														</td>
														<td><?=date('M d Y',strtotime($order->updated_at))?></td>
														<td><?=$order->orderid?></td>
														<td><?=$getOtherDetails->name?></td>
														<td><?=Config::get($statusKey)?></td>
														<td><a href="#">SMS</a> | <a href="#">Email</a></td>
													</tr>
													<?php
													}
												}
											}else{
												echo '<td colspan="6" style="text-align:center">No Results Found</td>';
											}
											?>
										</tbody>
									</table>
								</div>
								<div class="table-btn text-right">
									<ul class="table-foot-btn">
										<li class="selectUnchecked"><a href="javascript:;">Select All</a></li>
										<li class="deselectChecked hide"><a href="javascript:;">Deselect</a></li>
										<li><a href="">Batch Notify</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
</div>

<div id="NotifyEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Notify Clients</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Select which method you want to choose to notify your clients.</p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-success" value="Email">
					<input type="submit" class="btn btn-primary" value="SMS">
				</div>
			</form>
		</div>
	</div>
</div>

@stop

@section('footer')

@stop