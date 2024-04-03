@extends('home.includes.master',['cart_result'=> $response])

@section('header')
    @include('home.includes.header')
@stop
@section('content')
    <style>
        .logo {
            margin-top: 26px;
        }
        .login-btn:hover
        {
            color: #0059B2;
        }
        .field-icon
        {
            float: right;
            position: relative;
            z-index: 2;
            top: -24px;
            left: -7px;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <section class="p-b-65 p-t-50 m-t-30">
        <div class="container">
            <div class="row">
                <div class="col-sm-2 col-xs-12 hidden-xs col-sm-offset-2">
                    <div class="text-right">
                    
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="newAccount-area">
                        <h2 class="signIn-title">Create a new Customer account</h2>
                        <hr/>

                        @if ($message = Session::get('message'))
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($errors->has('name'))
                            <div class="alert alert-danger alert-dismissable">
                                <strong>* {{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                        @if ($errors->has('email'))
                            <div class="alert alert-danger alert-dismissable">
                                <strong>* {{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                        @if ($errors->has('password'))
                            <div class="alert alert-danger alert-dismissable">
                                <strong>* {{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                        @if ($errors->has('address'))
                            <div class="alert alert-danger alert-dismissable">
                                <strong>* {{ $errors->first('address') }}</strong>
                            </div>
                        @endif
                        @if ($errors->has('phone'))
                            <div class="alert alert-danger alert-dismissable">
                                <strong>* {{ $errors->first('phone') }}</strong>
                            </div>
                        @endif
                        @if ($errors->has('giftcode'))
                            <div class="alert alert-danger alert-dismissable">
                                <strong>* {{ $errors->first('giftcode') }}</strong>
                            </div>
                        @endif
                        <form action="{{route('home.register.submit')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="is_activated" value="1">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="reg_name">First Name <span>*</span></label>
                                    <input class="form-control" value="{{ old('first_name') }}" type="text"
                                           name="first_name" id="first_name" required autocomplete="off">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="reg_name">Last Name <span>*</span></label>
                                    <input class="form-control" value="{{ old('last_name') }}" type="text"
                                           name="last_name" id="last_name" required="" autocomplete="off">
                                    <input class="form-control" type="hidden" value="register" name="page" id="page"
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="reg_email">Email Address<span>*</span></label>
                                    <input class="form-control" value="{{ old('email') }}" type="email" name="email"
                                           id="reg_email" required autocomplete="off">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="reg_Pnumber">Phone Number <span>*</span></label>
                                    {{--<input class="form-control" type="text" name="phone" id="reg_Pnumber" required>--}}
                                    <input id="yourphone" class="form-control" value="{{ old('phone') }}" type="text"
                                           name="phone" required autocomplete="off">
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-12 form-group">
                                    <label for="reg_Pnumber">Address <span>*</span></label>
                                    {{--<input class="form-control" type="text" name="address" id="address" required>--}}
                                    <input name="address" id="pac-input" class="form-control" type="text"
                                           placeholder="Enter a location" value="{{ Session::get('address')}}" required
                                           autocomplete="off" >
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-6 form-group">--}}
{{--                                    <label for="unit_no">Suite/Unit#</label>--}}
{{--                                    <input class="form-control" value="{{ old('unit_no') }}" type="number"--}}
{{--                                           name="unit_no"--}}
{{--                                           id="unit_no" autocomplete="off">--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-6 form-group">--}}
{{--                                    <label for="buzz_code">Buzz Code</label>--}}
{{--                                    --}}{{--<input class="form-control" type="text" name="phone" id="reg_Pnumber" required>--}}
{{--                                    <input id="buzz_code" class="form-control" value="{{ old('buzz_code') }}"--}}
{{--                                           type="number"--}}
{{--                                           name="buzz_code" autocomplete="off">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="reg_password">Password <span>*</span></label>
                                    <input class="form-control" type="password" name="password" id="reg_password"
                                           required autocomplete="off">
                                    <span toggle="#reg_password"
                                          class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="confirm_password">Confirm Password <span>*</span></label>
                                    <input class="form-control" type="password" name="password_confirmation"
                                           id="confirm_password" required autocomplete="off">
                                    <span toggle="#confirm_password"
                                          class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                            </div>
                            <hr>
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-6 form-group promolabel">--}}
{{--                                    <label for="signup_code" style="margin-top:5px;">Referral Code--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-6 form-group">--}}
{{--                                    @php--}}
{{--                                        $code = null;--}}
{{--                                        if(request()->has('ref')){--}}
{{--                                        $code = request()->get('ref');--}}
{{--                                        }--}}
{{--                                    @endphp--}}
{{--                                    <input class="form-control" value="{{ $code }}" type="text" name="signup_code"--}}
{{--                                           id="signup_code">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <hr>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-6 form-group promolabel">--}}
{{--                                    <label for="signup_code" style="margin-top:5px;">Gift Code--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-6 form-group">--}}
{{--                                    <input class="form-control"--}}
{{--                                           value="{{ !$errors->has('giftcode') && request()->has('giftcode') ? request()->get('giftcode') : null }}"--}}
{{--                                           type="text" name="giftcode"--}}
{{--                                           id="giftcode" {{ !$errors->has('giftcode') && request()->has('giftcode') ? "" : null }}>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="btn btn-md login-btn" id="sign-btn" type="submit" value="SIGN UP">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                        <a href="{{route('home.user')}}">Already Have Account?</a>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="" name="lat" id="lat">
                            <input type="hidden" value="" name="lng" id="lng">
                            <input type="hidden" value="" name="address" id="location">
                            <input class="field" value="" name="route" id="route" type="hidden"/>
                            <input class="field" value="" name="locality" id="locality" type="hidden"/>
                            <input class="field" value="" name="administrative_area_level_1"
                                   id="administrative_area_level_1" type="hidden"/>
                            <input class="field" value="" name="country" id="country" type="hidden"/>
                            <input class="field" name="postal_code" id="postal_code" type="hidden"/>
                            <input class="field" name="street_number" id="street_number" type="hidden"/>
                            <div id="map" style="height: 300px;width: 100%" hidden></div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer')
    @include('home.shop.includes.footer')
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places&callback=initMap"
            async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(".toggle-password").click(function () {

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
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 55.585901,
                    lng: -105.750596
                },
                zoom: 5
            });
            var options = {
                types: ['geocode'],  // or '(cities)' if that's what you want?
                componentRestrictions: {country: ["us", "ca"]}
            };
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
            //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

            var autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function () {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
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
                //alert("Lat= "+item_Lat+"_____Lang="+item_Lng+"_____Location="+item_Location);
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
                /*radioButton.addEventListener('click', function() {
                autocomplete.setTypes(types);
                });*/
            }

            setupClickListener('changetype-all', []);
            setupClickListener('changetype-address', ['address']);
            setupClickListener('changetype-establishment', ['establishment']);
            setupClickListener('changetype-geocode', ['geocode']);
        }
    </script>
    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(51.508742, -0.120850),
                zoom: 5,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
    </script>
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.js')}}"></script>
    <script>
        jQuery(function ($) {
            $("#yourphone").mask("(999) 999 - 9999");

        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form', function () {
                $('#sign-btn').attr('disabled', 'disabled');
            });
        });
    </script>


@stop
