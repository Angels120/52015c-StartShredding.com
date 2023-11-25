@extends('admin.includes.master-admin')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h3>Admin Dashboard! </h3>
        <div class="row">
        <div class="dashboard-header-area col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Total Products!
                        <span class="product-quantity">{{ \App\Product::count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/products')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Orders Shedule!
                        <span class="product-quantity">{{ \App\Order::where('payment_status','Completed')->where('status','scheduled')->count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/orders')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Orders Processing!
                        <span class="product-quantity">{{ \App\Order::where('payment_status','Completed')->where('status','processing')->count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/orders')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Orders Completed!
                        <span class="product-quantity">{{ \App\Order::where('payment_status','Completed')->where('status','completed')->count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/orders')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-bank"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Pending Withdraws!
                        <span class="product-quantity">{{ \App\Withdraw::where('status','pending')->count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/withdraws/pending')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Total Customers!
                        <span class="product-quantity">{{ \App\Clients::count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/customers')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Vendors Pending!
                        <span class="product-quantity">{{ \App\Vendors::where('status',0)->count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/vendors/pending')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-group"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Total Vendors!
                        <span class="product-quantity">{{ \App\Vendors::count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/vendors')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-at"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Total Subscribers!
                        <span class="product-quantity">{{ \App\Subscribers::count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/subscribers')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
                            <div class="col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><strong>Top Referrals</strong></div>
                                    <div class="panel-body">
                                        <table class="table" style="margin-bottom: 0">
                                            <tbody>
                                            @foreach($referrals as $referral)
                                                <tr>
                                                    <td>{{$referral->referral}}</td>
                                                    <td>{{$referral->total_count}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><strong>Most Used Browser</strong></div>
                                    <div class="panel-body">
                                        <table class="table" style="margin-bottom: 0">
                                            <tbody>
                                            @foreach($browsers as $browser)
                                                <tr>
                                                    <td>{{$browser->referral}}</td>
                                                    <td>{{$browser->total_count}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-12" style="padding: 0">
                            <canvas id="lineChart" style="width: 100%"></canvas>
                        </div>

                </div>

            </div>
        </div>



        <div class="row" id="main" >



        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop

@section('footer')
    <script language="JavaScript">
        displayLineChart();
        function displayLineChart() {
            var data = {
                labels: [
                    {!! $days !!}
                ],
                datasets: [
                    {
                        label: "Prime and Fibonacci",
                        fillColor: "#3dbcff",
                        strokeColor: "#0099ff",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                            {!! $sales !!}
                        ]
                    }
                ]
            };
            var ctx = document.getElementById("lineChart").getContext("2d");
            var options = {
                responsive: true
            };
            var lineChart = new Chart(ctx).Line(data, options);
        }
        </script>
@stop