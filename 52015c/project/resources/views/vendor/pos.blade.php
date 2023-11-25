@extends('vendor.includes.master-vendor')

@section('content')


	<div class="page-title">
		<h2>Products</h2>
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
    
    
	<div class="main-content">
		<div class="">
			
			<div class="page-title">
				<div class="form-group">
					<form action="" method="get">
					<div class="col-md-6">
						<div class="form-inline">
							<select class="form-control width_50" name="category">
								<option value="">Category</option>
								<?php
								$query="SELECT * FROM `categories` WHERE `status`=1";	
								$categories = DB::select(DB::raw($query));
								if($categories!=null){
									foreach($categories as $category){
										?>
										<option <?php if (isset($_GET['category']) && $_GET['category']==$category->id ) { echo 'selected'; } ?> value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
										<?php
									}
								}
								?>
							</select>
							
							<select class="form-control mr-0" name="status">
								<option value="">Status</option>
								<option <?php if (isset($_GET['status']) && $_GET['status']==1 ) { echo 'selected'; } ?> value="1">Active</option>
								<option <?php if (isset($_GET['status']) && $_GET['status']==0 ) { echo 'selected'; } ?> value="0">In Active</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-4 text-center">
								<label style="margin-top:8px;">Search Product</label>
							</div>
							<div class="search-product col-md-5">
								 
							
									<input type="text" value="<?php if (isset($_GET['product']) && $_GET['product']!="" ) { echo $_GET['product']; } ?>" class="form-control" name="product">
									
								
							</div>
							<div class="col-md-3">
								<input type="submit" class="btn btn-success" name="submit" style="margin-top:2px;">
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
					<div class="bg-white"> 
						<div class="panel-body-custom tableContainParent">
							<div class="table-responsive">
								<table data-text="products" cellpadding="0" cellspacing="0" class="table table-bordered table-striped data-table">
									<thead>
										<tr>
											<th>Product ID</th>
											<th>Category</th>										 
											<th>Product Name</th>
											<th>Price</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if($products!=null){
											foreach($products as $product){
												
												?>
												<tr>
													<td><a href="javascript:;"><?php echo $product->id;?></a></td>
													<td><?php
													
														$categories=explode(',', $product->category);
													
														if(count($categories)>0){
															foreach($categories as $category){
																if($category!=""){
																	$categoryDetails="select * from categories where id=".$category;
																	$catDetails=DB::select(DB::raw($categoryDetails));
																	?>
																	<p><strong><?php echo $catDetails[0]->name;?></strong></p>
																	<?php
																}
															}
														}
														?></td>
													
													<td><a href="javascript:;"><?php echo $product->title;?></a></td>
													<td>$<?php echo $product->price;?></td>
													<td>
														<?php
														if($product->status==1){
															echo "Active";
														} 
														else{
															echo "In-active";
														}
														?>
													</td>
												</tr>
												<?php
											}
										}
										else{
										?>
										<tr>
											<td colspan="5">No Data Found</td>
										</tr>
										<?php	
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
			                            <label for="radio-new" class="float-left font_size_14">Clear Selection</label>
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
	</div>

@stop

@section('footer')

@stop