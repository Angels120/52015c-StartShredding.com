@extends('includes.newmaster2',['cart_result'=> $response])
@section('title', '| ' . $category_current['name'])
@section('content')

<style>
    #filter {
        text-align: center;
    }

    ul.mainnav li.level0>a>span.title {
        font-size: 13px;
        font-weight: 700;
        font-family: Poppins;
        position: relative;
        text-transform: uppercase;
        -webkit-transition: all .2s ease-out 0s;
        transition: all .2s ease-out 0s
    }

    #tableArea {
        /* -webkit-box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
        -moz-box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
        box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1); */
        padding: 0px 5px;
        margin-top: 20px;
    }

    #productTable,
    .bootstrap-select {
        width: 100% !important;
    }

    .bootstrap-select,
    .bootstrap-select .dropdown-menu li a,
    .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
        color: rgba(0, 0, 0, 0.53) !important;
        font-size: 14px;
        font-family: 'Raleway', sans-serif;
        font-weight: 600;
    }

    .bootstrap-select .dropdown-menu>.active>a.selected,
    .bootstrap-select .dropdown-menu>.active>a.selected {
        color: rgba(255, 255, 255, 0.9) !important;
    }

    .bootstrap-select .btn-default {
        padding: 8px 15px;
        font-size: 14px;
        border-radius: 0px !important;
        border: 0;
        -webkit-box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
        -moz-box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
        box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
    }

    .bootstrap-select .dropdown-menu {
        margin-top: 5px;
        border-radius: 0px !important;
        border: 0;
        -webkit-box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
        -moz-box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
        box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
    }

    input#searchProduct {
        color: rgba(0, 0, 0, 0.53) !important;
        border-radius: 0px !important;
        border: 0;
        font-size: 14px;
        -webkit-box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
        -moz-box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
        box-shadow: 0px 0px 2px 0px rgba(212, 212, 212, 1);
        font-family: 'Raleway', sans-serif;
        font-weight: 500;
        z-index: 0;
    }

    #productTable th,
    #featuredTable th {
        font-size: 14px;
        font-family: 'Raleway', sans-serif;
        font-weight: 800;
        text-transform: uppercase
    }

    .category-search button {
        background-color: #fff;
        border: 1px solid #f2f2f2;
        /* padding: 7.9px 14px; */
        top: -1.7px;
        height: 36px !important;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        border-top: none;
    }

    .category-search {
        margin-top: 20px;
    }

    #productTable td,
    #featuredTable td,
    #productTable td a,
    #featuredTable td a {
        color: #595959;
        font-size: 14px;
        font-family: 'Raleway', sans-serif !important;
        font-weight: 600;
    }

    #productTable td:first-child a,
    #featuredTable td:first-child a {
        font-weight: 500;
    }

    #productTable td:first-child:hover a,
    #featuredTable td:first-child:hover a {
        color: #e34444 !important;
    }

    #productTable .number,
    #featuredTable .number {
        /* margin-left: 7px; */
        /* margin-right: 3px; */
        padding: 0;
        margin: 0px;
        font-size: 14px;
        border-style: none;
        background-color: transparent;
        width: 16px;
    }

    #productTable .icons i,
    #featuredTable .icons i {
        top: 0;
        color: #652C91;
    }

    #productTable .icons i:first-child,
    #featuredTable .icons i:first-child {
        padding-right: 7px;
    }

    #productTable .icons i:last-child,
    #featuredTable .icons i:last-child {
        padding-left: auto;
    }

    .cart-icon {
        top: 0;
        font-size: 16px;
    }

    .home-wrapper .inner-block {
        width: 40%;
        margin: 0 auto;
    }

    .home-wrapper .inner-block table thead {
        font-size: 18px;
    }

    .home-wrapper .inner-block table tbody {
        font-size: 16px;
        font-weight: 500;
    }

    .home-wrapper .inner-block table tbody .icons i {
        font-size: 15px;
    }

    label#searchProduct-error.error {
        color: #ff0000;
        font-size: 13px;
        padding-top: 5px;
        text-transform: uppercase;
    }

    @media screen and (min-width : 1650px) {
        .home-wrapper .inner-block {
            width: 30%;
            margin: 0 auto;
        }
    }

    @media screen and (min-width : 2560px) {
        .home-wrapper .inner-block {
            width: 30%;
            margin: 0 auto;
        }
    }

    @media screen and (max-width : 1024px) {
        .home-wrapper .inner-block {
            width: 60%;
            margin: 0 auto;
        }
    }

    @media screen and (max-width : 480px) {
        .category-search button {
            top: -1.5px;
        }

        .home-wrapper .container.inner-block {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .home-wrapper .inner-block table thead {
            font-size: 14px;
        }

        .home-wrapper .inner-block table tbody {
            font-size: 12px;
            font-weight: 500;
        }

        .home-wrapper .inner-block table tbody .icons i {
            font-size: 13px;
        }

        .home-wrapper .inner-block table tbody .add-cart i {
            font-size: 15px;
        }

        #productTable .number {
            /* margin-left: 8px; */
            /* margin-right: 2px; */
            /* width: 10px; */
        }

        .bootstrap-select:first-child {
            margin-bottom: 15px;
        }
    }
</style>

<div class="home-wrapper">

    <div class="container-fluid">
        <!-- Starting of product filter area -->
        <div class="section-padding product-filter-wrapper wow fadeInUp">

            <div class="container inner-block">
                @if(!$featured_products->isEmpty())
                <h3>Most Popular Products</h3>
                <table id="featuredTable" class="table table-striped tabele-bordered" style="margin-top:20px;">
                    <thead>
                        <tr>
                            <th style="width: 40%">Item</th>
                            <th style="width: 25%" class="text-left">Rate</th>
                            <th style="width: 30%" class="text-center">QTY</th>
                            <th style="width: 8%"></th>
                            {{-- <td>Total</td> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($featured_products as $key => $featured_product)
                        <tr>
                            <td><a
                                    href='{{ url('product') . '/' . $featured_product->id . '/' . str_replace(' ', '-', strtolower($featured_product->title)) }}'>{{ $featured_product->title }}</a>
                                <input type='hidden' class='_token' name='_token' value='{{csrf_token()}}'>
                                <input type='hidden' class='uniqueid' name='uniqueid'
                                    value='{{ Session::get('uniqueid') }}'>
                                <input type='hidden' class='price' name='price'
                                    value='{{ number_format((float)$featured_product->price, 2, '.', '') }}'>
                                <input type='hidden' class='title' name='title'
                                    value='{{ str_replace(' ', '-', strtolower($featured_product->title)) }}'>
                                <input type='hidden' class='product' name='product' value='{{ $featured_product->id }}'>
                                <input type='hidden' class='cost' name='cost' value='{{ $featured_product->price }}'>
                                <input type='hidden' class='size' name='size'>
                            </td>
                            <td class='text-left'>$ {{ number_format((float)$featured_product->price, 2, '.', '') }}
                            </td>
                            <td class='text-center icons'>
                                <i style='cursor: pointer;' class='fas fa-minus-circle'
                                    onclick='decrementValue(this)'></i>
                                <input class='number quantity' style='border-style: none;width: 17px;' type='text'
                                    id='{{ $key }}' value='1' readonly>
                                <i style='cursor: pointer;' class='fas fa-plus-circle'
                                    onclick='incrementValue(this)'></i>
                            <td><a href='#!' class='add-cart' onclick='toAddCartFromTable(this)'><i
                                        class='fas fa-cart-plus cart-icon'
                                        style='margin-top: 0px; padding-top: 0px;'></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                <hr>

                @endif

                <h3>All Products</h3>
                <form id="filter" style="font-size: 24px;">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="first" id="subCategory" class="selectpicker" style="color: #0059B2;">
                                <option value="6">All Services</option>
                                @foreach($categories as $key => $cat)
                                @if($cat->id === $category_current['id'] || $cat->id === $category_current->subid['id'])
                                <option selected value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @else
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="second" id="childCategory" class="selectpicker">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-12">

                            <div class="input-group category-search">
                                <input type="text" class="searchbar form-control " id="searchProduct"
                                    name="searchProduct" placeholder="Search for a product">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn"><span class="fa fa-search"
                                            aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div id="tableArea">
                    <table id="productTable" class="table table-striped tabele-bordered" style="margin-top:20px;">
                        <thead>
                            <tr>
                                <th style="width: 40%">Item</th>
                                <th style="width: 25%" class="text-left">Rate</th>
                                <th style="width: 30%" class="text-center">QTY</th>
                                <th style="width: 8%"></th>
                                {{-- <td>Total</td> --}}
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>

                    </table>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
        <!-- Ending of product filter area -->
    </div>


</div>


@stop

@section('footer')

<script>
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

</script>

<script>
    jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[\w.]+$/i.test(value);
        }, "Invalid Input"); 
</script>

<script>
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
</script>
<script>
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
</script>
<script>
    incrementVar = 1;
    function incrementValue(elem){
        var $this = $(elem);
            $input = $this.prev('input');
            $parent = $input.closest('div');
            newValue = parseInt($input.val())+1;
        $parent.find('.inc').addClass('a'+newValue);
        $input.val(newValue);      
        incrementVar += newValue;
    }
    function decrementValue(elem){
        var $this = $(elem);
            $input = $this.next('input');
            $parent = $input.closest('div');
            newValue = parseInt($input.val())-1;
        $parent.find('.inc').addClass('a'+newValue);
        if(newValue <= 1){
            $input.val(1);
        }else{
            $input.val(newValue);
        }
        incrementVar += newValue;
    }
</script>
<script>

</script>
@stop