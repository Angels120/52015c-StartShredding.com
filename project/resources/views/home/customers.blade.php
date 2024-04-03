@extends('home.includes.master',['cart_result'=> $response])

@section('header')
    @include('home.includes.header')
@stop

@section('content')
<?php
if(!isset($_GET['tab_step'])){
    $_GET['tab_step'] = 1;
}
?>
<style>
    .basic-form .col-xs-12 {
        margin-bottom: 6px;
    }
  @media only screen and (max-width: 600px) {
    .step1 #next_btn_1 {
        width:100%;
    }
    .cart-box{
      margin: 0 24% 20%;  
    }

        }
    .add-cart {
        margin-left:unset;
    }
    .cart-box .form-control {
        padding: 0px;
    }
    .button-bx {
    background-color: #0c1b7a !important;
    color: white !important;
}
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script
        src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places">
    </script>
    <script src="{{ URL::asset('assets/map/js/jquery.blockUI.js') }}"></script>

    <?php
    $product_id = Session::get('product_id');
    ?>
    <script type="text/javascript">
        function validateNumber(id, product_id) {
            var number = $('.quantity_' + id).val();

            if (isNaN(number)) {
                alert("Please enter a valid quantity.");
                return false;
            } else {
                toAddCartFromCustomerTable(id, product_id)
            }
        }

        function toAddCartFromCustomerTable(id, product_id) {

            var existing_product_id = '<?= $product_id ?>';
            if (existing_product_id != product_id && existing_product_id != '') {
                alert(
                    'Booking is Restricted to Per one service.  Only select  one service only.  Bookings for Multiple services must be made separately.'
                );
                return false;
            } else {
                var token = {
                    name: '_token',
                    value: $('.token_' + id).val()
                };
                var uniqueid = {
                    name: 'uniqueid',
                    value: $('.uniqueid_' + id).val()
                };
                var quantity = {
                    name: 'quantity',
                    value: $('.quantity_' + id).val()
                };
                var price = {
                    name: 'price',
                    value: $('.price_' + id).val()
                };
                var title = {
                    name: 'title',
                    value: $('.title_' + id).val()
                };
                var product = {
                    name: 'product',
                    value: $('.product_' + id).val()
                };
                var cost = {
                    name: 'cost',
                    value: $('.cost_' + id).val()
                };
                var size = {
                    name: 'size',
                    value: $('.size_' + id).val()
                };
                var product_data = [token, uniqueid, quantity, price, title, product, cost, size];

                $.ajax({
                    type: "POST",
                    url: mainurl + '/cartupdate',
                    data: product_data,
                    success: function(data) {
                        $.ajax({
                            type: "GET",
                            url: mainurl + '/getcartdata',
                            data: {
                                _token: token
                            },
                            success: function(response) {
                                var trows, subtotal, totalTable;
                                $.each(response, function(i, product) {
                                    trows += "<tr><td>" + product.title + "</td>" +
                                        "<td class='text-center'>" +
                                        product.quantity +
                                        "</td>" +
                                        "<td class='text-left'>$" + parseFloat(product.cost)
                                        .toFixed(2) +
                                        "</td>" +
                                        "<td class='text-center'>$" +
                                        parseFloat(product.cost * product.quantity).toFixed(
                                            2) +
                                        "</td>" +
                                        "<td>" +
                                        "<form action='" + mainurl +
                                        '/cartdelete/product/' + product.product +
                                        "' method='GET'>" +
                                        "<input type='hidden' name='_token' value='" +
                                        token + "'>" +
                                        "<button class='fa fa-remove' title='Remove This Item' type='submit' style='margin-top:-5px;'></button>" +
                                        "</form>" +
                                        "</td>" +
                                        "</tr>";
                                });

                                var price = 0,
                                    items = 0,
                                    discount = 0;
                                $.each(response, function(x, item) {
                                    price += item.cost * item.quantity;
                                    items += item.quantity;
                                });

                                if (discount_type === 'fixed') {
                                    discount = price < discount_value ? price : discount_value;
                                } else if (discount_type === 'percent') {
                                    discount = (parseFloat(discount_value) / 100) * parseFloat(
                                        price);
                                }


                                var tax = (price + parseFloat(delivery_fee)) * 0.13;
                                var grandTotal = (parseFloat(round(tax, 2)) + parseFloat(price)) + (
                                        parseFloat(delivery_fee) + parseFloat(donation_amount)) -
                                    parseFloat(discount);

                                $("#cartProductTable").find("#cartproductList").html(trows);
                                if (response.length > 0) {
                                    $("#cartProductTable").find("#cartSummarySubtotal").html('$' +
                                        parseFloat(price).toFixed(2));
                                    $("#cartProductTable").find("#cartSummaryDiscount").html('- $' +
                                        parseFloat(discount).toFixed(2));
                                    $("#cartProductTable").find("#cartSummaryDelivery").html('$' +
                                        parseFloat(delivery_fee).toFixed(2));
                                    $("#cartProductTable").find("#cartSummaryTax").html('$' + round(
                                        tax, 2));
                                    $("#cartProductTable").find("#cartSummaryGrandTotal").html('$' +
                                        parseFloat(grandTotal).toFixed(2));
                                    $("#cartProductTable").find("#cartSummary").removeClass(
                                        'hidden');
                                } else {
                                    $("#cartProductTable").find("#cartSummary").addClass('hidden');
                                }

                                subtotal = "<span class='label'>Total:</span> " +
                                    "<span class='price'>$" + parseFloat(grandTotal).toFixed(2) +
                                    "</span>";

                                $(".cart-subtotal").html('');
                                $(".cart-subtotal").append(subtotal);

                                var tongle = " items &nbsp; | &nbsp;<b> $";

                                $(".top-cart .tongle").html("");
                                $(".top-cart .tongle").append(items + tongle + parseFloat(
                                        grandTotal).toFixed(2) +
                                    "</b> <i class='fa fa-shopping-cart cart-icon' style='margin-top: 0px; padding-top: 0px;'></i>"
                                );

                                var tongleFooter = " ITEMS | <b> $";

                                $(".top-icons .tongle").html("");
                                $(".top-icons .tongle").append(items + tongleFooter + parseFloat(
                                    grandTotal).toFixed(2) + "</b>");
                                window.location.replace(
                                    "{{ url('/customers/products/') }}/" +
                                    product_id);


                            }
                        });
                        $.notify({
                            // options
                            icon: 'fas fa-check',
                            title: '',
                            message: 'Successfully Added to Cart.',
                            // url: 'https://github.com/mouse0270/bootstrap-notify',
                            // target: '_blank'
                        }, {
                            // settings
                            element: 'body',
                            position: null,
                            type: "success",
                            allow_dismiss: true,
                            newest_on_top: true,
                            showProgressbar: false,
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            offset: 20,
                            spacing: 10,
                            z_index: 1031,
                            delay: 5000,
                            timer: 1000,
                            // url_target: '_blank',
                            mouse_over: null,
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            },
                            onShow: null,
                            onShown: null,
                            onClose: null,
                            onClosed: null,
                            icon_type: 'class',
                            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                                '<span data-notify="icon"></span> ' +
                                '<span data-notify="title">{1}</span> ' +
                                '<span data-notify="message" style="font-weight: 600;">{2}</span>' +
                                '</div>'
                        });
                    },
                    error: function(data) {
                        //console.log('Error:', data);
                    }
                });
            }

        }

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


            $('#next_btn_1').click(function() {
                $('.step-pane.step1').removeClass("show");
                $('.step-pane.step1').addClass("hide");
                $('.step-pane.step2').addClass("show");
            });

            $('#prev_btn_1').click(function() {
                $('.step-pane.step2').hide();
                $('.step-pane.step2').removeClass("show");
                $('.step-pane.step1').addClass("show");
            });

            $('#next_btn_2').click(function() {
                $('.step-pane.step2').hide();
                $('.step-pane.step3').removeClass("hide");
            });

            $('#prev_btn_2').click(function() {
                $('.step-pane.step3').addClass("hide");
                $('.step-pane.step2').show();
            });

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

            $(".close-box-button").click(function() {
                $.unblockUI();
            });

        });
    </script>

    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('error') }}
        </div>
    @endif
    <section class="p-b-50 p-t-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div
                            class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12">
                            {{ csrf_field() }}
                            <div class="step-content">
                                <!-- Step 1 Start -->
                               
                                <div class="step-pane step1 @if($_GET['tab_step'] == 2) hide @endif">
                                    <div class="map-section col-md-12 col-sm-12 col-xs-12" style="width: 100% !important;">
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <h3 align="left" style="color: #7934E2"><b>Start Shredding Today!</b></h3>
                                            <p align="left" style="font-size:15px; font-family: 'Montserrat'">Let's Get
                                                Started! <br><br>
                                                In order to provide you with the best and most accurate pricing, we
                                                first
                                                need to know where you are located.
                                            </p>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 map_sec">
                                            <div class="col-xs-12">
                                                <label style="color: darkgray" class="control-label col-sm-3">Step1:
                                                    Enter
                                                    Your Address</label>
                                                <?php
                                                $fullAddress = Session::get('fullAddress');
                                                $onload_product_id = Session::get('product_id');
                                                $fullAddress = $fullAddress ? $fullAddress : '';
                                                $onload_product_id = $onload_product_id ? $onload_product_id : '';
                                                ?>
                                                <div class="col-sm-9">
                                                    <input style="width: 100%" autocomplete="off" id="autocomplete"
                                                        placeholder="Enter address here" type="text"
                                                        value="<?= $fullAddress ?>">
                                                    <?php if($fullAddress) { ?>
                                                    <ul id="result" class="serachwrap" style="display: block;">
                                                        <li title="{{ $fullAddress }}" id="onload_click"><i
                                                                class="fa fa-map-marker"></i>{{ $fullAddress }}</li>
                                                    </ul>
                                                    <?php } ?>
                                                    <script type="text/javascript">
                                                        window.onload = function() {
                                                            <?php
                                                            if($fullAddress){ ?>
                                                            document.getElementById("onload_click").click();
                                                            <?php } if($onload_product_id){ ?>
                                                            var onload_product_id = '{{ $onload_product_id }}';
                                                            var url = '/customers/products/' + onload_product_id;
                                                            $('#next-button').html('<a href="' + url + '" class="btn col-md-6 btn-fo-next col-sm-12 col-xs-12" >NEXT</a>');
                                                            $("#next_btn_2").show();
                                                            <?php  }

                                                            ?>

                                                        };
                                                    </script>
                                                    <ul id="result" class="serachwrap">
                                                    </ul>
                                                </div>
                                                <div id="map"></div>
                                            </div>

                                            <div class="address-form-block col-md-12 col-sm-12 col-xs-12 hide">
                                                <h3>Verify Address</h3>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <label class="control-label col-sm-3" for="address">Address</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="address" id="address"
                                                                placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <label class="control-label col-sm-3" for="address">Country</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="country" id="country"
                                                                placeholder="Country">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <label class="control-label col-sm-3" for="city">City</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="city" id="city" placeholder="City">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <label class="control-label col-sm-3"
                                                            for="province">Province</label>
                                                        <div class="col-sm-9">
                                                            <select name="province" class="form-control"
                                                                placeholder="Province" id="province">
                                                                <option value="">Select Province</option>
                                                                <option value="Alberta">Alberta</option>
                                                                <option value="British Columbia">British Columbia
                                                                </option>
                                                                <option value="Manitoba">Manitoba</option>
                                                                <option value="New Brunswick">New Brunswick</option>
                                                                <option value="Newfoundland">Newfoundland</option>
                                                                <option value="Northwest Territorie">Northwest
                                                                    Territorie
                                                                </option>
                                                                <option value="Nova Scotia">Nova Scotia</option>
                                                                <option value="Nunavut">Nunavut</option>
                                                                <option value="Ontario">Ontario</option>
                                                                <option value="Prince Edward Island">Prince Edward
                                                                    Island
                                                                </option>
                                                                <option value="Quebec">Quebec</option>
                                                                <option value="Saskatchewan">Saskatchewan</option>
                                                                <option value="Yukon">Yukon</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <label class="control-label col-sm-3" for="postalcode">Postal
                                                            Code</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <input type="text" name="zip1" maxlength="3" id="zip1"
                                                                        placeholder="">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input type="text" name="zip2" maxlength="3" id="zip2"
                                                                        placeholder="">
                                                                </div>
                                                                <input type="hidden" class="form-control" name="street_no"
                                                                    id="street_no" value="">
                                                                <input type="hidden" class="form-control" name="country"
                                                                    id="country" value="">
                                                                <input type="hidden" class="form-control" name="address"
                                                                    id="address" value="">
                                                                <input type="hidden" class="form-control" name="state"
                                                                    id="state" value="">
                                                                <input type="hidden" class="form-control" name="zip"
                                                                    id="zip" value="">
                                                                <input type="hidden" class="form-control" name="city"
                                                                    id="city" value="">
                                                                <input type="hidden" class="form-control" name="latude"
                                                                    id="latude" value="">
                                                                <input type="hidden" class="form-control" name="lontude"
                                                                    id="lontude" value="">
                                                                <input type="hidden" class="form-control"
                                                                    name="fullAddress" id="fullAddress" value="">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12" align="center">
                                                <button type="button" data-next="step2" id="next_btn_1"
                                                    class="btn btn-fo-next btn-next hide">NEXT<i
                                                        class="icon-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Step 1 End -->

                                <!-- Step 2 Start -->
                                <div class="step-pane step2 hide @if($_GET['tab_step'] == 2) show @endif" >
                                    <div class="col-md-12 col-sm-12 col-xs-12 border_sec" style="width: 100% !important;">
                                        <div class="col-xs-12 col-sm-12 col-md-12 " align="left">
                                            <p style="color: darkgray"><b>Step 2: SELECT SERVICE AND QUANTITY</b></p>
                                            <p>Please enter the quantity of File Boxes. If your documents are not in file
                                                boxes, please transfer them into garbage bags and Select the ‘Bags’ option
                                            </p>
                                        </div>

                                        <div class="row">
                                            <!-- START POST -->
                                            <div class="row">
                                                @if (count($products) > 0)
                                                    @foreach ($products as $key => $pro)
                                                        <div align="center"
                                                            class="col-xs-12 col-sm-6 col-md-4 m-t-10 hover-push-pro">
                                                            <div style="border: 1px solid #000;">
                                                                @if ($pro->title)
                                                                    <h4 align="center"><b>
                                                                            @if ($pro->type == 2)
                                                                                {{ 'null' }}
                                                                            @else
                                                                                {{ $pro->title }}
                                                                            @endif
                                                                        </b></h4>
                                                                    <div class="post-card-cover">

                                                                        @if ($pro->feature_image)
                                                                            <img style="width:270px;height:200px"
                                                                                src="{{ URL::asset('assets/images/products/' . $pro->feature_image) }}">
                                                                        @else
                                                                            <img style="width:270px;height:200px"
                                                                                src="{{ URL::asset('shop_assets/images/placeholder-image.png') }}">
                                                                        @endif
                                                                    </div>
                                                                    <script>
                                                                        $(function() {
                                                                            $("#AddToCart{{ $key }}").on('click', function() {
                                                                                var product_id = $('.product_{{ $key }}').val();
                                                                                var url = '/customers/products/' + product_id;
                                                                                $('#next-button').html('<a href="' + url + '" class="btn btn-success" >Next</a>');
                                                                                $("#next_btn_2").show();
                                                                            });
                                                                        });
                                                                    </script>
                                                                    <p class="h3-text-blue m-t-5" align="center"
                                                                        style="
                                                                                       height: 50px;font-family: 'Montserrat';color: #134c89;font-size: 12px;">
                                                                        <?php echo substr($pro->description, 0, 100) . ' '; ?>
                                                                    </p>
                                                                    <form action="{{ route('home.order.addSession') }}"
                                                                        method="post">
                                                                        {{ csrf_field() }}
                                                                        <div class="m-t-15" align="center">
                                                                            <div class="cart-product-count">
                                                                                <div class="input-group">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-sm-12 col-xs-12 cart-box" >
                                                                                        <div class="col-md-5 col-sm-12 col-xs-2 m-b-2" >
                                                                                        <input type="hidden"
                                                                                            name="product_id"
                                                                                            value="{{ $pro->id }}">
                                                                                        <input
                                                                                            class="number quantity_{{ $key }} form-control input-number btn-default-focus"
                                                                                            type='text' name="quantity" 
                                                                                            id='{{ $key }}'
                                                                                            value='1' style="float:left;">
                                                                                        </div>  
                                                                                        <div class="col-md-7 col-sm-12 col-xs-4" >
                                                                                        <select class="form-control"
                                                                                            name="type" 
                                                                                            style="float:right; width:75px;">
                                                                                            <?php
                                                                                            $types = App\ProductType::get();
                                                                                        
                                                                                            ?>
                                                                                            @foreach ($types as $type)
                                                                                                <option
                                                                                                    value="{{ $type->id }}" >
                                                                                                    {{ $type->type }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        </div>  
                                                                                        <?php
                                                                        
                                                                        $product_id = Session::get('product_id');
                                                                        if (isset($product_id)) {
                                                                            $disabled = $product_id != $pro->id ? 'disabled=""' : '';
                                                                        } else {
                                                                            $disabled = '';
                                                                        }
                                                                        
                                                                        ?>
                                                                        <div class="col-md-12 col-sm-12 col-xs-12 m-t-5" align="center">
                                                                           
                                                                            <button type="submit" 
                                                                                class="add-cart  btn button-bx btn-next"
                                                                                style="border: 1px solid #000;"> ADD TO CART</button>

                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                      
                                                                    </form>
                                                                    <br />
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                        <h3 style="color: red"><b>No products found...</b></h3>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="col-xs-12 col-sm-12 col-md-5"></div> 
                                            <div class="col-xs-12 col-sm-12 col-md-2 m-t-30">
                                            <div>  
                                            <button type="button" id="prev_btn_1" class="btn btn-fo-back  btn-prev col-md-12 col-sm-12 col-xs-12">BACK</button>
                                            </div>
                                            <div id="next-button">
                                                <button type="button" id="next_btn_2" class="btn col-md-12 btn-fo-next col-sm-12 col-xs-12"
                                                    style="display: none;">NEXT
                                                </button>
                                             </div>
                                            

                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-5"></div>
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
    </section>

    <section class="p-b-65 p-t-20 bg-menu-blue">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xs-12 col-sm-6 col-md-4">
                    <h1 class="text-white"><b>TRUSTED</b></h1>
                    <p class="text-white fs-14">We are the proven document
                        <br>shredding service company. Trusted
                        <br>by small businesses and enterprises to
                        <br>securely destroy confidential
                        <br>information in a timely and cost
                        <br>effective manner.
                    </p>
                </div>
                <div class="col-12 col-xs-12 col-sm-6 col-md-8 star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Off Site Shredding -->
    <section class="p-b-40 p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="m-t-5 light">City Shredding Service</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                    <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris
                        nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                        qui
                        officia
                        deserunt mollit anim id est laborum.</p>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    <img class="p-r-40 m-t-10 xs-image-responsive-height sm-no-padding"
                        src="{{ url('home_assets/images/color_wheel.png') }}" alt="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h2 class="m-t-25 light">Our Service Areas</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                    <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor
                        incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris
                        nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                        qui
                        officia
                        deserunt mollit anim id est laborum.</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                    <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor
                        incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris
                        nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                        qui
                        officia
                        deserunt mollit anim id est laborum.</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                    <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor
                        incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris
                        nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                        qui
                        officia
                        deserunt mollit anim id est laborum.</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                    <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor
                        incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris
                        nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum
                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                        qui
                        officia
                        deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <hr class="double">
        </div>
    </section>
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
                $.map(results, function(item) {
                    //$('.step1 .map-section').removeClass('col-md-12').addClass('col-md-6');
                    $('.step1 .map_sec #next_btn_1').removeClass('hide');
                    var street_number = "";
                    var route = "";
                    var locality = "";
                    var administrative_area_level_1 = "";
                    var country = "";
                    var postal_code = "";
                    var formatted_address = item.formatted_address;
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

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: '<?php echo route('home.save.address'); ?>',
                        data: {
                            'country': country,
                            'street': street_number,
                            'address': street_number + " " + route,
                            'city': locality,
                            'province': administrative_area_level_1,
                            'zip': postal_code,
                            'lontude': longitude,
                            'latitude': latitude,
                            'fullAddress': formatted_address,

                        },
                        success: function(data) {

                        }
                    });

                    $(function() {
                        $('[name=province] option').filter(function() {
                            return ($(this).text() == administrative_area_level_1);
                        }).prop('selected', true);
                    });
                    if (postal_code) {
                        postal_code_array = postal_code.split(" ");
                        document.getElementById("zip").value = postal_code_array[0] == null ? '' :
                            postal_code_array[0];
                        document.getElementById("zip2").value = postal_code_array[1] == null ? '' :
                            postal_code_array[1];
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
    @include('home.includes.footer')
@stop
