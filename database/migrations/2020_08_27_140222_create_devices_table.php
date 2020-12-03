<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manufacturer_id')->unsigned();
            $table->integer('device_type_id')->unsigned();
            //$table->char('device_type_name');
            $table->string('name');
            //$table->string('protocol'); //protocol: {http,snmp}
            //$table->char('snmp_version');//v1,v2c,v3
            //$table->integer('snmp_timeout');
            //$table->integer('snmp_retries');
            //$table->char('snmp_read');
            //$table->char('snmp_write');
            //$table->char('snmp_port');
            //$table->string('url');
            $table->string('api_key');
            $table->string('api_label');
            $table->timestamps();

            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_type_id')->references('id')->on('device_types')->onUpdate('cascade')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {

            $table->dropForeign('devices_manufacturer_id_foreign');
            $table->dropColumn('manufacturer_id');

            $table->dropForeign('devices_device_type_id_foreign');
            $table->dropColumn('device_type_id');
            //
            //$table->dropForeign('devices_device_type_name_foreign');
            //$table->dropColumn('device_type_name');


        });

        Schema::dropIfExists('devices');
    }
}
