<?php

namespace App\Http\Controllers;

use App\Http\Models\DeviceList;
use App\Http\Models\DeviceNode;
use App\Http\Models\Site;
use App\Http\Requests\DeviceNodeRequest;
use DB;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\Datatables\Datatables;

class NodeController extends Controller {


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
     * @return Factory|View
     */
    public function index()
    {
        $data['sites'] = Site::all();
        $data['devices'] = DeviceList::all();
        //$data['pollers'] = Poller::all();

        return view('nms_incell.management.device_node', $data);
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
     * Create/store new node data
     *
     * @param DeviceNodeRequest $request
     * @return JsonResponse
     */
    public function store(DeviceNodeRequest $request)
    {

        $node = DeviceNode::create($request->except(['_token', 'id']));

        $comm_data = [
            'device_node_id'    => $node->id,
            'monitoring_status' => 0,
            'alarm_status'      => 0,
        ];
        DB::table('communication_data')->insert($comm_data);

        /**
         * Insert new data node+parameter  into polling_data table for monitoring data
         */
        $polling = DB::table('parameters')
            ->where('device_id', '=', $request->get('device_id'))
            ->where('group', '=', 'POLLING')
            ->get();

        foreach ($polling as $parameter):

            DB::table('polling_data_devices')->insert([
                'site_oid'       => $request->get('site_oid'),
                'device_node_id' => $node->id,
                'parameter_id'   => $parameter->id,
                //'severity_id' =>
                //'pack1'          => 0,
                //'pack2'          => 0,
                //'pack3'          => 0,
                //'pack4'          => 0,
            ]);
        endforeach;

        /**
         * Insert new data node+alarm into polling_alarm table for handling alarm data
         */
        $alarms = DB::table('parameters')
            ->where('device_id', '=', $request->get('device_id'))
            ->where('group', '=', 'ALARM')
            ->get();

        foreach ($alarms as $parameter):

            DB::table('polling_alarm_devices')->insert([
                'site_oid'       => $request->get('site_oid'),
                'device_node_id' => $node->id,
                'parameter_id'   => $parameter->id,

            ]);

        endforeach;

        /*INSERT NEW SERIAL NUMBER PACK DATA*/
        DB::table('serial_number_pack')->insert([
            'site_oid'       => $request->get('site_oid'),
            'device_node_id' => $node->id,
        ]);

        return response()->json(['Saved!', 200]);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function show()
    {
        $node = DeviceNode::with(['site', 'device'])->get();

        return Datatables::of($node)->addColumn('option', function ($node) {
            return '<button type="button" class="btn btn-info width-100 btn-outline btn-sm " onclick="edit(' . $node['id'] . ')" ><i class="fa fa-pencil"></i> EDIT </button>
         <button type="button" class="btn btn-danger width-100 btn-outline btn-sm " onclick="deleteData(' . $node['id'] . ')"><i class="fa fa-times"></i> DELETE </button>';
        })
            ->rawColumns(['option'])
            ->make(true);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Collection|Model
     */
    public function edit($id)
    {
        return DeviceNode::findOrFail($id);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(DeviceNodeRequest $request, $id)
    {
        DeviceNode::find($id)->fill($request->except(['_token', 'oid']))->save();

        return response()->json(['Updated!', 200]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        //DeviceNode::destroy($id);
        $node = DeviceNode::findOrFail($id);

        //delete data on  polling_data  first before delete device_node data
        DB::table('polling_data_devices')->where('device_node_id', '=', $id)->delete();
        DB::table('polling_alarm_devices')->where('device_node_id', '=', $id)->delete();

        //delete data on  communications_data  first before delete device_node data
        DB::table('communication_data')->where('device_node_id', '=', $id)->delete();

        DeviceNode::destroy($id);

        return response('DELETED:' . $id, 200);
    }
}
