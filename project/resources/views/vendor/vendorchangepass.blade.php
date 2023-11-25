@extends('vendor.includes.master-vendor')

@section('content')

<style>
    .field-icon {
        float: right;
        position: relative;
        z-index: 2;
        top: -24px;
        left: -7px;
    }
</style>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" id="main">

            <!-- Page Heading -->
            <div class="go-title">
                <h3>Change Password</h3>
                <div class="go-line"></div>
            </div>
            <!-- Page Content -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="response">
                        @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('message') }}
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('error') }}
                        </div>
                        @endif

                    </div>
                    <form method="POST" action="{!! action('VendorProfileController@changepass',['id' => $vendor->id]) !!}" class="form-horizontal form-label-left">
                        {{csrf_field()}}
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Current Password<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="cpass" id="cpass" placeholder="Current Password" value="{{ old('cpass') }}" required="required" type="password">
                                <span toggle="#cpass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug"> New Password <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="newpass" id="newpass" placeholder="New Password" value="{{ old('newpass') }}" required="required" type="password">
                                <span toggle="#newpass" class="fa fa-fw fa-eye field-icon toggle-password-1"></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> Re-Type New Password <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="renewpass" id="renewpass" placeholder="Re-Type New Password" value="{{ old('renewpass') }}" required="required" type="password">
                                <span toggle="#renewpass" class="fa fa-fw fa-eye field-icon toggle-password-2"></span>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="update_pass" type="submit" class="btn btn-success btn-block">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<script>
    $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#cpass");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $("body").on('click', '.toggle-password-1', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#newpass");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $("body").on('click', '.toggle-password-2', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#renewpass");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@stop

@section('footer')

@stop