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
        background-color: #f9f9f9;
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
    max-height: 150px;
    overflow-y: scroll;
    }
    #search-row{
        margin-left:0px !important;
    }
</style>
<nav class="page-sidebar" data-pages="sidebar">
<meta id="p" name="csrf_token" content="{{ csrf_token() }}" />
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- <div class="sidebar-overlay-slide from-top" id="appMenu">
          <div class="row">
            <div class="col-xs-6 no-padding">
              <a href="#" class="p-l-40"><img src="assets/img/demo/social_app.svg" alt="socail">
              </a>
            </div>
            <div class="col-xs-6 no-padding">
              <a href="#" class="p-l-10"><img src="assets/img/demo/email_app.svg" alt="socail">
              </a>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 m-t-20 no-padding">
              <a href="#" class="p-l-40"><img src="assets/img/demo/calendar_app.svg" alt="socail">
              </a>
            </div>
            <div class="col-xs-6 m-t-20 no-padding">
              <a href="#" class="p-l-10"><img src="assets/img/demo/add_more.svg" alt="socail">
              </a>
            </div>
          </div>
        </div> -->
    <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <!-- <img src="assets/img/logo_white.png" alt="logo" class="brand" data-src="assets/img/logo_white.png"
            data-src-retina="assets/img/logo_white_2x.png" width="78" height="22"> -->
        <div class="my-dashboard" style="padding:0px;" id="inter-dashboard">My Dashboard</div>
        <div class="sidebar-header-controls">
            <!-- <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i
                class="fa fa-angle-down fs-16"></i>
            </button> -->
            <!-- <button type="button"
                        class="btn btn-link d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none"
                        data-toggle-pin="sidebar"><i class="fa fs-12"></i>
                    </button> -->
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">
            <li class="m-t-30" {!! (Request::is('user-dashboard.index') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user-dashboard.index")}}" class="detailed">
                    <span class="title">My Dashboard</span>
                    <!-- {{-- <span class="details">12 New Updates</span> --}} -->
                </a>
                <span class="icon-thumbnail"><i class="fa fa-tachometer" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('user-orders') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user.myorders")}}" class="detailed">
                    <span class="title">My Orders</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-first-order" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('user/account-details') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user.account-details")}}" class="detailed">
                    <span class="title">My Account</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('user-gift-cards') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user-gift-cards")}}" class="detailed">
                    <span class="title">Gift Cards</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-gift"></i></span>
            </li>
            <li {!! (Request::is('user/refer-friend') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user.refer-friend")}}" class="detailed">
                    <span class="title">Refer a Friend</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('user/product-favourite') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user.product-favourite")}}" class="detailed">
                    <span class="title">My Faves</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-gratipay" aria-hidden="true"></i></span>
            </li>
            <li>
                <a href="{{route("logout")}}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="detailed">
                    <span class="title">Logout</span>
                </a>
                <span class="icon-thumbnail"><i class="pg-power" aria-hidden="true"></i></span>
            </li>
            {{-- <li {!! (Request::is('user-billing-setting') ? 'class="active"' : '') !!}>
                        <a href="{{route("user-billing-setting")}}" class="detailed">
            <span class="title">Billing History</span>
            </a>
            <span class="icon-thumbnail"><i class="fa fa-money" aria-hidden="true"></i>
            </span>
            </li> --}}
            {{-- <li>
                        <a href="manage-envelopes.html" class="detailed">
                            <span class="">Manage Envelopes</span>
                        </a>
                        <span class="icon-thumbnail"><i class="fa fa-envelope"></i></span>
                    </li> --}}
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
        <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar">
        </a>
        <!-- END MOBILE SIDEBAR TOGGLE -->
        <div class="mobile-set">
            <div class="brand inline logo-with-dashboad  ">
                <!-- <img src="assets/img/logo.png" alt="logo" data-src="assets/img/logo.png"
                data-src-retina="assets/img/logo_2x.png" width="78" height="22"> -->
                <div class="brand-logo">
                    <a href="{{url('/')}}"><img src="http://www.ubeclean.com/assets/img/ube_logo_ig.png"
                            class="img-responsive" /></a>
                </div>
                <div class="my-dashboard">
                    <a href="{{route("user-dashboard.index")}}"><img class="dashboard"
                            src="{{ url('/assets/img/logo_mydashboard.png') }}"></a>
                </div>

            </div>
            <div class="brand inline searchbar-wrap  ">
                <div class="input-group">
                    <input type="text" id="search" class="searchbar form-control "
                            placeholder="Search for a product, invoice or item">
                   
                        {{-- <span class="input-group-btn">
                            <button type="search1" id="search1" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </span> --}}
                        
                </div>
                <div id="here" class="dropdown-content ScrollStyle" style="left:0;">
                    <div class="row" id="search-row">
                        <div style="text-align: left;" class="col-md-6" id="here1">
                            Orders
                        </div>
                        <div style="text-align: left;" class="col-md-6" id="here2">
                            Products
                        </div>
                    </div>
                </div>
                {{-- <div id="here">
                    <div class="row">
                        <div class="col-md-6" id="here1"></div>
                        <div class="col-md-6" id="here2"></div>
                    </div>
                </div> --}}
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
                        <img src="{{ URL::asset('/assets/img/default-user.jpg')}}" alt=""
                            data-src="{{ URL::asset('/assets/img/default-user.jpg')}}"
                            data-src-retina="{{ URL::asset('/assets/img/default-user.jpg')}}" width="32" height="32">
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <a href="{{route("user.account-details")}}" class="dropdown-item">
                        Account
                        Settings <i class="pg-settings_small"></i></a>
                    {{-- <a href="#" class="dropdown-item"><i class="pg-outdent"></i> Feedback</a> --}}
                    {{-- <a href="#" class="dropdown-item"><i class="pg-signals"></i> Help</a> --}}

                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="clearfix bg-master-lighter dropdown-item">
                        <span class="pull-left">Logout</span>
                        <span class="pull-right"><i class="pg-power"></i></span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <div class="pull-right d-lg-block d-none balance-summery">
                <span>Balance :</span>
                <span>{{$settings[0]->currency_sign}}
                    {{ number_format(Auth::guard('profile')->user()->balance, 2) }}</span>
            </div>


            <!-- END User Info-->
            <!-- <a href="#" class="header-icon pg pg-alt_menu btn-link m-l-10 sm-no-margin d-inline-block"
              data-toggle="quickview" data-toggle-element="#quickview"></a> -->
        </div>
    </div>

    <!-- <div class="searchbar-wrap ">
                      <div class="col-xs-12 visible-xs">
                      <input type="text" class="searchbar form-control" placeholder="Search for a product, invoice or item">

                      </div>
             </div> -->
    <!-- END HEADER -->