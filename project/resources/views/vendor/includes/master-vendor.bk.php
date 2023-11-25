<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="GeniusOcean Admin Panel.">
    <meta name="author" content="GeniusOcean">
    <link rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />

    <title>{{$settings[0]->title}} - Vendor Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('assets/vendor/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/css/style.css')}}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>

<div id="wrapper"><!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{!! url('admin/dashboard') !!}">
            <img class="logo" src="{!! url('assets/images/logo') !!}/{{$settings[0]->logo}}" alt="LOGO">
        </a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">

        <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="fa fa-angle-down"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{!! url('vendor/vendorprofile') !!}"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                <li><a href="{!! url('vendor/vendorpassword') !!}"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-power-off"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{!! url('vendor/dashboard') !!}"><i class="fa fa-fw fa-home"></i>  Dashboard</a>
            </li>
            <li>
                <a href="{!! url('vendor/orders') !!}"><i class="fa fa-fw fa-usd"></i> Orders</a>
            </li>
            <li>
                <a href="{!! url('vendor/products') !!}"><i class="fa fa-fw fa-shopping-cart"></i> Products</a>
            </li>
            <li>
                <a href="{!! url('vendor/withdraws') !!}"><i class="fa fa-fw fa-list"></i> Withdraw</a>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

@yield('content')

</div><!-- /#wrapper -->
<!-- /#wrapper -->
<script>
    var baseUrl = '{!! url('/') !!}';
</script>
<!-- jQuery -->
<script src="{{ URL::asset('assets/vendor/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ URL::asset('assets/vendor/js/bootstrap.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>

	$(document).ready( function () {
	    $('#table_1').DataTable({
	    	"bPaginate": false,
	    	"searching": false,
	    	"bInfo" : false,
	    	"columnDefs": [
			    { "orderable": false, "targets": 0 }
			]
	    });
	    $('#table_2').DataTable({
	    	"bPaginate": false,
	    	"searching": false,
	    	"bInfo" : false,
	    	"columnDefs": [
			    { "orderable": false, "targets": 0 }
			]
	    });
	    $('#table_3').DataTable({
	    	"bPaginate": false,
	    	"searching": false,
	    	"bInfo" : false,
	    	"columnDefs": [
			    { "orderable": false, "targets": 0 }
			]
	    });
	});

	$( ".toggle-notify" ).click(function() {
	  $( ".drop-down.notify" ).toggle( "slow", function() {
	    // Animation complete.
	  });
	});
	$( ".toggle-user" ).click(function() {
	  $( ".drop-down.user" ).toggle( "slow", function() {
	    // Animation complete.
	  });
	});
	$( ".toggle-setting" ).click(function() {
	  $( ".drop-down.setting" ).toggle( "slow", function() {
	    // Animation complete.
	  });
	});
	 $("#datepicker").datepicker({ 
	        autoclose: true, 
	        todayHighlight: true
	  }).datepicker('update', new Date());
    $("#maincats").change(function () {
        $("#subs").html('<option value="">Select Sub Category</option>');
        $("#subs").attr('disabled',true);
        $("#childs").html('<option value="">Select Sub Category</option>');
        $("#childs").attr('disabled',true);
        var mainid = $(this).val();
        $.get('{{url('/')}}/subcats/'+mainid, function(response){
            $("#subs").attr('disabled',false);
            $.each(response, function(i, cart){
                $.each(cart, function (index, data) {
                    $("#subs").append('<option value="'+data.id+'">'+data.name+'</option>');
                    //console.log('index', data)
                })
            })
        });
    });
    $("#subs").change(function () {
        $("#childs").html('<option value="">Select Sub Category</option>');
        $("#childs").attr('disabled',true);
        var mainid = $(this).val();
        $.get('{{url('/')}}/childcats/'+mainid, function(response){
            $("#childs").attr('disabled',false);
            $.each(response, function(i, cart){
                $.each(cart, function (index, data) {
                    $("#childs").append('<option value="'+data.id+'">'+data.name+'</option>');
                    //console.log('index', data)
                })
            })
        });
    });


</script>
@yield('footer')
</body>
</html>

