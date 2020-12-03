<?php

namespace App\Http\Controllers;

use App\Http\Models\DeviceNode;
use App\Http\Models\Site;
use File;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Datatables;
class RawReportController extends Controller {


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('nms_incell.report.raw_report2');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function showOld(Request $request)
    {
        //dd('show only current month');
        //todo:show only current month
        $raw_report = \DB::table('raw_availability')
            ->leftJoin('sites', 'raw_availability.site_oid', '=', 'sites.oid')
            ->select([
                'sites.name as site_name', 'pack_id', 'serial_number', 'system_state', 'avg_bus_current', 'avg_bus_voltage', 'best_power', 'peak_power',
                'soc_start', 'soc_end', 'max_bus_current', 'duration_hour', 'raw_availability.created_at', 'raw_availability.updated_at',
            ])
            ->latest('raw_availability.updated_at')
            ->get()
            ->take(100);

        return Datatables::of($raw_report)
            ->addColumn('sys_state', function ($raw_report) {
                $state = $raw_report->system_state;
                switch ($state) {
                    case 1 :
                        $sys_state = 'Chg';
                        break;
                    case 2:
                        $sys_state = 'DsChg';
                        break;
                    case 3:
                        $sys_state = 'Ready';
                        break;
                    case 4:
                        $sys_state = 'Batt.Outage';
                        break;
                }

                return $sys_state;
            })
            ->make(true);

    }


    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return ResponseFactory|Response|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request)
    {
        $site = Site::with(['node', 'sn_pack'])
            ->where('oid', '=', $request->get('site_oid'))
            ->first();


        if ($site == null) {
            return response('NOT VALID SITE', 200);
        }

        ////todo:show only current month
        //$month = date('F');
        //dd('show only current month:'.$month);
        //
        //$raw_report = \DB::table('raw_availability')
        //    ->leftJoin('sites', 'raw_availability.site_oid', '=', 'sites.oid')
        //    ->select([
        //        'sites.name as site_name', 'pack_id', 'serial_number', 'system_state', 'avg_bus_current', 'avg_bus_voltage', 'best_power', 'peak_power',
        //        'soc_start', 'soc_end', 'max_bus_current', 'duration_hour', 'raw_availability.created_at', 'raw_availability.updated_at',
        //    ])
        //    ->latest('raw_availability.updated_at')
        //    ->get()
        //    ->take(100);
        //
        //return Datatables::of($raw_report)
        //    ->addColumn('sys_state', function ($raw_report) {
        //        $state = $raw_report->system_state;
        //        switch ($state) {
        //            case 1 :
        //                $sys_state = 'Ready';
        //                break;
        //            case 2:
        //                $sys_state = 'DsChg';
        //                break;
        //            case 3:
        //                $sys_state = 'Chg';
        //                break;
        //            case 4:
        //                $sys_state = 'Comm. Lost';
        //                break;
        //        }
        //
        //        return $sys_state;
        //    })
        //    ->make(true);


        $site_data = [
            'site' => $site,
        ];

        return response($site_data);

    }


    public function pack(Request $request)
    {
        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');

        $raw_report = \DB::table('raw_availability')
            ->where('site_oid', '=', $site_oid)
            ->where('pack_id', '=', $pack_id)
            //->where('raw_availability.pack_id','=',$pack_id)
            ->leftJoin('sites', 'raw_availability.site_oid', '=', 'sites.oid')
            ->select([
                'sites.name as site_name', 'pack_id', 'serial_number', 'system_state', 'avg_bus_current', 'avg_bus_voltage', 'best_power', 'peak_power',
                'soc_start', 'soc_end', 'max_bus_current', 'duration_hour', 'raw_availability.created_at', 'raw_availability.updated_at',
            ])
            ->latest('raw_availability.updated_at')
            ->get()
            ->take(100);


        //return response($raw_report);

        return Datatables::of($raw_report)
            ->addColumn('sys_state', function ($raw_report) {
                $state = $raw_report->system_state;
                switch ($state) {
                    case 1 :
                        $sys_state = 'Ready';
                        break;
                    case 2:
                        $sys_state = 'DsChg';
                        break;
                    case 3:
                        $sys_state = 'Chg';
                        break;
                    case 4:
                        $sys_state = 'Comm. Lost';
                        break;
                    default:
                        $sys_state = 'Comm. Lost';
                }

                return $sys_state;
            })
            ->make(true);
    }


    public function periode(Request $request)
    {
        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');
        $periode = $request->get('from');
        $month = date('F', strtotime($periode));
        $year = date('Y', strtotime($periode));


        $raw_report = \DB::table('raw_availability')
            ->where('site_oid', '=', $site_oid)
            ->where('pack_id', '=', $pack_id)
            ->where('month_of_data', '=', $month)
            ->where('year_of_data', '=', $year)
            ->leftJoin('sites', 'raw_availability.site_oid', '=', 'sites.oid')
            ->select([
                'sites.name as site_name', 'pack_id', 'serial_number', 'system_state', 'avg_bus_current', 'avg_bus_voltage', 'best_power', 'peak_power',
                'soc_start', 'soc_end', 'max_bus_current', 'duration_hour', 'raw_availability.created_at', 'raw_availability.updated_at',
            ])
            ->latest('raw_availability.updated_at')
            ->get();

        return Datatables::of($raw_report)
            ->addColumn('sys_state', function ($raw_report) {
                $state = $raw_report->system_state;
                switch ($state) {
                    case 1 :
                        $sys_state = 'Ready';
                        break;
                    case 2:
                        $sys_state = 'DsChg';
                        break;
                    case 3:
                        $sys_state = 'Chg';
                        break;
                    case 4:
                        $sys_state = 'Comm. Lost';
                        break;
                    default:
                        $sys_state = 'Comm. Lost';
                }

                return $sys_state;
            })
            ->make(true);
    }


    public function download(Request $request)
    {
        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');
        $periode = $request->get('from');
        $month = date('F', strtotime($periode));
        $year = date('Y', strtotime($periode));
        $select_batt_id = 'batt_id' . $pack_id;
        $select_sn = 'sn' . $pack_id;
        $limit = 10000;


        /**
         * 1.Battery ID
         * 2.Site ID
         * 3.Site Name
         * 4.Region Name
         */

        //$node_info = DeviceNode::with('site')
        //    ->where('site_oid', '=', $site_oid)->first();


        $site_info = Site::with(['region', 'sn_pack'])->where('oid', '=', $site_oid)->first();

        $region_name = $site_info->region->name;
        $site_name = $site_info->name;
        $site_id = $site_info->site_id_label;
        $battery_id = $site_info->sn_pack->$select_batt_id;
        $battery_sn = $site_info->sn_pack->$select_sn;


        //file_name : Raw_Availability_SiteName_PakckID_Month_Year.xlsx
        $fileLogName = 'Raw_Availability_' . $site_name . '_Pack' . $pack_id . '_' . $month . '_' . $year;
        $loadTemplate = 'RawAvailabilityNew.xlsx';

        File::cleanDirectory('exports');

        $linkDownload = [
            'success' => true,
            'path'    => 'http://' . $request->server('HTTP_HOST') . '/exports/' . $fileLogName . '.xlsx',
            //'path'    => 'https://' . $request->server('HTTP_HOST') . '/exports/' . $fileLogName . '.xlsx',

        ];

        $raw_availabilty = \DB::table('raw_availability')
            ->where('site_oid', '=', $site_oid)
            ->where('pack_id', '=', $pack_id)
            ->where('month_of_data', '=', $month)
            ->where('year_of_data', '=', $year)
            ->leftJoin('sites', 'raw_availability.site_oid', '=', 'sites.oid')
            ->select([
                'sites.name as site_name', 'pack_id', 'serial_number', 'system_state', 'avg_bus_current', 'avg_bus_voltage', 'best_power', 'peak_power',
                'soc_start', 'soc_end', 'max_bus_current', 'duration_hour', 'raw_availability.created_at', 'raw_availability.updated_at',
            ])
            ->latest('raw_availability.updated_at')
            ->get();


        \Excel::load(public_path($loadTemplate), function ($excel) use ($region_name, $site_name, $site_id, $battery_id, $battery_sn, $raw_availabilty, $limit) {

            $excel->sheet('Hutch', function ($sheet) use ($region_name, $site_name, $site_id, $battery_id, $battery_sn, $raw_availabilty, $limit) {

                $start = 2;

                foreach ($raw_availabilty as $data):
                    $row=$start++;
                    $sheet->cell('A'.$row,$battery_id);//BATTERY ID
                    $sheet->cell('B'.$row,$site_id);//SITE ID
                    $sheet->cell('C'.$row,$site_name);//SITE NAME
                    $sheet->cell('D'.$row,$data->system_state);//SYSTEM STATUS
                    $sheet->cell('E'.$row,$data->created_at);//DTIME START
                    $sheet->cell('F'.$row,$data->updated_at);//DTIME END
                    $sheet->cell('G'.$row,$data->duration_hour);//DURATION
                    $sheet->cell('H'.$row,$data->avg_bus_current);//AVG IBUS
                    $sheet->cell('I'.$row,$data->avg_bus_voltage);//AVG VBUS
                    //$sheet->cell('J'.$row++,$battery_id);//BEST POWER
                    $sheet->cell('K'.$row,$data->peak_power);//POWER PEAK
                    $sheet->cell('L'.$row,$data->soc_start);//SOC START
                    $sheet->cell('M'.$row,$data->soc_end);//SOC END
                    $sheet->cell('N'.$row,$data->max_bus_current);//MAX IBUS
                    //$sheet->cell('O'.$row++,$battery_id);//CL LVD
                    //$sheet->cell('P'.$row++,$battery_id);//FAILURE CATEGORY
                    //$sheet->cell('Q'.$row++,$battery_id);//REASONE
                    //$sheet->cell('R'.$row++,$battery_id);//FAILURE ISSUE
                    //$sheet->cell('S'.$row++,$battery_id);//REGION
                    //$sheet->cell('T'.$row++,$battery_id);//CLUSTER
                endforeach;

            });


        })->setFilename($fileLogName)->store('xlsx', 'exports');

        return $linkDownload;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
