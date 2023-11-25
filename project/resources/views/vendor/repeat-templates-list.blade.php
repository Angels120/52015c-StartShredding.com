@extends('vendor.includes.master-vendor')

@section('content')
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
    <div class="page-title row">
        <h2>All Repeat Jobs</h2>
    </div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="page-title row">
        <form action="" method="get">
            <div class="form-group">
                <div class="form-inline">
                    <label>Template Name</label>&nbsp;
                    <input type="hidden" name="templateForm" value="1">
                    <input type="text" name="template" style="width:150px;" value="<?=isset($_GET['template'])?$_GET['template']:'';?>">
                    &nbsp;<label>Is Active</label>&nbsp;
                    <select name="status">
                        <option value="">---</option>
                        <option <?php if(isset($_GET['status']) AND ($_GET['status']==1)){ ?> selected<?php }?> value="1">Yes</option>
                        <option <?php if(($_GET['status']!='') AND ($_GET['status']==0)){ ?> selected<?php }?> value="0">No</option>
                    </select>
                    &nbsp;<label>Repeat</label>&nbsp;
                    <select name="repeat">
                        <option value="">----</option>
                        <option <?php if($_GET['repeat']=='Daily'){ ?> selected<?php }?> value="Daily">Daily</option>
                        <option <?php if($_GET['repeat']=='Weekly'){ ?> selected<?php }?> value="Weekly">Weekly</option>
                        <option <?php if($_GET['repeat']=='Monthly'){ ?> selected<?php }?> value="Monthly">Monthly</option>
                        <option <?php if($_GET['repeat']=='Quarterly'){ ?> selected<?php }?> value="Quarterly">Qarterly</option>
                        <option <?php if($_GET['repeat']=='Semi-Annual'){ ?> selected<?php }?> value="Semi-Annual">Semi-Annual</option>
                        <option <?php if($_GET['repeat']=='Yearly'){ ?> selected<?php }?> value="Yearly">Yearly</option>
                        <option <?php if($_GET['repeat']=='On-Call'){ ?> selected<?php }?> value="On-Call">On Call</option>
                    </select>
                    &nbsp;<label>Business Name</label>&nbsp;
                    <input type="text" name="business" style="width:150px;" value="<?=isset($_GET['business'])?$_GET['business']:'';?>">
                    <input type="submit" value="Search" class="btn btn-info">
                    <a href="/vendor/order-template?reset=1" class="btn btn-danger">&nbsp;Show All&nbsp;</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row main-row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
            <div class="bg-white row">
                <div class="panel panel-body-custom tableContainParent col-md-12 col-lg-12 col-sm-12 left-tab">
                    <div class="table-responsive">
                        <table data-export="1,2,3,4,5,6" cellpadding="0" cellspacing="0" id="table_1"
                               class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="hidden-xs hidden-sm">Template Name</th>
                                <th class="hidden-xs hidden-sm">Business Name</th>
                                <th class="hidden-xs hidden-sm">Job Type</th>
                                <th class="hidden-xs hidden-sm">Repeat</th>
                                <th class="hidden-xs hidden-sm">Auto Schedule From</th>
                                <th class="hidden-xs hidden-sm">Next Job Scheduled For</th>
                                <th class="hidden-xs hidden-sm">Last Completed On</th>
                                <th class="hidden-xs hidden-sm">Scheduled Jobs</th>
                                <th class="hidden-xs hidden-sm">Completed Jobs</th>
                                <th class="hidden-xs hidden-sm">Is Active</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($orders != null) {
                            foreach ($orders as $order) {
                            $next = DB::select('SELECT booking_date FROM orders WHERE template_id = ' . $order->template_id . '
									      AND booking_date = (SELECT MIN(booking_date) FROM orders WHERE template_id = ' . $order->template_id . '
	                                      AND status = "job_status_scheduled" AND booking_date >= "' . date('Y-m-d') . '")');
                            $Last_completed = DB::select('SELECT booking_date FROM orders WHERE template_id = ' . $order->template_id . '
									      AND booking_date = (SELECT MAX(booking_date) FROM orders WHERE template_id = ' . $order->template_id . '
	                                      AND status = "job_status_completed")');
                            $scheduled = DB::select('SELECT COUNT(*) AS REC_COUNT FROM orders WHERE template_id = ' . $order->template_id . '
	                                      AND status = "job_status_scheduled" AND booking_date >= "' . date('Y-m-d') . '"');
                            $completed = DB::select('SELECT COUNT(*) AS REC_COUNT FROM orders WHERE template_id = ' . $order->template_id . '
	                                      AND status = "job_status_completed"');
                            $orderdet = App\Order::where('id', $order->id)->first();
                            ?>
                            <tr>
                                <td><a href="/vendor/order-template/<?=$order->template_id;?>" target="_blank"><?=$order->template_name;?></a></td>
                                <td><?=$order->business_name;?></td>
                                <td><?=$order->job_type;?></td>
                                <td><?=$order->repeat;?></td>
                                <td><?=date('d-m-Y', strtotime($order->schedule_from));?></td>
                                <td><?echo isset($next) ? $next['booking_date'] : '';?></td>
                                <td><?echo isset($Last_completed) ? $Last_completed['booking_date'] : '';?></td>
                                <td><?echo isset($scheduled) ? $scheduled['REC_COUNT'] : '';?></td>
                                <td><?echo isset($completed) ? $completed['REC_COUNT'] : '';?></td>
                                <td>
                                    <input type="checkbox" name="chk_isActive[]" value="{{$order->id}}" <?php echo ($order->is_active)?'checked="checked"':''; ?>>
                                </td>
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
                    <div class="col-md-12">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div style="float: right;">
                               <button class="btn btn-success" id="makeActive">Apply</button>
                            </div>
                        </div>
                    </div>

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
        $(document).ready(function () {
            $('#table_1').DataTable({
                select: true,
                ordering: true,
                "pageLength": 50,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'All']
                ],
            });
            $('#makeActive').click(function(){
                var isActive_arr = [];
                $.each($("input[name='chk_isActive[]']:checked"), function(){
                    isActive_arr.push($(this).val());
                });
                // Confirm alert
                var confirmActive = confirm("Do you really want to make template active?");
                if (confirmActive == true) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ url('/vendor/get-order-template-activate')}}',
                        type: 'POST',
                        data: {isActive_arr: isActive_arr,_token:'{{ csrf_token() }}'},
                        success: function (result) {
                            $('meta[name="csrf-token"]').attr('content', result.token);
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': result.token
                                }
                            });
                            table.ajax.reload();
                        }
                    });
                }
            });
        });
    </script>


@stop

@section('footer')

@stop