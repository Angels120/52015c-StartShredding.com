<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<!--toggle button css -->
<style>
	.switch {
		position: relative;
		display: inline-block;
		width: 40px;
		height: 22px;
	}

	/* Hide default HTML checkbox */
	.switch input {
		opacity: 0;
		width: 0;
		height: 0;
	}

	/* The slider */
	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 16px;
		width: 16px;
		left: 4px;
		bottom: 3px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	input:checked + .slider {
		background-color: #4caf50;
	}

	input:focus + .slider {
		box-shadow: 0 0 1px #4caf50;
	}

	input:checked + .slider:before {
		-webkit-transform: translateX(16px);
		-ms-transform: translateX(16px);
		transform: translateX(16px);
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}
</style>
<script>
    var customerData = <?php echo json_encode($customer_array,true); ?>;
    var coordinations = JSON.parse(customerData);
    var newCordinations = [];
    var map = [];

    function initMap(mapdata = coordinations) {
    	let latitude = parseFloat(coordinations[0][1]);
		let longtude = parseFloat(coordinations[0][2]);
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: {lat: latitude, lng: longtude}
        });

        setMarkers(map,mapdata);
    }

	function setMarkers(map, mapDetails = coordinations) {
		var lookup = [];
		for (let i = 0; i < mapDetails.length; i++) {

			let item = mapDetails[i];
			let latitude = parseFloat(item[1]);
			let longtude = parseFloat(item[2]);
			let information = '';
			let orderid = item[6];
			let existingMarker = getExistingMarker(lookup, [latitude, longtude]);
			if ((existingMarker == 0 || existingMarker != null)) {
				if (lookup[existingMarker][3] != orderid) {
					information = lookup[existingMarker][2] + '<hr><div><strong>Order ID: </strong><a href="/vendor/details/' + orderid + '">' + orderid + '</a><div><br>'
							+ '<div><strong>Client: </strong>' + item[0] + '<div><br>'
							+ '<div><strong>Address: </strong>' + item[3] + '<div><br>'
							+ '<div><strong>Email: </strong><a href="mailto:' + item[4] + '">' + item[4] + '</a><div><br>'
							+ '<div><strong>Phone: </strong><a href="tel:' + item[5] + '">' + item[5] + '</a><div>';

					lookup[existingMarker][2] = information;
				} else {
					continue;
				}
			} else {
				information = '<div><strong>Order ID: </strong><a href="/vendor/details/' + orderid + '">' + orderid + '</a><div><br>'
						+ '<div><strong>Client: </strong>' + item[0] + '<div><br>'
						+ '<div><strong>Address: </strong>' + item[3] + '<div><br>'
						+ '<div><strong>Email: </strong><a href="mailto:' + item[4] + '">' + item[4] + '</a><div><br>'
						+ '<div><strong>Phone: </strong><a href="tel:' + item[5] + '">' + item[5] + '</a><div><br>';

				lookup[i] = [latitude, longtude, information, orderid];
			}
			let infoWindow = new google.maps.InfoWindow({
				content: information
			});

			let marker = new google.maps.Marker({
				position: {lat: latitude, lng: longtude},
				map: map,
				title: item[0],
			});

			marker.addListener('click', function () {
				if (!marker.open) {
					infoWindow.open(map, marker);
					marker.open = true;
				} else {
					infoWindow.close();
					marker.open = false;
				}
				google.maps.event.addListener(map, 'click', function () {
					infoWindow.close();
					marker.open = false;
				});
			});
		}
	}

	function getExistingMarker(lookup, search) {
		if (lookup.length > 0) {
			for (let i = 0, l = lookup.length; i < l; i++) {
				if (lookup[i] && lookup[i].length > 0) {
					if (lookup[i][0] === search[0] && lookup[i][1] === search[1]) {
						return i;
					}
				}

			}
			return null;
		}
		return null;
	}

	function getClientDetails() {

		var search = $('input[type=search]').val();
		newCordinations = [];
		for (let i = 0; i < coordinations.length; i++) {
			let item = coordinations[i];

			if (item[0].toLowerCase().includes(search.toLowerCase())) {
				newCordinations.push(item);
			} else if (item[3].toLowerCase().includes(search.toLowerCase())) {
				newCordinations.push(item);
			} else if (item[4].toLowerCase().includes(search.toLowerCase())) {
				newCordinations.push(item);
			} else if (item[5].toLowerCase().includes(search.toLowerCase())) {
				newCordinations.push(item);
			} else if (item[6].toLowerCase().includes(search.toLowerCase())) {
				newCordinations.push(item);
			} else if (item[7].toLowerCase().includes(search.toLowerCase())) {
				newCordinations.push(item);
			} else if (item[8].toLowerCase().includes(search.toLowerCase())) {
				newCordinations.push(item);
			} else if (item[9].toLowerCase().includes(search.toLowerCase())) {
				newCordinations.push(item);
			} else if (item[10].toLowerCase().includes(search.toLowerCase())) {
				newCordinations.push(item);
			}  else {
				continue;
			}
		}
		initMap(newCordinations);
		console.log(newCordinations);
		let latitude = parseFloat(newCordinations[0][1]);
		let longtude = parseFloat(newCordinations[0][2]);
		map.setCenter({
			lat: latitude,
			lng: longtude
		});
	}
</script>
<div class="page-title row">
	<h2>Order History</h2>
	<div style="float: right;">
	<span id="map_toggle_txt">Show Map</span>
	<label class="switch">
		<input type="checkbox" id="map_toggle">
		<span class="slider round"></span>
	</label>
	</div>
</div>
<?php if(Session::has('message')): ?>
<div class="alert alert-success alert-dismissable">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<?php echo e(Session::get('message')); ?>

</div>
<?php endif; ?>
<div class="page-title row">
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
						<input class="form-control datepicker" id="fromTime" name="fromTime" type="text" />
						<span class="input-group-addon"><i class="fa fa-calendar fromTimeCalendar"></i></span>
					</div>
				</div>
				<div class="custom-dateicker">
					<label>To</label>
					<div id="datepicker3" class="input-group date custom-calendar" data-date-format="mm-dd-yyyy">
						<input class="form-control datepicker" id="toTime" name="toTime" type="text" />
						<span class="input-group-addon"><i class="fa fa-calendar toTimeCalendar"></i></span>
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
				<div class="comments-form pull-left">
					<input type="submit" name="orderForm" class="btn btn-success " style="margin: 0;padding: 9px 30px;" value="Search">
				</div>
			</div>

		</div>

	</form>
</div>
<div class="row main-row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table" >
		<div class="bg-white row">
			<div class="panel panel-body-custom tableContainParent col-md-12 col-lg-12 col-sm-12 left-tab">
				<div class="table-responsive">
					<table data-export="1,2,3,4,5,6" cellpadding="0" cellspacing="0" id="table_1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<!-- <th width="5%"></th> -->
								<th class="hidden-xs hidden-sm">Date</th>
								<th>Order#</th>
								<th>Client</th>
								<th class="hidden-xs hidden-sm">Status</th>
								<th class="hidden-xs hidden-sm">Amount</th>
								<th class="hidden-xs hidden-sm">Pay Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($orders != null) {
								foreach ($orders as $order) {

									$getOtherDetails = DB::select('SELECT * FROM `clients` WHERE id = (SELECT `customerid` FROM `orders` WHERE `id` = ?) ', [$order->orderid]);
									if ($getOtherDetails != null) {
										$getOtherDetails = $getOtherDetails[0];
										$statusKey = "constants.status_" . $order->status;
									}

									$orderdet = App\Order::where('id', $order->id)->first();
							?>
									<tr>
										<!-- <td align="center">
											<div class="checkbox-new">
												<input value="<?= $order->id ?>" class="float-left" id="order_pro_<?= $order->id ?>" name="order.product[]" type="checkbox">
												<label for="order_pro_<?= $order->id ?>" class="float-left font_size_14"></label>
											</div>
										</td> -->
										<td><?= date('M d, Y', strtotime($order->created_at)) ?></td>
										<td><a href="<?php echo url('vendor/details/'.$order->orderid); ?>"><?= $order->orderid ?></a></td>
										<td><a href="<?php echo url('vendor/profile/'.$getOtherDetails->id); ?>"><?= $getOtherDetails->name ?></a></td>

										<td class="hidden-xs hidden-sm"><?= $orderdet->status ?></td>
										<td class="hidden-xs hidden-sm">$ <?= number_format((float) $order->cost, 2, '.', '') ?></td>
										<?php if($order->payment == "completed"): ?>
											<td class="hidden-xs hidden-sm">Paid</td>
										<?php elseif($order->payment == "pending"): ?>
											<td class="hidden-xs hidden-sm">Not Paid</td>
										<?php else: ?>
											<td class="hidden-xs hidden-sm">Partial Paid</td>
										<?php endif; ?>
									</tr>
							<?php
								}
							} else {
								echo '<tr><td colspan="8" class="text-center">No Data Found</td></tr>';
							}
							?>
						</tbody>
					</table>
				</div>

			</div>
			<div class="col-md-6 col-lg-6 right-tab" style="display: none;">
				<div id="map"></div>
			</div>
		</div>
	</div>
</div>
<style>
	/* Set the size of the div element that contains the map */
	#map {
		height: 400px; /* The height is 400 pixels */
		width: 100%; /* The width is the width of the web page */
	}
</style>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script>
	$(document).ready(function() {
		$("#fromTime").datepicker();
        $('.fromTimeCalendar').click(function() {
            $("#fromTime").focus();
        });
        $("#toTime").datepicker();
        $('.toTimeCalendar').click(function() {
            $("#toTime").focus();
        });
		$('#table_1').DataTable({
			dom: 'lBfrtip',
			select: true,
			ordering: true,
			"pageLength": 50,
			lengthMenu: [
				[10, 25, 50, 100, -1],
				['10', '25', '50', '100', 'All']
			],
			order: [[1, 'desc']],
			buttons: [{
					extend: 'excel',
					text: '<i style="color:green" class="fa fa-file-excel-o fa-2x"></i>&nbsp; Excel',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: 'Order History',
				},
				{
					extend: 'csv',
					text: '<i style="color:blue" class="fa fa-file-text-o fa-2x"></i>&nbsp; CSV',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: 'Order History',
				},
				{
					extend: 'pdf',
					text: '<i style="color:red" class="fa fa-file-pdf-o fa-2x"></i>&nbsp; PDF',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: 'Order History',
				},
				{
					extend: 'print',
					text: '<i style="color:black" class="fa fa-print fa-2x"></i>&nbsp; Print',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: 'Order History',
				}
			]
		});
	});
</script>

<script>
    var Timer;
    $('#table_1').on('search.dt', function () {
            clearTimeout(Timer);
            Timer = setTimeout(SendRequest, 1000);
        });

    function SendRequest() {

        getClientDetails();
    }

    //toggle button

  $('#map_toggle').change(function(){
  	var boxWidth = $(".main-row").width();
    if ($(window).width() > 992) {
        if ($('#map_toggle').is(':checked')) {
            $('#map_toggle_txt').text('Hide Map');
            $('.left-tab').animate({
                width: (boxWidth / 2) - 22
            });
            $('.right-tab').show(1000);
        } else {
            $('#map_toggle_txt').text('Show Map');
            $('.left-tab').animate({
                width: boxWidth - 48
            });
            $('.right-tab').hide();
        }
    }else{
        if ($('#map_toggle').is(':checked')) {
            $('#map_toggle_txt').text('Hide Map');
            $('.left-tab').hide()
            $('.right-tab').show();
        } else {
            $('#map_toggle_txt').text('Show Map');
            $('.left-tab').show();
            $('.right-tab').hide();
        }
    }
  });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places&callback=initAutocomplete" async defer></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.includes.master-vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>