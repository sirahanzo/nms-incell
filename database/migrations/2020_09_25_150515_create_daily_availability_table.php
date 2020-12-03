<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyAvailabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_availability', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('region_oid');
            $table->char('site_oid');
            $table->char('month_of_data');
            $table->char('year_of_data');
            $table->double('d1')->default(0);
            $table->double('d2')->default(0);
            $table->double('d3')->default(0);
            $table->double('d4')->default(0);
            $table->double('d5')->default(0);
            $table->double('d6')->default(0);
            $table->double('d7')->default(0);
            $table->double('d8')->default(0);
            $table->double('d9')->default(0);
            $table->double('d10')->default(0);
            $table->double('d11')->default(0);
            $table->double('d12')->default(0);
            $table->double('d13')->default(0);
            $table->double('d14')->default(0);
            $table->double('d15')->default(0);
            $table->double('d16')->default(0);
            $table->double('d17')->default(0);
            $table->double('d18')->default(0);
            $table->double('d19')->default(0);
            $table->double('d20')->default(0);
            $table->double('d21')->default(0);
            $table->double('d22')->default(0);
            $table->double('d23')->default(0);
            $table->double('d24')->default(0);
            $table->double('d25')->default(0);
            $table->double('d26')->default(0);
            $table->double('d27')->default(0);
            $table->double('d28')->default(0);
            $table->double('d29')->default(0);
            $table->double('d30')->default(0);
            $table->double('d31')->default(0);
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
        Schema::table('daily_availability', function (Blueprint $table) {

            $table->dropForeign('daily_availability_site_oid_foreign');
            $table->dropColumn('site_oid');


        });

        Schema::dropIfExists('daily_availability');
    }
}
