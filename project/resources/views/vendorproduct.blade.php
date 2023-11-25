@extends('includes.newmaster2')

@section('content')



    <!-- CONTENT -->
            <div id="sns_content" class="wrap layout-m">
                <div class="container">
                    <div class="row">
                        <div id="sns_main" class="col-md-12 col-main">
                            <div id="sns_mainmidle">
                                <div id="sns_producttaps1" class="sns_producttaps_wraps">
                                    <h3 class="precar">PRODUCT TAPS</h3>
                                  <!-- Nav tabs -->
                                  <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">POPULAR</a></li>
                                    <li role="presentation"><a href="#onsale" aria-controls="onsale" role="tab" data-toggle="tab">ON SALE</a></li>
                                    <li role="presentation"><a href="#officewear" aria-controls="officewear" role="tab" data-toggle="tab">OFFICE WEAR</a></li>
                                    <li role="presentation"><a href="#casual" aria-controls="casual" role="tab" data-toggle="tab">CASUAL</a></li>
                                  </ul>
                                  <!-- Tab panes -->
                                  <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <div class="products-grid row style_grid">
		                                         @forelse($products as $product)
		                                         		<div class="item col-lg-2d4 col-md-3 col-sm-4 col-xs-6 col-phone-12">
		                                                 <div class="item-inner">
		                                                     <div class="prd">
		                                                         <div class="item-img clearfix">
		                                                             <div class="ico-label">
		                                                                    <span class="ico-product ico-new">New</span>
		                                                                    <span class="ico-product ico-sale">Sale</span>
		                                                                </div>
		
		                                                             <a class="product-image have-additional"
		                                                                title="{{$product->title}}"
		                                                                href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
		                                                                <span class="img-main">
				                                                               <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" />
		                                                                </span>
		                                                             </a>
		                                                         </div>
		                                                         <div class="item-info">
		                                                             <div class="info-inner">
		                                                                 <div class="item-title">
		                                                                     <a title="{{$product->title}}"
		                                                                        href="detail.html">
		                                                                         {{$product->title}} </a>
		                                                                 </div>
		                                                                 <div class="item-price">
		                                                                     <div class="price-box">
		                                                                <span class="regular-price">
		                                                                    <span class="price">
		                                                                        
									                                                        <span class="price1">${{\App\Product::Cost($product->id)}}</span>								                                                        
									                                                   
									                                                    @if($product->previous_price)
									                                                    <span class="price2">${{$product->previous_price}}</span>
									                                                    @endif
									                                                    
		                                                                    </span>
		                                                                </span>
		                                                                     </div>
		                                                                 </div>
		                                                             </div>
		                                                         </div>
		                                                         <div class="action-bot">
		                                                             <div class="wrap-addtocart">
		                                                                 <button class="btn-cart"
		                                                                         title="Add to Cart">
		                                                                     <i class="fa fa-shopping-cart"></i>
		                                                                     <span>Add to Cart</span>
		                                                                 </button>
		                                                             </div>
		                                                             <div class="actions">
		                                                                 <ul class="add-to-links">
		                                                                     <li>
		                                                                         <a class="link-wishlist"
		                                                                            href="#"
		                                                                            title="Add to Wishlist">
		                                                                             <i class="fa fa-heart"></i>
		                                                                         </a>
		                                                                     </li>
		                                                                     <!-- <li>
		                                                                         <a class="link-compare"
		                                                                            href="#"
		                                                                            title="Add to Compare">
		                                                                             <i class="fa fa-random"></i>
		                                                                         </a>
		                                                                     </li> -->
		                                                                     <li class="wrap-quickview" data-id="qv_item_7">
		                                                                         <div class="quickview-wrap">
		                                                                             <a class="sns-btn-quickview qv_btn"
		                                                                                href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
		                                                                                 <i class="fa fa-eye"></i>
		                                                                             </a>
		                                                                         </div>
		                                                                     </li>
		                                                                 </ul>
		                                                             </div>
		                                                         </div>
		                                                     </div>
		                                                 </div>
		                                             </div>
					                                @empty
					                                    <div class="item col-lg-2d4 col-md-3 col-sm-4 col-xs-6 col-phone-12">
					                                        <div class="item-inner">
					                                            <h3>{{$language->no_result}}</h3>
					                                        </div>
					                                    </div>
					                                @endforelse
					                                </div>
														</div>
												<div role="tabpanel" class="tab-pane" id="onsale">
                                        <div class="products-grid row style_grid">
                                            @forelse($products as $product)
		                                         		<div class="item col-lg-2d4 col-md-3 col-sm-4 col-xs-6 col-phone-12">
		                                                 <div class="item-inner">
		                                                     <div class="prd">
		                                                         <div class="item-img clearfix">
		                                                             <div class="ico-label">
		                                                                    <span class="ico-product ico-new">New</span>
		                                                                    <span class="ico-product ico-sale">Sale</span>
		                                                                </div>
		
		                                                             <a class="product-image have-additional"
		                                                                title="{{$product->title}}"
		                                                                href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
		                                                                <span class="img-main">
				                                                               <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" />
		                                                                </span>
		                                                             </a>
		                                                         </div>
		                                                         <div class="item-info">
		                                                             <div class="info-inner">
		                                                                 <div class="item-title">
		                                                                     <a title="{{$product->title}}"
		                                                                        href="detail.html">
		                                                                         {{$product->title}} </a>
		                                                                 </div>
		                                                                 <div class="item-price">
		                                                                     <div class="price-box">
		                                                                <span class="regular-price">
		                                                                    <span class="price">
		                                                                        
									                                                        <span class="price1">${{\App\Product::Cost($product->id)}}</span>								                                                        
									                                                   
									                                                    @if($product->previous_price)
									                                                    <span class="price2">${{$product->previous_price}}</span>
									                                                    @endif
									                                                    
		                                                                    </span>
		                                                                </span>
		                                                                     </div>
		                                                                 </div>
		                                                             </div>
		                                                         </div>
		                                                         <div class="action-bot">
		                                                             <div class="wrap-addtocart">
		                                                                 <button class="btn-cart"
		                                                                         title="Add to Cart">
		                                                                     <i class="fa fa-shopping-cart"></i>
		                                                                     <span>Add to Cart</span>
		                                                                 </button>
		                                                             </div>
		                                                             <div class="actions">
		                                                                 <ul class="add-to-links">
		                                                                     <li>
		                                                                         <a class="link-wishlist"
		                                                                            href="#"
		                                                                            title="Add to Wishlist">
		                                                                             <i class="fa fa-heart"></i>
		                                                                         </a>
		                                                                     </li>
		                                                                     <!-- <li>
		                                                                         <a class="link-compare"
		                                                                            href="#"
		                                                                            title="Add to Compare">
		                                                                             <i class="fa fa-random"></i>
		                                                                         </a>
		                                                                     </li> -->
		                                                                     <li class="wrap-quickview" data-id="qv_item_7">
		                                                                         <div class="quickview-wrap">
		                                                                             <a class="sns-btn-quickview qv_btn"
		                                                                                href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
		                                                                                 <i class="fa fa-eye"></i>
		                                                                             </a>
		                                                                         </div>
		                                                                     </li>
		                                                                 </ul>
		                                                             </div>
		                                                         </div>
		                                                     </div>
		                                                 </div>
		                                             </div>
					                                @empty
					                                    <div class="item col-lg-2d4 col-md-3 col-sm-4 col-xs-6 col-phone-12">
					                                        <div class="item-inner">
					                                            <h3>{{$language->no_result}}</h3>
					                                        </div>
					                                    </div>
					                                @endforelse
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="officewear">
                                        <div class="products-grid row style_grid">
                                            @forelse($products as $product)
		                                         		<div class="item col-lg-2d4 col-md-3 col-sm-4 col-xs-6 col-phone-12">
		                                                 <div class="item-inner">
		                                                     <div class="prd">
		                                                         <div class="item-img clearfix">
		                                                             <div class="ico-label">
		                                                                    <span class="ico-product ico-new">New</span>
		                                                                    <span class="ico-product ico-sale">Sale</span>
		                                                                </div>
		
		                                                             <a class="product-image have-additional"
		                                                                title="{{$product->title}}"
		                                                                href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
		                                                                <span class="img-main">
				                                                               <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" />
		                                                                </span>
		                                                             </a>
		                                                         </div>
		                                                         <div class="item-info">
		                                                             <div class="info-inner">
		                                                                 <div class="item-title">
		                                                                     <a title="{{$product->title}}"
		                                                                        href="detail.html">
		                                                                         {{$product->title}} </a>
		                                                                 </div>
		                                                                 <div class="item-price">
		                                                                     <div class="price-box">
		                                                                <span class="regular-price">
		                                                                    <span class="price">
		                                                                        
									                                                        <span class="price1">${{\App\Product::Cost($product->id)}}</span>								                                                        
									                                                   
									                                                    @if($product->previous_price)
									                                                    <span class="price2">${{$product->previous_price}}</span>
									                                                    @endif
									                                                    
		                                                                    </span>
		                                                                </span>
		                                                                     </div>
		                                                                 </div>
		                                                             </div>
		                                                         </div>
		                                                         <div class="action-bot">
		                                                             <div class="wrap-addtocart">
		                                                                 <button class="btn-cart"
		                                                                         title="Add to Cart">
		                                                                     <i class="fa fa-shopping-cart"></i>
		                                                                     <span>Add to Cart</span>
		                                                                 </button>
		                                                             </div>
		                                                             <div class="actions">
		                                                                 <ul class="add-to-links">
		                                                                     <li>
		                                                                         <a class="link-wishlist"
		                                                                            href="#"
		                                                                            title="Add to Wishlist">
		                                                                             <i class="fa fa-heart"></i>
		                                                                         </a>
		                                                                     </li>
		                                                                     <!-- <li>
		                                                                         <a class="link-compare"
		                                                                            href="#"
		                                                                            title="Add to Compare">
		                                                                             <i class="fa fa-random"></i>
		                                                                         </a>
		                                                                     </li> -->
		                                                                     <li class="wrap-quickview" data-id="qv_item_7">
		                                                                         <div class="quickview-wrap">
		                                                                             <a class="sns-btn-quickview qv_btn"
		                                                                                href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
		                                                                                 <i class="fa fa-eye"></i>
		                                                                             </a>
		                                                                         </div>
		                                                                     </li>
		                                                                 </ul>
		                                                             </div>
		                                                         </div>
		                                                     </div>
		                                                 </div>
		                                             </div>
					                                @empty
					                                    <div class="item col-lg-2d4 col-md-3 col-sm-4 col-xs-6 col-phone-12">
					                                        <div class="item-inner">
					                                            <h3>{{$language->no_result}}</h3>
					                                        </div>
					                                    </div>
					                                @endforelse
                                        </div>
                                    </div>


                                    <div role="tabpanel" class="tab-pane" id="casual">
                                        <div class="products-grid row style_grid">
                                             @forelse($products as $product)
		                                         		<div class="item col-lg-2d4 col-md-3 col-sm-4 col-xs-6 col-phone-12">
		                                                 <div class="item-inner">
		                                                     <div class="prd">
		                                                         <div class="item-img clearfix">
		                                                             <div class="ico-label">
		                                                                    <span class="ico-product ico-new">New</span>
		                                                                    <span class="ico-product ico-sale">Sale</span>
		                                                                </div>
		
		                                                             <a class="product-image have-additional"
		                                                                title="{{$product->title}}"
		                                                                href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
		                                                                <span class="img-main">
				                                                               <img src="{{url('/assets/images/products')}}/{{$product->feature_image}}" alt="Product Image" />
		                                                                </span>
		                                                             </a>
		                                                         </div>
		                                                         <div class="item-info">
		                                                             <div class="info-inner">
		                                                                 <div class="item-title">
		                                                                     <a title="{{$product->title}}"
		                                                                        href="detail.html">
		                                                                         {{$product->title}} </a>
		                                                                 </div>
		                                                                 <div class="item-price">
		                                                                     <div class="price-box">
		                                                                <span class="regular-price">
		                                                                    <span class="price">
		                                                                        
									                                                        <span class="price1">${{\App\Product::Cost($product->id)}}</span>								                                                        
									                                                   
									                                                    @if($product->previous_price)
									                                                    <span class="price2">${{$product->previous_price}}</span>
									                                                    @endif
									                                                    
		                                                                    </span>
		                                                                </span>
		                                                                     </div>
		                                                                 </div>
		                                                             </div>
		                                                         </div>
		                                                         <div class="action-bot">
		                                                             <div class="wrap-addtocart">
		                                                                 <button class="btn-cart"
		                                                                         title="Add to Cart">
		                                                                     <i class="fa fa-shopping-cart"></i>
		                                                                     <span>Add to Cart</span>
		                                                                 </button>
		                                                             </div>
		                                                             <div class="actions">
		                                                                 <ul class="add-to-links">
		                                                                     <li>
		                                                                         <a class="link-wishlist"
		                                                                            href="#"
		                                                                            title="Add to Wishlist">
		                                                                             <i class="fa fa-heart"></i>
		                                                                         </a>
		                                                                     </li>
		                                                                     <!-- <li>
		                                                                         <a class="link-compare"
		                                                                            href="#"
		                                                                            title="Add to Compare">
		                                                                             <i class="fa fa-random"></i>
		                                                                         </a>
		                                                                     </li> -->
		                                                                     <li class="wrap-quickview" data-id="qv_item_7">
		                                                                         <div class="quickview-wrap">
		                                                                             <a class="sns-btn-quickview qv_btn"
		                                                                                href="{{url('/product')}}/{{$product->id}}/{{str_replace(' ','-',strtolower($product->title))}}">
		                                                                                 <i class="fa fa-eye"></i>
		                                                                             </a>
		                                                                         </div>
		                                                                     </li>
		                                                                 </ul>
		                                                             </div>
		                                                         </div>
		                                                     </div>
		                                                 </div>
		                                             </div>
					                                @empty
					                                    <div class="item col-lg-2d4 col-md-3 col-sm-4 col-xs-6 col-phone-12">
					                                        <div class="item-inner">
					                                            <h3>{{$language->no_result}}</h3>
					                                        </div>
					                                    </div>
					                                @endforelse
                                        </div>
                                    </div>
                                  </div>
                                  <h3 class="bt-more">
                                    <span>Load more items</span>
                                  </h3>
                                </div>   

                               <!--  <div class="clearfix"></div> -->

                             </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- AND CONTENT -->
            <!-- PARTNERS -->
            <div id="sns_partners" class="wrap">
                <div class="container">
                    <div class="slider-wrap">
                        <div class="partners_slider_in">
                            <div id="partners_slider1" class="our_partners owl-carousel owl-theme owl-loaded" style="display: inline-block">
                                <div class="item">
                                    <a class="banner11" href="#" target="_blank">
                                        <img alt="" src="{{url('/assets2/images/brands/1.png')}}">
                                    </a>
                                </div>
                                <div class="item">
                                    <a class="banner11" href="#" target="_blank">
                                        <img alt="" src="{{url('/assets2/images/brands/2.png')}}">
                                    </a>
                                </div>
                                <div class="item">
                                    <a class="banner11" href="#" target="_blank">
                                        <img alt="" src="{{url('/assets2/images/brands/3.png')}}">
                                    </a>
                                </div>
                                <div class="item">
                                    <a class="banner11" href="#" target="_blank">
                                        <img alt="" src="{{url('/assets2/images/brands/4.png')}}">
                                    </a>
                                </div>
                                <div class="item">
                                    <a class="banner11" href="#" target="_blank">
                                        <img alt="" src="{{url('/assets2/images/brands/5.png')}}">
                                    </a>
                                </div>
                                <div class="item">
                                    <a class="banner11" href="#" target="_blank">
                                        <img alt="" src="{{url('/assets2/images/brands/6.png')}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- AND PARTNERS -->

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