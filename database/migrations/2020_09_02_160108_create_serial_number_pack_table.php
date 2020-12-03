<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerialNumberPackTable extends Migration {


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serial_number_pack', function (Blueprint $table) {
            $table->increments('id');
            $table->char('site_oid');
            $table->integer('device_node_id')->unsigned();
            $table->string('sn1')->default("NONE");
            $table->string('sn2')->default("NONE");
            $table->string('sn3')->default("NONE");
            $table->string('sn4')->default("NONE");
            $table->string('sn5')->default("NONE");
            $table->string('sn6')->default("NONE");
            $table->string('sn7')->default("NONE");
            $table->string('sn8')->default("NONE");
            $table->string('sn9')->default("NONE");
            $table->string('sn10')->default("NONE");
            $table->string('sn11')->default("NONE");
            $table->string('sn12')->default("NONE");
            $table->string('sn13')->default("NONE");
            $table->string('sn14')->default("NONE");
            $table->string('sn15')->default("NONE");
            $table->string('batt_id1')->default("NONE");
            $table->string('batt_id2')->default("NONE");
            $table->string('batt_id3')->default("NONE");
            $table->string('batt_id4')->default("NONE");
            $table->string('batt_id5')->default("NONE");
            $table->string('batt_id6')->default("NONE");
            $table->string('batt_id7')->default("NONE");
            $table->string('batt_id8')->default("NONE");
            $table->string('batt_id9')->default("NONE");
            $table->string('batt_id10')->default("NONE");
            $table->string('batt_id11')->default("NONE");
            $table->string('batt_id12')->default("NONE");
            $table->string('batt_id13')->default("NONE");
            $table->string('batt_id14')->default("NONE");
            $table->string('batt_id15')->default("NONE");
            $table->timestamps();

            $table->foreign('site_oid')->references('oid')->on('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_node_id')->references('id')->on('device_nodes')->onDelete('cascade')->onUpdate('cascade');
        });


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('serial_number_pack', function (Blueprint $table) {

            $table->dropForeign('serial_number_pack_site_oid_foreign');
            $table->dropColumn('site_oid');

            $table->dropForeign('serial_number_pack_device_node_id_foreign');
            $table->dropColumn('device_node_id');

        });

        Schema::dropIfExists('serial_number_pack');
    }
}
