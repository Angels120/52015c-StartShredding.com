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
                    <div class="home-wrapper">
                        <!-- Starting of login area -->
                        <div class="jumbotron text-center" style="margin-top: 10%">
                            <!-- <h1 class="display-3">Thank you for signing up!</h1> -->
                            <p class="lead"><strong>We have sent the temporary password to the email you provided.
                                    <br>It will give you a link that will enable you to create a New Password.</strong></p>
                            <hr>
                            <p class="lead">
                                <a class="btn btn-primary btn-sm" href="{{ url('/admin') }}" role="button">Back to Sign In</a>
                            </p>
                        </div>
                        <!-- Ending of login area -->
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