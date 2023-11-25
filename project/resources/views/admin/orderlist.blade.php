@extends('admin.includes.master-admin')

@section('content')
    <style>
        input[type=checkbox] {
            transform: scale(1.5);
        }
    </style>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <span><span style="background-color: lightgreen;">&nbsp;&nbsp;&nbsp;&nbsp;</span> Completed</span>
                        <span><span style="background-color: #d9edf7;">&nbsp;&nbsp;&nbsp;&nbsp;</span> Processing</span>
                    </div>
                    <h3>Orders</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>
                        <form action="{{ url('/admin/orders') }}">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="blog_id" class="control-label">ID #</label>
                                        <input type="text" class="form-control" name="id" value="{{ request()->get('id') }}">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="blog_id" class="control-label">Order Type</label>
                                        <select class="form-control" name="order_type">
                                            <option value="" selected>Select an option</option>
                                            <option value="1" <?php echo (request()->get('order_type')==1)?'selected="selected"':''?>>Walk In</option>
                                            <option value="2" <?php echo (request()->get('order_type')==2)?'selected="selected"':''?>>Online</option>
                                            <option value="3" <?php echo (request()->get('order_type')==3)?'selected="selected"':''?>>Inquiry</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" class="form-control" name="email" value="{{ request()->get('email') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="blog_id" class="control-label">Customer Name</label>
                                        <input type="text" class="form-control" name="customer_name" value="{{ request()->get('customer_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="blog_id" class="control-label">Payment Method</label>
                                        <select class="form-control" name="method">
                                            <option value="" selected>Select an option</option>
                                            <option value="CreditCard" <?php echo (request()->get('method')=="CreditCard")?'selected="selected"':''?>>CreditCard</option>
                                            <option value="Paypal" <?php echo (request()->get('method')=="Paypal")?'selected="selected"':''?>>Paypal</option>
                                            <option value="Credit" <?php echo (request()->get('method')=="Credit")?'selected="selected"':''?>>Credit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="blog_id" class="control-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="" selected>Select an option</option>
                                            <option value="completed" <?php echo (request()->get('status')=='completed')?'selected="selected"':''?>>Completed</option>
                                            <option value="completed at store" <?php echo (request()->get('status')=='completed at store')?'selected="selected"':''?>>Completed At Store</option>
                                            <option value="scheduled" <?php echo (request()->get('status')=='scheduled')?'selected="selected"':''?>>Scheduled</option>
                                            <option value="on delivery" <?php echo (request()->get('status')=='on delivery')?'selected="selected"':''?>>On Delivery</option>
                                            <option value="in transit" <?php echo (request()->get('status')=='in transit')?'selected="selected"':''?>>In Transit</option>
                                            <option value="at plant completed" <?php echo (request()->get('status')=='at plant completed')?'selected="selected"':''?>>At Plant Completed</option>
                                            <option value="at plant" <?php echo (request()->get('status')=='at plant')?'selected="selected"':''?>>At Plant</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <br>
                                        <button type="submit" class="btn btn-success">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                            <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Order#</th>
                                <th>Order Type</th>
                                <th>Customer Email</th>
                                <th width="15%">Customer Name</th>
                                <th width="5%">Total Product</th>
                                <th width="10%">Total Cost</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)

                                @if($order->status == "completed")
                                    <tr style="background-color: lightgreen;">
                                @elseif($order->status == "processing")
                                    <tr class="info">
                                @else
                                    <tr class="">
                                        @endif
                                        <td><input type="checkbox" name="chk_order[]" id="chk_job_{{ $order->id }}"
                                                   value="{{ $order->id }}" email_address="{{$order->customer_email}}"
                                                   class="chkbx-client"></td>
                                        <td>{{$order->id}}</td>
                                        <td>
                                            @if($order->order_type == 1)
                                                Walk In
                                            @elseif($order->order_type == 2)
                                                Online
                                            @else
                                                Inquiry
                                            @endif
                                        </td>
                                        <td>{{$order->customer_email}}</td>
                                        <td>{{$order->customer_name}}</td>
                                        <td>{{(array_sum($order->quantities)!=0)?array_sum($order->quantities):'-'}}</td>
                                        <td>{{($order->pay_amount!='')?"$ ".$order->pay_amount:'-'}}</td>
                                        <td>{{($order->method!='')?$order->method:'-'}}</td>
                                        <td><a href="#" class="btn btn-primary btn-xs"
                                               readonly>{{ucfirst($order->status)}}</a></td>
                                        <td>

                                            <a href="{{ url('admin/orders/show/'.$order->id) }}" class="btn btn-primary btn-xs"><i
                                                        class="fa fa-check"></i> View Details </a>

                                            <a href="orders/email/{{$order->id}}" class="btn btn-primary btn-xs"><i
                                                        class="fa fa-send"></i> Send Email</a>
                                        <!--
                                    ​<span class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-xs" type="button"
                                            data-toggle="dropdown">{{ucfirst($order->status)}}
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="orders/status/{{$order->id}}/scheduled">Scheduled</a></li>
                                            <li><a href="orders/status/{{$order->id}}/in transit">In Transit</a></li>
                                            <li><a href="orders/status/{{$order->id}}/at plant">At Plant</a></li>
                                            <li><a href="orders/status/{{$order->id}}/on delivery">On Delivery</a></li>
                                            <li><a href="orders/status/{{$order->id}}/at plant completed">At Plant
                                                    Completed</a></li>
                                            <li><a href="orders/status/{{$order->id}}/completed">Completed</a></li>
                                            <li><a href="orders/status/{{$order->id}}/completed at store">Completed At
                                                    Store</a></li>
                                        </ul>
                                    </span> -->

                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Select All &nbsp;
                                    <input type="checkbox" name="chk_job_all" id="Select_all">
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <button type="button" name="btn_bulk_mail" id="btn_bulk_mail"
                                        class="btn btn-primary footer-button" onclick="bulkMail()">Bulk Mail
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="bulk-mail-popup-content" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Send Mail</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="mail_form" method="post"
                                              action="{{ url('admin/orders/bulkMailSend') }}">
                                            <div class="col-md-12">
                                                {{ csrf_field() }}
                                                <div class="row form-group">
                                                    <div class="col-md-3">
                                                        <label>Template :</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select class="form-control email_twmplate" name="template"
                                                                id="template" required>
                                                            <option value="" selected disabled>Select status</option>
                                                            @foreach($order_status_mails as $status)
                                                                <option value="{{$status['status']}}"
                                                                        content="{{$status['email_body']}}"
                                                                        subject="{{$status['email_subject']}}">{{$status['status']}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-3">
                                                        <label>Address :</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select id="email-multi-select" name="email_multi_select[]"
                                                                class="form-control" multiple size="4" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class=" control-label">Subject:</label>
                                                    <input class="form-control" name="email_subject" id="email_subject"
                                                           placeholder="Enter Subject" value="" required>
                                                </div>
                                                <div class="row form-group">
                                                    <label class=" control-label">Text:</label>
                                                    <textarea class="form-control" rows="5" name="email_body"
                                                              id="email_body" placeholder="mail body" rows="10"
                                                              required></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close
                                            </button>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="submit" form="mail_form" value="Send mail" id="send_mail"
                                                   name="btn_send_mail" class="btn btn-success">
                                        </div>
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
    {{--javaScript--}}
    <script type="text/javascript">
        function bulkMail() {

            checkboxes = document.getElementsByName('chk_order[]');
            var order_ids = "";
            $('#email-multi-select')
                .find('option')
                .remove()
                .end();
            for (var i in checkboxes) {
                if (checkboxes[i].checked) {
                    order_ids += checkboxes[i].value + ",";
                    //  $("#email-multi-select").append(new Option("demo_text", checkboxes[i].value));
                    var o = new Option($(checkboxes[i]).attr('email_address'), checkboxes[i].value);
                    $(o).html($(checkboxes[i]).attr('email_address'));
                    $("#email-multi-select").append(o);
                    //alert(checkboxes[i].value + '||'+checkboxes[i].checked);
                }
            }
            $('#email-multi-select option').prop('selected', true);
            if (order_ids === "") {
                alert("Please select at least one record from list.");
                return false;
            }

            $('#hf_job_ids_mail').val(order_ids);
            $('#bulk-mail-popup-content').modal('show');
        }

        $(document).ready(function () {
            $("#Select_all").on("click", function () {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
            });

            CKEDITOR.replace('email_body', {
                allowedContent: true
            });

            $("select.email_twmplate").change(function () {
                var mailContent = $(this).children("option:selected").attr('content');
                var mailSubject = $(this).children("option:selected").attr('subject');
                document.getElementById("email_subject").value = mailSubject;
                CKEDITOR.instances.email_body.setData(mailContent);
            });
        });

        $(document).ready(function () {
            $('#send_mail').click(function () {
                if ($('#email_subject').val() != "" && $('#email-multi-select').val() != null) {
                    $('#bulk-mail-popup-content').modal('toggle');
                    $("#btn_bulk_mail").attr("disabled", true);
                }
            });
        });

    </script>
    <script src="{!! asset('new_assets/assets/plugins/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! asset('new_assets/assets/plugins/ckeditor/jquery-ckeditor.js') !!}"></script>
@stop