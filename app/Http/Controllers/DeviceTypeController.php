<?php

namespace App\Http\Controllers;

use App\Http\Models\DeviceList;
use App\Http\Models\DeviceType;
use App\Http\Requests\DeviceTypeRequest;
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

class DeviceTypeController extends Controller {


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
        return view('nms_incell.management.device_type');
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(DeviceTypeRequest $request)
    {
        DeviceType::create($request->except(['_token']));

        return response()->json(['Saved!', 200]);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws Exception
     */
    public function show()
    {
        $device_type = DeviceType::all();

        return Datatables::of($device_type)->addColumn('option', function ($device_type) {
            return '<button type="button" class="btn btn-info width-100 btn-outline btn-sm " onclick="edit(' . $device_type['id'] . ')" ><i class="fa fa-pencil"></i> EDIT </button>
         <button type="button" class="btn btn-danger width-100 btn-outline btn-sm " onclick="deleteData(' . $device_type['id'] . ')"><i class="fa fa-times"></i> DELETE </button>';
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
        return DeviceType::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(DeviceTypeRequest $request, $id)
    {
        DeviceType::find($id)->fill($request->all())->save();

        return response()->json(['Updated!', 200]);
    }


    /**
     * Remove the specified resource from storage.
     * Before delete `device_type` wee need to delete relation data on `devices` table first
     *
     * @param int $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function destroy($id)
    {
        DeviceList::where('device_type_id', '=', $id)->delete();

        DeviceType::destroy($id);

        return response('DELETED:' . $id, 200);
    }
}
