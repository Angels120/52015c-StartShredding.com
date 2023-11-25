@extends('home.includes.master_new')

@section('header')
    @include('home.includes.header_new')
@stop

@section('content')
    <section class="demo-hero-5" data-pages="parallax" data-pages-bg-image="{{ URL::asset('assets_new/assets/images/sub-banner.jpg') }}">
        <div class="container-xs-height full-height">
            <div class="col-xs-height col-middle text-center">
                <h1 class="inner m-t-100 p-b-50 m-b-50 main-title">Request Quote</h1>
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
                            <div class="padding-30 sm-padding-5 text-center">
                                <h3 class="bold">Thank You!</h3>
                                <p>Your Quote Request has been received and one of our representatives will <br> contact
                                    you within 24 hours to provide our best available rates for your service.</p>
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