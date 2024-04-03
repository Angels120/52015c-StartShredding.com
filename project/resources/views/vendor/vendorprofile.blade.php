<?php
use App\VendorPaymentAccount;
use App\VendorUser;
use App\Helper;
?>
@extends('vendor.includes.master-vendor')

@section('content')
<?php
$activeMenu = 1;
if(isset($_GET['section'])){
	switch ($_GET['section']) {
		case 'company':
			$activeMenu = 1;
			break;
		case 'store-settings':
			$activeMenu = 2;
			break;
		case 'login-users':
			$activeMenu = 3;
			break;
		case 'bank-accounts':
			$activeMenu = 4;
			break;
	}
}
$action = "";
$id = "";
if(isset($_GET['action'])){
	$action= $_GET['action'];	
}
if(isset($_GET['id'])){
	$id= $_GET['id'];	
}
?>

    <div id="page-wrapper">
        <div class="container-fluid">
        	
        	<div id="response">
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
        	
            <div class="row" id="main">
            	
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
            		
					<div class="bg-white p-0">
						<ul class="nav custom-tabs ffourNavs">
						    <li class="<?php if($activeMenu==1){echo 'active';} ?>"><a href="{!! url('vendor/settings') !!}?section=company" class="active">Company</a></li>
						    <li class="<?php if($activeMenu==2){echo 'active';} ?>"><a href="{!! url('vendor/settings') !!}?section=store-settings">Store Settings</a></li>
						    <li class="<?php if($activeMenu==3){echo 'active';} ?>"><a href="{!! url('vendor/settings') !!}?section=login-users">Users</a></li>
						    <li class="<?php if($activeMenu==4){echo 'active';} ?>"><a href="{!! url('vendor/settings') !!}?section=bank-accounts">Bank Accounts</a></li>
						</ul>
					</div>
					<div class="tab-content">
						
					    <div id="companySettings" class="tab-pane fade <?php if($activeMenu==1){echo 'in active';} ?>">
					     	<div class="bg-white">
								<div class="panel-body-custom tableContainParent">
									<form method="POST" action="{!! action('VendorProfileController@update',['setting' => $vendor->id]) !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">
			                            {{csrf_field()}}
			                            <input type="hidden" name="_method" value="PATCH">
			                            <div class="form-group">
			                                <label style="margin-top: 90px;" class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Current Photo <span class="required">*</span>
			                                </label>
			                                <span class="col-md-2 col-sm-6 col-xs-12">
			                                              <img style="width: 120px; height: 120px;" src="{{url('/')}}/assets/images/vendor/{{$vendor->photo}}" id="vendorimg" class="img-circle profile_img" alt="Vendor Photo">
			
			                        		</span>
			                                <div class="col-md-4 col-sm-6 col-xs-12">
			                                    <input class="hidden" onchange="readURL(this)" id="uploadFile" name="photo" type="file">
			                                    <div id="uploadTrigger" onclick="uploadclick()" style="margin-top: 90px;white-space: normal;" class="form-control btn btn-default"><i class="fa fa-upload"></i> Change Photo</div>
			                                </div>
			                            </div>
			
			
			
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Vendor Owner Name <span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="name" placeholder="Vendor Name" value="{{$vendor->name}}" required="required" type="text">
			                                </div>
			                            </div>
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Vendor Shop Name <span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="shop_name" placeholder="Vendor Name" value="{{$vendor->shop_name}}" required="required" type="text">
			                                </div>
			                            </div>
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Email Address <span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="email" placeholder="Vendor Email" value="{{$vendor->email}}" required="required" type="text" disabled>
			                                </div>
			                            </div>
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Phone Number <span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="phone" placeholder="Vendor Phone Number" value="{{$vendor->phone}}" required="required" type="text">
			                                </div>
			                            </div>
			
			                            <div class="ln_solid"></div>
			                            <div class="form-group">
			                                <div class="col-md-6 col-md-offset-3">
			                                    <button type="submit" class="btn btn-success btn-block">Update profile</button>
			                                </div>
			                            </div>
			                        </form>									
								</div>
							</div>
					    </div>
					    
					    
					    <div id="storeSettings" class="tab-pane fade <?php if($activeMenu==2){echo 'in active';} ?>">
					     	<div class="bg-white">
								<div class="panel-body-custom tableContainParent">
									<form method="POST" action="{!! action('VendorProfileController@update',['setting' => $vendor->id]) !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">
			                            {{csrf_field()}}
			                            <input type="hidden" name="_method" value="PATCH">
			                            
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Tax Rate <span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="tax_rate" placeholder="Tax Rate" value="{{$vendor->tax_rate}}" required="required" type="text">
			                                </div>
			                            </div>
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Shipping Fee <span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="shipping_fee" placeholder="Shipping Fee" value="{{$vendor->shipping_fee}}" required="required" type="text">
			                                </div>
			                            </div>
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Late Fee <span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="late_fee" placeholder="Late Fee" value="{{$vendor->late_fee}}" required="required" type="text" >
			                                </div>
			                            </div>
			                            
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Discount % <span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="discount" placeholder="Discount%" value="{{$vendor->discount}}" required="required" type="text" >
			                                </div>
			                            </div>
			                            
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Pickup Fee <span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="pickup_fee" placeholder="Pickup Fee" value="{{$vendor->pickup_fee}}" required="required" type="text" >
			                                </div>
			                            </div>
			                            
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Minimum Order $ <span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="minimum_order" placeholder="Minimum Order $" value="{{$vendor->minimum_order}}" required="required" type="text" >
			                                </div>
			                            </div>
			                            
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Zone<span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="zone" placeholder="Zone" value="{{$vendor->zone}}" required="required" type="text" >
			                                </div>
			                            </div>
			                            
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Plant<span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="plant" placeholder="Plant" value="{{$vendor->plant}}" required="required" type="text" >
			                                </div>
			                            </div>
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Account Manager<span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="account_manager" placeholder="Account Manager" value="{{$vendor->account_manager}}" required="required" type="text" >
			                                </div>
			                            </div>
			                             <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Delivery Service<span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <input class="form-control col-md-7 col-xs-12" name="delivery_service" placeholder="Delivery Service" value="{{$vendor->delivery_service}}" required="required" type="text" >
			                                </div>
			                            </div>
			                             <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Hours of Operation<span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <div class="row">
			                                    	<div class="col-md-6">
			                                    		<div class="">
							                                
							                                <div class="">
							                                    <input class="form-control col-md-7 col-xs-12 datepicker" name="start_time" placeholder="Start Time" value="{{$vendor->start_time}}" required="required" type="text" >
							                                </div>
							                            </div>
			                                    	</div>
			                                    	
			                                    	<div class="col-md-6">
			                                    		<div class="">
							                               
							                                <div class="">
							                                    <input class="form-control col-md-7 col-xs-12 datepicker" name="end_time" placeholder="End Time" value="{{$vendor->end_time}}" required="required" type="text" >
							                                </div>
							                            </div>
			                                    	</div>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class=" form-group">
			                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Notes<span class="required">*</span>
			                                </label>
			                                <div class="col-md-6 col-sm-6 col-xs-12">
			                                    <textarea class="form-control col-md-7 col-xs-12" name="notes" placeholder="Notes" value="{{$vendor->notes}}" required="required"  ></textarea>
			                                </div>
			                            </div>
			                          
			                          
			
			                            <div class="ln_solid"></div>
			                            <div class="form-group">
			                                <div class="col-md-6 col-md-offset-3">
			                                    <button type="submit" class="btn btn-success btn-block">Update profile</button>
			                                </div>
			                            </div>
			                        </form>									
								</div>
							</div>
					    </div>
					    
					    
					    <div id="loginUsers" class="tab-pane fade <?php if($activeMenu==3){echo 'in active';} ?>"> 
					     	<div class="bg-white">
								<div class="panel-body-custom tableContainParent">
									
									<div class="row">										 
										<div class="col-md-6 col-xs-12">
											<h3>User Accounts</h3>
										</div>
										<div class="col-md-6 col-xs-12"> 
											<button class="btn btn-primary" id="addUserAccountTrigger">Add Account</button>
										</div>
									</div>
									
									<?php
									$formStyle = "display: none;";
									$rowId = "";
									$formData = array();
									if($activeMenu==3 && $action=="edit" && $id!=""){
										$formStyle = "";	 
										$formData = VendorUser::find($id)->toArray();;						
									}else if($activeMenu==3 && $action=="add") {
										$formStyle = "";
									} else {
										$formStyle = $formStyle;
									}
									?>
									
									<div id="addUserAccountBox" style ="<?=$formStyle?>">
										<div class="col-md-12">
											<form method="POST" id="addUserForm" action="{!! url('vendor/login-accounts') !!}" class="form-horizontal form-label-left ajaxForm" enctype="multipart/form-data">
					                            {{csrf_field()}}
					                            <input type="hidden" name="id" value="<?=Helper::findInPost('id',$formData)?>" />					                            
					                            <div class="row">
					                            	<div class="errorbox"></div>
					                            	
					                            	<div class="col-md-12 col-xs-12">
					                            		<div class=" form-group">
							                                <label for="name"> Username <span class="required">*</span></label>
							                                <input class="form-control col-md-7 col-xs-12" name="username" placeholder="Username" value="<?=Helper::findInPost('username',$formData)?>" required="required" type="text">
							                            </div>
					                            	</div>
					                            	
					                            	<div class="col-md-12 col-xs-12">
					                            		 <div class=" form-group">
							                                <label for="name">Email<span class="required">*</span></label>
							                                <input class="form-control col-md-7 col-xs-12" name="email" placeholder="Email" value="<?=Helper::findInPost('email',$formData)?>" required="required" type="text">
							                            </div>
					                            	</div>
					                            	
					                            	<div class="col-md-12 col-xs-12">
					                            		 <div class=" form-group">
							                                <label for="name"> Password <span class="required">*</span></label>
							                                <input class="form-control col-md-7 col-xs-12" name="password" placeholder="Password" value="<?=Helper::findInPost('password',$formData)?>" required="required" type="text">
							                            </div>
					                            	</div>
												</div>
												
												<input type="hidden" id="form_type" name="form_type" value="user">
					                            					
					                            <div class="ln_solid"></div>
					                            
					                             <div class="row">
					                            	<div class="col-md-12 col-xs-12">
					                            		 <div class=" form-group">
							                                <button type="submit" class="btn btn-success btn-block">Save Account</button>
							                            </div>
					                            	</div>
					                            </div>
					                            
					                        </form>	
										</div>
									</div>
									
									<div class="table-responsive">
										<table id="loginuser-accounts-table" cellpadding="0" cellspacing="0" class="table table-striped table-bordered data-table">
											<thead>
												<tr>
													<th>Username</th>
													<th>Email</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$allAccounts = DB::table('vendor_members')->where('vendorid',Auth::user()->id)->get();
												if($allAccounts!=null){
													foreach ($allAccounts as $accounts) {
														?>
														<tr>
															<td><?=$accounts->username?></td>
															<td><?=$accounts->email?></td>
															<td>
																<div class="table-actions"> 
																	<a href="{!! url('vendor/settings') !!}?section=login-users&action=edit&id=<?=$accounts->id?>">Edit</a>
																	<a href="{!! url('vendor/delete-login-user') !!}?id=<?=$accounts->id?>">Delete</a>
																</div>
															</td>
														</tr>
														<?php
													}
												}
												?>												
											</tbody>
										</table>
									</div>
																	
								</div>
							</div>
					    </div> 
					    
					     <div id="bankAccounts" class="tab-pane fade <?php if($activeMenu==4){echo 'in active';} ?>">
					     	<div class="bg-white">
								<div class="panel-body-custom tableContainParent">
									
									<div class="row">										 
										<div class="col-md-6 col-xs-12">
											<h3>Bank Accounts</h3>
										</div>
										<div class="col-md-6 col-xs-12"> 
											<button class="btn btn-primary" id="addBankAccount">Add Bank Account</button>
										</div>
									</div>
									
									<?php
									$formStyle = "display: none;";
									$rowId = "";
									$formData = array();
									if($activeMenu==4 && $action=="edit" && $id!=""){
										$formStyle = "";	
										$formData = VendorPaymentAccount::find($id)->toArray();;						
									}
									?>
									
									<div id="bankAccountBox" style="<?=$formStyle?>">
										<div class="col-md-12">
											<form method="POST" action="{!! url('vendor/bank-account') !!}" class="form-horizontal form-label-left ajaxForm" enctype="multipart/form-data">
					                            {{csrf_field()}}
					                            <input type="hidden" name="id" value="<?=Helper::findInPost('id',$formData)?>" />					                            
					                            <div class="row">
					                            	<div class="errorbox"></div>
					                            	<div class="col-md-6 col-xs-12">
					                            		<div class=" form-group">
							                                <label for="name"> Account Name<span class="required">*</span></label>
							                                <input class="form-control col-md-7 col-xs-12" name="name" placeholder="Account Name" value="<?=Helper::findInPost('name',$formData)?>" required="required" type="text">
							                            </div>
					                            	</div>
					                            	<div class="col-md-6 col-xs-12">
					                            		<div class=" form-group">
							                                <label for="name"> Institution <span class="required">*</span></label>
							                                <input class="form-control col-md-7 col-xs-12" name="institution" placeholder="Institution" value="<?=Helper::findInPost('institution',$formData)?>" required="required" type="text">
							                            </div>
					                            	</div>
					                            </div>
					                            
					                            <div class="row">
					                            	<div class="col-md-6 col-xs-12">
					                            		 <div class=" form-group">
							                                <label for="name"> Account Number <span class="required">*</span></label>
							                                <input class="form-control col-md-7 col-xs-12" name="account_number" placeholder="Account number" value="<?=Helper::findInPost('account_number',$formData)?>" required="required" type="text">
							                            </div>
					                            	</div>
					                            	<div class="col-md-6 col-xs-12">
					                            		 <div class=" form-group">
							                                <label for="name"> PIN/Password <span class="required">*</span></label>
							                                <input class="form-control col-md-7 col-xs-12" name="password" placeholder="PIN/Password" value="<?=Helper::findInPost('password',$formData)?>" required="required" type="text">
							                            </div>
					                            	</div>
					                            </div>
					                            
					                            
					                            <div class="row">
					                            	<div class="col-md-12 col-xs-12">
					                            		 <div class=" form-group">
							                                <label for="name"> Api Url <span class="required">*</span></label>
							                                <input class="form-control col-md-7 col-xs-12" name="api_url" placeholder="Api Url" value="<?=Helper::findInPost('api_url',$formData)?>" required="required" type="text">
							                            </div>
					                            	</div>
					                            </div>
					                            					
					                            <div class="ln_solid"></div>
					                            
					                             <div class="row">
					                            	<div class="col-md-12 col-xs-12">
					                            		 <div class=" form-group">
							                                <button type="submit" class="btn btn-success btn-block">Save Account</button>
							                            </div>
					                            	</div>
					                            </div>
					                            
					                        </form>	
										</div>
									</div>
									
									<div class="table-responsive">
										<table id="ban-accounts-table" cellpadding="0" cellspacing="0" class="table table-striped table-bordered data-table">
											<thead>
												<tr>
													<th>Account Name</th>
													<th>Institution</th>
													<th>Account Number</th>
													<th>PIN/Password</th>
													<th>Api Url</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$allAccounts = DB::table('vendor_payment_accounts')->where('vendorid',Auth::user()->id)->get();
												if($allAccounts!=null){
													foreach ($allAccounts as $accounts) {
														?>
														<tr>
															<td><?=$accounts->name?></td>
															<td><?=$accounts->institution?></td>
															<td><?=$accounts->account_number?></td>
															<td><?=$accounts->password?></td>
															<td><?=$accounts->api_url?></td>
															<td>
																<div class="table-actions"> 
																	<a href="{!! url('vendor/settings') !!}?section=bank-accounts&action=edit&id=<?=$accounts->id?>">Edit</a>
																	<a href="{!! url('vendor/delete-bank-account') !!}?id=<?=$accounts->id?>">Delete</a>
																</div>
															</td>
														</tr>
														<?php
													}
												}
												?>												
											</tbody>
										</table>
									</div>
																	
								</div>
							</div>
					    </div>
					    
					    
					    
					</div>
				</div>

               
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@stop

@section('footer')
<script>

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#vendorimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $(document).on("click","#addBankAccount",function(){
    	$("#bankAccountBox").slideToggle();
    });
    
     $(document).on("click","#addUserAccountTrigger",function(){
		$("#addUserForm")[0].reset();
		window.location.href = "{!! url('vendor/settings') !!}?section=login-users&action=add";
    });
    
    $(document).on("submit", ".ajaxForm", function(e) {    
		
		var formData = $(this);	
	    var type = formData.find("#form_type").val();
		
		var errorBox = formData.find(".errorbox");	
	    errorBox.html("");	
	    var submitBtn = formData.find('button[type="submit"]');
	    var oldHtml = submitBtn.html();	
        submitBtn.html('<i class="fa fa-spinner fa-spin">&nbsp;</i>Processing...'); 
        $.post(formData.attr("action"), formData.serialize(), function(r) {
            if (r != "")
            {
                var data = JSON.parse(r);
                if (data.status == "error") {
                    errorBox.html("<p class='text-danger'>" + data.message + "</p>");
                } else {
                    $(".note-editable").html("");
                    formData[0].reset();
                    errorBox.html("<p class='text-success'>" + data.message + "</p>");
                    //$("#main_content_zone_parent").load(window.location.href+" #main_content_zone");
					if(type == "user") {
						window.location.href="{!! url('vendor/settings') !!}?section=login-users";
					}					
                }
            } else {
                errorBox.html("<p class='text-success'>Something went wrong, Please Try Later!</p>");
            }
            submitBtn.html(oldHtml);
        });
        e.preventDefault();
        return false;
    });
    
</script>
@stop