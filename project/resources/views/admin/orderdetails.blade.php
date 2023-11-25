@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/orders') !!}" class="btn btn-default btn-add"><i
                                    class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Order Details</h3>

                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">

                        <table class="table">
                            <tbody>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Order ID#</strong></td>
                                <td>{{$order->id}}</td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Name:</strong></td>
                                <td>{{$order->customer_name}}</td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Email:</strong></td>
                                <td>{{$order->customer_email}}</td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Phone:</strong></td>
                                <td>{{$order->customer_phone}}</td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Address:</strong></td>
                                <td>{{$order->customer_address}}</td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer City:</strong></td>
                                <td>{{$order->customer_city}}</td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Postal Code:</strong></td>
                                <td>{{$order->customer_zip}}</td>
                            </tr>
                            @if(isset($cus_details->unit_no))
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Unit #:</strong></td>
                                    <td>{{$cus_details->unit_no}}</td>
                                </tr>
                            @endif
                            {{-- <tr>
                                <td width="30%" style="text-align: right;"><strong>Unit #:</strong></td>
                                @if(isset($cus_details->unit_no))
                                    <td>{{$cus_details->unit_no}}</td>
                                @else
                                    <td></td>
                                @endif
                               
                            </tr> --}}
                            @if(isset($cus_details->buzz_code))
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Buzz Code:</strong></td>
                                    <td>{{$cus_details->buzz_code}}</td>
                                </tr>
                            @endif
                            {{-- <tr>
                                <td width="30%" style="text-align: right;"><strong>Buzz Code:</strong></td>
                                @if(isset($cus_details->buzz_code))
                                    <td>{{$cus_details->buzz_code}}</td>
                                @else
                                    <td></td>
                                @endif
                                
                            </tr> --}}
                            @if($order->order_type == 3)
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Service Type:</strong></td>
                                    <td>
                                        {{ $order_inquiry->service_type }}
                                    </td>
                                </tr>
                                @if($order_inquiry->shredding_type)
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shredding Type:</strong></td>
                                        <td>
                                            {{ $order_inquiry->shredding_type }}
                                        </td>
                                    </tr>
                                @endif
                                @if($order_inquiry->packing_container)
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Packing Type:</strong></td>
                                        <td>
                                            {{ $order_inquiry->packing_container }}
                                        </td>
                                    </tr>
                                @endif
                                @if($order_inquiry->quantity)
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Quantity:</strong></td>
                                        <td>
                                            {{ $order_inquiry->quantity }}
                                        </td>
                                    </tr>
                                @endif
                                @if($order_inquiry->additional_info)
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Additional
                                                Information:</strong></td>
                                        <td>
                                            {{ $order_inquiry->additional_info }}
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Start Date:</strong>
                                    </td>
                                    <td>
                                        {{ $order_inquiry->start_date }}
                                    </td>
                                </tr>
                                 @if($order_inquiry->promo_code)
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Promo Code:</strong>
                                    </td>
                                    <td>
                                        {{ $order_inquiry->promo_code }}
                                    </td>
                                </tr>
                                @endif
                                
                            @else
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Shipping Option:</strong></td>
                                    <td>
                                        @if($order->shipping == "pickup")
                                            Pick Up
                                        @else
                                            Ship To Address
                                        @endif
                                    </td>
                                </tr>
                                @if($order->shipping == "pickup")
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Pickup Location:</strong>
                                        </td>
                                        <td>{{$order->pickup_location}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping Name:</strong></td>
                                        <td>{{$order->shipping_name}}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping Email:</strong></td>
                                        <td>{{$order->shipping_email}}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping Phone:</strong></td>
                                        <td>{{$order->shipping_phone}}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping Address:</strong>
                                        </td>
                                        <td>{{$order->shipping_address}}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping City:</strong></td>
                                        <td>{{$order->shipping_city}}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping Postal
                                                Code:</strong>
                                        </td>
                                        <td>{{$order->shipping_zip}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Total Product:</strong></td>
                                    <td>{{array_sum($order->quantities)}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Total Cost:</strong></td>
                                    <td>{{$settings[0]->currency_sign}}{{$order->pay_amount}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Payment Method:</strong></td>
                                    <td>{{$order->method}}</td>
                                </tr>
                                @if($order->method != "Cash On Delivery")
                                    @if($order->method=="Stripe")
                                        <tr>
                                            <td width="30%" style="text-align: right;"><strong>{{$order->method}} Charge
                                                    ID:</strong></td>
                                            <td>{{$order->charge_id}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>{{$order->method}}
                                                Transection
                                                ID:</strong></td>
                                        <td>{{$order->txnid}}</td>
                                    </tr>
                                @endif
                            @endif
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Date:</strong></td>
                                <td>{{$order->booking_date}}</td>
                            </tr>
                            @if($order->order_type != 3)
                            <table class="table">
                                <h4 class="text-center">Products Ordered</h4>
                                <hr>
                                <thead>
                                <tr>
                                    <th width="10%">Product ID#</th>
                                    <th>Product Title</th>
                                    <th width="5%">Quantity</th>
                                    <th width="10%">Size</th>
                                    <th width="20%">Owner</th>
                                    <th width="10%">Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($products as $product)
                                    <tr>
                                        @if(\App\Product::where('id',$product->productid)->count() > 0)
                                            <td>{{$product->productid}}</td>
                                            <td><a target="_blank"
                                                   href="{{url('/product')}}/{{$product->productid}}/{{str_replace(' ','-',strtolower(\App\Product::findOrFail($product->productid)->title))}}">{{\App\Product::findOrFail($product->productid)->title}}</a>
                                            </td>
                                            <td>{{$product->quantity}}</td>
                                            <td>{{$product->size}}</td>
                                            <td>
                                                @if($product->owner == "vendor")
                                                    <a href="{{url('/admin/vendors')}}/{{$product->vendorid}}"
                                                       target="_blank">{{\App\Vendors::findOrFail($product->vendorid)->shop_name}}</a>
                                                @else
                                                    Admin
                                                @endif
                                            </td>
                                            <td class="o-{{$product->status}}">{{ucfirst($product->status)}}</td>
                                        @else
                                            <td>{{$product->productid}}</td>
                                            <td style="color:red;">Product Deleted</td>
                                            <td>{{$product->quantity}}</td>
                                            <td>{{$product->size}}</td>
                                            <td>
                                                @if($product->owner == "vendor")
                                                    @if(\App\Vendors::where('id',$product->vendorid)->count() > 0)
                                                        {{\App\Vendors::findOrFail($product->vendorid)->shop_name}}
                                                    @else
                                                        <span style="color:red;">Vendor Account Deleted</span>
                                                    @endif
                                                @else
                                                    Admin
                                                @endif
                                            </td>
                                            <td class="o-{{$product->status}}">{{ucfirst($product->status)}}</td>
                                        @endif
                                    </tr>
                                @endforeach
                                {{--@for($i=0;$i<=count($order->products)-1;$i++)--}}
                                {{--<tr>--}}
                                {{--@if(\App\Product::where('id',$order->products[$i])->count() > 0)--}}
                                {{--<td>{{$order->products[$i]}}</td>--}}
                                {{--<td><a target="_blank" href="{{url('/product')}}/{{$order->products[$i]}}/{{str_replace(' ','-',strtolower(\App\Product::findOrFail($order->products[$i])->title))}}">{{\App\Product::findOrFail($order->products[$i])->title}}</a></td>--}}
                                {{--<td>{{$order->quantities[$i]}}</td>--}}
                                {{--<td>{{explode(',',$order->sizes)[$i]}}</td>--}}
                                {{--@else--}}
                                {{--<td>{{$order->products[$i]}}</td>--}}
                                {{--<td style="color:red;">Product Deleted</td>--}}
                                {{--<td>{{$order->quantities[$i]}}</td>--}}
                                {{--<td>{{explode(',',$order->sizes)[$i]}}</td>--}}
                                {{--@endif--}}
                                {{--</tr>--}}
                                {{--@endfor--}}

                                </tbody>
                            </table>
                           @endif
                            <tr>
                                <td width="30%"></td>
                                <td><a href="email/{{$order->id}}" class="btn btn-primary"><i class="fa fa-send"></i>
                                        Contact Customer</a>
                                </td>
                            </tr>

                            </tbody>
                        </table>

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

@stop