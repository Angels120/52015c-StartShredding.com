@extends('home.shop.includes.master',['cart_result'=> $response])
@section('header')
@include('home.shop.includes.header')
@stop
@section('content')
<link rel="stylesheet" href="{{ URL::asset('assets2/css/product.css')}}">
<!-- BEGIN INTRO CONTENT -->
<section class="p-b-65 p-t-100 m-t-50">
    <div class="container">
        <div class="row">
            <div id="success" class="alert alert-success alert-dismissable" hidden>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Seccessfully Added to Favourite
            </div>
            <div id="error" class="alert alert-danger alert-dismissable" hidden>
                <a href="#" class="close" data-dismiss="alert" aria-label="close" hidden>&times;</a>
                Please sign in to add this product to your favourites list, Thank you.
            </div>
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
                                        <input type="hidden" class="product" id="product" name="product" value="{{$pro->id}}">
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
                                   <span class="glyphicon glyphicon-plus"></span>
                                   </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-15" align="center">
                        <a href="#!" onclick="toAddCartFromTable({{$key}})" class="add-cart btn btn-default">
                            <i class="fa fa-cart-plus"></i>&nbsp;ADD TO CART</a>
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
                <a href="{{ url('/shop/3') }}"  style="color: white;background: #134c89;" class="btn btn-default">BACK</a>&nbsp;&nbsp;
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
<script type="application/javascript">
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
    $(".add_fav").click(function() {

        var data={};

        $.ajax({
            url: '{{URL::route('add-product-favourite')}}',
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: {
                product_id :$('input#product').val(),
            },
            success:function(data){
                console.log(data);
                //$("#success").show();
                location.reload(true);
            },error:function(){
                //console.log(data);
                $("#error").show();
            }
        }); //end of ajax

    });
</script>
@stop

@section('footer')
@include('home.shop.includes.footer')

@stop