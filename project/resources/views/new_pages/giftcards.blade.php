@extends('new_includes.new_main')

@section('title','Gift Cards')



@section('content')
<!-- START PAGE CONTENT -->
<div class="content ">
    <!-- START JUMBOTRON -->
    {{-- <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ol class="breadcrumb">
                        <li class="">Gift Card</li>
                        <!-- <li style="color: #8533ff!important" class="top-right1">Account Balance CR{{$settings[0]->currency_sign}}{{ number_format($user->balance, 2) }}
    </li> -->

    </ol>
    <!-- END BREADCRUMB -->
</div>
</div>
</div> --}}
<!-- END JUMBOTRON -->
<!-- START CONTAINER FLUID -->
<div class=" container-fluid  p-b-50 m-t-40">
    <div class="row">
        <div class="col-md-8">
            <!-- START card -->
            <div class="card card-borderless">
                <ul class="nav nav-tabs nav-tabs-simple d-none d-md-flex d-lg-flex d-xl-flex" role="tablist"
                    data-init-reponsive-tabs="dropdownfx">
                    <li class="nav-item">
                        <a class="active show" data-toggle="tab" role="tab" data-target="#buygiftcard" href="#"
                            aria-selected="true">Buy Gift Card</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab" data-target="#redeemgiftcard" class=""
                            aria-selected="false">Redeem Gift Card</a>
                    </li>
                    <!-- newly added redeemed gift card  -->
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab" data-target="#redeemedgiftcard" class=""
                            aria-selected="false">Redeemed Gift Card</a>
                    </li>
                </ul>
                <div class="tab-content">
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('message') }}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('error') }}
                    </div>
                    @endif

                    <div class="tab-pane active show" id="buygiftcard">
                        <div class="row column-seperation">
                            <div class="col-sm-9">
                                <div class="card-deck">
                                    @foreach($giftcards as $giftcard)
                                    @if($giftcard->type == 1)
                                    <form method="POST"
                                        action="{!! action('BuyGiftCardController@buy', ['id' => $giftcard->id]) !!}">
                                        {{csrf_field()}}
                                        <div class="buy-gift">
                                            <ul class="gift-card">
                                                <li class="buy-gift-only">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <!-- background gift image goes here  -->
                                                            <div class="giftcard-img">
                                                                <img src="{{ url('assets/img/gift-cards/' . $giftcard->image) }}"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <!-- git card details goes here  -->
                                                            <div class="text-main">
                                                                <h3>{{ $giftcard->title }} |
                                                                    ${{ $giftcard->credit_amount }}</h3>

                                                                <ul>
                                                                    <li>Expiry Date: {{ $giftcard->expiry_date }}</li>
                                                                    <li class="last-child">
                                                                        <button id="buygiftcard" type="submit"
                                                                            class="btn btn-brown">buy</button>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="line"></div>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </form>
                                    @endforeach
                                </div>

                                <!-- newly added coustom html  -->

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="redeemgiftcard">
                        <div class="row column-seperation">
                            <div class="col-sm-9">
                                <div class="card-deck">
                                    @foreach($boughtgiftcards as $boughtgiftcard)
                                    <form method="POST"
                                        action="{!! action('BuyGiftCardController@redeem', ['id' => $boughtgiftcard->id]) !!}">
                                        {{csrf_field()}}
                                        <div class="buy-gift">
                                            <ul class="gift-card">
                                                <li class="buy-gift-only">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="giftcard-redeem">
                                                                <div class="giftcard-img">
                                                                    <img src="{{ url('assets/img/gift-cards/' . $boughtgiftcard->gift_card->image) }}"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="text-main">
                                                                @if($boughtgiftcard->gift_card->type == 1)
                                                                <h3>{{ $boughtgiftcard->gift_card->title }} |
                                                                    ${{ $boughtgiftcard->gift_card->credit_amount }}</h3>
                                                                @else
                                                                <h3>Giveaway |
                                                                    ${{ $boughtgiftcard->gift_card->credit_amount }}</h3>

                                                                @endif
                                                                <ul>
                                                                    <li class="last-child">
                                                                        <button class="btn btn-brown"
                                                                            id="redeemgiftcard"
                                                                            type="submit">reedem</button>
                                                                        <button class="btn btn-yellow" type="button"
                                                                            class="btn btn-secondary"><a
                                                                                href="{{ url('user/gift-cards/gift-friend') }}/{{ $boughtgiftcard->id }}"
                                                                                class="anchor-tag">send to a
                                                                                friend</a></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="line"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                    @endforeach
                                </div>



                            </div>
                        </div>
                    </div>

                    <!-- Redeemed Gift Cards  -->

                    <div class="tab-pane" id="redeemedgiftcard">
                        <div class="row column-seperation">
                            <div class="col-sm-9">
                                <!-- <div class="card-deck">
                                    @foreach($boughtgiftcards as $boughtgiftcard)
                                    <div class="card">
                                        <form method="POST"
                                            action="{!! action('BuyGiftCardController@redeem', ['id' => $boughtgiftcard->id]) !!}">
                                            {{csrf_field()}}
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $boughtgiftcard->gift_card->title }}</h5>
                                                <p class="card-text">
                                                    {{ $boughtgiftcard->gift_card->description }}
                                                    @if ($boughtgiftcard->is_gifted)
                                                    <br /><b>Gifted by: {{ $boughtgiftcard->bought_by->name }}
                                                        @endif
                                                        <br /><b>Credit Amount: $
                                                            {{ $boughtgiftcard->gift_card->credit_amount }}</b>
                                                </p>
                                                <div class="row">
                                                    <button id="redeemgiftcard" type="submit"
                                                        class="btn btn-primary">Redeem</button>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                        data-target="#sendgiftcardModal">
                                                        Send To A Friend
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @endforeach
                                </div> -->

                                <!-- newly added coustom HTMl  -->
                                @foreach($redeemedgiftcards as $redeemedgiftcard)
                                <div class="buy-gift">
                                    <ul class="gift-card">
                                        <li class="buy-gift-only">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- background gift image goes here  -->
                                                    <div class="giftcard-redeemed">
                                                        <div class="giftcard-img">
                                                            <img src="{{ url('assets/img/gift-cards/' . $redeemedgiftcard->gift_card->image) }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <!-- git card details goes here  -->
                                                    <div class="text-main">
                                                        @if($redeemedgiftcard->gift_card['type'] == 1)
                                                        <h3>{{ $boughtgiftcard->gift_card['title'] }} |
                                                            ${{ $redeemedgiftcard->gift_card['credit_amount'] }}</h3>
                                                        @else
                                                        <h3>Giveaway | ${{ $redeemedgiftcard->gift_card->credit_amount }}
                                                        </h3>

                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END card -->
        </div>
    </div>
</div>
<!-- END CONTAINER FLUID -->
</div>

<!-- END PAGE CONTENT -->
@endsection
@section('scripts')

<!-- END PAGE LEVEL JS -->
@endsection