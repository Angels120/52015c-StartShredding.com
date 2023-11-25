<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoughtGiftCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bought_gift_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gift_card_id')->unsigned();
            $table->integer('bought_by_id')->unsigned();
            $table->tinyInteger('is_payment_completed');
            $table->string('payment_id');
            $table->string('payment_token');
            $table->integer('current_owner_id')->unsigned()->nullable();
            $table->tinyInteger('is_redeemed');
            $table->integer('redeemed_by_id')->unsigned()->nullable();
            $table->tinyInteger('is_gifted');
            $table->string('auth_code');
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
        Schema::dropIfExists('bought_gift_cards');
    }
}
