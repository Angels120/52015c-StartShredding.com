<!-- {!! sprintf($template['content'], $name) !!} -->

@php

$variableArray = array(
'name' => $name
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
$templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

@endphp

{!! $templateHTML !!}