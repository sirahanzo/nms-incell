<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollingDataDevicesTable extends Migration {


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polling_data_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->char('site_oid');
            $table->integer('device_node_id')->unsigned();
            $table->integer('parameter_id')->unsigned();
            //$table->double('value');//change to pack1~pack4
            //$table->double('devider');
            $table->double('pack1')->default(0);
            $table->double('pack2')->default(0);
            $table->double('pack3')->default(0);
            $table->double('pack4')->default(0);
            $table->double('pack5')->default(0);
            $table->double('pack6')->default(0);
            $table->double('pack7')->default(0);
            $table->double('pack8')->default(0);
            $table->double('pack9')->default(0);
            $table->double('pack10')->default(0);
            $table->double('pack11')->default(0);
            $table->double('pack12')->default(0);
            $table->double('pack13')->default(0);
            $table->double('pack14')->default(0);
            $table->double('pack15')->default(0);
            $table->timestamps();

            $table->foreign('site_oid')->references('oid')->on('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_node_id')->references('id')->on('device_nodes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('polling_data_devices', function (Blueprint $table) {

            $table->dropForeign('polling_data_devices_site_oid_foreign');
            $table->dropColumn('site_oid');

            $table->dropForeign('polling_data_devices_device_node_id_foreign');
            $table->dropColumn('device_node_id');

            $table->dropForeign('polling_data_devices_parameter_id_foreign');
            $table->dropColumn('parameter_id');
        });

        Schema::dropIfExists('polling_data_devices');
    }
}
