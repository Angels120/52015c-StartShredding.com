@extends('home.shop.includes.master',['cart_result'=> $response])
@section('header')
@include('home.shop.includes.header')
<link rel="stylesheet" href="{{ URL::asset('assets2/css/product.css')}}">
@stop
@section('content')
<!-- BEGIN INTRO CONTENT -->
<section class="p-b-65 p-t-100 m-t-50">
    <div class="container">
        <div class="row">

            @if(count($products)>0)
                @foreach($products as $key => $pro)
            <div align="center" class="col-xs-12 col-sm-6 col-md-4 m-t-10 hover-push-pro">
                <div>
                @if($pro->title)
                        <a  href="{{ url('/shop-product/'.$pro->id.'/'.str_slug(str_replace(' ', '-', $pro->title))) }}">
                            @if($pro->feature_image)
                                <img style="width:300px;height:250px" src="{{ URL::asset('assets/images/products/'.$pro->feature_image) }}">
                            @else
                                <img style="width:300px;height:250px" src="{{ URL::asset('shop_assets/images/placeholder-image.png') }}">
                            @endif
                        </a>
                        <h6 class="h3-text-blue m-t-30" align="center" style="font-family: 'Montserrat';font-weight: 600;color: #134c89;font-size: 15px;">
                            <a class="h3-text-blue" href="{{ url('/shop-product/'.$pro->id.'/'.str_slug(str_replace(' ', '-', $pro->title))) }}">{{$pro->title}}</a>
                        </h6>
                    <h5 class="font-montserrat no-margin" style="color: #134c89;"><b>{{"$ ".number_format($pro->price, 2)}}</b></h5>
                    <div class="m-t-15" align="center">
                        <div class="cart-product-count">
                            <div class="input-group">
                                <span class="input-group-btn">
                                        <input type='hidden' class='token_{{ $key }}' name='token' value='{{csrf_token()}}'>
                                        <input type='hidden' class='uniqueid_{{ $key }}' name='uniqueid' value='{{ Session::get('uniqueid') }}'>
                                        <input type='hidden' class='price_{{ $key }}' name='price' value='{{ number_format((float)$pro->price, 2, '.', '') }}'>
                                        <input type='hidden' class='title_{{ $key }}' name='title'  value='{{ str_replace(' ', '-', strtolower($pro->title)) }}'>
                                        <input type='hidden' class='product_{{ $key }}' name='product' value='{{ $pro->id }}'>
                                        <input type='hidden' class='cost_{{ $key }}' name='cost' value='{{ $pro->price }}'>
                                        <input type='hidden' class='discount_type_{{ $key }}' name='discount_type' value=''>
                                        <input type='hidden' class='size_{{ $key }}' name='size'>
                                        <a href="#!" style="cursor: pointer;" class="btn btn-default btn-number" onclick="decrementValue({{$key}})" >
                                            <span class="glyphicon glyphicon-minus" ></span>
                                        </a>
                                </span>
                                <input class="number quantity_{{ $key }} form-control input-number"  type='text'  id='{{ $key }}' value='1' min="1" max="10" disabled>
                                <span class="input-group-btn">
                                   <a href="#!" style="cursor: pointer;" class="btn btn-default btn-number" onclick="incrementValue({{$key}})">
                                            <span class="glyphicon glyphicon-plus" ></span>
                                   </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-15" align="center">
                        <a href="#!" onclick="toAddCartFromTable({{$key}})" class="add-cart btn btn-default"><i class="fa fa-cart-plus"></i>&nbsp;ADD TO
                            CART</a> &nbsp;
                    </div>
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
        <div class="row m-t-50">
            <div class="col-md-12" align="center">
                <a href="{{ url('/shop/3') }}" type="button" style="color: white;background: #134c89;" class="btn btn-default">BACK</a>&nbsp;&nbsp;
                <a href="{{ url('/shop-cart') }}" style="color: white;background: #134c89;" class="btn btn-default">VIEW CART</a>&nbsp;&nbsp;
                @if(!Auth::guard('profile')->user())
                    <a href="{{url('/shop-order-summary')}}" style="color: white;background: #2fb207;" class="btn btn-default">CHECKOUT</a>
                @else
                    <a href="{{url('/shop-order-confirm')}}" style="color: white;background: #2fb207;" class="btn btn-default">CHECKOUT</a>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- END INTRO CONTENT -->

<section class="p-b-65 p-t-50 m-t-30 bg-master-dark" id="aboutUs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <h2 class="text-white fs-24">About Us</h2>
                <p class="text-white fs-13" style="font-family: 'Open Sans', Arial, sans-serif;">
                    We are a LICENSED Manufacturer and Distributor of Medical Face Masks, by Health Canada.
                    <br><br>
                    Based out of Toronto, our mandate is to provide our clients across Canada and the USA with
                    high quality personal protection equipment at the best value and in a timely manner.
                </p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <h2 class="text-white fs-24">OUR MISSION</h2>
                <p class="text-white fs-13" style="font-family: 'Open Sans', Arial, sans-serif;">
                    We are committed to building a national inventory of medical masks that can be fulfilled to meet
                    end-user demand at any given time.
                    <br><br>
                    Our distribution network will ensure medical and long-term care facilities have an ample supply
                    of personal protection equipment during a crisis event. We are in this together.
                </p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 p-t-100" align="center">
                <h4 class="text-white" style="font-family: 'Montserrat';text-transform: uppercase;"><b>We Stand on
                        Guard for Thee</b></h4>
            </div>
        </div>
    </div>
</section>

<!-- Off Site Shredding -->
<section class="p-b-40 p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="m-t-5 fs-24">Protectica: Canada’s Choice for Personal Protection Equipment (PPE)</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4" align="center">
                <img class="m-t-30 xs-image-responsive-height sm-no-padding" src="{{ URL::asset('shop_assets/images/dr1.JPG') }}" alt="">
                <br><br>
                <p class="fs-15" style="width: 300px;">
                    Each day, more and more Canadians choose Protectica Masks and
                    Sanitizers as a safeguard from air and water borne pollutants
                    and diseases.
                </p>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <h6 class="block-title"><b>CANADIAN MADE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class="m-t-15 fs-15">
                    Protectica is committed to supporting the public health and government repose to the
                    Coronoavirus. Masks and Sanitizers produced in Canada are manufactured under stricter and
                    controlled conditions, accelerating lead times, and resulting in peace of mind. Buying Canadian
                    also supports the local economy.
                </p>
                <h6 class="block-title m-t-50"><b>SUPERIOR QUALITY</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class="m-t-15 fs-15">
                    Protectica masks are made from high quality materials, providing the sought-after combination of
                    comfort and protection. All of our medical masks meet X Standards and come in a wide variety of
                    styles to suit personal preferences and clinical requirements. Protectica masks are highly
                    breathable, comfortable, hypoallergenic and latex-free.
                </p>
                <h6 class="block-title m-t-50"><b>SATISFACTION GUARANTEED</b><i class="pg-arrow_right m-l-20"></i>
                </h6>
                <p class="m-t-15 fs-15">
                    We are commited to providing only the highest quality products. Each purchase comes
                    with a money back guarantee against defects.
                </p>
            </div>
        </div>
        <hr class="double">
    </div>

    <div class="container p-t-20">
        <div class="row">
            <div class="col-md-12">
                <h4 class="m-t-5 fs-24">Hand Sanitizers: Better Hygiene, Better Health</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <h6 class="block-title"><b>ANTIBACTERIAL DEFENSE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class="m-t-15 fs-15">
                    Protectica Sanitizers are made with 75% Alcohol content, which is a proven defense against
                    bacteria and viruses. Regular application of a hand sanitizer helps prevent the spread of
                    contagious diseases.
                </p>
                <h6 class="block-title m-t-50"><b>BEST VALUE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class="m-t-15 fs-15">
                    Protectica manufactures and sells direct to consumers to save you money. With the increased
                    demand for hand sanitizer, and the growing importance of hand hygiene, buying direct is the
                    smart choice.
                </p>
                <h6 class="block-title m-t-50"><b>COMMUNITY SUPPORT</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class="m-t-15 fs-15">
                    For every bottle of hand sanitizer sold, we will donate one bottle to a local NPO or long-term
                    living facility.
                </p>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4" align="center">
                <img class="p-r-40 m-t-10 hidden-xs" src="{{ URL::asset('shop_assets/images/sanica_handsanitizer.png') }}" alt="">
                <img class="p-r-40 m-t-10 visible-xs" src="{{ URL::asset('shop_assets/images/sanica_handsanitizer_mobile.png') }}" alt="">
                <br>
                <p class="m-t-15 fs-15">
                    Regular use of Sanica hand sanitizer is an important part of good hand hygiene. Sanica hand
                    sanitizer removes dirt and germs without antibacterial ingredients or harsh preservatives.
                </p>
            </div>
        </div>
        <hr class="double">
    </div>

    <div class="container p-t-20">
        <div class="row">
            <div class="col-md-12">
                <h4 class="m-t-5 fs-24">Masks and Hand Hygiene: An Essential Part of the New Normal</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <p class="m-t-15 fs-15">
                    It is generally an accepted standard set by government health agencies that wearing masks, in
                    combination with proper hand hygiene that includes sanitizers, contribute to the defense against
                    infectious diseases. Protectica delivers the ideal combination of effective protection from
                    germs and safety for people and the environment. We develop well-being solutions for personal
                    protection–solutions that result in healthier people and a healthy environment at all times.
                </p>
            </div>

            <div class="m-t-15 col-xs-12 col-sm-6 col-md-4" align="center">
                <img class="p-r-40 m-t-10 xs-image-responsive-height sm-no-padding" src="{{ URL::asset('shop_assets/images/masks.JPG') }}" alt="">
            </div>
        </div>
        <br>

        <div class="row p-t-20">
            <div class="col-md-12">
                <h4 class="m-t-5">In The News: Face Masks and Hand Sanitizers</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <a href="https://www.bbc.com/future/article/20200504-coronavirus-what-is-the-best-kind-of-face-mask" target="_blank"><u>Why We should be wearing face masks: Face masks are a symbol of the pandemic
                        era – a visual
                        metaphor for the tiny, unseen viral foe that could be lurking around any corner. </u></a>
                <h6 class="block-title"><a href="https://www.bbc.com/future/article/20200504-coronavirus-what-is-the-best-kind-of-face-mask" target="_blank">READ MORE</a></h6>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <a href="https://www.healthing.ca/diseases-and-conditions/coronavirus/not-all-face-masks-are-created-equal-what-you-need-to-know-to-help-prevent-covid-19" target="_blank"><u>Canada’s chief public health officer, advised that non-medical masks help
                        prevent the spread
                        of COVID-19 by people who don’t know they have it.</u></a>
                <h6 class="block-title"><a href="https://www.healthing.ca/diseases-and-conditions/coronavirus/not-all-face-masks-are-created-equal-what-you-need-to-know-to-help-prevent-covid-19" target="_blank">READ MORE</a></h6>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <a href="https://www.medicalnewstoday.com/articles/covid-19-hand-sanitizers-inactivate-novel-coronavirus-study-finds" target="_blank"><u>COVID-19: Hand sanitizers inactivate novel coronavirus, study finds</u></a>
                <h6 class="block-title"><a href="https://www.medicalnewstoday.com/articles/covid-19-hand-sanitizers-inactivate-novel-coronavirus-study-finds" target="_blank">READ MORE</a></h6>
            </div>
        </div>
        <hr class="double">
    </div>
</section>
<!-- Off Site Shredding -->

<!-- BEGIN FOOTER -->
<section class="p-b-70">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xs-6 col-sm-6 col-6">
                <img alt="" src="home_assets/images/logo.png" width="152" height="30">
            </div>
        </div>
        <div class="row m-t-30">
            <div class="col-md-3 col-sm-4 col-xs-6 col-12" align="left">
                <p class="fs-14">327 Evans Avenue
                    <br> Toronto, Ontario
                    <br> Canada M8Z 1K2
                </p>
                <p class="fs-14">Phone: (613) 702 5030
                    <br> Toll Free: (866) 931 8615
                </p>
                <p class="fs-14"><a style="color: black;" href="mailto:info@protectica.ca"><u>Contact Us by
                            Email</u></a>
                </p>
            </div>
            <div class="col-md-6 col-sm-5 col-xs-12 col-12">
                 <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2888.598541254167!2d-79.5221020849952!3d43.61489986292543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b37d5f1663501%3A0xe085b53d61b4037a!2s327%20Evans%20Ave%2C%20Etobicoke%2C%20ON%20M8Z%201K2%2C%20Canada!5e0!3m2!1sen!2slk!4v1587997416979!5m2!1sen!2slk" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</section>

<script type="application/javascript">
    $(document).ready(function(e){
        $.getJSON("{{ route('get.child.categories') }}?cat_id=" + $("#subCategory").val(), function(values) {
            var options, option;

            var select_child = "{{$category_current->id}}";
            $("#childCategory").html("");
            options = "<option value='" + $("#subCategory").val() + "'>ALL</option>";
            for (var i = 0; i < values.length; i++) {
                if(values[i].id == select_child){
                    option = "<option selected value='" + values[i].id + "'>" + values[i].name + "</option>";
                }
                else{
                    option = "<option value='" + values[i].id + "'>" + values[i].name + "</option>";
                }
                options += option;
            }
            $("#childCategory").append(options);
            $('#childCategory.selectpicker').selectpicker('refresh');
        });
        var cat_current = "{{ $category_current['id'] }}";
        $.getJSON("{{ route('get.products') }}?cat_id=" + cat_current, function(values) {
            processProductList(values);
        });

        $("#subCategory").change(function(ev){
            var subCat = $(this).val();
            $.getJSON("{{ route('get.child.categories') }}?cat_id=" + subCat, function(values) {
                var options;
                $("#childCategory").html("");
                options = "<option value='" + subCat + "'>ALL</option>";
                for (var i = 0; i < values.length; i++) {
                    options += "<option value='" + values[i].id + "'>" + values[i].name + "</option>";

                }
                $("#childCategory.selectpicker").append(options);
                $('#childCategory.selectpicker').selectpicker('refresh');
            });

            $.getJSON("{{ route('get.products') }}?cat_id=" + $(this).val(), function(values) {
                processProductList(values);
            });
        });

        $("#childCategory").change(function(ev){
            $.getJSON("{{ route('get.products') }}?cat_id=" + $(this).val(), function(values) {
                processProductList(values);
            });
        });
        incrementVar = 0;
        $('.inc.button').click(function(){
            var $this = $(this),
                $input = $this.prev('input'),
                $parent = $input.closest('div'),
                newValue = parseInt($input.val())+1;
            $parent.find('.inc').addClass('a'+newValue);
            $input.val(newValue);
            incrementVar += newValue;
        });
        $('.dec.button').click(function(){
            var $this = $(this),
                $input = $this.next('input'),
                $parent = $input.closest('div'),
                newValue = parseInt($input.val())-1;
            $parent.find('.inc').addClass('a'+newValue);
            if(newValue <= 0){
                $input.val(0);
            }else{
                $input.val(newValue);
            }
            incrementVar += newValue;
        });
    });

    function processProductList (values) {
        var trows;
        $("#productTable tbody").html("");
        for (var i = 0; i < values.length; i++) {
            var price = parseFloat(values[i].price);

            trows +=    "<tr><td><a href='{{ url('product') }}/" + values[i].id + "/" + values[i].title.toLowerCase().replace(' ', '-') + "'>" + values[i].title +
                "</a>" +
                "<input type='hidden' class='_token' name='_token' value='{{csrf_token()}}'>" +
                "<input type='hidden' class='uniqueid name='uniqueid'' value='{{Session::get('uniqueid')}}'>" +
                "<input type='hidden' class='price' name='price' value='" + price.toFixed(2) + "'>" +
                "<input type='hidden' class='title' name='title' value='" + values[i].title + "'>" +
                "<input type='hidden' class='product' name='product' value='" + values[i].id + "'>" +
                "<input type='hidden' class='cost' name='cost' value='" + values[i].price + "'>" +
                "<input type='hidden' class='size' name='size'>" +
                "</td>" +
                "<td class='text-left'>$" + price.toFixed(2) + "</td>" +
                "<td class='text-center icons'>" +
                "<i style='cursor: pointer;' class='fas fa-minus-circle' onclick='decrementValue(this)'></i>" +
                "<input class='number quantity' style='border-style: none;width: 17px;' type='text' id='" + i + "' value='1' readonly>" +
                "<i style='cursor: pointer;' class='fas fa-plus-circle' onclick='incrementValue(this)'></i>" +
                "<td>" +
                "<a href='#!' class='add-cart' onclick='toAddCartFromTable(this)'><i class='fas fa-cart-plus cart-icon' style='margin-top: 0px; padding-top: 0px;'></i></a>" +
                "</td>" +
                "</tr>";
        }

        if (values.length == 0) {
            $("#productTable tbody").append("<tr><td class='text-center' colspan='4'>Sorry, But the procucts will be coming on soon!</td></tr>").hide().fadeIn("slow");
        } else {
            $("#productTable tbody").append(trows).hide().fadeIn("slow");
        }
    }

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[\w.]+$/i.test(value);
    }, "Invalid Input");
    $("#filter").validate({
        rules: {
            searchProduct: {
                lettersonly: true
            },
        }
    });
    $("#searchProduct").keyup(function(e){

        if($("#filter").valid()){
            if($.trim($(this).val()) == ""){
                $.getJSON("{{ route('get.products') }}?cat_id=6", function(values) {
                    processProductList(values);
                });
            }
            else{
                $.getJSON("{{ route('search.products') }}?search=" + $(this).val(), function(values) {
                    processProductList(values);
                });
            }

        }
    })
    function refreshPage(){
        setTimeout('location.reload()', 1000);
    }
    $("#sortby").change(function() {
        var sort = $("#sortby").val();
        window.location = "{{url('/category')}}/{{$category->slug}}?sort=" + sort;
    });

    $("#load-more").click(function() {
        $("#load").show();
        var slug = "{{$category->slug}}";
        var page = $("#page").val();
        var sort = $("#sortby").val();
        $.get("{{url('/')}}/loadcategory/" + slug + "/" + page + "?sort=" + sort, function(data, status) {
            $("#load").fadeOut();
            $("#products").append(data);
            //alert("Data: " + data + "\nStatus: " + status);
            $("#page").val(parseInt($("#page").val()) + 1);
            if ($.trim(data) == "") {
                $("#load-more").fadeOut();
            }

        });
    });
    incrementVar = 1;
    function incrementValue(id){
        var prevVal = $('.quantity_'+id).val();
        newValue = parseInt(prevVal)+1;
        $('.quantity_'+id).val(newValue);
        incrementVar += newValue;
    }
    function decrementValue(id){
        var prevVal = $('.quantity_'+id).val();
        newValue = parseInt(prevVal)-1;
        if(newValue <= 1){
            $('.quantity_'+id).val(1);
        }else{
            $('.quantity_'+id).val(newValue);
        }
        incrementVar += newValue;
    }

</script>

@stop
@section('footer')
@include('home.shop.includes.footer')
@stop