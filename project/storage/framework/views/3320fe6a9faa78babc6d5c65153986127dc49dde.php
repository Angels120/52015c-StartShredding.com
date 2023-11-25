<?php $__env->startSection('content'); ?>


	<div class="page-title">
		<h2>Customers</h2>
	</div>
	
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
    
    <div class="page-title">
				<div class="form-group"> 
					<div class="form-inline">
						<form action="" method="get">
							<input class="form-control width_30" value="<?php if (isset($_GET['name']) && $_GET['name']!="" ) { echo $_GET['name']; } ?>" name="name" type="text" placeholder="Search by Name">
							<input class="form-control  width_17" value="<?php if (isset($_GET['phone']) && $_GET['phone']!="" ) { echo $_GET['phone']; } ?>" name="phone" type="text" placeholder="Phone">
							<input class="form-control  width_17" value="<?php if (isset($_GET['email']) && $_GET['email']!="" ) { echo $_GET['email']; } ?>" name="email" type="text" placeholder="Email">
							<select class="form-control width_17" name="city">
								<option value="">Select City</option>
								<?php
								$query="SELECT * FROM `clients` WHERE `status`=1  group by city";	
								$cities = DB::select(DB::raw($query));
								if($cities!=null){
									foreach($cities as $city){
										if($city->city!=null && $city->city!=""){
										?>
										<option <?php if (isset($_GET['city']) && $_GET['city']==$city->name ) { echo 'selected'; } ?> value="<?php echo $city->city;?>"><?php echo $city->city;?></option>
										<?php
										}
									}
								}
								?>
								
							</select>
							<input class="form-control mr-0  width_17" value="<?php if (isset($_GET['zip']) && $_GET['zip']!="" ) { echo $_GET['zip']; } ?>" name="zip" type="text" placeholder="Postal Code">
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="comments-form " style="display:inline-block;padding-left:50px;" >
								<input type="submit" class="btn btn-success " style="margin: 0;padding: 9px 30px;" value="Search">
							</div>
						</div>
						<div class="col-md-4"></div>
					</div>
							
				</div>			
							<!--<input type="submit" style="display: none;" />-->
						</form>
					
				
			</div> 
			<div class="row"> 
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
					<div class="bg-white">
						<div class="panel-body-custom tableContainParent panel">
							<div class="table-responsive">
								<table data-export="1,2,3,4,5,6" data-text="customers" id="customer-table" cellpadding="0" cellspacing="0" class="table table-bordered table-striped data-table">
									<thead>
										<tr>
											<th></th>
											<th>Name</th>
											<th>Address</th>
											<th>City</th>
											<!--<th>Province</th>-->
											<th>Postal Code</th>
											<th>Phone </th>
											<th>Email</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if($customers != null){
											foreach($customers as $customer){
											
												$userDetails="Select * from clients where id=".$customer->customerid;
												$data = DB::select(DB::raw($userDetails));
												
												if($data!=null){
													$data=$data[0];
												?>
												<tr>
													<td align="center">
														<div class="checkbox-new">
														    <input class="float-left ids" name="ids[]" value="<?php echo $data->id;?>" name="remember" type="checkbox">
														    <label for="radio-new" class="float-left font_size_14"></label>
														</div>
													</td>
													
													<td>
														<?php
														if($data->name!=""){
														?>
														<a href="<?php echo url('vendor/profile/'.$data->id); ?>"><?php 
													
														echo $data->name;	
														?>
														</a>
														<?php
														
													}
													?></a></td>
													<td><?php
													if($data->address!=""){
													 echo $data->address;
													}
													 ?></td>
													<td><?php 
													if($data->city!=""){
													echo $data->city;
													}
													?></td>
													<!--<td>ON</td>-->
													<td><?php
													if($data->zip!=""){
													 echo $data->zip;
													 }
													 ?></td>
													<td><?php
													if($data->phone!=""){
													 echo $data->phone;
													 }
													 ?></td>
													<td><?php 
													if($data->email!=""){
													echo $data->email;
													}
													?></td>
													<td align="center"><a href="javascript:;" class="simple-link sendMail markMeFirst"><i class="fa fa-envelope-o"></i></a></td>
												</tr>
												
												
												<?php
												}
												
											}
										}
										else{
										?>
										<tr>
											<td colspan="8">No Data Found</td>
										</tr>
										<?php	
										}
										?>
										
										
									</tbody>
								</table>
							</div>
							<div class="table-btn text-right">
								<div class="left-select-all checkBoxActionParents">
									<div class="checkbox-new">
			                            <input class="float-left selectAllCheckbox" id="rememberSelectAll" name="remember" type="checkbox">
			                            <label for="rememberSelectAll" class="float-left font_size_14">Select All</label>
			                        </div>
			                        <div class="checkbox-new">
			                            <input class="float-left clearAllCheckbox" id="rememberClear" name="remember" type="checkbox">
			                            <label for="rememberClear" class="float-left font_size_14 ">Clear Selection</label>
			                        </div>
								</div>
								<ul class="table-foot-btn excel-btn">
									<li><a href="javascript:;" class="pdfExport"><i class="fa fa-file-pdf-o"></i><span>Download</span></a></li>
									<li><a href="javascript:;" class="excelExport"><i class="fa fa-file-excel-o"></i><span>Export</span></a></li>
									<li><a href="javascript:;" class="printExport"><i class="fa fa-print"></i><span>Print</span></a></li>
									<li><button type="submit" class="bulkEmailTrigger bigBtnhref sendMail"><i class="fa fa-envelope"></i><span>Bulk Email</span></button></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="modal fade" id="modal" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">Email</h4>
			      </div>
			       <form action="<?php echo action('VendorController@customers'); ?>" method="post">
			       	<?php echo e(csrf_field()); ?>

				      <div class="modal-body"> 	
				       	<div class="form-group">
				       		<input placeholder="Subject" class="form-control" type="subject" name="subject" required="" />
				       	</div>
				       	<div class="form-group">
				       		<textarea placeholder="Message" class="form-control" name="message" required="" /></textarea>
				       	</div>
				       	<input type="hidden" class="customerId" name="customerId">
				       	<input type="hidden" name="task" value="email">
				      </div>
				      <div class="modal-footer">
				        <button type="submit" name="save" class="btn btn-primary">Send Mail</button>
				      </div>
			       </form>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div>
			
<script>
	$(document).on("click",".markMeFirst",function(){
		$(this).closest("tr").find("input").prop("checked",true);
	});
	$(document).on('click','.sendMail',function(){
		var ids = [];
        $(".ids:checked").each(function(){
            ids.push($(this).val());
        });
        if(ids.length>0){
        	$('.customerId').val(ids);
        	$('#modal').modal('show');
        }
	});
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.includes.master-vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>