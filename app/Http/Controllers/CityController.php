<?php

namespace App\Http\Controllers;

use App\Http\Models\City;
use App\Http\Models\Region;
use App\Http\Requests\CityRequest;
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

class CityController extends Controller {


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
        $data['regions'] = Region::all();

        return view('nms_incell.management.city', $data);
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
     * @param CityRequest $request
     * @return JsonResponse
     */
    public function store(CityRequest $request)
    {
        $data = [
            'owner_id'   => Region::where('oid', '=', $request->get('region_oid'))->first()->owner_id,
            'region_oid' => $request->get('region_oid'),
            'oid'        => $request->get('oid'),
            'name'       => $request->get('name'),
            'icon'       => $request->get('icon'),
        ];

        City::create($data);

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
        $city = City::with('region')->get();

        return Datatables::of($city)->addColumn('option', function ($city) {
            return '<button type="button" class="btn btn-info width-100 btn-outline btn-sm " onclick="edit(' . $city['id'] . ')" ><i class="fa fa-pencil"></i> EDIT </button>
         <button type="button" class="btn btn-danger width-100 btn-outline btn-sm " onclick="deleteData(' . $city['id'] . ')"><i class="fa fa-times"></i> DELETE </button>';
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
        return City::findOrFail($id);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param CityRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CityRequest $request, $id)
    {
        City::find($id)->fill($request->except(['_token', 'oid']))->save();
        //TODO :create function update region_oid on site


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
        //$city_region_oid = City::where('id','=',$id)->first()->region_oid;
        //$site_city_oid = Site::where('region_oid','=',$city_region_oid )->first()->city_oid;
        //
        //DB::table('node_tree')->where('parent_oid','=',$site_city_oid)->delete();
        //DB::table('node_tree')->where('parent_oid','=',$city_region_oid)->delete();

        City::destroy($id);

        return response('DELETED!', 200);
    }
}
