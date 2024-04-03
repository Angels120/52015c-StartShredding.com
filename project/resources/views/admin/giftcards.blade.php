@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/gift-cards/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Gift Card</a>
                    </div>
                    <h3>Gift Cards</h3>
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
                        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>description</th>
                                <th>Purchase Price</th>
                                <th>Credit Amount</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($giftcards as $giftcard)
                                <tr class="{{ $giftcard->type != 1 ? 'active' : null}}">
                                    <td>{{$giftcard->title}}</td>
                                    <td>{{$giftcard->description}}</td>
                                    <td>$ {{$giftcard->purchase_price}}</td>
                                    <td>$ {{$giftcard->credit_amount}}</td>
                                    <td>
                                        @if($giftcard->type == 1)
                                            Gift Card
                                        @else
                                            Give Away
                                        @endif
                                    </td>
                                    <td>
                                        @if($giftcard->status == 1)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{!! action('GiftCardController@destroy',['gift_card' => $giftcard->id]) !!}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="{!! url('admin/gift-cards') !!}/{{$giftcard->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                            @if($giftcard->status==1)
                                                <a href="{!! url('admin/gift-cards') !!}/status/{{$giftcard->id}}/0" class="btn btn-warning btn-xs"><i class="fa fa-times"></i> Deactive </a>
                                            @else
                                                <a href="{!! url('admin/gift-cards') !!}/status/{{$giftcard->id}}/1" class="btn btn-primary btn-xs"><i class="fa fa-times"></i> Active </a>
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