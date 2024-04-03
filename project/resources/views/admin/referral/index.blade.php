@extends('admin.includes.master-admin')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" id="main">

            <!-- Page Heading -->
            <div class="go-title">
                <h3>Referral Program</h3>
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
                    <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>URL</th>
                                <th width="10%">Limit</th>
                                <th width="10%">Amount</th>
                                <th>Expire Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($refPrograms as $refProgram)
                            <tr>
                                <td>{{$refProgram->name}}</td>
                                <td>{{$refProgram->uri}}</td>
                                <td>{{$refProgram->limit}}</td>
                                <td>{{$refProgram->amount}}</td>
                                <td>{{date($refProgram->expire_date)}}</td>
                                <td>
                                    <form method="POST"
                                        action="{!! action('ReferralProgramController@destroy',['referral' => $refProgram->id]) !!}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="referrals/{{$refProgram->id}}/edit" class="btn btn-primary btn-xs"><i
                                                class="fa fa-pencil"></i> Edit </a>

                                        {{-- <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                            Remove </button> --}}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.end -->
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