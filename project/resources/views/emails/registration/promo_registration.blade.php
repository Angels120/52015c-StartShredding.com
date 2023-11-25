@php

$variableArray = array(
'first_name_one' => $first_name,
'last_name' => $last_name,
'first_name_two' => $first_name,
'promo_link' => $promo_link
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
$templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

@endphp

{!! $templateHTML !!}