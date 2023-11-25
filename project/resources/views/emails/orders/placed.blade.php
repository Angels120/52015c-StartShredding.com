@php

$variableArray = array(
'order_number' => $order['order_number'],
'order_date' => date('d/m/Y', strtotime($order['booking_date'])),
'name' => $name,
'button' => url('/user-dashboard')
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
$templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

@endphp

{!! $templateHTML !!}