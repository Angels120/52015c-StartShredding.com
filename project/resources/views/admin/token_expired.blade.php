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
</head>

<body>
    <div class="home-wrapper">
        <!-- Starting of login area -->
        <div class="jumbotron text-center" style="margin-top: 5%">
            <h1 class="display-3">Oops!!</h1>
            <p class="lead"><strong>Your password reset link is expired..</strong></p>
            <hr>
            <p class="lead">
                <a class="btn btn-primary btn-sm" href="{{ url('/admin') }}" role="button">Back to Sign In</a>
            </p>
        </div>
        <!-- Ending of login area -->
    </div>

    <!-- jQuery -->
    <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.js')}}"></script>
</body>

</html>