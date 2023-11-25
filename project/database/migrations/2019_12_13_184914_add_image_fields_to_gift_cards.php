<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageFieldsToGiftCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('gift_cards')) {
            if (Schema::hasColumn('gift_cards', 'image')) {
                error_log("image already exist in gift_cards table!");
            } else {
                Schema::table('gift_cards', function($table) {
                    $table->string('code')->after('id');
                    $table->string('image')->nullable()->after('description');
                    $table->date('expiry_date')->nullable()->after('description');
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
        if (Schema::hasColumn('gift_cards', 'image')) {
            Schema::table('gift_cards', function($table) {
                $table->dropColumn('code');
                $table->dropColumn('image');
                $table->dropColumn('expiry_date');
            });
        }
    }
}
