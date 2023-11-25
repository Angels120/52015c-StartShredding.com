@extends('includes.newmaster')

@section('content')

    <div class="home-wrapper">
        <div class="section-padding product-details-wrapper padding-bottom-0 wow fadeInUp">
            <div class="container">
                <div class="product-projects-FullDiv-area">
                    <div class="breadcrumb-box">
                        <a href="{{url('/')}}">{{$language->home}}</a>
                        <a href="{{url('/category')}}/{{\App\Category::where('id',$productdata->category[0])->first()->slug}}">{{\App\Category::where('id',$productdata->category[0])->first()->name}}</a>
                        @if($productdata->category[1] != "")
                            <a href="{{url('/category')}}/{{\App\Category::where('id',$productdata->category[1])->first()->slug}}">{{\App\Category::where('id',$productdata->category[1])->first()->name}}</a>
                        @endif
                        @if($productdata->category[2] != "")
                            <a href="{{url('/category')}}/{{\App\Category::where('id',$productdata->category[2])->first()->slug}}">{{\App\Category::where('id',$productdata->category[2])->first()->name}}</a>
                        @endif
                        <a href="{{url('/product')}}/{{$productdata->id}}/{{str_replace(' ','-',strtolower($productdata->title))}}">{{$productdata->title}}</a>
                    </div>

                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="product-review-carousel-img product-zoom">
                                <img id="imageDiv" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" alt="">
                            </div>
                            <div class="product-review-owl-carousel">
                                <div class="single-product-item">
                                    <img id="iconOne" onclick="productGallery(this.id)" src="{{url('/assets/images/products')}}/{{$productdata->feature_image}}" alt="">
                                </div>
                                @forelse($gallery as $galdta)
                                    <div class="single-product-item">
                                        <img id="galleryimg{{$galdta->id}}" onclick="productGallery(this.id)" src="{{url('/assets/images/gallery')}}/{{$galdta->image}}" alt="">
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <h2 class="product-header">{{$productdata->title}}</h2>
                            @if($productdata->owner != "admin")
                                @if(\App\Vendors::where('id',$productdata->vendorid)->count() != 0)
                                    <strong class="">{{$language->vendor}}: <a href="{{url('/shop')}}/{{$productdata->vendorid}}/{{str_replace(' ','-',strtolower(\App\Vendors::findOrFail($productdata->vendorid)->shop_name))}}" target="_blank">{{\App\Vendors::findOrFail($productdata->vendorid)->shop_name}}</a></strong>
                                @endif
                            @else
                            @endif
                            <p class="product-status">
                            @if($productdata->stock != 0 || $productdata->stock === null )
                                <span class="available">
                                    <i class="fa fa-check-square-o"></i>
                                    <span>{{$language->available}}</span>
                                </span>
                            @else
                                <span class="not-available">
                                <i class="fa fa-times-circle-o"></i>
                                <span>{{$language->out_of_stock}}</span>
                                </span>
                            @endif

                            </p>
                            <div>
                                <div class="ratings">
                                    <div class="empty-stars"></div>
                                    <div class="full-stars" style="width:{{\App\Review::ratings($productdata->id)}}%"></div>
                                </div>
                                @if(\App\Review::reviewCount($productdata->id) > 1)
                                    <span>{{\App\Review::reviewCount($productdata->id)}} Reviews</span>
                                @else
                                    <span>{{\App\Review::reviewCount($productdata->id)}} Review</span>
                                @endif
                            </div>
                            <p class="product-description">
                                {{substr(strip_tags($productdata->description), 0, 600)}}...
                                <a href="">show more</a>
                            </p>
                            <h1 class="product-price">
                                @if($productdata->previous_price != "")
                                    <span>
                                        <del>{{$settings[0]->currency_sign}}{{$productdata->previous_price}}</del>
                                    </span>
                                @endif
                                    {{$settings[0]->currency_sign}}{{\App\Product::Cost($productdata->id)}}
                            </h1>

                            @if($productdata->sizes != null)
                                <div class="product-size" id="product-size">
                                <p>Size</p>
                                    @foreach(explode(',',$productdata->sizes) as $size)
                                    <span>{{$size}}</span>
                                    @endforeach
                                </div>
                            @endif
                            <div class="product-quantity">
                                <p>{{$language->quantity}}</p>
                                <span class="quantity-btn" id="qty-minus"><i class="fa fa-minus"></i></span>
                                <span id="pqty">1</span>
                                <span class="quantity-btn" id="qty-add"><i class="fa fa-plus"></i></span>
                            </div>
                            <form class="addtocart-form">
                                {{csrf_field()}}
                                @if(Session::has('uniqueid'))
                                    <input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
                                @else
                                    <input type="hidden" name="uniqueid" value="{{str_random(7)}}">
                                @endif
                                <input type="hidden" id="price" name="price" value="{{\App\Product::Cost($productdata->id)}}">
                                <input type="hidden" name="title" value="{{$productdata->title}}">
                                <input type="hidden" name="product" value="{{$productdata->id}}">
                                <input type="hidden" id="cost" name="cost" value="{{\App\Product::Cost($productdata->id)}}">
                                <input type="hidden" id="quantity" name="quantity" value="1">
                                <input type="hidden" id="size" name="size" value="">
                                @if($productdata->stock != 0 || $productdata->stock === null )
                                    <button type="button" class="product-addCart-btn to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}}</span></button>
                                @else
                                    <button type="button" class="product-addCart-btn  to-cart" disabled><i class="fa fa-cart-plus"></i>{{$language->out_of_stock}}</button>
                                @endif
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-padding product-description-wrapper padding-bottom-0 padding-top-0 wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="custom-tab">
                            <div class="row">
                                <div class="col-md-5">
                                    <ul class="tab-list">
                                        <li class="active"><a data-toggle="tab" href="#overview-tab-1">{{$language->description}}</a></li>
                                        <li><a data-toggle="tab" href="#pricing-tab-2">{{$language->return_policy}}</a></li>
                                        <li><a data-toggle="tab" href="#location-tab-3">{{$language->reviews}}({{\App\Review::where('productid',$productdata->id)->count()}})</a></li>
                                    </ul>
                                </div>

                                <div class="col-md-7">
                                    @if(Session::has('message'))
                                        <div class="alert alert-success alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            {{ Session::get('message') }}
                                        </div>
                                    @endif
                                    <div class="tab-content">
                                        <div id="overview-tab-1" class="tab-pane active fade in">
                                            <p>{!! $productdata->description !!}</p>
                                        </div>

                                        <div id="pricing-tab-2" class="tab-pane fade">
                                            <p>{!! $productdata->policy !!}</p>
                                        </div>

                                        <div id="location-tab-3" class="tab-pane fade">
                                            <p>
                                                <h1>{{$language->write_a_review}}</h1>
                                                <hr>
                                                <div class="review-star">
                                                    <div class='starrr' id='star1'></div>
                                                    <div>
                                                        <span class='your-choice-was' style='display: none;'>
                                                            Your rating is: <span class='choice'></span>.
                                                        </span>
                                                    </div>
                                                </div>
                                                <form class="product-review-form" method="POST" action="{{route('review.submit')}}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="rating" id="rate" value="5">
                                                    <input type="hidden" name="productid" value="{{$productdata->id}}">
                                                    <div class="form-group">
                                                        <input name="name" type="text" class="form-control" placeholder="{{$language->name}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="email" type="email" class="form-control" placeholder="{{$language->email}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="review" id="" rows="5" placeholder="{{$language->review_details}}" class="form-control" style="resize: vertical;" required></textarea>
                                                    </div>
                                                    @if ($errors->has('error'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                    <div class="form-group text-center">
                                                        <input name="btn" type="submit" class="btn-review" value="{{$language->submit}}">
                                                    </div>
                                                </form>
                                                <hr>
                                                <h1>{{$language->reviews}}: </h1>
                                                <hr>
                                                <div class="review-rating-description">
                                                    @forelse($reviews as $review)
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-3">
                                                            <p>cej</p>
                                                            <div class="ratings">
                                                                <div class="empty-stars"></div>
                                                                <div class="full-stars" style="width:{{$review->rating*20}}%"></div>
                                                            </div>
                                                            <p>{{$review->review_date}}</p>
                                                        </div>
                                                        <div class="col-md-9 col-sm-9">
                                                            <p>{{$review->review}}</p>
                                                        </div>
                                                    </div>
                                                    @empty
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4>{{$language->no_review}}</h4>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="section-padding product-carousel-wrapper wow fadeInUp">
            <div class="container">
                <div class="product-carousel-full-div">
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>{{$language->related_products}}</h2>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-carousel-list">
                                @foreach($relateds as $product)
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
                                                    <span class="original-price">${{$product->previous_price}}</span>
                                                @else
                                                @endif
                                                <del class="offer-price">${{$product->price}}</del>
                                            </div>
                                            <div class="product-meta-area">
                                                <a href="" class="addTo-cart">
                                                    <i class="fa fa-cart-plus"></i>
                                                    <span>add to cart</span>
                                                </a>
                                                <a  href="javascript:;" class="wish-list" onclick="getQuickView({{$product->id}})" data-toggle="modal" data-target="#myModal">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop

@section('footer')
<script>
    $('#star1').starrr({
        rating: 5,
        change: function(e, value){
            if (value) {
                $('.your-choice-was').show();
                $('.choice').text(value);
                $('#rate').val(value);
            } else {
                $('.your-choice-was').hide();
            }
        }
    });

    $("#showmore").click(function() {
        $('html, body').animate({
            scrollTop: $("#description").offset().top - 200
        }, 1000);
    });


    $('#star1').starrr({
        rating: 5,
        change: function(e, value){
            if (value) {
                $('.your-choice-was').show();
                $('.choice').text(value);
                $('#rate').val(value);
            } else {
                $('.your-choice-was').hide();
            }
        }
    });
</script>
@stop