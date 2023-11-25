<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>Shredding Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="apple-touch-icon" href="{{ URL::asset('assets_new/pages/ico/60.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('assets_new/pages/ico/76.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('assets_new/pages/ico/120.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('assets_new/pages/ico/152.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('assets_new/favicon.ico') }}"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="StartShredding is a national document destruction and records management company based out of Toronto, Canada."
          name="description"/>
    <meta content="" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN PLUGINS -->
    <link href="{{ URL::asset('assets_new/assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::asset('assets_new/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::asset('assets_new/assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::asset('assets_new/assets/plugins/bootstrap/css/bootstrap-timepicker.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets_new/assets/plugins/bootstrap/css/datepicker3.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::asset('assets_new/assets/plugins/bootstrap/css/daterangepicker-bs3.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::asset('assets_new/assets/plugins/swiper/css/swiper.css') }}" rel="stylesheet" type="text/css"
          media="screen"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- END PLUGINS -->
    <!-- BEGIN PAGES CSS -->
    <link class="main-stylesheet" href="{{ URL::asset('assets_new/pages/css/pages.css') }}" rel="stylesheet"
          type="text/css"/>
    <link class="main-stylesheet" href="{{ URL::asset('assets_new/pages/css/pages-icons.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- BEGIN PAGES CSS -->
</head>
<body class="pace-dark">
<!-- BEGIN HEADER -->
@yield('header')
<!-- END HEADER -->
<div class="page-wrappers">
    <!-- BEGIN JUMBOTRON -->
@yield('content')

<!-- BEGIN FOOTER -->
@yield('footer')
<!-- END FOOTER -->

</div>
<!-- START OVERLAY SEARCH -->
<div class="overlay hide" data-pages="search">
    <!-- BEGIN Overlay Content !-->
    <div class="overlay-content full-height has-results">
        <!-- END Overlay Header !-->
        <div class="container relative full-height">
            <!-- BEGIN Overlay Header !-->
            <div class="container-fluid">
                <!-- BEGIN Overlay Close !-->
                <a href="#" class="close-icon-light overlay-close text-black fs-16 top-right">
                    <i class="pg-close_line"></i>
                </a>
                <!-- END Overlay Close !-->
            </div>
        </div>
    </div>
    <!-- END Overlay Content !-->
</div>
<!-- END OVERLAY SEARCH -->
<!-- BEGIN CORE FRAMEWORK -->
<script src="{{ URL::asset('assets_new/assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ URL::asset('assets_new/pages/js/pages.image.loader.js') }}"></script>
{{--<script type="text/javascript" src="{{ URL::asset('assets_new/assets/plugins/jquery/jquery-1.11.1.min.js') }}"></script>--}}
<script type="text/javascript" src="{{ URL::asset('assets_new/assets/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('assets_new/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets_new/assets/plugins/jquery/jquery-easy.js') }}"></script>
<!-- BEGIN SWIPER DEPENDENCIES -->
<script type="text/javascript"
        src="{{ URL::asset('assets_new/assets/plugins/swiper/js/swiper.jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets_new/assets/plugins/velocity/velocity.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets_new/assets/plugins/velocity/velocity.ui.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('assets_new/assets/plugins/jquery-appear/jquery.appear.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('assets_new/assets/plugins/animateNumber/jquery.animateNumbers.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- BEGIN RETINA IMAGE LOADER -->
<script type="text/javascript"
        src="{{ URL::asset('assets_new/assets/plugins/jquery-unveil/jquery.unveil.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets_new/assets/js/form_wizard.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets_new/assets/js/form_elements.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets_new/assets/js/jquery.bootstrap.wizard.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('assets_new/assets/plugins/bootstrap/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('assets_new/assets/plugins/bootstrap/js/bootstrap-timepicker.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('assets_new/assets/plugins/bootstrap/js/daterangepicker.js') }}"></script>
<!-- END VENDOR JS -->
<!-- BEGIN PAGES FRONTEND LIB -->
<script type="text/javascript" src="{{ URL::asset('assets_new/pages/js/pages.frontend.js') }}"></script>
<!-- END PAGES LIB -->
<!-- BEGIN YOUR CUSTOM JS -->
<script type="text/javascript" src="{{ URL::asset('assets_new/assets/js/custom.js') }}"></script>
<!-- END PAGES LIB -->
<script>
    AOS.init();
</script>

@yield('js')

</body>
</html>