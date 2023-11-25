<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #customers th {
        padding-top: 5px;
        padding-bottom: 5px;
        text-align: left;
    }
</style>

<div style="width:760px;font-family:sans-serif;">
    <div style="font-family:sans-serif;">
        <div style="width:720px;">
            <div style="width:55%; float: left;">
                <img style="margin-top:20px;" src="http://shop.localshredding.ca/home_assets/images/logo.png"
                     width="220" height="45">
                @if ($booking->invoice->is_paid)
                    <span style="position:absolute; left:10px;"><img src="{{ asset('images/paid-stamp.png') }}"
                                                                     width="200px" height="122px"
                                                                     style="margin-top:-7px; "></span>
                @endif
            </div>
            <div style="width:45%;float: left;text-align: left;">
                <p><b><span style="font-size: 30px;">Invoice</span></b><br>
                    <b>Invoice#</b> {{$order->id}}<br>
                    @php
                        $date=date_create($order->booking_date);
                        $new_date= date_format($date,"m/d/Y");
                    @endphp
                    <b>Date#</b> {{$new_date}}</p>

            </div>
        </div>
        <div style="text-align:right; font-size:14px;clear:both; box-sizing: border-box;"></div>
        <div style="width:720px;font-family:sans-serif;">
            <div style="width:55%; float:left; ">
                <div style="font-size:13px; ">
                    <p><b>Bill To :</b><br>
                        <b>{{$user['first_name']}} {{$user['last_name']}}</b><br>
                        {{$multiple_address->address}}<br>
                        {{--                    @if(isset($user->unit_no))--}}
                        {{--                        Unit #: {{$user->unit_no}}<br>--}}
                        {{--                    @endif--}}
                        {{--                    @if(isset($user->buzz_code))--}}
                        {{--                        Buzz Code:{{$user->buzz_code}}<br>--}}
                        {{--                    @endif--}}
                        {{$user->phone}}</p>
                </div>
            </div>
            <div style="width:45%; float:left;text-align: left;">
                <p>Total Due :
                    <b>@php
                            $date=date_create($order->booking_date);
                            $new_date= date_format($date,"m/d/Y");
                        @endphp
                        {{$settings[0]->currency_sign}}{{ number_format($order->pay_amount, 2) }}
                    </b>
            </div>

        </div>
        <div style="text-align:right; font-size:14px;clear:both; box-sizing: border-box;"></div>
        <div style="width:100%;box-sizing: border-box;font-family:sans-serif;">
            <table style="width:100%" id="customers">
                <thead style="text-align: left;font-size:16px;">
                <tr>
                    <th style="width: 55%;border-bottom:1px solid #000;">ITEM DESCRIPTION</th>
                    <th style="width: 15%;border-bottom:1px solid #000;padding-left: 10px;">PRICE</th>
                    <th style="width: 15%;border-bottom:1px solid #000;text-align: center">QTY</th>
                    <th style="width: 20%;border-bottom:1px solid #000;text-align: right;">TOTAL</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total=0;
                $subtotal=0;
                $getOrderProducts = DB::select("select * from ordered_products where orderid='$order->id'");
                if(is_array($getOrderProducts) && count($getOrderProducts) > 0)
                {
                foreach ($getOrderProducts as $orderDetails) {
                if($orderDetails != null){
                $productDetail = DB::select("select * from products where id='$orderDetails->productid'");
                ?>
                <tr>
                    <td style="width: 50%;border-right:1px solid #000;">{{$productDetail[0]->title}}<br/>{{$order->service}} Service</td>
                    <td style="width: 15%;padding-left: 10px;border-right:1px solid #000;">{{$settings[0]->currency_sign}}{{ number_format((float)$order->subtotal, 2, '.', '')/$orderDetails->quantity }}</td>
                    <td style="width: 15%;padding-left: 10px;text-align: center;border-right:1px solid #000;">{{$orderDetails->quantity}}</td>
                    <td style="width: 20%;text-align: right;">
                        {{$settings[0]->currency_sign}}{{ number_format((float)$order->subtotal, 2, '.', '') }}
                    </td>
                </tr>
                <?php
                }
                }
                }
                ?>
                <tr>
                    <td style="width: 50%;border-right:1px solid #000;"></td>
                    <td style="width: 15%;padding-left: 10px;border-right:1px solid #000;"></td>
                    <td style="width: 15%;padding-left: 10px;border-right:1px solid #000;"></td>
                    <td style="width: 20%;text-align: right;"></td>
                </tr>
                <tr>
                    <td style="width: 50%;border-right:1px solid #000;"></td>
                    <td style="width: 15%;padding-left: 10px;border-right:1px solid #000;"></td>
                    <td style="width: 15%;padding-left: 10px;border-right:1px solid #000;"></td>
                    <td style="width: 20%;text-align: right;"></td>
                </tr>
                <tr>
                    <td style="width: 50%;border-right:1px solid #000;"></td>
                    <td style="width: 15%;padding-left: 10px;border-right:1px solid #000;"></td>
                    <td style="width: 15%;padding-left: 10px;border-right:1px solid #000;"></td>
                    <td style="width: 20%;text-align: right;"></td>
                </tr>
                <tr>
                    <td style="width: 50%;border-right:1px solid #000;"></td>
                    <td style="width: 15%;padding-left: 10px;border-right:1px solid #000;"></td>
                    <td style="width: 15%;padding-left: 10px;border-right:1px solid #000;"></td>
                    <td style="width: 20%;text-align: right;"></td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #000;width: 50%;border-right:1px solid #000;"></td>
                    <td style="border-bottom:1px solid #000;width: 15%;padding-left: 10px;border-right:1px solid #000;"></td>
                    <td style="border-bottom:1px solid #000;width: 15%;padding-left: 10px;border-right:1px solid #000;"></td>
                    <td style="border-bottom:1px solid #000;width: 20%;text-align: right;"></td>
                </tr>
                </tbody>
            </table>
            <div style="width:100%;  padding-top:5px; font-size:8px;">&nbsp;</div>
        </div>
        <div style="width:100%; box-sizing: border-box;">
            <div style="width:55%; float: left;">
                <table style="width:100%">
                    <tr>
                        <td width="55%"><b>Payment Method</b></td>
                    </tr>
                    <tr>
                        <td><strong>Payment: </strong> {{$order->method}}</td>
                    </tr>
                    <tr>
                        <td>Reference: {{ $order->order_number }}
                            @if($order->method != "Cash On Delivery")
                                @if($order->method=="Stripe")
                                    <p>{{$order->order_number}}</p>
                                @endif
                                {{--                                     <p>{{$order->txnid}}</p>--}}
                            @endif</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>Contact :</b></td>
                    </tr>
                    <tr>
                        <td>327 Evans Avenue Toronto,<br>
                            Ontario Canada M8Z 1K2<br>
                            (613) 702 5030 <br>
                            info@protectica.ca
                        </td>
                    </tr>
                </table>
            </div>
            <div style="width:45%;float: left;text-align: right;">
                <table style="width:100%">
                    <tr>
                        <td width="55%"><b>SUBTOTAL:</b></td>
                        <td width="45%" style="text-align: right;"><b>{{$settings[0]->currency_sign}}{{ number_format((float)$order->subtotal, 2, '.', '') }}</b></td>
                    </tr>
                    @if ((float)$order->discount_amount > 0)
                        <tr>
                            <td width="55%">DISCOUNT:</td>
                            <td width="45%" style="text-align: right;">-{{$settings[0]->currency_sign}}{{ number_format((float)$order->discount_amount, 2, '.', '') }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td width="55%">DELIVERY:</td>
                        <td width="45%" style="text-align: right;">{{$settings[0]->currency_sign}}{{number_format((float)$order->delivery, 2, '.', '')}}</td>
                    </tr>
                    <tr>
                        <td width="55%">TAXES</td>
                        <td width="45%" style="text-align: right;">{{$settings[0]->currency_sign}}{{ number_format((float)$order->tax, 2, '.', '')}}</td>
                    </tr>
                    <tr>
                        <td width="55%"><strong>MAKE IT COUNT:</strong></td>
                        <td width="45%" style="text-align: right;">{{$settings[0]->currency_sign}}{{ number_format((float)$order->make_it_count, 2, '.', '') }}</td>
                    </tr>
                    <tr>
                        <td  width="55%" style="border-bottom:1px solid #000;" ></td>
                        <td  width="45%" style="border-bottom:1px solid #000;" ></td>
                    </tr>
                    <tr>
                        <td style="margin-top: 5px; margin-bottom:5px; box-sizing: border-box;" width="55%"><b>Grand Total</b></td>
                        <td style="margin-bottom:5px; box-sizing: border-box;text-align: right;" width="45%"><b>{{$settings[0]->currency_sign}}{{ number_format($order->pay_amount, 2) }}</b></td>
                    </tr>
                </table>
            </div>
        </div>
        {{--        <div style="font-size:11px; padding-top:5px; clear:both; padding-left:20px; box-sizing: border-box;">About Late--}}
        {{--            Fees--}}
        {{--        </div>--}}
        {{--        <br>--}}
        {{--        <div style="font-size:9.5px; padding-left:20px; box-sizing: border-box;">ShredEX charges a late fee interest--}}
        {{--            calculated at the rate of 28% per annum or $5.00 whichever is greater. Unless otherwise stated in a--}}
        {{--            contract, all invoices are due upon receipt and late fees are applicable immediately, calculated from the--}}
        {{--            original service date.--}}
        {{--        </div>--}}

    </div>
</div>