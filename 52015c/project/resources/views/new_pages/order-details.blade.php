@extends('new_includes.new_main')

@section('title','Oder Details')



@section('content')
<style>
    .p-10 {
        padding: 10px !important;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .inner {
            display: none !important;
        }


        #print-btn {
            display: none !important;
        }

        #print * {
            visibility: visible;
        }

        /* #print{
            position: absolute;
            left: 0;
            top: 0;
        } */


    }
</style>

@php
$subtotal = 0;
$getOrderProducts = DB::select("select * from ordered_products where orderid='$order->id'");
if(is_array($getOrderProducts) && count($getOrderProducts)>0){
foreach ($getOrderProducts as $orderDetails) {
if($orderDetails!=null){
$productDetail = \App\Product::findOrFail($orderDetails->productid);
$subtotal += $orderDetails->cost * $orderDetails->quantity;
}
}
}
@endphp
<!-- START PAGE CONTENT -->
<div class="content ">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner">
                <!-- START BREADCRUMB -->
                {{-- <ol class="breadcrumb">
                            <!-- <li class="breadcrumb-item"><a href="#">Title</a></li> -->
                            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="my-stores.html">Transactions</a></li>
                            <li class="breadcrumb-item active">Transaction Details</li>
                        </ol> --}}
                <!-- END BREADCRUMB -->
            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->
    <!-- START CONTAINER FLUID -->
    <div class=" container-fluid">
        <!-- START card -->
        <div class="card card-default">
            <div class="card-header separator">
                <div class="card-title">
                    <h5><strong>Order Details</strong></h5>

                </div>
            </div>
            <div class="card-body p-t-20">
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col-md-7" id="print">
                        <div class="card card-default">
                            <div class="invoice padding-50 sm-padding-10">
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2 class="all-caps text-center font-weight-bold">
                                                {{$user['first_name']}} {{$user['last_name']}}</h2>

                                            <address class="m-t-10 text-center">
                                                {{$multiple_address->address}} <br>
                                                {{$multiple_address->city}}, {{$multiple_address->zip}} <br>
                                                @if(isset($user->unit_no))
                                                    Unit #: {{$user->unit_no}}<br>
                                                @endif
                                                @if(isset($user->buzz_code))
                                                    Buzz Code:{{$user->buzz_code}}<br>
                                                @endif
                                                {{$user->phone}}
                                            </address>
                                            {{-- <address class="m-t-10 text-center">
                                              
                                                @if(isset($user->unit_no))
                                                <p>Unit #: {{$user->unit_no}}</td>
                                                @else
                                                
                                                @endif
                                                </p>
                                              
                                                @if(isset($user->buzz_code))
                                                <p>Buzz Code:{{$user->buzz_code}}
                                                @else
                                                    
                                                @endif
                                              </p>
                                            </address> --}}
                                            
                                        </div>
                                        @php
                                        $date=date_create($order->booking_date);
                                        $new_date= date_format($date,"m/d/Y");
                                        @endphp
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <div class="sm-m-t-20">
                                                <h2 class=" all-caps text-center font-weight-bold">
                                                    {{$settings[0]->currency_sign}}{{ number_format($order->pay_amount, 2) }}
                                                </h2>
                                                <address class="m-t-10 text-center">
                                                    {{$new_date}} <br>
                                                    {{-- 2:45 PM <br> --}}
                                                    #{{ $order->order_number }}
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive table-invoice" id="responsive-table">
                                    <table class="table m-t-10">
                                        <thead>
                                            <tr>
                                                <th class="text-left">ITEM</th>
                                                <th class="text-center">QTY</th>
                                                <th class="text-right">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- <tr>
                                                        <td class="v-align-middle text-left">Product Name</td>
                                                        <td class="v-align-middle text-center">1</td>
                                                        <td class="v-align-middle text-right">$124.33</td>
                                                    </tr> --}}
                                            <tr>
                                                <?php
                                                        $getOrderProducts = DB::select("select * from ordered_products where orderid='$order->id'");
                                                        if(is_array($getOrderProducts) && count($getOrderProducts)>0){
                                                            foreach ($getOrderProducts as $orderDetails) { 
                                                                if($orderDetails!=null){
                                                                $productDetail = \App\Product::findOrFail($orderDetails->productid);
                                                                ?>
                                            <tr>
                                                <td class="v-align-middle text-left">{{$productDetail->title}}</td>
                                                {{-- <td class="v-align-middle text-left">{{$settings[0]->currency_sign}}{{$orderDetails->cost}}
                                                </td> --}}

                                                <td class="v-align-middle text-center">{{$orderDetails->quantity}}</td>
                                                <td class="v-align-middle text-right">
                                                    {{$settings[0]->currency_sign}}{{ number_format((float)$orderDetails->cost * $orderDetails->quantity, 2, '.', '')}}
                                                </td>
                                            </tr>
                                            <?php	
                                                            }
                                                            }
                                                        }
                                                        ?>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="row">
                                                        <div class="col-sm-6 text-center"
                                                            style="padding: 1px!important; border-bottom: none;">
                                                            <div class="b-a b-grey p-10 paym-info">
                                                                <h5 class="m-b-30 font-weight-bold">PAYMENT
                                                                    INFORMATION
                                                                </h5>

                                                                <div class="m-t-10 text-right justify-content-center">
                                                                    <div class="row">
                                                                        <div class="col-6 text-right p-l-5 p-r-5">
                                                                            <strong>METHOD:</strong>
                                                                        </div>
                                                                        <div class="col-6 text-left p-l-5 p-r-5">{{$order->method}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6 text-right p-l-5 p-r-5">
                                                                            <strong>REFERENCE:</strong></div>
                                                                        <div class="col-6 text-left p-l-5 p-r-5">
                                                                            {{ $order->order_number }}
                                                                            @if($order->method != "Cash On Delivery")
                                                                            @if($order->method=="Stripe")
                                                                            <p>{{$order->order_number}}</p>
                                                                            @endif
                                                                            <p>{{$order->txnid}}</p>
                                                                            @endif</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-6 text-center" colspan="2"
                                                            style="padding-bottom: 1px!important; border-bottom: none;">

                                                            <div class="row text-right ">
                                                                <div class="col-8 text-right"><strong>SUBTOTAL:</strong>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    {{$settings[0]->currency_sign}}{{ number_format((float)$order->subtotal, 2, '.', '') }}
                                                                </div>
                                                            </div>
                                                            @if ((float)$order->discount_amount > 0)
                                                            <div class="row text-right">
                                                                <div class="col-8 text-right"><strong>DISCOUNT:</strong>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    -{{$settings[0]->currency_sign}}{{ number_format((float)$order->discount_amount, 2, '.', '') }}
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="row text-right">
                                                                <div class="col-8 text-right"><strong>DELIVERY:</strong>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    {{$settings[0]->currency_sign}}{{number_format((float)$order->delivery, 2, '.', '')}}
                                                                </div>
                                                            </div>
                                                            <div class="row text-right">
                                                                <div class="col-8 text-right"><strong>TAXES:</strong>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    {{$settings[0]->currency_sign}}{{ number_format((float)$order->tax, 2, '.', '')}}
                                                                </div>
                                                            </div>
                                                            <div class="row text-right">
                                                                <div class="col-8 text-right"><strong>MAKE IT
                                                                        COUNT:</strong>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    {{$settings[0]->currency_sign}}{{ number_format((float)$order->make_it_count, 2, '.', '') }}
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="text-right bg-master-darker col-sm-height padding-10 d-flex flex-column justify-content-center align-items-end m-t-20">
                                                                <h5
                                                                    class="all-caps small no-margin hint-text text-white bold">
                                                                    Total</h5>
                                                                <h1 class="no-margin text-white">
                                                                    {{$settings[0]->currency_sign}}{{ number_format($order->pay_amount, 2) }}
                                                                </h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                </div>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-default">
                        <div class="card-header separator">
                            <div class="card-title">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <button id="print-btn" class="btn btn-primary btn-cons m-b-10 btn-block"
                                            type="button"><i class="fa fa-print"></i> <span class="bold">PRINT</span>
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-success btn-cons m-b-10 btn-block" type="button"
                                            hidden><i class="fa fa-envelope"></i> <span class="bold">EMAIL</span>
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-info btn-cons m-b-10 btn-block p-l-10" type="button"
                                            hidden><i class="fa fa-download"></i> <span class="bold">DOWNLOAD</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-body">
                                        <h5 class="font-weight-bold"><strong>Organize</strong></h5>
                                        <p class="m-b-20">We've made it easy for you to sort receipts and organize
                                            your finances.</p>
                                        <p class="m-b-30">Add them to `Envelopes` to categorize your expenses.
                                            Create Budgets to track your goal vs actual expenses</p>
                                        <form action="" id="form-env">
                                            <div class="input-group required">
                                                <input type="text" class="form-control"
                                                    placeholder="Add to Envelope" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text primary"
                                                        style="cursor: pointer;">ADD
                                                    </span>
                                                </div>
                                            </div>

                                            <p class="small m-t-10">
                                                <a href="manage-envelopes.html"><span>Go To Envelopes Manager</span>
                                                    <i
                                                        class="fa fs-12 fa-arrow-circle-o-right text-success m-l-10"></i></a>
                                            </p>
                                        </form>
                                        <br>
                                        <form action="" id="form-budget">
                                            <div class="input-group required">
                                                <input type="text" class="form-control" placeholder="Add to Budget"
                                                    required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text primary"
                                                        style="cursor: pointer;">ADD
                                                    </span>
                                                </div>
                                            </div>

                                            <p class="small m-t-10">
                                                <a href="#!"><span>Go To Budget Manager</span>
                                                    <i
                                                        class="fa fs-12 fa-arrow-circle-o-right text-success m-l-10"></i></a>
                                            </p>
                                        </form>
                                        <br>
                                        <h5 class="font-weight-bold"><strong>Archive It!</strong></h5>
                                        <p class="m-b-20">Don't need receipt anymore? Put them away quickly with our
                                            one touch archive</p>
                                        <form action="" id="form-archive">
                                            <div class="input-group required">
                                                <button type="button" class="btn btn-primary btn-block">SEND TO
                                                    ARCHIVES</button>
                                            </div>
                                        </form>
                                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
</div>
<!-- END card -->
</div>

<!-- END PAGE CONTENT -->
@endsection
@section('scripts')
<script>
    incrementVar = 1;
        function incrementValue(elem){
            var $this = $(elem);
            $input = $this.prev('input');
            $parent = $input.closest('div');
            newValue = parseInt($input.val())+1;
            $parent.find('.inc').addClass('a'+newValue);
            $input.val(newValue);
            incrementVar += newValue;
        }
        function decrementValue(elem){
            var $this = $(elem);
            $input = $this.next('input');
            $parent = $input.closest('div');
            newValue = parseInt($input.val())-1;
            $parent.find('.inc').addClass('a'+newValue);
            if(newValue <= 1){
                $input.val(1);
            }else{
                $input.val(newValue);
            }
            incrementVar += newValue;
        }
</script>
<script>
    function myMap() {
            var mapProp= {
                center:new google.maps.LatLng(51.508742,-0.120850),
                zoom:5,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        }
</script>
<script>
    $("#print-btn").click(function() {
   
               //$("#print_report").addClass("printable");
                window.print();
   
   
            });
   
</script>
<!-- END PAGE LEVEL JS -->
@endsection