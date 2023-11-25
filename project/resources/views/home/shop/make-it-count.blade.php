@extends('home.shop.includes.master',['cart_result'=> $response])

@section('header')
    @include('home.shop.includes.header')
@stop

@section('content')
<!-- ,['cart_result'=> $response] -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<section class="p-b-65 p-t-100 m-t-50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-7">
                    <h2 class="ae-2 done">Make It Count</h2>
                    <p class="small ae-2 done"><span class=" small opacity-10">MakeItCount™ is a crowdfunding program that utilizes micro donations with every transaction from participating merchants. The proceeds from this program will benefit the Janeen Foundation for Mental Health.
                    </span></p>
                    <h3 class="small ae-2 done"><span class=" small opacity-10"><strong>How It Works</strong>
              </span></h3>
                    <p class="small ae-2 done"><span class=" small opacity-10">Participating Merchants will set the amount of the suggested micro donation that is added by default to each transaction.
Merchants agree to match the amount, that the customer donates. </span></p>
                    <p class="small ae-2 done"><span class=" small opacity-10">Customers may choose to remove the donation or increase the amount, to a maximum set by the merchant All proceeds will be forwarded to the Janeen Foundation for Mental Health. This organization’s mandate is to establish and grow a fund that will be used to provide free psychological and support services. For more information, visit www.janeen.ca
              </span></p>
                    <h3 class="small ae-2 done"><span class=" small opacity-10"><strong>Why support this program?</strong>
              </span></h3>
                    <p class="small ae-2 done"><span class=" small opacity-10">A society with a strong foundation and commitment to its citizen’s mental health is a society that will flourish and grow for generations. However, the reality is that far too many people are unable to afford the care that they truly need. Until the need is met with government funding, it is up to the private sector to gather as a community and help one another, even through miniscule means. Every single cent counts, and helps towards helping another person live for another day.
              </span></p>
                    <p class="small ae-2 done"><span class=" small opacity-10"><strong>Make a Difference, Make It Count. </strong></span></p>
                    <br>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-4">
                    <div class="image-contain">
                        <br>
                        <img src="/assets/img/3742-300x300.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Ending of product filter area -->
</section>

@stop
@section('footer')
    @include('home.shop.includes.footer')
@stop