@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/coupons/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Coupon</a>
                    </div>
                    <h3>Coupons</h3>
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
                        </div>
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th width="10%">ID#</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Expiry Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach($coupons as $coupon)
                            <tr>
                                <td>{{$coupon->id}}</td>
                                <td>{{$coupon->code}}</td>
                                <td>{{ucwords($coupon->type)}}</td>
                                <td>
                                    {{ $coupon->type === 'percent' ? $coupon->value . " %" : "$ " . $coupon->value }}
                                </td>
                                <td>
                                    @if($coupon->status == 1)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                                <td>
                                    {{ $coupon->expiry_date }}
                                </td>
                                <td>
                                    <form method="POST" action="{!! action('CouponController@destroy',['coupon' => $coupon->id]) !!}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{!! url('admin/coupons') !!}/{{$coupon->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                        @if($coupon->status==1)
                                            <a href="{!! url('admin/coupons') !!}/status/{{$coupon->id}}/0" class="btn btn-warning btn-xs"><i class="fa fa-times"></i> Deactive </a>
                                        @else
                                            <a href="{!! url('admin/coupons') !!}/status/{{$coupon->id}}/1" class="btn btn-primary btn-xs"><i class="fa fa-times"></i> Active </a>
                                        @endif
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
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