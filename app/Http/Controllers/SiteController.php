<?php

namespace App\Http\Controllers;

use App\Http\Models\City;
use App\Http\Models\DeviceNode;
use App\Http\Models\Site;
use App\Http\Requests\SiteRequest;
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

class SiteController extends Controller {


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
        $data['sub_regions'] = City::all();

        return view('nms_incell.management.site', $data);
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
     * @return JsonResponse
     */
    public function store(SiteRequest $request)
    {
        $city = City::where('oid', '=', $request->get('city_oid'))->first();

        $data = [
            'owner_id'      => $city->owner_id,
            'region_oid'    => $city->region_oid,
            'city_oid'      => $request->get('city_oid'),
            'oid'           => '',
            'name'          => $request->get('name'),
            'site_id_label' => $request->get('site_id_label'),
            'address'       => $request->get('address'),
            'longitude'     => $request->get('longitude'),
            'latitude'      => $request->get('latitude'),
            'icon'          => $request->get('icon'),
            'total_pack'          => $request->get('total_pack'),
        ];

        Site::create($data);

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
        $site = Site::with('city')->get();

        return Datatables::of($site)->addColumn('option', function ($site) {
            return '<button type="button" class="btn btn-info width-100 btn-outline btn-sm " onclick="edit(' . $site['id'] . ')" ><i class="fa fa-pencil"></i> EDIT </button>
         <button type="button" class="btn btn-danger width-100 btn-outline btn-sm " onclick="deleteData(' . $site['id'] . ')"><i class="fa fa-times"></i> DELETE </button>';
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
        return Site::findOrFail($id);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param SiteRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(SiteRequest $request, $id)
    {
        //return  $request->all();
        Site::find($id)->fill($request->except(['_token', 'oid']))->save();

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
        $site = Site::findOrFail($id);

        $node = DeviceNode::where('site_oid', '=', $site->oid)->get();

        //TODO :detele temporary alarm
        //\DB::table('temporary_alarm')->where('site', '=', $site->name)->delete();
        //DB::table('temporary_alarm')->where('site_oid', '=', $site->oid)->delete();

        //TODO :delete on polling_data_device
        DB::table('polling_data_devices')->where('site_oid', '=', $site->oid)->delete();

        //TODO :delete commnunication_data
        foreach ($node as $item):
            DB::table('communications_data')->where('device_node_id', '=', $item->id)->delete();
        endforeach;

        //TODO :delete device_node
        //DeviceNode::where('site_oids','=',$site->oid)->delete();
        Site::destroy($id);


        return response('DELETED:' . $id, 200);
    }


}
