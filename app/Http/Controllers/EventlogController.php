<?php

namespace App\Http\Controllers;

use App\Http\Models\DeviceNode;
use App\Http\Models\Site;
use Datatables;
use DB;
use Excel;
use File;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventlogController extends Controller {


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
        return view('nms_incell.log.alarm');
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
     * @param Request $request
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
     * @return ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request)
    {
        $site = Site::with(['node', 'sn_pack'])
            ->where('oid', '=', $request->get('site_oid'))
            ->first();


        if ($site == null) {
            return response('NOT VALID SITE', 200);
        }

        $site_data = [
            'site' => $site,
        ];

        return response($site_data);

    }


    public function pack(Request $request)
    {
        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');
        $pack = str_ireplace('pack', '', $pack_id);

        $alarm_log = DB::table('log_polling_alarm')
            ->select(['alias as name', 'pack_id', 'value', 'log_polling_alarm.updated_at'])
            ->leftJoin('parameters', 'log_polling_alarm.parameter_id', '=', 'parameters.id')
            ->where('site_oid', '=', $site_oid)
            ->where('pack_id', '=', $pack)
            ->latest('log_polling_alarm.updated_at')
            ->take(100);

        return Datatables::of($alarm_log)
            ->addColumn('status', function ($alarm_log) {
                return ($alarm_log->value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
            })
            ->make(true);

    }


    public function periode(Request $request)
    {
        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');
        $from = $request->get('from');
        $to = $request->get('to');

        $pack = str_ireplace('pack', '', $pack_id);


        $alarm_log = DB::table('log_polling_alarm')
            ->select(['alias as name', 'pack_id', 'value', 'log_polling_alarm.updated_at'])
            ->leftJoin('parameters', 'log_polling_alarm.parameter_id', '=', 'parameters.id')
            ->where('site_oid', '=', $site_oid)
            ->where('pack_id', '=', $pack)
            ->where('log_polling_alarm.updated_at', '>=', $from)
            ->where('log_polling_alarm.updated_at', '<=', date('Y-m-d ', strtotime($to . ' +1 day')))
            ->latest('log_polling_alarm.updated_at')
            ->get();


        return Datatables::of($alarm_log)
            ->addColumn('status', function ($alarm_log) {
                return ($alarm_log->value == 1) ? 'ACTIVE' : 'IN-ACTIVE';
            })
            ->make(true);


    }


    public function download(Request $request)
    {
        $site_oid = $request->get('site_oid');
        $pack_id = $request->get('pack_id');
        $from = $request->get('from');
        $to = $request->get('to');
        $limit = 10000;

        $pack = str_ireplace('pack', '', $pack_id);

        $node_info = DeviceNode::with('site')
            ->where('site_oid', '=', $site_oid)->first();

        $fileLogName = 'Eventlog_' . $node_info->name . '_' . $from . '_' . $to;
        $loadTemplate = 'EventlogTemplate.xlsx';
        //clear old file log
        File::cleanDirectory('exports');

        $linkDownload = [
            'success' => true,
            'path'    => 'http://' . $request->server('HTTP_HOST') . '/exports/' . $fileLogName . '.xlsx',
            //'path'    => 'https://' . $request->server('HTTP_HOST') . '/exports/' . $fileLogName . '.xlsx',
        ];

        $alarm_log = DB::table('log_polling_alarm')
            ->select(['alias as name', 'pack_id', 'value', 'log_polling_alarm.updated_at'])
            ->leftJoin('parameters', 'log_polling_alarm.parameter_id', '=', 'parameters.id')
            ->where('site_oid', '=', $site_oid)
            ->where('pack_id', '=', $pack)
            ->where('log_polling_alarm.updated_at', '>=', $from)
            ->where('log_polling_alarm.updated_at', '<=', date('Y-m-d ', strtotime($to . ' +1 day')))
            ->latest('log_polling_alarm.updated_at')
            ->get();

        Excel::load(public_path($loadTemplate), function ($excel) use ($node_info, $pack,$from, $to, $limit, $alarm_log) {

            $excel->sheet('Sheet1', function ($sheet) use ($node_info,$pack ,$from, $to, $limit, $alarm_log) {
                $sheet->cell('C7', $node_info->site->name); //SITE NAME;
                $sheet->cell('C8', $node_info->site->address); //SITE ADDRESS;
                $sheet->cell('C9', $node_info->name); //DEVICE NODE NAME;
                $sheet->cell('C10','PACK '.$pack); //BATTERY PACK ;
                $sheet->cell('C11', $node_info->ipaddress); //DEVICE NODE IPADDRESS;
                $sheet->cell('C12', $from); //FROM;
                $sheet->cell('C13', $to); //TO


                $a = 13;
                $no = 1;

                $cell = 16;


                for ($x = 0; $x <= $limit; [$x++, $cell++, $no++]) {
                    if (isset($alarm_log[$x])) {
                        $sheet->cell('A' . $cell, $no);
                        $sheet->cell('B' . $cell, $alarm_log[$x]->updated_at);
                        $sheet->cell('C' . $cell, $alarm_log[$x]->name);
                        $sheet->cell('D' . $cell, ($alarm_log[$x]->value == 1) ? 'ACTIVE' : 'IN-ACTIVE');

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
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
