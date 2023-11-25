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
</head>

<body>
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
                            <form action="{{ route('admin.forgotpass.submit') }}" method="POST">
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
                                            <a href="{{url('/admin')}}">Return to login</a>
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

    <!-- jQuery -->
    <script src="{{ URL::asset('assets/js/jquery.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
</body>

</html>