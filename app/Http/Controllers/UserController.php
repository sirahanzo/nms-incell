<?php

namespace App\Http\Controllers;

use App\Http\Models\Owner;
use App\Http\Requests\UserRequest;
use App\User;
use Auth;
use DB;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\Datatables\Datatables;

class UserController extends Controller {


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
        $data['roles'] = DB::table('roles')->get();
        $data['owners'] = Owner::all();
        $data['notifications'] = DB::table('notification_type')->get();

        $user_credential = Auth::getUser()->region_oid;

        if ($user_credential == 'admin') {

            $data['regions'] = DB::table('regions')->where('owner_id', '=', Auth::getUser()->owner_id)->get();

        } else {

            $data['regions'] = DB::table('regions')
                ->where('owner_id', '=', Auth::getUser()->owner_id)
                ->where('oid', '=', $user_credential)
                ->get();

        }


        return view('nms_incell.management.user_management', $data);
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
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request)
    {

        User::create($request->except(['_token']));

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
        $user_credential = Auth::getUser()->region_oid;

        if ($user_credential == 'admin') {

            $userlist = User::all()->except([1, 2]);

            return Datatables::of($userlist)
                ->addColumn('option', function ($city) {
                    return '<button type="button" class="btn btn-info width-100 btn-outline btn-sm " onclick="edit(' . $city['id'] . ')" ><i class="fa fa-pencil"></i> EDIT </button>
         <button type="button" class="btn btn-danger width-100 btn-outline btn-sm " onclick="deleteData(' . $city['id'] . ')"><i class="fa fa-times"></i> DELETE </button>';
                })
                ->rawColumns(['option'])
                ->make(true);

        } else {

            $userlist = User::where('region_oid', '=', $user_credential)->get();

        }

        return Datatables::of($userlist)
            ->addColumn('option', function ($city) {
                return '<button type="button" class="btn btn-info width-100 btn-outline btn-sm " onclick="edit(' . $city['id'] . ')" ><i class="fa fa-pencil"></i> EDIT </button>';
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
        return User::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        User::find($id)->fill($request->except(['_token', 'oid']))->save();

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

        if (User::find($id)->username != 'admin' || User::find($id)->username != 'superadmin') {
            return response('NOT AUTHORIZED', 500);
        }

        //User::destroy($id);

        return response('DELETED:', 200);
    }
}
