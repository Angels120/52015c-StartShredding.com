@php

$variableArray = array(
'transaction_id' => $transaction,
'name' => $name,
'credit_amount' => number_format((float)$Cbalance, 2, '.', '')
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
$templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

@endphp

{!! $templateHTML !!}