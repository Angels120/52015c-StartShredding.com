@extends('vendor.includes.master-vendor')

@section('content')

<link href="{{ URL::asset('assets/map/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/map/css/custom.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/map/css/font-awesome.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places"></script>
<style>
    .blockUI {
        z-index: 1011;
        position: absolute !important;
    }
</style>
<script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
<!--<script src="{{ URL::asset('assets/map/js/bootstrap3.3.4.min.js')}}"></script>-->
<script src="{{ URL::asset('assets/map/js/jquery.blockUI.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $.blockUI.defaults = {

            message: '&lt;h1&gt;Please wait...&lt;/h1&gt;',

            title: null,

            draggable: true,

            theme: false,

            css: {
                padding: 0,
                margin: 0,
                width: '45%',
                top: '10%',
                left: '30%',
                textAlign: 'center',
                color: '#000',
                border: '3px solid #aaa',
                backgroundColor: '#fff'
                //cursor: 'wait'
            },

            themedCSS: {
                width: '30%',
                top: '40%',
                left: '35%'
            },

            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.6
                //cursor: 'wait'
            },

            cursorReset: 'default',

            growlCSS: {
                width: '350px',
                top: '10px',
                left: '',
                right: '10px',
                border: 'none',
                padding: '5px',
                opacity: 0.6,
                cursor: null,
                color: '#fff',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px'
            },

            iframeSrc: /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank',

            forceIframe: false,

            baseZ: 1000,

            centerX: true,

            centerY: true,

            allowBodyStretch: true,

            bindEvents: true,

            constrainTabKey: true,

            fadeIn: 200,

            fadeOut: 400,

            timeout: 0,

            showOverlay: true,

            focusInput: true,

            onBlock: null,

            onUnblock: null,

            quirksmodeOffsetHack: 4,

            blockMsgClass: 'blockMsg',

            ignoreIfBlocked: false
        };



        /*$('.btn-next').click(function(){
            var next_step = $(this).data('next');
            if(next_step == "step2"){
                $('.step-pane.step1').hide();
                $("li[data-target='step1']").removeClass('active');
                $('.step-pane.step2').show();
                $("li[data-target='step2']").addClass('active');
            }
        });*/

        $('.js-select_button').click(function() {
            var next_step = $(this).data('next');
            if (next_step == "step2") {
                $('.step-pane.step1').hide();
                $("li[data-target='step1']").removeClass('active');
                $('.step-pane.step2').show();
                $("li[data-target='step2']").addClass('active');
            }
        });

        $('.btn-prev').click(function() {
            var prev_step = $(this).data('prev');
            if (prev_step == "step1") {
                $('.step-pane.step2').hide();
                $("li[data-target='step2']").removeClass('active');
                $('.step-pane.step1').show();
                $("li[data-target='step1']").addClass('active');
            }
        });

        $('#txt_search_by_name').keypress(function(e) {

            var search_length = $(this).val().trim().length;

            var key = e.which;
            if (key == 13) {
                if (search_length < 3) {
                    $('.resultsMessage').show();
                    $(".resultsTable").hide();
                } else {
                    $.ajax({
                        type: "GET",
                        url: '',
                        data: {
                            'keyword': $(this).val()
                        },
                        success: function(data) {
                            $('.resultsMessage').hide();
                            $(".resultsTable").show();
                            $(".resultsTable").html(data);
                        }
                    });
                }
            }
        });

        $('#txt_search_by_phone').keypress(function(e) {

            var search_length = $(this).val().trim().length;

            var key = e.which;
            if (key == 13) {
                if (search_length < 3) {
                    $('.resultsMessage').show();
                    $(".resultsTable").hide();
                } else {
                    $.ajax({
                        type: "GET",
                        url: '',
                        data: {
                            'phone': $(this).val()
                        },
                        success: function(data) {
                            $('.resultsMessage').hide();
                            $(".resultsTable").show();
                            $(".resultsTable").html(data);
                        }
                    });
                }
            }
        });

        $('#doSearch').click(function() {
            var search_name_length = $('#txt_search_by_name').val().trim().length;
            var search_phone_length = $('#txt_search_by_phone').val().trim().length;
            if (search_name_length < 3 && search_phone_length < 3) {
                $('.resultsMessage').show();
                $(".resultsTable").hide();
            } else {
                $.ajax({
                    type: "GET",
                    url: '<?php echo route('get_ajax_search_client'); ?>',
                    data: {
                        'keyword': $('#txt_search_by_name').val(),
                        'phone': $('#txt_search_by_phone').val()
                    },
                    success: function(data) {
                        $('.resultsMessage').hide();
                        $(".resultsTable").show();
                        $(".resultsTable").html(data);
                    }
                });
            }
        });

        $(".close-box-button").click(function() {
            $.unblockUI();
        });

        $("#zip").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#zip2').focus();
            }
        });

        $("#txt_fsa1").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#txt_fsa2').focus();
            }
        });

        $("#phone1").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#phone2').focus();
            }
        });

        $("#phone2").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#phone3').focus();
            }
        });

        $("#txt_phone1").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#txt_phone2').focus();
            }
        });

        $("#txt_phone2").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#txt_phone3').focus();
            }
        });
    });

    function openEditPopup(client_id) {
        $.ajax({
            type: "GET",
            url: '<?php echo url('/vendor/customer/get_ajax_client'); ?>',
            data: {
                'client_id': client_id
            },
            success: function(data) {
                var client = JSON.parse(data);
                $('#hf_client_id').val(client['id']);
                $('#txt_business_name').val(client['business_name']);
                $('#txt_first_name').val(client['first_name']);
                $('#txt_last_name').val(client['last_name']);
                $('#txt_gender').val(client['gender']);
                $('#txt_email').val(client['email']);
                //$('#txt_phone').val(client['PHONE']);
                $('#txt_phone1').val(client['phone'].substring(0, 3));
                $('#txt_phone2').val(client['phone'].substring(3, 6));
                $('#txt_phone3').val(client['phone'].substring(6, 10));
                $('#txt_address').val(client['address']);
                $('#txt_country').val(client['Country']);
                $('#txt_city').val(client['city']);
                $('#cmb_province').val(client['Province_State']);
                $('#txt_fsa1').val(client['zip'].substring(0, 3));
                $('#txt_fsa2').val(client['zip'].substring(3, 6));
                $.blockUI({
                    message: $('#updateCustomerForm')
                });
            }
        });
    }

    function selectClient(client_id) {
        var url = "<?php echo url('/vendor/order'); ?>?client_id=" + client_id + "&action=";
        window.location = url;
        /*$('.step-pane.step1').hide();
        $("li[data-target='step1']").removeClass('active');
        $('.step-pane.step2').show();
        $("li[data-target='step2']").addClass('active');*/
    }
</script>

@if(Session::has('message'))
<div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('message') }}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('error') }}
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="boxed no-padding">
                <div class="inner">
                    <div id="wizard-form" class="wizard">
                        <ul class="steps">
                            <li data-target="step1" class="active">Customer<span class="chevron"></span></li>
                            <!-- <li data-target="step2"><span class="badge">2</span>Services<span class="chevron"></span></li>
                            <li data-target="step3"><span class="badge">3</span>Confirm<span class="chevron"></span></li> -->
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <form method="post" action="{{ route('vendor.customer_add') }}" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12 customer_left_portion">
                                        <div class="customer_right_top col-md-12">
                                            <div class="img"><img src="http://kiosk.shredex.net/resources/assets/image/add-client.png"></div>
                                            <h2 class="Client_title">New Customer</h2>
                                            <p>Use Customer's Address</p>
                                        </div>
                                        {{ csrf_field() }}
                                        <div class="step-content">
                                            <!-- Step 1 Start -->
                                            <div class="step-pane step1">
                                                <div class="map-section col-md-12 col-sm-12 col-xs-12" style="width: 100% !important;">
                                                    <div id="locationField">
                                                        <input autocomplete="off" id="autocomplete" placeholder="Enter address here" type="text">
                                                        </input>
                                                        <ul id="result" class="serachwrap">
                                                        </ul>
                                                    </div>
                                                    <div id="map"></div>
                                                </div>
                                                <div class="address-form-block col-md-12 col-sm-12 col-xs-12 hide">
                                                    <h3>Verify Address</h3>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <label for="ClientBusinessName" class="control-label col-sm-3">Business Name</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="business_name" id="business_name" placeholder="Business Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="unit">First Name *</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="unit">Last Name *</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="province">Gender *</label>
                                                            <div class="col-sm-9">
                                                                <select name="gender" class="form-control" placeholder="Gender" id="gender">
                                                                    <option value="">Select Gender</option>
                                                                    <option value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="city">E-mail *</label>
                                                            <div class="col-sm-9">
                                                                <input type="email" name="email" id="email" placeholder="E-mail" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="phone">Phone *</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="phone1" id="phone1" maxlength="3" placeholder="000" required>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="phone2" id="phone2" maxlength="3" placeholder="000" required>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="phone3" id="phone3" maxlength="4" placeholder="0000" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="address">Address</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="address" id="address" placeholder="Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="address">Country</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="country" id="country" placeholder="Country">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="city">City</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="city" id="city" placeholder="City">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="province">Province</label>
                                                            <div class="col-sm-9">
                                                                <select name="province" class="form-control" placeholder="Province" id="province">
                                                                    <option value="">Select Province</option>
                                                                    <option value="Alberta">Alberta</option>
                                                                    <option value="British Columbia">British Columbia</option>
                                                                    <option value="Manitoba">Manitoba</option>
                                                                    <option value="New Brunswick">New Brunswick</option>
                                                                    <option value="Newfoundland">Newfoundland</option>
                                                                    <option value="Northwest Territorie">Northwest Territorie</option>
                                                                    <option value="Nova Scotia">Nova Scotia</option>
                                                                    <option value="Nunavut">Nunavut</option>
                                                                    <option value="Ontario">Ontario</option>
                                                                    <option value="Prince Edward Island">Prince Edward Island</option>
                                                                    <option value="Quebec">Quebec</option>
                                                                    <option value="Saskatchewan">Saskatchewan</option>
                                                                    <option value="Yukon">Yukon</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="postalcode">Postal Code</label>
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <input type="text" name="zip1" maxlength="3" id="zip1" placeholder="">
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <input type="text" name="zip2" maxlength="3" id="zip2" placeholder="">
                                                                    </div>
                                                                    <input type="hidden" class="form-control" name="lontude" id="lontude">
                                                                    <input type="hidden" class="form-control" name="latude" id="latude">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-right col-xs-12">
                                                            <div class="actions col-xs-12">
                                                                <button type="submit" data-next="step2" id="btnCreateClient" class="btn btn-success btn-next">Create<i class="icon-arrow-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!------>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 basic-form" style="overflow: hidden;">
                                <div class="customer_right_top" style="padding: 5px 10px 0 10px !important;margin: 30px 0 !important;">
                                    <div class="img"><img src="http://kiosk.shredex.net/resources/assets/image/exit-client.png"></div>
                                    <h2 class="Client_title">Existing Clients</h2>
                                    <p>Use any one of the following filters to search for an existing client</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row" style="margin-bottom: 30px;">
                                            <div class="col-lg-12">
                                                <label for="ClientQ">Enter Client First and Last Name or Company Name</label>
                                                <div class="input-group">
                                                    <input name="txt_search_by_name" class="form-control" placeholder="Search" autocomplete="off" type="text" id="txt_search_by_name" style="margin:0px; border-right: 0;">
                                                    <span class="input-group-btn"><label class="btn btn-default search-icon"><i class="fa fa-search"></i></label></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" style="margin-top: 30px;">
                                                <label for="ClientQ">Search By Phone Number</label>
                                                <div class="input-group">
                                                    <input name="txt_search_by_phone" class="form-control" placeholder="Search" autocomplete="off" type="text" id="txt_search_by_phone" style="margin:0px; border-right: 0;">
                                                    <span class="input-group-btn"><label class="btn btn-default search-icon"><i class="fa fa-search"></i></label></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center" style="margin-top: 20px;">
                                                <button type="button" id="doSearch" class="lnk-change-pwd btn btn-success fr btn-client-srch">Search</button>
                                            </div>
                                        </div>
                                        <div class="resultsMessage" style="display: none;">Query should contain minimum 3 characters</div>
                                        <div class="resultsTable" style="display: none; overflow-x: scroll; height: 500px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">On Site</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Off Site</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="blockUI blockMsg blockPage" style="z-index: 1011; display:none;position: absolute !important;" id="updateCustomerForm">
    <div class="background-container">
        <h3 style="text-align:center;">Edit Customer</h3>
        <form action="{{ route('vendor.customer_update') }}" role="form" class="form-horizontal" id="ClientHomeForm" method="post" accept-charset="utf-8">
            {{ csrf_field() }}
            <div class="col-sm-10">
                <input type="hidden" name="hf_client_id" class="form-control" id="hf_client_id" value="">
            </div>
            <div class="form-group">
                <label for="BUSINESS_NAME" class="col-sm-4 control-label">Business Name</label>
                <div class="col-sm-7">
                    <input name="txt_business_name" class="form-control" placeholder="Business Name" id="txt_business_name" type="text">
                </div>
            </div>
            <div class="form-group">
                <label for="CONTACT_FIRST_NAME" class="col-sm-4 control-label">First Name *</label>
                <div class="col-sm-7">
                    <input name="txt_first_name" class="form-control" placeholder="First Name" id="txt_first_name" required type="text">
                </div>
            </div>
            <div class="form-group">
                <label for="CONTACT_LAST_NAME" class="col-sm-4 control-label">Last Name *</label>
                <div class="col-sm-7">
                    <input name="txt_last_name" class="form-control" placeholder="Last Name" id="txt_last_name" required type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="province">Gender *</label>
                <div class="col-sm-7">
                    <select name="txt_gender" class="form-control" placeholder="Gender" id="txt_gender">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="EMAIL" class="col-sm-4 control-label">E-mail *</label>
                <div class="col-sm-7">
                    <input name="txt_email" class="form-control" placeholder="Email" required id="txt_email" type="email">
                </div>
            </div>
            <div class="form-group">
                <label for="PHONE" class="col-sm-4 control-label">Phone</label>
                <div class="col-sm-2">
                    <input name="txt_phone1" class="form-control" maxlength="3" placeholder="000" id="txt_phone1" type="phone">
                </div>
                <div class="col-sm-2">
                    <input name="txt_phone2" class="form-control" maxlength="3" placeholder="000" id="txt_phone2" type="phone">
                </div>
                <div class="col-sm-3">
                    <input name="txt_phone3" class="form-control" maxlength="4" placeholder="0000" id="txt_phone3" type="phone">
                </div>
            </div>
            <div class="form-group">
                <label for="STREET_ADDR1" class="col-sm-4 control-label">Address</label>
                <div class="col-sm-7">
                    <input name="txt_address" class="form-control" placeholder="Address" id="txt_address" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="address">Country</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="txt_country" id="txt_country" placeholder="Country">
                </div>
            </div>
            <div class="form-group">
                <label for="CITY" class="col-sm-4 control-label">City</label>
                <div class="col-sm-7">
                    <input name="txt_city" class="form-control" placeholder="City" id="txt_city" type="text">
                </div>
            </div>
            <div class="form-group">
                <label for="PROVINCE" class="col-sm-4 control-label">Province</label>
                <div class="col-sm-7">
                    <select name="cmb_province" class="form-control" placeholder="Province" id="cmb_province">
                        <option value="">Select Province</option>
                        <option value="Alberta">Alberta</option>
                        <option value="British Columbia">British Columbia</option>
                        <option value="Manitoba">Manitoba</option>
                        <option value="New Brunswick">New Brunswick</option>
                        <option value="Newfoundland">Newfoundland</option>
                        <option value="Northwest Territorie">Northwest Territorie</option>
                        <option value="Nova Scotia">Nova Scotia</option>
                        <option value="Nunavut">Nunavut</option>
                        <option value="Ontario">Ontario</option>
                        <option value="Prince Edward Island">Prince Edward Island</option>
                        <option value="Quebec">Quebec</option>
                        <option value="Saskatchewan">Saskatchewan</option>
                        <option value="Yukon">Yukon</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-sm-4 control-label">
                    <label for="ClientPostalCode1">Postal Code</label>
                </div>
                <div class="col-sm-2">
                    <input name="txt_fsa1" class="form-control" maxlength="3" id="txt_fsa1" type="text">
                </div>
                <div class="col-sm-2">
                    <input name="txt_fsa2" class="form-control" maxlength="3" id="txt_fsa2" type="text">
                </div>
            </div>
            <button class="btn btn-inverse close-box-button" type="reset">Cancel</button>
            &nbsp;
            <button class="btn btn-success" type="submit">Update</button>
            <div class="form-group"></div>
        </form>
    </div>
</div>
<!----------------- javascript for map address--------------------------------------->
<script type="text/javascript">
    $(document).ready(function() {
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
        $(document).on("keypress", 'form #autocomplete', function(e) {
            if (e.which == 13) return false;
            if (e.which == 13) e.preventDefault();
        });
        $("#autocomplete").on("keyup", function(e) {
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
        $(document).on('click', '.serachwrap li', function() {
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
                    resultData += '<li title="' + predictions[i].description + '"><i class="fa fa-map-marker"></i>' + predictions[i].description + '</li>';
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
            $.map(results, function(item) {
                //console.log(JSON.stringify(results));
                /*$('#address').val(item.address_components[0]['long_name']);
                $('#city').val(item.address_components[1]['long_name']);*/
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
                        //alert(addressType+"->"+component_map[addressType]);
                        //document.getElementById(component_map[addressType]).value = val;
                    }
                }
                document.getElementById("country").value = country;
                document.getElementById("address").value = street_number + " " + route;
                document.getElementById("city").value = locality;
                document.getElementById("lontude").value = longitude;
                document.getElementById("latude").value = latitude;
                $(function() {
                    $('[name=province] option').filter(function() {
                        return ($(this).text() == administrative_area_level_1);
                    }).prop('selected', true);
                });
                if (postal_code) {
                    postal_code_array = postal_code.split(" ");
                    document.getElementById("zip").value = postal_code_array[0] == null ? '' : postal_code_array[0];
                    document.getElementById("zip2").value = postal_code_array[1] == null ? '' : postal_code_array[1];
                }
                google.maps.event.trigger(map, 'resize');
            });
        }
        google.maps.event.addListener(map, 'resize', function() {
            map.setCenter(currCenter);
        });
        google.maps.event.addListener(map, 'bounds_changed', function() {
            if (currCenter) {
                map.setCenter(currCenter);
            }
            currCenter = null;
        });
    });
</script>
@stop

@section('footer')

@stop