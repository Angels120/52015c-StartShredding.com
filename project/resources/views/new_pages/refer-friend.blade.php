@extends('new_includes.new_main')

@section('title','Refer a Friend')



@section('content')
<style>
    ::placeholder {
        /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: red;
        opacity: 1;
        /* Firefox */
    }

    .top-right1 {
        position: absolute !important;
        /* top: 1px; */
        right: 0;
    }

    .font-clr {
        color: #B6B6B6;
    }

    .font-cl1 {
        color: #8533ff;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right;
        text-align: right;
        visibility: hidden;
    }
</style>
<!-- START PAGE CONTENT -->
<div class="content ">

    <div class="container-fluid p-b-50 m-t-40">
        <!-- START card -->
        <div>
            <!-- <div class="card-header separator">
                     <div class="card-title">
                         <h5><strong>Transaction Details</strong></h5>

                     </div>
                 </div>-->
            <!-- <div class="card-body p-t-20">-->
            <!-- <div class="container-fluid"> -->
            @if ($message = Session::get('message_success'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{ $message }}</strong>
            </div>
            @elseif($message = Session::get('message_fail'))
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <!-- <div class="row">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-body">
                            @forelse(Auth::guard('profile')->user()->getReferrals() as $referral)
                            <div class="col-lg-12">
                                <div class="row"> -->
            <!-- <div class="col-lg-6">
                                        <div class="ube-card-title">{{ $referral->program->name }}</div>
                                        Your Referal Code: <code>{{ $referral->code }}</code>
                                        <p>
                                            Number of referred users: {{ $referral->relationships()->count() }}
                                        </p>
                                    </div> -->
            <!-- <div class="col-lg-6">
                                        <form id="{{$referral->code}}" class="form-control"
                                            action="{{url('user/send-refer-mail')}}" method="POST">
                                            <div class="form-group form-group-default ">
                                                <label>Email Address{{ csrf_field() }}</label>
                                                <input type="hidden" class="form-control" form="{{$referral->code}}"
                                                    name="code" id="code" value="{{$referral->code}}">
                                                <input type="email" class="form-control" form="{{$referral->code}}"
                                                    placeholder="Enter Email Address" name="email_add" id="email_add"
                                                    required>
                                                &nbsp;

                                            </div>
                                            <input type="submit" class="btn btn-primary btn-block"
                                                form="{{$referral->code}}" name="Send" Value="Send Mail">


                                        </form>
                                    </div> -->
            <!-- </div>
                            </div>
                            @empty
                            No referrals
                            @endforelse
                        </div>
                    </div>
                </div> -->
            <!-- <div class="col-md-4" style="background-color: #f0f0f0; padding: 40px"> -->
            <!--<div class="card card-default">
                            <div class="card-body">-->
            <!-- <h5 class="font-weight-bold">Why Choose Favourite Items?</h5>
                    <p class="m-b-20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in
                        a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard
                        McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more
                        obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the
                        word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections
                        1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by
                        Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during
                        the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a
                        line in section 1.10.32.</p>

                    <br> -->

            <!--</div>
                    </div>-->
            <!-- </div> 
            </div> -->
            <!-- </div>-->
            <!-- </div> -->
            @php
            $value = 0;
            if($referral->program->name == 'Sign-up Bonus'){
            $value = $referral->program->amount;
            }
            @endphp
            <div class="row">
            <!-- <div class="col-sm-8 col-md-8"> -->
                <div class="col-sm-12 col-md-8" id="refer-column">
                    <div class="refer-img"></div>
                </div>
                <div class="col-md-4" id="refer-column" style="background-color: #f0f0f0; padding: 40px">
                    <div>
                        <div>
                            <!-- <h5 class="font-weight-bold">Why Choose Favourite Items?</h5> -->
                            <div class="m-b-20 font-color">
                                <p> What's better than getting free stuff?
                                    Letting your friends in on the secret
                                    and sharing the wealth!</p>

                                <p>As a token of our appreciation for your
                                    support, we would like to give you a
                                    chance to earn as much free
                                    drycleaning and laundry credits as
                                    possible.
                                </p>
                                <p>Simply tell a friend about us, and
                                    ask them to sign up with your code.
                                    When they do, they will receive
                                    ${{ $value }} in Credits and so will you!
                                </p>
                                <p>That Was Easy!</p>
                            </div>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
            @forelse(Auth::guard('profile')->user()->getReferrals() as $referral)
            <div class="row">
                <div class="col-sm-4 col-md-3" >

                    <div class="code-title">
                        Your Unique Code
                    </div>
                    <div class="code-text-send">
                        {{$referral->code}}
                    </div>
                    <div class="text-center">
                        Referred Users: {{ $referral->relationships()->count() }}
                    </div>

                </div>
                <div class="col-sm-4 col-md-4">
                    <p class="msg-of-friend">This is your very own unique code that you can either send by email or text
                        to your friends, so that they can sign up and you both receive bonus credits</p>
                </div>
                <div class="col-sm-4 col-md-4"></div>
            </div>
            <div class="row">
                <form class="form-inline" action="{{url('user/send-refer-mail')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-sm-12 col-12 setwidthform">
                        <div class="codenandinvi-title">Send invitation and code</div>

                        <div class="form-group" id="send-email-id">
                            <label for="email" class="sr-only">Email address:</label>
                            <input type="email" class="form-control" name="email" id="email" style="width: 60%;"
                                placeholder="EMAIL ADDRESS" required>
                        </div>
                        <input type="hidden" class="form-control" name="link" id="code"
                            value="{{$referral->link}}">
                        {{-- <div class="form-group">
                            <div class="orr-text">OR</div>
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="sr-only">Mobile:</label>
                            <input type="text" class="form-control" id="mobile" placeholder="MOBILE NUMBER">
                        </div>

                        <button type="submit" class="btn btn-invite" id="invitebtn">Add to invite list</button> --}}

                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-invite" id="invite-btn">SEnd invite code</button>
                        <button type="reset" class="btn btn-cancel">Cancel</button>

                    </div>
                </form>
            </div>
            @empty
            No referral Programs at the moment
            @endforelse
        </div>
    </div>
    <!-- END card -->
</div>
<!-- END PAGE CONTENT -->
@endsection
@section('scripts')
<!-- BEGIN VENDOR JS -->

<!-- END PAGE LEVEL JS -->
@endsection