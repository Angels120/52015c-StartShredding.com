@extends('includes.newmaster')

@section('content')

<div class="home-wrapper">
    <!-- Starting of Account Dashboard area -->
    <div class="section-padding dashboard-account-wrapper wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('includes.usermenu')
                </div>
                <div class="col-md-9">
                    <div class="dashboard-content">
                        <div id="account-information-tab">
                            <h1>edit account information</h1>
                            <div class="edit-account-info-div">
                                <h3>account information</h3>
                                @if(Session::has('message'))
                                    <div class="alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                <p><span>*</span> required field</p>
                                <form action="{{ action('ClientsController@update',['id' => $user->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_fname">Full name <span>*</span></label>
                                            <input class="form-control" type="text" name="name" id="dash_fname" value="{{$user->name}}" placeholder="first name" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_email">email address <span>*</span></label>
                                            <input class="form-control" type="email" name="mail" value="{{$user->email}}" id="dash_email" placeholder="email address" disabled required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_email">Phone Number <span>*</span></label>
                                            <input class="form-control" type="text" name="phone" value="{{$user->phone}}" placeholder="Phone Number" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_email">Address <span>*</span></label>
                                            <textarea name="address" placeholder="Address" class="form-control" required>{{$user->address}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_email">City <span>*</span></label>
                                            <input name="city" placeholder="City" value="{{$user->city}}" class="form-control"  type="text" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_email">Postal Code <span>*</span></label>
                                            <input name="zip" placeholder="Postal Code" class="form-control" value="{{$user->zip}}" type="text" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <a class="btn btn-md back-btn" href="{{route('user.account')}}">back</a>
                                            <input class="btn btn-md save-btn" type="submit" value="save">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ending of Account Dashboard area -->
</div>

@stop

@section('footer')

@stop