<?php

namespace App\Http\Controllers;

use App\Http\Models\City;
use App\Http\Models\Owner;
use App\Http\Models\Region;
use App\Http\Models\Site;
use App\Http\Requests\RegionRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Yajra\Datatables\Datatables;

class RegionController extends Controller {


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
        $data['owners'] = Owner::all();

        return view('nms_incell.management.region', $data);
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
     * @param RegionRequest $request
     * @return JsonResponse
     */
    public function store(RegionRequest $request)
    {
        Region::create($request->except(['_token']));

        return response()->json(['Saved!', 200]);
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function show()
    {
        $region = Region::with('owner')->get();

        return Datatables::of($region)->addColumn('option', function ($region) {
            return '<button type="button" class="btn btn-info width-100 btn-outline btn-sm " onclick="edit(' . $region['id'] . ')" ><i class="fa fa-pencil"></i> EDIT </button>
         <button type="button" class="btn btn-danger width-100 btn-outline btn-sm  " onclick="deleteData(' . $region['id'] . ')"><i class="fa fa-times"></i> DELETE </button>';
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
        return Region::findOrFail($id);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param RegionRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(RegionRequest $request, $id)
    {
        Region::find($id)->fill($request->except(['_token', 'oid']))->save();

        return response()->json(['Updated!', 200]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ResponseFactory|Response
     */
    public function destroy($id)
    {
        //delete tree from node_tree
        //$region_oid = Region::where('id', '=', $id)->first()->oid;

        //$city_oid = City::where('region_oid', '=', $region_oid)->get();

        //DB::table('node_tree')->where('parent_oid', '=', $region_oid)->delete();//ini betul delete parent_oid region

        //foreach ($city_oid as $city) {
        //    $site_oid = Site::where('city_oid', '=', $city->oid)->first()->city_oid;
        //}
        //

        Region::destroy($id);


        return response('DELETED:' . $id, 200);
    }
}
