@extends('vendor.includes.master-vendor')

@section('content')
    <link href="{{ URL::asset('assets/map/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/custom.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/bootstrap-4-utilities.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <style>
        .w-100 {
            width: 100% !important;
        }

        .order-id {
            width: 150px!important;
            float: left;
            padding-right: 15px;
        }

        .order-id label {
            margin: 8px 0px;
        }

        @media only screen and (max-width: 480px)
        {
           .order-id {
            width: 100%!important;
            float: unset;
            padding-right: unset;
        }
     }

    </style>
    <script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
    <script src="{{ URL::asset('assets/map/js/jquery.blockUI.js')}}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="page-title row">
        <h2>{{$client->first_name." ".$client->last_name}}</h2>
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

    <div class="container row">
        <div class="row main-row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
                <div class="bg-white row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div id="exTab2" class="col-12">
                            <ul class="nav nav-tabs">
                                <li><a href="{{url('/vendor/customer/'.$client->id)}}">Overview</a></li>
                                <li class="active"><a href="{{url('/vendor/customer/'.$client->id.'/templates')}}">Templates</a>
                                </li>
                                <li>
                                    <a href="{{url('/vendor/customer/'.$client->id.'/orders')}}">Orders</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane  mt-3" id="1">
                                </div>
                                <div class="tab-pane active mt-3" id="2">
                                    <div class="page-title row">
                                        <form action="" method="get">
                                            <div class="form-group">
                                                <div class="form-inline">
                                                    <div class="col-md-2">
                                                        <label>Name#</label>
                                                        <input type="text" class="form-control order-id" name="template_name" value="<?=isset($_GET['template_name']) && ($_GET['template_name']) != '' ? $_GET['template_name'] : ''?>" id="template_name">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Job Type</label>
                                                        <select class="form-control" name="type" id="type">
                                                            <option value="">--Job Type--</option>
                                                            <?php foreach ($jobType as $type){ ?>
                                                            <option value="{{$type->id}}"
                                                                    <?php if(isset($_GET['type']) && $_GET['type'] == $type->id){?>selected<?php } ?>>{{$type->name}}</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Repeat By</label>
                                                        <select class="form-control" name="repeat" id="repeat">
                                                            <option value="">--Repeat--</option>
                                                            <option value="Daily" <?php if(isset($_GET['repeat']) && $_GET['repeat'] == 'Daily'){?>selected<?php } ?>>Daily</option>
                                                            <option value="Weekly" <?php if(isset($_GET['repeat']) && $_GET['repeat'] == 'Weekly'){?>selected<?php } ?>>Weekly</option>
                                                            <option value="Monthly" <?php if(isset($_GET['repeat']) && $_GET['repeat'] == 'Monthly'){?>selected<?php } ?>>Monthly</option>c
                                                            <option value="Quarterly" <?php if(isset($_GET['repeat']) && $_GET['repeat'] == 'Quarterly'){?>selected<?php } ?>>Quarterly</option>
                                                            <option value="Semi-Annual" <?php if(isset($_GET['repeat']) && $_GET['repeat'] == 'Semi-Annual'){?>selected<?php } ?>>Semi-Annual</option>
                                                            <option value="Yearly"  <?php if(isset($_GET['repeat']) && $_GET['repeat'] == 'Yearly'){?>selected<?php } ?>>Yearly</option>
                                                            <option value="On-Call" <?php if(isset($_GET['repeat']) && $_GET['repeat'] == 'On-Call'){?>selected<?php } ?>>On-Call</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>From</label>
                                                        <div id="datepicker2" class="input-group date custom-calendar"
                                                             data-date-format="mm-dd-yyyy">
                                                            <input class="form-control datepicker" id="fromTime" name="fromTime" type="text" value="<?=(isset($_GET['fromTime']) && $_GET['fromTime']) != '' ? $_GET['fromTime'] : ''?>" style="width: 100%;"/>
                                                            <span class="input-group-addon" ><i class="glyphicon glyphicon-calendar fromTimeCalendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>To</label>
                                                        <div id="datepicker3" class="input-group date custom-calendar" data-date-format="mm-dd-yyyy">
                                                            <input class="form-control datepicker" id="toTime" name="toTime" type="text" value="<?=(isset($_GET['toTime']) && $_GET['toTime']) != '' ? $_GET['toTime'] : ''?>"/>
                                                            <span class="input-group-addon" ><i class="glyphicon glyphicon-calendar toTimeCalendar" for="toTime"></i></span>
                                                        </div>
                                                     </div>
                                                    <div class="col-md-2">
                                                        <br/>
                                                        <input type="submit" name="orderForm" class="form-control btn btn-success" style="margin: 0;padding: 6px 20px;margin-top: 20px;" value="Search">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div style="float: right;padding-bottom:20px;">
                                        <a href="{{ url('vendor/template/') }}/{{$client->id}}/create" class="btn btn-info float-right my-2">
                                        <i class="glyphicon glyphicon-plus-sign"></i> Add New Template</a>
                                    </div>
                                    <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 left-tab">
                                        <div class="table-responsive">
                                            <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                                <table class="table table-bordered w-100" id="templates-table">
                                                    <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Name</th>
                                                        <th>Job Type</th>
                                                        <th>Repeat</th>
                                                        <th>Last Completed Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane mt-3" id="3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            var template_name = ($.urlParam('template_name')!=0)?$.urlParam('template_name'):'';
            var repeat = ($.urlParam('repeat')!=0)?$.urlParam('repeat'):'';
            var lastDate = ($.urlParam('lastDate')!=0)?$.urlParam('lastDate'):'';
            var fromTime = ($.urlParam('fromTime')!=0)?$.urlParam('fromTime'):'';
            var toTime = ($.urlParam('toTime')!=0)?$.urlParam('toTime'):'';
            var type = ($.urlParam('type')!=0)?$.urlParam('type'):'';
            var table = $('#templates-table').DataTable({
                // dom: "flrtipB",
                processing: true,
                serverSide: true,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                ajax: {
                    url: '{{ url('vendor/get-template-ajax')}}/{{$client->id}}?template_name=' + template_name + '&repeat=' + repeat + '&fromTime=' + fromTime+ '&toTime=' + toTime + '&type==' + type + '&orderForm=Search',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'name', name: 'name', fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a style='color: #0090d9' href='/vendor/order-template/" + oData.id + "'>" + oData.name + "</a>");
                        }
                    },
                    {data: 'typeName', name: 'typeName'},
                    {data: 'repeat', name: 'repeat'},
                    {data: 'last_date', name: 'last_date'},
                    {data: 'action', name: 'action', searchable: false}
                ],
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

@stop

@section('footer')

@stop