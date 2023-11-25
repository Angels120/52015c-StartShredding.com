@extends('home.includes.master',['cart_result'=> $response])

@section('header')
    @include('home.includes.header')
@stop
@section('content')
    <style>
        .logo {
            margin-top: 10px;
        }
        .login-btn:hover
        {
            color: #0059B2;
        }
        .field-icon
        {
            float: right;
            position: relative;
            z-index: 2;
            top: -24px;
            left: -7px;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <section class="p-b-65 p-t-50 m-t-30">
    <div class="container">
        <div class="row">
                <div class="col-sm-2 col-xs-12 hidden-xs col-sm-offset-2">
                    <div>
{{--                        <img class="login-logo" src="{{ url('/assets/img/ube_logo_ig.png') }}">--}}
                    </div>
                </div>

                <div class="col-sm-4  col-xs-12">
                    <div class="row">
                                @if ($login_message = Session::get('login_message'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>{{ $login_message}}</strong>
                                    </div>
                                @endif
                    </div>
                    <div class="signIn-area">
                        <h2 class="signIn-title">Sign in</h2>
                        <hr />
                        <form action="{{route('home.login.submit') }}" method="POST">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">Email Address <span>*</span></label>
                                <input class="form-control" value="{{ old('email') }}" type="email" name="email"
                                       id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span>*</span></label>
                                <input class="form-control" type="password" name="password" id="password" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a href="{{route('home.register.submit')}}">Create New Account</a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                        <a href="{{route('home.forgotpass')}}">Forgot your Password?</a>
                                    </div>
                                </div>
                            </div>
                            <div id="resp">
                                @if ($errors->has('password'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                                @endif
                                @if ($errors->has('email'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                                @endif
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif
                                @if ($message = Session::get('warning'))
                                <div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="btn btn-md login-btn" type="submit" value="LOGIN">
                            </div>
                        </form>
                    </div>
                </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br>

            </div>
        </div>

</section>   
@stop
@section('footer')
    @include('home.shop.includes.footer')
@stop
