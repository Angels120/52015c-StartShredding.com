@php
    $variableArray = array(
        'address' => $info['address'],
        'street_no' => $info['street_no'],
        'unit' => $info['unit'],
        'state' => $info['state'],
        'city' => $info['city'],
        'zip' => $info['zip'],
        'service_type' => $info['service_type'],
        'service_type_RB'=> $info['service_type_RB'],
        'qty' => $info['qty'],
        'container_type' => $info['container_type'],
        'service_preference' => $info['service_preference'],
        'notes' => $info['notes'],
        'idealstart_date' => $info['idealstart_date'],
        'specificpost_date' => $info['specificpost_date'],
        'am_pm' => ($info['specificpost_date'])?$info['am_pm']:'',
        'company' => $info['company'],
        'fname' => $info['fname'],
        'lname' => $info['lname'],
        'email' => $info['email'],
        'phone' => $info['phone'],
        'promocode' => $info['promocode'],
    );

    $templateHTML = $template['content'];

    foreach ($variableArray as $key => $value) {
        $templateHTML = str_replace("{".$key."}", $value, $templateHTML);
    }

@endphp

{!! $templateHTML !!}