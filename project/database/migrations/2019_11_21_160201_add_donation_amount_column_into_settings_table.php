<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDonationAmountColumnIntoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('settings')) {
            if (Schema::hasColumn('settings', 'donation_amount')) {
                error_log("donation_amount already exist in settings table!");
            } else {
                Schema::table('settings', function($table) {
                    $table->float('donation_amount', 10, 2)->nullable();
                });
            }
        } else {
            error_log("settings table is missing!");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('settings', 'donation_amount')) {
            Schema::table('settings', function($table) {
                $table->dropColumn('donation_amount');
            });
        }
    }
}
