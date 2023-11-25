@extends('includes.newmaster2')

@section('content')

<div class="home-wrapper">
    <!-- Starting of login area -->
    <div class="section-padding login-area-wrapper wow fadeInUp">
        <div class="container">



            <div class="row">
                <div class="col-sm-3 col-xs-12 hidden-xs col-sm-offset-2">
                    <div>
                        <img class="login-logo" src="{{ url('/assets/img/ube_logo_ig.png') }}">
                    </div>
                </div>

                <div class="col-sm-5  col-xs-12">
                    <div class="signIn-area">

                        <!-- <hr /> -->
                        <!-- <br><br><br><br><br><br> -->
                        <form action="{{ route('customer.chang_pass') }}" method="POST" style="padding-top:25%;">

                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="password">Set Password <span>*</span></label>
                                        <input class="form-control" type="password" name="password" id="password"
                                            required>
                                        <span toggle="#password"
                                            class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>

                                    <div id="resp">
                                        @if ($errors->has('password'))
                                        <div class="alert alert-danger alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-md login-btn" type="submit" value="SAVE">
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
        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('.login-btn').attr('disabled', 'disabled');
            });
        });
</script>
@stop
