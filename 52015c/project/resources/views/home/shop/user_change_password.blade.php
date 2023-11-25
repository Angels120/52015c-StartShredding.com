@extends('home.includes.master',['cart_result'=> $response])

@section('header')
    @include('home.includes.header')
@stop
@section('content')
<style type="text/css">
    .field-icon {
    float: right;
    position: relative;
    z-index: 2;
    top: -24px;
    left: -7px;
}

</style>
    <section class="p-b-65 p-t-100 m-t-20">
        <div class="container">
            <div class="row">

                <div class="container-fluid">
                    <!-- Starting of product filter area -->
                    <div class="section-padding product-filter-wrapper wow fadeInUp">

                        <div class="container inner-block">
                            <div class="row">
                <div class="col-sm-5">
                    <div class="signIn-area">
                        <h2 class="signIn-title">Change Password</h2>
                        <hr />
                        <form action="{{ url('/shop-changePassword') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="password">Password <span>*</span></label>
                                <input class="form-control" type="password" name="password" id="password" value="{{ old('password') }}" required>
                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <input type="hidden" value="{{ $id }}" name="user_id" id="user_id">
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm Password <span>*</span></label>
                                <input class="form-control" type="password" name="password_confirmation" id="con_pwd" value="{{ old('password_confirmation') }}" required>
                                <span toggle="#con_pwd" class="fa fa-fw fa-eye field-icon toggle-password-1" ></span>
                            </div>
                            
                            <!-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a href="{{route('vendor.reg')}}">Create New Account</a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                        <a href="{{route('vendor.forgotpass')}}">Forgot your Password?</a>
                                    </div>
                                </div>
                            </div> -->
                            <div id="resp">

                                @if ($errors->has('email'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $errors->first('email') }}
                                </div>

                                @endif
                                @if ($errors->has('password'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $errors->first('password') }}
                                </div>
                                @endif
                                @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('error') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="btn btn-md login-btn" type="submit" value="CHANGE">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    <!-- Ending of login area -->
     </div>
    </section>
@stop

@section('footer')
<script>
    $(".toggle-password").click(function() {
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
            $(this).toggleClass("far fa-eye-slash");
        } else {
            input.attr("type", "password");
            $(this).toggleClass("far fa-eye");
        }
    });

    $(".toggle-password-1").click(function() {
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
            $(this).toggleClass("far fa-eye-slash");
        } else {
            input.attr("type", "password");
            $(this).toggleClass("far fa-eye");
        }
    });
</script>

@stop

