@extends('vendor.includes.master-vendor')

@section('content')
    <link href="{{ URL::asset('assets/map/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/custom.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/bootstrap-4-utilities.min.css')}}" rel="stylesheet">
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
                                <li><a href="{{url('/vendor/customer/'.$client->id.'/templates')}}">Templates</a></li>
                                <li><a href="{{url('/vendor/customer/'.$client->id.'/orders')}}">Orders</a></li>
                                <li><a href="{{url('/vendor/customer/'.$client->id.'/billing')}}">Billing</a></li>
                                <li class="active"><a href="{{url('/vendor/customer/'.$client->id.'/documents')}}">Documents</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane  mt-3" id="1"></div>
                                <div class="tab-pane mt-3" id="2"></div>
                                <div class="tab-pane mt-3" id="3"></div>
                                <div class="tab-pane mt-3" id="4"></div>
                                <div class="tab-pane active mt-3" id="5">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="top-title">
                                                <h3>List of Documents</h3>
                                            </div>
                                        </div>
                                        <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 left-tab">
                                            <div class="table-responsive">
                                                <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                                    <table class="table table-bordered w-100" id="documents-table">
                                                        <thead>
                                                            <th>Doc ID</th>
                                                            <th>Order#</th>
                                                            <th>Order Date</th>
                                                            <th>Complete Date</th>
                                                            <th>Actions</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order as $item)
                                                                <tr>
                                                                    <td>{{ $item->doc_id }}</td>
                                                                    <td>{{ $item->order_number }}</td>
                                                                    <td>{{ $item->booking_date }}</td>
                                                                    <td>{{ $item->complete_date }}</td>
                                                                    <td></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
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
    </div>
    <script>
        $(document).ready(function() {
            $('#documents-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                "pageLength": 15
            });
        });
        /* $(function () {
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
            var table = $('#documents-table').DataTable({
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

        }); */
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