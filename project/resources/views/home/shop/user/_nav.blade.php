<!-- BEGIN SIDEBPANEL-->
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #0C1B7A;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        border-bottom: 1px solid #eaeaea;
        background-color: #fff;
        border: 1px solid #cccccc;
    }

    .dropdown-content a {
        color: black;
        padding: 0px 12px !important;
        text-decoration: none;
        display: block;
        font-family: 'Raleway', sans-serif;
        background: #fff;

    }
    .ScrollStyle{
        /*overflow-y: scroll;*/
        width: 70%;
    }
    #search-row{
        margin-left:0px !important;
    }
    .middle-menu a {
        color: #1d1c80;
        font-weight: bold;
        text-transform: uppercase;
        font-family: 'Montserrat';
        padding-right: 21px;
    }
    .middle-menu a:hover {
        color: #f6300e;
    }
    .header .brand {
        position: inherit;
    }

</style>
<nav class="page-sidebar" data-pages="sidebar">
    <meta id="p" name="csrf_token" content="{{ csrf_token() }}" />
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <div class="my-dashboard" style="padding:0px;" id="inter-dashboard">My Dashboard</div>
        <div class="sidebar-header-controls">
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">
            <li class="m-t-30" {!! (Request::is('/shop-user-dashboard') ? 'class="active"' : '' ) !!}>
                <a href="{{route("home.user-dashboard")}}" class="detailed">
                    <span class="title">My Dashboard</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-tachometer" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('user-orders') ? 'class="active"' : '' ) !!}>
                <a href="{{route("home.user-myorders")}}" class="detailed">
                    <span class="title">My Orders</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-first-order" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('user-orders') ? 'class="active"' : '' ) !!}>
                <a href="{{route("home.user-my-transactions")}}" class="detailed">
                    <span class="title">My Transactions</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-first-order" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('shop-account-details') ? 'class="active"' : '' ) !!}>
                <a href="{{route("home.account-details")}}" class="detailed">
                    <span class="title">My Account</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('shop-refer-friend') ? 'class="active"' : '' ) !!}>
                <a href="{{route("home.user-refer-friend")}}" class="detailed">
                    <span class="title">Refer a Friend</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
            </li>
            {{--            <li {!! (Request::is('shop-product-favourite') ? 'class="active"' : '' ) !!}>--}}
            {{--                <a href="{{route("shop.user-product-favourite")}}" class="detailed">--}}
            {{--                    <span class="title">My Faves</span>--}}
            {{--                </a>--}}
            {{--                <span class="icon-thumbnail"><i class="fa fa-gratipay" aria-hidden="true"></i></span>--}}
            {{--            </li>--}}
            <li>
                <a href="{{route("home.logout")}}" class="detailed">
                    <span class="title">Logout</span>
                </a>
                <span class="icon-thumbnail"><i class="pg-power" aria-hidden="true"></i></span>
            </li>
        </ul>

        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->
<!-- START PAGE-CONTAINER -->
<div class="page-container ">
    <!-- START HEADER -->
    <div class="header ">
        <!-- START MOBILE SIDEBAR TOGGLE -->
        <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar"></a>
        <!-- END MOBILE SIDEBAR TOGGLE -->
        <div class="mobile-set">
            <div class="brand inline logo-with-dashboad  ">
                <div class="brand-logo">
                    <a href="{{url('/')}}"><img src="/home_assets/images/logo.png" style="width:152px; height:30px;float: left;"  class="img-responsive" /></a>
                </div>
            </div>
            <div class="brand inline searchbar-wrap  ">
                <div class="input-group">
                    <input type="text" id="search" class="searchbar form-control " placeholder="Search for a product, invoice or item">
                </div>
                <div id="here" class="dropdown-content ScrollStyle" style="left: 21%;">
                    <div class="row" id="search-row">
                        <div style="text-align: left;" class="col-md-6" id="here1">
                            Orders
                        </div>
                        <div style="text-align: left;" class="col-md-6" id="here2">
                            Products
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <!-- START User Info-->
            <div class="pull-left p-r-10 fs-14 d-lg-block d-none logged-username">
                <span>{{ Auth::guard('profile')->user()->first_name }}</span>
                <span>{{ Auth::guard('profile')->user()->last_name }}</span>
            </div>
            <div class="dropdown pull-right d-lg-block d-none">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <span class="thumbnail-wrapper d32 circular inline">
                        <img src="{{ URL::asset('/assets/img/default-user.jpg')}}" alt="" data-src="{{ URL::asset('/assets/img/default-user.jpg')}}" data-src-retina="{{ URL::asset('/assets/img/default-user.jpg')}}" width="32" height="32">
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <a href="{{route("home.account-details")}}" class="dropdown-item">Account Settings <i class="pg-settings_small"></i></a>
                    <a href="{{route("home.logout")}}" class="dropdown-item">Logout <i class="pg-power"></i></a>
                </div>
            </div>
            <div class="pull-right d-lg-block d-none balance-summery">
                <span>Balance :</span>
                <span>{{$settings[0]->currency_sign}}{{ number_format(Auth::guard('profile')->user()->balance, 2) }}</span>
            </div>
        </div>
    </div>
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0; // remove the gap so it doesn't close
        }
    </style>
