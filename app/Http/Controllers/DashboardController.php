<?php

namespace App\Http\Controllers;

use App\Http\Models\PollingDataDevices;
use App\Http\Models\Site;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller {


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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nms_incell.monitoring.dashboard');
    }


    public function siteMap(Request $request)
    {
        $data['sites'] = Site::all();
        $data['latest'] = PollingDataDevices::latest('updated_at')->first();
        $data['site_up'] = DB::table('communication_data')->whereIn('monitoring_status' ,[1,3])->get()->count();
        $data['pln_down'] = DB::table('communication_data')->where('monitoring_status','=',2)->get()->count();
        $data['site_down'] = DB::table('communication_data')->where('monitoring_status','=',4)->get()->count();
        $data['commlost'] = DB::table('communication_data')->where('monitoring_status','=',0)->get()->count();

        //dd($data['site_up']);

        //$data['sites'] = Site::with(['pollingdatadevices'])
        //    ->whereHas('pollingdatadevices',function ($q){
        //        return $q->where('parameter_id','=',1);
        //    })
        //    ->get();

        return response()->json($data, 200);
    }


    public function markerInformation(Request $request)
    {
        //$site_info = Site::where('oid','=',$request->get('site_oid'))->first();
        $site_info = Site::with(['pollingdatadevices'])
            ->where('oid', '=', $request->get('site_oid'))
            ->whereHas('pollingdatadevices', function ($q) use ($request) {
                return $q->where('parameter_id', '=', 1)
                    ->where('site_oid', '=', $request->get('site_oid'));
            })
            ->first();

        $total_pack = $site_info->total_pack;

        $avg_data = DB::table('polling_data_devices')
            ->select([DB::raw('(pack1+pack2+pack3+pack4+pack5+pack6+pack7+pack8+pack9+pack10+pack11+pack12+pack13+pack14+pack15)/' . $total_pack . ' as value, updated_at')])
            ->where('site_oid', '=', $request->get('site_oid'))
            ->whereIn('parameter_id', [1, 2])
            //->where('device_node_id', '=', 1)
            ->get();


        $data = [
            'site'     => $site_info,
            'avg_data' => $avg_data,
        ];

        return response($data);
    }


    public function map()
    {
        //return view('debug.map');

        //$site_oid = 'e909178b-2f83-4201-90f4-17331cd58f7b';
        //$total_pack = 3;
        //$avg_soc = DB::table('polling_data_devices')
        //    ->select([DB::raw('(pack1+pack2+pack3+pack4+pack5+pack6+pack7+pack8+pack9+pack10+pack11+pack12+pack13+pack14+pack15)/' . $total_pack . ' as value')])
        //    ->where('site_oid', '=', $site_oid)
        //    //->where('parameter_id','=',1)
        //    ->whereIn('parameter_id', [1, 2])
        //    //->where('device_node_id', '=', 4)
        //    ->get();

        $data = PollingDataDevices::latest('updated_at')->first();


        dd($data);
        //return view('debug.map2');
    }
}
