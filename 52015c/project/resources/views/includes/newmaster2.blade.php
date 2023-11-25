<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="keywords" content="{{$code[0]->meta_keys}}">
    <link rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />
    <title>{{$settings[0]->title}} @yield('title')</title>

    <link href='https://fonts.googleapis.com/css?family=Poppins:300,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Mountains+of+Christmas:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Taviraj:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="{{ URL::asset('assets2/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets2/css/style.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/font/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('assets2/css/style.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets2/js/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets2/js/owl-carousel/owl.theme.css')}}">
    <link href="{{ URL::asset('assets2/css/bs-select.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
    <style>
        @media screen and (max-width : 1920px) {
            .mobileshow {
                display: none;
            }
        }

        @media screen and (max-width : 906px) {
            .mobileshow {
                display: block;
            }
        }

        #sns_footer_bottom {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: red;
            color: white;
            text-align: center;
        }

        /* 
        body {
            font-family: "Raleway script=all rev=1", "Adobe Blank";
            font-size: 13px
        } */

        .credit-sign {
            width: 11px;
            height: 16px;
        }

        #cartProductTable i {
            top: 0;
        }
    </style>
    <style>
        .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            display: none;
            padding-top: 60px;
        }

        /* .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        } */

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .nav-open i {
            font-size: 24px;
            cursor: pointer;
            color: #ffffff !important;
        }

        .closebtn {
            margin-top: 30px;
            padding-bottom: 20px;
        }

        .closebtn i {
            color: #ffffff;
        }

        .top-left-nav {
            display: table;
            margin-top: 30px;
            padding-left: 20px;
        }

        .top-left-nav li {
            position: relative;
        }

        .top-left-nav li a {
            color: #ffffff;
            font-size: 16px;
            text-transform: uppercase;
            font-weight: 600;
        }



        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>

    <style>
        .top-middle-nav {
            display: table;
            margin: 7px auto 0px auto;
            padding: 2px 20px;
            line-height: 30px;
            border: 1px solid #fff;
        }

        .top-middle-nav li {
            float: left;
            margin-left: 20px;
            margin-right: 20px;
        }

        .top-middle-nav li a {
            color: #ffffff;
            font-size: 16px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .top-middle-nav li:hover a {
            color:
        }

        @media screen and (max-width: 480px) {
            .top-middle-nav {
                display: none;
            }
        }
    </style>

    <style>
        .mycart:before {
            background: none;
        }

        .mycart .tongle,
        .mycart .tongle i {
            color: #ffffff !important;
        }

        .mycart .tongle i {
            font-size: 13px;
        }
    </style>

<body id="bd" class="cms-index-index4 header-style4 prd-detail sns-products-detail1 cms-simen-home-page-v2 default cmspage">
    <div id="sns_wrapper">
        <!-- Menu -->
        <div id="sns_header" class="wrap">
            <!-- Header Top -->
            <div id="sns_menu" class="container-fluid" style="z-index:9999;">
                @include('includes.nav')
            </div>

            <div class="content-center fixed-header-margin">

                @yield('content')
                <script src="https://use.fontawesome.com/releases/v5.11.1/js/all.js" data-auto-replace-svg="nest">
                </script>
                <!-- starting of footer area -->
                <style>
                    #footer_bottom {
                        background-color: rgb(41, 41, 41);
                        color: #fff;
                        line-height: 30px;
                        position: relative;
                        position: fixed;
                        bottom: 0;
                        width: 100%;
                        z-index: 999;
                    }

                    #footer_bottom .icon-container {
                        display: table;
                        width: 100%;
                        margin: 0 auto;
                    }

                    #footer_bottom .accountloy {
                        display: table-cell;
                        vertical-align: middle;
                        width: 50%;
                        text-align: left;
                    }

                    #footer_bottom .transhop {
                        display: table-cell;
                        vertical-align: middle;
                        width: 50%;
                        text-align: right;
                    }

                    #footer_bottom .inner a {
                        color: #fff;
                        font-family: 'Raleway', sans-serif;
                        font-weight: 600;
                    }

                    #footer_bottom .inner i {
                        font-size: 18px;
                        color: #fff;
                    }

                    #footer_bottom .inner {
                        display: inline-block;
                        vertical-align: middle;
                        text-align: center;
                        padding-right: 30px;
                        font-size: 9px;
                    }

                    #footer_bottom .inner:last-child {
                        padding-right: 0;
                    }

                    #footer_bottom .shcart {
                        color: #444;
                        font-size: 30px;
                        vertical-align: middle;
                        background-color: #fff;
                        width: 55px;
                        height: 55px;
                        display: block;
                        line-height: 40px;
                        text-align: center;
                        position: absolute;
                        left: 0;
                        right: 0;
                        margin: auto;
                        top: -23px;
                        border-radius: 50%;
                        border: 4px solid #333;
                        /* outline: 1px solid #ccc; */
                        box-shadow: 0 0 3px #ddd;
                    }

                    #footer_bottom .shcart i {
                        line-height: 52px;
                        top: 0;
                    }

                    #footer_bottom #footer-cart .tongle i {
                        color: #fff;
                        top: 0;
                    }



                    @media screen and (max-width : 906px) {
                        .mobileshow {
                            display: block;
                        }
                    }

                    #sns_#footer_bottom_bottom {
                        position: fixed;
                        left: 0;
                        bottom: 0;
                        width: 100%;
                        background-color: red;
                        color: white;
                        text-align: center;
                    }

                    @media screen and (min-width : 1920px) {
                        .mobileshow {
                            display: none;
                        }

                        #footer_bottom .accountloy {
                            vertical-align: unset;
                            text-align: unset;
                            width: 50%;
                        }

                        #footer_bottom .transhop {
                            vertical-align: unset;
                            text-align: unset;
                            width: 50%;

                        }

                    }

                    @media screen and (max-width : 906px) {
                        .mobileshow {
                            display: block;
                        }
                    }

                    #sns_footer {
                        margin-top: 150px;
                    }

                    @media screen and (max-width : 480px) {
                        #footer_bottom {
                            line-height: 25px;
                        }

                        #sns_footer_bottom .icon-container {
                            max-width: 100% !important;
                        }

                        #footer_bottom .shcart {
                            width: 40px;
                            height: 40px;
                            line-height: 24px;
                            top: -15px;
                        }

                        #footer_bottom .shcart i {
                            line-height: 24px;
                            font-size: 16px;
                        }

                        #footer_bottom .accountloy {
                            display: inline-block;
                            text-align: left;
                            width: 50%;
                        }

                        #footer_bottom .transhop {
                            display: inline-block;
                            text-align: right;
                            width: 50%;
                        }

                        #footer_bottom .icon-container {
                            padding: 0px 15px;
                        }

                        #footer_bottom #footer-cart .tongle,
                        #footer_bottom #footer-cart .tongle i {
                            font-size: 13px;
                        }

                        #footer_bottom .transhop .inner,
                        #footer_bottom .accountloy .inner {
                            font-size: 10px;
                        }

                        #footer_bottom .transhop .inner i,
                        #footer_bottom .accountloy .inner i {
                            font-size: 19px;
                            /* padding-bottom: 5px; */
                        }

                        #footer_bottom .accountloy .inner a {
                            /* top: 10; */
                        }

                        #footer_bottom .inner {
                            padding-right: 25px;
                        }

                        #sns_footer {
                            margin-top: 250px;
                        }

                        #footer_bottom .transhop .hid,
                        #footer_bottom .accountloy .hid {
                            display: none;
                        }

                        #footer_bottom .break {
                            line-height: 10px !important;
                        }

                        #sns_footer {
                            margin-top: 100px;
                        }
                    }

                    #sns_footer_bottom {
                        position: fixed;
                        left: 0;
                        bottom: 0;
                        width: 100%;
                        background-color: red;
                        color: white;
                        text-align: center;
                    }

                    #sns_footer_bottom .icon-container {
                        text-transform: uppercase;
                        max-width: 90%;
                    }
                </style>
                <!-- FOOTER -->
                <footer>
                    <div id="sns_footer" class="footer_style vesion2 wrap">

                        <div class="container-fluid">
                            <div id="footer_bottom">
                                <div id="sns_footer_bottom" class="footer" style='background-color:black;z-index:999;'>
                                    <div class="icon-container">
                                        @if(!Auth::guard('profile')->user())
                                        <a class="shcart" href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i></a>
                                        @else
                                        <a class="shcart" href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i></a>
                                        @endif
                                        {{-- <a class="shcart" href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i></a> --}}
                                        <div class="accountloy">
                                            <div class="inner">
                                                <a href="{{route("user.product-favourite")}}"><i class="fas fa-heart"></i><br><span class="break"></span>Faves</a>
                                            </div>
                                            <div class="inner">
                                                <a href="{{route('user.myorders')}}"><i class="fas fa-file-invoice"></i><br><span class="break"></span>Orders</a>

                                            </div>
                                            <div class="inner hid">
                                                <a href="{{ url('/locations') }}"><i class="fas fa-map-marked-alt"></i><br><span class="break"></span>Drop Off</a>
                                            </div>
                                        </div>
                                        <div class="transhop">
                                            <!-- <div class="inner hid">
                                                <a href="{{ url('/request-pickup') }}"><i
                                                        class="fas fa-phone-square"></i><br><span
                                                        class="break"></span>Request Pickup</a>
                                            </div> -->
                                            <div class="inner">
                                                <a href="{{route("user-dashboard.index")}}"><i class="fas fa-user-cog"></i><br><span class="break"></span>Account</a>
                                            </div>
                                            <!-- <div class="inner">
                                                <a href="{{ url('/rewards') }}"><i class="fas fa-medal"></i><br><span
                                                        class="break"></span>Rewards</a>
                                            </div> -->
                                        </div>
                                        {{-- <div id="footer-cart">
                                            <span class="tongle"> --}}
                                        <?php
                                        // $price=0;
                                        // $items =0;
                                        // foreach($cart_result as $res){
                                        //     $price += $res->cost * $res->quantity;
                                        //     $items += $res->quantity;
                                        // }
                                        ?>

                                        {{-- &nbsp; {{$items}} ITEMS | <b>
                                            $ {{$price}} </b>
                                        </span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </footer>
            <!-- AND FOOTER -->

        </div>
       <script>
        var baseUrl = '{!! url('/') !!}';
        var mainurl = '{{url('/')}}';
        </script>
        <script>
            var currency = '{{$settings[0]->currency_sign}}';
            var language = {
                !!json_encode($language) !!
            };
        </script>


        <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.zoom.js')}}"></script>
        <script src="{{ URL::asset('assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap-slider.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/wow.js')}}"></script>
        <script src="{{ URL::asset('assets/js/genius-slider.js')}}"></script>
        <script src="{{ URL::asset('assets/js/global.js')}}"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script> --}}
        <script src="{{ URL::asset('assets/js/main.js')}}"></script>
        <script src="{{ URL::asset('assets/js/plugins.js')}}"></script>
        <script src="{{ URL::asset('assets/js/notify.js')}}"></script>

        <script src="{{ URL::asset('assets2/js/less.min.js')}}"></script>
        <script src="{{ URL::asset('assets2/js/sns-extend.js')}}"></script>
        <script src="{{ URL::asset('assets2/js/custom.js')}}"></script>
        <script src="{{ URL::asset('assets2/js/bs-select.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
        @yield('footer')

        <script>
            function openNav() {
                $("#mySidenav").fadeIn();
            }

            function closeNav() {
                $("#mySidenav").fadeOut();
            }
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

</body>

</html>