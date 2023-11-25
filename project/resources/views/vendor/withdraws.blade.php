@extends('vendor.includes.master-vendor')

@section('content')


	<div class="page-title">
		<h2>Finances</h2>
	</div>
	
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
	
	<div class="row"> 
		<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 left-table">
			<div class="bg-white p-0">
				<ul class="nav custom-tabs">
				    <li class="active"><a data-toggle="tab" href="#earning" class="active">Earnings</a></li>
				    <li><a data-toggle="tab" href="#withdraw">Withdraw</a></li>
				    <li><a data-toggle="tab" href="#history">History</a></li>
				</ul>
			</div>
			<div class="tab-content">
			    <div id="earning" class="tab-pane fade in active">
			    	<div class="page-title custom">
			    		<form action="" method="get">
			    		<div class="form-group">
			    			<label>Order#</label>
			    			<div class="form-inline">
			    				<input type="text" class="form-control width_100" name="orderId">
			    				<select class="form-control" name="time">
			    					<option value="">Quick Date</option>
			    					<option value="all">All Time</option>
			    					<option value="today">Today</option>
			    					<option value="week">This Week</option>
			    					<option value="month">This Month</option>
			    					<option value="year">Year to Date</option>
			    					<option value="lastYear">Last Year</option>
			    					
			    				</select>
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
			    				
			    			</div>
			    		</div>
			    		<div class="form-group">
			    			<label>Customer Name</label>
			    			<div class="form-inline">
			    				<input type="text" name="clientName" class="form-control width_100" name="">
			    			</div>
			    			<input type="submit" style="display:none;" name="earningbtn">
			    		</div>
			    	</form>
			    	</div>
			     	<div class="bg-white">
						<div class="panel-body-custom tableContainParent">
							<div class="table-responsive">
								<table data-export="1,2,3,4,5,6,7" id="earnings-table" cellpadding="0" cellspacing="0" class="table table-striped table-bordered data-table">
									<thead>
										<tr>
											<th width="5%"></th>
											<th>Date</th>
											<th><a href="">Order#</a></th>
											<th>Order Type</th>
											<th><a href="">Client</a></th>
											<th>Invoice Amount</th>
											<th>Fees</th>
											<th>Net Amount</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$total=0;
										$fee=0;
										if($earnings!=null){
											foreach ($earnings as $earning) {
												$getCustomerDetails = DB::select('SELECT * FROM `clients` WHERE id = '.$earning->customerid);
												if($getCustomerDetails!=null){
													$getCustomerDetails = $getCustomerDetails[0];
													$statusKey = "constants.order_".$earning->order_type;
												?>
												<tr>
													<td align="center">
														<div class="checkbox-new">
														    <input class="float-left" id="remember" name="remember" type="checkbox">
														    <label for="radio-new" class="float-left font_size_14"></label>
														</div>
													</td>
													<td><?=date('M/d/y',strtotime($earning->created_at))?></td>
													<td><a href="{!! url('vendor/details/'.$earning->orderid) !!}"><?=$earning->orderid?></a></td>
													<td><?=Config::get($statusKey)?></td>
													<td><a href="{!! url('vendor/profile/'.$getCustomerDetails->id) !!}"><?=$getCustomerDetails->name?></a></td>
													<td>$<?=$earning->cost?></td>
													<td>$(0)</td> 
													<td>$<?=$earning->cost?></td>
													<?php $total+=$earning->cost;?>
												</tr>
												<?php
												}
											}
										}
										?>
									</tbody>
								</table>
							</div>
							<div class="table-btn text-right">
								<div class="left-select-all">
									<div class="checkbox-new">
			                            <input class="float-left" id="remember" name="remember" type="checkbox">
			                            <label for="radio-new" class="float-left font_size_14">Select All</label>
			                        </div>
			                        <div class="checkbox-new">
			                            <input class="float-left" id="remember" name="remember" type="checkbox">
			                            <label for="radio-new" class="float-left font_size_14">Select None</label>
			                        </div>
								</div>
								<ul class="table-foot-btn excel-btn custom">
									<li><a href="javascript:;" class="pdfExport"><i class="fa fa-file-pdf-o"></i><span>Download</span></a></li>
									<li><a href="javascript:;" class="excelExport"><i class="fa fa-file-excel-o"></i><span>Export</span></a></li>
									<li><a href="javascript:;" class="printExport"><i class="fa fa-print"></i><span>Print</span></a></li>
								</ul>
								<div class="page-total">
									<div class="total">
										<h4>Page Total</h4>
										<span>$<?php echo $total;?></span>
									</div>
									<div class="totle grand">
										<h4>Grand Total</h4>
										<span>$<?php echo $total;?></span>
									</div>
								</div>
								
							</div>
						</div>
					</div>
			    </div>
			    <div id="withdraw" class="tab-pane fade in">
			      	<div class="bg-white">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="top-title">
									<h3>Withdraw Funds</h3>
								</div>
							</div>
							<div class="panel-body">
								<div class="col-lg-8 col-lg-offset-2">
									<form role="form" method="POST" action="{{ route('account.withdraw.submit') }}" class="form-horizontal form-label-left withdraw-form">
		                                {{ csrf_field() }}
		
		                                <div class="form-group">
		                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Withdraw Method<span class="required">*</span>
		
		                                    </label>
		                                    <div class="col-md-6 col-sm-6 col-xs-12">
		                                        <select class="form-control" name="methods" id="withmethod" required>
		                                            <option value="">Select Withdraw Method</option>
		                                            <option value="Paypal">Paypal</option>
		                                            <option value="Skrill">Skrill</option>
		                                            <option value="Payoneer">Payoneer</option>
		                                            <option value="Bank">Bank</option>
		                                        </select>
		                                    </div>
		                                </div>
		
		                                <div class="form-group">
		                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Withdraw Amount<span class="required">*</span>
		
		                                    </label>
		                                    <div class="col-md-6 col-sm-6 col-xs-12">
		                                        <input name="amount" placeholder="Withdraw Amount" value="{{ old('amount') }}" class="form-control"  type="text" required>
		                                    </div>
		                                </div>
		
		                                <div id="paypal" style="display: none;">
		
		                                    <div class="form-group">
		                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Enter Account Email<span class="required">*</span>
		
		                                        </label>
		                                        <div class="col-md-6 col-sm-6 col-xs-12">
		                                            <input name="acc_email" value="{{ old('email') }}" placeholder="Enter Account Email" class="form-control" type="email">
		                                        </div>
		                                    </div>
		
		                                </div>
		                                <div id="bank" style="display: none;">
		
		                                    <div class="form-group">
		                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Enter IBAN/Account No:<span class="required">*</span>
		
		                                        </label>
		                                        <div class="col-md-6 col-sm-6 col-xs-12">
		                                            <input name="iban" value="{{ old('iban') }}" placeholder="Enter IBAN/Account No" class="form-control" type="text">
		                                        </div>
		                                    </div>
		
		                                    <div class="form-group">
		                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Enter IBAN/Account No:<span class="required">*</span>
		
		                                        </label>
		                                        <div class="col-md-6 col-sm-6 col-xs-12">
		                                            <input name="acc_name" value="{{ old('accname') }}" placeholder="Enter Account Name" class="form-control" type="text">
		                                        </div>
		                                    </div>
		
		                                    <div class="form-group">
		                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Enter IBAN/Account No:<span class="required">*</span>
		
		                                        </label>
		                                        <div class="col-md-6 col-sm-6 col-xs-12">
		                                            <input name="address" value="{{ old('address') }}" placeholder="Enter Address" class="form-control" type="text">
		                                        </div>
		                                    </div>
		
		                                    <div class="form-group">
		                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Enter IBAN/Account No:<span class="required">*</span>
		
		                                        </label>
		                                        <div class="col-md-6 col-sm-6 col-xs-12">
		                                            <input name="swift" value="{{ old('swift') }}" placeholder="Enter Swift Code" class="form-control" type="text">
		                                        </div>
		                                    </div>
		
		                                </div>
		
		                                <div class="form-group">
		                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Additional Referance(Optional):<span class="required">*</span>
		
		                                    </label>
		                                    <div class="col-md-6 col-sm-6 col-xs-12">
		                                        <textarea class="form-control" name="reference" rows="6" placeholder="Additional Referance(Optional)">{{ old('reference') }}</textarea>
		                                    </div>
		                                </div>
		
		                                <div id="resp" class="col-md-6 col-md-offset-3">
		
		                                    @if($settings[0]->withdraw_fee > 0)
		                                        <span class="help-block">
		                                <strong>Withdraw Fee {{$settings[0]->currency_sign}}{{ $settings[0]->withdraw_fee }} and {{ $settings[0]->withdraw_charge }}% will deduct from your account.</strong>
		                            </span>
		                                    @endif
		                                </div>
		                                <div class="form-group">
		                                    <div class="col-md-6 col-md-offset-3">
		                                        <button type="submit" class="btn btn-success btn-block">Withdraw</button>
		                                    </div>
		                                </div>
		                            </form>
									<div class="thank-you-box text-center">
										<h3>Thank you</h3>
										<p>Your Withdrawal Request has been sent <br> and will be processed within the next two <br> business days</p>
										<label>Reference #0144575</label>
									</div>
								</div>
							</div>
						</div>
					</div>
			    </div>
			    <div id="history" class="tab-pane fade in">
			      	<div class="page-title custom">
			      		<form action="" method="get">
			    		<div class="form-group">
			    			<label>REF#</label>
			    			<div class="form-inline">
			    				<input type="text" class="form-control width_100" name="ref">
			    				<select class="form-control" name="time">
			    					<option value="">Quick Date</option>
			    					<option value="all">All Time</option>
			    					<option value="today">Today</option>
			    					<option value="week">This Week</option>
			    					<option value="month">This Month</option>
			    					<option value="year">Year to Date</option>
			    					<option value="lastYear">Last Year</option>
			    				</select>
			    				<!--<select class="form-control" name="type">
			    					<option value="">Deposit</option>
			    					<option value="">Withdrawal</option>
			    				</select>-->
			    				<div class="custom-dateicker">
			    					<label>From</label>
			    					<div id="datepicker4" class="input-group date custom-calendar" data-date-format="mm-dd-yyyy">
			    					    <input class="form-control datepicker" name="fromTime" type="text" />
			    					    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			    					</div>
			    				</div>
			    				<div class="custom-dateicker">
			    					<label>To</label>
			    					<div id="datepicker5" class="input-group date custom-calendar" data-date-format="mm-dd-yyyy">
			    					    <input class="form-control datepicker" name="toTime" type="text" />
			    					    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			    					</div>
			    				</div>
			    				
			    			</div>
			    		</div>
			    		<input type="submit" name="historybtn" style="display:none;">
			    		</form>
			    	</div>
			     	<div class="bg-white">
						<div class="panel-body-custom tableContainParent">
							<div class="table-responsive">
								<table data-export="1,2,3,4,5,6" id="history-table" cellpadding="0" cellspacing="0" class="table table-bordered table-striped data-table">
									<thead>
										<tr>
											<th width="5%"></th>
											<th>Date</th>
											<th>Reference#</th>
											<th>Method</th>
											<th>Amount</th>
											<th>Fee</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										
										if($getHistory!=null){
											foreach($getHistory as $single){
										?>
												<tr>
													<td align="center">
														<div class="checkbox-new">
														    <input class="float-left" id="remember" name="remember" type="checkbox">
														    <label for="radio-new" class="float-left font_size_14"></label>
														</div>
													</td>
													<td><?php echo date('M/d/Y',strtotime($single->updated_at)); ?></td>
													<td><a href="javascript:;"><?php echo $single->reference;?></a></td>
													<td><a href="javascript:;"><?php echo $single->method;?></a></td>
													<td>$<?php echo $single->amount;?></td>
													<td>$(<?php echo $single->fee;?>)</td>
													<td><?php echo $single->status;?></td>
												</tr>
										<?php
											}
										}
										?>
										
										
										
									</tbody>
								</table>
							</div>
							<div class="table-btn text-right">
								<div class="left-select-all">
									<div class="checkbox-new">
			                            <input class="float-left" id="remember" name="remember" type="checkbox">
			                            <label for="radio-new" class="float-left font_size_14">Select All</label>
			                        </div>
			                        <div class="checkbox-new">
			                            <input class="float-left" id="remember" name="remember" type="checkbox">
			                            <label for="radio-new" class="float-left font_size_14">Select None</label>
			                        </div>
								</div>
								<ul class="table-foot-btn excel-btn">
									<li><a href="javascript:;" class="pdfExport"><i class="fa fa-file-pdf-o"></i><span>Download</span></a></li>
									<li><a href="javascript:;" class="excelExport"><i class="fa fa-file-excel-o"></i><span>Export</span></a></li>
									<li><a href="javascript:;" class="printExport"><i class="fa fa-print"></i><span>Print</span></a></li>
								</ul>
							</div>
						</div>
					</div>
			    </div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 left-table">
			<div class="bg-yellow account-blnce text-center">
				<span>Account Balance</span>
				<h2>$<?php echo $total; ?></h2>
			</div>
			<div class="bg-yellow">
				<div class="sale-summary">
					<div class="order-title mt-0">
						<h4>Account Summary</h4>
					</div>
					<form method="get" action="" id="filterModel"> 
						<select onchange="document.getElementById('filterModel').submit();" class="form-control" name="sideTime">
							<option <?php if(isset($_GET['sideTime'])){ if($_GET['sideTime']=="all"){ echo 'selected=""'; }}?> value="all">All Time</option>
							<option <?php if(isset($_GET['sideTime'])){ if($_GET['sideTime']=="today"){ echo 'selected=""'; }}?> value="today">Today</option>
							<option <?php if(isset($_GET['sideTime'])){ if($_GET['sideTime']=="week"){ echo 'selected=""'; }}?> value="week">This Week</option>
							<option <?php if(isset($_GET['sideTime'])){ if($_GET['sideTime']=="month"){ echo 'selected=""'; }}?> value="month">This Month</option>
							<option <?php if(isset($_GET['sideTime'])){ if($_GET['sideTime']=="year"){ echo 'selected=""'; }}?> value="year">This Year</option> 
							
						</select>  
					</form>
					<div class="sales">
						<p><b>Sales:</b> <span><a href="">$<?php echo $total; ?></a></span></p>
						<p><b>Fee Paid:</b> <span><a href="">($0)</a></span></p>
					</div>
					<div class="net-profit">
						<label>Net Earnings:&nbsp; <b>$<?php echo $total; ?></b></label>
					</div>
				</div>
			</div>
		</div>
	</div>

    
<script>
	 $("#withmethod").change(function(){
        var method = $(this).val();
        if(method == "Bank"){

            $("#bank").show();
            $("#bank").find('input, select').attr('required',true);

            $("#paypal").hide();
            $("#paypal").find('input').attr('required',false);

        }
        if(method != "Bank"){
            $("#bank").hide();
            $("#bank").find('input, select').attr('required',false);

            $("#paypal").show();
            $("#paypal").find('input').attr('required',true);
        }
        if(method == ""){
            $("#bank").hide();
            $("#paypal").hide();
        }

    })
</script>
@stop

@section('footer')

@stop