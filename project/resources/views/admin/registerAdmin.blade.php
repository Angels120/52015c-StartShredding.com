<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="Simple Documentation for project NewsOcean.">
    <meta name="author" content="GeniusOcean">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />

    <title>{{$settings[0]->title}} - Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('assets/css/genius-admin.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets2/css/style.css')}}">

    <script>
        window.Laravel = <?php echo json_encode([
                                'csrfToken' => csrf_token(),
                            ]); ?>
    </script>

    <style>
        .field-icon {
            float: right;
            position: relative;
            z-index: 2;
            top: -24px;
            left: -7px;
        }
    </style>
</head>

<body>

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-12 hidden-xs col-sm-offset-2">
                    <div class="text-right">
                        <img class="login-logo" src="{{ url('/assets/img/ube_logo_ig.png') }}">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="newAccount-area">
                        <h2 class="signIn-title">Create a new Admin account</h2>
                        <hr />

                        @if ($message = Session::get('message'))
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('first_name'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('first_name') }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('last_name'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('last_name') }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('uname'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('uname') }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('email'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('email') }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('password'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('password') }}</strong>
                        </div>
                        @endif
                        <form action="{{route('admin.reg.submit')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="reg_name">First Name <span>*</span></label>
                                    <input class="form-control" value="{{ old('fname') }}" type="text" name="fname" id="fname" required autocomplete="off">
                                    <input class="form-control" type="hidden" value="register" name="page" id="page" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="reg_name">Last Name <span>*</span></label>
                                    <input class="form-control" value="{{ old('lname') }}" type="text" name="lname" id="lname" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="uname">Username<span>*</span></label>
                                    <input class="form-control" value="{{ old('uname') }}" type="text" name="uname" id="uname" required autocomplete="off">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="reg_email">Email Address<span>*</span></label>
                                    <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="reg_email" required autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="reg_password">Password <span>*</span></label>
                                    <input class="form-control" type="password" name="password" id="reg_password" required autocomplete="off">
                                    <span toggle="#reg_password" class="fa fa-fw fa-eye field-icon toggle-password_1"></span>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="confirm_password">Confirm Password <span>*</span></label>
                                    <input class="form-control" type="password" name="password_confirmation" id="confirm_password" required autocomplete="off">
                                    <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password_2"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="btn btn-md login-btn" id="sign-btn" type="submit" value="SIGN UP">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                        <a href="{{url('/admin')}}">Already Have Account?</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div> <!-- /.container -->
    </section>

    <!-- jQuery -->
    <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.js')}}"></script>

    <script>
        $("body").on('click', '.toggle-password_1', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#reg_password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }

        });

        $("body").on('click', '.toggle-password_2', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#confirm_password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }

        });
    </script>
</body>

</html>