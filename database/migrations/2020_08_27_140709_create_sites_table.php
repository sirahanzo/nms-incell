<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned();
            $table->char('region_oid');
            $table->char('city_oid');
            $table->char('oid')->unique();
            $table->string('name');
            $table->string('site_id_label')->nullable();
            $table->string('address');
            $table->string('longitude');
            $table->string('latitude');
            $table->smallInteger('total_pack')->default(1);
            $table->string('icon')->nullable();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('region_oid')->references('oid')->on('regions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_oid')->references('oid')->on('cities')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {

            $table->dropForeign('sites_owner_id_foreign');
            $table->dropColumn('owner_id');

            $table->dropForeign('sites_region_oid_foreign');
            $table->dropColumn('region_oid');

            $table->dropForeign('sites_city_oid_foreign');
            $table->dropColumn('city_oid');

            //$table->dropForeign('sites_poller_ipaddress_foreign');
            //$table->dropColumn('poller_ipaddress');
        });


        Schema::dropIfExists('sites');
    }
}
