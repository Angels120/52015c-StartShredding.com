@extends('home.shop.includes.master',['cart_result'=> $response])
@section('header')
    @include('home.includes.header')
@stop
@section('content')
    <link rel="stylesheet" href="{{ URL::asset('assets2/css/summary.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets2/css/cart.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">


    <script>
        $(function() {
            $("#tabs").tabs();
        });
    </script>
    <style type="text/css">
        .field-icon {
            float: right;
            position: relative;
            z-index: 2;
            top: -24px;
            left: -7px;
        }
        .ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button
        {
            font-family:unset;
            font-size: unset;
        }

    </style>

    <?php
    $price = 0;
    $items = 0;
    foreach ($response as $res) {
        $price += $res->cost * $res->quantity;
        $items += $res->quantity;
    }
    $discount = 0;
    if (Session::has('coupon')) {
        $discount = App\Coupon::calculateDiscount(Session::get('coupon'), $price);
    }
    $setting = DB::select('select * from settings where id=1');
    $delivery_fee = $setting[0]->delivery_fee;
    $donation_amount = $setting[0]->donation_amount;
    ?>

    <section class="p-b-65 p-t-100 m-t-20">
        <div class="container">
            <div class="row">

                <div class="container-fluid">
                    <!-- Starting of product filter area -->
                    <div class="section-padding product-filter-wrapper wow fadeInUp">

                        <div class="container inner-block">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-7">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>* {{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>* {{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                            @if (Session::has('message'))
                                                <div class="alert alert-success alert-dismissable">
                                                    <a href="#" class="close" data-dismiss="alert"
                                                        aria-label="close">&times;</a>
                                                    {{ Session::get('message') }}
                                                </div>
                                            @endif
                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger alert-dismissable">
                                                    <a href="#" class="close" data-dismiss="alert"
                                                        aria-label="close">&times;</a>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div id="tabs">
                                                <ul>
                                                    <li>
                                                        <a href="#tabs-1">New Customers</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#tabs-2"> Sign In</a>
                                                    </li>
                                                </ul>
                                                <div id="tabs-2">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row"></div>
                                                            <h4 class="sec-title">Existing Customers</h4>
                                                            <form action="{{ route('home.login.submit') }}" method="POST">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label for="email">Email Address
                                                                        <span>*</span></label>
                                                                    <input class="form-control"
                                                                        value="{{ old('email') }}" type="email"
                                                                        name="email" id="email1" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password">Password
                                                                        <span>*</span></label>
                                                                    <input class="form-control" type="password"
                                                                        name="password" id="password" required> <span toggle="#password"
                                                                        class="fa fa-fw fa-eye field-icon toggle-password">
                                                                    <input class="form-control" type="hidden"
                                                                        value="shopsummary" name="page" id="page1" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input class="btn login-btn" type="submit"
                                                                        value="LOGIN">
                                                                </div>
                                                                <div class="form-group">
                                                                    <a href="{{ route('home.forgotpass') }}"
                                                                        target="_blank" style="color: #0000FF;">Forgot
                                                                        your
                                                                        Password?</a>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="tabs-1">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="sec-title">Your Personal Details</h4>
                                                            <form action="{{ route('home.register.submit.order') }}"
                                                                method="post">

                                                                {{ csrf_field() }}
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="first_name">First Name
                                                                                <span>*</span></label>
                                                                            <input class="form-control"
                                                                                value="{{ old('first_name') }}"
                                                                                type="text" name="first_name"
                                                                                id="first_name" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="last_name">Last Name
                                                                                <span>*</span></label>
                                                                            <input class="form-control"
                                                                                value="{{ old('last_name') }}"
                                                                                type="text" name="last_name" id="last_name"
                                                                                required="">
                                                                            <input class="form-control" type="hidden"
                                                                                value="shopsummary" name="page" id="page"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="email">Email Address
                                                                                <span>*</span></label>
                                                                            <input class="form-control"
                                                                                value="{{ old('email') }}" type="email"
                                                                                name="email" id="email" required=""
                                                                                autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="phone">Phone
                                                                                <span>*</span></label>
                                                                            <input id="yourphone" class="form-control"
                                                                                value="{{ old('phone') }}" type="text"
                                                                                name="phone" id="phone" required="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="reg_password">Password<span>*</span></label>
                                                                            <input class="form-control" type="password"
                                                                                name="password" id="reg_password" required>
                                                                            <span toggle="#reg_password"
                                                                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="confirm_password">Confirm
                                                                                Password<span>*</span></label>
                                                                            <input class="form-control" type="password"
                                                                                name="password_confirmation"
                                                                                id="confirm_password" required>
                                                                            <span toggle="#confirm_password"
                                                                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col col-lg-12">
                                                                        <?php
                                                                        $fullAddress = Session::get('fullAddress');
                                                                        $fullAddress = $fullAddress ? $fullAddress : '';
                                                                        ?>
                                                                        <input id="pac-input" class="form-control"
                                                                            type="text" placeholder="Enter a location"
                                                                            value="{{ $fullAddress }}" autocomplete="off"
                                                                            required><br>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col col-lg-12">
                                                                        <div id="mapClass"
                                                                            style="height: 300px;width: 100%"></div>
                                                                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places&callback=initMap"
                                                                                                                                                async defer></script>

                                                                        <script>
                                                                            $(".toggle-password").click(function() {

                                                                                var input = $($(this).attr("toggle"));
                                                                                if (input.attr("type") == "password") {
                                                                                    input.attr("type", "text");
                                                                                    $(this).toggleClass("far fa-eye-slash");
                                                                                } else {
                                                                                    input.attr("type", "password");
                                                                                    $(this).toggleClass("far fa-eye");
                                                                                }
                                                                            });

                                                                            function initMap() {
                                                                                var latt = 43.667754;
                                                                                var long = -79.497566;

                                                                                if (document.getElementById("latitude").value) {
                                                                                    latt = document.getElementById("latitude").value;
                                                                                    long = document.getElementById("longitude").value;
                                                                                }

                                                                                var latitude = parseFloat(latt);
                                                                                var longitude = parseFloat(long);

                                                                                // The location of Uluru
                                                                                var uluru = {
                                                                                    lat: latitude,
                                                                                    lng: longitude
                                                                                };
                                                                                var map = new google.maps.Map(
                                                                                    document.getElementById('mapClass'), {
                                                                                        zoom: 10,
                                                                                        center: uluru
                                                                                    });

                                                                                var options = {
                                                                                    types: ['geocode'], // or '(cities)' if that's what you want?
                                                                                    componentRestrictions: {
                                                                                        country: ["us", "ca"]
                                                                                    }
                                                                                };
                                                                                var marker = new google.maps.Marker({
                                                                                    position: uluru,
                                                                                    map: map
                                                                                });
                                                                                var componentForm = {
                                                                                    street_number: 'short_name',
                                                                                    route: 'long_name',
                                                                                    locality: 'long_name',
                                                                                    administrative_area_level_1: 'short_name',
                                                                                    country: 'long_name',
                                                                                    postal_code: 'short_name'
                                                                                };
                                                                                var input = /** @type {!HTMLInputElement} */ (
                                                                                    document.getElementById('pac-input'));
                                                                                var types = document.getElementById('type-selector');
                                                                                map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

                                                                                var autocomplete = new google.maps.places.Autocomplete(input, options);
                                                                                autocomplete.bindTo('bounds', map);

                                                                                var infowindow = new google.maps.InfoWindow();
                                                                                var marker = new google.maps.Marker({
                                                                                    map: map,
                                                                                    anchorPoint: new google.maps.Point(0, -29)
                                                                                });

                                                                                autocomplete.addListener('place_changed', function() {
                                                                                    infowindow.close();
                                                                                    marker.setVisible(false);
                                                                                    var place = autocomplete.getPlace();

                                                                                    if (!place.geometry) {
                                                                                        window.alert("No details available for input: '" + place.name + "'");
                                                                                        return;
                                                                                    }

                                                                                    // If the place has a geometry, then present it on a map.
                                                                                    if (place.geometry.viewport) {
                                                                                        map.fitBounds(place.geometry.viewport);
                                                                                    } else {
                                                                                        map.setCenter(place.geometry.location);
                                                                                        map.setZoom(17); // Why 17? Because it looks good.
                                                                                    }
                                                                                    marker.setIcon( /** @type {google.maps.Icon} */ ({
                                                                                        url: place.icon,
                                                                                        size: new google.maps.Size(71, 71),
                                                                                        origin: new google.maps.Point(0, 0),
                                                                                        anchor: new google.maps.Point(17, 34),
                                                                                        scaledSize: new google.maps.Size(35, 35)
                                                                                    }));
                                                                                    marker.setPosition(place.geometry.location);
                                                                                    marker.setVisible(true);
                                                                                    var item_Lat = place.geometry.location.lat()
                                                                                    var item_Lng = place.geometry.location.lng()
                                                                                    var item_Location = place.formatted_address;
                                                                                    $("#lat").val(item_Lat);
                                                                                    $("#lng").val(item_Lng);
                                                                                    $("#location").val(item_Location);
                                                                                    $("#location1").val(item_Location);

                                                                                    var address = '';
                                                                                    if (place.address_components) {
                                                                                        address = [
                                                                                            (place.address_components[0] && place.address_components[0].short_name || ''),
                                                                                            (place.address_components[1] && place.address_components[1].short_name || ''),
                                                                                            (place.address_components[2] && place.address_components[2].short_name || '')
                                                                                        ].join(' ');
                                                                                    }
                                                                                    for (var component in componentForm) {
                                                                                        document.getElementById(component).value = '';
                                                                                        document.getElementById(component).disabled = false;
                                                                                    }
                                                                                    // Get each component of the address from the place details,
                                                                                    // and then fill-in the corresponding field on the form.
                                                                                    for (var i = 0; i < place.address_components.length; i++) {
                                                                                        var addressType = place.address_components[i].types[0];
                                                                                        if (componentForm[addressType]) {
                                                                                            var val = place.address_components[i][componentForm[addressType]];
                                                                                            document.getElementById(addressType).value = val;
                                                                                        }
                                                                                    }
                                                                                    //console.log(val);
                                                                                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                                                                                    infowindow.open(map, marker);
                                                                                });

                                                                                // Sets a listener on a radio button to change the filter type on Places
                                                                                // Autocomplete.
                                                                                function setupClickListener(id, types) {
                                                                                    var radioButton = document.getElementById(id);
                                                                                }

                                                                                setupClickListener('changetype-all', []);
                                                                                setupClickListener('changetype-address', ['address']);
                                                                                setupClickListener('changetype-establishment', ['establishment']);
                                                                                setupClickListener('changetype-geocode', ['geocode']);
                                                                            }
                                                                        </script>
                                                                        <br>
                                                                        <?php
                                                                        $lontude = Session::get('lontude');
                                                                        $latitude = Session::get('latitude');
                                                                        $street_no = Session::get('street_no');
                                                                        $city = Session::get('city');
                                                                        $province = Session::get('province');
                                                                        $country = Session::get('shop_country');
                                                                        $zip = Session::get('zip');
                                                                        $fullAddress = Session::get('fullAddress');
                                                                        
                                                                        ?>
                                                                        <input type="hidden" value="{{ $latitude }}"
                                                                            name="latitude" id="latitude">
                                                                        <input type="hidden" value="{{ $lontude }}"
                                                                            name="lontude" id="lontude">
                                                                        <input type="hidden" value="{{ $street_no }}"
                                                                            name="street" id="street">
                                                                        <input type="hidden" value="{{ $city }}"
                                                                            name="city" id="city">
                                                                        <input type="hidden" value="{{ $province }}"
                                                                            name="province" id="province">
                                                                        <input type="hidden" value="{{ $country }}"
                                                                            name="country" id="country">
                                                                        <input type="hidden" value="{{ $zip }}"
                                                                            name="zip" id="zip">
                                                                        <input type="hidden" value="{{ $fullAddress }}"
                                                                            name="address" id="location">
                                                                        <input type="hidden" name="uniqueid"
                                                                            value="{{ Session::get('uniqueid') }}">

                                                                    </div>

                                                                    <table id="address" hidden>
                                                                        <tr>
                                                                            <td class="label">Street address</td>
                                                                            <td class="slimField"><input
                                                                                    class="field"
                                                                                    name="street_number" id="street_number"
                                                                                    disabled="true" />
                                                                            </td>
                                                                            <td class="wideField" colspan="2"><input
                                                                                    class="field"
                                                                                    value="{{ old('route') }}"
                                                                                    name="route" id="route"
                                                                                    disabled="true" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="label">City</td>
                                                                            <td class="wideField" colspan="3"><input
                                                                                    class="field"
                                                                                    value="{{ old('locality') }}"
                                                                                    name="locality" id="locality"
                                                                                    disabled="true" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="label">State</td>
                                                                            <td class="slimField"><input
                                                                                    class="field"
                                                                                    value="{{ old('administrative_area_level_1') }}"
                                                                                    name="administrative_area_level_1"
                                                                                    id="administrative_area_level_1"
                                                                                    disabled="true" />
                                                                            </td>
                                                                            <td class="label">Zip code</td>
                                                                            <td class="wideField"><input
                                                                                    class="field"
                                                                                    name="postal_code" id="postal_code"
                                                                                    disabled="true" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="label">Country</td>
                                                                            <td class="wideField" colspan="3"><input
                                                                                    class="field"
                                                                                    value="{{ old('country') }}"
                                                                                    name="country" id="country"
                                                                                    disabled="true" /></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>

                                                                <div class="form-group" style="text-align:center;">
                                                                    <br>
                                                                    <input class="btn btn-fo-next" type="submit"
                                                                        value="CONTINUE" >
                                                                </div>
                                                            </form>
                                                            <input type="hidden" name="latitude" id="latitude"
                                                                value="{{ Session::get('latitude') }}" />
                                                            <input type="hidden" name="logtitude" id="longitude"
                                                                value="{{ Session::get('lontude') }}" />

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div id="tableArea">
                                                @if ($response->count() == 0)
                                                    <div class="text-center" id="emptyCart">
                                                        Hey! Looks like your cart is empty, Please add some products!
                                                        <br>
                                                        <a href="{{ url('/customers') }}"><i
                                                                class="fa fa-cart-arrow-down"></i></a>
                                                    </div>
                                                @else
                                                    <table id="productTable" class="table table-striped tabele-bordered"
                                                        style="margin-top:20px;">
                                                        <thead>
                                                            <tr style="text-transform: uppercase;">
                                                                <th>Item</th>
                                                                <th class="text-center">QTY</th>
                                                                <th class="text-left">Rate</th>
                                                                <th class="text-center">Total</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody style="font-size: 12px;">
                                                            @foreach ($response as $res)
                                                                <tr style="font-weight: 700;">
                                                                    <td>
                                                                        {{ $res->title }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{ $res->quantity }}
                                                                    </td>
                                                                    <td class="text-left">${{ number_format((float) $res->cost, 2, '.', '') }}
                                                                    </td>
                                                                    <td class="text-center">${{ number_format((float) $res->cost * $res->quantity, 2, '.', '') }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr style="background-color:#ffffff;">
                                                                <td colspan="5">
                                                                    <table id="totalTable">
                                                                        <tr>
                                                                            <td style="float:right; font-weight: 500;">
                                                                                <b> Subtotal :&nbsp;</b>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <b>${{ number_format((float) $price, 2, '.', '') }}</b>
                                                                            </td>
                                                                        </tr>
                                                                        @if (Session::has('coupon'))
                                                                            <tr>
                                                                                <td style="float:right">
                                                                                    Discount :&nbsp;
                                                                                </td>
                                                                                <td class="text-right">
                                                                                    -${{ number_format((float) $discount, 2, '.', '') }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                        <tr>
                                                                            <td style="float:right">
                                                                                Shipping :&nbsp;
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <?php
                                                                                $setting = DB::select('select * from settings where id=1');
                                                                                $delivery_fee = $setting[0]->delivery_fee;
                                                                                ?>
                                                                                ${{ number_format((float) $delivery_fee, 2, '.', '') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="float:right">
                                                                                Tax (13%) :&nbsp;
                                                                            </td>
                                                                            <td class="text-right">
                                                                                ${{ number_format(((float) ($price + $delivery_fee) * 13) / 100, 2, '.', '') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="float:right">
                                                                                <span style='float:right'
                                                                                    class="makeittext"
                                                                                    data-toggle="popover" title=""
                                                                                    data-content="Help Us Make A Difference!
        Your small micro donation will go towards providing free services and programs for Mental Health.  In addition, this Merchant will also generously match your donation. <br> <br> <a href='{{ route('home.makeitcount') }}' target='_blank' title='test add link'><b style=''>Click Here</b> </a> to learn more about this program
        and the Janeen Foundation" data-original-title="Make It Count">Make It Count <img class='makeitcounticon'
                                                                                        src='{{ url('assets/img/makeitcounticon.png') }}'>
                                                                                    :&nbsp;</span>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                ${{ number_format((float) $donation_amount, 2, '.', '') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="line" style="float:right">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="line"  style="float:right; ">
                                                                                <b>Grand Total :&nbsp;</b>
                                                                            </td>
                                                                            <td class="line text-right">
                                                                                <b>${{ number_format(((float) ($price + $delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}</b>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr style="background-color:#ffffff;">
                                                                <td colspan="4">
                                                                    <div class="card" style="padding: 10px;">
                                                                        <div class="card-body">
                                                                            @if (!Session::has('coupon'))
                                                                                <h5 class="card-title all-caps">Have a
                                                                                    Coupon Code?</h5>
                                                                                <form
                                                                                    action="{{ route('home.coupon.apply') }}"
                                                                                    method="POST">
                                                                                    {{ csrf_field() }}
                                                                                    <div class="form-group">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            id="coupon_code"
                                                                                            name="coupon_code"
                                                                                            placeholder="Coupon Code"
                                                                                            required>
                                                                                    </div>
                                                                                    <div style="text-align:center;">
                                                                                        <button type="submit"
                                                                                            class="btn apply-btn">Apply
                                                                                        </button>
                                                                                    </div>

                                                                                </form>
                                                                            @else
                                                                                <h5 class="card-title">Coupon Applied
                                                                                </h5>
                                                                                <form class="form-inline"
                                                                                    action="{{ route('home.coupon.remove') }}"
                                                                                    method="POST">
                                                                                    {{ csrf_field() }}
                                                                                    {{ method_field('delete') }}
                                                                                    <div class="form-group">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            id="coupon_code"
                                                                                            name="coupon_code"
                                                                                            placeholder="Coupon Code"
                                                                                            value="{{ Session::get('coupon')['code'] }}"
                                                                                            readonly>
                                                                                    </div>
                                                                                    <div style="text-align:center;">
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger"
                                                                                            style="justify: center;">Remove
                                                                                        </button>
                                                                                    </div>
                                                                                </form>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                @endif
                                                </tbody>

                                                </table>
                                                {{-- @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Ending of product filter area -->
            </div>
        </div>
        </div>
    </section>
    <!--  <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> -->
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.js') }}"></script>
    <script type="text/javascript">
        window.onload = function() {
            document.getElementById("onload_click").click();
        };
    </script>

    <script>
        incrementVar = 1;

        function incrementValue(elem) {
            var $this = $(elem);
            $input = $this.prev('input');
            $parent = $input.closest('div');
            newValue = parseInt($input.val()) + 1;
            $parent.find('.inc').addClass('a' + newValue);
            $input.val(newValue);
            incrementVar += newValue;
        }

        function decrementValue(elem) {
            var $this = $(elem);
            $input = $this.next('input');
            $parent = $input.closest('div');
            newValue = parseInt($input.val()) - 1;
            $parent.find('.inc').addClass('a' + newValue);
            if (newValue <= 1) {
                $input.val(1);
            } else {
                $input.val(newValue);
            }
            incrementVar += newValue;
        }
    </script>
    <script>
        jQuery(function($) {
            $("#yourphone").mask("(999) 999 - 9999");

        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('#sign-btn').attr('disabled', 'disabled');
            });
        });
    </script>
@stop
@section('footer')
    @include('home.includes.footer')
@stop
