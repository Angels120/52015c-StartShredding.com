<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderSummaryRelatedFieldsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function($table) {
                $table->float('subtotal', 10, 2)->nullable();
                $table->float('discount_amount', 10, 2)->nullable();
                $table->float('delivery', 10, 2)->nullable();
                $table->float('tax', 10, 2)->nullable();
                $table->float('make_it_count', 10, 2)->nullable();
            });
        } else {
            error_log("orders table is missing!");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function($table) {
            $table->dropColumn('subtotal');
            $table->dropColumn('discount_amount');
            $table->dropColumn('delivery');
            $table->dropColumn('tax');
            $table->dropColumn('make_it_count');
        });
    }
}
