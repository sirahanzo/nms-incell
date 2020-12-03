<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawAvailabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_availability', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('region_oid');
            $table->char('site_oid');
            $table->smallInteger('pack_id');
            $table->char('serial_number');//battery_id
            $table->char('month_of_data');
            $table->char('year_of_data');
            $table->smallInteger('system_state');
            $table->double('avg_bus_current')->nullable();
            $table->double('avg_bus_voltage')->nullable();
            $table->double('best_power')->nullable();
            $table->double('peak_power')->nullable();
            $table->double('soc_start')->nullable();
            $table->double('soc_end')->nullable();
            $table->double('max_bus_current')->nullable();
            $table->double('max_bus_voltage')->nullable();
            //$table->timestamp('state_start');//created_at
            //$table->timestamp('state_end');//updated_at
            $table->double('duration_hour')->nullable() ;
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
        Schema::table('raw_availability', function (Blueprint $table) {

            $table->dropForeign('raw_availability_site_oid_foreign');
            $table->dropColumn('site_oid');


        });

        Schema::dropIfExists('raw_availability');
    }
}
