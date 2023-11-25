@extends('home.shop.user.new_main')
@section('title','My Dashboard')
@section('content')
    <!-- START PAGE CONTENT -->
    <div class="content">

        <!-- START CONTAINER FLUID -->
        <div class="container-fluid p-b-50 m-t-40">

            <div class="row">
                <div class="col-lg-12 col-xl-6 col-xlg-5 p-b-5" style="border-color: black !important">
                    <div
                            class="widget-11-2 card no-border card-condensed no-margin widget-loader-circle full-height d-flex flex-column">
                        <div class="card-header  top-right">
                            <div class="card-controls">
                                <ul>
                                </ul>
                            </div>
                        </div>
                        <div class="padding-25">
                            <div class="pull-left">
                                <div class="no-margin ube-card-title">My Orders</div>
                                <p class="no-margin">Recent Orders</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="auto-overflow widget-11-2-table">
                            <table class="table table-condensed  table-hover " id="tableStore1">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 20%;" class="all-caps">Date</th>
                                    <th style="width: 35%;white-space: nowrap;" class="all-caps">Order ID</th>
                                    <th style="width: 20%;" class="all-caps">Amount</th>
                                    <th style="width: 30%;" class="all-caps">Status <i class="fa fa-question-circle"
                                                                                       style="color:white;" aria-hidden="true"></i></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                    <tr class="text-center">
                                        <td class="fs-12">{{date('m/d/Y', strtotime($order->booking_date))}}</td>
                                        <td class="fs-12">
                                            <a href="{{url('/shop-order-details')}}/{{$order->id}}"><u>{{$order->id}}</u></a>
                                        </td>

                                        <td class="fs-12">{{$settings[0]->currency_sign}}{{ number_format($order->pay_amount, 2) }}</td>
                                        @if($order->status=='scheduled'||$order->status=='in transit'||$order->status=='at
                                        plant'||$order->status=='at
                                        plant completed')
                                            <td class="fs-12">
                                                <button class="btn schedule-btn btn-cons btn-block"
                                                        type="button"><span>scheduled</span>
                                                </button>
                                            </td>
                                        @elseif($order->status=='completed'||$order->status=='completed at store')
                                            <td class="fs-12">
                                                <button class="btn complete-btn btn-cons btn-block"
                                                        type="button"><span>completed</span>
                                                </button>
                                            </td>
                                        @else
                                            <td class="fs-12">
                                                <button class="btn ondelivery-btn btn-cons btn-block" type="button"><span>on
                                                delivery</span>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="padding-25 mt-auto">
                            <p class="small pull-right">
                                <a href="{{ route('home.user-myorders') }}"><span>View Order History</span> <i class="fa fs-12 fa-arrow-circle-o-right text-success m-l-10"></i></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-xl-6 col-xlg-5 p-b-5">
                    <div class="widget-11-2 card no-border card-condensed no-margin widget-loader-circle ">
                        <div class="card-header  top-right">
                            <div class="card-controls">
                                <ul>
                                </ul>
                            </div>
                        </div>
                        <div class="padding-25">
                            <div class="pull-left">
                                <div class="no-margin ube-card-title">My Transactions</div>
                                <p class="no-margin">Recent Transactions</p>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="auto-overflow widget-11-2-table">
                            <table class="table table-hover" id="tableStore">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 20%;" class="all-caps">Date</th>
                                    <th style="width: 30%;" class="all-caps">Ref#</th>
                                    <th style="width: 22%;" class="all-caps">Transaction</th>
                                    <th style="width: 30%;" class="all-caps">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($credits_details as $credits_detail)
                                    <tr class="text-center">
                                        <td class="fs-12">{{$credits_detail->created_at->format('m/d/Y')}}</td>
                                        <td class="fs-12"><a href="{{url('/shop-transaction-details/')}}/{{$credits_detail->id}}"><u>{{$credits_detail->reference_id}}</u></a></td>
                                        <td style="text-transform: uppercase;" class="fs-12">{{$credits_detail->type}}</td>
                                        <td class="fs-12">
                                            @if($credits_detail->type == 'deposit' || $credits_detail->type == 'bonus' || $credits_detail->type =='purchase')
                                                <span style="color:#00ae00">+{{$settings[0]->currency_sign}}{{ number_format($credits_detail->amount, 2) }}</span>
                                            @elseif($credits_detail->type =='refund')
                                                <span style="color:#ff0000">-{{$settings[0]->currency_sign}}{{ number_format($credits_detail->amount, 2) }}</span>
                                            @else
                                                <span >{{$settings[0]->currency_sign}}{{ number_format($credits_detail->amount, 2) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="padding-25 mt-auto">
                        <p class="small pull-right">
                            <a href="{{ route('home.user-my-transactions') }}"><span>View Transaction History</span> <i class="fa fs-12 fa-arrow-circle-o-right text-success m-l-10"></i></a>
                        </p>
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
            $("#tableEnvelope").dataTable({
                "sDom": "<t><'row'<p i>>",
                "paging": false,
                "info": false,
                "destroy": true,
                "scrollCollapse": true,
                "oLanguage": {
                    "sLengthMenu": "_MENU_ ",
                    "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
                },
                "iDisplayLength": 5
            })

            $("#tableStore").dataTable({
                "sDom": "<t><'row'<p i>>",
                "order": [],
                "paging": false,
                "info": false,
                "destroy": true,
                "scrollCollapse": true,
                "oLanguage": {
                    "sLengthMenu": "_MENU_ ",
                    "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
                },
                "iDisplayLength": 5
            })
            $("#tableStore1").dataTable({
                "sDom": "<t><'row'<p i>>",
                "order": [],
                "paging": false,
                "info": false,
                "destroy": true,
                "scrollCollapse": true,
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