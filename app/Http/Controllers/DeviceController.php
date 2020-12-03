<?php

namespace App\Http\Controllers;

use App\Http\Models\DeviceList;
use App\Http\Models\DeviceType;
use App\Http\Models\Manufacturer;
use App\Http\Requests\DeviceRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\Datatables\Datatables;

class DeviceController extends Controller {


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
        $data['manufacture'] = Manufacturer::all();
        $data['type'] = DeviceType::all();

        return view('nms_incell.management.device',$data);
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
    public function store(DeviceRequest $request)
    {
        DeviceList::create($request->except(['_token']));

        return response()->json(['Saved!', 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show()
    {
        $device_list = DeviceList::with(['manufacture', 'device_type'])->get();

        return Datatables::of($device_list)->addColumn('option', function ($device_list) {
            return '<button type="button" class="btn btn-info width-100 btn-outline btn-sm " onclick="edit(' . $device_list['id'] . ')" ><i class="fa fa-pencil"></i> EDIT </button>
         <button type="button" class="btn btn-danger width-100 btn-outline btn-sm " onclick="deleteData(' . $device_list['id'] . ')"><i class="fa fa-times"></i> DELETE </button>';
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
        return DeviceList::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(DeviceRequest $request, $id)
    {
        DeviceList::find($id)->fill($request->all())->save();

        return response()->json(['Updated!', 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        DeviceList::destroy($id);

        return response('DELETED:' . $id, 200);
    }
}
