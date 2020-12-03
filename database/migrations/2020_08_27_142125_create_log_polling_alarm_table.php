<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPollingAlarmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_polling_alarm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('site_oid');
            $table->integer('device_node_id')->unsigned();
            $table->integer('parameter_id')->unsigned();
            $table->smallInteger('pack_id');
            $table->smallInteger('value');
            $table->smallInteger('status')->nullable();
            $table->timestamps();

            $table->foreign('site_oid')->references('oid')->on('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_node_id')->references('id')->on('device_nodes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::unprepared('
        CREATE EVENT `delete_log_polling_alarm` ON SCHEDULE EVERY 1 DAY STARTS \'2020-01-01 00:00:00\'
            DO BEGIN
            DELETE FROM log_polling_alarm WHERE updated_at < DATE_SUB(NOW(),INTERVAL 6 MONTH );
        END;
        ');

        //DB::unprepared('
        //CREATE EVENT `reset_counting_alarm` ON SCHEDULE EVERY 1 MONTH STARTS \'2020-01-01 00:00:00\'
        //    DO BEGIN
        //    UPDATE polling_alarm_devices SET counting_alarm = 0;
        //
        //END;
        //');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_polling_alarm', function (Blueprint $table) {

            $table->dropForeign('log_polling_alarm_site_oid_foreign');
            $table->dropColumn('site_oid');

            $table->dropForeign('log_polling_alarm_device_node_id_foreign');
            $table->dropColumn('device_node_id');

            $table->dropForeign('log_polling_alarm_parameter_id_foreign');
            $table->dropColumn('parameter_id');

        });

        DB::unprepared('DROP EVENT `delete_log_polling_alarm`');
        //DB::unprepared('DROP EVENT `reset_counting_alarm`');

        Schema::dropIfExists('log_polling_alarm');
    }
}
