@extends('admin.includes.master-admin')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" id="main">
            <!-- Page Heading -->
            <div class="go-title">
                <div class="pull-right">
                    <a href="{!! url('admin/referrals') !!}" class="btn btn-default btn-back"><i
                            class="fa fa-arrow-left"></i> Back</a>
                </div>
                <h3>Edit Referral Program {{ $ReferralProgram['id'] }}</h3>
                <div class="go-line"></div>
            </div>
            <!-- Page Content -->
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(Session::has('message'))
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('message') }}
                    </div>
                    @endif
                    <div id="response"></div>
                    <form method="POST" action="{!! action('ReferralProgramController@update',['referral' => $ReferralProgram->id]) !!}"
                        class="form-horizontal form-label-left">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Program
                            Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12" name="name"
                                value="{{$ReferralProgram->name}}" required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uri">URL <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="uri" class="form-control col-md-7 col-xs-12" name="uri"
                                value="{{$ReferralProgram->uri}}" required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="limit">Limit <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="limit" class="form-control col-md-7 col-xs-12" name="limit"
                                value="{{$ReferralProgram->limit}}" required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">Amount <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="amount" class="form-control col-md-7 col-xs-12" name="amount"
                                value="{{$ReferralProgram->amount}}" required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expire_date">Expire Date <span
                                class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="expire_date" class="form-control col-md-7 col-xs-12" name="expire_date"
                                value="{{$ReferralProgram->expire_date}}" type="date">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-success btn-block">Update</button>
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
@stop

@section('footer')

@stop