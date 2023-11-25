@extends('includes.newmaster2')

@section('content')
<style>
    @font-face {
        font-family: 'Fresty Script';
        src: url('{{ url('assets/fonts/FrestyScript.eot') }}');
        src: url('{{ url('assets/fonts/FrestyScript.eot?#iefix') }}') format('embedded-opentype'),
        url('{{ url('assets/fonts/FrestyScript.woff2') }}') format('woff2'),
        url('{{ url('assets/fonts/FrestyScript.woff') }}') format('woff'),
        url('{{ url('assets/fonts/FrestyScript.ttf') }}') format('truetype'),
        url('{{ url('assets/fonts/FrestyScript.svg#FrestyScript') }}.svg#FrestyScript') format('svg');
        font-weight: normal;
        font-style: normal;
    }

    .size-matters {
        font-family: 'Fresty Script';
        font-size: 135px;
        color: #330066;
        margin-top: 0px;
    }

    .subtitle {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 17px;
        margin-bottom: 45px;
    }

    .card-package .card {
        border: 1px solid #010c23;
        padding: 20px;
        text-align: center;
    }

    .package-title {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 22px;
        margin-bottom: 25px;
    }

    .package-title {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 22px;
        margin-bottom: 25px;
    }

    .package-credit {
        font-size: 70px;
        font-weight: bold;
        color: #222222;
        margin-bottom: 50px;
    }

    .package-credit span {
        font-size: 19px;
        display: block;
        text-transform: uppercase;
        line-height: 4px;
        letter-spacing: 3px;
    }

    .package-details {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 10px;
        /* color:#222222; */
    }

    .card-btn {
        margin-top: 5px;
    }

    .card-btn button {
        border: 1px solid #010c23;
        padding: 10px 0px;
        background-image: url('{{ url('assets/img/btn-pattern.png') }}');
        background-size: auto;
        background-repeat: repeat-x;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
    }

    .reccomend button {
        background-image: url('{{ url('assets/img/btn-pattern2.png') }}');
        background-size: auto;
        background-repeat: repeat-x;
    }

    .card-btn button:hover {
        color: #fff;
    }

    .fashionista .card {
        color: #ffffff;
        background-image: url('{{ url('assets/img/card-bg.png') }}');
    }

    .fashionista .package-credit {
        color: #ffffff;
    }

    .fashionista .package-title {
        font-family: 'Fresty Script';
        text-transform: capitalize;
        font-weight: normal;
        letter-spacing: 1px;
        font-size: 50px;
        margin-bottom: 15px;
        line-height: 41px;
    }

    .bottom-title {
        font-weight: bold;
        font-size: 16px;
        margin: 30px 0px;
    }

    .diva .package-title {
        font-size: 39px;
        color: #000b22;
        margin-bottom: 1px;
    }

    .bottom-title a {
        color: #307519;
        font-style: italic;
    }
    /* Responsive design  */
    
    @media screen and (min-width: 1920px){
        div#only-4k {
            margin-top: 11rem;
        }
    }
    

    @media screen and (max-width: 767px) {
        .size-matters {
            font-size: 63px;
        }

        .subtitle {
            font-size: 10px;
            margin-bottom: 19px;
        }

        .card-package {
            margin-bottom: 25px;
        }


    }
</style>
<div class="home-wrapper">
    <!-- Starting of login area -->
    <div class="container">
        <div class="row" id="only-4k">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    @if ($email_confirm_message = Session::get('confirm_email_message'))
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $email_confirm_message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif


                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1 class="size-matters "> SizesMatters.</h1>
                        <p class="subtitle">The Bigger The Package, The Bigger The Savings.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card-package">
                            <div class="card">
                                <div class="package-title">
                                    Basic
                                </div>
                                <div class="package-credit">
                                    55 <span>Credits</span>
                                </div>
                                <div class="package-details">
                                    <p>Purchase $50 and <br>Receive 55 credits</p>
                                </div>
                            </div>
                            <form action="{{ route('buy.credits') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="select" value="2">
                                <div class="card-btn">
                                    <button type="submit" class="btn btn-block">
                                        Buy Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card-package diva">
                            <div class="card">
                                <div class="package-title">
                                    Diva
                                </div>
                                <div class="package-credit">
                                    115 <span>Credits</span>
                                </div>
                                <div class="package-details">
                                    <p>Purchase $100 and <br>Receive 115 credits</p>
                                </div>
                            </div>
                            <form action="{{ route('buy.credits') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="select" value="3">
                                <div class="card-btn">
                                    <button type="submit" class="btn btn-block">
                                        Buy Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card-package fashionista">
                            <div class="card">
                                <div class="package-title">
                                    Fashionista!
                                </div>
                                <div class="package-credit">
                                    275 <span>Credits</span>
                                </div>
                                <div class="package-details">
                                    <p>Purchase $200 and <br> Receive 275 credits</p>
                                </div>
                            </div>
                            <form action="{{ route('buy.credits') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="select" value="4">
                                <div class="card-btn reccomend">
                                    <button type="submit" class="btn btn-block">
                                        Buy Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 text-center bottom-title">
                        <p>Want to try our service? Purchase our worry free <a href="#!" class="trial_link">Trail
                                Package
                                for $25.00</a></p>
                    </div>
                    <form id="trial_form" action="{{ route('buy.credits') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="select" value="1">
                        <button style="display:none" type="submit" class="btn btn-block">SUBMIT</button>
                    </form>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <img src="{{ url('assets/img/paypal-logo.png') }}" alt="paypal"
                            class="img-responsive text-center" style="width: 50px; margin: 0 auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ending of login area -->
</div>
@stop

@section('footer')
<script>
    $(document).ready(function () {
        $(document).on('submit', 'form', function () {
            $('button').attr('disabled', 'disabled');
        });


        $(".trial_link").on('click', function(){
            $("#trial_form button").click();
        });
    });
</script>
@stop