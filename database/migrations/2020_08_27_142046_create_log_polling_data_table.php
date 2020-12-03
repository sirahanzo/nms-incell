<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPollingDataTable extends Migration {


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_polling_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('site_oid');
            $table->integer('device_node_id')->unsigned();
            $table->integer('parameter_id')->unsigned();
            $table->double('pack1');
            $table->double('pack2');
            $table->double('pack3');
            $table->double('pack4');
            $table->double('pack5');
            $table->double('pack6');
            $table->double('pack7');
            $table->double('pack8');
            $table->double('pack9');
            $table->double('pack10');
            $table->double('pack11');
            $table->double('pack12');
            $table->double('pack13');
            $table->double('pack14');
            $table->double('pack15');
            //$table->double('devider');
            $table->timestamps();

            $table->foreign('site_oid')->references('oid')->on('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_node_id')->references('id')->on('device_nodes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade')->onUpdate('cascade');


        });

        DB::unprepared('
       CREATE EVENT `log_polling_data_scheduller` ON SCHEDULE EVERY 5 MINUTE STARTS \'2020-01-01 00:00:00\'
            DO BEGIN
            INSERT INTO log_polling_data (site_oid, device_node_id, parameter_id,pack1,pack2,pack3,pack4,pack5,pack6,pack7,pack8,pack9,pack10,pack11,pack12,pack13,pack14,pack15, updated_at)
            SELECT pdd.site_oid, device_node_id, parameter_id,pack1,pack2,pack3,pack4,pack5,pack6,pack7,pack8,pack9,pack10,pack11,pack12,pack13,pack14,pack15, (SELECT DATE_FORMAT(NOW(), \'%Y-%m-%d %H:%i:00\'))
            FROM polling_data_devices pdd
                     LEFT JOIN device_nodes ON pdd.device_node_id = device_nodes.id
            WHERE device_id = 1;
        
        END;
        ');

        DB::unprepared('
        CREATE EVENT `delete_log_polling_data` ON SCHEDULE EVERY 1 DAY STARTS \'2020-01-01 00:00:00\'
            DO BEGIN
            DELETE FROM log_polling_data WHERE updated_at < DATE_SUB(NOW(),INTERVAL 6 MONTH );
        END;
        ');


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_polling_data', function (Blueprint $table) {

            $table->dropForeign('log_polling_data_site_oid_foreign');
            $table->dropColumn('site_oid');

            $table->dropForeign('log_polling_data_device_node_id_foreign');
            $table->dropColumn('device_node_id');

            $table->dropForeign('log_polling_data_parameter_id_foreign');
            $table->dropColumn('parameter_id');

        });

        DB::unprepared('DROP EVENT `log_polling_data_scheduller`');
        DB::unprepared('DROP EVENT `delete_log_polling_data`');

        Schema::dropIfExists('log_polling_data');
    }
}
