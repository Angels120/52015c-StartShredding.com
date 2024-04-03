<link class="main-stylesheet" href="{{ URL::asset('home_assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $(document).ready(function()
    {
        $('#updateAddress').on('click', function (e) {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: "POST",
                url: '{{ route('home.updateMultipleAddress.popup',['id' => $edit_address->id])}}',
                data: {
                    'address': $("#pac-input").val(),
                },
                success: function(data) {
                    $("#successMessage").show();
                }
            });
            return false;
        });
    });
</script>
 <style>
.button-bx {
    background-color: #0c1b7a !important;
    color: white !important;
}
</style>
<div id="successMessage" style="display:none;" class="alert alert-success" role="alert"> Address successfully updated.</div>
<div class="row column-seperation">
    <div class="auto-overflow col-lg-12">
        <style>
            .form-group-default .form-control {
                width: 100% !important;
            }
        </style>
        <div class="col-lg-12 col-xl-12 col-xlg-5 p-b-5" style="border-color: black !important">
            <div class="">
                <div class=" widget-11-2-table">
                    <div class="row">
                        <div class="col col-lg-12 form-group-default">
                            <input id="pac-input" class="form-control" type="text" placeholder="Enter a location"
                                   value="{{$edit_address->address}}" autocomplete="off" required><br>
                            <br>
                            <div class="row">
                                <div class="col col-lg-12">
                                    <div id="mapClass" style="height: 300px;width: 100%"></div>
                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places&callback=initMap"
                                            async defer></script>
                                    <script>
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
                                                types: ['geocode'],  // or '(cities)' if that's what you want?
                                                componentRestrictions: {country: ["us", "ca"]}
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
                                            var input = /** @type {!HTMLInputElement} */(
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

                                            autocomplete.addListener('place_changed', function () {
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
                                                    map.setZoom(17);  // Why 17? Because it looks good.
                                                }
                                                marker.setIcon(/** @type {google.maps.Icon} */({
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
                                                $("#latitude").val(item_Lat);
                                                $("#logtitude").val(item_Lng);
                                                $("#location").val(item_Location);
                                                // $("#location1").val(item_Location);

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
                                </div>
                            </div>
                            <input type="hidden" value="{{$street_no}}" name="street" id="street">
                            <input type="hidden" value="{{$city}}" name="city" id="city">
                            <input type="hidden" value="{{$province}}" name="province" id="province">
                            <input type="hidden" value="{{$country}}" name="country" id="country">
                            <input type="hidden" value="{{$zip}}" name="zip" id="zip">
                            <input type="hidden" value="{{$edit_address->address}}" name="address" id="location">
                            <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
                            <input type="hidden" name="latitude" id="latitude" value="{{$edit_address->latitude }}"/>
                            <input type="hidden" name="logtitude" id="longitude" value="{{$edit_address->longitude}}"/>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <button class="btn button-bx btn-cons m-t-10" type="submit" id="updateAddress">UPDATE ADDRESS</button>
        </div>

    </div>
</div>