@extends('includes.newmaster2')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

<style>
    .gift-image {
        margin-top: 50px;
    }

    .gift-title {
        font-family: 'Taviraj', serif !important;
        font-size: 18px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .gift-title .t {
        font-size: 32px !important;
    }

    hr.style-seven {
        overflow: visible;
        /* For IE */
        height: 30px;
        border-style: solid;
        border-color: #68008b;
        border-width: 1px 0 0 0;
        border-radius: 20px;
    }

    hr.style-seven:before {
        /* Not really supposed to work, but does */
        display: block;
        content: "";
        height: 30px;
        margin-top: -31px;
        border-style: solid;
        border-color: #68008b;
        border-width: 0 0 1px 0;
        border-radius: 20px;
    }

    label {
        font-family: 'Taviraj', serif;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 12px !important;
    }

    input::placeholder {
        font-family: 'Taviraj', serif;
        font-weight: 400;
        text-align: left !important;
    }

    textarea::-webkit-input-placeholder {
        font-family: 'Taviraj', serif;
        font-weight: 400;
        text-align: left !important;
    }
    textarea#sender_message::placeholder {
    /* line-height: 1.58; */
    line-height: 1.6;
    white-space: pre-line;
    font-weight: 400;
    font-family: 'Taviraj', serif !important;
    }

    @media screen and (max-width: 480px) {
        .gift-image {
            margin-bottom: 20px;
        }

        .login-logo {
            display: none;
        }
    }
</style>

<div class="home-wrapper">
    <!-- Starting of login area -->
    <div class="section-padding signup-area-wrapper wow fadeInUp">
        <div class="container">

            <div class="row">
                <div class="col-sm-3 col-xs-12 -xs col-sm-offset-2">
                    <div class="text-center">
                        <img class="gift-image" src="{{ url('/assets/img/gift-card/ubeclean-main.png') }}">
                    </div>
                    <div class="text-center">
                        <img class="login-logo" style="width:150px;" src="{{ url('/assets/img/ube_logo_ig.png') }}">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="newAccount-area" style="margin-top: 40px;">
                        <h2 class="gift-title text-center">Give Your Friends a Free $25 Gift
                            Card!</h2>
                        <hr class="style-seven" />

                        @if ($message = Session::get('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{route('giftcode.store')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" id="type" name="type" value="2">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="reg_name">Your First Name <span>*</span></label>
                                    <input class="form-control" value="{{ old('first_name') }}" type="text"
                                        name="first_name" id="first_name" placeholder="Enter first name" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="reg_name">Your Last Name <span>*</span></label>
                                    <input class="form-control" value="{{ old('last_name') }}" type="text"
                                        name="last_name" id="last_name" placeholder="Enter last name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="reg_Pnumber">Your Email <span>*</span></label>
                                    <input id="sender_email" name="sender_email" class="form-control" type="email"
                                        placeholder="Enter your email" value="{{ old('sender_email') }}" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="reg_Pnumber">Recipient Email <span>*</span></label>
                                    <input id="recipient_emails" name="recipient_emails" class="form-control"
                                        type="email" placeholder="Enter recipient email"
                                        value="{{ old('recipient_emails') }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="reg_Pnumber">Your Message <span>*</span></label>
                                    <textarea style="text-align: left" rows="6" cols="50" id="sender_message"
                                        name="sender_message" class="form-control"
                                        placeholder="Happy Holidays!  One of my friends started this new company and we got a bunch of free gift cards, so I wanted to give you one!  Check it out, they pick up and deliver your dry cleaning straight to your door!"
                                        required></textarea>
                                </div>
                            </div>
                            {{-- <div class="form-group"> --}}
                            {{-- <div class="row"> --}}
                            {{-- <label for="reg_Pnumber">Code <span>*</span></label> --}}
                            {{-- <div class="row"> --}}
                            {{-- <div class="col-ms-6 col-sm-6 col-xs-6" style="padding-right: 0px"> --}}
                            <input id="code" name="code" class="form-control" type="hidden" placeholder="Enter a code"
                                value="{{ old('code') }}" required readonly>
                            {{-- </div> --}}
                            {{-- <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 0px">
                                        <button id="auto_code" class="btn btn-primary">New Gift Code</button>
                                    </div> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- <hr class="style-seven"> --}}

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="btn-area">
                                            <button class="btn btn-block btn-primary" id="send-gift-code" type="submit"
                                                style="background-color: #68008b !important;
                                                border-color: #68008b !importanF">SEND
                                                GIFT CARD</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ending of login area -->
</div>
@stop

@section('footer')

<script>
    $(document).ready(function (e) {
        $('#auto_code').prop('disabled', true);
        reloadRandomCode(0);
    });

    // document.getElementById("auto_code").addEventListener("click", function(event){
    //         event.preventDefault();
    //         $(this).prop('disabled', true);
    //         reloadRandomCode(0);
    //     });

    function reloadRandomCode(x) {
        var length = 6;
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        $.ajax({
            type: "POST",
            url: "{!! route('giftcode.isuniquecode') !!}",
            data: JSON.stringify({ _token: "{{ csrf_token() }}", code: result }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data){
                if (data.isUniqueCode) {
                    document.getElementById("code").value = result;
                    $('#auto_code').prop('disabled', false);
                } else {
                    reloadRandomCode(0);
                }
            },
            failure: function(errMsg) {
                if (x > 2) {
                    alert('Unknown error!');
                } else {
                    x++;
                    reloadRandomCode(x);
                }
            }
        });
    }
</script>


@stop