<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')->unsigned();
            $table->string('name');
            $table->string('alias');
            $table->string('group');
            $table->string('unit')->nullable();
            $table->smallInteger('severity_id');
            $table->smallInteger('notification_id');
            $table->double('minimum')->default(0);
            $table->double('maximum')->default(0);
            $table->double('scale')->default(0);
            $table->smallInteger('state')->default(0);
            $table->smallInteger('triggers')->default(0);
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parameters', function (Blueprint $table) {

            $table->dropForeign('parameters_device_id_foreign');
            $table->dropColumn('device_id');

        });


        Schema::dropIfExists('parameters');
    }
}
