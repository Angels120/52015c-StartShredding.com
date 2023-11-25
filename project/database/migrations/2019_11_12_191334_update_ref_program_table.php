<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRefProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referral_programs', function (Blueprint $table) {
            $table->integer('limit')->after('lifetime_minutes')->default(10);
            $table->integer('amount')->after('limit')->default(20);
            $table->timestamp('expire_date')->after('amount')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referral_programs', function (Blueprint $table) {
            $table->dropColumn(['limit', 'amount', 'expire_date', 'deleted_at']);
        });
    }
}
