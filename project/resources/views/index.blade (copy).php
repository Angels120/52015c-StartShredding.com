@extends('includes.newmaster')
@section('content')

    <div class="home-wrapper">
        @if($pagesettings[0]->slider_status)
        <section class="go-slider">
            <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Wrapper For Slides -->
                <div class="carousel-inner" role="listbox">

                @for ($i = 0; $i < count($sliders); $i++)
                    @if($i == 0)
                        <!-- Third Slide -->
                            <div class="item active">

                                <!-- Slide Background -->
                                <img src="{{url('/')}}/assets/images/sliders/{{$sliders[$i]->image}}" alt="Bootstrap Touch Slider"  class="slide-image"/>
                                <div class="bs-slider-overlay"></div>

                                <div class="container">
                                    <div class="row">
                                        <!-- Slide Text Layer -->
                                        <div class="slide-text {{$sliders[$i]->text_position}}">

                                            <h1 data-animation="animated fadeInDown">{{$sliders[$i]->title}}</h1>
                                            <p data-animation="animated fadeInUp">{{$sliders[$i]->text}}</p>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End of Slide -->
                    @else
                        <!-- Second Slide -->
                            <div class="item">

                                <!-- Slide Background -->
                                <img src="{{url('/')}}/assets/images/sliders/{{$sliders[$i]->image}}" alt="Bootstrap Touch Slider"  class="slide-image"/>
                                <div class="bs-slider-overlay"></div>
                                <!-- Slide Text Layer -->
                                <div class="slide-text {{$sliders[$i]->text_position}}">
                                    <h1 data-animation="animated fadeInDown">{{$sliders[$i]->title}}</h1>
                                    <p data-animation="animated fadeInUp">{{$sliders[$i]->text}}</p>
                                </div>
                            </div>
                            <!-- End of Slide -->
                        @endif
                    @endfor

                </div><!-- End of Wrapper For Slides -->

                <!-- Left Control -->
                <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <!-- Right Control -->
                <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div> <!-- End  bootstrap-touch-slider Slider -->

        </section>
        @endif

        @if($pagesettings[0]->category_status)
        <!-- Starting of featured product area -->
        <div class="section-padding featured-categories padding-bottom-0 wow fadeInUp">
            <div class="container">
                <div class="product-featured-full-div">
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>{{$language->top_category}}</h2>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row featured-list">
                        <div class="featured-categories-wrapper">
                            <div class="col-md-6 col-sm-12">
                                <div class="single-featured-area">
                                    <a href="{{url('/category')}}/{{$fcategory->slug}}">
                                        <img class="featured-img" src="{{url('/assets')}}/images/categories/{{$fcategory->feature_image}}" alt="">
                                        <div class="product-feature-content">
                                            <h3>{{$fcategory->name}}</h3>
                                            @if(\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcategory->id])->count()>1)
                                                <p>{{\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcategory->id])->count()}} products</p>
                                            @else
                                                <p>{{\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcategory->id])->count()}} product</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @foreach($fcategories as $fcat)
                            <div class="col-md-3 col-sm-6">
                                <div class="single-featured-area">
                                    <a href="{{url('/category')}}/{{$fcat->slug}}">
                                        <img class="featured-img" src="{{url('/assets')}}/images/categories/{{$fcat->feature_image}}" alt="">
                                        <div class="product-feature-content">
                                            <h3>{{$fcat->name}}</h3>
                                            @if(\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcat->id])->count()>1)
                                                <p>{{\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcat->id])->count()}} products</p>
                                            @else
                                                <p>{{\App\Product::where('status','1')->whereRaw('FIND_IN_SET(?,category)', [$fcat->id])->count()}} product</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of featured product area -->
        @endif

        @if($pagesettings[0]->sbanner_status)
        <!-- Starting of product-imageBlog area -->
        <div class="section-padding product-imageBlog-section padding-top-0 padding-bottom-0 wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-imgBlog-fullDiv">
                            @foreach($banners as $banner)
                            <div class="col-md-4">
                                <a href="{{$banner->link}}" target="_blank">
                                    <img src="{{url('/assets')}}/images/brands/{{$banner->image}}" alt="">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of product-imageBlog area -->
        @endif
        @if($pagesettings[0]->latestpro_status)
        <!-- starting of new project area -->
        <div class="section-padding product-carousel-wrapper padding-bottom-0 wow fadeInUp">
            <div class="container">
                <div class="product-carousel-full-div">
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>{{$language->latest_products}}</h2>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-carousel-list">
                                @foreach($latests as $product)
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
                                                    <span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>
                                                @else
                                                @endif
                                                <del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of new project area -->
        @endif
        @if($pagesettings[0]->featuredpro_status)
        <!-- starting of featured project area -->
        <div class="section-padding product-carousel-wrapper wow fadeInUp">
            <div class="container">
                <div class="product-carousel-full-div">
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>{{$language->featured_products}}</h2>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-carousel-list">
                                @foreach($features as $product)
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
                                                    <span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>
                                                @else
                                                @endif
                                                <del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of featured project area -->
        @endif
        @if($pagesettings[0]->lbanner_status)
        <!-- Starting of Breadcroumb area -->
        <div class="breadcroumb-section text-center  wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{$pagesettings[0]->banner_link}}" target="_blank">
                            <img style="width: 100%;" src="{{url('/assets/images')}}/{{$pagesettings[0]->large_banner}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of Breadcroumb area -->
        @endif
        @if($pagesettings[0]->popularpro_status)
        <!-- starting of best seller area -->
        <div class="section-padding product-carousel-wrapper padding-bottom-0 wow fadeInUp">
            <div class="container">
                <div class="product-carousel-full-div">
                    <div class="row margin-bottom-0">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>{{$language->popular_products}}</h2>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-carousel-list">
                                @foreach($tops as $product)
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
                                                    <span class="original-price">{{$settings[0]->currency_sign}}{{\App\Product::Cost($product->id)}}</span>
                                                @else
                                                @endif
                                                <del class="offer-price">{{$settings[0]->currency_sign}}{{$product->previous_price}}</del>
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of best seller area -->
        @endif
        @if($pagesettings[0]->subscribe_status)
        <!-- Starting of product subscribe form area -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-subscribe-section text-center wow fadeInUp">
                        <img src="{{url('/assets/images')}}/{{$settings[0]->background}}" alt="">
                        <div class="product-subscribe-form">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2  col-xs-10 col-xs-offset-1">
                                    <div class="product-subscribe-form-content">
                                        <div class="product-subscribe-icon">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <h1>{{$language->subscription}}</h1>
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, magni, ad. Molestiae, error similique voluptates nam dignissimos, alias fugit assumenda.</p>--}}
                                        <p id="resp"></p>
                                        <form id="subform" action="{{action('FrontEndController@subscribe')}}" method="post">
                                            {{csrf_field()}}
                                            <input type="email" id="email" placeholder="Enter Email" name="email" required>

                                            <input id="subs"  type="button" class="btn subscribe-btn" value="{{$language->subscribe}}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ending of product subscribe form area -->
        @endif


        @if($pagesettings[0]->blogs_status)
        <!-- Starting of blog area -->
        <div class="section-padding blog-area-wrapper padding-bottom-0 wow fadeInUp">
            <div class="container">
                <div class="blog-area-fullDiv">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="section-title text-center">
                                <h2>{{$languages->blog_title}}</h2>
                                <p>{{$languages->blog_text}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="blog-area-slider">
                                @foreach($blogs as $blog)
                                <div class="single-blog-box">
                                    <div class="blog-thumb-wrapper">
                                        <img src="{{url('/assets')}}/images/blog/{{$blog->featured_image}}" alt="Blog Image">
                                    </div>
                                    <div class="blog-text">
                                        <p class="blog-meta">{{date('d M Y',strtotime($blog->created_at))}}</p>
                                        <h4>{{$blog->title}}</h4>
                                        <p>{{substr(strip_tags($blog->details),0,125)}}</p>
                                        <a href="{{url('/blog')}}/{{$blog->id}}" class="blog-more-btn">{{$language->view_details}}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of blog area -->
        @endif
        @if($pagesettings[0]->testimonial_status)
        <!-- Starting of customer review carousel area -->
        <div class="customer-review-carousel-wrapper text-center wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="customer-review-carousel-image">
                            <img src="{{url('/assets/images')}}/{{$settings[0]->background}}" alt="">

                            <div class="review-carousel-table">
                                <div class="review-carousel-table-cell">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
                                                <div class="section-title text-center">
                                                    <h2>{{$languages->testimonial_title}}</h2>
                                                    <p>{{$languages->testimonial_text}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="testimonial-section animated fadeInRight">
                                                    @foreach($testimonials as $testimonial)
                                                    <div class="single-testimonial-area">
                                                        <div class="testimonial-text">
                                                            <p>{{$testimonial->review}}</p>
                                                        </div>
                                                        <div class="testimonial-author">
                                                            <img src="{{url('/assets/images/cusavatar.png')}}" alt="Author">
                                                            <h4><strong>{{$testimonial->client}}</strong> <br> {{$testimonial->designation}}</h4>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of customer review carousel area -->
        @endif
        @if($pagesettings[0]->brands_status)
        <!-- Starting of brandLogo-carousel-wrapper area -->
        <div class="section-padding logo-carousel-wrapper  wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo-carousel">
                            @foreach($brands as $brand)
                            <div class="single-logo-item">
                                <div class="logo-item-inner">
                                    <img src="{{url('/assets/images/brands')}}/{{$brand->image}}" alt="">
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of brandLogo-carousel-wrapper area -->
        @endif

    </div>
@stop

@section('footer')
<script>

</script>
@stop