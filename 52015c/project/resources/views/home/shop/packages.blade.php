@extends('home.shop.includes.master',['cart_result'=> $response])

@section('header')
    @include('home.shop.includes.header')
@stop
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
            font-size: 21px;
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
            background-color: #1d1c80;
            background-size: auto;
            background-repeat: repeat-x;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
        }

        .reccomend button {
            background-image: url('{{ url('assets/img/btn-pattern2.png') }}')!important;
            background-size: auto;
            background-repeat: repeat-x;
        }

        .card-btn button:hover {
            background-color: #1e7e34;
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
        .card {
            width: unset;
            margin-bottom:unset;
            float:unset;
        }
        h1 {
            line-height:unset;
            letter-spacing:unset;
        }
        .btn {
            background-color:unset;
        }
        dd, p {
            font-weight:unset;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <section class="p-b-65 p-t-50 m-t-30">
        <div class="container">
            <div class="row">
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
                <br/>
                <div class="col-sm-9 col-sm-offset-2">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <p class="subtitle">The Bigger The Package, The Bigger The Savings.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card-package">
                                <div class="card">
                                    <div class="package-title">
                                      Starter
                                    </div>
                                    <div class="package-credit">
                                        275 <span>Credits</span>
                                    </div>
                                    <div class="package-details">
                                        <p>Purchase $250 and <br>Receive 275 credits</p>
                                    </div>
                                </div>
                                <form action="{{ route('home.buy.credits') }}" method="post">
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
                            <div class="card-package">
                                <div class="card">
                                    <div class="package-title">
                                        Small Business
                                    </div>
                                    <div class="package-credit">
                                        575 <span>Credits</span>
                                    </div>
                                    <div class="package-details">
                                        <p>Purchase $500 and <br>Receive 575 credits</p>
                                    </div>
                                </div>
                                <form action="{{ route('home.buy.credits') }}" method="post">
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
                            <div class="card-package">
                                <div class="card">
                                    <div class="package-title">
                                        Enterprise
                                    </div>
                                    <div class="package-credit">
                                        1250 <span>Credits</span>
                                    </div>
                                    <div class="package-details">
                                        <p>Purchase $1000 and <br> Receive 1250 credits</p>
                                    </div>
                                </div>
                                <form action="{{ route('home.buy.credits') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="select" value="4">
                                    <div class="card-btn">
                                        <button type="submit" class="btn btn-block">
                                            Buy Now
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@stop
@section('footer')
    @include('home.shop.includes.footer')
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