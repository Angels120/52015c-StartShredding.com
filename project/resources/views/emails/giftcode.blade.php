@php

$variableArray = array(
    'first_name_1' => $data['first_name'],
    'first_name_2' => $data['first_name'],
    'message' => $data['sender_message'],
    'last_name_1' => $data['last_name'],
    'last_name_2' => $data['last_name'],
    'credit_amount' => number_format((float)$data['credit_amount'], 2, '.', ''),
    'code' => $data['code'],
    'button' => $button
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
    $templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

@endphp

{!! $templateHTML !!}