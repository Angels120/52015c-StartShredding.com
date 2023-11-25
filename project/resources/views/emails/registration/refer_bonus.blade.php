
{{-- {!! sprintf($template['content'],$provider_name, $name, $email, $bonus, $button) !!} --}}

@php

$variableArray = array(
'first_name' => $provider_name,
'first_name_1' => $provider_name,
'email' => $email,
'amount' => $bonus,
'promo_link' => $button
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
$templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

@endphp

{!! $templateHTML !!}