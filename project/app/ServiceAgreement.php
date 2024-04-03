<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceAgreement extends Model {
    protected $table = "service_agreements";

    protected $fillable = [
        'order_id', "company_name", "contact_name", "phone_number", "email", "billing_address_1", "billing_address_2",
        "billing_city", "billing_state", "billing_postal_code", "billing_phone", "billing_email", "shipping_address_1",
        "shipping_address_2", "shipping_city", "shipping_state", "shipping_postal_code", "shipping_phone",
        "shipping_email", "operation_from", "operation_to", "make_it_count", "terms_accepted", "credit_card_name",
        "credit_card_number", "credit_card_expire_month", "credit_card_expire_year", "credit_card_ccv",
        "created_at", "updated_at"
    ];
}
