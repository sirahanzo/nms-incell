<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceNodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->char('site_oid');
            $table->integer('device_id')->unsigned();
            $table->char('name');
            //$table->char('poller_ipaddress');
            $table->char('serial_number');
            $table->char('ipaddress');
            $table->char('protocol_monitoring');
            $table->char('status');
            $table->timestamps();

            $table->foreign('site_oid')->references('oid')->on('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_id')->references('id')->onDelete('cascade')->on('devices')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('device_nodes', function (Blueprint $table) {

            $table->dropForeign('device_nodes_site_oid_foreign');
            $table->dropColumn('site_oid');

            $table->dropForeign('device_nodes_device_id_foreign');
            $table->dropColumn('device_id');

        });


        Schema::dropIfExists('device_nodes');
    }
}
