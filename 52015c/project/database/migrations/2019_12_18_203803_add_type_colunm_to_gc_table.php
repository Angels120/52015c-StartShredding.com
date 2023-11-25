<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeColunmToGcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('gift_cards')) {
            if (Schema::hasColumn('gift_cards', 'type')) {
                error_log("type already exist in gift_cards table!");
            } else {
                Schema::table('gift_cards', function($table) {
                    $table->integer('type')->after('credit_amount')->default(1);
                });
            }
        } else {
            error_log("gift_cards table is missing!");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('gift_cards', 'type')) {
            Schema::table('gift_cards', function($table) {
                $table->dropColumn('type');
            });
        }
    }
}
