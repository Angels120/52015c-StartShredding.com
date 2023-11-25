@extends('home.shop.includes.master',['cart_result'=> $response])
@section('header')
    @include('home.includes.header')
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('home_assets/css/cart.css')}}">
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
    <!-- BEGIN INTRO CONTENT -->
    <section class="p-b-65 p-t-100 m-t-50">
        <div class="container">
            <div class="row">
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
                                                            <img src="{{ url('/assets/images/products')}}/{{ $product['feature_image'] }}" class="img-responsive"/>
                                                        @else
                                                            <img src="https://via.placeholder.com/100" class="img-responsive"/>
                                                        @endif

                                                    </div>
                                                    <div class="cart-product-name hidden-xs">
                                                        {{ $product->title }}
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
                                                          <input type="text" name="quant[1]" class="form-control input-number" value="{{ $res->quantity }}" min="1" max="10">
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
                                                            <button title="Remove This Item" type="submit" style="margin: 5px 0 !important; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;"><i class="fa fa-times-circle"></i></button>
                                                        </form>
                                                    </div>

                                                    <!--mobile view-->
                                                    <div class="visible-xs">
                                                        <div class="row">
                                                            <div class="col-xs-4">
                                                                <div class="cart-product-img">
                                                                    @if($product['feature_image'])
                                                                        <img src="{{ url('/assets/images/products')}}/{{ $product['feature_image'] }}" class="img-responsive"/>
                                                                    @else
                                                                        <img src="https://via.placeholder.com/100" class="img-responsive"/>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <div class="col-xs-8">
                                                                <div class="row">
                                                                    <div class="col-xs-10">
                                                                        <div class="cart-product-name">
                                                                            <a href="{{ url('product/') . '/' . $res->product . '/' . str_replace(' ', '-', $res->title) }}">{{ $res->title }}</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-2">
                                                                        <div class="cart-product-option">
                                                                            <form action="{{ url('/') . '/cartdelete/product/' . $res->product}}"
                                                                                  method="GET">
                                                                                {{csrf_field()}}
                                                                                <button title="Remove This Item" type="submit" style="margin: 5px 0 !important;  background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;"><i class="fa fa-times-circle"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-xs-6">
                                                                        <div class="cart-product-count">
                                                                            <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <form action="{{ url('/') . '/cart/product/qtydown/' . $res->product}}" method="GET">
                                                                    {{csrf_field()}}
                                                                    <button class="btn btn-default btn-number"
                                                                            type="submit">
                                                                        <span class="glyphicon glyphicon-minus"></span>
                                                                    </button>
                                                                </form>
                                                            </span>
                                                                 <input type="text" name="quant[1]" class="form-control input-number" value="{{ $res->quantity }}" min="1" max="10">
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
                                        <div class="row os-item " style="">
                                            <div class="col-xs-8 os-item-title">
                                                Subtotal :
                                            </div>
                                            <div class="col-xs-4 price">
                                                ${{ number_format((float)$price, 2, '.', '') }}
                                            </div>
                                        </div>
                                        @if(Session::has('coupon'))
                                            <div class="row os-item">
                                                <div class="col-xs-8 os-item-title">
                                                    Discount :
                                                </div>
                                                <div class="col-xs-4 price">
                                                    -$ {{ number_format((float)$discount, 2, '.', '') }}
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row os-item">
                                            <div class="col-xs-8 os-item-title">
                                                Shipping :
                                            </div>
                                            <div class="col-xs-4 price">
                                                ${{ number_format((float)$delivery_fee, 2, '.', '') }}
                                            </div>
                                        </div>
                                        <div class="row os-item">
                                            <div class="col-xs-8 os-item-title">
                                                Tax (13%) :
                                            </div>
                                            <div class="col-xs-4 price">
                                                ${{ number_format((float) ($price+$delivery_fee) * 0.13, 2, '.', '') }}
                                            </div>
                                        </div>
                                        <div class="row os-item">
                                            <div class="col-xs-8 os-item-title">
                                                <div class="makeittext" data-toggle="popover"
                                                     title="" data-content="Help Us Make A Difference!
Your small micro donation will go towards providing free services and programs for Mental Health.  In addition, this Merchant will also generously match your donation. <br> <br> <a href='{{route('home.makeitcount')}}' target='_blank' title='test add link'>Click Here </a> to learn more about this program
and the Janeen Foundation" data-original-title="Make It Count">Make it count  <img class="makeitcounticon" src="{{ url('/assets/img/makeitcounticon.png') }}"> :
                                                </div>
                                            </div>
                                            <div class="col-xs-4 price">
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
                                                <?php
                                                $product_id=Session::get('product_id');
                                                ?>
                                                @if(!Auth::guard('profile')->user())
                                                    <a href="{{url('/customers/products/').'/'.$product_id}}" class="btn btn-block btn-checkout checkout">Checkout</a>
                                                @else
                                                    <a href="{{url('/customers/products/').'/'.$product_id}}" class="btn btn-block btn-checkout checkout">Checkout</a>
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
                                                    <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code" required>
                                                </div>
                                                <button type="submit" class="btn apply-btn">Apply</button>
                                            </form>
                                        @else
                                            <h5 class="card-title">Coupon Applied</h5>
                                            <form class="form-inline" action="{{ route('coupon.remove') }}"
                                                  method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code" value="{{ Session::get('coupon')['code'] }}" readonly>
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
                                    <div class="text-center" id="emptyCart">Hey! Looks like your cart is empty, Please add some products! <br>
                                        <a href="{{ route('home.order') }}"><i class="fa fa-cart-arrow-down"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                <!-- Ending of add to cart table -->
            </div>
        </div>
        </section>
@stop
@section('footer')
    @include('home.shop.includes.footer')
@stop