<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned();
            $table->char('oid')->unique();
            $table->string('name');
            $table->string('parent')->default('#');//due to no node_tree table
            $table->string('icon')->nullable();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regions', function (Blueprint $table) {

            $table->dropForeign('regions_owner_id_foreign');
            $table->dropColumn('owner_id');
        });

        Schema::dropIfExists('regions');
    }
}
