@extends('includes.newmaster')

@section('content')

    <div class="home-wrapper">
        <!-- Starting of login area -->
        <div class="section-padding login-area-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="signIn-area">
                            <h2 class="signIn-title">Vendor Forgot Password</h2>
                            <hr/>
                            <form action="{{ route('vendor.forgotpass.submit') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="email">Email Address <span>*</span></label>
                                    <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="email" required>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                            <a href="{{url('vendor')}}">Login Now</a>
                                        </div>
                                    </div>
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
                                    <input class="btn btn-md login-btn" type="submit" value="SUBMIT">
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

@stop