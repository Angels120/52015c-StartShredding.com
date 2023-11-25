@extends('includes.newmaster')
@section('content')
    <div class="home-wrapper">
        <!-- Starting of product shipping form -->
        <div class="section-padding product-shipping-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="product-shipping-full-div">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="signIn-title">{{$language->order_details}}</h2>
                                    <hr/>
                                    <div class="pricing-list">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>{{$language->product_name}}</th>
                                                <th width="20%">{{$language->quantity}}</th>
                                                <th width="20%">{{$language->subtotal}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cartdata as $cart)
                                                <tr>
                                                    <td><a href="{{url('/product')}}/{{$cart->product}}/{{str_replace(' ','-',strtolower(\App\Product::findOrFail($cart->product)->title))}}" target="_blank">{{$cart->title}}</a></td>
                                                    <td>{{$cart->quantity}}</td>
                                                    <td>{{$settings[0]->currency_sign}}{{$cart->cost}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <table class="table">
                                            <tr id="shipshow">
                                                <td><strong>{{$language->shipping_cost}}:</strong></td>
                                                <td width="20%"><strong>{{$settings[0]->currency_sign}}<span id="ship-cost">{{round($settings[0]->shipping_cost,2)}}</span></strong></td>
                                            </tr>
                                            <tr>
                                                <td><h3>{{$language->total}}:</h3></td>
                                                <td width="20%"><h3>{{$settings[0]->currency_sign}}<span id="total-cost">{{round($total,2)}}</span></h3></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <form  action="" method="post" id="payment_form">
                                    {{csrf_field()}}
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="billing-details-area">
                                            <h2 class="signIn-title">billing deatils</h2>
                                            <hr/>
                                            <div class="form-group">
                                                <select class="form-control" onChange="sHipping(this)" id="shipop" name="shipping" required>
                                                    <option value="shipto" selected>Ship To Address</option>
                                                    <option value="pickup">Pick Up</option>
                                                </select>
                                            </div>

                                        <div id="pick" style="display:none;">
                                            <div class="form-group">
                                                <select class="form-control" name="pickup_location">
                                                    <option value="">Select a PickUp Location</option>
                                                    @foreach($pickups as $pickup)
                                                        <option value="{{$pickup->address}}">{{$pickup->address}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if(Auth::guard('profile')->guest())
                                            <div class="form-group">
                                                <label for="shippingFull_name">full name <span>*</span></label>
                                                <input type="text" class="form-control" name="name" value="" placeholder="Full Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">Phone Number <span>*</span></label>
                                                <input type="text" class="form-control" name="phone" value="" placeholder="Phone Number" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">Email <span>*</span></label>
                                                <input type="email" class="form-control" name="email" value="" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">Address <span>*</span></label>
                                                <input type="text" class="form-control" name="address" value="" placeholder="Address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">City <span>*</span></label>
                                                <input type="text" class="form-control" name="city" value="" placeholder="City" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">Postal Code <span>*</span></label>
                                                <input type="text" class="form-control" name="zip" value="" placeholder="Postal Code" required>
                                            </div>
                                            <input type="hidden" name="customer" value="0" />
                                        @else
                                            <div class="form-group">
                                                <label for="shippingFull_name">full name <span>*</span></label>
                                                <input type="text" class="form-control" name="name" value="{{Auth::guard('profile')->user()->name}}" placeholder="Full Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">phone <span>*</span></label>
                                                <input type="text" class="form-control" name="phone" value="{{Auth::guard('profile')->user()->phone}}" placeholder="Phone Number" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">emai <span>*</span></label>
                                                <input type="email" class="form-control" name="email" value="{{Auth::guard('profile')->user()->email}}" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">address <span>*</span></label>
                                                <input type="text" class="form-control" name="address" value="{{Auth::guard('profile')->user()->address}}" placeholder="Address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">city <span>*</span></label>
                                                <input type="text" class="form-control" name="city" value="{{Auth::guard('profile')->user()->city}}" placeholder="City" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">postal code <span>*</span></label>
                                                <input type="text" class="form-control" name="zip" value="{{Auth::guard('profile')->user()->zip}}" placeholder="Postal Code" required>
                                            </div>
                                            <input type="hidden" name="customer" value="{{Auth::guard('profile')->user()->id}}" />
                                        @endif
                                            <div class="form-group">
                                                <label>select Payment Method <span>*</span></label>
                                                <select name="method" onChange="meThods(this)" class="form-control" required>
                                                    <option value="" selected>Select Payment Method</option>
                                                    @if($settings[0]->paypal_status == 1)
                                                        <option value="Paypal">Paypal</option>
                                                    @endif
                                                    @if($settings[0]->stripe_status == 1)
                                                        <option value="Stripe">Credit Card</option>
                                                    @endif
                                                    @if($settings[0]->mobile_status == 1)
                                                        <option value="Mobile">Mobile Money</option>
                                                    @endif
                                                    @if($settings[0]->bank_status == 1)
                                                        <option value="Bank">Bank Wire</option>
                                                    @endif
                                                    @if($settings[0]->cash_status == 1)
                                                        <option value="Cash">Cash On Delivery</option>
                                                    @endif
                                                </select>
                                            </div>
                                        <div id="mobile" style="display: none;">
                                            <div class="form-group">
                                                <strong>{{$settings[0]->mobile_money}}</strong>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">Transaction ID# <span>*</span></label>
                                                <input type="text" class="form-control" name="txn_id" placeholder="Transaction ID#">
                                            </div>
                                        </div>
                                        <div id="bank" style="display: none;">
                                            <div class="form-group">
                                                <strong>Bank {{$settings[0]->bank_wire}}</strong>
                                            </div>
                                            <div class="form-group">
                                                <label for="shippingFull_name">Transaction ID# <span>*</span></label>
                                                <input type="text" class="form-control" name="txn_id" placeholder="Transaction ID#">
                                            </div>
                                        </div>
                                        <div id="stripes" style="display: none;">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="card" placeholder="Card">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="cvv" placeholder="Cvv">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="month" placeholder="Month">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="year" placeholder="Year">
                                            </div>
                                        </div>

                                        <input type="hidden" name="total" id="grandtotal" value="{{round($total,2)}}" />
                                        <input type="hidden" name="products" value="{{$product}}" />
                                        <input type="hidden" name="quantities" value="{{$quantity}}" />
                                        <input type="hidden" name="sizes" value="{{$sizes}}" />

                                        <div id="paypals">
                                            <input type="hidden" name="cmd" value="_xclick" />
                                            <input type="hidden" name="no_note" value="1" />
                                            <input type="hidden" name="lc" value="UK" />
                                            <input type="hidden" name="currency_code" value="{{$settings[0]->currency_code}}" />
                                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="shipping-title">
                                        <label id="ship-diff">
                                            <input class="shippingCheck" type="checkbox" value="check"> {{$language->ship_to_another}}
                                        </label>
                                        <label id="pick-info" style="display: none">
                                            {{$language->pickup_details}}
                                        </label>
                                    </div>
                                    <hr/>
                                    <div class="shipping-details-area">
                                        <div class="form-group">
                                            <label for="shippingFull_name">full name <span>*</span></label>
                                            <input class="form-control" type="text" name="shipping_name" id="shippingFull_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="shipingPhone_number">Phone Number <span>*</span></label>
                                            <input class="form-control" type="number" name="shipping_email" id="shipingPhone_number">
                                        </div>
                                        <div class="form-group">
                                            <label for="ship_email">Email Address <span>*</span></label>
                                            <input class="form-control" type="email" name="shipping_phone" id="ship_email">
                                        </div>
                                        <div class="form-group">
                                            <label for="shipping_address">address <span>*</span></label>
                                            <textarea class="form-control" name="shipping_address" id="shipping_address" cols="30" rows="1" style="resize: vertical;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="shipping_city">city <span>*</span></label>
                                            <input class="form-control" type="text" name="shipping_city" id="shipping_city">
                                        </div>
                                        <div class="form-group">
                                            <label for="shippingPostal_code">postal code <span>*</span></label>
                                            <input class="form-control" type="text" name="shipping_zip" id="shippingPostal_code">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="order_notes">order notes <span>*</span></label>
                                        <textarea class="form-control order-notes" name="order_notes" id="order_notes" cols="30" rows="5" style="resize: vertical;"></textarea>
                                    </div>
                                </div>

                                <div class="row text-center">
                                    <div class="form-group">
                                        <input class="btn btn-md order-btn" type="submit" value="order now">
                                    </div>
                                    {{--<a href="" class="checkOut-btn">CheckOut as User</a>--}}
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of product shipping form -->

    </div>


@stop
@section('footer')
    <script type="text/javascript">
        function meThods(val) {
            var action1 = "{{route('payment.submit')}}";
            var action2 = "{{route('stripe.submit')}}";
            var action3 = "{{route('cash.submit')}}";
            var action4 = "{{route('mobile.submit')}}";
            var action5 = "{{route('bank.submit')}}";
            if (val.value == "Mobile") {
                $("#payment_form").attr("action", action4);
                $("#stripes").hide();
                $("#mobile").show();
                $("#bank").hide();
            }
            if (val.value == "Bank") {
                $("#payment_form").attr("action", action5);
                $("#stripes").hide();
                $("#mobile").hide();
                $("#bank").show();
            }
            if (val.value == "Paypal") {
                $("#payment_form").attr("action", action1);
                $("#stripes").hide();
                $("#mobile").hide();
                $("#bank").hide();
            }
            if (val.value == "Stripe") {
                $("#payment_form").attr("action", action2);
                $("#stripes").show();
                $("#mobile").hide();
                $("#bank").hide();
            }
            if (val.value == "Cash") {
                $("#payment_form").attr("action", action3);
                $("#stripes").hide();
                $("#mobile").hide();
                $("#bank").hide();
            }
        }

        function sHipping(val) {
            var shipcost = parseFloat($("#ship-cost").html());
            var totalcost = parseFloat($("#total-cost").html());
            var total = 0;

            if (val.value == "shipto") {
                total = shipcost + totalcost;
                $("#pick").hide();
                $("#ship-diff").show();
                $("#pick-info").hide();
                $("#shipshow").show();
                $("#total-cost").html(total);
                $("#grandtotal").val(total);
                $("#shipto").find("input").prop('required',true);
                $("#pick").find("select").prop('required',false);
            }

            if (val.value == "pickup") {
                total = totalcost - shipcost;
                $("#pick").show();
                $("#pick-info").show();
                $("#ship-diff").hide();
                $("#shipshow").hide();
                $("#total-cost").html(total);
                $("#grandtotal").val(total);
                $("#shipto").find("input").prop('required',false);
                $("#pick").find("select").prop('required',true);
            }
        }

    </script>
@stop