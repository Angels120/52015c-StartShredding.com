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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    <div class="home-wrapper">
        <!-- Starting of login area -->
        <div class="section-padding login-area-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-xs-12 hidden-xs col-sm-offset-2">
                        <div class="text-right">
                            <img class="login-logo" src="{{ url('/assets/img/ube_logo_ig.png') }}">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="signIn-area">
                            <h2 class="signIn-title">Change Password</h2>
                            <hr />
                            <form action="{{ url('/admin/changePassword') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="password">Password <span>*</span></label>
                                    <input class="form-control" type="password" name="password" id="password" value="{{ old('password') }}" required>
                                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    <input type="hidden" value="{{ $id }}" name="admin_id" id="admin_id">
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Password <span>*</span></label>
                                    <input class="form-control" type="password" name="password_confirmation" id="con_pwd" value="{{ old('password_confirmation') }}" required>
                                    <span toggle="#con_pwd" class="fa fa-fw fa-eye field-icon toggle-password-1"></span>
                                </div>

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
        </div>
        <!-- Ending of login area -->
    </div>

    <!-- jQuery -->
    <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.js')}}"></script>

    <script>
        $("body").on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $("body").on('click', '.toggle-password-1', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#con_pwd");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
</body>

</html>