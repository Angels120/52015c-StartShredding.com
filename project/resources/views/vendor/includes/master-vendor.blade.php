<?php
$siteLogo = "http://www.mybackpocket.io/assets/images/logo/logo_backpocket_test_small.png";
$assetVersion = 1.4;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />

    <title>{{$settings[0]->title}} - Vendor Panel</title> 
    
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/owl.carousel.css')}}" rel="stylesheet">  
    <link href="{{ URL::asset('assets/css/bootstrap-slider.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/genius-slider.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/go-style.css')}}" rel="stylesheet">

    <link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet">
	<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/responsive.css')}}" rel="stylesheet"> 
    <link href="{{ URL::asset('assets/vendor/css/custom.css')}}" rel="stylesheet">
    
    <link href='https://fonts.googleapis.com/css?family=Poppins:300,700' rel='stylesheet' type='text/css'>
    
    <script>
		var baseUrl = '{!! url('/') !!}';
	    var mainurl = '{{url('/')}}';
	    var currency = '{{$settings[0]->currency_sign}}';
	   //  var language = {!! json_encode($language) !!}; 
	</script>
	<script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
	<style>
		.header-wrapper.style-10 .nav-overflow::before{
			background:#000;  
		}
		body, input, textarea, select {
			font-family: Poppins;
		}
        .dropdown-menu > li > a:hover {
            color: #000000 !important;
        }
	</style>	
	<script>
		var siteLogo = "<?=$siteLogo?>";
		var storeName = "<?=Auth::user()->shop_name;?>";
	</script>
</head>
<body>
	
<div id="cover"></div>
<div id="content-block">
   <div class="content-center fixed-header-margin" style="padding-top: 114px;">
      <!-- HEADER -->
      <div class="header-wrapper style-10">
         <header class="type-1">
            <div class="header-product">
               <div class="logo-wrapper">
                  <div class="row">
                  	<div class="col-md-6">
                  	<a href="{!! url('vendor/dashboard') !!}" id="logo">
	                  	<img alt="Backpocket" src="<?=$siteLogo?>">
	                  </a>
                  </div>
                  
                  <div class="col-md-6">
                  	<h3 style="padding:20px 0px 0;font-size: 18px;text-transform: uppercase	"><?php
	echo Auth::user()->shop_name; 
	?></h3>
                  </div> 
                  </div>
               </div>
               <div class="product-header-content">
                  <div class="line-entry">
                     <div class="menu-button responsive-menu-toggle-class"><i class="fa fa-reorder"></i></div>
                  </div>
                  <div class="line-entry">
                     <div class="header-top-entry increase-icon-responsive login">
                     	 <div class="dropdown">
             	 			<a href="javascript:void(0);" class="toggle-user" data-toggle="dropdown">
             	 				<i class="fa fa-bell"></i>
					  		</a>
						  	<ul class="dropdown-menu notify_menu">
							    <li>
									<div class="notify_box">
										<p>Lorem Ipsum</p>
										<span>Lorem Ipsum seller doller</span>
									</div>
								</li>
								<li>
									<div class="notify_box">
										<p>Lorem Ipsum</p>
										<span>Lorem Ipsum seller doller</span>
									</div>
								</li>
						  	</ul>
						</div> 
                     </div>
                     <div class="header-top-entry increase-icon-responsive login">
                     	 <div class="dropdown">
             	 			<a href="javascript:void(0);" class="toggle-user" data-toggle="dropdown">
             	 				<i class="fa fa-user"></i>
					  		</a>
						  	<ul class="dropdown-menu">
				                <li>
				                    <a href="{{ route('logout') }}"
				                       onclick="event.preventDefault();
				                                                     document.getElementById('logout-form').submit();">
				                        <i class="fa fa-fw fa-power-off"></i> Logout
				                    </a>
				
				                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				                        {{ csrf_field() }}
				                    </form>
				                </li>
                            <li>
                            <a href="{!! url('vendor/vendorpassword') !!}">
                                <i class="fa fa-lock"></i> Change Password
				                    </a>
				                </li>
						  	</ul>
						</div> 
                     </div>
                     <div class="header-top-entry increase-icon-responsive login">
                     	 <div class="dropdown">
             	 			<a href="{!! url('vendor/settings') !!}">
             	 				<i class="fa fa-cogs"></i>
					  		</a>
						</div> 
                     </div>
                  </div>
               </div>
            </div>
            <div class="close-header-layer"></div>
            <div class="navigation">
               <div class="navigation-header responsive-menu-toggle-class">
                  <div class="title">Navigation</div>
                  <div class="close-menu"></div>
               </div>
               <div class="nav-overflow">
                  <nav> 
                     <ul>
                        <li class="simple-list"><a href="{!! url('vendor/dashboard') !!}" class="">Dashboard</a></li>
                        <?php /* donot work on it for now ?>
                        <li class="simple-list"><a href="{!! url('vendor/pos') !!}" class="">POS</a></li>
                        <?php */ ?>
                        <li class="simple-list"><a href="{!! url('vendor/plant') !!}" class="">Plant</a></li>
                        <li class="simple-list"><a href="{!! url('vendor/orders') !!}" class="">Orders</a></li>
                        <li class="simple-list"><a href="{!! url('vendor/products') !!}" class="">Products</a></li>
                        <li class="simple-list"><a href="{!! url('vendor/customer') !!}" class="">Add Customer</a></li>
                        <li class="simple-list"><a href="{!! url('vendor/customers') !!}" class="">Customers</a></li>
                        <li class="simple-list"><a href="{!! url('vendor/withdraws') !!}" class="">Finances</a></li>
                        <li class="simple-list"><a href="{!! url('vendor/dashboard') !!}" class="">Reports</a></li>
                        <li class="simple-list"><a href="{!! url('vendor/order-template') !!}">Repeat Jobs</a></li>
                     </ul>
                     <div class="clear"></div>
                  </nav>
                  <div class="navigation-footer responsive-menu-toggle-class">
                  </div>
               </div>
            </div>
         </header>
         <div class="clear"></div>
      </div>
   </div>
</div>
<div class="home-wrapper">
   <div class="section-padding dashboard-account-wrapper wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
      <div class="container">
         <div id="main_content_zone_parent">
         	<div id="main_content_zone">
         		@yield('content')
         	</div>
         </div>
      </div>
   </div>
</div>

<script src="{{ URL::asset('assets/js/jquery.zoom.js')}}"></script>
<script src="{{ URL::asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-slider.min.js')}}"></script>

<!-- <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> -->

<script src="{{ URL::asset('assets/js/wow.js')}}"></script>
<script src="{{ URL::asset('assets/js/genius-slider.js')}}"></script>
<script src="{{ URL::asset('assets/js/global.js')}}"></script>
<script src="{{ URL::asset('assets/js/main.js')}}"></script>
<script src="{{ URL::asset('assets/js/plugins.js')}}"></script>
<script src="{{ URL::asset('assets/js/notify.js')}}"></script>   
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ URL::asset('assets/vendor/js/custom.js')}}?v=<?=$assetVersion?>"></script>

@yield('footer')
</body>
</html>