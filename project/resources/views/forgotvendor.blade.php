@extends('includes.newmaster2')

@section('content')

<div class="home-wrapper">
    <!-- Starting of login area -->
    <div class="section-padding forgotlog-area-wrapper wow fadeInUp">
        <div class="container">

            <div class="row">
                <div class="col-sm-3 col-xs-12 hidden-xs col-sm-offset-2">
                    <div class="text-right">
                        <img class="login-logo" src="{{ url('/assets/img/ube_logo_ig.png') }}">
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="forgot-area">
                        <h2 class="signIn-title">Forgot Password</h2>
                        <hr />
                        <form action="{{ route('vendor.forgotpass.submit') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">Email Address <span>*</span></label>
                                <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="email" required>
                            </div>

                            <div id="resp">
                                @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('success') }}
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
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="btn btn-md login-btn" id="forgot-btn" type="submit" value="SUBMIT">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                        <a href="{{url('/vendor')}}">Return to login</a>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    $(document).ready(function() {
        $(document).on('submit', 'form', function() {
            $('#forgot-btn').attr('disabled', 'disabled');
        });
    });
</script>
@stop