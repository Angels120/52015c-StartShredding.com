@php

$variableArray = array(
'activation_link' => $button
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
$templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

@endphp

{!! $templateHTML !!}