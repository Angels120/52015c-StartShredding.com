<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("service_agreements", function(Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->string("company_name");
            $table->string("contact_name");
            $table->string("phone_number");
            $table->string("email");
            $table->string("billing_address_1");
            $table->string("billing_address_2");
            $table->string("billing_city");
            $table->string("billing_state");
            $table->string("billing_postal_code");
            $table->string("billing_phone");
            $table->string("billing_email");
            $table->string("shipping_address_1");
            $table->string("shipping_address_2");
            $table->string("shipping_city");
            $table->string("shipping_state");
            $table->string("shipping_postal_code");
            $table->string("shipping_phone");
            $table->string("shipping_email");
            $table->string("operation_from");
            $table->string("operation_to");
            $table->decimal("make_it_count",8, 2);
            $table->tinyInteger("terms_accepted");
            $table->string("credit_card_name");
            $table->string("credit_card_number");
            $table->integer("credit_card_expire_month");
            $table->integer("credit_card_expire_year");
            $table->integer("credit_card_ccv");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("service_agreements");
    }
}
