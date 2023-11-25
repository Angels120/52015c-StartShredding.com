@php 

$variableArray = array(
    'name' => ucfirst($name),
    'gift_card_value' => $gift_card_value,
    'sign_up_bonus' => $sign_up_bonus
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
    $templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

@endphp

{!! $templateHTML !!}
