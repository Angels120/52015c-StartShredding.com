@extends('includes.newmaster2')
@section('content')
<!-- ,['cart_result'=> $response] -->
<style>
    .div2 {
        width: 300px;
        height: 110px;
        padding: 10px;
        border: 1px solid black;
        background-color: #ffd11a;
    }

    .thank-you-text {
        text-align: center;
    }

    .next-order-area {
        text-align: center;
        font-size: 21px;
        font-weight: bold;
        margin-bottom: 20px;

    }

    .next-order-area span img {
        position: relative;
        top:
            -3px;
    }

    .steps ol {
        position: relative;
        overflow: hidden;
        counter-reset: wizard;
        list-style: none;
    }

    .stepsli {
        position: relative;
        float: left;
        width: 20%;
        text-align: center;
        color: #000000;
    }

    .steps .current~.stepsli {
        color: #dbdbea;
    }

    .stepsli:before {
        counter-increment: wizard;
        content: counter(wizard);
        display: block;
        color: #ffff00;
        background-color: #000000;

        text-align: center;
        width: 2.5em;
        height: 2.5em;
        line-height: 2.5em;
        border-radius: 2.5em;
        position: relative;
        left: 50%;
        margin-bottom: 0.625em;
        margin-left: -1.25em;
        z-index: 1;
        font-size: 16px;
        font-weight: bold;
    }

    .steps .current~.stepsli:before {
        background-color: #dbdbea;
        color: #B6B6B6;
        border-color: #dbdbea;
    }

    .stepsli+.stepsli:after {
        content: "";
        display: block;
        width: 100%;
        background-color: #000000;
        height: 4px;
        position: absolute;
        left: -50%;
        top: 1.95em;
        z-index: 0;
    }

    .current~.stepsli:after {
        background-color: #dbdbea;
    }

    .order-confirmed {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 20px;
        text-align: center;
    }

    .steps {
        margin-top: 40px;
    }

    .steps ol {
        padding-left: 0px;
    }

    li.stepsli {
        text-transform: uppercase;
        font-size: 9px;
    }

    .order-tracking {
        text-align: center;
        text-transform: unset;
    }

    .oc-hr {
        margin-top: 0px;
    }

    .trackingnumber {
        background-color: #69008c;
        color: #fff;
        font-weight: bold;
        font-size: 27px;
        padding: 15px;
        width: 80%;
        margin: 8px auto;
        border-radius: 35px;
    }

    .order-tracking a {
        text-transform: uppercase;
        font-size: 12px;
    }

    .order-note {
        margin: 35px 0px;
    }

    .card {
        border: 1px solid #ddd;
        padding: 28px;
    }

    .creditlist ul {
        list-style: none;
        padding-left: 0px;
    }

    .creditlist ul li {
        clear: both;
        text-transform: uppercase;
        font-size: 13px;
        padding: 22px 0px;
        border-top: 1px solid #ddd;
        margin-bottom: 12px;
    }

    .credit-name {
        float: left;
    }

    .credit-count {
        float: right;
        font-weight: bold;

    }

    .creditlist {
        clear: both;
    }

    .termsandcon {
        width: 50%;
        text-align: center;
        margin: 20px auto;
        text-transform: uppercase;
        font-size: 10px;
    }

    @media (max-width: 767px) {}

    @media (max-width: 570px) {
        li.stepsli {
            text-transform: uppercase;
            font-size: 9px;
        }

        .card {
            margin-top: 40px;
        }

    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="home-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">
                <div class="thank-you-text">
                    <img src="{{ url('/assets/img/thankyou.png') }}" />
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">
                <hr class="oc-hr">
                <div class="order-confirmed">
                    Order COnfirmed
                </div>

                <div class="steps">
                    <ol>
                        <li class="stepsli current"> On Request</li>
                        <li class="stepsli ">Sheduled</li>
                        <li class="stepsli">At Plant</li>
                        <li class="stepsli">On delivery</li>
                        <li class="stepsli">Completed</li>
                    </ol>
                </div>

                <div class="order-note">
                    <p>Your Order has been placed in our service queue and you will recive a notification from out
                        dispatch shortly. We will let you know when we have scheduled the pick up of your garments.</p>
                    <p>To view the status of your order, click on the button below or save the tracking number for
                        future inquiry</p>
                </div>
                <div class="order-tracking">
                    <span class="title">Order tracking number</span>
                    <div class="trackingnumber">
                        #{{ session()->get( 'order1' )->order_number }}
                        {{-- {{$order->order_number}} --}}
                    </div>
                    <a href="{{route('user.myorders')}}">Click to view status</a>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-content">
                        <div class="next-order-area">
                            <div>Get Your Next Order for <span><img src="{{ url('/assets/img/free.png') }}" /></span>
                            </div>
                        </div>
                        <div class="text-center">
                            <p>We've made the process of earning credits towards free cleaning so much easier. Here's
                                just some of the rewards waiting for you.</p>
                        </div>

                        <div class="creditlist">
                            <ul>
                                <li>
                                    <div class="credit-name">Tell a friend about us</div>
                                    <div class="credit-count">20 credits</div>
                                </li>
                                <li>
                                    <div class="credit-name">Instagram post or story</div>
                                    <div class="credit-count">10 credits</div>
                                </li>
                                <li>
                                    <div class="credit-name">Instagram or fb mention</div>
                                    <div class="credit-count">5 credits</div>
                                </li>
                                <li>
                                    <div class="credit-name">Wear our shirt courtside</div>
                                    <div class="credit-count">500 credits</div>
                                </li>
                                <li>
                                    <div class="credit-name">Tattoo our logo on you</div>
                                    <div class="credit-count">750 credits</div>
                                </li>
                                <li>
                                    <div class="credit-name">Name your kid ube</div>
                                    <div class="credit-count">1000 credits</div>
                                </li>
                            </ul>
                        </div>



                    </div>
                </div>
                <div class="termsandcon">
                    <p>Terms and Conditions apply. void where prohibited. Contact us form details.</p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Ending of product filter area -->
</div>

@stop

@section('footer')
@stop