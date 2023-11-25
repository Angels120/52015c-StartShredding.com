<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8" />
  <title>Shredding Service</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta content="" name="description" />
  <meta content="" name="author" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ URL::asset('home_assets/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('home_assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('home_assets/plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('home_assets/plugins/swiper/css/swiper.css')}}" rel="stylesheet" type="text/css" media="screen" />
  <link class="main-stylesheet" href="{{ URL::asset('home_assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
  <link class="main-stylesheet" href="{{ URL::asset('home_assets/css/pages-icons.css')}}" rel="stylesheet" type="text/css" />
  <link class="main-stylesheet" href="{{ URL::asset('home_assets/css/productSelect.css')}}" rel="stylesheet" type="text/css" />
  <script src="{{ URL::asset('home_assets/map/js/jquery1.11.3.min.js')}}"></script>
  <script src="{{ URL::asset('home_assets/map/js/jquery.blockUI.js')}}"></script>
  <script src="{{ URL::asset('home_assets/js/main.vender.js')}}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="{{ url('home_assets/js/functions.js') }}"></script>
    <script src="{{ URL::asset('home_assets/js/customers.js')}}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places">
  </script>
    <link href="{{ URL::asset('home_assets/css/customers.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ URL::asset('home_assets/css/product.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('home_assets/css/comman.css')}}">
    <script>
        var baseUrl = '{!! url('/') !!}';
        var mainurl = '{{url('/')}}';
    </script>


</head>

<body class="pace-dark">
    @yield('header')
    @yield('content')
    @yield('footer')
  <!-- END FOOTER -->
  <!-- BEGIN CORE FRAMEWORK -->
  <script src="{{ URL::asset('home_assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript" src="{{ URL::asset('home_assets/js/pages.image.loader.js')}}"></script>
  <script type="text/javascript" src="{{ URL::asset('home_assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- BEGIN SWIPER DEPENDENCIES -->
  <script type="text/javascript" src="{{ URL::asset('home_assets/plugins/swiper/js/swiper.jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{ URL::asset('home_assets/plugins/velocity/velocity.min.js')}}"></script>
  <script type="text/javascript" src="{{ URL::asset('home_assets/plugins/velocity/velocity.ui.js')}}"></script>
  <!-- BEGIN RETINA IMAGE LOADER -->
  <script type="text/javascript" src="{{ URL::asset('home_assets/plugins/jquery-unveil/jquery.unveil.min.js')}}"></script>
  <!-- END VENDOR JS -->
  <!-- BEGIN PAGES FRONTEND LIB -->
  <script type="text/javascript" src="{{ URL::asset('home_assets/js/pages.frontend.js')}}"></script>
  <!-- END PAGES LIB -->
  <!-- BEGIN YOUR CUSTOM JS -->
  <script type="text/javascript" src="{{ URL::asset('home_assets/js/custom.js')}}"></script>
  <!-- END PAGES LIB -->
</body>

</html>