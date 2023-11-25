@extends('includes.newmaster2',['cart_result'=> $response])

@section('content')
<style>
    body {
        font-family: 'Raleway', sans-serif;
    }

    .heading-title h3 {
        text-transform: uppercase;
        font-weight: bold;
    }
    .grand-total-line {
    font-weight: bold;
    font-size: 1.3rem;
}
    .btn-checkout {
        background-color: #b4f400;
        color: #452125;
        font-weight: bold;
        text-transform: uppercase;
        height: 45px;
        font-weight: bold;
        font-size: 18px;
        letter-spacing: 1px;
    }

    .cart-product-count {
        width: 20%;
        min-width: 150px;
    }

    .cart-product-list {
        padding-left: 0px;
    }

    .cart-item .cart-product-img,
    .cart-item .cart-product-name,
    .cart-item .cart-product-count,
    .cart-item .cart-product-price,
    .cart-item .cart-product-option {
        display: inline-block;
    }

    .cart-item {
        list-style: none;
        display: inline-flex;
        border-top: 1px solid #ddd;
        width: 95%;
        padding: 2rem 0px;
    }

    .cart-product-img {
        min-width: 100px;
        width: 15%;
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        margin: auto;
    }

    .cart-product-name {
        width: 40%;
        text-transform: uppercase;
        text-align: center;
    }

    .cart-product-price {
        width: 20%;
        text-align: center;
        font-weight: bold;
        font-size: 19px;
    }

    .cart-product-option {
        text-align: center;
        width: 8%;
    }

    .cart-item .cart-product-name,
    .cart-item .cart-product-count,
    .cart-item .cart-product-price,
    .cart-item .cart-product-option {
        padding: 3.3rem 0px;
    }

    .cart-product-count .input-group span {
        height: 17px;
        width: auto;

    }

    .cart-product-count .input-group button {
        border-radius: 0px;
    }

    .cart-product-count .input-group input {
        text-align: center;
        width: 45px;
    }

    .cart-item .cart-product-name {
        padding: 4rem 0px;
        text-align: left;
        padding-left: 30px;
    }

    .cart-product-option i {
        top: 0px;
        position: relative;
        cursor: pointer;
    }

    li.cart-item:last-child {
        border-bottom: 1px solid #ddd;
    }

    .order-summery {
        border: 1px solid #ddd;
        padding: 2rem;
        text-transform: uppercase;
    }

    .order-summery button.checkout {
        text-transform: uppercase;
        height: 45px;
        font-weight: bold;
        font-size: 18px;
        letter-spacing: 1px;

    }

    .os-item {
        margin-bottom: 10px;
    }

    .os-item-title {
        text-align: right;
    }

    img.makeitcounticon {
        width: 36px;
        position: relative;
        top: -10px;
    }

    .makeittext {
        display: flex;
        float: right;
    }

    .all-caps {
        text-transform: uppercase;
    }

    .ube-card-body {
        border: 1px solid #ddd;
        padding: 1.4rem;
        min-height: 150px;
    }

    #emptyCart {
        padding: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    #emptyCart i {
        font-size: 70px;
    }

    .apply-btn {
        background-color: #ffbd00;
        color: #530033;
        text-transform: uppercase;
        font-weight: bold;
        padding: 10px 40px;
    }

    @media (max-width: 767px) {
        .cart-product-name {
            padding: 11px 0px 0px 0px !important;
            width: 100%;
        }
        .cart-product-option {
    text-align: center;
    width: 100%;
    padding: 5px 0px 0px 0px!important;
}
.cart-product-count {
    width: 100%;
    min-width: 89px;
    padding: 10px 0px 0px 0px!important;
}
.cart-product-price {
    width: 100%;
    text-align: center;
    font-weight: bold;
    font-size: 19px;
    padding: 17px 0px 0px 0px!important;
}


    }
</style>

@php
$price=0;
$items =0;
foreach($response as $res){
$price += $res->cost * $res->quantity;
$items += $res->quantity;

$user = Auth::user();
}
@endphp

@php
$quantities = 0;
$products = 0;
// $quantity = 0;
// $quantity = null;
@endphp
@foreach($response as $res)
@php
// $quantity += $res->quantity;
if ($products == 0 && $quantities == 0){
$products = $res->product;
$quantities = $res->quantity;
}else{
$products = $products.",".$res->product;
$quantities = $quantities.",".$res->quantity;
}
@endphp
@endforeach

@php
$delivery_fee=$settings[0]->delivery_fee;
@endphp

@php
$delivery_fee=$settings[0]->delivery_fee;
$donation_amount=$settings[0]->donation_amount;
@endphp

@php
$discount = 0;
if(Session::has('coupon')){
$discount = App\Coupon::calculateDiscount(Session::get('coupon'), $price);
}
@endphp

@php
$grandTotal = number_format((float)($price+$delivery_fee) * 13/100 +
$price - $discount + $delivery_fee + $donation_amount, 2, '.', '');
@endphp
<div class="home-wrapper">
    @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- Starting of add to cart table -->
    <div class="section-padding product-shoppingCart-wrapper wow fadeInUp">
        <div class="container">
            @if($response->count())
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="heading-title">
                        <h3>Your Shopping Cart</h3>
                    </div>
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('message') }}
                    </div>
                    @endif

                    @foreach($response as $res)
                    @php
                    $product = \App\Product::where('id', $res->product)->first();
                    @endphp
                    <div class="cart-product-list-wrap">
                        <ul class="cart-product-list">
                            <li class="cart-item">
                                <div class="cart-product-img hidden-xs">
                                    @if($product['feature_image'])
                                    <img src="{{ url('/assets/images/products')}}/{{ $product['feature_image'] }}"
                                        class="img-responsive" />
                                    @else
                                    <img src="https://via.placeholder.com/100" class="img-responsive" />
                                    @endif

                                </div>
                                <div class="cart-product-name hidden-xs">
                                    <a
                                        href="{{ url('product/') . '/' . $res->product . '/' . str_replace(' ', '-', $res->title) }}">{{ $res->title }}</a>
                                </div>
                                <div class="cart-product-count hidden-xs">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <form action="{{ url('/') . '/cart/product/qtydown/' . $res->product}}"
                                                method="GET">
                                                {{csrf_field()}}
                                                <button class="btn btn-default btn-number" type="submit">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </form>
                                        </span>
                                        <input type="text" name="quant[1]" class="form-control input-number"
                                            value="{{ $res->quantity }}" min="1" max="10">
                                        <span class="input-group-btn">
                                            <form action="{{ url('/') . '/cart/product/qtyup/' . $res->product}}"
                                                method="GET">
                                                {{csrf_field()}}
                                                <button class="btn btn-default btn-number" type="submit">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </form>
                                        </span>
                                    </div>
                                </div>
                                <div class="cart-product-price hidden-xs">
                                    ${{ number_format((float)$res->cost, 2, '.', '') }}
                                    <!-- ${{ number_format((float)$res->cost * $res->quantity, 2, '.', '') }} -->
                                </div>

                                <div class="cart-product-option hidden-xs">
                                    <form action="{{ url('/') . '/cartdelete/product/' . $res->product}}" method="GET">
                                        {{csrf_field()}}
                                        <button title="Remove This Item" type="submit"
                                            style="margin-top:-5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </form>
                                </div>

                                <!--mobile view-->
                                <div class="visible-xs">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="cart-product-img">
                                                @if($product['feature_image'])
                                                <img src="{{ url('/assets/images/products')}}/{{ $product['feature_image'] }}"
                                                    class="img-responsive" />
                                                @else
                                                <img src="https://via.placeholder.com/100" class="img-responsive" />
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-xs-8">
                                            <div class="row">
                                            <div class="col-xs-10">
                                                    <div class="cart-product-name">
                                                        <a
                                                            href="{{ url('product/') . '/' . $res->product . '/' . str_replace(' ', '-', $res->title) }}">{{ $res->title }}</a>
                                                    </div>
                                                </div>
                                            <div class="col-xs-2">
                                            <div class="cart-product-option">
                                                <form action="{{ url('/') . '/cartdelete/product/' . $res->product}}"
                                                    method="GET">
                                                    {{csrf_field()}}
                                                    <button title="Remove This Item" type="submit"
                                                        style="margin-top:-5px; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;">
                                                        <i class="fas fa-times-circle"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                            </div>
                                            <div class="row">
                                              
                                                <div class="col-xs-6">
                                                    <div class="cart-product-count">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <form
                                                                    action="{{ url('/') . '/cart/product/qtydown/' . $res->product}}"
                                                                    method="GET">
                                                                    {{csrf_field()}}
                                                                    <button class="btn btn-default btn-number"
                                                                        type="submit">
                                                                        <span class="glyphicon glyphicon-minus"></span>
                                                                    </button>
                                                                </form>
                                                            </span>
                                                            <input type="text" name="quant[1]"
                                                                class="form-control input-number"
                                                                value="{{ $res->quantity }}" min="1" max="10">
                                                            <span class="input-group-btn">
                                                                <form
                                                                    action="{{ url('/') . '/cart/product/qtyup/' . $res->product}}"
                                                                    method="GET">
                                                                    {{csrf_field()}}
                                                                    <button class="btn btn-default btn-number"
                                                                        type="submit">
                                                                        <span class="glyphicon glyphicon-plus"></span>
                                                                    </button>
                                                                </form>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="cart-product-price">
                                                        ${{ number_format((float)$res->cost, 2, '.', '') }}
                                                        <!-- ${{ number_format((float)$res->cost * $res->quantity, 2, '.', '') }} -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>








                            </li>
                        </ul>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="heading-title">
                        <h3>Order Summary </h3>
                    </div>
                    <div class="order-summery">
                        <div class="row os-item">
                            <div class="col-xs-8 os-item-title">
                                Subtotal :
                            </div>
                            <div class="col-xs-4">
                                ${{ number_format((float)$price, 2, '.', '') }}
                            </div>
                        </div>
                        @if(Session::has('coupon'))
                        <div class="row os-item">
                            <div class="col-xs-8 os-item-title">
                                Discount :
                            </div>
                            <div class="col-xs-4">
                                -$ {{ number_format((float)$discount, 2, '.', '') }}
                            </div>
                        </div>
                        @endif
                        <div class="row os-item">
                            <div class="col-xs-8 os-item-title">
                                Delivery :
                            </div>
                            <div class="col-xs-4">
                                ${{ number_format((float)$delivery_fee, 2, '.', '') }}
                            </div>
                        </div>
                        <div class="row os-item">
                            <div class="col-xs-8 os-item-title">
                                Tax (13%) :
                            </div>
                            <div class="col-xs-4">
                                ${{ number_format((float) ($price+$delivery_fee) * 13/100, 2, '.', '') }}
                            </div>
                        </div>
                        <div class="row os-item">
                            <div class="col-xs-8 os-item-title">
                                <img class="makeitcounticon" src="{{ url('/assets/img/3742-300x300.jpg') }}">
                                <div class="makeittext"  class="capital popovers" data-toggle="popover" title="" data-content="Help Us Make A Difference!
Your small micro donation will go towards providing free services and programs for Mental Health.  In addition, this Merchant will also generously match your donation. <br> <br> <a href='https://dryclean.io/makeitcount.php' title='test add link'>Click Here </a> to learn more about this program
and the Janeen Foundation" data-original-title="Make It Count" >Make it count <i class="helpicon far fa-question-circle"></i> : </div>
                            </div>
                            <div class="col-xs-4">
                                ${{ number_format((float)$donation_amount, 2, '.', '') }}
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-xs-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row os-item grand-total-line">
                            <div class="col-xs-8 os-item-title">
                                Grand Total : 
                            </div>
                            <div class="col-xs-4">
                                <b>${{ $grandTotal }}</b>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-xs-12">
                                @if(!Auth::guard('profile')->user())
                                <a href="{{ url('order-summary') }}"
                                    class="btn btn-block btn-checkout checkout">Checkout</a>
                                @else
                                <a href="{{ url('order-confirm') }}"
                                    class="btn btn-block btn-checkout checkout">Checkout</a>

                                @endif

                            </div>
                        </div>
                        <div class="col-xs-12">
                            <hr>
                        </div>
                        @if(!Session::has('coupon'))
                        <h5 class="card-title all-caps">Have a Coupon Code?</h5>
                        <form action="{{ route('coupon.apply') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" id="coupon_code" name="coupon_code"
                                    placeholder="Coupon Code" required>
                            </div>
                            <button type="submit" class="btn apply-btn">Apply</button>
                        </form>
                        @else
                        <h5 class="card-title">Coupon Applied</h5>
                        <form class="form-inline" action="{{ route('coupon.remove') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <div class="form-group">
                                <input type="text" class="form-control" id="coupon_code" name="coupon_code"
                                    placeholder="Coupon Code" value="{{ Session::get('coupon')['code'] }}" readonly>
                            </div>
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="heading-title">
                <h3 class="text-center">Your Shopping Cart</h3>
            </div>

            <div class="col-md-6 col-md-offset-3">
                <hr>
                <div class="ube-card-body">
                    <div class="text-center" id="emptyCart">
                        Hey! Looks like your cart is empty, Please add some products! <br>
                        <a href="{{ url('/category/dry-clean-laundry') }}"><i class="fas fa-cart-arrow-down"></i></a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
    <!-- Ending of add to cart table -->
</div>

@stop

@section('footer')
<script>

</script>
@stop