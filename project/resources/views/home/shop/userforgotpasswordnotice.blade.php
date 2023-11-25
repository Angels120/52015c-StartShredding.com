@extends('home.includes.master',['cart_result'=> $response])

@section('header')
    @include('home.includes.header')
@stop
@section('content')
    <style>
        .jumbotron {
            background-color:#fff !important;
        }
        .btn-primary, .btn-primary:focus {
            background-color: #000080;
            border-color: #000080;
        }
        .btn-primary:hover {
            background-color: #fff;
            color: #000080;
            border-color: #000080;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <section class="p-b-65 p-t-20 m-t-30">
        <div class="container">
            <div class="row">
                <!-- Starting of login area -->
                <div class="jumbotron text-center" style="margin-top: 10%">
                    <!-- <h1 class="display-3">Thank you for signing up!</h1> -->
                    <p class="lead"><strong>We have sent the temporary password to the email you provided.
                            <br>It will give you a link that will enable you to create a New Password.</strong></p>
                    <hr>
                    <p class="lead">
                        <a class="btn btn-primary btn-sm" href="{{ route('home.user') }}" role="button">Back to Sign In</a>
                    </p>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
                <!-- Ending of login area -->
            </div>
        </div>
    </section>
@stop
@section('footer')
    @include('home.shop.includes.footer')
@stop