<?php

namespace App\Jobs;

use App\Http\Models\DailyPowerCalculate;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DailyReportCalculationJob implements ShouldQueue {


    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $regionOId;
    private $siteOid;
    private $statusBattery;
    private $socEnd;
    private $packID;
    private $snPack;
    private $batteryVoltage;
    private $batteryCurrent;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($region_oid, $site_oid, $pack_id, $sn_pack, Request $request)
    {
        //
        $this->regionOId = $region_oid;
        $this->siteOid = $site_oid;
        $this->statusBattery = $request->get('status_batt');
        $this->socEnd = $request->get('SOC');
        $this->packID = $pack_id;
        $this->snPack = $sn_pack;
        $this->batteryVoltage = $request->get('BATT_VOLTAGE');
        $this->batteryCurrent = $request->get('BATT_CURRENT');


    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
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
                'site_oid' => $this->siteOid,
                'pack_id'  => ltrim($this->packID, 'pack'),
                'vbus'     => $this->batteryVoltage,
                'ibus'     => $this->batteryCurrent,
                //'power'    => number_format(abs($this->batteryCurrent * $this->batteryVoltage), 2),
                'power'    => number_format(abs($this->batteryCurrent)* $this->batteryVoltage,2),
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
                //'power'    => number_format(abs($this->batteryCurrent * $this->batteryVoltage), 2),
                'power'    => number_format(abs($this->batteryCurrent)* $this->batteryVoltage,2),
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

}
