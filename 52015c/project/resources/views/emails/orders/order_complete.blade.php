<!-- {!! sprintf($template['content'], $button) !!} -->

@php

$variableArray = array(
'first_name' => $name
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
$templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

@endphp

{!! $templateHTML !!}