<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeOfTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE trasactions CHANGE COLUMN type type ENUM('deposit', 'purchase', 'bonus') NOT NULL");
        // Schema::table('trasactions', function (Blueprint $table) {
        //     $table->enum('choices', ['deposit', 'purchase','bonus'])->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trasactions', function (Blueprint $table) {
            //
        });
    }
}
