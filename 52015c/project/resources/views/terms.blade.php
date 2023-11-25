@extends('home.includes.master_new')

@section('header')
    @include('home.includes.header_new')
@stop

@section('content')

    <section class="demo-hero-5" data-pages="parallax" data-pages-bg-image="{{ URL::asset('assets_new/assets/images/sub-banner.jpg') }}">
        <div class="container-xs-height full-height">
            <div class="col-xs-height col-middle text-center">
                <h1 class="inner m-t-100 p-b-50 m-b-50 main-title">Terms & Conditions</h1>
            </div>
        </div>
    </section>
    <div class="container-fluid bg-master-lightest">
        <div class=" container container-fixed-lg">

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="slide-left padding-20 sm-no-padding" id="tab5">
                    <div class="row row-same-height">
                        <div class="col-md-12">
                            <div class="padding-30 sm-padding-5">
                                <h3 class="bold">Terms & Conditions</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus sapien eu
                                    metus consequat vulputate. Aenean gravida auctor nibh, sed ultricies quam rutrum
                                    vitae. Aenean feugiat elit eu orci suscipit, in hendrerit ex porttitor. Nunc
                                    ultricies mollis nisi, vel luctus odio porttitor vitae. Curabitur mattis id turpis
                                    sed tempor. Duis laoreet ultricies metus eget pharetra. Vestibulum pharetra ligula
                                    ut tempus ullamcorper. Nunc et ullamcorper lacus, eu varius metus. In mollis
                                    condimentum ipsum a consectetur. Ut lacus tellus, malesuada eu ligula vitae,
                                    sagittis pulvinar ipsum. Pellentesque vitae est ut erat faucibus pretium.
                                    Suspendisse eu efficitur sapien, non porta diam.</p>
                                <p>Sed ut tortor mauris. Nulla tempor est tortor, eu efficitur dolor scelerisque luctus.
                                    Aliquam erat volutpat. Sed ac sapien nulla. Etiam bibendum scelerisque urna id
                                    eleifend. Etiam sodales ultricies elit ac dapibus. Curabitur vulputate gravida enim,
                                    commodo maximus quam venenatis at. Ut et nulla non libero malesuada tempus eu vel
                                    massa. Vivamus congue odio a augue varius congue. Aenean tortor felis, egestas quis
                                    nulla at, dapibus ultrices nulla. Nullam tempus massa id ligula convallis placerat.
                                    Pellentesque imperdiet tincidunt dui non scelerisque. In leo eros, varius in felis
                                    et, fringilla condimentum purus. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop

@section('footer')
    @include('home.includes.footer_new')
@stop