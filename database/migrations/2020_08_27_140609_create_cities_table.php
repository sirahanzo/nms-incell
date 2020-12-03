<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned();
            //$table->smallInteger('region_id');
            $table->char('region_oid');
            $table->char('oid')->unique();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('region_oid')->references('oid')->on('regions')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('cities',function (Blueprint $table){
            $table->dropForeign('cities_owner_id_foreign');
            $table->dropColumn('owner_id');

            $table->dropForeign('cities_region_oid_foreign');
            $table->dropColumn('region_oid');
        });


        Schema::dropIfExists('cities');
    }
}
