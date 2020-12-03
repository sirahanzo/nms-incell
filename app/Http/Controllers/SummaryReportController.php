<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class SummaryReportController extends Controller {


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nms_incell.report.summary_report');
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
        $daily_report = DB::table('daily_availability')
            ->leftJoin('sites', 'daily_availability.site_oid', '=', 'sites.oid')
            ->leftJoin('regions', 'daily_availability.region_oid', '=', 'regions.oid')
            ->select(DB::raw('d1+d2+d3+d4+d5+d6+d7+d8+d9+d10+d11+d12+d13+d14+d15+d16+d17+d18+d19+d20+d21+d22+d23+d24+d25+d26+d27+d28+d29+d30+d31 as value,
            sites.name as site_name, regions.name as region_name , month_of_data,year_of_data,sites.site_id_label as site_id'))
            ->get();

        return Datatables::of($daily_report)
            ->addColumn('avg', function ($daily_report) {

                $date = date_parse($daily_report->month_of_data);//conver from name month to number of month

                $day = cal_days_in_month(CAL_GREGORIAN, $date['month'], $daily_report->year_of_data); //find how many day in  month_of at year_of

                return number_format(($daily_report->value / $day),2) .'%';

            })
            ->make(true);
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
}
