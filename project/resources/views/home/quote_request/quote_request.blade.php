@extends('home.includes.master_new')

@section('header')
    @include('home.includes.header_new')
@stop

@section('content')
    <script
            src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places">
    </script>
    <style>
        .text-red {
            color: red;
        }

        .tab-content #map {
            width: 100%;
            height: 330px;
        }

        .tab-content #result li {
            padding: .3em .4em;
            cursor: pointer;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            border-top: 1px solid #DCE0E0;
            text-align: left;
        }

        .tab-content #result {
            margin-left: 0%;
            border: 1px solid #DCE0E0;
            background: #FFF;
            list-style: none;
            padding: 0px;
            z-index: 100;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            position: absolute;
            top: 37px;
            width: 100%;
            max-height: 160px;
            overflow-y: auto;
            display: none;
        }

        .serachwrap li i.fa {
            margin-right: 5px;
        }

        .disable {
            opacity: 0.4;
        }

        #boxes-div:hover, #garbage-div:hover, #pallets-div:hover {
            box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.5);
        }

    </style>
    <script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.14/dist/jquery-input-mask-phone-number.js"></script>
    <script type="text/javascript" src="{{ url('home_assets/js/functions.js') }}"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $("#service_type").val('');
            $("#service_preference").val('');
            $("#standard_file_boxes").val('');
            $("#garbage_bags").val('');
            $("#pallets").val('');
            $("#firstname").val('');
            $("#lastname").val('');
            $("#email").val('');
            $("#phone").val('');
            $("#company").val('');

            $('.btn-fo-next').click(function () {
                var next_step = $(this).data('next');
                if (next_step == "step2") {

                    $(".address_error").html("");
                    $(".street_no_error").html("");
                    $(".state_error").html("");
                    $(".city_error").html("");
                    $(".zip_error").html("");

                    if (!$("#address").val() || $("#address").val() == " ") {
                        $(".address_error").html("Address is required");
                    } else if (!$("#street_no").val() || $("#street_no").val() == " ") {
                        $(".street_no_error").html("Street number is required");
                    } else if (!$("#state").val() || $("#state").val() == " ") {
                        $(".state_error").html("State is required");
                    } else if (!$("#city").val() || $("#city").val() == " ") {
                        $(".city_error").html("City is required");
                    } else if ($("#fsa1").val() == "") {
                        $(".zip_error").html("Zip Code is required");
                    } else if ($("#fsa1").val().length < 3) {
                        $(".zip_error").html("Zip Code is invalid");
                    } else {
                        $('.step1').removeClass('active');
                        $('.step2').addClass('active');
                        $(".nav-item[data-target='step1']").removeClass('active');
                        $(".nav-item[data-target='step2']").addClass('active');
                        $(document).scrollTop(0);
                    }
                }

                if (next_step == "step3") {

                    $(".service_type_error").html("");
                    $(".service_preference_error").html("");
                    $(".quantity_error").html("");
                    $(".specific_date_error").html("");

                    if ($("#service_type").val() == '') {
                        $(".service_type_error").html("Service Type is required");
                    } else if (($("#service_preference").val() == '') && ($("#service_type").val() != 'Shredding on a Regular Basis')) {
                        $(".service_preference_error").html("Service preference is required");
                    } else if ($("#standard_file_boxes").val() == "" && $("#garbage_bags").val() == "" && $("#pallets").val() == "" && ($("#service_type").val() != 'Shredding on a Regular Basis')) {
                        $(".quantity_error").html("Quantity is required");
                        // } else if ($("#specific-date").attr("checked", 'checked')) {
                        //     alert("sssds");
                        //     $(".specific_date_error").html("Date is required");
                    } else {
                        $('.step2').removeClass('active');
                        $('.step3').addClass('active');
                        $(".nav-item[data-target='step2']").removeClass('active');
                        $(".nav-item[data-target='step3']").addClass('active');
                        $(document).scrollTop(0);
                    }
                }

                if (next_step == "step4") {
                    $(".firstname_error").html("");
                    $(".lastname_error").html("");
                    $(".email_error").html("");
                    $(".phone_error").html("");

                    if ($("#firstname").val() == "") {
                        $(".firstname_error").html("First name is required");
                    } else if ($("#lastname").val() == "") {
                        $(".lastname_error").html("Last name is required");
                    } else if ($("#email").val() == "") {
                        $(".email_error").html("Email is required");
                    } else if ($("#phone").val() == "") {
                        $(".phone_error").html("Phone is required");
                    } else {
                        $('.step3').removeClass('active');
                        $('.step4').addClass('active');
                        $(".nav-item[data-target='step3']").removeClass('active');
                        $(".nav-item[data-target='step4']").addClass('active');
                        $(document).scrollTop(0);
                    }
                }
            });

            $('.submit').click(function () {
                $cap = $("#CaptchaDiv").text();
                $input = $("#CaptchaInput").val();

                $(".captcha_error").html("");

                if ($input != $cap) {
                    $(".captcha_error").html("Please, enter the correct captcha");
                } else {
                    $("#main-form").submit();
                }
            });

            $('.btn-fo-back').click(function () {
                var prev_step = $(this).data('back');
                if (prev_step == "step1") {
                    $('.step2').removeClass('active');
                    $('.step1').addClass('active');
                    $(".nav-item[data-target='step2']").removeClass('active');
                    $(".nav-item[data-target='step1']").addClass('active');
                    $(document).scrollTop(0);
                }

                if (prev_step == "step2") {
                    $('.step3').removeClass('active');
                    $('.step2').addClass('active');
                    $(".nav-item[data-target='step3']").removeClass('active');
                    $(".nav-item[data-target='step2']").addClass('active');
                    $(document).scrollTop(0);
                }

                if (prev_step == "step3") {
                    $('.step4').removeClass('active');
                    $('.step3').addClass('active');
                    $(".nav-item[data-target='step4']").removeClass('active');
                    $(".nav-item[data-target='step3']").addClass('active');
                    $(document).scrollTop(0);
                }
            });
        });
    </script>

    <!-- BEGIN PRICING SECTION -->
    <section class="demo-hero-5" data-pages="parallax"
             data-pages-bg-image="{{ URL::asset('assets_new/assets/images/sub-banner.jpg') }}">
        <div class="container-xs-height full-height">
            <div class="col-xs-height col-middle text-center">
                <h1 class="inner m-t-100 p-b-50 m-b-50 main-title">Request Quote</h1>
            </div>
        </div>
    </section>
    <div class="container-fluid bg-master-lightest">
        <div class=" container container-fixed-lg">
            <div id="rootwizard" class="m-t-50 m-b-50">
                <!-- Nav tabs -->
                <ul
                        class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm d-none d-md-flex d-lg-flex d-xl-flex"
                        role="tablist" data-init-reponsive-tabs="dropdownfx">
                    <li class="nav-item" data-target="step1">
                        <a class="d-flex align-items-center active" style="pointer-events: none" data-toggle="tab"
                           href="#tab1" data-target="#tab1"
                           role="tab"
                           aria-selected="true"><i class="fa-solid fa-location-dot"></i> <span> Location</span></a>
                    </li>
                    <li class="nav-item" data-target="step2">
                        <a class="d-flex align-items-center" style="pointer-events: none" data-toggle="tab" href="#tab2"
                           data-target="#tab2"
                           role="tab"
                           aria-selected="false"><i class="fa-solid fa-box-archive"></i> <span> Services</span></a>
                    </li>
                    <li class="nav-item" data-target="step3">
                        <a class="d-flex align-items-center" style="pointer-events: none" data-toggle="tab" href="#tab3"
                           data-target="#tab3"
                           role="tab"><i
                                    class="fa-solid fa-address-card"></i> <span> Contact Info</span></a>
                    </li>
                    <li class="nav-item" data-target="step4">
                        <a class="d-flex align-items-center" style="pointer-events: none" data-toggle="tab" href="#tab4"
                           data-target="#tab4"
                           role="tab"><i
                                    class="fa-solid fa-file-invoice"></i> <span> Promo Code</span></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <?php $address = $_GET ? $_GET['address'] : ''; ?>
                <form method="post" action="{{ url('/request_quote/submit') }}" id="main-form"
                      class="bg-white clearfix">
                    {{ csrf_field() }}
                    <div class="tab-content">
                        <div class="tab-pane padding-20 sm-no-padding slide-left active step1" id="tab1">
                            <div class="row row-same-height">
                                <div class="col-md-6 b-r b-dashed b-grey sm-b-b">
                                    <div class="sm-padding-5 sm-m-t-15 m-t-15">
                                        <div class="form-group form-group-default required">
                                            <label class="control-label">Address</label>
                                            <input autocomplete="off" id="autocomplete" placeholder="Enter address here"
                                                   type="text" value="{{ $address }}" class="form-control"
                                                   aria-required="true" style="width: 100%">
                                            <ul id="result" class="serachwrap" style="display: block;">
                                                <li title="{{ $address }}" id="onload_click"><i
                                                            class="fa fa-map-marker"></i>{{ $address }}</li>
                                            </ul>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $('.step1 .map-section').removeClass('col-md-12').addClass('col-md-6');
                                                    $('.step1 .address-form-block').removeClass('hide');
                                                });
                                                window.onload = function () {
                                                    document.getElementById("onload_click").click();
                                                };
                                            </script>
                                            <ul id="result" class="serachwrap"></ul>
                                            <div id="map" class="map-location p-b-45"></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-r-30 p-l-30 sm-padding-5">

                                        <div class="form-group form-group-default required">
                                            <label class="control-label">Address</label>
                                            <input type="text" name="address" placeholder="Enter Address"
                                                   class="form-control" id="address"
                                                   aria-required="true">
                                            <small><span class="text-red address_error"></span></small>
                                        </div>
                                        <div class="form-group form-group-default required" aria-required="true">
                                            <label class="control-label">Street No</label>
                                            <input type="text" name="street_no" placeholder="Enter Street No"
                                                   class="form-control" id="street_no"
                                                   aria-required="true">
                                            <small><span class="text-red street_no_error"></span></small>
                                        </div>
                                        <div class="form-group form-group-default">
                                            <label class="control-label">Unit</label>
                                            <input type="text" name="unit" placeholder="Enter Unit"
                                                   class="form-control" id="unit"
                                                   aria-required="true">
                                        </div>
                                        <div class="form-group form-group-default required">
                                            <label class="control-label">State/Province</label>
                                            <input type="text" name="state" placeholder="Enter State/Province"
                                                   class="form-control"
                                                   id="state" aria-required="true">
                                            <small><span class="text-red state_error"></span></small>
                                        </div>
                                        <div class="form-group form-group-default required">
                                            <label class="control-label">City</label>
                                            <input type="text" name="city" placeholder="Enter your city"
                                                   class="form-control" id="city"
                                                   aria-required="true">
                                            <small><span class="text-red city_error"></span></small>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group form-group-default required"
                                                     aria-required="true">
                                                    <label class="control-label">Zip</label>
                                                    <input type="text" name="fsa1" class="form-control" id="fsa1"
                                                           aria-required="true">
                                                    <small><span class="text-red zip_error"></span></small>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-group-default">
                                                    <label class="control-label">Postal Code</label>
                                                    <input type="text" name="fsa2" class="form-control"
                                                           id="fsa2"
                                                           aria-required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="country" id="country">
                                        <input type="hidden" id="lontude" name="lontude">
                                        <input type="hidden" id="latude" name="latude">

                                        <div class="clearfix"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="padding-20 sm-padding-5 sm-m-b-20 sm-m-t-20 bg-white clearfix">
                                <button aria-label="" class="btn btn-primary btn-cons from-left pull-right btn-fo-next"
                                        type="button" id="next" data-next="step2">
                                    <span>Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="tab-pane slide-left padding-20 sm-no-padding step2" id="tab2">
                            <div class="row row-same-height">
                                <h2>What Type of Service Do you Require ? </h2>
                                <div class="col-md-9">
                                    <div class="padding-30 sm-padding-5">
                                        <div class="menu">
                                            <div class="row m-b-35">
                                                <div class="col-sm-4 overlay-div">
                                                    <a class="showSingle" target="1"
                                                       id="service_one"
                                                       data-service-type="One Time Bulk Service"
                                                       onclick="service(this.id)">
                                                        <img src="{{ URL::asset('assets_new/assets/images/onetime.jpg') }}"
                                                             class="w-100 image">
                                                        <h3>One Time Bulk Shredding</h3>
                                                    </a>
                                                </div>
                                                <div class="col-sm-4 overlay-div">
                                                    <a class="showSingle" target="2"
                                                       id="service_two"
                                                       data-service-type="Drop Off Shredding"
                                                       onclick="service(this.id)">
                                                        <img src="{{ URL::asset('assets_new/assets/images/dropoff.jpg') }}"
                                                             class="w-100 image">
                                                        <h3>Drop Off Shredding</h3>
                                                    </a>
                                                </div>
                                                <div class="col-sm-4 overlay-div">
                                                    <!--a  class="showSingle" target="3"-->
                                                    <a class="showSingle" target="3"
                                                       id="service_three"
                                                       data-service-type="Shredding on a Regular Basis"
                                                       onclick="service(this.id)">
                                                        <img src="{{ URL::asset('assets_new/assets/images/sheduled.jpg') }}"
                                                             class="w-100 image">
                                                        <h3>Scheduled Shredding</h3>
                                                    </a>
                                                </div>
                                                <input type="hidden" value="" name="service_type" id="service_type">
                                                <script>
                                                    function service(link_id) {
                                                        document.getElementById('service_type').value = document.getElementById(link_id).getAttribute('data-service-type');
                                                    }
                                                </script>
                                            </div>
                                            <small><span class="text-red service_type_error"></span></small>
                                        </div>


                                        <section class="cnt">
                                            <div id="div1" class="targetDiv">
                                                <h2>What Type of Shredding Service do you prefer ?</h2>
                                                <div class="row second-selection">
                                                    <div class="col-sm-4 type-box overlay-div">
                                                        <a class="showType" target="1"
                                                           id="shredding_one"
                                                           data-shredding-type="OFF-SITE (Secured Warehouse Shredding)"
                                                           onclick="shredding(this.id)">
                                                            <img src="{{ URL::asset('assets_new/assets/images/sheduled.jpg') }}"
                                                                 class="w-100 image">
                                                            <h3>Secure Plant Shredding </h3>
                                                            <p>Your documents are securely transported to our
                                                                off Site Plant Shredding
                                                                Facility where they are
                                                                destroyed the same day.</p>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-4 type-box overlay-div">
                                                        <a class="showType" target="1"
                                                           id="shredding_two"
                                                           data-shredding-type="ON-SITE (Mobile Shredding)"
                                                           onclick="shredding(this.id)">
                                                            <img src="{{ URL::asset('assets_new/assets/images/sheduled.jpg') }}"
                                                                 class="w-100 image">
                                                            <h3>Mobile Shredding</h3>
                                                            <p>Your documents are
                                                                destroyed on your premises with our mobile Shredding
                                                                Truck
                                                            </p>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-4 type-box overlay-div">
                                                        <a class="showType" target="3"
                                                           id="shredding_three"
                                                           data-shredding-type="No Preference"
                                                           onclick="shredding(this.id)">
                                                            <img src="{{ URL::asset('assets_new/assets/images/sheduled.jpg') }}"
                                                                 class="w-100 image">
                                                            <h3>No Preference</h3>
                                                            <p>We can schedule the earliest available service at the
                                                                Best
                                                                Available Rate</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <small><span class="text-red service_preference_error"></span></small>
                                            </div>
                                            <div id="div2" class="targetDiv">
                                                <h2>What Type of Shredding Service do you prefer ?</h2>
                                                <div class="row second-selection">
                                                    <div class="col-sm-4 type-box overlay-div">
                                                        <a class="showType" target="1"
                                                           id="shredding_one"
                                                           data-shredding-type="OFF-SITE (Secured Warehouse Shredding)"
                                                           onclick="shredding(this.id)">
                                                            <img src="{{ URL::asset('assets_new/assets/images/dropoff.jpg') }}"
                                                                 class="w-100 image">
                                                            <h3>Secure Plant Shredding </h3>
                                                            <p>Your documents are securely transported to our
                                                                off Site Plant Shredding
                                                                Facility where they are
                                                                destroyed the same day.</p>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-4 type-box overlay-div">
                                                        <a class="showType" target="1"
                                                           id="shredding_two"
                                                           data-shredding-type="ON-SITE (Mobile Shredding)"
                                                           onclick="shredding(this.id)">
                                                            <img src="{{ URL::asset('assets_new/assets/images/dropoff.jpg') }}"
                                                                 class="w-100 image">
                                                            <h3>Mobile Shredding</h3>
                                                            <p>Your documents are
                                                                destroyed on your premises with our mobile Shredding
                                                                Truck</p>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-4 type-box overlay-div">
                                                        <a class="showType" target="3"
                                                           id="shredding_three"
                                                           data-shredding-type="No Preference"
                                                           onclick="shredding(this.id)">
                                                            <img src="{{ URL::asset('assets_new/assets/images/dropoff.jpg') }}"
                                                                 class="w-100 image">
                                                            <h3>No Preference</h3>
                                                            <p>We can schedule the earliest available service at the
                                                                Best
                                                                Available Rate</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <small><span class="text-red service_preference_error"></span></small>
                                            </div>
                                            <input type="hidden" value="" name="service_preference"
                                                   id="service_preference">
                                            <script>
                                                function shredding(link_id) {
                                                    document.getElementById('service_preference').value = document.getElementById(link_id).getAttribute('data-shredding-type');
                                                }
                                            </script>
                                            <div id="type1" class="targetType">
                                                <h2 class="mt-3 mb-3">How will you pack your documents ?</h2>
                                                <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                <script>
                                                    $(document).ready(function () {
                                                        $("#boxes-div").click(function () {
                                                            $("#garbage-div").addClass("disable");
                                                            $("#pallets-div").addClass("disable");
                                                            $("#boxes-div").removeClass("disable");
                                                            $("#garbage_bags").val("");
                                                            $("#pallets").val("");
                                                        })

                                                        $("#garbage-div").click(function () {
                                                            $("#boxes-div").addClass("disable");
                                                            $("#pallets-div").addClass("disable");
                                                            $("#garbage-div").removeClass("disable");
                                                            $("#standard_file_boxes").val("");
                                                            $("#pallets").val("");
                                                        })

                                                        $("#pallets-div").click(function () {
                                                            $("#garbage-div").addClass("disable");
                                                            $("#boxes-div").addClass("disable");
                                                            $("#pallets-div").removeClass("disable");
                                                            $("#garbage_bags").val("");
                                                            $("#standard_file_boxes").val("");
                                                        })
                                                    });
                                                </script>
                                                <div class="row second-selection">
                                                    <div class="col-sm-4" id="boxes-div">
                                                        <img src="{{ URL::asset('assets_new/assets/images/file-box.jpg') }}"
                                                             class="w-100 image">
                                                        <div class="box-title ti-h">
                                                            <h3>Standard File Boxes</h3>
                                                            <p>(15"W * 10"D *12"H)</p>
                                                        </div>
                                                        <div class="box-qty">
                                                            <div class="form-group required">
                                                                <label class="control-label">Qty</label>
                                                                <input type="number" name="standard_file_boxes"
                                                                       id="standard_file_boxes" class="form-control"
                                                                       required="" min="0"
                                                                       oninput="this.value = Math.abs(this.value)"
                                                                       aria-required="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 type-box" id="garbage-div">
                                                        <img src="{{ URL::asset('assets_new/assets/images/garbage-bag.jpg') }}"
                                                             class="w-100 image">
                                                        <div class="box-title">
                                                            <h3>Garbage Bags</h3>
                                                        </div>
                                                        <div class="box-qty">
                                                            <div class="form-group required">
                                                                <label class="control-label">Qty</label>
                                                                <input type="number" name="garbage_bags"
                                                                       id="garbage_bags" class="form-control"
                                                                       required="" min="0"
                                                                       oninput="this.value = Math.abs(this.value)"
                                                                       aria-required="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 type-box" id="pallets-div">
                                                        <img src="{{ URL::asset('assets_new/assets/images/plates.jpg') }}"
                                                             class="w-100 image">
                                                        <div class="box-title">
                                                            <h3>Pallets</h3>
                                                        </div>
                                                        <div class="box-qty">
                                                            <div class="form-group required">
                                                                <label class="control-label">Qty</label>
                                                                <input type="number" name="pallets" id="pallets"
                                                                       class="form-control" required=""
                                                                       min="0"
                                                                       oninput="this.value = Math.abs(this.value)"
                                                                       aria-required="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <small><span class="text-red quantity_error"></span></small>
                                            </div>
                                            {{--                                            <div id="type2" class="targetType">--}}
                                            {{--                                                <h2 class="mt-3 mb-3">How will you pack your documents ?</h2>--}}
                                            {{--                                                <div class="row second-selection">--}}
                                            {{--                                                    <div class="col-sm-4">--}}
                                            {{--                                                        <img src="{{ URL::asset('assets_new/assets/images/file-box.jpg') }}"--}}
                                            {{--                                                             class="w-100 image">--}}
                                            {{--                                                        <div class="box-title ti-h">--}}
                                            {{--                                                            <h3>Standard File Boxes</h3>--}}
                                            {{--                                                            <p>(15"W * 10"D *12"H)</p>--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                        <div class="box-qty">--}}
                                            {{--                                                            <div class="form-group required">--}}
                                            {{--                                                                <label class="control-label">Qty</label>--}}
                                            {{--                                                                <input type="number" class="form-control" required=""--}}
                                            {{--                                                                       aria-required="true">--}}
                                            {{--                                                            </div>--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="col-sm-4 type-box">--}}
                                            {{--                                                        <img src="{{ URL::asset('assets_new/assets/images/garbage-bag.jpg') }}"--}}
                                            {{--                                                             class="w-100 image">--}}
                                            {{--                                                        <div class="box-title">--}}
                                            {{--                                                            <h3>Garbage Bags</h3>--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                        <div class="box-qty">--}}
                                            {{--                                                            <div class="form-group required">--}}
                                            {{--                                                                <label class="control-label">Qty</label>--}}
                                            {{--                                                                <input type="number" class="form-control" required=""--}}
                                            {{--                                                                       aria-required="true">--}}
                                            {{--                                                            </div>--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="col-sm-4 type-box">--}}
                                            {{--                                                        <img src="{{ URL::asset('assets_new/assets/images/plates.jpg') }}"--}}
                                            {{--                                                             class="w-100 image">--}}
                                            {{--                                                        <div class="box-title">--}}
                                            {{--                                                            <h3>Pallets</h3>--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                        <div class="box-qty">--}}
                                            {{--                                                            <div class="form-group required">--}}
                                            {{--                                                                <label class="control-label">Qty</label>--}}
                                            {{--                                                                <input type="number" class="form-control" required=""--}}
                                            {{--                                                                       aria-required="true">--}}
                                            {{--                                                            </div>--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            <div id="div3" class="targetDiv">
                                                <div class="form-group boxed mb-1">
                                                    <div class="input-wrapper">
                                                        <h2>What is your preferred Service Frequency ?</h2>
                                                        <select name="service_type_RB"
                                                                class="form-select form-control w-50"
                                                                aria-label="Default select example">
                                                            <option value="Shredding on a Regular Basis Monthly"
                                                                    selected>Monthly
                                                            </option>
                                                            <option value="Shredding on a Regular Basis Weekly">Weekly
                                                            </option>
                                                            <option value="Shredding on a Regular Basis_Call as Needed">
                                                                On Call
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <div class="form-group form-group-default m-t-35">
                                            <label class="control-label">Please provide any other relevant, additional
                                                info</label>
                                            <textarea name="notes" placeholder="Type the here additional info"
                                                      id="notes"
                                                      style="height:100px"
                                                      class="form-control" required=""
                                                      aria-required="true"></textarea>
                                        </div>
                                        <p>IDEAL START DATE</p>
                                        <div class="post-time">
                                            <label class="col-md-3 col-sm-4 col-xs-4 active">
                                                <input type="radio" name="idealstart_date" class="postingtimes"
                                                       value="NOW">
                                                Now
                                            </label>
                                            <label class="col-md-4 col-sm-4 col-xs-4">
                                                <input type="radio" name="idealstart_date" class="postingtimes"
                                                       value="FLEXIBLE">
                                                <span class="visible-xs hidden-md hidden-lg text-center margin-top-5">
                                                    <img style="width:32px;"
                                                         src="{{ URL::asset('home_assets/images/flexibleTime.png') }}"
                                                         alt="I'm flexible" title="I'm flexible">
                                                </span>
                                                <span class="hidden-xs">
                                                    I'm flexible
                                                </span>
                                            </label>
                                            <label class="col-md-5 col-sm-4 col-xs-4" id="specific_date">
                                                <input type="radio" name="idealstart_date" class="postingtimes"
                                                       value="SPECIFIC" id="specific-date">
                                                <span class="visible-xs hidden-md hidden-lg text-center margin-top-5">
                                                    <img style="width:32px;"
                                                         src="{{ URL::asset('home_assets/images/specificDate.png') }}"
                                                         alt="Specific Date" title="Specific Date">
                                                </span>
                                                <span class="hidden-xs">
                                                    Specific Date
                                                </span>
                                            </label>
                                        </div>
                                        <div class="contain post-time-content-outer" id="specific_date_content">
                                            <div class="col-md-12 no-padding">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="date" id="specificpost_date"
                                                               name="specificpost_date"
                                                               class="form-control  hasDatepicker"
                                                               placeholder="Date">
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="col-xs-10 form-control p-l-15 timeline"
                                                                name="am_pm" id="am_pm">
                                                            <option value="AM">AM</option>
                                                            <option value="PM">PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <small><span class="text-red specific_date_error"></span></small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="padding-20 sm-padding-5 sm-m-b-20 sm-m-t-20 bg-white clearfix">
                                <button aria-label="" class="btn btn-primary btn-cons from-left pull-right btn-fo-next"
                                        type="button" id="next" data-next="step3">
                                    <span>Next</span>
                                </button>
                                <button aria-label=""
                                        class="btn btn-default btn-cons from-left pull-right btn-fo-back"
                                        type="button" data-back="step1">
                                    <span>Previous</span>
                                </button>
                            </div>
                        </div>
                        <div class="tab-pane slide-left padding-20 sm-no-padding step3" id="tab3">
                            <div class="row row-same-height">
                                <div class="col-md-7">
                                    <div class="padding-30 sm-padding-5">
                                        <div class="bg-contrast-low padding-30 b-rad-lg">
                                            <div class="form-group form-group-default m-t-25">
                                                <label>Company Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Company"
                                                       required="" name="company" id="company"
                                                       value="<?php echo !empty($_POST['company']) ? $_POST['company'] : ''; ?>">
                                            </div>
                                            <div class="form-group form-group-default required">
                                                <label>First Name</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Enter First Name"
                                                       required="" name="firstname" id="firstname"
                                                       value="<?php echo !empty($_POST['firstname']) ? $_POST['firstname'] : ''; ?>">
                                                <small><span class="text-red firstname_error"></span></small>
                                            </div>
                                            <div class="form-group form-group-default required">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Enter Last Name"
                                                       required="" name="lastname" id="lastname"
                                                       value="<?php echo !empty($_POST['lastname']) ? $_POST['lastname'] : ''; ?>">
                                                <small><span class="text-red lastname_error"></span></small>
                                            </div>
                                            <div class="form-group form-group-default required">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Enter Email"
                                                       required="" name="email" id="email"
                                                       value="<?php echo !empty($_POST['email']) ? $_POST['email'] : ''; ?>">
                                                <small><span class="text-red email_error"></span></small>
                                            </div>
                                            <div class="form-group form-group-default required">
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#phone").usPhoneFormat({
                                                            format: '(xxx) xxx-xxxx',
                                                        });
                                                    });
                                                </script>
                                                <label>Phone</label>
                                                <input type="text" class="form-control" placeholder="Enter Phone"
                                                       required="" name="phone" id="phone"
                                                       value="<?php echo !empty($_POST['phone']) ? $_POST['phone'] : ''; ?>">
                                                <small><span class="text-red phone_error"></span></small>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="padding-20 sm-padding-5 sm-m-b-20 sm-m-t-20 bg-white clearfix">
                                <button aria-label="" class="btn btn-primary btn-cons from-left pull-right btn-fo-next"
                                        type="button" id="next" data-next="step4">
                                    <span>Next</span>
                                </button>
                                <button aria-label=""
                                        class="btn btn-default btn-cons from-left pull-right btn-fo-back"
                                        type="button" data-back="step2">
                                    <span>Previous</span>
                                </button>
                            </div>
                        </div>
                        <div class="tab-pane slide-left padding-20 sm-no-padding step4" id="tab4">
                            <div class="row row-same-height">
                                <div class="col-md-7">
                                    <div class="padding-30 sm-padding-5">
                                        <div class="form-group form-group-default">
                                            <label>Promo Code</label>
                                            <input type="tel" class="form-control" placeholder="Enter Promo Code"
                                                   name="promocode" id="promocode"
                                                   value="<?php echo !empty($_POST['promocode']) ? $_POST['promocode'] : ''; ?>">
                                            <input id="validpromocode" name="validpromocode" type="hidden" value="0">
                                        </div>
                                        <div class="col-sm-8 col-xs-8 promo-message">
                                        </div>
                                        <button aria-label=""
                                                class="btn btn-primary btn-cons btn-animated from-left"
                                                type="button" id="validate-promo">Validate
                                        </button>
                                        <p class="fs-12 m-t-35"><span style="color: red;">*</span> PLEASE ENTER TEXT
                                            FROM IMAGE</p>
                                        <!-- START CAPTCHA -->
                                        <br>
                                        <div class="capbox">
                                            <?php $var = str_random(6); ?>

                                            <div id="CaptchaDiv" onclick="changeText()">{{ $var }}</div>

                                            <div class="capbox-inner">
                                                Type the number:<br>
                                                <input type="text" name="CaptchaInput" id="CaptchaInput"
                                                       size="15"><br>
                                            </div>
                                        </div>
                                        <br><br>
                                        <!-- END CAPTCHA -->
                                        <small><span class="text-red captcha_error"></span></small>
                                    </div>
                                </div>
                            </div>
                            <div class="padding-20 sm-padding-5 sm-m-b-20 sm-m-t-20 bg-white clearfix">
                                <button aria-label=""
                                        class="btn btn-primary btn-cons from-left pull-right btn-fo-next submit"
                                        type="button">
                                    <span>Submit</span>
                                </button>
                                <button aria-label=""
                                        class="btn btn-default btn-cons from-left pull-right btn-fo-back"
                                        type="button" data-back="step3">
                                    <span>Previous</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@stop

@section('footer')
    @include('home.includes.footer_new')
@stop

@section('js')
    <script>
        $(document).on('click', '.post-time label', function () {
            $('.post-time label').removeClass('active');
            $(this).find('.postingtimes').prop("checked", true);
            $(this).addClass('active');
            if ($(this).attr('id') == 'specific_date') {
                $('.post-time-content-outer').show();
            } else
                $('.post-time-content-outer').hide();
        });

    </script>

    <script>
        function changeText() {
            $captcha = generateRandomString(6);
            $("#CaptchaDiv").html($captcha);
        }

        function generateRandomString(length) {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < length; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.targetDiv').hide();
        });
        jQuery(function () {
            jQuery('.showSingle').click(function () {
                jQuery('.targetDiv').hide();
                jQuery('#div' + $(this).attr('target')).show();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.targetType').hide();
        });
        jQuery(function () {
            jQuery('.showType').click(function () {
                jQuery('.targetType').hide();
                jQuery('#type' + $(this).attr('target')).show();
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $('.overlay-div a')
                .click(function (e) {
                    $('.overlay-div a')
                        .removeClass('active');
                    $(this).addClass('active');
                });
            $('#div1 .overlay-div a')
                .click(function (e) {
                    $('#div1 .overlay-div a')
                        .removeClass('active');
                    $(this).addClass('active');
                });
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            $("#validate-promo").click(function (e) {
                e.preventDefault();
                var promocode = $("#promocode").val();
                if (promocode != '') {
                    var data = {
                        _token: null,
                        promocode: promocode
                    };
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/apply-coupon') }}",
                        beforeSend: function (xhr) {
                            var token = $('meta[name="csrf_token"]').attr('content');

                            if (token) {
                                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                            }
                        },
                        data: data,
                        success: function (data) {
                            $('.promo-message').html(data['message']);
                            $('#validpromocode').val(data['status']);

                        }
                    });
                }
                return false;
            });
        });

    </script>
    <script>
        function changeText() {
            $captcha = generateRandomString(6);
            $("#CaptchaDiv").html($captcha);
        }

        function generateRandomString(length) {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < length; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }
    </script>
    <!----------------- javascript for map address--------------------------------------->
    <script type="text/javascript">
        $(document).ready(function () {
            var myLatLng = {
                lat: 47.774241,
                lng: -94.031905
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: myLatLng
            });
            var currCenter = null;

            var placeSearch, autocomplete;
            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'long_name',
                country: 'long_name',
                postal_code: 'short_name'
            };
            var component_map = {
                street_number: 'street_no',
                route: 'address',
                locality: 'city',
                administrative_area_level_1: 'state',
                country: 'country',
                postal_code: 'zip'
            };
            $(document).on("keypress", 'form #autocomplete', function (e) {
                if (e.which == 13) return false;
                if (e.which == 13) e.preventDefault();
            });
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
                //service.getPlacePredictions(request1, callback);//remove if only for CA
                service.getPlacePredictions(request2, callback); //remove if only for US
            });
            $(document).on('click', '.serachwrap li', function () {
                var string = $(this).attr('title');
                $('#autocomplete').val(string);
                var geocd = new google.maps.Geocoder();
                geocd.geocode({
                    "address": string
                }, fillInAddress);
                $('#result').hide();
            });


            function callback(predictions, status) {
                $('#result').html('');
                $('#result').hide();
                var resultData = '';
                if (predictions != '') {
                    for (var i = 0; i < predictions.length; i++) {
                        resultData += '<li title="' + predictions[i].description +
                            '"><i class="fa fa-map-marker"></i>' + predictions[i].description + '</li>';
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

            marker = null;

            function fillInAddress(results, status) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();

                if (marker != null) {
                    marker.setMap(null);
                }
                var point = {
                    lat: latitude,
                    lng: longitude
                };
                marker = new google.maps.Marker({
                    position: point,
                    map: map,
                    title: 'Your location'
                });
                map.setCenter(point);
                currCenter = map.getCenter();
                if (results[0].geometry.viewport)
                    map.fitBounds(results[0].geometry.viewport);
                $('.step1').find('input:not(#autocomplete)').val('');
                $.map(results, function (item) {
                    $('.step1 .map-section').removeClass('col-md-12').addClass('col-md-6');
                    $('.step1 .address-form-block').removeClass('hide');
                    var street_number = "";
                    var route = "";
                    var locality = "";
                    var administrative_area_level_1 = "";
                    var country = "";
                    var postal_code = "";
                    for (var i = 0; i < item.address_components.length; i++) {
                        var addressType = item.address_components[i].types[0];
                        if (componentForm[addressType]) {
                            var val = item.address_components[i][componentForm[addressType]];
                            if (addressType == "street_number") {
                                street_number = val;
                            }
                            if (addressType == "route") {
                                route = val;
                            }
                            if (addressType == "locality") {
                                locality = val;
                            }
                            if (addressType == "administrative_area_level_1") {
                                administrative_area_level_1 = val;
                            }
                            if (addressType == "country") {
                                country = val;
                            }
                            if (addressType == "postal_code") {
                                postal_code = val;
                            }

                        }
                    }
                    document.getElementById("street_no").value = street_number;
                    document.getElementById("country").value = country;
                    if (street_number != "" || route != "") {
                        document.getElementById("address").value = street_number + " " + route;
                    }
                    document.getElementById("state").value = administrative_area_level_1;
                    //document.getElementById("zip").value = postal_code;
                    document.getElementById("city").value = locality;
                    document.getElementById("lontude").value = longitude;
                    document.getElementById("latude").value = latitude;
                    $(function () {
                        $('[name=province] option').filter(function () {
                            return ($(this).text() == administrative_area_level_1);
                        }).prop('selected', true);
                    });
                    if (postal_code) {
                        postal_code_array = postal_code.split(" ");
                        document.getElementById("fsa1").value = postal_code_array[0] == null ? '' :
                            postal_code_array[0];
                        document.getElementById("fsa2").value = postal_code_array[1] == null ? '' :
                            postal_code_array[1];
                    }
                    google.maps.event.trigger(map, 'resize');
                });
            }

            google.maps.event.addListener(map, 'resize', function () {
                map.setCenter(currCenter);
            });
            google.maps.event.addListener(map, 'bounds_changed', function () {
                if (currCenter) {
                    map.setCenter(currCenter);
                }
                currCenter = null;
            });
        });
    </script>

@stop