@extends('includes.newmaster2')

<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> -->
<!-- <html xmlns="http://www.w3.org/1999/xhtml"><head> -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
<meta name="description" content="" />
<meta name="keywords" content=""/>

<link href='http://fonts.googleapis.com/css?family=Lato:400,100italic,100,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('project/public/clientorder-css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('project/public/clientorder-css/font-awesome.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('project/public/clientorder-css/style.css?v=1.2')}}"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/jquery1.11.3.min.js')}}"  ></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/bootstrap3.3.4.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/picker.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/picker.date.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/validate.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/validate_init.js?v=1.0')}}"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/function.js')}}"></script>

<style>
.plussigncenetr {top:0px !important;}
.boxed .inner{width:100%;}
</style>
<!-- </head> -->
@section('content')

<!--------------------------------common header ends----------------------------------------------------------->
   	<section class="main-container">
			<div class="container">

            <div class="row">
           		<div class="col-xs-12">
                    <h3 class="request-quote"></h3>
                    <div class="boxed no-padding">
											@if ($message = Session::get('flash_message'))
											<div class="alert alert-success fade-message" role="alert">

											  {{ $message }}
											    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											        <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
											    </button>
											</div>
											@endif
                        <div class="inner">
                            <div id="wizard-form" class="wizard">
                                <ul class="steps">
                                    <li data-target="step1" class="active"><span class="badge badge-info">1</span>Customer<span class="chevron"></span></li>
                                    <li data-target="step2"><span class="badge">2</span>Service<span class="chevron"></span></li>
                                    <li data-target="step3"><span class="badge">3</span>Contact Info<span class="chevron"></span></li>
                                    <li data-target="step4"><span class="badge">4</span>Confirm<span class="chevron"></span></li>
                                </ul>
                            </div>
                            <div class="step-content">
                              <form method=""  enctype="multipart/form-data" action="{{route('clientorder.store')}}" name="clientorderform" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12">
                				<!-- Step 1 Start -->
                                <div class="step-pane step1">
                                    <div class="map-section">
                                        <div id="locationField">
                                            <input autocomplete="off" id="autocomplete" placeholder="Enter address here" type="text"></input>
                                            <ul id="result" class="serachwrap"></ul>
                                        </div>
                                        <div id="map"></div>
                                    </div>
                                	<div class="address-form-block col-md-6 col-sm-12 col-xs-12 hide">
                                 		<!-- <h3>Verify Address</h3> -->
                                  	<div class="row">
                                    <div class="col-xs-12">
                                      <label class="control-label col-sm-3"  for="address">Address:</label>
                                      <div class="col-sm-9">
                                      <input type="text" name="address" id="address" placeholder="Enter address" value="">
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
                                      <label class="control-label col-sm-3"for="street_no">Street No:</label>
                                      <div class="col-sm-9">
                                      <input type="text" name="street_no" id="street_no" placeholder="Enter Street No" value="">
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
                                      <label class="control-label col-sm-3"for="unit">Unit:</label>
                                      <div class="col-sm-9">
                                      <input type="text" name="unit" id="unit" placeholder="Enter Unit" value="">
                                      </div>
                                    </div>

                                    <div class="col-xs-12">
                                      <label class="control-label col-sm-3" for="state">State/Province:</label>
                                      <div class="col-sm-9">
                                      <input type="text" name="state" id="state" placeholder="Enter state/province" value="">
                                        <!-- <select name="stae" id="state" value="">
                                            <option value="">--State--</option>
                                            <option value="Alberta">Alberta</option>
                                            <option value="British Columbia">British Columbia</option>
                                            <option value="Manitoba">Manitoba</option>
                                            <option value="New Brunswick">New Brunswick</option>
                                            <option value="Newfoundland">Newfoundland</option>
                                            <option value="Northwest Territorie">Northwest Territorie</option>
                                            <option value="Nova Scotia">Nova Scotia</option>
                                            <option value="Nunavut">Nunavut</option>
                                            <option value="Ontario">Ontario</option>
                                            <option value="Prince Edward Island">Prince Edward Island</option>
                                            <option value="Квебек">Quebec</option>
                                            <option value="Saskatchewan">Saskatchewan</option>
                                            <option value="Yukon">Yukon</option>
                                         </select> -->
                                      </div>
                                    </div>
                                        <div class="col-xs-12">
                                            <label class="control-label col-sm-3" for="service_requested">City:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="city" id="city" placeholder="Enter your city" value="">
                                            </div>
                                        </div>
                                    <div class="col-xs-12">
                                      <label class="control-label col-sm-3" for="zip">Zip/Postal Code:</label>
                                      <div class="col-sm-9">
                                      <input type="text" name="zip" id="zip" placeholder="Enter zip/postal code" value="">
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
<!--                                      <label class="control-label col-sm-3" for="country">Country:</label>-->
                                      <div class="col-sm-9">
                                      <input type="hidden" name="country"  id="country" value="CA">
                                      </div>
                                    </div>
                                 	<div class="text-right col-xs-12">
                                      <div class="actions col-xs-12">
                                        <button type="button" data-next="step2" class="btn btn-md login-btn btn-next">Next<i class="icon-arrow-right"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                	</div>
                                </div>
                                <!-- Step 2 Start -->
                                 <div class="step-pane step2">
                                  <div class="row">


				                                <div class="col-sm-12 col-xs-12 col-md-12 service-block">

				                                    <table class="items">
				                                        <thead>
				                                            <tr>
				                                                <td style="width: 20%;"> <b>ITEM</b></td>
				                                                <td style="width: 15%;"><b>QTY</b></td>
				                                                <td class="rateCol" style="width: 10%;"><b>RATE</b></td>
				                                                <td class="totalCol" style="width: 10%;"><b>TOTAL</b></td>
				                                                <td style="width: 15%;"></td>
				                                            </tr>
				                                        </thead>
				                                        <tbody>
				                                            <tr class="item">
				                                                <td>
				                                                    <div class="form-group">
				                                                        <div>
							<select required name="cmb_order_item[]" id="cmb_order_item" class="itemSelect form-control" style="width:250px;">
							<option value="">Select</option>
							<?php
							foreach ($order_items as $order_item) {
										$selected = "";
										if ($order_item->title == "DNS -- Per File Box") {
												$selected = "selected='selected'";
										}
										echo "<option value='" . $order_item->id . "' " . $selected . ">" . $order_item->title . "</option>";
							}?>
							</select>
				                                                        </div>
				                                                    </div>
				                                                </td>
				                                                <td>
				                                                    <div class="form-group">
				                                                        <div class="col-sm-6" style="padding-left: 0px;">
				                                                            <input required name="txt_qty[]" class="itemQty form-control" min="1"  type="number" id="txt_qty">
				                                                        </div>
				                                                    </div>
				                                                </td>
				                                                <td>
				                                                    <div class="form-group">
				                                                        <div class="rate form-control-static">$0.00</div>
				                                                        <input type="hidden" name="hf_base_price[]" class="hf_base_price form-control" value="">
				                                                    </div>
				                                                </td>
				                                                <td>
				                                                    <div class="form-group">
				                                                        <div class="total form-control-static">$0.00</div>
				                                                        <input type="hidden" name="hf_tax[]" class="hf_tax" value="">
				                                                    </div>
																	<div style="display:none" class="tax form-control-static">$0.00</div>
				                                                </td>
															</tr>
				                                        </tbody>
				                                        <tfoot>
				                                            <tr>
				                                                <td colspan="5" class="action"><button class="btn btn-default" style="padding: 3px 10px;" id="addItem" type="button">
                                                          <i class="fa fa-plus plussigncenetr" style="font-size: 18px;"></i>
                                                        </button></td>
				                                            </tr>
				                                            <!-- <tr>
				                                                <td colspan="5">&nbsp;</td>
				                                            </tr> -->
				                                            <tr>
				                                                <td colspan="3" align="right">
				                                                    <b>Subtotal</b> :
				                                                    <input type="hidden" name="hf_subtotal" id="hf_subtotal" value="">
																</td>
																<td>
				                                                    <span class="subtotal">$0.00</span>
				                                                </td>
															</tr>
															<tr>
															<td colspan="3" align="right">
																<b>Tax</b> :
															</td>
															 <td>
				                                                <span class="finalTax">$0.00</span>
																<input type="hidden" name="hf_totaltax" id="hf_totaltax" value="">
				                                            </td>
															</tr>
				                                            <tr>
				                                                <td colspan="3" class="big-text" align="right">
				                                                    <b>Grand Total</b> :
				                                                    <input type="hidden" name="hf_grandtotal" id="hf_grandtotal" value="">
																</td>
																<td>
				                                                <span class="grandTotal">$0.00</span>
				                                            	</td>
				                                            </tr>
				                                        </tfoot>
				                                    </table>
				                                    <div class="text-right col-xs-12">
				                                        <div class="actions col-xs-12">

				                                        </div>
				                                    </div>
				                                    <div class="form-group"></div>
				                                    <div class="form-group"></div>
				                                </div>


                                    <div class="text-right col-xs-12">
                                      <div class="actions col-xs-12">
                                      	<a class="btn btn-default  btn-prev" href="javascript:;" data-back="step1"></i>Back</a>
                                        <button style="margin-left: 5px;" type="button" data-next="step3" class="btn btn-md login-btn btn-next orderformsubmit">Next<i class="icon-arrow-right"></i></button>
                                      </div>
                                    </div>
                                   </div>
                                 </div>
																 <!-- step3 start -->
																 <!-- Step3 Start -->
                                <div class="step-pane step3">
                                  	<div class="row">
                                        <div class="col-xs-12">
                                            <label class="control-label col-sm-2" for="company">Company:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="company" id="company" placeholder="Enter company" value="">
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                          <label class="control-label col-sm-2" for="firstname">First Name:</label>
                                          <div class="col-sm-10">
                                            <input type="text" name="firstname" id="firstname" placeholder="Enter first name" value="">
                                          </div>
                                        </div>
                                        <div class="col-xs-12">
                                          <label class="control-label col-sm-2" for="lastname">Last Name:</label>
                                          <div class="col-sm-10">
                                            <input type="text" name="lastname" id="lastname" placeholder="Enter last name" value="">
                                          </div>
                                        </div>
                                        <div class="col-xs-12">
                                          <label class="control-label col-sm-2" for="email">Email:</label>
                                          <div class="col-sm-10">
                                            <input type="text" name="email" id="email" placeholder="Enter email" value="">
                                          </div>
                                        </div>
																				<div class="col-xs-12">
																					<label class="control-label col-sm-2" for="password">Password:</label>
																					<div class="col-sm-10">
																						<input type="password" name="password" id="password" placeholder="Enter Password" value="">
																					</div>
																				</div>
                                        <div class="col-xs-12">
                                          <label class="control-label col-sm-2" for="phone">Phone:</label>
                                          <div class="col-sm-10">
                                            <input type="text" name="phone" id="phone" placeholder="Enter phone" value="">
                                          </div>
                                        </div>
                                        <div class="text-right col-xs-12">
                                          <div class="actions col-xs-12">
                                            <a class="btn btn-default  btn-prev" href="javascript:;" data-back="step2"></i>Back</a>
                                            <button type="button" style="margin-left: 5px;" data-next="step4" class="btn btn-md login-btn btn-next">Next<i class="icon-arrow-right"></i></button>
                                          </div>
                                     	</div>
                                	</div>
                                </div>
                                <!-- Step4 Start -->
                                <div class="step-pane step4">
                                  	<div class="row">

																			<h1 align="center">Terms & Conditions</h1>
																			<div class="text-right col-xs-12">
																				<div class="actions col-xs-12">
																					<a class="btn btn-default  btn-prev" href="javascript:;" data-back="step3"></i>Back</a>
																					<button type="submit" style="margin-left: 5px;" class="btn btn-md login-btn" onclick="clientorderform.submit();">Submit</button>
																				</div>
																			</div>
                                	</div>
                                </div>
                                <!-- <span class="form-control-static">Remove</span> -->
                               </form>
            				</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <footer>
         <div class="container">
            <div class="row">
                <div class="col-xs-12">
                </div>
                <div class="col-xs-12 copyright">
                	&copy; 2019 LocalShredding.ca by shredEX Inc.
                </div>
            </div>
         </div>
    </footer> -->

		@stop

<!----------------- javascript for map address--------------------------------------->



@section('footer')


<script type="text/javascript">

$(document).ready(function(){
	 var myLatLng = {lat: 47.774241,lng: -94.031905};
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 4,
		center: myLatLng
	});

	var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
      };
	  var component_map = {
        street_number: 'street_no',
        route: 'address',
				password:'password',
        locality: 'city',
        administrative_area_level_1: 'state',
        country: 'country',
        postal_code: 'zip'
      };
	 $("#autocomplete").on("keyup", function (e) {
		 var code = e.keyCode || e.which;

		 if(code ==40) {
		   if($('.serachwrap .focus').length==0)
				$('.serachwrap li:first-child').addClass('focus');
		   else{
				var el = $('.serachwrap li.focus');
				$('.serachwrap li').removeClass('focus');
				el.next('li').addClass('focus');
		   }
		   return;
		 }else if(code==38){
		   if($('.serachwrap .focus').length==0)
				$('.serachwrap li:last-child').addClass('focus');
		   else{
				var el = $('.serachwrap li.focus');
				$('.serachwrap li').removeClass('focus');
				el.prev('li').addClass('focus');
		   }
		   return;
		 }else if(code==13){
			e.preventDefault();
			var el = $('.serachwrap li.focus');
			var string = $('.serachwrap li.focus').attr('title');
		 	$('#autocomplete').val(string);
			var geocd = new google.maps.Geocoder();
			geocd.geocode({"address": string},fillInAddress);
			$('#result').hide();
			return false;
		 }
		 $('#result').hide();
		   $('#result').html('');
           var inputData = $("#autocomplete").val();
           service = new google.maps.places.AutocompleteService();
           <!-- countries US and Canada--->
		   var request1 = {
             input: inputData,
             types: ['geocode'],
             componentRestrictions: {country: 'us'},
           };
           var request2 = { //remove if only for US
             input: inputData,
             types: ['geocode'],
             componentRestrictions: {country: 'ca'},
           };
           $('#result').empty();
           service.getPlacePredictions(request1, callback);
           service.getPlacePredictions(request2, callback);//remove if only for US
	  });
	  $(document).on('click','.serachwrap li',function(){
	  		var string = $(this).attr('title');
		 	$('#autocomplete').val(string);
			var geocd = new google.maps.Geocoder();
			geocd.geocode({"address": string},fillInAddress);
			$('#result').hide();
	  });
      function callback(predictions, status) {
            $('#result').html('');
			$('#result').hide();
			var resultData = '';
			if(predictions !=''){
            for (var i = 0; i < predictions.length; i++) {
				resultData += '<li title="'+predictions[i].description+'"><i class="fa fa-map-marker"></i>' + predictions[i].description + '</li>';
            }
            if($('#result').html() != undefined && $('#result').html() != ''){
                resultData = $('#result').html()+ resultData;
            }
            if(resultData != undefined && resultData != ''){
                $('#result').html(resultData).show();
				$('#result').show();
            }
			}

      }

	  marker = null;
	  function fillInAddress(results, status) {
		var latitude = results[0].geometry.location.lat();
		var longitude = results[0].geometry.location.lng();
		if(marker!=null){
			marker.setMap(null);
		}
		var point = {lat: latitude,lng: longitude};
		 marker = new google.maps.Marker({
			position:point,
			map: map,
			title: 'Your location'
		  });
		map.setCenter(point);
		if (results[0].geometry.viewport)
          map.fitBounds(results[0].geometry.viewport);
		 $('#step1').trigger("reset");

 		console.log(results);

		$.map(results, function(item){

			for (var i = 0; i < item.address_components.length; i++) {
				var addressType = item.address_components[i].types[0];
				if (componentForm[addressType]) {
					var val = item.address_components[i][componentForm[addressType]];
					document.getElementById(component_map[addressType]).value = val;
				}
			}

			$(".address-form-block").removeClass("hide");

			$(".map-section").removeClass("col-md-12").addClass("col-md-6");

		});
	  }
});


$(document).ready(function () {

		var pid = $('.itemSelect option').filter(function () {
				return ($(this).text() == "DNS -- Per File Box");
		}).val();

		$.ajax({
				type: "GET",
				url: '<?php echo route('client.get_ajax_product'); ?>',
				data: {'id': pid},
				success: function (data) {

						var product = JSON.parse(data);
						var rate = product['price'];

						$('.itemQty').val(1);
						$('.rate').html("$" + rate);
						$('.total').html("$" + rate);
						$('.hf_base_price').val(rate);
						$('.hf_tax').val(tax);

						$row = $('tr.item');
						countRow($row);
				}
		});

		$('.btn-prev').click(function () {
				var url = "";
				// window.location = url;
		});

		$(document).on("change", ".itemSelect", function (e) {
				$this = $(this);
				$row = $this.parents('tr.item');

				var price_flag = false;
				if ($row.find('.itemSelect option:selected').text() == "DNS - Open Amount") {
						price_flag = true;
				} else {
						price_flag = false;
				}

				if ($(this).val() == "") {
						var rate = parseFloat(0.00).toFixed(2);
						 var tax = parseFloat(0.00).toFixed(2);
						$row.find('.itemQty').val();
						$row.find('.rate').html("$" + rate);
						$row.find('.total').html("$" + rate);
						 $row.find('.tax').html("$" + tax);
						$row.find('.hf_base_price').val(rate);
						$row.find('.hf_tax').val(tax);
						$('.subtotal').html("$" + rate);
						 $('.finalTax').html("$" + tax);
						$('.grandTotal').html("$" + rate);
						$('#hf_subtotal').val("$" + rate);
						 $('#hf_totaltax').val("$" + tax);
						$('#hf_grandtotal').val("$" + rate);
						return false;
				}

				$.ajax({
						type: "GET",
						url: '<?php echo route('client.get_ajax_product'); ?>',
						data: {'id': $(this).val()},
						success: function (data) {

								var product = JSON.parse(data);
								var rate = product['price'];
								 var tax = (rate * 13) / 100;
								$row.find('.itemQty').val(1);
								$row.find('.rate').html("$" + rate);
								$row.find('.total').html("$" + rate);
								 $row.find('.tax').html("$" + tax);
								$row.find('.hf_base_price').val(rate);
								 $row.find('.hf_tax').val(tax);


								
								countRow($row);

								if (price_flag) {
										$row.find('.rate').hide();
										$row.find('.hf_base_price').attr('type', 'text');
								} else {
										$row.find('.rate').show();
										$row.find('.hf_base_price').attr('type', 'hidden');
								}
						}
				});
		});

		$(document).on("change", ".itemQty", function (e) {
				var qty = $(this).val();
				// var quentity = document.getElementById("txt_qty").value;
				// document.getElementById("qty_confirmlist").innerHTML = quentity;
				$this = $(this);
				$row = $this.parents('tr.item');
				countRow($row);
		});

		$(document).on("keyup", ".hf_base_price", function (e) {
				var base_price = $(this).val();
				$this = $(this);
				$row = $this.parents('tr.item');

				var tax = (base_price * 13) / 100;
				tax = parseFloat(tax).toFixed(2);
				$('.tax').html("$" + tax);
				$('.hf_tax').val(tax);

				countRow($row);
		});

		$("#addItem").click(function () {
				$('.item>td.action').html($('<div class="form-group"><button class="btn btn-default removeItem" type="button" style="padding: 3px 10px;"><i class="fa fa-minus plussigncenetr" style="font-size: 18px;"></i></button></div>'));
				document.getElementById("cmb_order_item").style.borderColor = "#c6ced0";

				$this = $(this);
				$row = $this.parents('tr.item');


				$newRow = rowTemplate();

				$('table.items tbody').append($newRow);
		});

		$(document).on("click", ".removeItem", function (e) {
				$this = $(this);
				$row = $this.parents('tr.item');
				$row.remove();

				var rows = $('.item>td.action');

				if (rows.length == 1) {
						rows.html('');
				}
				//getSubtotal();
				countRow($row);
		});

		$("#cmb_payment_method").change(function () {
				if ($(this).val() == "1") {
						$('.cheque-data').show();
						$('#txt_cheque_number').attr('required', 'required');
						$('.cc-data').hide();
						hideCCData()
				} else if ($(this).val() == "2") {
						$('.cheque-data').hide();
						$('#txt_cheque_number').removeAttr("required");
						$('.cc-data').hide();
						hideCCData()
				} else if ($(this).val() == "3") {
						$('.cheque-data').hide();
						$('#txt_cheque_number').removeAttr("required");
						$('.cc-data').hide();
						hideCCData()
				} else if ($(this).val() == "4") {
						$('.cheque-data').hide();
						$('#txt_cheque_number').removeAttr("required");
						$('.cc-data').show();
						showCCData();
				} else {
						$('.cheque-data').hide();
						$('#txt_cheque_number').removeAttr("required");
						$('.cc-data').hide();
						hideCCData()
				}
		});

});

function showCCData() {
		$('#txt_card_no').attr('required', 'required');
		$('#txt_cardholder_name').attr('required', 'required');
		$('#txt_cvv').attr('required', 'required');
		$('#cmb_exp_month').attr('required', 'required');
		$('#cmb_exp_year').attr('required', 'required');
}

function hideCCData() {
		$('#txt_card_no').removeAttr("required");
		$('#txt_cardholder_name').removeAttr("required");
		$('#txt_cvv').removeAttr("required");
		$('#cmb_exp_month').removeAttr("required");
		$('#cmb_exp_year').removeAttr("required");
}

function countRow($row) {


	  var item = $row.find('.itemSelect').val();
		var qty = $row.find('.itemQty').val();
		var rate = $row.find('.hf_base_price').val();
		var tax = $row.find('.hf_tax').val();
		var tax = parseFloat(tax * qty).toFixed(2) || 0;
		var total = parseFloat(rate * qty).toFixed(2) || 0;
		$row.find('.total').html("$" + total);
		$row.find('.tax').html("$" + tax);


		getSubtotal();


		/*$('.subtotal').html("$"+total);
		 $('.finalTax').html("$"+tax);
		 $('.grandTotal').html("$"+total);*/
}

function getSubtotal() {
		subtotal = 0;
		$('.total').each(function (i, el) {
				subtotal += parseFloat($(el).text().replace('$', ''), 10) || 0;
		});

		$('.subtotal').html('$' + subtotal.toFixed(2));

		tax = 0;
		
		$('.tax').each(function (i, el) {
				tax += parseFloat($(el).text().replace('$', ''), 10) || 0;
		});
		
		$('.finalTax').html('$' + tax.toFixed(2));

		$('.grandTotal').html('$' + (tax + subtotal).toFixed(2));

		$('#hf_subtotal').val(subtotal.toFixed(2));
		$('#hf_totaltax').val(tax.toFixed(2));
		$('#hf_grandtotal').val((tax + subtotal).toFixed(2));
}

function rowTemplate() {

		template = '';
		template += '<tr class="item">';
		template += '<td><div class="form-group"><div>';
		template += $('.itemSelect').prop('outerHTML');
		template += '</div></div></td>';
		template += '<td><div class="form-group"><div class="col-sm-6" style="padding-left: 0px;">';
		template += '<input name="txt_qty[]" class="itemQty form-control" min="1" required="required" type="number" id="txt_qty">';
		template += '</div></div></td>';
		template += '<td><div class="form-group"><div class="rate form-control-static">$0.00</div><input type="hidden" name="hf_base_price[]" class="hf_base_price form-control" value=""></div></td>';
		template += '<td><div class="tax"  style="display:none" form-control-static">$0.00</div><div class="form-group"><div class="total form-control-static" >$0.00</div><div class=""></div></div></td>';
		template += '<td class="action"><div class="form-group"><button class="btn btn-default removeItem" style="padding: 3px 10px;" type="button"><i style="font-size: 18px;" class="fa fa-minus plussigncenetr"></i></button></div></td>';
		template += '<input type="hidden" name="hf_tax[]" class="hf_tax" value="">';
		template += '</tr>';

		return template;
}
</script>

<script type="text/javascript">
$(document).ready(function () {

    $('.orderformsubmit').click(function() {

			var selorder = document.getElementById("cmb_order_item").value;
      if(selorder == "") {
         $('#cmb_order_item').focus();
				  document.getElementById("cmb_order_item").style.borderColor = "red";
        return false;
      }
			// $(".itemSelect").each(function(i) {
			//      var Item = $(".itemSelect").val();
			//  });

			return true;

    });
});

</script>
@stop
