{{--<h3>Congratulations! You have received a Gift Certificate redeemable for {{ $settings[0]->title }} from {{ $Clients->name }}</h3>--}}
{{--<hr/>--}}
{{--<h3>{{ $boughtgiftcard->gift_card->title }}</h3>--}}
{{--<p>{{ $boughtgiftcard->gift_card->description }}</p>--}}
{{--<p><b>Credit Amount: {{ $boughtgiftcard->gift_card->credit_amount }}</b></p>--}}
{{--<hr/>--}}
{{--<a href="{{ $baseurl }}/user/gift-cards/validate/{{ $boughtgiftcard->id }}/{{ $auth_code }}">Click Here To Continue</a>--}}
{{-- {!! sprintf($template['content'],$settings[0]->title, $Clients->name, $boughtgiftcard->gift_card->title, $boughtgiftcard->gift_card->description,
$boughtgiftcard->gift_card->credit_amount, $button) !!} --}}

@php

$variableArray = array(
    'first_name' => $Clients->first_name,
    'last_name' => $Clients->last_name,
    'message' => $data['sender_message'],
    'credit_amount' => number_format((float)$boughtgiftcard->gift_card->credit_amount, 2, '.', ''),
    'code' => $data['code'],
    'button' => $button
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
    $templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

@endphp

{!! $templateHTML !!}