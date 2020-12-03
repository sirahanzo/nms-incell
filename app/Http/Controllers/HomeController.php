<?php

namespace App\Http\Controllers;

use App\Http\Models\DailyPowerCalculate;
use App\Http\Models\PollingDataDevices;
use App\User;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller {


    private $regionOId;
    private $siteOid;
    private $statusBattery;
    private $socEnd;
    private $packID;
    private $snPack;
    private $batteryVoltage;
    private $batteryCurrent;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('debug');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function debug()
    {
        $log = [
            'soc'           => $this->logParameter('a', 'pack1', 1, '0', '0'),
            'batt_voltage'  => 'batt_voltage',
            'batt_curr'     => 'batt_curr',
            'min_cell_volt' => 'min_cell_volt',
            'max_cell_volt' => 'max_cell_volt',
            'cycle'         => 'cycle',
            'backup_time'   => 'backup_time',
            'life_time'     => 'life_time',
            'pwr_sw_temp'   => 'pwr_sw_temp',
            'min_temp'      => 'min_temp',
            'max_temp'      => 'max_temp',
            'vcell1'        => 'vcell1',
            'vcell2'        => 'vcell2',
            'vcell3'        => 'vcell3',
            'vcell4'        => 'vcell4',
            'vcell5'        => 'vcell5',
            'vcell6'        => 'vcell6',
            'vcell7'        => 'vcell7',
            'vcell8'        => 'vcell8',
            'vcell9'        => 'vcell9',
            'vcell10'       => 'vcell10',
            'vcell11'       => 'vcell11',
            'vcell12'       => 'vcell12',
            'vcell13'       => 'vcell13',
            'vcell14'       => 'vcell14',
            'vcell15'       => 'vcell15',
        ];


        //dd($user);
        $current_time = new \DateTime();


        $avg_vbus = DB::table('log_polling_data')
            ->where('site_oid', '=', 'a17b8772-e77b-4d71-bf2c-1a8a36555b3d')
            ->where('parameter_id', '=', 2)
            ->where('log_polling_data.updated_at', '>=', '2020-10-01 00:00:00')
            ->where('log_polling_data.updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
            ->average('pack1');

        $avg_ibus = DB::table('log_polling_data')
            ->where('site_oid', '=', 'a17b8772-e77b-4d71-bf2c-1a8a36555b3d')
            ->where('parameter_id', '=', 3)
            ->where('log_polling_data.updated_at', '>=', '2020-10-01 00:00:00')
            ->where('log_polling_data.updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
            ->average('pack1');

        $max_vbus = DB::table('log_polling_data')
            ->where('site_oid', '=', 'a17b8772-e77b-4d71-bf2c-1a8a36555b3d')
            ->where('parameter_id', '=', 2)
            ->where('log_polling_data.updated_at', '>=', '2020-10-01 00:00:00')
            ->where('log_polling_data.updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
            ->max('pack1');

        $max_ibus = DB::table('log_polling_data')
            ->where('site_oid', '=', 'a17b8772-e77b-4d71-bf2c-1a8a36555b3d')
            ->where('parameter_id', '=', 3)
            ->where('log_polling_data.updated_at', '>=', '2020-10-01 00:00:00')
            ->where('log_polling_data.updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
            ->max('pack1');

        //return view('debug.request');

        $last_status = DB::table('raw_availability')
            ->where('site_oid', '=', 'a17b8772-e77b-4d71-bf2c-1a8a36555b3d')
            ->where('pack_id', '=', ltrim('pack1', 'pack'))
            ->where('updated_at', '=', null)
            ->first();


        //dd($avg_vbus);
        $data ['c_avg_vbus'] =($avg_vbus == null) ? 0 : $avg_vbus;
        $data ['c_avg_ibus'] =($avg_ibus == null) ? 0 : $avg_ibus;
        $data ['c_max_vbus'] =($max_vbus == null) ? 0 : $max_vbus;
        $data ['c_max_ibus'] =($max_ibus == null) ? 0 : $max_ibus;
        $data ['power'] = floatval(($max_vbus == null | $max_ibus == null) ? 0 : $max_vbus * $max_ibus);
        $data['last_status'] = $last_status;

        return $data ;
    }


    public function debug2()
    {
        //$region_oid = $site->region_oid;
        //$site_oid = $this->siteOid;
        $current_time = new \DateTime();
        $current_month = $current_time->format('F');
        $current_year = $current_time->format('Y');
        $current_system_state = $this->statusBattery;
        //$soc_end = $request->get('SOC');

        $last_status = DB::table('raw_availability')
            ->where('site_oid', '=', $this->siteOid)
            ->where('pack_id', '=', ltrim($this->packID, 'pack'))
            ->where('updated_at', '=', null)
            ->first();

        //dd($last_status);

        //$delta_time = ($current_time->format('Y-m-d H:i:s') - $last_status->created_at)/3600;
        $ts1 = strtotime(($last_status == null) ? $current_time->format('Y-m-d H:i:s') : $last_status->created_at);
        $ts2 = strtotime($current_time->format('Y-m-d H:i:s'));
        $seconds_diff = $ts2 - $ts1;
        $delta_time = ($seconds_diff / 3600);

        switch ($current_system_state) {
            case 1:
                $this->calculateData($last_status, $current_month, $current_year, $current_system_state, $current_time, $delta_time);

                $msg = [
                    'status battery' => 'charge',

                ];


                break;
            case 2:
                $this->calculateData($last_status, $current_month, $current_year, $current_system_state, $current_time, $delta_time);

                $msg = [
                    //'status battery' => 'grid off/dcg',
                    'status battery' => 'discharge',
                ];
                break;
            case 3:
                $this->calculateData($last_status, $current_month, $current_year, $current_system_state, $current_time, $delta_time);

                $msg = [
                    'status battery' => 'ready/floating',
                ];
                break;
            case 4:
                $this->calculateData($last_status, $current_month, $current_year, $current_system_state, $current_time, $delta_time);
                $msg = [
                    //'status battery' => 'battery commlost',
                    'status battery' => 'batt outage',
                ];
                break;

        }

    }

    /**
     * @param $last_status
     * @param $current_month
     * @param $current_year
     * @param $current_system_state
     * @param \DateTime $current_time
     * @param $delta_time
     */
    protected function calculateData($last_status, $current_month, $current_year, $current_system_state, \DateTime $current_time, $delta_time)
    {
        if ($last_status == null) {
            echo 'insert new data on system ready';
            DB::table('raw_availability')
                ->insert([
                    'region_oid'      => $this->regionOId,
                    'site_oid'        => $this->siteOid,
                    'pack_id'         => ltrim($this->packID, 'pack'),
                    'serial_number'   => $this->snPack,
                    'month_of_data'   => $current_month,
                    'year_of_data'    => $current_year,
                    'system_state'    => $current_system_state,
                    'avg_bus_current' => 0,
                    'avg_bus_voltage' => 0,
                    'best_power'      => 0,
                    'peak_power'      => 0,
                    'soc_start'       => $this->socEnd,
                    'soc_end'         => 0,
                    'max_bus_current' => 0,
                    'max_bus_voltage' => 0,
                    'duration_hour'   => 0,
                    'created_at'      => $current_time->format('Y-m-d H:i:s'),
                ]);


        } elseif ($last_status->system_state != $current_system_state) {
            echo 'update data and insert new data system_state';

            DailyPowerCalculate::create([
                'site_oid1' => $this->siteOid,
                'pack_id'  => ltrim($this->packID, 'pack'),
                'vbus'     => $this->batteryVoltage,
                'ibus'     => $this->batteryCurrent,
                'power'    => number_format(abs($this->batteryCurrent * $this->batteryVoltage), 2),
            ]);


            $avg_vbus = DB::table('daily_power_calculate')
                ->where('site_oid', '=', $this->siteOid)
                ->where('pack_id', '=', ltrim($this->packID, 'pack'))
                ->where('updated_at', '>=', $last_status->created_at)
                ->where('updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
                ->average('vbus');

            $avg_ibus = DB::table('daily_power_calculate')
                ->where('site_oid', '=', $this->siteOid)
                ->where('pack_id', '=', ltrim($this->packID, 'pack'))
                ->where('updated_at', '>=', $last_status->created_at)
                ->where('updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
                ->average('ibus');

            $max_vbus = DB::table('daily_power_calculate')
                ->where('site_oid', '=', $this->siteOid)
                ->where('pack_id', '=', ltrim($this->packID, 'pack'))
                ->where('updated_at', '>=', $last_status->created_at)
                ->where('updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
                ->max('vbus');

            $max_ibus = DB::table('daily_power_calculate')
                ->where('site_oid', '=', $this->siteOid)
                ->where('pack_id', '=', ltrim($this->packID, 'pack'))
                ->where('updated_at', '>=', $last_status->created_at)
                ->where('updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
                ->max('ibus');

            $max_power = number_format(abs($max_ibus * $max_vbus),2);




            DB::table('raw_availability')
                ->where('site_oid', '=', $this->siteOid)
                ->where('pack_id', '=', ltrim($this->packID, 'pack'))
                ->where('updated_at', '=', null)
                ->update([
                    'avg_bus_current' => ($avg_ibus == null) ? 0 : $avg_ibus,
                    'avg_bus_voltage' => ($avg_vbus == null) ? 0 : $avg_vbus,
                    'best_power'      => 0,
                    'peak_power'      => $max_power,
                    'soc_end'         => $this->socEnd,
                    'max_bus_current' => ($max_ibus == null) ? 0 : $max_ibus,
                    'max_bus_voltage' => ($max_vbus == null) ? 0 : $max_vbus,
                    'duration_hour'   => $delta_time,
                    'updated_at'      => $current_time->format('Y-m-d H:i:s'),
                ]);

            DB::table('raw_availability')
                ->insert([
                    'region_oid'      => $this->regionOId,
                    'site_oid'        => $this->siteOid,
                    'pack_id'         => ltrim($this->packID, 'pack'),
                    'serial_number'   => $this->snPack,
                    'month_of_data'   => $current_month,
                    'year_of_data'    => $current_year,
                    'system_state'    => $current_system_state,
                    'avg_bus_current' => 0,
                    'avg_bus_voltage' => 0,
                    'best_power'      => 0,
                    'peak_power'      => 0,
                    'soc_start'       => $this->socEnd,
                    'soc_end'         => 0,
                    'max_bus_current' => 0,
                    'max_bus_voltage' => 0,
                    'duration_hour'   => 0,
                    'created_at'      => $current_time->format('Y-m-d H:i:s'),
                ]);

        } else {
            echo 'update existing data';


            DailyPowerCalculate::create([
                'site_oid' => $this->siteOid,
                'pack_id'  => ltrim($this->packID, 'pack'),
                'vbus'     => $this->batteryVoltage,
                'ibus'     => $this->batteryCurrent,
                'power'    => number_format(abs($this->batteryCurrent * $this->batteryVoltage), 2),
            ]);

            $avg_vbus = DB::table('daily_power_calculate')
                ->where('site_oid', '=', $this->siteOid)
                ->where('pack_id', '=', ltrim($this->packID, 'pack'))
                ->where('updated_at', '>=', $last_status->created_at)
                ->where('updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
                ->average('vbus');

            $avg_ibus = DB::table('daily_power_calculate')
                ->where('site_oid', '=', $this->siteOid)
                ->where('pack_id', '=', ltrim($this->packID, 'pack'))
                ->where('updated_at', '>=', $last_status->created_at)
                ->where('updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
                ->average('ibus');

            $max_vbus = DB::table('daily_power_calculate')
                ->where('site_oid', '=', $this->siteOid)
                ->where('pack_id', '=', ltrim($this->packID, 'pack'))
                ->where('updated_at', '>=', $last_status->created_at)
                ->where('updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
                ->max('vbus');

            $max_ibus = DB::table('daily_power_calculate')
                ->where('site_oid', '=', $this->siteOid)
                ->where('pack_id', '=', ltrim($this->packID, 'pack'))
                ->where('updated_at', '>=', $last_status->created_at)
                ->where('updated_at', '<=', date('Y-m-d ', strtotime($current_time->format('Y-m-d H:i:s') . ' +1 day')))
                ->max('ibus');

            $max_power = number_format(abs($max_ibus * $max_vbus),2);



            DB::table('raw_availability')
                ->where('site_oid', '=', $this->siteOid)
                ->where('pack_id', '=', ltrim($this->packID, 'pack'))
                ->where('updated_at', '=', null)
                ->update([
                    'avg_bus_current' => ($avg_ibus == null) ? 0 : $avg_ibus,
                    'avg_bus_voltage' => ($avg_vbus == null) ? 0 : $avg_vbus,
                    'best_power'      => 0,
                    'peak_power'      => $max_power,
                    'soc_end'         => $this->socEnd,
                    'max_bus_current' => ($max_ibus == null) ? 0 : $max_ibus,
                    'max_bus_voltage' => ($max_vbus == null) ? 0 : $max_vbus,
                    'duration_hour'   => $delta_time,
                ]);


        }

    }


    /**
     * @param $site_oid
     * @param $parameter_id
     * @param $from
     * @param $to
     */
    protected function logParameter($site_oid, $pack_id, $parameter_id, $from, $to)
    {
        $polling_log = DB::table('log_polling_data')
            ->select(['parameter_id', $pack_id, 'updated_at'])
            ->where('site_oid', '=', 'd2881a44-1627-492f-8cc2-52583a9a383d')
            ->where('parameter_id', '=', $parameter_id)
            //->where('device_node_id','=',$node_info->id)
            //->where('updated_at', '>=', $from)
            //->where('updated_at', '<=', date('Y-m-d ', strtotime($to . ' +1 day')))
            ->get();

        return $polling_log;
    }


    public function debug3()
    {
        /*$debug = DailyPowerCalculate::create([
            'site_oid1' => 'site_oid',
            'pack_id'  => 1,
            'vbus'     => 0.2,
            'ibus'     => 10,
            'power'    => 10.3,
        ]);*/

        //$avg_vbus = DB::table('daily_power_calculate1')
        //    ->where('site_oid', '=', 'site_oid')
        //    ->where('pack_id', '=', 1)
        //    ->where('updated_at', '>=', date('Y-m-d H:i:s'))
        //    ->where('updated_at', '<=', date('Y-m-d H:i:s'))
        //    ->average('vbus');

        //$max_vbus = DB::table('daily_power_calculate1')
        //    ->where('site_oid', '=', 'site_oid')
        //    ->where('pack_id', '=', 1)
        //    ->where('updated_at', '>=',date('Y-m-d H:i:s') )
        //    ->where('updated_at', '<=', date('Y-m-d H:i:s'))
        //    ->max('vbus');

        //$debug = DB::table('raw_availability1')
        //    ->where('site_oid', '=', 'site_oid')
        //    ->where('pack_id', '=', '1')
        //    ->where('updated_at', '=', null)
        //    ->update([
        //        'avg_bus_current' => 0,
        //        'avg_bus_voltage' => 0,
        //        'best_power'      => 0,
        //        'peak_power'      => 0,
        //        'soc_end'         => 0,
        //        'max_bus_current' => 0,
        //        'max_bus_voltage' => 0,
        //        'duration_hour'   => 0,
        //    ]);


        /*$debug= DB::table('raw_availability1')
            ->insert([
                'region_oid'      => 'region_oid',
                'site_oid'        => 'site_oid',
                'pack_id'         => 1,
                'serial_number'   => 'serial_number',
                'month_of_data'   => 'month_name',
                'year_of_data'    => 'year',
                'system_state'    => 1,
                'avg_bus_current' => 0,
                'avg_bus_voltage' => 0,
                'best_power'      => 0,
                'peak_power'      => 0,
                'soc_start'       => 0,
                'soc_end'         => 0,
                'max_bus_current' => 0,
                'max_bus_voltage' => 0,
                'duration_hour'   => 0,
                'created_at'      => date('Y-m-d H:i:s'),
            ]);*/

        //PollingDataDevices::where('parameter_id1', '=', 1)
        //    ->where('site_oid', '=','site_oid')
        //    ->where('device_node_id', '=','device_node')
        //    ->update([
        //        'epack1' => 1,
        //    ]);

        //dd($debug);

        //count total dscharge per day
        //DB::table('raw_availability1')
        //    ->where('site_oid','=','site_oid')
        //    ->where('system_state','=',2)
        //    ->where('updated_at', '>=',date('Y-m-d H:i:s') )
        //    ->where('updated_at', '<=', date('Y-m-d H:i:s'))
        //    ->count('system_state');
        //    //->select('duration')
        //    //->sum('duration')

        //insert into table daily_availabitly
        //DB::table('daily_vailability1')
        //    ->insert([
        //       'region_oid' => 'region_oid',
        //       'site_oid' => 'site_oid',
        //       'year_of' => 'year_of',
        //       'month_of' => 'month_of',
        //    ]);

        //
        //$site = DB::table('daily_availability')
        //    ->where('site_oid','=','f71853c5-556a-4669-b4f1-f1e6c5a3236f')
        //    ->where('month_of_data','LIKE','NOVEMBER')
        //    ->get();
        //
        //return $site;

        DB::table('outage_report1')
            ->insert([
               'site_oid' => 'site_oid',
               'month_of_data' => 'month_of_data',
               'year_of_data' => 'year_of_data',
               'total_event_outage' => 'total_event_outage',
               'total_duration_outage' => 'total_duration_outage',
               'total_suported_outage' => 'total_suported_outage',
            ]);
    }
}
