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
    </style>
    <div class="page-title row">
        <h2>Template: {{$orderTemplate->name}}</h2>
        <div style="float: right;">
            <a class="btn btn-info right" href="/vendor/order-template/{{$orderTemplate->id}}/edit"><i class="glyphicon glyphicon-edit"></i> Edit Template</a>
            <a class="btn btn-warning right" href="/vendor/order-template-history/{{$orderTemplate->client_id}}/{{$orderTemplate->id}}"><i class="glyphicon glyphicon-record"></i> Order History</a>
        </div>
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
                        <h3>Template Details</h3>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="mt-2 col-md-4">
                            <p><strong>ID:</strong></p>
                            <p>{{$orderTemplate->id}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Name:</strong></p>
                            <p>{{$orderTemplate->name}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Customer:</strong></p>
                            <p>
                                <a href="/vendor/customer/{{$orderTemplate->client_id}}">{{$orderTemplate->client->first_name." ".$orderTemplate->client->last_name}}</a>
                            </p>
                        </div>
                        <div class="mt-2 col-md-4">
                            <p><strong>Job Type:</strong></p>
                            <p>{{$job_type->TYPE_NAME}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Average Service Time:</strong></p>
                            <p>{{$orderTemplate->avg_service_time}}&nbsp;minutes</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Account Manager:</strong></p>
                            <p>{{$accountManager->FULL_NAME}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Repeat:</strong></p>
                            <p>{{$orderTemplate->repeat}}</p>
                        </div>
                        <?php 
                        $schedule_from= date('m-d-Y', strtotime($orderTemplate->schedule_from));   
                       ?>
                        <div class="mt-2 col-md-4">
                            <p><strong>Auto Schedule From:</strong></p>
                            <p>{{$schedule_from}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Days Allowed:</strong></p>
                            <p>{{$orderTemplate->daysAllowed()}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Special Notes:</strong></p>
                            <p>{{$orderTemplate->special_notes}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Is Active:</strong></p>
                            <p>{{$orderTemplate->is_active==1? 'Yes':'No'}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>PO/CRO Number:</strong></p>
                            <p>{{(isset($orderTemplate->po_cro_no)?$orderTemplate->po_cro_no:'N/A')}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Payment Method:</strong></p>
                            <p>{{$orderTemplate->payment_method}}</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="top-title">
                        <h3>Actions</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-xs-12">
                            <a data-toggle="modal" data-target="#genNextMonth" class="btn btn-info float-right my-2">
                                <i class="glyphicon glyphicon-calendar"></i> Gen. for Next Month</a>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a data-toggle="modal" data-target="#genDateRange" class="btn btn-info float-right my-2">
                                <i class="glyphicon glyphicon-calendar"></i> Gen. for Date Range</a>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a data-toggle="modal" data-target="#genSingleDate" class="btn btn-info float-right my-2">
                                <i class="glyphicon glyphicon-calendar"></i> Gen. for Single Date</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="top-title">
                        <h3>Current Items</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 left-tab">
                                <div class="table-responsive">
                                    <a href="javascript:void(0);" onclick="addItem();"
                                       class="btn btn-info float-right my-2">
                                        <i class="glyphicon glyphicon-plus-sign"></i> Add Item</a>
                                    <form method="POST" action="/vendor/template-product">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                        <input type="hidden" name="template_id" value="{{$orderTemplate->id}}"/>
                                        <table data-text="customers" id="example" cellpadding="0" cellspacing="0"
                                               class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th width="10%">Product</th>
                                                <th width="10%">Description</th>
                                                <th width="2%">Qty</th>
                                                <th width="2%">Base Price</th>
                                                <th width="5%">Sub Total</th>
                                                <th width="2%"></th>
                                            </tr>
                                            </thead>
                                            <tbody class="item-tbody">
                                            <?php
                                            $subtotal=0.00;
                                            $total=0.00;
                                            ?>
                                            @foreach($orderTemplateItems as $orderTemplateItem)
                                                <tr id="existingRow{{$orderTemplateItem->id}}">
                                                    <td>
                                                        <select name="existingitem[{{$orderTemplateItem->id}}][product_id]"
                                                                id="existingitem" style="width:100%">
                                                            <option value="">Select Product</option>
                                                            @foreach($products as $value => $key)
                                                                <option value="{{$key}}"
                                                                        @if($key == $orderTemplateItem->product_id) selected="selected" @endif>
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" id="productprice"
                                                               value="{{App\Product::getPriceById($orderTemplateItem->product_id)}}"
                                                               name="existingitem[{{$orderTemplateItem->id}}][product_price]"/>
                                                    </td>
                                                    <td><input type="text" value="{{(!empty($orderTemplateItem->item_note))?$orderTemplateItem->item_note:App\Product::getShortDescriptionById($orderTemplateItem->product_id)}}"
                                                               name="existingitem[{{$orderTemplateItem->id}}][item_note]"
                                                               class="item_note" style="width:100%"/>
                                                    </td>
                                                    <td><input type="number" value="{{$orderTemplateItem->qty}}"
                                                               name="existingitem[{{$orderTemplateItem->id}}][qty]"
                                                               maxlength="5" size="5"/>
                                                    </td>
                                                    <td>
                                                        $<input type="text" id="itemprice"
                                                                value="{{number_format((float)($orderTemplateItem->base_price), 2, '.', '')}}" class="price"
                                                                name="existingitem[{{$orderTemplateItem->id}}][base_price]"
                                                                maxlength="8" size="8"/>
                                                    </td>
                                                    <td>
                                                        <?php $subtotal = $orderTemplateItem->base_price * $orderTemplateItem->qty; ?>
                                                        $<?=number_format((float)$subtotal, 2, '.', '')?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                           onclick="$(this).parent().parent().remove();"
                                                           class="btn btn-danger float-right">
                                                            <i class="glyphicon glyphicon-minus-sign"></i>&nbsp; remove</a>
                                                    </td>
                                                </tr>
                                                <?php $total=$total+$subtotal?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <input type="submit" id="save-order" value="Save" class="btn btn-md btn-info"/>
                                    </form>
                                    <div class="col-md-12">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3 p-r-20" style="text-align: right;">Total: &nbsp; $<?=number_format((float)$total, 2, '.', '')?></div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3 p-r-20" style="text-align: right;">Tax: &nbsp; &nbsp; $<?=number_format((float)($total*0.13), 2, '.', '')?></div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3 p-r-20" style="text-align: right;"><strong>Grand Total: &nbsp; &nbsp; $<?=number_format((float)($total*0.13+$total), 2, '.', '')?></strong></div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="genNextMonth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Generate for Next Month</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Do you want to generate orders for next month?
                            <form id="genNextMonthForm" action="/vendor/order-template/generate" method="POST">
                                <input type="hidden" name="order_template_id" value="{{$orderTemplate->id}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="order_template_type" value="1">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" onclick="$('#genNextMonthForm').submit();" class="btn btn-primary">
                                Yes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="genDateRange" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="text-align: center;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Generate for Date Range</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="genDateRangeForm" action="/vendor/order-template/generate" method="POST">
                                <input type="hidden" name="order_template_id" value="{{$orderTemplate->id}}">
                                {{ csrf_field() }}
                                <input type="text" name="dates" class="w-100"/>
                                <input type="hidden" name="order_template_type" value="2">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" onclick="$('#genDateRangeForm').submit();" class="btn btn-primary">
                                Yes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="genSingleDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="text-align: center;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Generate for Single Date</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="genSingleDateForm" action="/vendor/order-template/generate" method="POST">
                                <input type="hidden" name="order_template_id" value="{{$orderTemplate->id}}">
                                {{ csrf_field() }}
                                <input type="text" name="date" class="w-50" value="{{date('m/d/Y')}}"/>
                                <input type="hidden" name="order_template_type" value="3"><i class="glyphicon glyphicon-calendar"></i>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" onclick="$('#genSingleDateForm').submit();" class="btn btn-primary">
                                Yes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/vendor/customer/{{$orderTemplate->client_id}}" class="btn btn-success float-right my-2">Back To Customer Account</a>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
            type="text/javascript"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#save-order").click(function () {
                var product = $('#newitems option:selected').val();
                if (product == "") {
                    alert("Please select at least one product.");
                    return false;
                }
                var newprice = $('#itemprice').val();
                if (!parseFloat(newprice)) {
                    alert("Please enter correct price.");
                    return false;
                }
            });
        });
    </script>
    <script>
        $(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 50,
                ajax: '/vendor/get-template-ajax',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'job_type_id', name: 'job_type_id'},
                    {data: 'repeat', name: 'repeat'},
                    {data: 'schedule_from', name: 'schedule_from'},
                    {data: 'action', name: 'action', searchable: false}
                ]
            });
        });

        var increment = 1;
        var laravelToken = "{!! csrf_token() !!}";
        var options = {!! json_encode($products) !!};

        function addItem() {
            $('.item-tbody').append(
                '<tr id="' + "row" + increment + '">'
                + '<td><select  name="item[' + increment + '][product_id]" id="newitems" style="width:100%">' +
                '<option value="">Select Product</option></select>' +
                '</td>'
                + '<input type="hidden" id="productprice" value="" name="item[' + increment + '][product_price]" style="width:100%"/>'
                + '<td><input type="text" class="item_note" name="item[' + increment + '][item_note]" style="width:100%"/></td>'
                + '<td><input type="number" name="item[' + increment + '][qty]" value="1" maxlength="5" size="5" /></td>'
                + '<td>$<input type="text" id="itemprice" class="price" name="item[' + increment + '][base_price]" maxlength="8" size="8" value="0.00"/></td>'
                + '<td>$0.00</td>'
                + '<td><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();"'
                + 'class="btn btn-danger float-right">'
                + '<i class="glyphicon glyphicon-minus-sign"></i> remove</a></td>'
                + '</tr>'
            );
            $.each(options, function (value, key) {
                $("#row" + increment).find('select')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            increment++;
        }

        $('table').on('change', "select", function () {
            var self = this;
            $.ajax({
                url: "/vendor/template-product/get-price",
                method: "POST", //First change type to method here

                data: {
                    id: this.value, // Second add quotes on the value.
                    _token: laravelToken
                },
                success: function (response) {
                    console.log(response);
                    var product = JSON.parse(response);
                    var item_price=product.price;
                    jQuery(self).parent().parent().find("#productprice").val(product.price);
                    jQuery(self).parent().parent().find(".price").val(item_price.toFixed(2));
                    jQuery(self).parent().parent().find(".item_note").val(product.short_description);
                },
                error: function () {
                    alert("Something went wrong!");
                }

            });
        });
        $('input[name="dates"]').daterangepicker({
            minDate: moment()
        });
        $('input[name="date"]').datepicker({
            dateFormat: 'd/m/Y',
            defaultDate: new Date(),

        });
    </script>
@stop

@section('footer')

@stop