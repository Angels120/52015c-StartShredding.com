@extends('includes.newmaster2')

@section('content')



    <div class="home-wrapper">
        <!-- Starting of product filter breadcroumb area -->
        <div class="productFilter-breadcroumb-section text-center wow fadeInUp">
            <img src="{{url('/')}}/assets/images/{{$settings[0]->background}}" alt="">
            <h1>
                @if(is_object($vendor))
                    <h1>{{$vendor->shop_name}}</h1>
                @else
                    <h1>No Shop Found</h1>
                @endif
            </h1>
        </div>
        <!-- Ending of product filter breadcroumb area -->

        <!-- Starting of product filter area -->
        <div class="section-padding product-filter-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-filter-rightDiv">
                            <div class="row" id="products">
                                @forelse($products as $product)
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <div class="single-product-carousel-item text-center">
                                            <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                            <div class="product-carousel-text">
                                                <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
                                                    <h4 class="product-title">{{$product->title}}</h4>
                                                </a>
                                                <div class="ratings">
                                                    <div class="empty-stars"></div>
                                                    <div class="full-stars" style="width:{{\App\Review::ratings($product->id)}}%"></div>
                                                </div>
                                                <div class="product-price">
                                                    @if($product->previous_price != "")
                                                        <span class="original-price">${{\App\Product::Cost($product->id)}}</span>
                                                    @else
                                                    @endif
                                                    <del class="offer-price">${{$product->previous_price}}</del>
                                                </div>
                                                <div class="product-meta-area">
                                                    <form class="addtocart-form">
                                                        {{csrf_field()}}
                                                        @if(Session::has('uniqueid'))
                                                            <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
                                                        @else
                                                            <input type="hidden" name="uniqueid" value="{{str_random(7)}}">
                                                        @endif
                                                        <input type="hidden" name="title" value="{{$product->title}}">
                                                        <input type="hidden" name="product" value="{{$product->id}}">
                                                        <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($product->id)}}">
                                                        <input type="hidden" id="quantity" name="quantity" value="1">
                                                        @if($product->stock != 0 || $product->stock === null )
                                                            <button type="button" class="addTo-cart to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>
                                                        @else
                                                            <button type="button" class="addTo-cart  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>
                                                        @endif
                                                    </form>
                                                    <a  href="javascript:;" class="wish-list" onclick="getQuickView({{$product->id}})" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row" style="margin-left: 0">
                                        <div class="col-md-12">
                                            <h3>{{$language->no_result}}</h3>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            @if(count($products) > 0)
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <img id="load" src="{{url('/assets/images/default.gif')}}" style="display: none;width: 80px;">
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <input type="hidden" id="page" value="2">
                                        <a href="javascript:;" id="load-more" class="product-filter-loadMore-btn">load more</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of product filter area -->

    </div>

@stop

@section('footer')
<script>

    $("#load-more").click(function () {
        $("#load").show();
        var id = "{{$vendor->id}}";
        var page = $("#page").val();
        $.get("{{url('/')}}/loadvendor/"+id+"/"+page, function(data, status){
            $("#load").fadeOut();
            $("#products").append(data);
            //alert("Data: " + data + "\nStatus: " + status);
            $("#page").val(parseInt($("#page").val())+1);
            if ($.trim(data) == ""){
                $("#load-more").fadeOut();
            }
        });
    });
</script>
@stop