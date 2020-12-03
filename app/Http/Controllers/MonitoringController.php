<?php

namespace App\Http\Controllers;

use App\Http\Models\PollingAlarmDevices;
use App\Http\Models\PollingDataDevices;
use App\Http\Models\Site;
use Auth;
use DB;
use Illuminate\Http\Request;
use function foo\func;

class MonitoringController extends Controller {


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
        return view('nms_incell.monitoring.site_monitoring2');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
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

        $polling_data = PollingDataDevices::with(['parameters'])
            //->whereHas('parameters',function ($q){
            //    return $q->where('group','=','POLLING');
            //})
            ->where('site_oid', '=', $request->get('site_oid'))
            ->where('device_node_id', '=', $site->node[0]->id)
            ->get();

        $polling_alarm = PollingAlarmDevices::with(['parameters'])
            //->whereHas('parameters',function ($q){
            //    return $q->where('group','=','ALARM');
            //})
            ->where('site_oid', '=', $request->get('site_oid'))
            ->where('device_node_id', '=', $site->node[0]->id)
            ->get();

        $digital_input = PollingAlarmDevices::with(['parameters'])
            //->select(['pack1'])
            ->whereHas('parameters', function ($q) {
                return $q->where('name', 'LIKE', '%DIG%');
            })
            ->where('site_oid', '=', $request->get('site_oid'))
            ->where('device_node_id', '=', $site->node[0]->id)
            ->get();

        //dd($digital_input);

        $site_data = [
            'site'          => $site,
            'polling'       => $polling_data,
            'alarm'         => $polling_alarm,
            'digital_input' => $digital_input,
        ];

        return response($site_data);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function nodeTree()
    {

        $user_credential = Auth::getUser()->region_oid;


        $node_region = DB::table('regions')
            ->select(['oid as id', 'name as text', 'parent', 'icon'])
            //->where('parent_oid', '=', '#')
            ->orderBy('text', 'asc')
            ->get();
        //dd($node_region);

        if ($user_credential == 'admin') {
            //$node = DB::table('node_tree')->select(['oid as id', 'parent_oid as parent', 'name as text', 'icon'])->orderBy('name', "asc")->get();

            $node_region = [];
            $node_region = DB::table('regions')
                ->select(['oid as id', 'name as text', 'parent', 'icon'])
                //->where('parent_oid', '=', '#')
                ->orderBy('text', 'asc')
                ->get();

            $node_city = [];

            for ($x = 0; $x < $node_region->count(); $x++):

                $city[] = DB::table('cities')
                    ->select(['oid as id', 'name as text', 'region_oid as parent', 'icon'])
                    ->where('region_oid', '=', $node_region[$x]->id)
                    ->orderBy('text', 'asc')
                    ->get()->toArray();

                $node_city = call_user_func_array('array_merge', $city);

            endfor;

            $collection_city = collect($node_city);


            $node_site = [];

            for ($x = 0; $x < count($node_city); $x++) :

                $site[] = DB::table('sites')
                    //->select(['oid as id', 'name as text', 'city_oid as parent', 'icon'])
                    ->select(['oid as id', DB::raw('CONCAT(site_id_label," | ",name) as text'), 'city_oid as parent', 'icon'])
                    //    ->select(DB::raw('CONCAT(site_id_label," ",name) as text'))
                    ->where('city_oid', '=', $node_city[$x]->id)
                    ->orderBy('text', 'asc')
                    ->get()->toArray();

                $node_site = call_user_func_array('array_merge', $site);

            endfor;

            $collection_site = collect($node_site);

            $node = array_merge(json_decode($node_region), json_decode($collection_city), json_decode($collection_site));

        } else {


            $node_region = [];
            $node_region = DB::table('regions')
                ->select(['oid as id', 'name as text', 'parent', 'icon'])
                //->where('parent_oid', '=', '#')
                ->orderBy('text', 'asc')
                ->where('oid', '=', $user_credential)
                ->get();


            $node_city = [];
            for ($x = 0; $x < $node_region->count(); $x++) {
                foreach ($node_region as $region):
                    //$node_city = $region;
                    //$node_city = DB::table('node_tree')
                    //    ->select(['oid as id', 'name as text', 'parent_oid as parent', 'icon'])
                    //    ->where('parent_oid', '=', $region->id)
                    //    ->orderBy('text', 'asc')
                    //    ->get();

                    $node_city = DB::table('cities')
                        ->select(['oid as id', 'name as text', 'region_oid as parent', 'icon'])
                        ->where('region_oid', '=', $region->id)
                        ->orderBy('text', 'asc')
                        ->get();


                endforeach;
            }

            $node_site = [];

            for ($x = 0; $x < $node_city->count(); $x++) {

                //$site[] = DB::table('node_tree')
                //    ->select(['oid as id', 'name as text', 'parent_oid as parent', 'icon'])
                //    ->where('parent_oid', '=', $node_city[$x]->id)
                //    ->orderBy('text', 'asc')
                //    ->get()->toArray();

                $site[] = DB::table('sites')
                    ->select(['oid as id', 'name as text', 'city_oid as parent', 'icon'])
                    ->where('city_oid', '=', $node_city[$x]->id)
                    ->orderBy('text', 'asc')
                    ->get()->toArray();


                $node_site = call_user_func_array('array_merge', $site);

            }

            $collection_site = collect($node_site);

            $node = array_merge(json_decode($node_region), json_decode($node_city), json_decode($collection_site));
        }

        return response($node);


    }
}
