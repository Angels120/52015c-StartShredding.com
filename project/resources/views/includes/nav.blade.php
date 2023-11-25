<style>
    .tongle {
        font-family: 'Raleway', sans-serif;
        font-weight: 600;
    }
    .popover {
     font-size: 11px; 
}
.popover-title{
    font-size:12px;
}

    .tongle .price {
        font-weight: 800;
    }
.helpicon{
    font-size: 12px;
    top: 0px;
    margin-left:2px;
}
    .cart-subtotal .price {
        color: #666 !important;
    }

    .drop-submenu12 .wrap_dropdown h6,
    .drop-submenu12 .wrap_dropdown h6 a {
        font-family: 'Raleway', sans-serif;
    }

    .drop-submenu12 .wrap_dropdown ul.level1 li a {
        font-family: 'Raleway', sans-serif;
        font-weight: 500;
    }

    .homelogo {
        position: absolute;
        top: -12px;
        padding: 0px;
        left: 0px;
        margin: 0px;
        height: 81px;
        width: auto;
    }

    .navbar-inverse {
        top: 15px !important;
    }

    .table>thead>tr>th,
    #wp-calendar>thead>tr>th,
    table>thead>tr>th,
    .table>tbody>tr>th,
    #wp-calendar>tbody>tr>th,
    table>tbody>tr>th,
    .table>tfoot>tr>th,
    #wp-calendar>tfoot>tr>th,
    table>tfoot>tr>th,
    .table>thead>tr>td,
    #wp-calendar>thead>tr>td,
    table>thead>tr>td,
    .table>tbody>tr>td,
    #wp-calendar>tbody>tr>td,
    table>tbody>tr>td,
    .table>tfoot>tr>td,
    #wp-calendar>tfoot>tr>td,
    table>tfoot>tr>td {
        border-top: 0;
    }

    .mainnav {
        z-index: 9999;
    }

    .field-icon {
        float: right;
        position: relative;
        z-index: 2;
        top: -24px;
        left: -7px;
    }

    .carousel-indicators {
        z-index: 0;
    }

    .mainnav>li {
        display: inline-block !important;
        vertical-align: middle !important;
    }

    .mainnav>li:last-child {
        right: 0;
        position: absolute;
    }

    .mobileshow {
        font-size: 20px;
    }

    .navbar-toggle {
        float: left;
    }

    .mobile-menu {
        display: none;
    }

    #mobile.top-icons {
        position: absolute;
        top: 20;
        margin-top: 12px;
        margin-right: 5px;
        right: 0;
        color: #fff;
    }

    #mobile.top-icons .tongle {
        line-height: 20px;
    }

    #mobile.top-icons i {
        float: right;
        color: #fff;
        margin-left: 10px;
        font-size: 20px;
    }

    .tongle i {
        top: 0;
    }

    .cart-subtotal .label {
        font-size: 13px;
        font-family: 'Raleway', sans-serif;
        font-weight: 700;
        text-transform: uppercase;
    }
    input.form-control.input-number {
    z-index: 0;
}

    #cartProductTable th {
        font-size: 13px;
        font-family: 'Raleway', sans-serif;
        font-weight: 800;
        color: rgba(0, 0, 0, 0.53) !important;
        text-transform: uppercase;
    }
    
    #cartProductTable  tbody >  tr:last-child { background:#ffffff; }
   
    #cartProductTable td,
    #cartProductTable td a {
        font-size: 11px!important;
        color: #3f3f3f;
        font-family: 'Raleway', sans-serif;
        font-weight: 600;
        text-transform: uppercase;
    }

    #cartProductTable td:first-child a {
        font-weight: 500;
    }

    #footer-cart {
        display: none;
    }

    .login-a a {
        color: #fff;
        font-family: Poppins;
        font-weight: 600;
        text-transform: uppercase;
        transition: all .2s ease-out 0s;
    }

    .login-a i {
        font-size: 12px;
        top: 0;
        color: #fff;
        margin-right: 3px;
    }

    .login-a span {
        color: #fff;
    }

    .login-a a:hover {
        color: #e34444 !important;
    }

    .content-center {
        margin-top: 35px;
    }

    .capital {
        text-transform: uppercase;
    }
    /* 
    responsive 4K
     */

    @media screen and (min-width: 2400px){
        .mobileshow {
            display: none;
        }
        #sns_custommenu ul.mainnav {
            margin-left: 28rem;
        }
        .mycart{
            margin-right: 42rem;
        }
        .homelogo {
            left: 42rem;
        }
    }
    @media screen and (max-width: 906px) {
        .mobileshow {
            display: none;
        }

        .top-cart {
            display: none;
        }

        .navbar-inverse {
            top: 2px !important;
        }

    }
    @media screen and (min-width: 768px) and (max-width: 990px){
        img.homelogo {
            display: none;
        }
        #logo-uBe img {
        position: absolute;
        width: 12%;
        left: 42%;
        top: 3px;
        z-index: 999;
        }
        .navbar-toggle {
        display: block;
        }

        .navbar-header {
        float: none;
        }

        .mobile-menu {
        display: block;
        }

        /* .navbar-collapse.collapse.in {
       display: none !important;
        } */
        .navbar-collapse {
        overflow-x: visible;
        padding-right: 15px;
        padding-left: 15px;
        border-top: 1px solid transparent;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
        -webkit-overflow-scrolling: touch;
        }

        .navbar-collapse.collapse {
            display: none !important;
            height: auto !important;
            padding-bottom: 0;
            overflow: visible !important;
        }

        .navbar-collapse:before,.navbar-collapse:after {
            content: " ";
            display: table;
        }

        .navbar-collapse:after {
            clear: both!important;
        }

        .navbar-collapse.in {
        
            display: block !important;
        }
        .navbar-fixed-top .navbar-collapse, .navbar-fixed-bottom .navbar-collapse {
            max-height: 700px!important;
        }
        div#tablet-nav-responsive {
            width: 100%;
            float: none;
            padding-left: 40px;
            padding-right: 40px;
        }
      
    }

/*
     @media screen and (min-width: 768px) and (max-width: 991px) {
        
        .navbar-inverse {
            border-color: #090909;
            background-image: url('{{ url('assets/img/51096b - menu_bkg.png') }}');
            background-size: inherit;
            background-repeat: repeat;
        }
        .navbar-inverse {
            top: 2px !important;
        }
        .top-cart {
            display: block;
        }

        #logo-uBe img {
        width: 100px;
        }
        
          #mobileNav {
            display: none;
        } */
        /* 

        Can be changed ???? 
        
        

        span.login-a.dropbtn {
            display: none;
        } 
        .mobileshow {
            display: none;
        } 

    } */
    @media screen and (max-width: 767px){
        #logo-uBe img {
        position: absolute;
        width: 15%;
        left: 42%;
        top: 3px;
        z-index: 999;
        }
        .mobile-menu{
            display: block;
        }
        img.homelogo {
            display: none;
        }
    }

    @media screen and (max-width: 480px) {


        .navbar-fixed-top .navbar-collapse,
        .navbar-fixed-bottom .navbar-collapse {
            max-height: 500px;
        }

        .navbar-inverse .navbar-toggle {
            border: 0;
        }
        #logo-uBe img{
            position: fixed;
        }

        .navbar-toggle .icon-bar {}

        .content-center {
            margin-top: 55px;
        }

        .navbar-brand {
            position: absolute;
            left: 36%;
        }

        .navbar-brand img {
            width: 75px;
        }
        
    }

    nav .simple-list {
        position: relative;
    }

    .header-style4 #sns_header #sns_menu .sns_mainmenu {
        background-color: transparent !important;
    }

    #mobileNav i {
        position: absolute;
        right: 5px;
        top: 2px;
        line-height: 40px;
        width: 40px;
        text-align: center;
        cursor: pointer;
        margin: 0;
        font-size: 12px;
    }

    #mobileNav a {
        font-size: 13px;
        color: #fff;
        line-height: 14px;
        padding: 15px 45px 15px 0px;
        display: block;
        text-transform: uppercase;
        font-family: 'Raleway', sans-serif;
        font-weight: 700;
    }

    #mobileNav li {
        float: none;
        border-bottom: 1px #343434 solid;
        padding: 0;
        position: relative;
        list-style: none;
    }

    #mobileNav li.contact {
        border-bottom: 3px #555555 solid !important;
    }

    #mobileNav .simple-list {
        position: relative;
    }

    /*submenu full width*/
    #mobileNav .submenu {
        position: relative;
        top: auto;
        left: auto;
        padding: 0 !important;
        width: 100%;
        background: #fff;
        border: 1px #f2f2f2 solid;
        display: none;
    }

    #mobileNav .submenu .product-column-entry {
        float: none;
        padding: 0;
        border: none;
        border-right: 1px #f2f2f2 solid;
        max-width: 300px;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
    }

    #mobileNav .submenu-list-title {
        margin: 0;
        display: block;
        position: relative;
        font-size: 16px;
        line-height: 22px;
        color: #2e2e2e;
        font-weight: 700;
        text-transform: uppercase;
    }

    #mobileNav .submenu-list-title a {
        color: #2e2e2e;
        display: block;
        margin: 0;
        font-size: 12px;
        line-height: 14px;
        padding: 15px 45px 15px 20px;
    }

    .submenu-list-title .toggle-list-button {
        width: 43px;
        height: 43px;
        position: absolute;
        top: 0;
        right: 2px;
        cursor: pointer;
    }

    .submenu-list-title .toggle-list-button:before {
        width: 11px;
        height: 1px;
        background: #878787;
        position: absolute;
        left: 50%;
        top: 50%;
        margin-top: -1px;
        margin-left: -6px;
        content: "";
    }

    #mobileNav .submenu .product-column-entry {
        border: 0;
    }

    .submenu-list-title .toggle-list-button:after {
        width: 1px;
        height: 11px;
        background: #878787;
        position: absolute;
        left: 50%;
        top: 50%;
        margin-top: -6px;
        margin-left: -1px;
        content: "";
    }

    .description .toggle-list-container .full-width-columns a {
        color: #343434;
    }

    .toggle-list-container {
        display: none;
        padding-left: 20px;
    }

    .white-ribbon {
        height: 20px;
        width: 100%;
        background-color: white;
        position: fixed;
        top: 0px;
    }

    .submenu-list-title.opened .toggle-list-button:after {
        height: 0;
        margin-top: 0;
    }

    .list-type-1 {
        font-size: 13px;
        line-height: 15px;
        color: #2e2e2e;
        font-weight: 500;
        margin-bottom: 0;
    }

    .top-cart {
        z-index: 99;
    }

    .mycart .content .actions {
        margin-bottom: 10px;
        margin-top: 0px;
        border-top: 0;
        padding-bottom: 5px;
        border-bottom: 1px solid #a8a8a8;
    }

    .mycart .content {
        padding: 0px 20px;
    }

    #totalTable {
        width: 100%;
        float: right;
    }

    #totalTable .line {
        border-top: solid 1px #a8a8a8;
        font-size: 12px;
    }

    ul.mainnav li.level0>a>span.title {
        font-size: 13px;
        font-weight: 700;
        font-family: Poppins;
        position: relative;
        text-transform: uppercase;
        -webkit-transition: all .2s ease-out 0s;
        transition: all .2s ease-out 0s
    }

    /*.dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }*/

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        /*background-color: #f9f9f9;*/
        min-width: 160px;
        /*box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
        z-index: 1;
        border-bottom: 1px solid #eaeaea;
        background-color: #fff;



    }

    .dropdown-content a {
        color: black;
        padding: 0px 12px !important;
        text-decoration: none;
        display: block;
        font-family: 'Raleway', sans-serif;
        background: #fff;

    }

    .dropdown-content a:hover {
        color:
            red;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    img.makeitcounticon {
        width: 26px;
        position: relative;
        top: 0px;
    }

    .os-item {
        margin-bottom: 10px;
    }

    .ube-hr {
        margin: 1px 0px 5px;
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #e0bfec;
    }

    .table-striped>tbody>tr:nth-of-type(even) {
        background-color: #f9f2fa;
    }

    .table {
        border: none;
    }

    .table thead>tr>th {
        border-bottom: none;
    }

    .table thead>tr>th,
    .table tbody>tr>th,
    .table tfoot>tr>th,
    .table thead>tr>td,
    .table tbody>tr>td,
    .table tfoot>tr>td {
        border: none;
    }

    .navbar-inverse {
        border-color: #090909;
        background-image: url('{{ url('assets/img/51096b - menu_bkg.png') }}');
        background-size: contain;
        background-repeat: repeat-x;
    }



    /*.dropdown:hover .dropbtn {background-color: #3e8e41;}*/
</style>
@php
$price=0;
$items =0;
foreach($cart_result as $res){
$price += $res->cost * $res->quantity;
$items += $res->quantity;
}
$discount = 0;
if(Session::has('coupon')){
$discount = App\Coupon::calculateDiscount(Session::get('coupon'), $price);
}
$setting = DB::select('select * from settings where id=1');
$delivery_fee=$setting[0]->delivery_fee;
$donation_amount=$setting[0]->donation_amount;
@endphp
<div class="white-ribbon"></div>
<nav class="container-fluid navbar navbar-inverse navbar-fixed-top" style="margin-top:-2px;z-index:9999;">
    <div class="">

        <div class="navbar-header">
            <div class="row mobile-menu">
                <div class="col-md-2">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" onclick="$('#mobilemenu').css('display','block');">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="col-md-6 text-center">
                    <a href="#!" target="_self" class="navbar-brand mobileshow" href="#" id="logo-uBe"><img
                            src="{{ url('/assets/img/ube_logo_ig.png') }}"></a>
                </div>
                <div class="col-md-4">
                    <div id="mobile" class="top-icons">
                        </span>
                        <span class="tongle">
                            {{$items}} ITEMS &nbsp; | &nbsp; <span class="price">
                                @if($price !== 0)
                                ${{ number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}
                                @else
                                $0.00
                                @endif
                            </span>
                            <i class="fas fa-shopping-cart cart-icon" style="margin-top: 0px; padding-top: 0px;"></i>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="row">
                <div class="col-sm-2">
                <a href="{{ url('/') }}" target="_self"> <img class="homelogo"
                            src="{{ url('/assets/img/51096b - logo_menu.png') }}"></a>
                </div>
                <div class="col-sm-6 col-md-4" id="tablet-nav-responsive">
                    <div id="mobileNav" class="mobileshow">
                        <li class="simple-list">
                            <a href="{{ url('/') }}" target="_self"><span class="title">Home</span></a>
                        </li>
                        @foreach($menus as $menu)
                        @if($menu->name === "Dry Clean and Laundry")
                        <li class="full-width-columns">
                            <a href="{{url('/category')}}/{{$menu->slug}}">SHOP BY CATEGORY</a>
                            @if(\App\Category::where('mainid',$menu->id)->where('role','sub')->count() >0)
                            <i style="color: #fff;" class="fa fa-chevron-down"></i>
                            <div class="submenu">
                                @foreach(\App\Category::where('mainid',$menu->id)->where('role','sub')->get() as
                                $submenu)
                                {{-- @if(\App\Category::where('subid',$submenu->id)->where('role','child')->count()) --}}
                                <div class="product-column-entry">
                                    <div class="submenu-list-title"><a href="{{url('/category')}}/{{$submenu->slug}}"
                                            style="color:#2e2e2e; font-size:13px;">{{$submenu->name}}</a><span
                                            style="color:#2e2e2e;" class="toggle-list-button"></span></div>
                                    <div class="description toggle-list-container">
                                        <ul class="list-type-1">
                                            @foreach(\App\Category::where('subid',$submenu->id)->where('role','child')->get()
                                            as $childmenu)
                                            <li class="full-width-columns" style="border-bottom: 0;"><a
                                                    href="{{url('/category')}}/{{$childmenu->slug}}"
                                                    style="color:#666; font-size: 12px; font-weight: 600; text-transform: capitalize;">{{$childmenu->name}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                {{-- @endif --}}
                                @endforeach
                            </div>
                            @endif
                        </li>
                        <!-- <li class="simple-list">
                            <a href="{{ url('/deals') }}" target="_self"><span class="title">Deals</span></a>
                        </li> -->
                        <li class="simple-list">
                            <a href="{{ url('/buy-credits') }}" target="_self"><span class="title">Buy
                                    Credits</span></a>
                        </li>
                        <!-- <li class="simple-lists">
                            <a href="{{ url('/locations') }}" target="_self"><span class="title">Locations</span></a>
                        </li> -->
                        <li class="simple-lists contact">
                            <a href="{{ url('/rewards') }}" target="_self"><span class="title">Rewards</span></a>
                        </li>
                        {{-- <li class="simple-lists">
                            <a href="{{ url('/about') }}" target="_self"><span class="title">About Us</span></a>
                        </li>
                        <li class="simple-lists contact">
                            <a href="{{ url('/contact') }}" target="_self"><span class="title">Contact Us</span></a>
                        </li> --}}
                        <li class="simple-lists">
                            <a href="{{route('user-dashboard.index')}}">
                                <span class="title">Order History</span>
                            </a>
                        </li>
                        <li class="simple-lists">
                            <a href="{{route('user.account-details')}}" class="title">
                                <span class="title">My Account</span>
                            </a>
                        </li>
                        <li class="simple-lists">
                            <a href="{{route('user-dashboard.index')}}" class="title">
                                <span class="title">My orders</span>
                            </a>
                        </li>
                        <li class="simple-lists">
                            <a href="{{route("user.product-favourite")}}" class="detailed">
                                <span class="">My Faves</span>
                            </a>
                        </li>
                        <li class="simple-lists">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span
                                    class="">
                                    logout </span></a>
                        </li>
                        @endif
                        @endforeach
                    </div>

                    <div id="sns_mainnav" class="sns_mainmenu" style="width:100%!important;">
                        <div id="sns_custommenu" class="visible-md visible-lg">
                            <ul class="mainnav">
                                <!-- <li class="level0 nav-3 no-group drop-submenu12"><span class="fa fa-bars"
                                        style="color:gray;"></span></li> -->
                                <li class="level0 nav-3 no-group drop-submenu12">
                                    {{-- @if($productdata->vendorid)
                                    <a class="menu-title-lv0" id="homelink"
                                        href="{{url('/shop')}}/{{$productdata->vendorid}}/{{str_replace(' ','-',strtolower(\App\Vendors::findOrFail($productdata->vendorid)->shop_name))}}"
                                    target="_self"><span class="title">{{$language->home}}</span></a>
                                    @else --}}
                                    <a class="menu-title-lv0" id="homelink" href="{{ url('/') }}" target="_self"><span
                                            class="title">{{$language->home}}</span></a>
                                    {{-- @endif --}}
                                </li>
                                @foreach($menus as $menu)
                                @if($menu->name === "Dry Clean and Laundry")
                                <li class="level0 nav-1 no-group drop-submenu12">
                                    <!-- <a class="menu-title-lv0" href="{{url('/category')}}/{{$menu->slug}}"><span class="title">{{$menu->name}}</span></a> -->
                                    <a class="menu-title-lv0" href="{{url('/category')}}/{{$menu->slug}}"><span
                                            class="title">SHOP
                                            BY
                                            CATEGORY</span></a>
                                    @if(\App\Category::where('mainid',$menu->id)->where('role','sub')->count()
                                    >0)
                                    <div class="wrap_dropdown fullwidth">
                                        <div class="row">
                                            @foreach(\App\Category::where('mainid',$menu->id)->where('role','sub')->get()
                                            as $submenu)
                                            {{-- @if(\App\Category::where('subid',$submenu->id)->where('role','child')->count()) --}}
                                            <div class="col-sm-3 col-md-4">
                                                <h6 class="title menu1-2-5"><a
                                                        href="{{url('/category')}}/{{$submenu->slug}}">{{$submenu->name}}</a><span
                                                        class="toggle-list-button"></span></h6>
                                                <div class="wrap_submenu">
                                                    <ul class="level1">
                                                        @foreach(\App\Category::where('subid',$submenu->id)->where('role','child')->get()
                                                        as $childmenu)
                                                        <li class="level2 nav-1-3-16 first"><a class=" menu-title-lv2"
                                                                href="{{url('/category')}}/{{$childmenu->slug}}">{{$childmenu->name}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            {{-- @endif --}}
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </li>
                                @endif
                                @endforeach
                                  <!-- <div class="wrap_dropdown fullwidth">
                                        <div class="row">
                                            @foreach(\App\Category::where('mainid',$menu->id)->where('role','sub')->get()
                                            as $submenu)
                                            @if(\App\Category::where('subid',$submenu->id)->where('role','child')->count())
                                            <div class="col-sm-3">
                                                <h6 class="title menu1-2-5"><a
                                                        href="{{url('/category')}}/{{$submenu->slug}}">{{$submenu->name}}</a><span
                                                        class="toggle-list-button"></span></h6>
                                                <div class="wrap_submenu">
                                                    <ul class="level1">
                                                        @foreach(\App\Category::where('subid',$submenu->id)->where('role','child')->get()
                                                        as $childmenu)
                                                        <li class="level2 nav-1-3-16 first"><a class=" menu-title-lv2"
                                                                href="{{url('/category')}}/{{$childmenu->slug}}">{{$childmenu->name}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div> -->

                                <!-- <li class="level0 nav-3 no-group drop-submenu12">
                                    <a class="menu-title-lv0" href="{{ url('/deals') }}" target="_self"><span
                                            class="title">Deals</span></a>
                                  
                                </li> -->
                                <li class="level0 nav-3 no-group drop-submenu12">
                                    <a class="menu-title-lv0" href="{{ url('/buy-credits') }}" target="_self"><span
                                            class="title">Buy
                                            Credits</span></a>
                                </li>
                                <!-- <li class="level0 nav-3 no-group drop-submenu12">
                                    <a class="menu-title-lv0" href="{{ url('/locations') }}" target="_self"><span
                                            class="title">Locations</span></a>
                                </li> -->

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-6">
                    <div class="top-cart">
                        <div class="mycart mini-cart">
                            <div class="block-minicart">
                                {{--<span class="login-a">
                                @if(Auth::guard('profile')->guest())
                                    <span><a href="{{url('user/registration')}}"><i class="fa fa-user-plus"> </i><span
                                    class="">
                                    Sign Up </span></a> &nbsp; | &nbsp;</span>
                                <span><a href="{{url('signin/user')}}"><i class="fa fa-key"> </i><span class="">
                                            Login </span></a> &nbsp; | </span>
                                @else
                                <span><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="fa fa-power-off"> </i><span class="">
                                            logout </span></a> &nbsp; | &nbsp;</span>
                                <span>
                                    <a href="{{route('user-dashboard.index')}}"><i class="fa fa-user"></i>
                                        <span class="title">{{ Auth::guard('profile')->user()->first_name }}
                                        </span>
                                    </a>
                                    &nbsp; |

                                </span>

                                @endif
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                </span>--}}
                                <div class="dropdown" style="float:left;">
                                    {{--<button class="dropbtn">Left</button>--}}
                                    <span class="login-a dropbtn" style="margin-top:10px;padding:5px;margin-right:3px;">
                                        @if(Auth::guard('profile')->guest())
                                        <span><a href="{{url('user/registration')}}"><i class="fa fa-user-plus">
                                                </i><span class="">
                                                    Sign Up </span></a> &nbsp; | &nbsp;</span>
                                        <span><a href="{{url('signin/user')}}"><i class="fa fa-key"> </i><span class="">
                                                    Login </span></a> &nbsp; | </span>
                                        @else
                                        <span><a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                                    class="fa fa-power-off"> </i><span class="">
                                                    logout </span></a> &nbsp; | &nbsp;</span>
                                        <span>
                                            <a href="{{route('user-dashboard.index')}}"><i class="fa fa-user"></i>
                                                <span class="title">{{ Auth::guard('profile')->user()->first_name }} &nbsp; ${{ number_format((float)Auth::guard('profile')->user()->balance, 2, '.', '') }} 
                                                </span>
                                            </a>
                                            &nbsp; |

                                        </span>

                                        @endif
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </span>
                                    @if(!Auth::guard('profile')->guest())
                                    <div class="dropdown-content " style="left:0;">
                                        <a href="{{route("user.account-details")}}" class="detailed">
                                            <span class="title">My Account</span>
                                        </a>
                                        <a href="{{route('user-dashboard.index')}}">
                                            <span class="title">My orders</span>
                                        </a>
                                        <a href="{{route("user.product-favourite")}}" class="detailed">
                                            <span class="">My Faves</span>
                                        </a>
                                        {{-- <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><span class="">
                                            logout </span></a>--}}
                                    </div>
                                    @endif
                                </div>

                                <span class="cart-content">

                                    <span class="tongle" style="margin-top:10px;padding:5px;margin-right:3px;">
                                        {{$items}} ITEMS &nbsp; | &nbsp; <span class="price">
                                            @if($price !== 0)
                                            ${{ number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}
                                            @else
                                            $0.00
                                            @endif
                                        </span>
                                        <i class="fas fa-shopping-cart cart-icon"
                                            style="margin-top: 0px; padding-top: 0px;"></i>
                                    </span>


                                    <div class="block-content content">
                                        <div class="block-inner">
                                            <div class="row actions">
                                                <div class="col-md-6">
                                                    @if(!Auth::guard('profile')->user())
                                                    <a class="button gfont go-to-cart btn-block"
                                                        href="{{url('/order-summary')}}" style="width: 100%;">Check
                                                        out</a>
                                                    @else
                                                    <a class="button gfont go-to-cart btn-block"
                                                        href="{{url('/order-confirm')}}" style="width: 100%;">Check
                                                        out</a>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    {{-- <a class="button gfont go-to-cart btn-block" href="{{url('/cart')}}"
                                                    style="width: 100%;">Go
                                                    to
                                                    cart</a> --}}
                                                    @if(!Auth::guard('profile')->user())
                                                    <a class="button gfont go-to-cart btn-block" href="{{url('/cart')}}"
                                                        style="width: 100%;">Go
                                                        to
                                                        cart</a>
                                                    @else
                                                    <a class="button gfont go-to-cart btn-block" href="{{url('/cart')}}"
                                                        style="width: 100%;">Go
                                                        to
                                                        cart</a>
                                                    @endif
                                                </div>
                                            </div>
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
                                                            <a
                                                                href="{{ route('product.details', ['id' => $res->product, 'title' => str_slug(str_replace(' ', '-', $res->title))]) }}">{{ $res->title }}</a>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $res->quantity }}
                                                        </td>
                                                        <td class="text-left">
                                                            ${{ number_format((float)$res->cost, 2, '.', '') }}
                                                        </td>
                                                        <td class="text-center">
                                                            ${{ number_format((float)$res->cost * $res->quantity, 2, '.', '') }}
                                                        </td>
                                                        <td class="text-center">
                                                            <form
                                                                action="{{ url('/') . '/cartdelete/product/' . $res->product}}"
                                                                method="GET">
                                                                {{csrf_field()}}

                                                                <button class="btn-remove" title="Remove This Item"
                                                                    type="submit" style="margin-top:-5px;">Remove
                                                                    This
                                                                    Item</button>

                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tbody id="cartSummary" class="{{ $cart_result->count() == 0 ? 'hidden' : '' }}">
                                                    <tr>
                                                        <td colspan="5">
                                                            <table id="totalTable">
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
                                                                        <span  style='float:right'
                                                                        class="capital popovers" data-toggle="popover" title="" data-content="Help Us Make A Difference!
Your small micro donation will go towards providing free services and programs for Mental Health.  In addition, this Merchant will also generously match your donation. <br> <br> <a href='https://dryclean.io/makeitcount.php' title='test add link'>Click Here </a> to learn more about this program
and the Janeen Foundation" data-original-title="Make It Count"><img
                                                                                class='makeitcounticon'
                                                                                src='{{ url('assets/img/3742-300x300.jpg') }}'>Make
                                                                            it count <i class="helpicon far fa-question-circle"></i>:</span>
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
                                                                    <td class="line text-right" id="cartSummaryGrandTotal">
                                                                        <b>${{ number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}</b>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>


                                            {{-- <div class="actions"> --}}
                                            {{-- </a> --}}
                                            {{-- @if(!Auth::check())
                                            <a class="button gfont go-to-cart" href="{{url('/order-summary')}}">Check
                                            out</a>
                                            @else
                                            <a class="button gfont go-to-cart" href="{{url('/order-confirm')}}">Check
                                                out</a>
                                            @endif --}}
                                            {{-- <a class="button gfont go-to-cart" href="{{url('/cart')}}">Go to
                                            cart</a> --}}
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

</nav>
<script>
    var delivery_fee = {{ $delivery_fee }}
</script>
<script>
    var delivery_fee = {{ $delivery_fee }};
    var donation_amount = {{ $donation_amount=$setting[0]->donation_amount }};
    var discount_type = "{{ Session::has('coupon') ? Session::get('coupon')->type : null }}";
    var discount_value = {{ Session::has('coupon') ? Session::get('coupon')->value : 0 }};
    

</script>