<?php
use App\Order;
use App\OrderedProducts;
use Illuminate\Support\Facades\DB;

$fullUrlCurrent = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$status = [
    'pending' => 0,
    'in_transit' => 0,
    'at_plan_rece' => 0,
    'at_plan_com' => 0,
    'on_deliver' => 0,
    'completed_deliver' => 0,
    'completed_in_store' => 0,
];
$startTime = date('Y-m-d 00:00:00');
$endTime = date('Y-m-d 23:59:59');
$totalAmount = 0;
$urlTime = '';

?>
@extends('vendor.includes.master-vendor')

@section('content')
    <div class="row">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('error') }}
            </div>
        @endif
    </div>
    <style>
        @media only screen and (max-width: 767px) {
            .mb_left {
                text-align: left !important;
                margin: 25px 0;
            }
        }
    </style>
    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
            <div class="row">

                <div class="bg-white" style="padding-top: 50px;padding-bottom: 50px;">
                    <div class="card-body p-0">


                        <div class="row pb-5 p-5">
                            <div class="col-md-6">
                                <p class="font-weight-bold mb-4"><strong>Client Information</strong></p>
                                <p class="mb-1"><?= $order->customer_name ?></p>
                                <p><?= $order->customer_email ?></p>
                                <p class="mb-1"><?= $order->customer_city ?>, <?= $order->customer_address ?>
                                    <?= $order->customer_zip ?></p>
                                <p class="mb-1"><?= $order->customer_phone ?></p>
                            </div>
                            @if ($order->order_type == 3)
                                <div class="col-md-6 text-right mb_left">
                                    <p class="font-weight-bold mb-4"><strong>Payment Details</strong></p>
                                    <p class="mb-1"><span class="text-muted">Order number: </span>
                                        <?= $order->order_number ?></p>
                                    <p class="mb-1"><span class="text-muted">Payment Status: </span>
                                        <?= $order->payment_status ?></p>
                                </div>
                            @else
                                <div class="col-md-6 text-right mb_left">
                                    <p class="font-weight-bold mb-4"><strong>Payment Details</strong></p>
                                    <p class="mb-1"><span class="text-muted">Total Amount: </span>
                                        $<?= $order->pay_amount ?></p>
                                    <p class="mb-1"><span class="text-muted">Order number: </span>
                                        <?= $order->order_number ?></p>
                                    <p class="mb-1"><span class="text-muted">Payment Status: </span>
                                        <?= $order->payment_status ?></p>
                                    <p class="mb-1"><span class="text-muted">Payment Method: </span> <?= $order->method ?>
                                    </p>
                                </div>
                            @endif
                        </div>

                        <hr class="my-5">
                        @if ($order->order_type == 3)
                            <div class="row pb-5 p-5">
                                <div class="col-md-6">
                                    @php
                                        $created = date_create($orderinquiry->created_at);
                                        $created = date_format($created, 'm/d/Y');
                                    @endphp
                                    <p class="font-weight-bold mb-4"><strong>Order Inquiry Details</strong></p>
                                    <p class="mb-1"><span class="text-muted">Order Id : </span> <?= $order->id ?></p>
                                    <p class="mb-1"><span class="text-muted">Service Type : </span>
                                        <?= $orderinquiry->service_type ?></p>
                                    <p class="mb-1"><span class="text-muted">Shredding Type: </span>
                                        <?= $orderinquiry->shredding_type ?></p>
                                    <p class="mb-1"><span class="text-muted">Packing Container: </span>
                                        <?= $orderinquiry->packing_container ?></p>
                                    <p class="mb-1"><span class="text-muted">Quantity : </span>
                                        <?= $orderinquiry->quantity ?></p>
                                    <p class="mb-1"><span class="text-muted">Additional Info : </span>
                                        <?= $orderinquiry->additional_info ?></p>
                                    <p class="mb-1"><span class="text-muted">Start Date : </span>
                                        <?= $orderinquiry->start_date ?></p>
                                    <p class="mb-1"><span class="text-muted">Promo Code : </span>
                                        <?= $orderinquiry->promo_code ?></p>
                                    <p class="mb-1"><span class="text-muted">Created : </span> <?= $created ?></p>
                                </div>
                            </div>
                        @else
                            <div class="row p-5">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                                    <th class="border-0 text-uppercase small font-weight-bold">Product</th>
                                                    <th class="border-0 text-uppercase small font-weight-bold text-center">
                                                        Quantity</th>
                                                    <th class="border-0 text-uppercase small font-weight-bold">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                            $getOrderProducts = DB::select("select * from ordered_products where orderid='$order->id'");

                                            if(is_array($getOrderProducts) && count($getOrderProducts) > 0){
                                            foreach ($getOrderProducts as $orderDetails) {
                                            if($orderDetails != null){
                                            $productDetail = DB::select("select * from products where id='$orderDetails->productid'");
                                            ?>
                                                @php
                                                    $date = date_create($orderDetails->created_at);
                                                    $new_date = date_format($date, 'm/d/Y');
                                                @endphp
                                                <tr>
                                                    <td class="v-align-middle text-left">{{ $productDetail!=null ?? $productDetail[0]->id }}</td>
                                                    <td class="v-align-middle text-left">{{ $productDetail!=null ?? $productDetail[0]->title }} :
                                                        {{ $order->service }} Service</td>
                                                    <td class="v-align-middle text-center">{{ $orderDetails->quantity }}
                                                    </td>
                                                    <td class="v-align-middle text-left">
                                                        {{ $settings[0]->currency_sign }}{{ number_format((float) $order->subtotal, 2, '.', '') }}
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            }
                                            }
                                         ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-5">

                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <p class="font-weight-bold mb-1">Order ID #<?= $order->id ?></p>
                                    <p class="text-muted">Date: <?= $new_date ?></p>
                                </div>
                                <div class="col-md-6 text-right mb_left">
                                    <div class="mb-2">Grand Total</div>
                                    <div class="h2 font-weight-light" style="color: #000;margin: 5px 0">
                                        $<?= $order->pay_amount ?></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>



@stop

@section('footer')

@stop
