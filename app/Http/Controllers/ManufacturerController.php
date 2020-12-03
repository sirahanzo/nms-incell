<?php

namespace App\Http\Controllers;

use App\Http\Models\Manufacturer;
use App\Http\Requests\ManufaturerRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ManufacturerController extends Controller {


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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('nms_incell.management.manufacturer');

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ManufaturerRequest $request)
    {
        Manufacturer::create($request->except(['_token']));

        return response()->json(['Saved!', 200]);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //$manufacture= DB::table('manufacturers')->get()->all();
        $manufacture = Manufacturer::all();

        return Datatables::of($manufacture)
            ->addColumn('option', function ($manufacture) {
                return '<button type="button" class="btn btn-info width-100 btn-outline btn-sm " onclick="edit(' . $manufacture['id'] . ')" ><i class="fa fa-pencil"></i> EDIT </button>
         <button type="button" class="btn btn-danger width-100 btn-outline btn-sm " onclick="deleteData(' . $manufacture['id'] . ')"><i class="fa fa-times"></i> DELETE </button>';
            })
            ->rawColumns(['option'])
            ->make(true);


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Manufacturer::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(ManufaturerRequest $request, $id)
    {
        Manufacturer::find($id)->fill($request->all())->save();

        return response()->json(['Updated!', 200]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        Manufacturer::destroy($id);

        return response('DELETED:' . $id, 200);
    }
}
