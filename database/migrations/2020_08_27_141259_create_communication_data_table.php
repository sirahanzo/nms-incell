<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicationDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_node_id')->unsigned();
            $table->smallInteger('monitoring_status');//monitoring_status:comm_lost(0),ok(1)
            $table->smallInteger('alarm_status');//alarm_status:alarm(1),clear(0)
            //$table->smallInteger('ping_cycle');//add this due to change ping methode ; reff:ECN120820-0001
            $table->timestamps();

            //$table->foreign('site_oid')->references('oid')->on('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_node_id')->references('id')->on('device_nodes')->onDelete('cascade')->onUpdate('cascade');        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('communication_data', function (Blueprint $table) {

            $table->dropForeign('communication_data_device_node_id_foreign');
            $table->dropColumn('device_node_id');
        });

        Schema::dropIfExists('communication_data');
    }
}
