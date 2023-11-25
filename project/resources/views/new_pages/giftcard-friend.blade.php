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
<!-- Email content starts here  -->

    <div class="main-content">
        <div class="content-gift">
            <div class="frd-gift first">
                <div class="box-inner">
                    <div class="image-container">
                        <div class="card-deck">
                            <div class="buy-gift">
                                <ul class="gift-card">
                                    <li class="buy-gift-only">
                                        {{-- <div class="row">
                                            <div class="col-sm-6">
                                            <div class="giftcard-redeem">
                                            <div class="giftcard-img">
                                                <img src="{{ url('assets/img/gift-cards/' . $send_gc->gift_card->image) }}" alt="">
                                            </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-main">
                                                    <h3>{{ $send_gc->gift_card->title }} | {{ $send_gc->gift_card->code }}</h3>
                                                        <ul>
                                                            <li>{{ $send_gc->gift_card->description }}</li>
                                                            @if ($send_gc->is_gifted)
                                                            <li>Gifted by: {{ $send_gc->bought_by->name }}</li>
                                                            @else
                                                            <li>Purchased Price: ${{ $send_gc->gift_card->purchase_price }}</li>
                                                            @endif
                                                            <li>Credit Amount: ${{ $send_gc->gift_card->credit_amount }}</li>                                                                
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="frd-gift second">
                <div class="box-inner">
                    <div class="form-container">
                        <form method="POST" action="{!! action('BuyGiftCardController@send', ['id' => $send_gc->id]) !!}">
                            {{csrf_field()}}
                            <input type="email" placeholder="Your Email" id="from_email" name="from_email" required>
                            <input type="email" placeholder="Friend's Email" id="to_email" name="to_email" required>
                            <textarea placeholder="message:" id="sender_msg" name="sender_msg" required></textarea>
                            <hr/>
                            <button class="button btn-friend">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('scripts')

<!-- END PAGE LEVEL JS -->
@endsection
