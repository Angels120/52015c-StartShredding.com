@extends('home.shop.includes.master',['cart_result'=> $response])
@section('header')
    @include('home.shop.includes.header')
@stop
@section('content')
    <link rel="stylesheet" href="{{ URL::asset('home_assets/css/orderConfirm.css') }}">
    <style>
        .modal-header .close {
            margin-top: -37px !important;
            font-size: 36px !important;
            margin-bottom: 10px !important;
        }
       #exampleModal{
        margin-top: 65px;
       }
        @media(max-width: 850px){
            .pay_lebel{
                text-align: left;
            }
           
        }
        @media(min-width: 780px){
            .back-mobile
            {
                display: none;
            }
            .back-large
            {
                display: block;
            }
        }
        @media(max-width: 780px){
           
            .back-large
            {
                display: none;
            }
            .sub{
                text-align: left;
            }
        }
        .btn-fo-back {
        color: #fff;
        background-color: #2f9fc4 !important;
        border-color: unset !important;
        margin-left: -14px;
        }
        .card {
            padding-bottom:unset;
        }
        .button-bx {
            background-color: #0c1b7a !important;
            color: white !important;
        }
        </style>
    @php
    $price = 0;
    $items = 0;
    foreach ($response as $res) {
        $price += $res->cost * $res->quantity;
        $items += $res->quantity;

        $user = Auth::user();
    }
    @endphp
    @php
    $quantities = 0;
    $products = 0;
    @endphp
    @foreach ($response as $res)
        @php
            if ($products == 0 && $quantities == 0) {
                $products = $res->product;
                $quantities = $res->quantity;
            } else {
                $products = $products . ',' . $res->product;
                $quantities = $quantities . ',' . $res->quantity;
            }
        @endphp
    @endforeach
    @php
    $delivery_fee = $settings[0]->delivery_fee;
    @endphp
    @php
    $delivery_fee = $settings[0]->delivery_fee;
    $donation_amount = $settings[0]->donation_amount;
    @endphp
    @php
    $discount = 0;
    if (Session::has('coupon')) {
        $discount = App\Coupon::calculateDiscount(Session::get('coupon'), $price);
    }
    @endphp
    @php
    $grandTotal = number_format(((float) ($price + $delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '');
    @endphp
    <section class="p-b-65 p-t-100 m-t-50">
        <div class="container">
            <div class="row">
                <!-- Starting of product filter area -->
                <div class="section-padding product-filter-wrapper wow fadeInUp" id="order-confirm-form">

                    <div class="container inner-block order-confrm-page">
                        <div class="row">
                            <div class="col-sm-10 col-md-offset-2">
                                @if (count($errors) > 0)
                                    <br>
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert"
                                            aria-label="close">&times;</a>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @if ($error == 'Invalid coupon code. Please try again.')
                                                    <script>
                                                        $(function() {
                                                            $("#order-confirm-form").show();
                                                            $("#order-payment-form").hide();
                                                        });
                                                    </script>
                                                @else
                                                    <script>
                                                        $(function() {
                                                            $("#order-confirm-form").hide();
                                                            $("#order-payment-form").show();
                                                        });
                                                    </script>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                @endif
                                <div class="row">
                                    <div class="col-md-10 md-offset-2">
                                        <div class="row">
                                            @if ($email_confirm_message = Session::get('confirm_email_message'))
                                                <div class="alert alert-danger alert-dismissable">
                                                    <a href="#" class="close" data-dismiss="alert"
                                                        aria-label="close">&times;</a>
                                                    <strong>{{ $email_confirm_message }}</strong>
                                                </div>
                                            @endif
                                            @if ($message = Session::get('success'))
                                                <div class="alert alert-success alert-dismissable">
                                                    <a href="#" class="close" data-dismiss="alert"
                                                        aria-label="close">&times;</a>
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- ui start from here -->
                                @if ($response->count() == 0)
                                    <div class="ube-card-body">
                                        <div class="text-center" id="emptyCart">
                                            Hey! Looks like your cart is empty, Please add some products! <br>
                                            <a href="{{ url('/customers') }}"><i
                                                    class="fa fa-cart-arrow-down"></i></a>
                                        </div>
                                    </div>
                                    <div>
                                    @else
                                        <div class="row col-container ">
                                            <div class="col-sm-10">
                                                <div>
                                                    <div class="ube-card-title">
                                                        Customer Information
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="bil-title">
                                                                Bill to:
                                                            </div>
                                                            <?php
                                                            
                                                            if (empty($multiple_address)) {
                                                                $address = Session::get('session_address');
                                                                $address = explode(',', $address);
                                                            } ?>
                                                            <? $session_address = Session::all();?>
                                                            <?php
                                                            $address = explode(',', $multiple_address->address);
                                                            ?>
                                                            <div class="bill-address">
                                                                <div class="customer-name">
                                                                    {{ Auth::guard('profile')->user()->first_name ? ucfirst(Auth::guard('profile')->user()->first_name) : ucfirst(Session::get('first_name')) }}
                                                                    {{ Auth::guard('profile')->user()->last_name ? ucfirst(Auth::guard('profile')->user()->last_name) : ucfirst(Session::get('last_name')) }}
                                                                </div>
                                                                <div class="customer-lane">{{ $address[0] }}</div>
                                                                <div class="customer-lane">{{ $address[1] }}</div>
                                                                <div class="customer-lane">{{ $address[2] }}</div>
                                                                <div class="customer-lane">{{ $address[3] }}</div>
                                                                <div class="customer-zip">{{ $address[4] }}</div>
                                                                <div class="customer-zip">{{ $address[5] }}</div>
                                                                <div class="customer-email">
                                                                    {{ Auth::guard('profile')->user()->email ? Auth::guard('profile')->user()->email : Session::get('email_address') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="delivery-title">
                                                                Pickup / Shipping :
                                                            </div>
                                                            <div class="delivery-address">
                                                                <div class="customer-name">
                                                                    {{ Auth::guard('profile')->user()->first_name ? ucfirst(Auth::guard('profile')->user()->first_name) : ucfirst(Session::get('first_name')) }}
                                                                    {{ Auth::guard('profile')->user()->last_name ? ucfirst(Auth::guard('profile')->user()->last_name) : ucfirst(Session::get('last_name')) }}
                                                                </div>
                                                                <div class="customer-lane">{{ $address[0] }}</div>
                                                                <div class="customer-lane">{{ $address[1] }}</div>
                                                                <div class="customer-lane">{{ $address[2] }}</div>
                                                                <div class="customer-lane">{{ $address[3] }}</div>
                                                                <div class="customer-zip">{{ $address[4] }}</div>
                                                                <div class="customer-zip">{{ $address[5] }}</div>
                                                                <div class="customer-email">
                                                                    {{ Auth::guard('profile')->user()->phone ? Auth::guard('profile')->user()->phone : Session::get('contact_no') }}
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">&nbsp;</div>
                                                    <div class="row">
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-4"><?php if(Auth::guard('profile')->user()){ ?>

                                                            <script>
                                                                $(document).ready(function() {
                                                                    $('#edit-address').on('click', function(e) {
                                                                        $('#iframe-updateDetails').attr('src',
                                                                            '{{ url('/update-address', $multiple_address->id) }}');
                                                                        $('#exampleModal').modal({
                                                                            backdrop: 'static'
                                                                        });
                                                                        $('#exampleModal').on('hidden.bs.modal', function(e) {
                                                                            $('#iframe-updateDetails').attr('src', '')
                                                                        });
                                                                        return false;
                                                                    });
                                                                });
                                                            </script>
                                                            <a class="btn button-bx" id="edit-address" data-toggle="modal"
                                                                data-target="#exampleModal" style="background-color: #1D4AB5 !important;">
                                                                Edit Details
                                                            </a>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-sm-3"></div>
                                                    </div>
                                                    <div class="row">&nbsp;</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <div class="ube-card">
                                                    <div class="ube-card-title">
                                                        Order Summary
                                                    </div>
                                                    <table id="productTable" class="table table-striped tabele-bordered"
                                                        style="margin-top:20px;">
                                                        <thead>
                                                            <tr style="text-transform: uppercase;">
                                                                <th>Item</th>
                                                                <th class="text-left">QTY</th>
                                                                <th class="text-left">Rate</th>
                                                                <th class="text-center">Total</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody style="font-size: 12px; font-weight: 500;">
                                                            <?php $itemCont = 0; 
                                                            $type = App\ProductType::where('id', Session::get('order_type'))->first()->type;
                                                         
                                                            ?>
                                                            @foreach ($cart as $res)
                                                                <tr>
                                                                    <td>
                                                                        <a style="font-weight: 650 !important;"
                                                                            href="{{ route('product.details', ['id' => $res->product, 'title' => str_slug(str_replace(' ', '-', $res->title))]) }}">{{ $res->title }}</a>
                                                                        <br />
                                                                        {{ $res->service }} Service
                                                                        <?php session::put('service', $res->service); ?>
                                                                        <br>
                                                                        Container Type : {{ $type }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="cart-product-count">
                                                                            <div class="input-group">
                                                                                <span class="input-group-btn">
                                                                                    <form
                                                                                        action="{{ url('/') . '/cart/product/qtydown/' . $res->product }}"
                                                                                        method="GET">
                                                                                        {{ csrf_field() }}
                                                                                        <button
                                                                                            class="btn btn-default btn-number"
                                                                                            type="submit">
                                                                                            <span
                                                                                                class="glyphicon glyphicon-minus"></span>
                                                                                        </button>
                                                                                    </form>
                                                                                </span>
                                                                                
                                                               <form  action="{{ url('/') . '/cart/product/qtyupdate/' . $res->product }}" method="POST">
                                                                                {{ csrf_field() }}
                                                                <input type="text" name="quantity" class="form-control input-number" onchange="updateCartQty(<?=$res->product?>)" value="{{ $res->quantity }}" >
                                                                 <button class="btn btn-default btn-number" id="cartUpdate" type="submit" style="display: none;"> </button>
                                                                </form>
                                                                                <span class="input-group-btn">
                                                                                    <form
                                                                                        action="{{ url('/') . '/cart/product/qtyup/' . $res->product }}"
                                                                                        method="GET">
                                                                                        {{ csrf_field() }}
                                                                                        <button
                                                                                            class="btn btn-default btn-number"
                                                                                            type="submit">
                                                                                            <span
                                                                                                class="glyphicon glyphicon-plus"></span>
                                                                                        </button>
                                                                                    </form>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        ${{ number_format((float) $res->cost, 2, '.', '') }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        ${{ number_format((float) $res->cost * $res->quantity, 2, '.', '') }}
                                                                    </td>
                                                                </tr>
                                                                <?php $itemCont++; ?>
                                                            @endforeach
                                                            <input type="hidden" id="confirm-item-count"
                                                                value="{{ $itemCont }}">
                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    @if (!Session::has('coupon'))
                                                                        <h5 class="card-title all-caps">Have a
                                                                            Coupon Code?</h5>
                                                                        <form action="{{ route('home.coupon.apply') }}"
                                                                            method="POST">
                                                                            {{ csrf_field() }}
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control"
                                                                                    id="coupon_code" name="coupon_code"
                                                                                    placeholder="Coupon Code" required>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn apply-btn">Apply
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <h5 class="card-title">Coupon Applied</h5>
                                                                        <form class="form-inline"
                                                                            action="{{ route('home.coupon.remove') }}"
                                                                            method="POST">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('delete') }}
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control"
                                                                                    id="coupon_code" name="coupon_code"
                                                                                    placeholder="Coupon Code"
                                                                                    value="{{ Session::get('coupon')['code'] }}"
                                                                                    readonly>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Remove
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $product_id = Session::get('product_id');
                                                            ?>
  <div class="col-xs-12 col-sm-12 col-md-6 m-t-10 back-large" align="left">
    <a class="btn btn-fo-back"
        href="{{ url('/customers/products/') . '/' . $product_id }}"
        style="width: 100%;margin-bottom: 10px;">BACK</a>
</div>
                                                          
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div>

                                                                <div class="row os-item" style="font-weight: 700; text-align:right; padding-right:2px;">
                                                                    <div class="col-xs-8 os-item-title">
                                                                        Subtotal:
                                                                    </div>
                                                                    <div class="col-xs-4 sub" style="text-align:left;">
                                                                        ${{ number_format((float) $price, 2, '.', '') }}
                                                                    </div>
                                                                </div>
                                                                @if (Session::has('coupon'))
                                                                    <div class="row os-item">
                                                                        <div class="col-xs-8 os-item-title">
                                                                            Discount:
                                                                        </div>
                                                                        <div class="col-xs-4 ">
                                                                            -$
                                                                            {{ number_format((float) $discount, 2, '.', '') }}
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                <div class="row os-item">
                                                                    <div class="col-xs-8 os-item-title">
                                                                        Delivery:
                                                                    </div>
                                                                    <div class="col-xs-4 ">
                                                                        ${{ number_format((float) $delivery_fee, 2, '.', '') }}
                                                                    </div>
                                                                </div>


                                                                <div class="row os-item">
                                                                    <div class="col-xs-8 os-item-title">
                                                                        Tax (13%):
                                                                    </div>
                                                                    <div class="col-xs-4 ">
                                                                        ${{ number_format(((float) ($price + $delivery_fee) * 13) / 100, 2, '.', '') }}
                                                                    </div>
                                                                </div>

                                                                <div class="row os-item">
                                                                    <div class="col-xs-8 os-item-title">
                                                                        <img class="makeitcounticon"
                                                                            src="{{ url('assets/img/3742-300x300.jpg') }}">

                                                                        <div class="makeittext"
                                                                            class="capital popovers" data-toggle="popover"
                                                                            title="" data-content="Help Us Make A Difference!
    Your small micro donation will go towards providing free services and programs for Mental Health.  In addition, this Merchant will also generously match your donation. <br> <br> <a href='{{ route('home.makeitcount') }}' target='_blank' title='test add link'><b style='color:#5e8000;'>Click Here</b> </a> to learn more about this program
    and the Janeen Foundation" data-original-title="Make It Count">Make it Count&nbsp;
                                                                            <i class="helpicon fa fa-question-circle"></i>
                                                                            &nbsp; :
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-4 ">

                                                                        <span class="input-group-text">$</span>

                                                                        <input class="editable-text"
                                                                            style="width:70px;display: inline-block;"
                                                                            aria-label="Amount (to the nearest dollar)"
                                                                            id="user-entered-donation-amount"
                                                                            grand-total-without-donation-amount="{{ $grandTotal - $donation_amount }}"
                                                                            value="{{ number_format((float) $donation_amount, 2, '.', '') }}"
                                                                            {{-- type="number" step="0.01" min="0" --}}
                                                                            onkeypress="return (event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode == 46  || event.charCode == 0">
                                                                    </div>
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-xs-12">
                                                                        <hr class="ube-hr">
                                                                    </div>
                                                                </div>
                                                                <div class="row os-item">
                                                                    <div class="col-xs-8 os-item-title">
                                                                        <b>Grand Total:</b>
                                                                    </div>
                                                                    <div class="col-xs-4 ">
                                                                        <b id="grand-total-row">${{ $grandTotal }}</b>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form method="post" id="confirm_and_buy_form">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="products" id="products"
                                                                    value="{{ $products }}" />
                                                                <input type="hidden" name="quantities" id="quantities"
                                                                    value="{{ $quantities }}" />
                                                                <input type="hidden" name="customer" id="customer"
                                                                    value="{{ Auth::guard('profile')->user()->id }}" />
                                                                <input type="hidden" name="discount" id="discount"
                                                                    value="{{ Session::has('coupon') ? Session::get('coupon')->value : null }}" />
                                                                <input type="hidden" name="discount_type" id="discount_type"
                                                                    value="{{ Session::has('coupon') ? Session::get('coupon')->type : null }}" />
                                                                <input type="hidden" name="subtotal" id="subtotal"
                                                                    value="{{ number_format((float) $price, 2, '.', '') }}" />
                                                                <input type="hidden" name="discount_amount"
                                                                    id="discount_amount"
                                                                    value="{{ number_format((float) $discount, 2, '.', '') }}" />
                                                                <input type="hidden" name="delivery" id="delivery"
                                                                    value="{{ number_format((float) $delivery_fee, 2, '.', '') }}" />
                                                                <input type="hidden" name="tax" id="tax"
                                                                    value="{{ number_format(((float) ($price + $delivery_fee) * 13) / 100, 2, '.', '') }}" />
                                                                <input type="hidden" name="make_it_count" id="make_it_count"
                                                                    value="{{ number_format((float) $donation_amount, 2, '.', '') }}" />
                                                                <input type="hidden" name="total" id="total"
                                                                    value="{{ number_format(((float) ($price + $delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}" />
                                                                <div class="btn-area text-right">
                                                                    <button type="submit" id="confirmBtn"
                                                                        class="btn btn-block btn-primary" style="background-color:green !important;">
                                                                        Confirm
                                                                    </button>
                                                                </div>

                                                            </form>
                                                          
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-6 m-t-10 back-mobile" align="left">
                                                            <a class="btn btn-primary"
                                                                href="{{ url('/customers/products/') . '/' . $product_id }}"
                                                                style="width: 100%;margin-bottom: 10px;">BACK</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="section-padding product-filter-wrapper wow fadeInDown" id="order-payment-form">

                    <div class="container inner-block order-confrm-page">
                        <div class="row">
                            <div class="col-sm-10 col-md-offset-1">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert"
                                            aria-label="close">&times;</a>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="row">
                                            @if ($email_confirm_message = Session::get('confirm_email_message'))
                                                <div class="alert alert-danger alert-dismissable">
                                                    <a href="#" class="close" data-dismiss="alert"
                                                        aria-label="close">&times;</a>
                                                    <strong>{{ $email_confirm_message }}</strong>
                                                </div>
                                            @endif
                                            @if ($message = Session::get('success'))
                                                <div class="alert alert-success alert-dismissable">
                                                    <a href="#" class="close" data-dismiss="alert"
                                                        aria-label="close">&times;</a>
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @endif


                                        </div>
                                    </div>
                                </div>
                                <!-- ui start from here -->
                                @if ($response->count() == 0)
                                    <div class="ube-card-body">
                                        <div class="text-center" id="emptyCart">
                                            Hey! Looks like your cart is empty, Please add some products! <br>
                                            <a href="{{ url('/customers') }}"><i
                                                    class="fas fa-cart-arrow-down"></i></a>
                                        </div>
                                    </div>
                                    <div>
                                    @else
                                        <div class="row col-container ">
                                            <div class="col-sm-6 cv-col">
                                                <div class="ube-card quickplay">
                                                    <div class="ube-card-title">
                                                        Credit Card Payment
                                                    </div>
                                                    <div class="ube-card-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="os-price" id="grand-total-row">
                                                                    <strong>Pay Amount:&nbsp;
                                                                        ${{ $grandTotal }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form id="credit-pay" method="POST"
                                                            action="{{ route('home.purchase.by.cc') }}">
                                                            <div class="form-group">
                                                                <div class="errorTxt"></div>
                                                                <br />
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="pay_lebel" for="name">Cardholder Name</label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" id="name"
                                                                            name="name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label for="card" class="pay_lebel">card#:</label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" id="card"
                                                                            name="card">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label for="name" class="pay_lebel">Expiry:</label>
                                                                    </div>
                                                                    <div class="col-sm-3 col-xs-6 block">
                                                                        <!-- <input type="text" class="form-control" id="month" placeholder="MM"  name="month"> -->
                                                                        <select class="form-control valid" id="month"
                                                                            name="month">
                                                                            <option value="">MM</option>
                                                                            <option value="01">Jan</option>
                                                                            <option value="02">Feb</option>
                                                                            <option value="03">Mar</option>
                                                                            <option value="04">Apr</option>
                                                                            <option value="05">May</option>
                                                                            <option value="06">June</option>
                                                                            <option value="07">July</option>
                                                                            <option value="08">Aug</option>
                                                                            <option value="09">Sep</option>
                                                                            <option value="10">Oct</option>
                                                                            <option value="11">Nov</option>
                                                                            <option value="12">Dec</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-3 col-xs-6 block">
                                                                        <!-- <input type="text" class="form-control" id="year" placeholder="YY"  name="year"> -->
                                                                        <select class="form-control valid" id="year"
                                                                            name="year">
                                                                            <option value="">YY</option>
                                                                            <option value="<?php echo substr(date('Y'), 2); ?>">
                                                                                <?php echo date('Y'); ?></option>
                                                                            <option value="<?php echo substr(date('Y') + 1, 2); ?>">
                                                                                <?php echo date('Y') + 1; ?></option>
                                                                            <option value="<?php echo substr(date('Y') + 2, 2); ?>">
                                                                                <?php echo date('Y') + 2; ?></option>
                                                                            <option value="<?php echo substr(date('Y') + 3, 2); ?>">
                                                                                <?php echo date('Y') + 3; ?></option>
                                                                            <option value="<?php echo substr(date('Y') + 4, 2); ?>">
                                                                                <?php echo date('Y') + 4; ?></option>
                                                                            <option value="<?php echo substr(date('Y') + 5, 2); ?>">
                                                                                <?php echo date('Y') + 5; ?></option>
                                                                            <option value="<?php echo substr(date('Y') + 6, 2); ?>">
                                                                                <?php echo date('Y') + 6; ?></option>
                                                                            <option value="<?php echo substr(date('Y') + 7, 2); ?>">
                                                                                <?php echo date('Y') + 7; ?></option>
                                                                            <option value="<?php echo substr(date('Y') + 8, 2); ?>">
                                                                                <?php echo date('Y') + 8; ?></option>
                                                                            <option value="<?php echo substr(date('Y') + 9, 2); ?>">
                                                                                <?php echo date('Y') + 9; ?></option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-2">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">

                                                                    <div class="col-sm-4 ">
                                                                        <label for="cvv" class="pay_lebel">CCV:</label>
                                                                    </div>
                                                                    <div class="col-sm-3 block">
                                                                        <input type="text" class="form-control" id="cvv"
                                                                            placeholder="123" name="cvv">
                                                                    </div>
                                                                    <div class="col-sm-3">

                                                                    </div>
                                                                    <div class="col-sm-2">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="products" id="products"
                                                                value="{{ $products }}" />
                                                            <input type="hidden" name="quantities" id="quantities"
                                                                value="{{ $quantities }}" />
                                                            <input type="hidden" name="customer" id="customer"
                                                                value="{{ Auth::guard('profile')->user()->id }}" />
                                                            <input type="hidden" name="discount" id="discount"
                                                                value="{{ Session::has('coupon') ? Session::get('coupon')->value : null }}" />
                                                            <input type="hidden" name="discount_type" id="discount_type"
                                                                value="{{ Session::has('coupon') ? Session::get('coupon')->type : null }}" />
                                                            <input type="hidden" name="subtotal" id="subtotal"
                                                                value="{{ number_format((float) $price, 2, '.', '') }}" />
                                                            <input type="hidden" name="discount_amount" id="discount_amount"
                                                                value="{{ number_format((float) $discount, 2, '.', '') }}" />
                                                            <input type="hidden" name="delivery" id="delivery"
                                                                value="{{ number_format((float) $delivery_fee, 2, '.', '') }}" />
                                                            <input type="hidden" name="tax" id="tax"
                                                                value="{{ number_format(((float) ($price + $delivery_fee) * 13) / 100, 2, '.', '') }}" />
                                                            <input type="hidden" name="make_it_count" id="make_it_count"
                                                                value="{{ number_format((float) $donation_amount, 2, '.', '') }}" />
                                                            <input type="hidden" name="total" id="total"
                                                                value="{{ number_format(((float) ($price + $delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}" />
                                                            <div class="col-sm-4"></div>
                                                            <div class="col-xs-12 text-center">
                                                            <button type="submit" class="btn btn-primary"
                                                                id="pay_now_action">PAY NOW
                                                            </button>
                                                            {{ csrf_field() }}
                                                            </div>
                                                            <br>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 cv-col">
                                                <div class="ube-card quickplay">
                                                    <div class="ube-card-title">
                                                        <img src="{{ url('/assets/img/uqickpay.png') }}" />
                                                    </div>
                                                    <div class="ube-card-body">
                                                        <div class="order-summery">
                                                            <div class="row os-item">
                                                                <div class="col-xs-8 os-item-title">
                                                                    Account Balance:
                                                                </div>
                                                                <div class="col-xs-4 os-price" id="user-account-balance">
                                                                    ${{ number_format((float) Auth::guard('profile')->user()->balance, 2, '.', '') }}
                                                                </div>
                                                            </div>
                                                            <div class="row os-item">
                                                                <div class="col-xs-8 os-item-title">
                                                                    Order total:
                                                                </div>
                                                                <div class="col-xs-4 os-price" id="grand-total-row">
                                                                    ${{ $grandTotal }}
                                                                </div>
                                                            </div>


                                                            <div class="row">

                                                                <div class="col-xs-12">
                                                                    <hr class="ube-hr">
                                                                </div>
                                                            </div>
                                                            <div class="row os-item">
                                                                <div class="col-xs-8 os-item-title">
                                                                    New Balance:
                                                                </div>
                                                                <div class="col-xs-4 os-price" id="new-balance-row">
                                                                    <b>
                                                                        ${{ number_format((float) Auth::guard('profile')->user()->balance - $grandTotal, 2, '.', '') }}</b>
                                                                </div>
                                                            </div>

                                                            <form action="{{ route('home.purchase.by.credit') }}"
                                                                method="POST" id="pay_now_form">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="products" id="products"
                                                                    value="{{ $products }}" />
                                                                <input type="hidden" name="quantities" id="quantities"
                                                                    value="{{ $quantities }}" />
                                                                <input type="hidden" name="customer" id="customer"
                                                                    value="{{ Auth::guard('profile')->user()->id }}" />
                                                                <input type="hidden" name="discount" id="discount"
                                                                    value="{{ Session::has('coupon') ? Session::get('coupon')->value : null }}" />
                                                                <input type="hidden" name="discount_type" id="discount_type"
                                                                    value="{{ Session::has('coupon') ? Session::get('coupon')->type : null }}" />
                                                                <input type="hidden" name="subtotal" id="subtotal"
                                                                    value="{{ number_format((float) $price, 2, '.', '') }}" />
                                                                <input type="hidden" name="discount_amount"
                                                                    id="discount_amount"
                                                                    value="{{ number_format((float) $discount, 2, '.', '') }}" />
                                                                <input type="hidden" name="delivery" id="delivery"
                                                                    value="{{ number_format((float) $delivery_fee, 2, '.', '') }}" />
                                                                <input type="hidden" name="tax" id="tax"
                                                                    value="{{ number_format(((float) ($price + $delivery_fee) * 13) / 100, 2, '.', '') }}" />
                                                                <input type="hidden" name="make_it_count" id="make_it_count"
                                                                    value="{{ number_format((float) $donation_amount, 2, '.', '') }}" />
                                                                <input type="hidden" name="total" id="total"
                                                                    value="{{ number_format(((float) ($price + $delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}" />
                                                                <div class="row">
                                                                    <div class="own-space"></div>
                                                                    <div class="col-xs-12 text-center">
                                                                        @if (Auth::guard('profile')->user()->balance == 0 || Auth::guard('profile')->user()->balance < $grandTotal)
                                                                            <button type="submit" class="btn paynow-btn"
                                                                                disabled>
                                                                                PAY NOW
                                                                            </button>
                                                                        @elseif(Auth::guard('profile')->user()->balance
                                                                            < 25.00) <button type="submit"
                                                                                class="btn paynow-btn" disabled>
                                                                                PAY NOW
                                                                                </button>
                                                                            @else
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">PAY NOW
                                                                                </button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </form>


                                                        </div>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="latitude" id="latitude"
                                                                value="{{ $multiple_address->latitude }}" />
                                                            <input type="hidden" name="logtitude" id="longitude"
                                                                value="{{ $multiple_address->longitude }}" />
                                                        </form>
                                                        <!--    <div class="btn-area">
                                                                    <a href="{{ route('home.packages') }}"
                                                                       class="btn btn-primary">Get Credits</a>
                                                                </div> -->

                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <br />
                                             <div class="col-xs-12 col-sm-12 col-md-12 m-t-10">
                                                    <div class="col-xs-6 col-sm-12 col-md-6 m-t-10" >
                                                     <div class="col-xs-6 col-sm-12 col-md-6" >
                                                     <a class="btn btn-fo-back" href="{{ url('/shop-order-confirm')}}" style="width: 100%;">BACK</a></div>
                                                     <div class="col-xs-6 col-sm-12 col-md-6" ></div>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-12 col-md-6 m-t-12">
                                                        
                                                    </div>
                                                </div>
                                           
                                        </div>
                                        <!-- ui end here -->
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="javascript:window.location.reload()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <iframe id="iframe-updateDetails" class="modal-body" src="" frameborder="0" scrolling="auto"
                        width="100%" height="500px"></iframe>
                </div>
            </div>
        </div>


    </section>
    <input type="hidden" name="user-account-balance" id="user-account-balance"
        value="${{ number_format((float) Auth::guard('profile')->user()->balance, 2, '.', '') }}" />
    <script>
        $("#order-payment-form").hide();
        $("#confirmBtn").click(function(e) {
            e.preventDefault();
            $("#order-confirm-form").hide();
            $("#order-payment-form").show();
        });

        incrementVar = 1;

        var grandTotalWithoutDonation = parseFloat($("#user-entered-donation-amount").attr(
            "grand-total-without-donation-amount"));
        var userAccountBalance = parseFloat($("#user-account-balance").html().replace('$', ''));
        $("#user-entered-donation-amount").change(function(event) {

            refreshGrandTotal();
        });

        function incrementValue(elem) {
            var $this = $(elem);
            $input = $this.prev('input');
            $parent = $input.closest('div');
            newValue = parseInt($input.val()) + 1;
            $parent.find('.inc').addClass('a' + newValue);
            $input.val(newValue);
            incrementVar += newValue;
        }

        function decrementValue(elem) {
            var $this = $(elem);
            $input = $this.next('input');
            $parent = $input.closest('div');
            newValue = parseInt($input.val()) - 1;
            $parent.find('.inc').addClass('a' + newValue);
            if (newValue <= 1) {
                $input.val(1);
            } else {
                $input.val(newValue);
            }
            incrementVar += newValue;
        }

        function refreshGrandTotal() {
            let donation = parseFloat($("#user-entered-donation-amount").val());
            if (isNaN(donation)) {
                donation = 0;
                $("#user-entered-donation-amount").val(0);
            }

            let grandTotal = (grandTotalWithoutDonation + donation).toFixed(2);
            let newBalance = (userAccountBalance - grandTotal).toFixed(2);

            if (grandTotal > userAccountBalance) {
                $(".paynow-btn").attr("disabled", true);
                $(".warning-text").removeClass("hidden");
            } else {
                $(".paynow-btn").attr("disabled", false);
                $(".warning-text").addClass("hidden");
            }

            // $('input[id="grandtotal"]').val(grandTotal);
            $('#pay_now_form').find('#total').val(grandTotal);
            $('#credit-pay').find('#total').val(grandTotal);
            $('#paypal-pay').find('#total').val(grandTotal);
            $('#pay_now_form').find('#make_it_count').val(donation);
            $('#credit-pay').find('#make_it_count').val(donation);
            $('#paypal-pay').find('#make_it_count').val(donation);
            $('#confirm_and_buy_form').find('#total').val(grandTotal);
            $('#confirm_and_buy_form').find('#make_it_count').val(donation);
            $('[id="grand-total-row"]').html("<b>$" + grandTotal + "</b>");
            $('[id="new-balance-row"]').html("$" + newBalance);
            $('[id="cartSummaryGrandTotal"]').html("<b>$" + grandTotal + "</b>");
            $('[id="cartSummaryMakeItCount"]').html("$" + donation);
            var items = $('[id="confirm-item-count"]').val();
            var tongleFooter = " ITEMS | <b> $";
            $(".dropdown .dropdnItem .tongle").html("");
            $(".dropdown .dropdnItem .tongle").html(items + tongleFooter + parseFloat(grandTotal).toFixed(2) + "</b>");

            console.log(grandTotal, newBalance);
        }

        // Initialize and add the map
        function initMap() {
            var lat = document.getElementById("latitude").value;
            var long = document.getElementById("longitude").value;

            var latitude = parseFloat(lat);
            var longitude = parseFloat(long);

            // The location of Uluru
            var uluru = {
                lat: latitude,
                lng: longitude
            };
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {
                    zoom: 15,
                    center: uluru
                });
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }

        function updateCartQty(id) {
            $("#cartUpdate").click();
        }

        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
        $(function() {
            $('#credit-pay').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true,
                        maxlength: 50
                    },
                    card: {
                        required: true,
                        number: true,
                        minlength: 11,
                        maxlength: 16
                    },
                    month: {
                        required: true,
                        number: true,
                        maxlength: 2
                    },
                    year: {
                        required: true,
                        number: true,
                        maxlength: 2
                    },
                    cvv: {
                        required: true,
                        maxlength: 4
                    }
                },
                // Specify the validation error messages
                messages: {
                    name: {
                        required: "Please enter card holder name",
                        maxlength: "Card holder name can not be more than 30 chars"
                    },
                    card: {
                        required: "Please enter your card number",
                        number: "Please enter valid card number",
                        minlength: "Please enter valid card number",
                        maxlength: "Please enter valid card number"
                    },
                    month: "Please enter a valid month",
                    year: "Please enter a valid year",
                    cvv: "Please enter a valid cvv"
                },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                submitHandler: function(form) {
                    if ($("#webteamContactForm").valid()) {
                        form.submit();
                        return false;
                    }
                }
            });

        });
    </script>
@stop
@section('footer')
    @include('home.shop.includes.footer')
@stop
