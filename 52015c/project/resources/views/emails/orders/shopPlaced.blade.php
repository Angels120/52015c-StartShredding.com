@php

    $variableArray = array(
    'order_number' => $order['order_number'],
    'order_date' => date('d/m/Y', strtotime($order['booking_date'])),
    'first_name' => $first_name,
    'order_id' => $order_id,
    );



    $templateHTML = $template['content'];

    foreach ($variableArray as $key => $value) {
    $templateHTML = str_replace("{".$key."}", $value, $templateHTML);
    }

@endphp

{!! $templateHTML !!}