<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trasactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_id',100);
            $table->integer('user_id')->unsigned();
            $table->enum('type', ['deposit','debit','bonus']);
            $table->integer('type_id')->unsigned();
            $table->float('amount');
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
        Schema::dropIfExists('trasactions');
    }
}
