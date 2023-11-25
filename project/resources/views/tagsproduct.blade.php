@extends('includes.newmaster')

@section('content')


    <section style="background: url({{url('/')}}/assets/images/{{$settings[0]->background}}) no-repeat center center; background-size: cover;">
        <div class="row" style="background-color:rgba(0,0,0,0.7);">

            <div style="margin: 3% 0px 3% 0px;">
                <div class="text-center" style="color: #FFF;padding: 20px;">
                    <h1>{{$language->search_result}}: {{$tag}}</h1>
                </div>
            </div>

        </div>


    </section>



    <div class="section-padding product-filter-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <div class="single-product-carousel-item text-center">
                                <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}"> <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" /> </a>
                                <div class="product-carousel-text">
                                    <a href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
                                        <h4 class="product-title">{{$product->title}}</h4>
                                    </a>
                                    <div class="product-review">
                                        <i class="fa fa-star"></i>
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
                        <h3>{{$language->no_result}}</h3>
                    @endforelse
                </div>
            </div>
    </div>

@stop

@section('footer')

@stop