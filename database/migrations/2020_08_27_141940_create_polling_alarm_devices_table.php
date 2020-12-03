<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollingAlarmDevicesTable extends Migration {


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polling_alarm_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->char('site_oid');
            $table->integer('device_node_id')->unsigned();
            $table->integer('parameter_id')->unsigned();
            //$table->double('value');//change to pack1~pack4
            //$table->double('devider');
            $table->smallInteger('pack1')->default(0);
            $table->smallInteger('pack2')->default(0);
            $table->smallInteger('pack3')->default(0);
            $table->smallInteger('pack4')->default(0);
            $table->smallInteger('pack5')->default(0);
            $table->smallInteger('pack6')->default(0);
            $table->smallInteger('pack7')->default(0);
            $table->smallInteger('pack8')->default(0);
            $table->smallInteger('pack9')->default(0);
            $table->smallInteger('pack10')->default(0);
            $table->smallInteger('pack11')->default(0);
            $table->smallInteger('pack12')->default(0);
            $table->smallInteger('pack13')->default(0);
            $table->smallInteger('pack14')->default(0);
            $table->smallInteger('pack15')->default(0);
            //$table->string('status_alarm');// this show active on inactive/clear
            //$table->integer('counting_alarm');
            $table->timestamps();

            $table->foreign('site_oid')->references('oid')->on('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_node_id')->references('id')->on('device_nodes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::unprepared('
        CREATE TRIGGER `polling_alarm_device_trigger` AFTER UPDATE ON polling_alarm_devices
        FOR EACH ROW
        BEGIN
            IF NEW.pack1 <> OLD.pack1
            THEN
                INSERT INTO log_polling_alarm ( site_oid, device_node_id, parameter_id, pack_id, `value`, status, updated_at) VALUES (NEW.site_oid,NEW.device_node_id,NEW.parameter_id,1,NEW.pack1,NEW.pack1,NEW.updated_at);
            END IF;
    
            IF NEW.pack2 <> OLD.pack2
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,2,NEW.pack2, NEW.pack2,NEW.updated_at);
            END IF;
    
            IF NEW.pack3 <> OLD.pack3
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,3,NEW.pack3, NEW.pack3,NEW.updated_at);
            END IF;
    
            IF NEW.pack4 <> OLD.pack4
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,4,NEW.pack4, NEW.pack4,NEW.updated_at);
            END IF;
    
            IF NEW.pack5 <> OLD.pack5
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,5,NEW.pack5, NEW.pack5,NEW.updated_at);
            END IF;
    
            IF NEW.pack6 <> OLD.pack6
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,6,NEW.pack6, NEW.pack6,NEW.updated_at);
            END IF;
    
            IF NEW.pack7 <> OLD.pack7
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,7,NEW.pack7, NEW.pack7,NEW.updated_at);
            END IF;
    
            IF NEW.pack8 <> OLD.pack8
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,8,NEW.pack8, NEW.pack8,NEW.updated_at);
            END IF;
    
            IF NEW.pack9 <> OLD.pack9
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,9,NEW.pack9, NEW.pack9,NEW.updated_at);
            END IF;
    
            IF NEW.pack10 <> OLD.pack10
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,10,NEW.pack10,NEW.pack10, NEW.updated_at);
            END IF;
    
            IF NEW.pack11 <> OLD.pack11
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,11,NEW.pack11,NEW.pack11, NEW.updated_at);
            END IF;
    
            IF NEW.pack12 <> OLD.pack12
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,12,NEW.pack12,NEW.pack12, NEW.updated_at);
            END IF;
    
            IF NEW.pack13 <> OLD.pack13
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,13,NEW.pack13,NEW.pack13, NEW.updated_at);
            END IF;
    
            IF NEW.pack14 <> OLD.pack14
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,14,NEW.pack14,NEW.pack14, NEW.updated_at);
            END IF;
    
            IF NEW.pack15 <> OLD.pack15
            THEN
                INSERT INTO log_polling_alarm (site_oid, device_node_id, parameter_id, pack_id,`value`,status,updated_at) VALUES (NEW.site_oid, NEW.device_node_id, NEW.parameter_id,15,NEW.pack15,NEW.pack15, NEW.updated_at);
            END IF;
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
        Schema::table('polling_alarm_devices', function (Blueprint $table) {

            $table->dropForeign('polling_alarm_devices_site_oid_foreign');
            $table->dropColumn('site_oid');

            $table->dropForeign('polling_alarm_devices_device_node_id_foreign');
            $table->dropColumn('device_node_id');

            $table->dropForeign('polling_alarm_devices_parameter_id_foreign');
            $table->dropColumn('parameter_id');

        });


        DB::unprepared('DROP TRIGGER `polling_alarm_device_trigger`');


        Schema::dropIfExists('polling_alarm_devices');
    }
}
