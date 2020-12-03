<?php

namespace App\Http\Controllers;

use App\Http\Models\DeviceNode;
use App\Http\Models\Site;
use Datatables;
use DB;
use Excel;
use Exception;
use File;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DatalogController extends Controller {


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
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        return view('nms_incell.log.polling4');
    }


    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return ResponseFactory|Application|Response|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request)
    {
        /*GET DATA SITE
            - site
            - device_node
            - device
        */
        //$site = Site::where('oid','=',$request->get('site_oid'))->first();
        $site = Site::with(['node', 'sn_pack'])
            ->where('oid', '=', $request->get('site_oid'))
            ->first();


        if ($site == null) {
            return response('NOT VALID SITE', 200);
        }

        //$polling_data = DB::table('polling_data_devices')
        //    ->where('site_oid','=',$request->get('site_oid'))
        //    ->where('device_node_id','=',$site->node[0]->id)
        //    ->get();

        //$polling_data = PollingDataDevices::with(['parameters'])
        //    //->whereHas('parameters',function ($q){
        //    //    return $q->where('group','=','POLLING');
        //    //})
        //    ->where('site_oid', '=', $request->get('site_oid'))
        //    ->where('device_node_id', '=', $site->node[0]->id)
        //    ->get();
        //
        //$polling_alarm = PollingAlarmDevices::with(['parameters'])
        //    //->whereHas('parameters',function ($q){
        //    //    return $q->where('group','=','ALARM');
        //    //})
        //    ->where('site_oid', '=', $request->get('site_oid'))
        //    ->where('device_node_id', '=', $site->node[0]->id)
        //
        //    ->get();

        $site_data = [
            'site' => $site,
            //'polling' => $polling_data,
            //'alarm'   => $polling_alarm,
        ];

        return response($site_data);
    }


    /**
     *
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function pack(Request $request)
    {
        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');
        //$from = $request->get('from');
        //$to = $request->get('to');

        $polling_log = DB::table('log_polling_data')
            ->select(['alias as name', 'unit', $pack_id . ' as value', 'log_polling_data.updated_at'])
            ->leftJoin('parameters', 'log_polling_data.parameter_id', '=', 'parameters.id')
            ->where('site_oid', '=', $site_oid)
            ->latest('log_polling_data.updated_at')
            ->take(100);

        return Datatables::of($polling_log)->make(true);

    }


    /**
     *
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function periode(Request $request)
    {
        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');
        $from = $request->get('from');
        $to = $request->get('to');

        $polling_log = DB::table('log_polling_data')
            ->select(['alias as name', 'unit', $pack_id . ' as value', 'log_polling_data.updated_at'])
            ->leftJoin('parameters', 'log_polling_data.parameter_id', '=', 'parameters.id')
            ->where('site_oid', '=', $site_oid)
            ->where('log_polling_data.updated_at', '>=', $from)
            ->where('log_polling_data.updated_at', '<=', date('Y-m-d ', strtotime($to . ' +1 day')))
            ->get();

        return Datatables::of($polling_log)->make(true);

    }


    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function chart(Request $request)
    {
        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');

        $soc = DB::table('log_polling_data')
            ->select('updated_at', $pack_id . ' as value')
            ->where('site_oid', '=', $site_oid)
            ->where('parameter_id', '=', 1)
            ->latest('updated_at')
            ->take(100)
            ->get();


        $vbatt = DB::table('log_polling_data')
            ->select('updated_at', $pack_id . ' as value')
            ->where('site_oid', '=', $site_oid)
            ->where('parameter_id', '=', 2)
            ->latest('updated_at')
            ->take(100)
            ->get();

        $ibatt = DB::table('log_polling_data')
            ->select('updated_at', $pack_id . ' as value')
            ->where('site_oid', '=', $site_oid)
            ->where('parameter_id', '=', 3)
            ->latest('updated_at')
            ->take(100)
            ->get();

        $batt_status = DB::table('log_polling_data')
            ->select('updated_at', $pack_id . ' as value')
            ->where('site_oid', '=', $site_oid)
            ->where('parameter_id', '=', 43)
            ->latest('updated_at')
            ->take(100)
            ->get();

        $data = [
            'soc'         => $soc,
            'vbatt'       => $vbatt,
            'ibatt'       => $ibatt,
            'batt_status' => $batt_status,
        ];

        return response()->json($data, 200);
    }


    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function chartPeriode(Request $request)
    {

        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');
        $from = $request->get('from');
        $to = $request->get('to');

        $soc = DB::table('log_polling_data')
            ->select('updated_at', $pack_id . ' as value')
            ->where('site_oid', '=', $site_oid)
            ->where('parameter_id', '=', 1)
            ->where('updated_at', '>=', $from)
            ->where('updated_at', '<=', date('Y-m-d ', strtotime($to . ' +1 day')))
            ->latest('updated_at')
            ->get();

        $vbatt = DB::table('log_polling_data')
            ->select('updated_at', $pack_id . ' as value')
            ->where('site_oid', '=', $site_oid)
            ->where('parameter_id', '=', 2)
            ->where('updated_at', '>=', $from)
            ->where('updated_at', '<=', date('Y-m-d ', strtotime($to . ' +1 day')))
            ->latest('updated_at')
            ->get();

        $ibatt = DB::table('log_polling_data')
            ->select('updated_at', $pack_id . ' as value')
            ->where('site_oid', '=', $site_oid)
            ->where('parameter_id', '=', 3)
            ->where('updated_at', '>=', $from)
            ->where('updated_at', '<=', date('Y-m-d ', strtotime($to . ' +1 day')))
            ->latest('updated_at')
            ->get();

        $batt_status = DB::table('log_polling_data')
            ->select('updated_at', $pack_id . ' as value')
            ->where('site_oid', '=', $site_oid)
            ->where('parameter_id', '=', 43)
            ->where('updated_at', '>=', $from)
            ->where('updated_at', '<=', date('Y-m-d ', strtotime($to . ' +1 day')))
            ->latest('updated_at')
            ->get();

        $data = [
            'soc'         => $soc,
            'vbatt'       => $vbatt,
            'ibatt'       => $ibatt,
            'batt_status' => $batt_status,
        ];

        return response()->json($data, 200);

    }


    /**
     *
     * @param Request $request
     * @return array
     */
    public function download(Request $request)
    {
        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');
        $from = $request->get('from');
        $to = $request->get('to');
        $limit = 10000;


        $node_info = DeviceNode::with('site')
            ->where('site_oid', '=', $site_oid)->first();

        $fileLogName = 'Datalog_' . $node_info->name . '_' . $from . '_' . $to;
        $loadTemplate = 'DatalogTemplate.xlsx';

        //clear old file log
        File::cleanDirectory('exports');

        $linkDownload = [
            'success' => true,
            'path'    => 'http://' . $request->server('HTTP_HOST') . '/exports/' . $fileLogName . '.xlsx',
            //'path'    => 'https://' . $request->server('HTTP_HOST') . '/exports/' . $fileLogName . '.xlsx',

        ];


        $log = [
            'soc'           => $this->logParameter($site_oid, $pack_id, 1, $from, $to),
            'batt_voltage'  => $this->logParameter($site_oid, $pack_id, 2, $from, $to),
            'batt_curr'     => $this->logParameter($site_oid, $pack_id, 3, $from, $to),
            'min_cell_volt' => $this->logParameter($site_oid, $pack_id, 4, $from, $to),
            'max_cell_volt' => $this->logParameter($site_oid, $pack_id, 5, $from, $to),
            'cycle'         => $this->logParameter($site_oid, $pack_id, 6, $from, $to),
            'backup_time'   => $this->logParameter($site_oid, $pack_id, 7, $from, $to),
            'life_time'     => $this->logParameter($site_oid, $pack_id, 34, $from, $to),
            'pwr_sw_temp'   => $this->logParameter($site_oid, $pack_id, 37, $from, $to),
            'min_temp'      => $this->logParameter($site_oid, $pack_id, 35, $from, $to),
            'max_temp'      => $this->logParameter($site_oid, $pack_id, 36, $from, $to),
            'vcell1'        => $this->logParameter($site_oid, $pack_id, 19, $from, $to),
            'vcell2'        => $this->logParameter($site_oid, $pack_id, 20, $from, $to),
            'vcell3'        => $this->logParameter($site_oid, $pack_id, 21, $from, $to),
            'vcell4'        => $this->logParameter($site_oid, $pack_id, 22, $from, $to),
            'vcell5'        => $this->logParameter($site_oid, $pack_id, 23, $from, $to),
            'vcell6'        => $this->logParameter($site_oid, $pack_id, 24, $from, $to),
            'vcell7'        => $this->logParameter($site_oid, $pack_id, 25, $from, $to),
            'vcell8'        => $this->logParameter($site_oid, $pack_id, 26, $from, $to),
            'vcell9'        => $this->logParameter($site_oid, $pack_id, 27, $from, $to),
            'vcell10'       => $this->logParameter($site_oid, $pack_id, 28, $from, $to),
            'vcell11'       => $this->logParameter($site_oid, $pack_id, 29, $from, $to),
            'vcell12'       => $this->logParameter($site_oid, $pack_id, 30, $from, $to),
            'vcell13'       => $this->logParameter($site_oid, $pack_id, 31, $from, $to),
            'vcell14'       => $this->logParameter($site_oid, $pack_id, 32, $from, $to),
            'vcell15'       => $this->logParameter($site_oid, $pack_id, 33, $from, $to),
        ];


        Excel::load(public_path($loadTemplate), function ($excel) use ($node_info, $pack_id, $from, $to, $limit, $log) {

            $excel->sheet('Sheet1', function ($sheet) use ($node_info, $pack_id, $from, $to, $limit, $log) {
                $sheet->cell('C7', $node_info->site->name); //SITE NAME;
                $sheet->cell('C8', $node_info->site->address); //SITE ADDRESS;
                $sheet->cell('C9', $node_info->name); //DEVICE NODE NAME;
                $sheet->cell('C10', strtoupper($pack_id)); //BATTERY PACK ;
                $sheet->cell('C11', $node_info->ipaddress); //DEVICE NODE IPADDRESS;
                $sheet->cell('C12', $from); //FROM;
                $sheet->cell('C13', $to); //TO


                //$a = 13;
                $no = 1;

                $cell = 16;


                for ($x = 0; $x <= $limit; [$x++, $cell++, $no++]) {
                    if (isset($log['soc'][$x])) {
                        $sheet->cell('A' . $cell, $no);
                        $sheet->cell('B' . $cell, $log['soc'][$x]->updated_at);
                        $sheet->cell('C' . $cell, ($log['soc'][$x]->value == 0) ? '-0' : $log['soc'][$x]->value);
                        $sheet->cell('D' . $cell, ($log['batt_voltage'][$x]->value == 0) ? '-0' : $log['batt_voltage'][$x]->value);
                        $sheet->cell('E' . $cell, ($log['batt_curr'][$x]->value == 0) ? '-0' : $log['batt_curr'][$x]->value);
                        $sheet->cell('F' . $cell, ($log['min_cell_volt'][$x]->value == 0) ? '-0' : $log['min_cell_volt'][$x]->value);
                        $sheet->cell('G' . $cell, ($log['max_cell_volt'][$x]->value == 0) ? '-0' : $log['max_cell_volt'][$x]->value);
                        $sheet->cell('H' . $cell, ($log['cycle'][$x]->value == 0) ? '-0' : $log['cycle'][$x]->value);
                        $sheet->cell('I' . $cell, ($log['life_time'][$x]->value == 0) ? '-0' : $log['life_time'][$x]->value);
                        $sheet->cell('J' . $cell, ($log['pwr_sw_temp'][$x]->value == 0) ? '-0' : $log['pwr_sw_temp'][$x]->value);
                        $sheet->cell('L' . $cell, ($log['min_temp'][$x]->value == 0) ? '-0' : $log['min_temp'][$x]->value);
                        $sheet->cell('M' . $cell, ($log['max_temp'][$x]->value == 0) ? '-0' : $log['max_temp'][$x]->value);
                        $sheet->cell('N' . $cell, ($log['vcell1'][$x]->value == 0) ? '-0' : $log['vcell1'][$x]->value);
                        $sheet->cell('O' . $cell, ($log['vcell2'][$x]->value == 0) ? '-0' : $log['vcell2'][$x]->value);
                        $sheet->cell('P' . $cell, ($log['vcell3'][$x]->value == 0) ? '-0' : $log['vcell3'][$x]->value);
                        $sheet->cell('Q' . $cell, ($log['vcell4'][$x]->value == 0) ? '-0' : $log['vcell4'][$x]->value);
                        $sheet->cell('R' . $cell, ($log['vcell5'][$x]->value == 0) ? '-0' : $log['vcell5'][$x]->value);
                        $sheet->cell('S' . $cell, ($log['vcell6'][$x]->value == 0) ? '-0' : $log['vcell6'][$x]->value);
                        $sheet->cell('T' . $cell, ($log['vcell7'][$x]->value == 0) ? '-0' : $log['vcell7'][$x]->value);
                        $sheet->cell('U' . $cell, ($log['vcell8'][$x]->value == 0) ? '-0' : $log['vcell8'][$x]->value);
                        $sheet->cell('V' . $cell, ($log['vcell9'][$x]->value == 0) ? '-0' : $log['vcell9'][$x]->value);
                        $sheet->cell('W' . $cell, ($log['vcell10'][$x]->value == 0) ? '-0' : $log['vcell10'][$x]->value);
                        $sheet->cell('X' . $cell, ($log['vcell11'][$x]->value == 0) ? '-0' : $log['vcell11'][$x]->value);
                        $sheet->cell('Y' . $cell, ($log['vcell12'][$x]->value == 0) ? '-0' : $log['vcell12'][$x]->value);
                        $sheet->cell('Z' . $cell, ($log['vcell13'][$x]->value == 0) ? '-0' : $log['vcell13'][$x]->value);
                        $sheet->cell('AA' . $cell, ($log['vcell14'][$x]->value == 0) ? '-0' : $log['vcell14'][$x]->value);
                        $sheet->cell('AB' . $cell, ($log['vcell15'][$x]->value == 0) ? '-0' : $log['vcell15'][$x]->value);

                    }

                }


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
     * @param Request $request
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
     * @return void
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param $site_oid
     * @param $parameter_id
     * @param $from
     * @param $to
     * @return Collection
     */
    protected function logParameter($site_oid, $pack_id, $parameter_id, $from, $to)
    {
        $polling_log = DB::table('log_polling_data')
            ->select(['parameter_id', $pack_id . ' as value', 'updated_at'])
            ->where('site_oid', '=', $site_oid)
            ->where('parameter_id', '=', $parameter_id)
            //->where('device_node_id','=',$node_info->id)
            ->where('updated_at', '>=', $from)
            ->where('updated_at', '<=', date('Y-m-d ', strtotime($to . ' +1 day')))
            ->get();

        return $polling_log;
    }
}
