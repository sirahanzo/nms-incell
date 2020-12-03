<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutageReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outage_report', function (Blueprint $table) {
            $table->increments('id');
            $table->char('site_oid');
            //$table->date("report_date");
            $table->char('month_of_data');
            $table->char('year_of_data');
            $table->double("outage_time");
            $table->double('total_event_outage');
            $table->double('total_duration_outage');
            $table->double('total_suported_outage');
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
        Schema::table('outage_report', function (Blueprint $table) {

            $table->dropForeign('outage_report_site_oid_foreign');
            $table->dropColumn('site_oid');

        });

        Schema::dropIfExists('outage_report');
    }
}
