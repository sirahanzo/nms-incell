<?php

namespace App\Http\Controllers;

use App\Http\Models\DeviceList;
use App\Http\Models\DeviceNode;
use App\Http\Models\Parameters;
use App\Http\Requests\ParameterAlarmRequest;
use BladeView;
use DB;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Yajra\Datatables\Datatables;

class ParameterAlarmController extends Controller {


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return BladeView|bool|Factory|Response|View
     */
    public function index()
    {
        $data['device_list'] = DeviceList::all();
        $data['severities'] = DB::table('severities')->get();
        $data['notifications'] = DB::table('notification_type')->get();

        return view('nms_incell.management.parameter_alarm', $data);
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
     * @return JsonResponse|Response
     */
    public function store(ParameterAlarmRequest $request)
    {
        $new_trap = Parameters::create($request->except(['_token']));

        $device_id = $request->get('device_id');

        $device_node = DeviceNode::where('device_id', '=', $device_id)->get();

        if ($device_node->count() != 0) {
            //echo 'insert new polling data';
            foreach ($device_node as $new_data):


                $new_trap_object = [
                    'site_oid'       => $new_data->site_oid,
                    'device_node_id' => $new_data->id,
                    'parameter_id'   => $new_trap->id,
                    //'severity_id'    => $new_trap->severity_id,
                    'pack1'          => 0,
                    'pack2'          => 0,
                    'pack3'          => 0,
                    'pack4'          => 0,
                    'pack5'          => 0,
                    'pack6'          => 0,
                    'pack7'          => 0,
                    'pack8'          => 0,
                    'pack9'          => 0,
                    'pack10'         => 0,
                    'pack11'         => 0,
                    'pack12'         => 0,
                    'pack13'         => 0,
                    'pack14'         => 0,
                    'pack15'         => 0,

                ];
                DB::table('polling_alarm_devices')->insert($new_trap_object);


            endforeach;
        }

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
        //$device_list = DeviceList::with('snmp_object')->get();
        $device_list = Parameters::with(['device', 'severity'])
            ->where('group', '=', 'ALARM')
            ->get();

        return Datatables::of($device_list)
            ->addColumn('option', function ($device_list) {
                return '<button type="button" class="btn btn-info width-100 btn-outline btn-sm " onclick="edit(' . $device_list['id'] . ')" ><i class="fa fa-pencil"></i> EDIT </button>
         <button type="button" class="btn btn-danger width-100 btn-outline btn-sm " onclick="deleteData(' . $device_list['id'] . ')"><i class="fa fa-times"></i> DELETE </button>';
            })
            ->addColumn('notification_type', function ($device_list) {

                $type = [];
                switch ($device_list->notification_id) {
                    case 1:
                        $type = 'None';
                        break;
                    case 2:
                        $type = 'Email';
                        break;
                    case 3:
                        $type = 'SMS';
                        break;
                    case 4:
                        $type = 'WhatsApp';
                        break;

                }

                return $type;
            })
            ->rawColumns(['option', 'notification_type'])
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
        return Parameters::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse|Response
     */
    public function update(ParameterAlarmRequest $request, $id)
    {
        Parameters::find($id)->fill($request->all())->save();

        //DB::table('polling_alarm_devices')
        //    ->where('parameter_id', '=', $id)
        //    ->update([
        //        'severity_id' => $request->get('severity_id'),
        //    ]);


        return response()->json(['Updated!', 200]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ResponseFactory|Response|Response
     */
    public function destroy($id)
    {
        //TODO : create fuction delete on temporary_alarm and log_alarm
        Parameters::destroy($id);


        return response('DELETED:' . $id, 200);
    }
}
