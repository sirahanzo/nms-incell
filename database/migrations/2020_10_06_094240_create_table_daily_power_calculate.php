<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDailyPowerCalculate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_power_calculate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_oid');
            $table->smallInteger('pack_id');
            $table->double('vbus');
            $table->double('ibus');
            $table->double('power');
            $table->timestamps();

            $table->foreign('site_oid')->references('oid')->on('sites')->onDelete('cascade')->onUpdate('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_power_calculate', function (Blueprint $table) {

            $table->dropForeign('daily_power_calculate_site_oid_foreign');
            $table->dropColumn('site_oid');


        });

        Schema::dropIfExists('daily_power_calculate');
    }
}
