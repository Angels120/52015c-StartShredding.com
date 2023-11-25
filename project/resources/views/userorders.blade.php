@extends('includes.newmaster')

@section('content')

<div class="home-wrapper">
    <!-- Starting of Account Dashboard area -->
    <div class="section-padding dashboard-account-wrapper wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('includes.usermenu')
                </div>
                <div class="col-md-9">
                    <div class="dashboard-content">
                        <div id="my-orders-tab">
                            <h1>my orders</h1>
                            {{--<div class="order-item-quantity">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--1 Item(s)--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6 text-right">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Show</label>--}}
                                            {{--<select name="show-order">--}}
                                                {{--<option value="">10 per page</option>--}}
                                                {{--<option value="">15 per page</option>--}}
                                                {{--<option value="">20 per page</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="table-responsive">
                                <table class="table" id="userOrders">
                                    <thead>
                                    <tr class="table-header-row">
                                        <th>Order#</th>
                                        <th>Date</th>
                                        <th>Order Total</th>
                                        <th>Order Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->order_number}}</td>
                                        <td>{{$order->booking_date}}</td>

                                        <td>{{$settings[0]->currency_sign}}{{$order->pay_amount}}</td>
                                        <td>{{$order->status}}</td>
                                        <td><a href="{{url('user/order/')}}/{{$order->id}}">view order</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <a href="" class="back-btn">back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ending of Account Dashboard area -->
</div>

@stop

@section('footer')
<script>
    $('#userOrders').DataTable( {
        "order": []
    });
</script>
@stop