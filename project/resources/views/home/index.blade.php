@extends('home.includes.master_new')

@section('header')
    @include('home.includes.header_new')

    <script src="https://code.jquery.com/jquery-1.12.1.min.js" name="jquery"></script>
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places&callback=initAutocomplete'></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var placeSearch, autocomplete;
            $("#autocomplete").on("keyup", function (e) {
                e.preventDefault();
                var code = e.keyCode || e.which;
                if (code == 40) {
                    if ($('.serachwrap .focus').length == 0)
                        $('.serachwrap li:first-child').addClass('focus');
                    else {
                        var el = $('.serachwrap li.focus');
                        $('.serachwrap li').removeClass('focus');
                        el.next('li').addClass('focus');
                    }
                    return;
                } else if (code == 38) {
                    if ($('.serachwrap .focus').length == 0)
                        $('.serachwrap li:last-child').addClass('focus');
                    else {
                        var el = $('.serachwrap li.focus');
                        $('.serachwrap li').removeClass('focus');
                        el.prev('li').addClass('focus');
                    }
                    return;
                } else if (code == 13) {
                    e.preventDefault();
                    var el = $('.serachwrap li.focus');
                    if (el.length) {
                        var string = $('.serachwrap li.focus').attr('title');
                        $('#autocomplete').val(string);
                        var geocd = new google.maps.Geocoder();
                        geocd.geocode({
                            "address": string
                        }, fillInAddress);
                        $('#result').hide();
                        return false;
                    }
                }
                $('#result').hide();
                $('#result').html('');
                var inputData = $("#autocomplete").val();
                service = new google.maps.places.AutocompleteService();

                var request1 = {
                    input: inputData,
                    types: ['geocode'],
                    componentRestrictions: {
                        country: 'us'
                    },
                };
                var request2 = {
                    input: inputData,
                    types: ['geocode'],
                    componentRestrictions: {
                        country: 'ca'
                    },
                };
                $('#result').empty();
                service.getPlacePredictions(request1, callback);
                service.getPlacePredictions(request2, callback);

            });

            function callback(predictions, status) {

                $('#result').html('');
                $('#result').hide();
                var resultData = '';
                if (predictions != '') {
                    for (var i = 0; i < predictions.length; i++) {
                        resultData += '<li title="' + predictions[i].description + '"><a href="{{ url("/request_quote") }}?address=' + predictions[i]
                            .description + '"><i class="fa fa-map-marker"></i>' + predictions[i]
                            .description + '</a></li>';
                    }
                    if ($('#result').html() != undefined && $('#result').html() != '') {
                        resultData = $('#result').html() + resultData;
                    }
                    if (resultData != undefined && resultData != '') {
                        $('#result').html(resultData).show();
                        $('#result').show();
                    }
                }

            }
        });
    </script>
    <style type="text/css">
        #result li {
          color: #666666;
          text-align: left;
          border-bottom: 1px solid #dadada;
          cursor: pointer;
          text-overflow: ellipsis;
          white-space: nowrap;
          overflow: auto;
          text-align: left;
          font-size: 14px;
        }
        #result {
          border: 1px solid #DCE0E0;
          margin-left: 25%;
          background: #FFF;
          list-style: none;
          padding: 0px;
          z-index: 999;
          border-radius: 4px;
          position: absolute;
          top: 50px;
          width: 50%;
          max-height: 202px;
          display: none;
        }
        #result li a {
          padding: 7px 15px;
          display: block;
        }
        ul > li, ol > li {
          padding-left: 3px;
          line-height: 24px;
        }
        .serachwrap li i.fa {
          margin-right: 5px;
        } 
        .form-control {
          background-color: #ffffff;
          background-image: none;
          border: 1px solid rgba(0, 0, 0,0.5);
          font-family: Arial, sans-serif;
          -webkit-appearance: none;
          color: #2c2c2c;
          outline: 0;
          height: 35px;
          padding: 9px 12px;
          line-height: normal;
          font-size: 14px;
          font-weight: normal;
          vertical-align: middle;
          min-height: 35px;
          -webkit-transition: all 0.12s ease;
          transition: all 0.12s ease;
          -webkit-box-shadow: none;
          box-shadow: none;
          border-radius: 2px;
          -webkit-border-radius: 2px;
          -moz-border-radius: 2px;
          -webkit-transition: background 0.2s linear 0s;
          transition: background 0.2s linear 0s;
        }
    </style>
@stop

@section('content')
    <!-- BEGIN JUMBOTRON -->
    <section class="jumbotron full-vh" data-pages="parallax">
        <div class="inner full-height">
            <!-- BEGIN SLIDER -->
            <div class="swiper-container" id="hero">
                <div class="swiper-wrapper">
                    <!-- BEGIN SLIDE -->
                    <div class="swiper-slide fit">
                        <!-- BEGIN IMAGE PARRALAX -->
                        <div class="slider-wrapper">
                            <div class="background-wrapper" data-swiper-parallax="30%">
                                <!-- YOUR BACKGROUND IMAGE HERE, YOU CAN ALSO USE IMG with the same classes -->
                                <div class="background"
                                     data-pages-bg-image="{{ URL::asset('assets_new/assets/images/new-slider-1.jpg') }}"></div>
                            </div>
                        </div>
                        <!-- END IMAGE PARRALAX -->
                        <!-- BEGIN CONTENT -->
                        <div class="content-layer">
                            <div class="inner full-height">
                                <div class="container-xs-height full-height">
                                    <div class="col-xs-height col-middle text-center">
                                        <div class="container">
                                            <div class="col-md-12 no-padding col-xs-12">
                                                <h1 class="text-white sm-text-center" data-swiper-parallax="-15%"
                                                    data-aos="fade-down" data-aos-easing="linear"
                                                    data-aos-duration="1700"> Los Angeles Shredding Service</h1>
                                                <p class="sm-text-center" data-aos="fade-down" data-aos-easing="linear"
                                                   data-aos-duration="1700">We provide GUARANTEED lowest pricing for
                                                    Secure Paper
                                                    Shredding Services <br>
                                                    Request A Quote and get started on shredding personal & confidential
                                                    documents</p>
                                                <div class="search-box ae-4 done" data-aos="fade-down"
                                                     data-aos-easing="linear" data-aos-duration="1700">

                                                    <form method="get" action="request_quote/">
                                                        <div class="location-field">
                                                            <input type="text" name="address" id="autocomplete"
                                                                   placeholder="Enter your EXACT adress"
                                                                   class="xs-full-width">
                                                            <ul id="result" class="serachwrap"></ul>
                                                        </div>
                                                        <input type="submit"
                                                               class="button btn btn-primary btn-rounded btn-lg"
                                                               value="Let's Get Started">
                                                    </form>
                                               <div class="banner-logo m-t-35 m-b-15" data-aos="fade-down"
                                                     data-aos-easing="linear" data-aos-duration="1800" >
                                                    <img class="xs-image-responsive-height image-responsive-width"
                                                         src="{{ URL::asset('assets_new/assets/images/banner-logos.png') }}"
                                                         alt="Banner Logos">
                                                </div>
                                                </div>

                                                <p class="text-white m-t-20" data-aos="fade-down"
                                                   data-aos-easing="linear" data-aos-duration="1800">Take a peek at some
                                                    of our <b>satisfied</b>
                                                    customers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END CONTENT -->
                    </div>
                    <!-- END SLIDE -->
                    <!-- BEGIN SLIDE -->
                    <div class="swiper-slide fit">
                        <!-- BEGIN IMAGE PARRALAX -->
                        <div class="slider-wrapper">
                            <div class="background-wrapper" data-swiper-parallax="30%">
                                <!-- YOUR BACKGROUND IMAGE HERE, YOU CAN ALSO USE IMG with the same classes -->
                                <div class="background"
                                     data-pages-bg-image="{{ URL::asset('assets_new/assets/images/new-slider-2.jpg') }}"></div>
                            </div>
                        </div>
                        <!-- END IMAGE PARRALAX -->
                        <!-- BEGIN CONTENT -->
                        <div class="content-layer">
                            <div class="inner full-height">
                                <div class="container-xs-height full-height">
                                    <div class="col-xs-height col-middle text-center">
                                        <div class="container">
                                            <div class="col-md-12 no-padding col-xs-12">
                                                <!--h1 class="text-white sm-text-center" data-swiper-parallax="-15%" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1000"> Ready to Shred</h1-->
                                                <h1 class="text-white sm-text-center" data-swiper-parallax="-15%"
                                                    data-aos="fade-down" data-aos-easing="linear"
                                                    data-aos-duration="1100"> Los Angeles Shredding Service</h1>
                                                <p class="sm-text-center" data-aos="fade-down" data-aos-easing="linear"
                                                   data-aos-duration="1200">We provide GUARANTEED lowest pricing for
                                                    Secure Paper
                                                    Shredding Services <br>
                                                    Request A Quote and get started on shredding personal & confidential
                                                    documents</p>
                                                <div class="search-box ae-4 done" data-aos="fade-down"
                                                     data-aos-easing="linear" data-aos-duration="1300">

                                                    <form method="get" action="request_quote/">
                                                        <div class="location-field">
                                                            <input type="text" name="address" id="autocomplete"
                                                                   placeholder="Enter your EXACT adress"
                                                                   class="xs-full-width">
                                                            <ul id="result" class="serachwrap"></ul>
                                                        </div>
                                                        <input type="submit"
                                                               class="button btn btn-primary btn-rounded btn-lg"
                                                               value="Let's Get Started">
                                                    </form>
                                                </div>
                                                <div class="banner-logo m-t-35 m-b-15" data-aos="fade-down"
                                                     data-aos-easing="linear" data-aos-duration="1500">
                                                    <img class="xs-image-responsive-height image-responsive-width"
                                                         src="{{ URL::asset('assets_new/assets/images/banner-logos.png') }}"
                                                         alt="Banner Logos">
                                                </div>
                                                <p class="text-white m-t-20" data-aos="fade-down"
                                                   data-aos-easing="linear" data-aos-duration="1700">Take a peek at some
                                                    of our <b>satisfied</b>
                                                    customers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END CONTENT -->
                    </div>
                    <!-- END SLIDE -->
                    <!-- BEGIN SLIDE -->
                    <div class="swiper-slide fit">
                        <!-- BEGIN IMAGE PARRALAX -->
                        <div class="slider-wrapper">
                            <div class="background-wrapper" data-swiper-parallax="30%">
                                <div class="background"
                                     data-pages-bg-image="{{ URL::asset('assets_new/assets/images/new-slider-1.jpg') }}"></div>
                            </div>
                        </div>
                        <!-- END IMAGE PARRALAX -->
                        <!-- BEGIN CONTENT -->
                        <div class="content-layer">
                            <div class="inner full-height">
                                <div class="container-xs-height full-height">
                                    <div class="col-xs-height col-middle text-center">
                                        <div class="container">
                                            <div class="col-md-12 no-padding col-xs-12">
                                                <!--h1 class="text-white sm-text-center" data-swiper-parallax="-15%" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1000"> Ready to Shred</h1-->
                                                <h1 class="text-white sm-text-center" data-swiper-parallax="-15%"
                                                    data-aos="fade-down" data-aos-easing="linear"
                                                    data-aos-duration="1100"> Los Angeles Shredding Service</h1>
                                                <p class="sm-text-center" data-aos="fade-down" data-aos-easing="linear"
                                                   data-aos-duration="1200">We provide GUARANTEED lowest pricing for
                                                    Secure Paper
                                                    Shredding Services <br>
                                                    Request A Quote and get started on shredding personal & confidential
                                                    documents</p>
                                                <div class="search-box ae-4 done" data-aos="fade-down"
                                                     data-aos-easing="linear" data-aos-duration="1300">

                                                    <form method="get" action="request_quote/">
                                                        <div class="location-field">
                                                            <input type="text" name="address" id="autocomplete"
                                                                   placeholder="Enter your EXACT adress"
                                                                   class="xs-full-width">
                                                            <ul id="result" class="serachwrap"></ul>
                                                        </div>
                                                        <input type="submit"
                                                               class="button btn btn-primary btn-rounded btn-lg"
                                                               value="Let's Get Started">
                                                    </form>
                                                </div>
                                                <div class="banner-logo m-t-35 m-b-15" data-aos="fade-down"
                                                     data-aos-easing="linear" data-aos-duration="1500">
                                                    <img class="xs-image-responsive-height image-responsive-width"
                                                         src="{{ URL::asset('assets_new/assets/images/banner-logos.png') }}"
                                                         alt="Banner Logos">
                                                </div>
                                                <p class="text-white m-t-20" data-aos="fade-down"
                                                   data-aos-easing="linear" data-aos-duration="1700">Take a peek at some
                                                    of our <b>satisfied</b>
                                                    customers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END CONTENT -->
                    </div>
                    <!-- END SLIDE -->
                </div>
                <!-- BEGIN ANIMATED MOUSE -->
                <div class="mouse-wrapper hidden-xs">
                    <div class="mouse">
                        <div class="mouse-scroll"></div>
                    </div>
                </div>
                <!-- Add Navigation -->
                <div class="swiper-navigation swiper-dark-solid swiper-button-prev auto-reveal"></div>
                <div class="swiper-navigation swiper-dark-solid swiper-button-next auto-reveal"></div>
            </div>
        </div>
        <!-- END SLIDER -->
    </section>
    <!-- END JUMBOTRON -->
    <!-- START CONTENT SECTION -->
    <section class="bg-master-lightest p-b-85 p-t-75 xs-p-t-20 xs-p-l-20">
        <div class="container">
            <div class="row">
                <div class="col-md-5 b-r b-grey xs-b-b b-grey">
                    <div class="text-left">
                        <h1 class="m-t-5 main-title text-uppercase" data-aos="fade-down" data-aos-duration="1500">
                            PROVEN</h1>
                    </div>
                    <h3 class="no-margin"><span data-pages-animate="number" data-value="15"
                                                data-animation-duration="800" data-aos="fade-down"
                                                data-aos-easing="linear" data-aos-duration="1500">0</span> YEARS</h3>
                    <h3 class=" no-margin"><span data-pages-animate="number" data-value="1000"
                                                 data-animation-duration="800" data-aos="fade-down"
                                                 data-aos-easing="linear" data-aos-duration="1500">0</span> + CUSTOMERS
                    </h3>
                    <h3 class=" no-margin"><span data-pages-animate="number" data-value="2" data-animation-duration="1"
                                                 data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">0</span>
                        MILLION + BOXES DESTROYED</h3>
                    <h3 class=" no-margin" data-aos="fade-down" data-aos-duration="1500">ZERO DATA BREACH</h3>
                </div>
                <div class="col-md-7 p-r-30 p-l-30 xs-p-l-15 xs-p-t-20">
                    <h1 class="m-t-5 main-title text-uppercase" data-aos="fade-down" data-aos-duration="1500">About
                        Us</h1>
                    <h5 data-aos="fade-down" data-aos-duration="1500">StartShredding is a national document destruction
                        and records management company based out of Toronto, Canada. Founded in 2005, we have
                        consistently proven to be the trusted name and industry leader. Trusted by over 10,000 Clients,
                        we utilize best of breed technology, attention to details and unparalleled commitment to
                        customer service, that brings repeat customers every single year.</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTENT SECTION -->
    <!-- BEGIN INTRO CONTENT -->
    <section class="container-fluid b-t b-white">
        <div class="row">
            <div class="col-md-4 text-center bg-success hover-push demo-story-block">
                <div class="hover-backdrop"
                     style="background:url({{ URL::asset('assets_new/assets/images/feature_1.jpg') }})"></div>
                <div class="hover-caption bottom-left bottom-right p-b-40">
                    <h4 class="text-white m-b-25">Paint it the way you like it!</h4>
                    <a class="font-montserrat fs-12 hint-text text-white all-caps">More information</a>
                </div>
            </div>
            <div class="col-md-4 text-center bg-success hover-push demo-story-block">
                <div class="hover-backdrop"
                     style="background:url({{ URL::asset('assets_new/assets/images/feature_2.jpg') }})"></div>
                <div class="hover-caption bottom-left bottom-right p-b-40">
                    <h4 class="text-white m-b-25">Capture the moments</h4>
                    <a class="font-montserrat fs-12 hint-text text-white all-caps">More information</a>
                </div>
            </div>
            <div class="col-md-4 text-center bg-success hover-push demo-story-block">
                <div class="hover-backdrop"
                     style="background:url({{ URL::asset('assets_new/assets/images/feature_3.jpg') }})"></div>
                <div class="hover-caption bottom-left bottom-right p-b-40">
                    <h4 class="text-white m-b-25">Digital solutions led by<br>
                        clarity, simplicity & honesty</h4>
                    <a class="font-montserrat fs-12 hint-text text-white all-caps">More information</a>
                </div>
            </div>
        </div>
    </section>
    <!-- END INTRO CONTENT -->
    <!-- BEGIN CONTENT SECTION -->
    <section class="p-b-85 p-t-75 bg-master-lighter">
        <div class="container">
            <div class="md-p-l-20 xs-no-padding clearfix">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="m-t-15" data-aos="fade-right" data-aos-duration="1500">
                            <img alt="" class="image-responsive-height image-responsive-width"
                                 src="{{ URL::asset('assets_new/assets/images/off-site-shreding.jpg') }}"
                                 id="mobile_phone">
                        </div>
                    </div>
                    <div class="col-md-7 col-md-offset-1 col-sm-offset-2 col-sm-6">
                        <div class="clearfix hidden-sm">
                            <h2 class="font-montserrat main-title text-uppercase" data-aos="fade-down"
                                data-aos-duration="1500">OFF SITE SHREDDING</h2>
                            <p class="col-md-10 col-sm-10 no-padding" data-aos="fade-down" data-aos-duration="1500">The
                                most secure and cost-effective way to destroy your documents. Convenient, Reliable, and
                                Trusted by thousands of our clients.</p>
                        </div>
                        <div class="col-md-9 col-sm-11">
                            <div class="p-t-25">
                                <dl>
                                    <dt class="block-title p-b-15 text-black fw-6" data-aos="fade-down"
                                        data-aos-duration="1500">SECURE <i class="pg-arrow_right m-l-10"></i></dt>
                                    <dd class="m-b-30" data-aos="fade-down" data-aos-duration="1500">Our plant
                                        facilities are equipped with best of breed technology, to securely destroy
                                        documents in a timely manner.
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="block-title p-b-15 text-black fw-6" data-aos="fade-down"
                                        data-aos-duration="1500">BEST VALUE <i class="pg-arrow_right m-l-10"></i></dt>
                                    <dd class="m-b-30">Our cost efficient systems and processes ensure that our Clients
                                        receive the best value in shredding services.
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="block-title text-black p-b-15 fw-6" data-aos="fade-down"
                                        data-aos-duration="1500">TRUSTED <i class="pg-arrow_right m-l-10"></i></dt>
                                    <dd class="m-b-30" data-aos="fade-down" data-aos-duration="1500">From City services,
                                        government offices, and small businesses, thousands of clients rely on our
                                        secure offsite shredding service.
                                    </dd>
                                </dl>
                            </div>
                            <button class="btn btn-cons btn-primary btn-lg col-xs-6" data-aos="fade-down"
                                    data-aos-duration="1500">HOW IT WORKS
                            </button>
                            <button class="btn btn-cons btn-primary btn-lg col-xs-5" data-aos="fade-down"
                                    data-aos-duration="1500">BOOK NOW
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTENT SECTION -->
    <section class="bg-master-lightest p-b-85 p-t-75 no-overflow">
        <div class="container">
            <h1 class="font-montserrat m-t-5 text-center main-title text-uppercase" data-aos="fade-down"
                data-aos-duration="1500">MOBILE SHREDDING</h1>
            <p class="text-center" data-aos="fade-down" data-aos-duration="1500">Secure destruction of your material
                right on your premises. Convenient, Reliable, and Trusted by thousands of our clients.</p>
            <div class="row m-t-30">
                <div class="col-md-4 col-sm-6 p-t-25">
                    <h6 class="block-title fw-6" data-aos="fade-down" data-aos-duration="1500">SECURE<i
                                class="pg-arrow_right m-l-20"></i></h6>
                    <p class=" m-t-15" data-aos="fade-down" data-aos-duration="1500">With Onsite Shredding, your
                        documents are destroyed securely utilizing our best of breed technology.</p>
                    <h6 class="block-title m-t-50 fw-6" data-aos="fade-down" data-aos-duration="1500">CONVENIENT <i
                                class="pg-arrow_right m-l-20"></i></h6>
                    <p class=" m-t-15" data-aos="fade-down" data-aos-duration="1500">The destruction process occurs
                        right on your premises at a time that is convenient for you.</p>
                    <h6 class="block-title m-t-50 fw-6" data-aos="fade-down" data-aos-duration="1500">RELIABLE <i
                                class="pg-arrow_right m-l-20"></i></h6>
                    <p class=" m-t-15 m-b-30" data-aos="fade-down" data-aos-duration="1500">Our team works hard to
                        ensure your service is completed in a timely and cost-effective manner.</p>
                    <button class="btn btn-cons btn-primary btn-lg col-xs-6" data-aos="fade-down"
                            data-aos-duration="1500">HOW IT WORKS
                    </button>
                    <button class="btn btn-cons btn-primary btn-lg col-xs-5" data-aos="fade-down"
                            data-aos-duration="1500">BOOK NOW
                    </button>
                </div>
                <div class="col-md-6 col-sm-6 text-right sm-text-center sm-p-l-0 xs-p-r-0" data-aos="fade-left"
                     data-aos-duration="1500">
                    <img class="xs-image-responsive-height sm-no-padding image-responsive-width image-responsive-height xs-m-t-35"
                         src="{{ URL::asset('assets_new/assets/images/mobile-shreding.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="p-b-85 p-t-75 bg-master-lighter">
        <div class="container">
            <h1 class="font-montserrat m-t-5 text-center main-title text-uppercase" data-aos="fade-down"
                data-aos-duration="2000">CITY SHREDDING SERVICE</h1>
            <p class="text-center" data-aos="fade-down" data-aos-duration="2000">We provide a full range of shredding
                services from coast to coast, with service to nearly every major metropolitan city in the USA and
                Canada. Our dependable and secure network of mobile shredding and plant shredding facilities has enabled
                us to provide the same reliable and secure shredding services for clients ranging from individuals to
                multi national corporations.</p>
            <div class="md-p-l-20 md-p-r-20 xs-no-padding">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3" data-aos="fade-up"
                         data-aos-duration="2000">
                        <img class="p-r-40 m-t-10 xs-image-responsive-height sm-no-padding"
                             src="{{ URL::asset('assets_new/assets/images/city-shredding.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="map-location" class="bg-master-lightest no-overflow relative"
             data-pages-bg-image="assets/images/location-bg-1.png">
        <div class="container">
            <h1 class="font-montserrat m-t-5 m-b-25 text-center main-title text-uppercase" data-aos="fade-down"
                data-aos-duration="2000">OUR SERVICE AREAS</h1>
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-down" data-aos-duration="2000">
                    <ul>
                        <li>New York</li>
                        <li>Los Angeles</li>
                        <li>Chicago</li>
                        <li>Houston[3]</li>
                        <li>Phoenix</li>
                        <li>Philadelphia[e]</li>
                        <li>San Antonio</li>
                        <li>San Diego</li>
                        <li>Dallas</li>
                        <li>San Jose</li>
                        <li>Austin</li>
                        <li>Jacksonville[f]</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-down" data-aos-duration="2000">
                    <ul>
                        <li>Fort Worth</li>
                        <li> Columbus</li>
                        <li> San Francisco[g]</li>
                        <li>Charlotte</li>
                        <li>Indianapolis[h]</li>
                        <li> Seattle</li>
                        <li> Denver[i]</li>
                        <li> Washington[j]</li>
                        <li>Boston</li>
                        <li>El Paso</li>
                        <li>Detroit</li>
                        <li>Nashville[k]</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-down" data-aos-duration="2000">
                    <ul>
                        <li>Portland</li>
                        <li>Memphis</li>
                        <li>Oklahoma City</li>
                        <li>Las Vegas</li>
                        <li>Louisville[l]</li>
                        <li>Baltimore[m]</li>
                        <li>Milwaukee</li>
                        <li>Albuquerque</li>
                        <li>Tucson</li>
                        <li>Fresno</li>
                        <li>Mesa</li>
                        <li>Sacramento</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-down" data-aos-duration="2000">
                    <ul>
                        <li>Atlanta</li>
                        <li>Kansas City</li>
                        <li>Colorado Springs</li>
                        <li>Miami</li>
                        <li>Raleigh</li>
                        <li>Omaha</li>
                        <li>Long Beach</li>
                        <li>Virginia Beach[m]</li>
                        <li>Oakland</li>
                    </ul>
                </div>
            </div>
            <h2 class="font-montserrat m-l-35" data-aos="fade-down" data-aos-duration="2000">Canada</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-down" data-aos-duration="2000">
                    <ul>
                        <li>Toronto</li>
                        <li>Montreal</li>
                        <li>Vancouver</li>
                        <li>Calgary</li>
                        <li>Edmonton</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-down" data-aos-duration="2000">
                    <ul>
                        <li>Ottawa-Gatineau</li>
                        <li>Winnipeg</li>
                        <li>Quebec City</li>
                        <li>Hamilton</li>
                        <li>Kitchener</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-down" data-aos-duration="2000">
                    <ul>
                        <li>London</li>
                        <li>Victoria</li>
                        <li>Halifax</li>
                        <li>Oshawa</li>
                        <li>Windsor</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@stop

@section('footer')
    @include('home.includes.footer_new')
@stop