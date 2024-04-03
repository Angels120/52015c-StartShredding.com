<!-- BEGIN HEADER -->
<link rel="stylesheet" href="{{ URL::asset('home_assets/css/product.css')}}">
<link rel="stylesheet" href="{{ URL::asset('home_assets/css/comman.css')}}">
<link rel="stylesheet" href="{{ URL::asset('home_assets/css/logo.css')}}">
<link rel="stylesheet" href="{{ URL::asset('home_assets/css/header.css')}}">

<?php
   $price = 0;
   $items = 0;
   foreach ($cart_result as $res) {
       $price += $res->cost * $res->quantity;
       $items += $res->quantity;
   }
   $discount = 0;
   if (Session::has('coupon')) {
       $discount = App\Coupon::calculateDiscount(Session::get('coupon'), $price);
   }
   $setting = DB::select('select * from settings where id=1');
   $delivery_fee = $setting[0]->delivery_fee;
   $donation_amount = $setting[0]->donation_amount;
   ?>
<div class="white-ribbon"></div>
<nav class="container-fluid navbar navbar-inverse navbar-fixed-top" style="margin-top:-5px;z-index:9999;">
   <div class="">
      <div class="navbar-header">
         <div class="row mobile-menu">
            <div class="col-md-2">
               <button type="button" class="navbar-toggle" data-toggle="collapse"
                  data-target="#bs-example-navbar-collapse-1" onclick="myFunction()" >
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
            </div>
            <div class="col-md-6 text-center">
               <a href="#!" target="_self" class="navbar-brand" href="#" id="logo-uBe"><img
                  src="{{ url('/home_assets/images/logo.png') }}"></a>
            </div>
            <div class="col-md-4">
               <div id="mobile" class="top-icons">
                   <a href="{{ route('home.cart') }}"
                  <span class="tongle">
                  {{$items}} ITEMS &nbsp; | &nbsp; <span class="price">
                  @if($price !== 0)
                  ${{ number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}
                  @else
                  $0.00
                  @endif
                  </span>
                  <i class="fa fa-shopping-cart cart-icon" style="margin-top: 0px; padding-top: 0px;"></i>
                  </span>
                </a>
               </div>
            </div>
         </div>
      </div>
      <script>
function myFunction() {
  var x = document.getElementById("mobileNav");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-bottom: 20px;">
         <div class="row">
            <div class="col-sm-2">
               <a href="{{ url('/') }}" target="_self"> <img class="homelogo"
                  src="{{ url('/home_assets/images/logo.png') }}"></a>
            </div>
            <div class="col-sm-6 col-md-6" id="tablet-nav-responsive">
               <div id="mobileNav" class="mobileshow">
                  <li class="simple-lists">
                     <a href="{{url('/')}}" class="active">
                     <span class="title">Home</span>
                    </a>
                  </li>
                  <li class="simple-lists">
                     <a href="{{url('/customers')}}">Just Shred It</a>
                  </li>
                  <li class="simple-lists">
                     <a href="portfolio.html">Best Prices </a>
                  </li>
                  <li class="simple-lists">
                     <a href="contact.html">Drop Off</a>
                  </li>
                  <li class="simple-lists">
                     <a href="contact.html">About Us</a>
                  </li>
                  <li class="non-link">
                     <a>(416) 255 1500</a>
                  </li>
               </div>
                <div id="sns_mainnav" class="sns_mainmenu" style="width:100%!important;">
                    <div id="sns_custommenu" class="visible-md visible-lg">
                        <ul class="mainnav">
                            <li class="level0 nav-3 no-group drop-submenu12">
                            <a href="{{url('/')}}" class="active"> <span class="title">Home</span></a>
                            </li>
                            <li class="level0 nav-1 no-group drop-submenu12">
                            <a href="{{url('/customers')}}"> <span class="title">Just Shred It</span></a>
                            </li>
                            <li class="level0 nav-1 no-group drop-submenu12">
                            <a href="portfolio.html"> <span class="title">Best Prices</span></a>
                            </li>
                            <li class="level0 nav-1 no-group drop-submenu12">
                            <a href="contact.html"> <span class="title">Drop Off</span></a>
                            </li>
                            <li class="level0 nav-1 no-group drop-submenu12">
                            <a href="contact.html"> <span class="title">About Us</span></a>
                            </li>
                            <li class="level0 nav-1 no-group drop-submenu12">
                            <a> <span class="title">(416) 255 1500</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
               </div>
               <div class="col-sm-4 col-md-4">
               <div class="cont top-cart">
                    @if(Auth::guard('profile')->guest())
                        <span><a style="color: #000; font-weight: bold" href="{{route('home.register')}}">SIGN UP </a> | <a style="color: #000; font-weight: bold"
                                                                   href="{{route('home.user')}}">LOGIN</a> | </span>
                    @else
                        <a style="color: #000; font-weight: bold" href="{{ route('home.logout') }}"><span class="">LOGOUT</span></a>
                        |
                        <a style="color: #000; font-weight: bold;text-transform:uppercase;"
                           href="{{route('home.user-dashboard')}}">
                            <span class="title">My Account  ${{ number_format((float)Auth::guard('profile')->user()->balance, 2, '.', '') }}</span>
                        </a> |
                    @endif
                    <form id="logout-form" action="{{ route('home.logout') }}" method="POST"
                          style="display: none;">{{ csrf_field() }}</form>
                    @if(!Auth::guard('profile')->guest())
                    @endif
                    <div class="dropdown" style="display: inline-block !important;">
                                    <span class="dropdnItem">
                                        <a class="tongle" style="color: #000; font-weight: bold" href="{{ route('home.cart') }}">
                                            {{$items}} ITEMS |
                                            @if($price !== 0)
                                                ${{ number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}
                                            @else
                                                $0.00
                                            @endif
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </span>
                        <?php
                        $product_id = Session::get('product_id');
                        ?>
                        <div class="dropdown-content cart-content<?=(!Auth::guard('profile')->guest())?'-profile':''?>" style="float: right;">
                            @if($product_id)
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn btn-primary"
                                       href="{{url('/shop-order-summary')}}"
                                       style="width: 100%;">CHECK OUT</a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-primary" href="{{url('/shop-order-summary')}}"
                                       style="width: 100%;">GO TO CART</a>
                                </div>
                            </div>
                            <hr>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="cartProductTable" class="table table-striped"
                                           style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-left">Rate</th>
                                            <th class="text-center">Total</th>
                                            <th style="width:5%"></th>
                                        </tr>
                                        </thead>

                                        <tbody id="cartproductList">
                                        @if($cart_result->count() == 0)
                                            <tr>
                                                <td colspan="4">Please add some products first</td>
                                            </tr>
                                        @else
                                            @foreach($cart_result as $res)
                                                <tr>
                                                    <td>
                                                        {{ $res->title }}
                                                    </td>
                                                    <td class="text-center">{{ $res->quantity }}</td>
                                                    <td class="text-left">
                                                        ${{ number_format((float)$res->cost, 2, '.', '') }}</td>
                                                    <td class="text-center">
                                                        ${{ number_format((float)$res->cost * $res->quantity, 2, '.', '') }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ url('/cartdelete/product/') . '/' . $res->product}}"
                                                              method="GET">
                                                            {{csrf_field()}}
                                                            <button class="fa fa-remove"
                                                                    title="Remove This Item"
                                                                    type="submit"
                                                                    style="margin-top:-5px;"></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tbody id="cartSummary"
                                               class="{{ $cart_result->count() == 0 ? 'hidden' : '' }}">
                                        <tr>
                                            <td colspan="5">
                                                <table id="totalTable" style="width: 100%;">
                                                    <tr>
                                                        <td>
                                                            <span style='float:right'>Subtotal:</span>
                                                        </td>
                                                        <td class="text-right" id="cartSummarySubtotal">
                                                            ${{ number_format((float)$price, 2, '.', '') }}
                                                        </td>
                                                    </tr>
                                                    @if(Session::has('coupon'))
                                                        <tr>
                                                            <td>
                                                                <span style="float:right">Discount:</span>
                                                            </td>
                                                            <td class="text-right" id="cartSummaryDiscount">
                                                                -${{ number_format((float)$discount, 2, '.', '') }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td>
                                                            <span style='float:right'>Delivery:</span>
                                                        </td>
                                                        <td class="text-right" id="cartSummaryDelivery">
                                                            ${{ number_format((float) $delivery_fee, 2, '.', '') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span style='float:right'>Tax (13%):</span>
                                                        </td>
                                                        <td class="text-right" id="cartSummaryTax">
                                                            ${{ number_format((float) ($price+$delivery_fee) * 13/100, 2, '.', '') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <span style='float:right'
                                                                              class="makeittext"
                                                                              data-toggle="popover" title="" data-placement="top"
                                                                              data-content="Help Us Make A Difference!
                                                                            Your small micro donation will go towards providing free services and programs for Mental Health.
                                                                            In addition, this Merchant will also generously match your donation. <br> <br> <a href='{{route('home.makeitcount')}}' target='_blank' title='test add link'>Click Here </a> to learn more about this program
                                                                            and the Janeen Foundation"
                                                                              data-original-title="Make It Count">Make It Count <img
                                                                                    class='makeitcounticon'
                                                                                    src='{{ url('assets/img/makeitcounticon.png') }}'/></span>
                                                        </td>
                                                        <td class="text-right" id="cartSummaryMakeItCount">
                                                            ${{ number_format((float) $donation_amount, 2, '.', '') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="line">
                                                                        <span style='float:right'><b>Grand
                                                                                Total:</b></span>
                                                        </td>
                                                        <td class="line text-right"
                                                            id="cartSummaryGrandTotal">
                                                            <b>${{ number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}</b>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</nav>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
<script>
   function clickHere() {
       $.notify("I'm to the right of this box", "success", {
           position: "bottom right",
           elementPosition: 'bottom right',
           globalPosition: 'bottom right',
       });
   }
   
   var delivery_fee = "{{ $delivery_fee }}";
   var delivery_fee = "{{ $delivery_fee }}";
   var donation_amount = "{{ $donation_amount=$setting[0]->donation_amount }}";
   var discount_type = "{{ Session::has('coupon') ? Session::get('coupon')->type : null }}";
   var discount_value = "{{ Session::has('coupon') ? Session::get('coupon')->value : 0 }}";
</script>
<script type="application/javascript">
   incrementVar = 1;
   function incrementValue(id){
       var prevVal = $('.quantity_'+id).val();
       newValue = parseInt(prevVal)+1;
       $('.quantity_'+id).val(newValue);
       incrementVar += newValue;
   }
   function decrementValue(id){
       var prevVal = $('.quantity_'+id).val();
       newValue = parseInt(prevVal)-1;
       if(newValue <= 1){
           $('.quantity_'+id).val(1);
       }else{
           $('.quantity_'+id).val(newValue);
       }
       incrementVar += newValue;
   }
   
</script>