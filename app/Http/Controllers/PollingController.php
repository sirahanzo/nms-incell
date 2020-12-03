<?php

namespace App\Http\Controllers;

use App\Http\Models\CommunicationData;
use App\Http\Models\DeviceList;
use App\Http\Models\LogPollingData;
use App\Http\Models\Parameters;
use App\Http\Models\PollingAlarmDevices;
use App\Http\Models\PollingDataDevices;
use App\Http\Models\PostReceived;
use App\Http\Models\SerialNumberPack;
use App\Http\Models\Site;
use App\Jobs\DailyReportCalculationJob;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;

class PollingController extends Controller {


    public function polling($device_name, $site_id, $sn_pack, $pack_id, Request $request)
    {
        $polling = [
            'devicename' => $device_name,
            'sitename'   => $site_id,
            'sn_pack'    => $sn_pack,
            'packid'     => $pack_id,
            'data'       => $request->all(),
        ];


        //dd(ltrim($pack_id,'pack'));
        /*
        parsing data
        - insert new message into post_received
        - update polling_data_devices
        - update polling_alarm_devices

        */

        //$device_name = DeviceList::whereRaw('UPPER(name)',$device_name)->first();
        $device = DeviceList::where('name', 'LIKE', $device_name)->first();


        //dd($device);
        /*DEVICE VALIDATIONS*/
        if ($device == null) {
            return response()->json($device_name . ' => UNKNOWN DEVICE', 500);

        }

        //return $device;


        $site = Site::with('node')
            ->where('site_id_label', 'LIKE', $site_id)
            ->first();

        /* SITE VALIDATION */
        if ($site == null) {
            return response()->json('SITE NOT REGISTERED', 500);
        }


        //todo:create validasi site

        /*INSERT NEW MESSAGE RECEIVED FROM SITE*/
        PostReceived::create([
            'site_oid'        => $site->oid,
            'site_name'       => $site->site_id_label,
            'type_message'    => 'POLLING',
            'content_message' => json_encode($request->all()),
        ]);

        /*UPDATE SERIAL NUMBER*/
        SerialNumberPack::where('site_oid', '=', $site->oid)
            ->where('device_node_id', '=', $site->node[0]->id)
            ->update([
                'sn' . ltrim($pack_id, 'pack') => $sn_pack,
            ]);


        /*UPDATE POLLING DATA*/
        $parameter_data = DB::table('parameters')->where('group', '=', 'POLLING')->get();

        foreach ($parameter_data as $param):
            try {

                //echo $param->alias;
                //    DB::table('polling_data_devices')
                //        ->where('parameter_id', '=', $param->id)
                //        ->where('site_oid', '=', $site->oid)
                //        ->where('device_node_id', '=', $site->node[0]->id)
                //        ->update([
                //            $pack_id => $request->get($param->alias),
                //        ]);

                PollingDataDevices::where('parameter_id', '=', $param->id)
                    ->where('site_oid', '=', $site->oid)
                    ->where('device_node_id', '=', $site->node[0]->id)
                    ->update([
                        $pack_id => $request->get($param->alias),
                    ]);

            } catch (Exception $exception) {

                //echo '[' . $param->name . ' ] => skipped!!,NOT REGISTERED / POLLING NAME HAS NO ALIAS NAME</br>';
                echo '[' . $param->name . ' ] => SKIPPED !!</br>';

            };

        endforeach;


        /*UPDATE ALARM DATA*/
        $parameter_alarm = DB::table('parameters')->where('group', '=', 'ALARM')->get();

        foreach ($parameter_alarm as $param):

            try {

                //DB::table('polling_alarm_devices1')
                //    ->where('parameter_id', '=', $param->id)
                //    ->where('site_oid', '=', $site->oid)
                //    ->where('device_node_id', '=', $site->node[0]->id)
                //    ->update([
                //        $pack_id => $request->get($param->alias),
                //    ]);

                PollingAlarmDevices::where('parameter_id', '=', $param->id)
                    ->where('site_oid', '=', $site->oid)
                    ->where('device_node_id', '=', $site->node[0]->id)
                    ->update([
                        $pack_id => $request->get($param->alias),
                    ]);

            } catch (Exception $exception) {
                //echo '[' . $param->name . ' ] => skipped!!,NOT REGISTERED / ALARM NAME HAS NO ALIAS NAME</br>';
                echo '[' . $param->name . ' ] => SKIPPED !!</br>';

            }

        endforeach;

        return response()->json('NEW POLLING RECEIVED');
    }


    public function pollingNew($device_name, $site_id, $sn_original, $battery_id, $sn_pack, $pack_id, Request $request)
    {
        $msg = [];

        /*
        Process
        1. Validation Device & Site
        2. insert new message into post_received
        3. update polling_data_devices
        4. update polling_alarm_devices
        5. insert log_polling_data -> this will be a new job queue (no)
        6. insert log_polling_alarm -> this will be a new job queue (no)
        7. calculate daily report -> this will be a new job queque (yes)
        todo: add methode for sn_pack (serial_number input manual)
        8. update communication_data

        */

        /* 1.DEVICE AND SITE VALIDATIONS*/
        $device = DeviceList::where('name', 'LIKE', $device_name)->first();

        if ($device == null) {
            return response()->json($device_name . ' => UNKNOWN DEVICE', 500);

        }

        $site = Site::with('node')
            ->where('site_id_label', 'LIKE', $site_id)
            ->first();

        if ($site == null) {
            return response()->json('SITE NOT REGISTERED', 500);
        }


        /* 2.INSERT NEW MESSAGE RECEIVED FROM SITE*/
        PostReceived::create([
            'site_oid'        => $site->oid,
            'site_name'       => $site->site_id_label,
            'type_message'    => 'POLLING',
            'content_message' => json_encode($request->all()),
        ]);

        /*UPDATE SERIAL NUMBER*/
        SerialNumberPack::where('site_oid', '=', $site->oid)
            ->where('device_node_id', '=', $site->node[0]->id)
            ->update([
                'sn' . ltrim($pack_id, 'pack')      => $sn_original,
                'batt_id' . ltrim($pack_id, 'pack') => $battery_id,
            ]);


        /* 3.UPDATE POLLING DATA*/
        $parameter_data = DB::table('parameters')->where('group', '=', 'POLLING')->get();

        foreach ($parameter_data as $param):

            try {
                PollingDataDevices::where('parameter_id', '=', $param->id)
                    ->where('site_oid', '=', $site->oid)
                    ->where('device_node_id', '=', $site->node[0]->id)
                    ->update([
                        $pack_id => $request->get($param->alias),
                    ]);

            } catch (Exception $exception) {

                //echo '[' . $param->name . ' ] => SKIPPED !!</br>';
                $msg[] = [
                    $param->name => 'SKIPPED',
                ];

            };

        endforeach;

        /* 4.UPDATE POLLING ALARM DATA*/
        $parameter_alarm = DB::table('parameters')->where('group', '=', 'ALARM')->get();

        foreach ($parameter_alarm as $param):

            try {
                PollingAlarmDevices::where('parameter_id', '=', $param->id)
                    ->where('site_oid', '=', $site->oid)
                    ->where('device_node_id', '=', $site->node[0]->id)
                    ->update([
                        $pack_id => $request->get($param->alias),
                    ]);

            } catch (Exception $exception) {
                //echo '[' . $param->name . ' ] => skipped!!,NOT REGISTERED / ALARM NAME HAS NO ALIAS NAME</br>';
                //echo '[' . $param->name . ' ] => SKIPPED !!</br>';
                $msg[] = [
                    $param->name => 'SKIPPED',
                ];

            }

        endforeach;

        /* 6.INSERT NEW LOG  ALARM DATA, THIS IS WILL HANDLE WITH TRIGGER ON `polling_alarm_device` TABLE */

        /* 7.CALCULATE DAILY REPORT*/
        /*INSERT TABLE RAW AVAIBILITY TABLE
              - *region_oid
              - *site_oid
              - *month_of_data
              - *year_of_data
              - *system_state
              - *avg_bus_current
              - *avg_bus_voltage
              - best_power
              - *soc_start -> last_soc
              - *soc_end -> new_soc
              - *max_bus_current
              - *duration_hour
              - *created_at/start_system_state
              - *updated_at/end_system_state
        */
        $region_oid = $site->region_oid;
        $site_oid = $site->oid;

        //CAST TO JOB QUEUE FOR BETTER TIME RESPONSE & PERMORMANCE
        DailyReportCalculationJob::dispatch($region_oid, $site_oid, $pack_id, $sn_pack, $request);

        //8.UPDATE commmunication_data
        CommunicationData::where('device_node_id','=',$site->node[0]->id)->update([
            'monitoring_status' => $request->get('status_batt')
        ]);


        $msg[] = [
            "POLLING" => "NEW DATA SAVED!",
        ];

        return response()->json($msg, 200);
    }


    public function alarm($device_name, $site_id, $sn_original, $battery_id, $sn_pack, $pack_id, Request $request)
    {
        $polling = [
            'devicename' => $device_name,
            'sitename'   => $site_id,
            'packid'     => $pack_id,
            'data'       => $request->all(),
        ];

        $msg = [];

        /*
        parsing data
        - insert new message into post_received
        - update polling_data_devices
        - update polling_alarm_devices
        todo: create function to insert log_polling_alarm
        - insert log_polling_alarm

        */

        $device = DeviceList::where('name', 'LIKE', $device_name)->first();

        /*DEVICE VALIDATIONS*/
        if ($device == null) {
            return response()->json($device_name . ' => UNKNOWN DEVICE', 500);

        }


        $site = Site::with('node')
            ->where('site_id_label', 'LIKE', $site_id)
            ->first();


        /* SITE VALIDATION */
        if ($site == null) {
            return response()->json('SITE NOT REGISTERED', 500);
        }


        /*INSERT NEW MESSAGE RECEIVED FROM SITE*/
        PostReceived::create([
            'site_oid'        => $site->oid,
            'site_name'       => $site->site_id_label,
            'type_message'    => 'ALARM',
            'content_message' => json_encode($request->all()),
        ]);


        /*UPDATE SERIAL NUMBER*/
        SerialNumberPack::where('site_oid', '=', $site->oid)
            ->where('device_node_id', '=', $site->node[0]->id)
            ->update([
                'sn' . ltrim($pack_id, 'pack')      => $sn_original,
                'batt_id' . ltrim($pack_id, 'pack') => $battery_id,

            ]);


        /*UPDATE POLLING DATA*/
        $parameter_data = DB::table('parameters')->where('group', '=', 'POLLING')->get();

        foreach ($parameter_data as $param):
            try {

                //echo $param->alias;
                //    DB::table('polling_data_devices')
                //        ->where('parameter_id', '=', $param->id)
                //        ->where('site_oid', '=', $site->oid)
                //        ->where('device_node_id', '=', $site->node[0]->id)
                //        ->update([
                //            $pack_id => $request->get($param->alias),
                //        ]);

                PollingDataDevices::where('parameter_id', '=', $param->id)
                    ->where('site_oid', '=', $site->oid)
                    ->where('device_node_id', '=', $site->node[0]->id)
                    ->update([
                        $pack_id => $request->get($param->alias),
                    ]);

            } catch (Exception $exception) {

                //echo '[' . $param->name . ' ] => skipped, cause POLLING NAME no alias</br>';
                //echo '[' . $param->name . ' ] => SKIPPED !!</br>';
                $msg[] = [
                    $param->name => 'SKIPPED',
                ];

            };

        endforeach;


        /*UPDATE ALARM DATA*/
        $parameter_alarm = DB::table('parameters')->where('group', '=', 'ALARM')->get();

        foreach ($parameter_alarm as $param):

            try {

                //DB::table('polling_alarm_devices1')
                //    ->where('parameter_id', '=', $param->id)
                //    ->where('site_oid', '=', $site->oid)
                //    ->where('device_node_id', '=', $site->node[0]->id)
                //    ->update([
                //        $pack_id => $request->get($param->alias),
                //    ]);

                PollingAlarmDevices::where('parameter_id', '=', $param->id)
                    ->where('site_oid', '=', $site->oid)
                    ->where('device_node_id', '=', $site->node[0]->id)
                    ->update([
                        $pack_id => $request->get($param->alias),
                    ]);

            } catch (Exception $exception) {
                //echo '[' . $param->name . ' ] => skipped, cause ALARM NAME no alias</br>';
                //echo '[' . $param->name . ' ] => SKIPPED !!</br>';
                $msg[] = [
                    $param->name => 'SKIPPED',
                ];
            }

        endforeach;

        $msg[] = [
            "ALARM" => "NEW ALARM SAVED!",
        ];

        return response()->json($msg, 200);

        //return response()->json('NEW ALARM RECEIVED', 200);
    }


}
