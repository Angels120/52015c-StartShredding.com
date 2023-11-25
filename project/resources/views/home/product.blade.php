@extends('home.includes.master',['cart_result'=> $response])

@section('header')
    @include('home.includes.header')
@stop
@section('content')
    <script>
        function placeOrder(id, price, service) {
            var product_id = id;
            var product_price = price;
            var product_quantity = $('.quantity').val();
            if (product_id != '') {
                var data = {
                    _token: null,
                    product_id: product_id,
                    product_price: product_price,
                    product_service: service,
                    product_quantity: product_quantity,
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(url('/update-cart-values')); ?>",
                    beforeSend: function(xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    data: data,
                    success: function(data) {
                        window.location.href = "<?php echo e(route('home.summary')); ?>";
                    }
                });
            }
            return false;
        }
    </script>
    <style type="text/css">
        .logo {
            margin-top: 34px !important;
        }

        #cartProductTable th,
        td {
            font-family: 'Montserrat';
            font-size: 12px !important;
        }

        #cartProductTable btn-primary {
            font-size: 13px !important;
        }

        .button-g {
            background-color: green;
            color: white !important;
        }

        .button-b {
            background-color: blue !important;
            color: white !important;
        }

        .button-bx {
            background-color: #0c1b7a !important;
            color: white !important;
        }

        .button-o {
            background-color: orange !important;
            color: black !important;
        }

        #destop-view {
            display: block;
        }

        #mobile-view {
            display: none;
        }

        @media only screen and (max-width: 600px) {
            #mobile.top-icons {
                top: unset !important;
            }

            #destop-view {
                display: none;
            }

            #mobile-view {
                display: block;
                border: unset;
            }

            .mobile-tr-boder {
                border-bottom: 1pt solid black;
                border-top: 1pt solid black;
            }

            .mobile-text-style-1 {
                font-size: 17px;
                font-weight: bold;
            }

            .mobile-text-style-2 {
                font-size: 12px;
            }

            .mobile-tyle {
                margin-bottom: 20px;
                margin-left: 20px;
            }

            .mobile-tyle ul {
                list-style-type: square;
            }
        }

    </style>
    <section class="p-b-65 p-t-20 m-t-40">
        <div class="container">
            <div class="row">
                <div class="col-md-12 p-t-50">
                    <div class="row">
                        <div class="step-pane step3 ">
                            <div class="col-md-12 col-sm-12 col-xs-12 border_sec">
                                <div class="content">
                                    <div class="container">
                                        <div class="col-xs-12 col-sm-12 col-md-12 " align="left">
                                            <p class="product_p">
                                                <b>Step 3: SELECT PRICE</b>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <h3 style="font-weight: 700;">{{ $products->title }}</h2>
                                                    <img style="width:270px;height:200px"
                                                        src="{{ URL::asset('assets/images/products/' . $products->feature_image) }}">
                                                    <form class="basic-form" style="margin-top: 20px;"
                                                        action="{{ route('home.order.update.details', $products->id) }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        <div class="row col-md-12">
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                                <input class="form-control quantity" type="text"
                                                                    value="{{ Session::get('quantity') }}" name="quantity"
                                                                    maxlength="4">
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                                <select class="form-control" name="type"
                                                                    style="padding: 4px; width:90px;"> 
                                                                    <?php
                                                                    $types = App\ProductType::get();
                                                                    ?>
                                                                    @foreach ($types as $type)
                                                                        <option value="{{ $type->id }}"
                                                                            @if ($type->id == Session::get('order_type')) selected="selected" @endif>
                                                                            {{ $type->type }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                                <button type="submit" class="btn button-bx btn-next">
                                                                    <strong>UPDATE QUANTITY</strong></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                            </div>
                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                <div class="table-responsive" id="destop-view">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"></th>
                                                                <th scope="col" bgcolor="yellow" align="center">Standard
                                                                </th>
                                                                <th scope="col" bgcolor="#228b22" align="center">Flex</th>
                                                                <th scope="col" bgcolor="yellow" align="center">Expedited
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td scope="row">Service Time</td>
                                                                <td style="text-align:center;">Within One Week</td>
                                                                <td style="text-align:center;">Within Two Weeks</td>
                                                                <td style="text-align:center;">Within 2 Days</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Certificate of Destruction</td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Free Recycling</td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Dedicated Account Manager</td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Weekend Service</td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                                <td style="text-align:center;"></td>
                                                                <td style="text-align:center;"><i
                                                                        class="fa fa-check"></i>
                                                                </td>
                                                            </tr>

                                                            <tr>

                                                                @php
                                                                    $priceList = unserialize($products['tiers']);
                                                                @endphp
                                                                <td></td>
                                                                <td style="text-align:center;">
                                                                    <h2><b>{{ "$" . number_format($priceList['standard'] * Session::get('quantity'), 2) }}</b>
                                                                    </h2>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <h2><b>{{ "$" . number_format($priceList['flex'] * Session::get('quantity'), 2) }}</b>
                                                                    </h2>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <h2><b>{{ "$" . number_format($priceList['expedited'] * Session::get('quantity'), 2) }}</b>
                                                                    </h2>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:center;"></td>
                                                                <td style="text-align:center;">
                                                                    @if (!Auth::guard('profile')->user())
                                                                        <a onclick="placeOrder('{{ $products['id'] }}','{{ number_format($priceList['standard'], 2) }}','Standard');"
                                                                            href="#"
                                                                            class="btn btn-warning button-y"><strong>Select
                                                                                Standard</strong></a>
                                                                    @else
                                                                        <a onclick="placeOrder('{{ $products['id'] }}','{{ number_format($priceList['standard'], 2) }}','Standard')"
                                                                            href="#"
                                                                            class="btn btn-warning button-y"><strong>Select
                                                                                Standard</strong></a>
                                                                    @endif
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    @if (!Auth::guard('profile')->user())
                                                                        <a onclick="placeOrder('{{ $products['id'] }}','{{ number_format($priceList['flex'], 2) }}','Flex');"
                                                                            href="#" class="btn btn-success button-x">
                                                                            <strong>Select Flex</strong></a>
                                                                    @else
                                                                        <a onclick="placeOrder('{{ $products['id'] }}','{{ number_format($priceList['flex'], 2) }}','Flex')"
                                                                            href="#" class="btn btn-success button-x">
                                                                            <strong>Select Flex</strong></a>
                                                                    @endif
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    @if (!Auth::guard('profile')->user())
                                                                        <a onclick="placeOrder('{{ $products['id'] }}','{{ number_format($priceList['expedited'], 2) }}','Expedited');"
                                                                            href="#"
                                                                            class="btn btn-warning button-y"><strong>Select
                                                                                Expedited</strong></a>
                                                                    @else
                                                                        <a onclick="placeOrder('{{ $products['id'] }}','{{ number_format($priceList['expedited'], 2) }}','Expedited')"
                                                                            href="#"
                                                                            class="btn btn-warning button-y"><strong>Select
                                                                                Expedited</strong></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="mobile-view">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"></th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $priceList = unserialize($products['tiers']);
                                                            @endphp
                                                            <tr class="mobile-tr-boder">
                                                                <td scope="row">
                                                                    <span class="mobile-text-style-1">STANDARD </span><br />
                                                                    <span class="mobile-text-style-2">Service Within 1
                                                                        Week</span>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <a onclick="placeOrder('{{ $products['id'] }}','{{ number_format($priceList['standard'], 2) }}','Standard')"
                                                                        href="#" class="btn button-g">
                                                                        <strong>{{ "$" . number_format($priceList['standard'] * Session::get('quantity'), 2) }}</strong></a>
                                                                </td>
                                                            </tr>
                                                            <tr class="mobile-tr-boder">
                                                                <td scope="row">
                                                                    <span class="mobile-text-style-1">FLEX </span><br />
                                                                    <span class="mobile-text-style-2">Service Within 2
                                                                        Weeks</span>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <a onclick="placeOrder('{{ $products['id'] }}','{{ number_format($priceList['flex'], 2) }}','Flex')"
                                                                        href="#" class="btn button-o">
                                                                        <strong>{{ "$" . number_format($priceList['flex'] * Session::get('quantity'), 2) }}</strong>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr class="mobile-tr-boder">
                                                                <td scope="row">
                                                                    <span class="mobile-text-style-1">EXPEDITED
                                                                    </span><br />
                                                                    <span class="mobile-text-style-2">Service Within 2
                                                                        days</span>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <a onclick="placeOrder('{{ $products['id'] }}','{{ number_format($priceList['expedited'], 2) }}','Expedited')"
                                                                        href="#" class="btn btn-warning button-b">
                                                                        <strong>{{ "$" . number_format($priceList['expedited'] * Session::get('quantity'), 2) }}</strong>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="mobile-tyle">
                                                        <ul>
                                                            <li>Certificate of Destruction</li>
                                                            <li>Free Recycling</li>
                                                            <li>Dedicated Account Manager</li>
                                                            <li>ECO Paperless</li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="col-md-12 col-sm-12 col-xs-6">
                                            <a type="button" class="btn btn-fo-back  btn-prev col-md-2 col-sm-4 col-xs-12"
                                                href="{{ url('/customers').'?tab_step=2' }}">Back</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>
@section('footer')
    @include('home.includes.footer')
@stop
