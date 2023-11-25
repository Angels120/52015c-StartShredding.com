@extends('home.shop.user.new_main')
@section('title','My Orders')
@section('content')
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START CONTAINER FLUID -->
    <div class="container-fluid p-b-50 m-t-40">

        <div class="row">
            <div class="col-sm-12 p-b-5" style="border-color: black !important">
                <div class="card card-default">
                    <div class="padding-25">
                        <div class="pull-left">
                            <div class="no-margin ube-card-title">My Transactions</div>
                            <p class="no-margin">Recent Transactions</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-11-2-table">
                        <table class="table table-hover table-condensed table-responsive" id="tableStore1" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th  class="all-caps">Transaction Id</th>
                                    <th  style=" white-space: nowrap;" class="all-caps">Ref#</th>
                                    <th  class="all-caps">Transaction</th>
                                    <th  class="all-caps">Amount</th>
                                    <th class="all-caps">Date </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $trans)
                                <tr class="text-center">
                                    <td class="fs-12">{{$trans->id}}</td>
                                    <td class="fs-12"><a href="{{url('/shop-transaction-details/')}}/{{$trans->id}}"><u>{{$trans->reference_id}}</u></a></td>
                                    <td style="text-transform: uppercase;" class="fs-12">{{$trans->type}}</td>
                                    <td class="fs-12">{{$settings[0]->currency_sign}}{{ number_format($trans->amount, 2) }}</td>
                                    <td class="fs-12">{{$trans->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- END CONTAINER FLUID -->

</div>
<!-- END PAGE CONTENT -->
@endsection
@section('scripts')
<script>
    $(document).ready(function (e) {
        $("#tableStore1").dataTable({
            // "sDom": "<'top'f<'clear'>><t><'row'<p i>>",
                "destroy": true,
                "order": [],
                "scrollCollapse": true,
                "bLengthChange": false,
                "columns": [
                        { "width": "30%" },
                        { "width": "30%" },
                        { "width": "20%" },
                        { "width": "20%" },
                        { "width": "20%" },
                    ],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ ",
                    "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
                },
                "iDisplayLength": 5
        })
    })
</script>
<!-- END PAGE LEVEL JS -->
@endsection