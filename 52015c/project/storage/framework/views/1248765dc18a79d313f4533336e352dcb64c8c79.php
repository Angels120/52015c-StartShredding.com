<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(URL::asset('assets/map/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/map/css/custom.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/map/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/map/css/bootstrap-4-utilities.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"></script>

    <style>
        .w-100 {
            width: 100% !important;
        }

        .order-id {
            max-width: 150px;
            padding-right: 15px;
        }

        .order-id label {
            margin: 8px 0px;
        }

        div.dt-buttons {
            float: unset;
            margin: 48px 14px 0 0;
        }

        .buttons-select-all, .buttons-select-none {
            text-transform: capitalize;
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
        .form-inline select.form-control {
         min-width: 100%!important;
      }
      .custom-calendar {
    margin-top: unset;
       }
        
    </style>
    <script src="<?php echo e(URL::asset('assets/map/js/jquery1.11.3.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/map/js/jquery.blockUI.js')); ?>"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="page-title row">
        <h2><?php echo e($client->first_name." ".$client->last_name); ?></h2>
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
    <script>
        function modalSend(order_id)
        {
            $('#order_id').val(order_id);
        }
    </script>
    <div class="container row">
        <div class="row main-row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
                <div class="bg-white row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div id="exTab2" class="col-12">
                            <ul class="nav nav-tabs">
                                <li><a href="<?php echo e(url('/vendor/customer/'.$client->id)); ?>">Overview</a></li>
                                <li><a href="<?php echo e(url('/vendor/customer/'.$client->id.'/templates')); ?>">Templates</a></li>
                                <li class="active"><a
                                            href="<?php echo e(url('/vendor/customer/'.$client->id.'/orders')); ?>">Orders</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane  mt-3" id="1"></div>
                                <div class="tab-pane mt-3" id="2"></div>
                                <div class="tab-pane active mt-3" id="3">
                                    <div class="page-title row">
                                        <form action="" method="get">
                                            <div class="form-group">
                                                <div class="form-inline">
                                                    <div class="col-md-2 col-xs-12">
                                                        <label>Order Id</label>
                                                        <input type="text" style="width: 100%;" class="form-control" name="orderId" value="<?=($_GET['orderId']) != '' ? $_GET['orderId'] : ''?>" id="orderId">
                                                    </div>
                                                    <div class="col-md-2 col-xs-12">
                                                        <label>Customer</label>
                                                        <input type="text" style="width: 100%;" class="form-control" name="clientName" value="<?=($_GET['clientName']) != '' ? $_GET['clientName'] : ''?>" id="customer">
                                                    </div>
                                                    <div class="col-md-2 col-xs-12">
                                                        <label>Job Type</label>
                                                        <select class="form-control" name="type" style="width: 100%;">
                                                            <option value="">--Order Type--</option>
                                                            <?php foreach ($jobType as $type){ ?>
                                                            <option value="<?php echo e($type->id); ?>"
                                                                    <?php if($_GET['type'] == $type->id){?>selected<?php } ?>><?php echo e($type->name); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12">
                                                        <label>Payment Method</label>
                                                        <select class="form-control" name="method" style="width: 100%;">
                                                            <option value="">--Select--</option>
                                                            <option value="Paypal"
                                                                    <?php if($_GET['method'] == 'Paypal'){?>selected<?php } ?>>
                                                                PayPal
                                                            </option>
                                                            <option value="Credit Card"
                                                                    <?php if($_GET['method'] == 'Credit Card'){?>selected<?php } ?>>
                                                                Credit Card
                                                            </option>
                                                        </select>
                                                    </div>
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

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inline">
                                                    <div class="col-md-2 col-xs-12">
                                                        <label>From</label>
                                                        <div id="datepicker2" class="input-group date custom-calendar"
                                                             data-date-format="mm-dd-yyyy">
                                                            <input style="width: 100%;" class="form-control datepicker" id="fromTime" name="fromTime" type="text" value="<?=($_GET['fromTime']) != '' ? $_GET['fromTime'] : ''?>" style="width: 100%;"/>
                                                            <span class="input-group-addon"><i class="fa fa-calendar fromTimeCalendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12">
                                                        <label>To</label>
                                                        <div id="datepicker3" class="input-group date custom-calendar"
                                                             data-date-format="mm-dd-yyyy">
                                                            <input class="form-control datepicker" id="toTime"
                                                                   name="toTime" type="text" style="width: 100%;"
                                                                   value="<?=($_GET['toTime']) != '' ? $_GET['toTime'] : ''?>"/>
                                                            <span class="input-group-addon"><i class="fa fa-calendar toTimeCalendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12">
                                                        <label>Order Status</label>
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
                                                        <label>Action</label>
                                                        <input type="submit" name="orderForm" class="btn btn-success" style="width: 100%;" value="Search">
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 left-tab">
                                        <div class="table-responsive">
                                            <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                                <table class="table table-bordered w-100" id="orders-table">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                        </th>
                                                        <th>Id</th>
                                                        <th>Customer</th>
                                                        <th>Job Type</th>
                                                        <th>Method</th>
                                                        <th>Pay Amount</th>
                                                        <th>Booking Date</th>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $.urlParam = function (name) {
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                if(results==null){
                    return 0;
                }
                else {
                    return results[1] || 0;
                }
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var orderId = ($.urlParam('orderId')!=0)?$.urlParam('orderId'):'';
            var fromTime = ($.urlParam('fromTime')!=0)?$.urlParam('fromTime'):'';
            var toTime = ($.urlParam('toTime')!=0)?$.urlParam('toTime'):'';
            var quickDate = ($.urlParam('quickdate')!=0)?$.urlParam('quickdate'):'';
            var status = ($.urlParam('status')!=0)?$.urlParam('status'):'';
            var method = ($.urlParam('method')!=0)?$.urlParam('method'):'';
            var type = ($.urlParam('type')!=0)?$.urlParam('type'):'';
            var clientName = ($.urlParam('clientName')!=0)?$.urlParam('clientName'):'';

            var table = $('#orders-table').DataTable({
                dom: "flrtipB",
                processing: true,
                serverSide: true,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                ajax: {
                    url: '<?php echo e(url('vendor/get-template-order-ajax')); ?>/<?php echo e($client->id); ?>?orderId=' + orderId + '&quickdate=' + quickDate + '&fromTime=' + fromTime + '&toTime=' + toTime + '&clientName=' + clientName+ '&status=' + status + '&method=' + method + '&type==' + type + '&orderForm=Search',
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
                    {data: 'customer_name', name: 'clients.name'},
                    {data: "type", name: 'type', searchable: false},
                    {data: "method", name: 'method'},
                    {data: 'pay_amount', render: $.fn.dataTable.render.number(',', '.', 2, '$'), name: 'pay_amount'},
                    {
                        data: 'booking_date', render: function (data, type, full) {
                            return moment(new Date(data)).format('MM-DD-YYYY');
                        }
                    },
                    {data: 'status', render: function (data, type, full) {
                            return data.charAt(0).toUpperCase() + data.slice(1);
                        }}, 
                    {data: 'action', name: 'action', searchable: false}
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                order: [[1, 'DESC']],
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
                                    url: '<?php echo e(url('/vendor/get-template-order-delete')); ?>/<?php echo e($client->id); ?>',
                                    type: 'POST',
                                    data: {deleteids_arr: deleteids_arr, _token: '<?php echo e(csrf_token()); ?>'},
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
                    url: '<?php echo e(route('vendor.order.notify')); ?>',
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
                    url: '<?php echo e(route('vendor.order.notify.all')); ?>',
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
                    <h3 class="modal-title"><i class="fa fa-envelope"></i> &nbsp;<strong><?php echo e(__('E-Mail Receipt')); ?></strong></h3>
                </div>
                <form id="store-deposit" action="<?php echo e(route('vendor.order.notify')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <br>
                    <h5><?php echo e(__('Send receipt via email to the address below')); ?></h5>
                    <input type="text" placeholder="email@domain.com" class="form-control" name="send_email">
                    <div id="successMessageSend" style="display:none;" class="alert alert-success" role="alert"> Invoice
                        successfully sent.
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="order_id" id="order_id">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" ><?php echo e(__('Send')); ?></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" ><?php echo e(__('Cancel')); ?></button>
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
                    <h3 class="modal-title"><i class="fa fa-envelope"></i> &nbsp;<strong><?php echo e(__('E-Mail Receipt')); ?></strong></h3>
                </div>
                <form id="store-deposit" action="<?php echo e(route('vendor.order.notify.all')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <br>
                    <h5><?php echo e(__('Send rceipts via email to the address below')); ?></h5>
                    <input type="text" placeholder="email@domain.com" class="form-control" name="send_email">
                    <div id="successMessageSendAll" style="display:none;" class="alert alert-success" role="alert"> Invoice
                        successfully sent.
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="order_ids" id="order_ids">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" ><?php echo e(__('Send')); ?></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" ><?php echo e(__('Cancel')); ?></button>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.includes.master-vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>