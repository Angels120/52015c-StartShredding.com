@extends('includes.newmaster2')

@section('content')
<style>
    .jumbotron {
    background-color:#fff !important;
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">


<div class="home-wrapper">
    <!-- Starting of login area -->
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank you for signing up!</h1>
        <p class="lead"><strong>Please check your inbox for the account activation link.</strong></p>
        <hr>
        {{-- <p>
          Having trouble? <a href="">Contact us</a>
        </p> --}}
        <p class="lead">
          <a class="btn btn-primary btn-sm" href="{{ url('/') }}" role="button">Continue to homepage</a>
        </p>
      </div>
    <!-- Ending of login area -->
</div>
@stop

@section('footer')



@stop