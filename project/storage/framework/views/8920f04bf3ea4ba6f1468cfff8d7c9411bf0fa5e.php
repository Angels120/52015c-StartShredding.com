<?php $__env->startSection('content'); ?>

<div class="page-title">
	<h2>Order History</h2>
</div>
<?php if(Session::has('message')): ?>
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo e(Session::get('message')); ?>

    </div>
<?php endif; ?>
<div class="page-title">
	<form action="" method="get">
	<div class="form-group">
		<div class="form-inline">
			<label>Order#</label>
			<input type="text" class="form-control" name="orderId">
			<select class="form-control" name="time">
				<option value="">Quick Date</option>
				<option value="all">All Time</option>
				<option value="today">Today</option>
				<option value="week">This Week</option>
				<option value="month">This Month</option>
				<option value="year">Year to Date</option>
				<option value="lastYear">Last Year</option>
			</select>
			<div class="custom-dateicker">
				<label>From</label>
				<div id="datepicker2" class="input-group date custom-calendar" data-date-format="mm-dd-yyyy">
				    <input class="form-control datepicker" name="fromTime" type="text" />
				    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
			</div>
			<div class="custom-dateicker">
				<label>To</label>
				<div id="datepicker3" class="input-group date custom-calendar" data-date-format="mm-dd-yyyy">
				    <input class="form-control datepicker" name="toTime" type="text" />
				    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
			</div>
			<select class="form-control" name="process">
				<option value="">Status</option>		
				<option value="1">Pending</option>			    					
				<option value="2">In Transit</option>
				<option value="3">Plant Receive</option>
				<option value="4">Plant Complete</option>
				<option value="5">On Delivery</option>
				<option value="6">Delivery Completed</option>
				<option value="7">Delivery in Store</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		
		<div class="form-inline">
			<div class="pull-left">
				<label>Client Name</label>
			<input type="text" class="form-control width_40" name="clientName">
			<select class="form-control" name="paidStatus">
				<option value="">Payment Status</option>
				<option value="2">Paid</option>
				<option value="pending">Not Paid</option>
			</select>
			</div>
			<!--<select class="form-control width_20">
				<option>Cash</option>
				<option>Credit Card</option>
				<option>BP Credits</option>
				<option>Debit</option>
				<option>Cheque</option>
			</select>-->
			<div class="comments-form pull-left" >
				<input type="submit" name="orderForm"  class="btn btn-success " style="margin: 0;padding: 9px 30px;" value="Search">
			</div>
		</div>
		
	</div>
	
</form>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
		<div class="bg-white">
			<div class="panel panel-body-custom tableContainParent">
				<div class="table-responsive">
					<table data-export="1,2,3,4,5,6" cellpadding="0" cellspacing="0" id="table_1" class="table table-bordered table-striped data-table">
						<thead>
							<tr>
								<th width="5%"></th>
								<th class="hidden-xs hidden-sm" >Date</th>
								<th>Order#</th> 
								<th>Clients</th>
								<th class="hidden-xs hidden-sm" >Status</th>
								<th class="hidden-xs hidden-sm" >Amount</th>
								<th class="hidden-xs hidden-sm" >Pay Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if($orders!=null){
								foreach ($orders as $order) {
									
									$getOtherDetails = DB::select('SELECT * FROM `clients` WHERE id = (SELECT `customerid` FROM `orders` WHERE `id` = ?) ',[$order->orderid]);
									if($getOtherDetails!=null){
										$getOtherDetails = $getOtherDetails[0];
										$statusKey = "constants.status_".$order->status;
										
									}
									?>
									<tr>
										<td align="center">
											<div class="checkbox-new">
											    <input value="<?=$order->id?>" class="float-left" id="order_pro_<?=$order->id?>" name="order.product[]" type="checkbox">
											    <label for="order_pro_<?=$order->id?>" class="float-left font_size_14"></label>
											</div>
										</td>
										<td><?=date('M d, Y',strtotime($order->created_at))?></td>
										<td><a href="<?php echo url('vendor/details/'.$order->orderid); ?>"><?=$order->orderid?></a></td>
										<td><a href="<?php echo url('vendor/profile/'.$getOtherDetails->id); ?>"><?=$getOtherDetails->name?></a></td>
										
										<td class="hidden-xs hidden-sm" ><?=Config::get($statusKey)?></td>
										<?php //number_format((float)$foo, 2, '.', ''); ?>
										<!-- <td class="hidden-xs hidden-sm" >$<?=round($order->cost,2)?></td> -->
										<td class="hidden-xs hidden-sm" ><?=number_format((float)$order->cost,2,'.','')?></td>
										<td class="hidden-xs hidden-sm" ><?=ucfirst($order->payment)?></td>
									</tr>
									<?php	
								}
							}else{
								echo '<tr><td colspan="8" class="text-center">No Data Found</td></tr>';
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="table-btn text-right">
					<div class="left-select-all">
						<ul class="table-foot-btn">
							<li class="selectUnchecked"><a href="javascript:;">Select All</a></li>
							<li class="deselectChecked hide"><a href="javascript:;">Deselect</a></li>
						</ul>
					</div>
					<ul class="table-foot-btn excel-btn">
						<strong>
							<li><a href="javascript:;" class="pdfExport"><i class="fa fa-file-pdf-o"></i><span>Download</span></a></li>
							<li><a href="javascript:;" class="excelExport"><i class="fa fa-file-excel-o"></i><span>Export</span></a></li>
							<li><a href="javascript:;" class="printExport"><i class="fa fa-print"></i><span>Print</span></a></li>
						</strong>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
	

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.includes.master-vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>