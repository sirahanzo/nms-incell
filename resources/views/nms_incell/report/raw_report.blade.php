@extends('layouts.nms_master3')

@section('css')
    {{--note:(8/7/20), no use due to change to nms_master2 template--}}
    {{--    <link href="{{ asset('/') }}css/dataTables.bootstrap.min.css" rel="stylesheet"/>--}}
    {{--    <link href="{{ asset('/') }}css/responsive.bootstrap.min.css" rel="stylesheet"/>--}}
    {{--    <link href="{{ asset('/') }}css/bootstrap-select.css" rel="stylesheet"/>--}}

@endsection

@section('content')

    <!-- begin #content -->
    <div id="content" class="content">
{{--        <h1 class="page-header text-uppercase">{{ Request::segment(1) }}--}}
{{--        </h1>--}}
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                           data-click="panel-reload" id="btn_refresh"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                           data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Panel Title here</h4>
                </div>
                <div class="panel-body" id="monitoring_site">


                    <div id="user-list" class="panel-body">
                        <form class="form-inline"  method="POST" id="formRawRepor">

                            <div class="form-group m-r-10">
                                <label class="col-sm-12 control-label">Periode Time</label>

                            </div>
                            <div class="form-group m-r-10">
                                <select name="month" id="month" class="form-control">
                                    <option value=""> -- Select Month --</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                            <div class="form-group m-r-10">
                                <select name="year" id="year" class="form-control">
                                    <option value=""> -- Select Year --</option>
                                    @for($x=0 ;$x <=10;$x++)
                                        <option value="{{ 2020+$x }}" >{{ 2020+$x }}</option>
                                        @endfor
                                </select>
                            </div>

                            <button class="btn btn-sm width-100 btn-white btn-outline " disabled="disabled" type="button" id="show_data" onclick="showTable()">
                                Show Data
                            </button>
                            <button class="btn btn-sm width-100 btn-white btn-outline " disabled="disabled" type="button" id="download">Download</button>
                            <button class="btn btn-sm width-100 btn-info btn-outline btn-loading" type="button" id="refresh" onclick="refreshTable()">Refresh
                                Data
                            </button>
                        </form>
                        <br>

                        <table id="myTable" class="table table-striped table-bordered table-responsive" width="100%">
                            <thead>
                            <tr>

                                <th class=""> SIte Name</th>
                                <th class=""> Serial Number </th>
                                <th class=""> Sys State</th>
                                <th class=""> Start</th>
                                <th class=""> End</th>
                                <th class="">Duration</th>
                                <th class="">Avg Vbus</th>
                                <th class="">Avg Ibus</th>
                                <th class="">Best Pwr</th>
                                <th class="">Peak Pwr</th>
                                <th class="">SOC Start</th>
                                <th class="">SOC End</th>
                                <th class="">Max Ibus</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <!-- end #content -->

@endsection
@section('js')
    <script>
        getRawReport();
        $("#month,#year").on("propertychange change keyup paste input", function () {
            // alert('form change');
            $("#show_data,#download").removeAttr('disabled');
            $("#show_data,#download").removeClass('btn-default').addClass('btn-info');

        });

        function getRawReport() {
            // clearInterval(myInterval);
            // sec =60;//reset counter

            var oTable = $('#myTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: false,
                destroy: true,
                // ajax: url_manufature_show,
                ajax: {
                    url: '{{route('raw-report-show')}}',
                    type: 'GET',
                    dataType: 'json',
                    tryCount: 1,
                    retryLimit: 3,
                    error: function (xhr, textStatus, errorThrown) {
                        if (textStatus === 'timeout') {
                            this.tryCount++;
                            if (this.tryCount <= this.retryLimit) {
                                //try again
                                $.ajax(this);
                                // refreshJsTree()
                                oTable.draw();

                            }
                        } else {
                            if (xhr.status === 500) {
                                //handle error
                                this.tryCount++;
                                if (this.tryCount <= this.retryLimit) {
                                    //try again
                                    $.ajax(this);
                                    // refreshJsTree()
                                    oTable.draw();

                                }
                            }
                        }
                    }

                },
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'site_name', name: 'site_name'},
                    {data: 'serial_number', name: 'serial_number'},
                    {data: 'sys_state', name: 'sys_state'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'duration_hour', name: 'duration_hour'},
                    {data: 'avg_bus_voltage', name: 'avg_bus_voltage'},
                    {data: 'avg_bus_current', name: 'avg_bus_current'},
                    {data: 'best_power', name: 'best_power'},
                    {data: 'peak_power', name: 'peak_power'},
                    {data: 'soc_start', name: 'soc_start'},
                    {data: 'soc_end', name: 'soc_end'},
                    {data: 'max_bus_current', name: 'max_bus_current'},

                ],

            });

            // myInterval = setInterval(scheduledMonitoring, 1000);

        }

        function refreshTable() {
            console.log('refresh table');
            getRawReport();
            $('#formRawRepor').trigger('reset');
            $("#show_data,#download").attr('disabled', 'disabled');
            $("#show_data").addClass('btn-white').removeClass('btn-info');
            $("#download").addClass('btn-white').removeClass('btn-info');
        }

        function showTable() {
            console.log("SHOW Click");
            // drawPackTable(url_raw_report_pack_periode);

        }


    </script>
@endsection