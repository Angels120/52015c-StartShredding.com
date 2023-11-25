@extends('includes.newmaster')

@section('content')


    <section style="background: url({{url('/')}}/assets/images/{{$settings[0]->background}}) no-repeat center center; background-size: cover;">
        <div class="row" style="background-color:rgba(0,0,0,0.7);">

            <div style="margin: 3% 0px 3% 0px;">
                <div class="text-center" style="color: #FFF;padding: 20px;">
                    <h1>{{$language->contact_us}}</h1>
                </div>
            </div>

        </div>
    </section>

    <div class="home-wrapper">
        <!-- Starting of contact us area -->
        <div class="section-padding contact-area-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="contact-area-fullDiv">
                            <p>{{$language->contact_us_today}}</p>
                            <div class="comments-area">
                                <div class="comments-form">
                                    <form action="{{action('FrontEndController@contactmail')}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" name="to" value="{{$pagedata->contact_email}}">
                                        <!-- Success message -->
                                        @if(Session::has('cmail'))
                                            <div class="alert alert-success" role="alert" id="success_message">
                                                {{ Session::get('cmail') }}
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input name="name" type="text" placeholder="Your Name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input name="phone" type="tel" placeholder="Your Phone">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input name="email" type="email" placeholder="Your Email" required>
                                            </div>
                                        </div>
                                        <p><textarea name="message" id="comment" placeholder="Write a Replay" cols="30" rows="10" required></textarea></p>
                                        <input name="contact_btn" type="submit" value="Send Message">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5">
                        <div class="contact-info-div">
                            <p class="contact-info">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                {{$settings[0]->address}}
                            </p>
                            @if($settings[0]->phone != null)
                                <p class="contact-info">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    Phone :  <a href="tel:{{$settings[0]->phone}}">{{$settings[0]->phone}}</a><br/>
                                </p>
                            @endif
                            @if($settings[0]->fax != null)
                                <p class="contact-info">
                                    <i class="fa fa-fax" aria-hidden="true"></i>
                                    Fax :  <a href="tel:{{$settings[0]->fax}}">{{$settings[0]->fax}}</a><br/>
                                </p>
                            @endif
                            <p class="contact-info">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                Site :  <a href="{{url('/')}}">{{$_SERVER['SERVER_NAME']}}</a><br/>
                            </p>
                            <p class="contact-info">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                Email :  <a href="mailto:{{$settings[0]->email}}">{{$settings[0]->email}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of contact us area -->
    </div>




    {{----}}
    {{----}}
    {{--<div id="wrapper" class="go-section">--}}
        {{--<div class="row">--}}
            {{--<div class="container">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="container">--}}
                        {{--<!-- Form Name -->--}}
                        {{--<h3>{{$language->contact_us_today}}</h3>--}}
                        {{--<hr>--}}

                        {{--<form action="{{action('FrontEndController@contactmail')}}" method="post">--}}
                            {{--{{csrf_field()}}--}}
                            {{--<input type="hidden" name="to" value="{{$pagedata->contact_email}}">--}}
                            {{--<!-- Success message -->--}}
                            {{--@if(Session::has('cmail'))--}}
                            {{--<div class="alert alert-success" role="alert" id="success_message">--}}
                                {{--{{ Session::get('cmail') }}--}}
                            {{--</div>--}}
                            {{--@endif--}}
                            {{--<!-- Text input-->--}}
                            {{--<div class="row">--}}
                                {{--<div class="form-group col-md-6">--}}
                                    {{--<input name="name" placeholder="Name" class="form-control" type="text" required>--}}
                                    {{--<p id="nameError" class="errorMsg"></p>--}}
                                {{--</div>--}}

                                {{--<div class="form-group col-md-6">--}}
                                    {{--<input name="email" placeholder="Email" class="form-control"  type="email" required>--}}
                                    {{--<p id="emailError" class="errorMsg"></p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="form-group col-md-6">--}}
                                    {{--<input name="phone" placeholder="Phone" class="form-control"  type="text" required>--}}
                                    {{--<p id="phoneError" class="errorMsg"></p>--}}
                                {{--</div>--}}

                                {{--<div class="form-group col-md-6">--}}
                                    {{--<select name="department" class="form-control selectpicker" required>--}}
                                        {{--<option value="">Select Gender</option>--}}
                                        {{--<option value="Male">Male</option>--}}
                                        {{--<option value="Female">Female</option>--}}
                                        {{--<option value="Others">Others</option>--}}
                                    {{--</select>--}}
                                    {{--<p id="departmentError" class="errorMsg"></p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="form-group col-md-12">--}}
                                    {{--<textarea class="form-control" placeholder="Message" name="message" rows="8" required></textarea>--}}
                                    {{--<p id="messageError" class="errorMsg"></p>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div id="resp"></div>--}}
                            {{--<!-- Button -->--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-5 control-label"></label>--}}
                                {{--<div class="col-md-2">--}}
                                    {{--<button type="submit" class="button style-10" >{{$language->submit}}</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}


@stop

@section('footer')

@stop