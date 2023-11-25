@extends('vendor.includes.master-vendor')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style>
        .w-100 {
            width: 51% !important;
        }

        .w-50 {
            width: 25% !important;
        }
        .buttons-select-all, .buttons-select-none {
            text-transform: capitalize;
        }
        div.dt-buttons {
            float: unset;
            margin: 48px 14px 0 0;
        }
        .btn-warning {
            color: #fff!important;
            background-color: #f0ad4e!important;
            border-color: #eea236!important;
            background-image: unset!important;
        }
        .btn-info {
            color: #fff!important;
            background-color: #5bc0de!important;
            border-color: #46b8da!important;
            background-image: unset!important;
        }

    </style>
    <div class="page-title row">
        <h2>Template: {{$template->name}}</h2>
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

    <div class="bg-white row">
        <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 left-tab">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="top-title">
                        <h3>Order History</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="page-title row">
                        <form action="" method="get">
                            <div class="form-group">
                                <div class="form-inline">
                                    <div class="col-md-2 col-xs-12">
                                        <label>ID</label>
                                        <input type="text" style="width: 100%;" class="form-control" name="orderId"
                                               value="<?=($_GET['orderId']) != '' ? $_GET['orderId'] : ''?>"
                                               id="orderId">
                                    </div>
                                    <div class="col-md-2 col-xs-12">
                                        <label>Job Name</label>
                                        <input type="text" style="width: 100%;" class="form-control" name="jobName"
                                               value="<?=($_GET['jobName']) != '' ? $_GET['jobName'] : ''?>"
                                               id="jobName">
                                    </div>
                                   <div class="col-md-2 col-xs-12">
                                   <label>Job Type</label>
                                        <select class="form-control" name="jobType" style="width: 100%;">
                                            <option value="">--Job Type--</option>
                                            <?php foreach ($jobType as $type) { ?>
                                                <option value="{{$type->id}}" @if($_GET['jobType']==$type->id) selected @endif>
                                                    {{$type->name}}
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-xs-12">
                                        <label>Order Type</label>
                                        <select class="form-control" name="orderType" style="width: 100%;">
                                            <option value="">--Order Type--</option>
                                            <option value="1" @if($_GET['orderType']==1) selected @endif>WALK IN</option>
                                            <option value="2" @if($_GET['orderType']==2) selected @endif>ONLINE</option>
                                            <option value="3" @if($_GET['orderType']==3) selected @endif>REPEAT</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline">
                                       <div class="col-md-2 col-xs-12">
                                        <label>Quick Date</label>
                                        <select class="form-control" name="quickdate" style="width: 100%;">
                                            <option value="">--Quick Date--</option>
                                            <option value="yesterday"
                                                    <?php if($_GET['quickdate'] == 'yesterday'){?>selected<?php } ?>>
                                                Yesterday
                                            </option>
                                            <option value="today"
                                                    <?php if($_GET['quickdate'] == 'today'){?>selected<?php } ?>>
                                                Today
                                            </option>
                                            <option value="tomorrow"
                                                    <?php if($_GET['quickdate'] == 'tomorrow'){?>selected<?php } ?>>
                                                Tomorrow
                                            </option>
                                            <option value="weekday"
                                                    <?php if($_GET['quickdate'] == 'weekday'){?>selected<?php } ?> >
                                                This Weekdays
                                            </option>
                                            <option value="wholeweek"
                                                    <?php if($_GET['quickdate'] == 'wholeweek'){?>selected<?php } ?> >
                                                This Whole Week
                                            </option>
                                            <option value="nextweek"
                                                    <?php if($_GET['quickdate'] == 'nextweek'){?>selected<?php } ?>>
                                                Next Weekdays
                                            </option>
                                            <option value="thismonth"
                                                    <?php if($_GET['quickdate'] == 'thismonth'){?>selected<?php } ?>>
                                                This Month
                                            </option>
                                            <option value="nextmonth"
                                                    <?php if($_GET['quickdate'] == 'nextmonth'){?>selected<?php } ?>>
                                                Next Month
                                            </option>
                                            <option value="thisyear"
                                                    <?php if($_GET['quickdate'] == 'thisyear'){?>selected<?php } ?>>
                                                This Year
                                            </option>
                                            <option value="yeartodate"
                                                    <?php if($_GET['quickdate'] == 'yeartodate'){?>selected<?php } ?>>
                                                Year to Date
                                            </option>
                                            <option value="alltime"
                                                    <?php if($_GET['quickdate'] == 'alltime'){?>selected<?php } ?>>
                                                All Time
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-xs-12">
                                        <label>From</label>
                                        <div id="datepicker2" class="input-group date custom-calendar"
                                             data-date-format="mm-dd-yyyy">
                                            <input class="form-control datepicker" name="fromTime" type="text" id="fromTime" style="width: 100%;"
                                                   value="<?=($_GET['fromTime']) != '' ? $_GET['fromTime'] : ''?>"
                                                   style="width: 100%;"/>
                                            <span class="input-group-addon"><i class="fa fa-calendar fromTimeCalendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-xs-12">
                                        <label>To</label>
                                        <div id="datepicker3" class="input-group date custom-calendar"
                                             data-date-format="mm-dd-yyyy">
                                            <input class="form-control datepicker" style="width: 100%;"
                                                   name="toTime" type="text" id="toTime"
                                                   value="<?=($_GET['toTime']) != '' ? $_GET['toTime'] : ''?>"/>
                                            <span class="input-group-addon"><i class="fa fa-calendar toTimeCalendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Status</label> 
                                        <select class="form-control" name="status" style="width: 100%;">
                                            <option value="">--Status--</option>
                                            <option value="scheduled"
                                                    <?php if($_GET['status'] == 'scheduled'){?>selected<?php } ?>>
                                                Scheduled
                                            </option>
                                            <option value="completed"
                                                    <?php if($_GET['status'] == 'completed'){?>selected<?php } ?>>
                                                Completed
                                            </option>
                                            <option value="at plant completed"
                                                    <?php if($_GET['status'] == 'at plant completed'){?>selected<?php } ?>>
                                                At Plant Completed
                                            </option>
                                            <option value="in transit"
                                                    <?php if($_GET['status'] == 'in transit'){?>selected<?php } ?>>
                                                In Transit
                                            </option>
                                            <option value="at plant"
                                                    <?php if($_GET['status'] == 'at plant'){?>selected<?php } ?>>
                                                At Plant
                                            </option>
                                            <option value="on delivery"
                                                    <?php if($_GET['status'] == 'on delivery'){?>selected<?php } ?>>
                                                On Delivery
                                            </option>
                                            <option value="completed at store"
                                                    <?php if($_GET['status'] == 'completed at store'){?>selected<?php } ?>>
                                                Completed At Store
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-2 col-xs-12">
                                        <label>Action:</label>
                                        <input type="submit" name="orderForm" class="btn btn-success " style="width: 100%;" value="Search">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                <table class="table table-bordered" id="orders-table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Job Name</th>
                                        <th>Job Type</th>
                                        <th>Order Type</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/vendor/order-template/{{$template->id}}" class="btn btn-success float-right my-2">Back To Template</a>
        </div>
    </div>

    <script>
        function modalSend(order_id)
        {
            $('#order_id').val(order_id);
        }
        $(function () {
            $.urlParam = function (name) {
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                if (results == null) {
                    return 0;
                } else {
                    return results[1] || 0;
                }
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var orderId = ($.urlParam('orderId') != 0) ? $.urlParam('orderId') : '';
            var fromTime = ($.urlParam('fromTime') != 0) ? $.urlParam('fromTime') : '';
            var toTime = ($.urlParam('toTime') != 0) ? $.urlParam('toTime') : '';
            var quickDate = ($.urlParam('quickdate') != 0) ? $.urlParam('quickdate') : '';
            var status = ($.urlParam('status') != 0) ? $.urlParam('status') : '';
            var jobName = ($.urlParam('jobName') != 0) ? $.urlParam('jobName') : '';
            var jobType = ($.urlParam('jobType') != 0) ? $.urlParam('jobType') : '';
            var orderType = ($.urlParam('orderType') != 0) ? $.urlParam('orderType') : '';

            var table = $('#orders-table').DataTable({
                dom: "flrtipB",
                select: true,
                ordering: true,
                "pageLength": 50,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                ajax: {
                    url: '{{ url('vendor/get-template-history-ajax')}}/{{$template->client_id}}/{{$template->id}}?orderId=' + orderId + '&quickdate=' + quickDate + '&fromTime=' + fromTime + '&toTime=' + toTime + '&status=' + status+ '&jobName==' + jobName + '&jobType==' + jobType + '&orderType==' + orderType+ '&orderForm=Search',
                },
                columns: [
                    {
                        'targets': 0,
                        'checkboxes': {'selectRow': true},
                        'searchable': false,
                        'orderable': false,
                        'className': 'dt-body-center',
                        'data': 'id',
                        'sortable': false,
                        'render': function (id) {
                            return '<input type="checkbox" name="chk_orders[]" value="' + $('<div/>').text(id).html() + '">';
                        }
                    },
                    {data: 'id', name: 'id'},
                    {data: "job_name", name: 'job_name'},
                    {data: "type", name: 'type'},
                    {data: 'order_type', render: function (data, type, full) {
                            if ({data:"order_type"} === 1)
                            {
                                var str ='walk in';
                                return str.toUpperCase();
                            }
                           else if ({data:"online"} === 2)
                            {
                                var str ='walk in';
                                return str.toUpperCase();
                            }
                            else {
                                var str ='Repeat';
                                return str.toUpperCase();

                            }

                        }
                    },
                     {
                        data: 'booking_date', render: function (data, type, full) {
                            return moment(new Date(data)).format('MM-DD-YYYY');
                        }
                    },
                    {data: 'pay_amount', render: $.fn.dataTable.render.number(',', '.', 2, '$'), name: 'pay_amount'},
                    {data: 'status',"render": function ( data, type, row, meta ) {
                            return data.toLowerCase().replace(/\b[a-z]/g, function(letter){return  letter.toUpperCase();});
                      }              },
                    {data: 'action', name: 'action', searchable: false}
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                buttons: [
                    'selectAll',
                    'selectNone',
                    {
                        text: 'Delete All',
                        action: function (e, dt, node, config) {
                            var deleteids_arr = [];
                            $.each($("input[name='chk_orders[]']:checked"), function () {
                                deleteids_arr.push($(this).val());
                            });
                            // Confirm alert
                            var confirmdelete = confirm("Do you really want to Delete records?");
                            if (confirmdelete == true) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    url: '{{ url('/vendor/get-template-order-delete')}}/{{$template->client_id}}',
                                    type: 'POST',
                                    data: {deleteids_arr: deleteids_arr, _token: '{{ csrf_token() }}'},
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

                        }
                    },
                    {
                        text: 'Batch Update',
                        className:'btn btn-warning',
                    },
                    {
                        text: 'Batch Email',
                        className:'btn btn-info sendAll',
                        action: function (e, dt, node, config) {
                            var emailids_arr = [];
                            $.each($("input[name='chk_orders[]']:checked"), function () {
                                emailids_arr.push($(this).val());
                            });
                            $('#order_id').val(order_id);
                        }
                    },
                ],

            });


            $('.buttons-select-all').on('click', function () {
                var table = $("#orders-table");
                var boxes = $('input:checkbox', table);
                $.each($('input:checkbox', table), function () {
                    $(this).parent().addClass('checked');
                    $(this).prop('checked', 'checked');
                });

            });
            $('.buttons-select-none').on('click', function () {
                var table = $("#orders-table");
                var boxes = $('input:checkbox', table);
                $.each($('input:checkbox', table), function () {
                    $(this).parent().removeClass('checked');
                    $(this).prop('checked', false);
                });
            });


            $('.sendAll').on('click', function (e)
            {
                var emailids_arr = [];
                $.each($("input[name='chk_orders[]']:checked"), function () {
                    emailids_arr.push($(this).val());
                });
                // Confirm alert
                var confirmEmail = confirm("Do you really want to send batch emails?");
                if (confirmEmail == true) {
                    $('#sendAll').modal('show');
                    $('#order_ids').val(emailids_arr);

                }
            });

            $('#sendInvoice').on('click', function (e)
            {
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                    $.ajax({
                        type: "POST",
                        url: '{{ route('vendor.order.notify')}}',
                        data: {
                            'order_id': $("#order_id").val(),
                            'send_email':$("#send_email").val(),
                        },
                        success: function (data) {
                            $("#successMessageSend").show();
                        }
                    });
                    return false;
            });

            $('#sendInvoices').on('click', function (e)
            {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "POST",
                    url: '{{ route('vendor.order.notify.all')}}',
                    data: {
                        'order_ids': $("#order_ids").val(),
                        'send_email':$("#send_email").val(),
                    },
                    success: function (data) {
                        $("#successMessageSendAll").show();
                    }
                });
                return false;
            });



        });

    </script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="http://cdn.datatables.net/plug-ins/1.10.15/dataRender/datetime.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


    <div id="send" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><i class="fa fa-envelope"></i> &nbsp;<strong>{{ __('E-Mail Receipt') }}</strong></h3>
                </div>
                  <form id="store-deposit" action="{{ route('vendor.order.notify') }}" method="POST">
                     {{csrf_field()}}
                <div class="modal-body">
                    <br>
                    <h5>{{ __('Send receipt via email to the address below') }}</h5>
                    <input type="text" placeholder="email@domain.com" class="form-control" name="send_email">
                    <div id="successMessageSend" style="display:none;" class="alert alert-success" role="alert"> Invoice
                        successfully sent.
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="order_id" id="order_id">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" >{{ __('Send') }}</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" >{{ __('Cancel') }}</button>
                    </div>
                </div>
               </form>
            </div>
        </div>
    </div>

    <div id="sendAll" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><i class="fa fa-envelope"></i> &nbsp;<strong>{{ __('E-Mail Receipt') }}</strong></h3>
                </div>
                <form id="store-deposit" action="{{ route('vendor.order.notify.all')}}" method="POST">
                     {{csrf_field()}}
                <div class="modal-body">
                    <br>
                    <h5>{{ __('Send receipts via email to the address below') }}</h5>
                    <input type="text" placeholder="email@domain.com" class="form-control" name="send_email">
                    <div id="successMessageSendAll" style="display:none;" class="alert alert-success" role="alert"> Invoices
                        successfully sent.
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="order_ids" id="order_ids">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success"  >{{ __('Send') }}</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" >{{ __('Cancel') }}</button>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
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
        });
   </script>

@stop

@section('footer')

@stop