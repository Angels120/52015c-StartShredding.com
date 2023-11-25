@extends('home.includes.master',['cart_result'=> $response])

@section('header')
    @include('home.includes.header')
@stop
@section('content')
    <style>
        .btn-primary, .btn-primary:focus {
            background-color: #000080;
            border-color: #000080;
        }
        .jumbotron {
            background-color: #fff !important;
        }
    </style>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <br>
    <section class="p-b-65 p-t-20 m-t-30">
        <div class="container">
            <div class="row">
                <!-- Starting of login area -->
                <div class="jumbotron text-center" style="margin-top: 6%">
                    <h1 class="display-3">Oops!!</h1>
                    <p class="lead"><strong>Your password reset link is expired..</strong></p>
                    <hr>
                    <p class="lead">
                        <a class="btn btn-primary btn-sm" href="{{ route('home.user') }}" role="button">Back to Sign
                            In</a>
                    </p>
                </div>
                <br>
                <br>
                <br>
                <!-- Ending of login area -->
            </div>
        </div>
    </section>
@stop
@section('footer')
    @include('home.shop.includes.footer')
@stop