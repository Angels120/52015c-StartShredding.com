@extends('home.shop.includes.master',['cart_result'=> $response])

@section('header')
@include('home.shop.includes.header')
@section('content')
<style>
    .jumbotron {
    background-color:#fff !important;
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">


    <section class="p-b-65 p-t-50 m-t-30">
        <div class="container">
            <div class="row">
    <!-- Starting of login area -->
      <div class="jumbotron text-center">
        <h1 class="display-3">Thank you for signing up!</h1>
        <hr>
        {{-- <p>
          Having trouble? <a href="">Contact us</a>
        </p> --}}
        <p class="lead">
          <a class="btn btn-primary btn-sm" href="{{ url('/') }}" role="button">Continue to homepage</a>
        </p>
        <br>
        <div>
        <p class="lead">
        <a class="btn btn-primary btn-sm" href="{{ url('/shop-signin') }}" role="button">Login</a>
        </p>
       </div>
      </div>
    <!-- Ending of login area -->
      </div>
      </div>
    </section>
@stop
@section('footer')
    @include('home.shop.includes.footer')


@stop