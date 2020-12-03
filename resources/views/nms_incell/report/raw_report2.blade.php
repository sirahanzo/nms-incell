@extends('layouts.nms_master3')

@section('css')
    <link href="{{ asset('/') }}css/bootstrap-datepicker3.min.css" rel="stylesheet"/>

@endsection

@section('content')
    <div class="panel panel-default panel-with-tabs m-t-10" data-sortable-id="ui-unlimited-tabs-2">
        <table id="table_1" class="table table-striped table-bordered" width="100%">
            <thead>
            <tr>
                <th class="col-sm-1 text-center"><i class="fa fa-flag"></i></th>
                <th class="col-sm-1">SITE NAME</th>
                <th colspan="5"><span class="site_name">SITE NAME</span></th>

            </tr>

            <tr>
                <th class="col-sm-1 text-center"><i class="fa fa-archive"></i></th>
                <th>ADDRESS</th>
                <th colspan="5"><a href="http://maps.google.com/?q=<LAT>,<LNG>" target="_blank" id="gmap_address" class="site_address">-</a></th>
            </tr>
            <tr>
                <th class="col-sm-1 text-center"><i class="fa fa-map-marker"></i></th>
                <th>GPS</th>
                <th colspan="5"><a href="http://maps.google.com/?q=<LAT>,<LNG>" target="_blank" id="gmap_gps"><span id="site_latitude"
                                                                                                                    class="site_latitude">0</span> , <span
                                id="site_longitude" class="site_longitude">0</span></a>
                </th>
            </tr>
            @for ($i = 1; $i <= 15; $i++)
                <tr id="tr_pack{{ $i }}"  class="{{ ($i == 1)?'show-tr':'hide' }}">
                    <th class="col-sm-1 text-center"><i class="fa fa-battery-3"></i></th>
                    <th>BATTERY ID</th>
                    <th><span id="batt_id{{$i}}">battery id here</span></th>
                    <th class="col-sm-1">BATTERY SN</th>
                    <th><span id="sn{{$i}}">battery serial number here</span></th>
                </tr>
            @endfor

            </thead>

        </table>
        <div class="panel-heading p-0">
            <div class="panel-heading-btn m-r-10 m-t-10">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-inverse" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <!-- begin nav-tabs -->
            <div class="tab-overflow overflow-right">
                <ul class="nav nav-tabs" style="margin-left: 0px;" id="navTab">
                    <li class="prev-button" style=""><a href="javascript:;" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a>
                    </li>
                    @for ($i = 1; $i <= 15; $i++)
                        <li id="{{($i== 1)?'tabDefault':'tab_pack'.$i}}" class="{{ ($i == 1)?'active':'hide' }}" onclick="initDrawTablePack({{$i}})">
                            <a href="#nav-tab2-{{$i}}" data-toggle="tab" tab="pack{{$i}}">Pack{{$i}}</a>
                        </li>
                    @endfor
                    {{--this is for only dummy--}}
                    {{--                        <li id="li_" class="show1 disabled"  onclick="initDeviceId()"><a href="#tab_" data-toggle="tab"--}}
                    {{--                                                                                                                 aria-expanded="false"><strong--}}
                    {{--                                        class="h5 text-uppercase"></strong></a></li>--}}
                    {{--                    <li class=""><a href="#rectifier" data-toggle="tab" aria-expanded="false"><strong class="h4 text-uppercase">rectifier</strong></a></li>--}}
                    {{--                    <li class=""><a href="#bms" data-toggle="tab" aria-expanded="false"><strong class="h4 text-uppercase">sinelith-50a</strong></a></li>--}}
                    {{--                    <li class=""><a href="#gkf" data-toggle="tab" aria-expanded="true"><strong class="h4 text-uppercase">gkf-ex4</strong></a></li>--}}

                    <li class="next-button" style=""><a href="javascript:;" data-click="next-tab" class="text-inverse"><i class="fa fa-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <br>
            {{--<form class="form-inline"  method="POST" id="formRawRepor">
                {{csrf_field()}}
                <input type="hidden" id="pack_id" name="pack_id" value="pack1">
                <input type="hidden" id="site_oid" name="site_oid" value="site_oid">

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
            </form>--}}

            <form class="form-horizontal form-stripe" id="form_data">
                {{csrf_field()}}
                <input type="hidden" id="pack_id" name="pack_id" value="1">
                <input type="hidden" id="site_oid" name="site_oid" value="site_oid">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Periode Time</label>
                            <div class="col-sm-6">
                                <div class="input-daterange input-group" id="range-datepicker">
                                    <input type="text" class="input-sm form-control" name="from" id="from" placeholder="Start Date" value="Select Time"/>
                                    {{--                                    <span class="input-group-addon x-primary">to</span>--}}
                                    {{--                                    <input type="text" class="input-sm form-control" name="to" id="to" placeholder="End Date" value="End Date"/>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-sm width-100 btn-white btn-outline " disabled="disabled" type="button" id="show_data" onclick="showTable()">
                            Show Data
                        </button>
                        <button class="btn btn-sm width-100 btn-white btn-outline " disabled="disabled" type="button" id="download">Download</button>
                        <button class="btn btn-sm width-100 btn-info btn-outline btn-loading" type="button" id="refresh" onclick="refreshTable()">Refresh Data
                        </button>
                    </div>
                </div>
            </form>

            <hr>
            @for ($i = 1; $i <= 15; $i++)
                <div class="tab-pane fade {{ ($i ==1)?'active in':''  }}" id="nav-tab2-{{$i}}">

                    @include('nms_incell.report._table_raw_availability_pack',['pack_id' => $i])

                </div>
            @endfor

        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>
    <script>

        // $('#from').datepicker( {
        //     format: "mm/yyyy",
        //     startView: 1,
        //     minViewMode: 1
        // });


        function show_loading() {
            swal({
                type: 'info',
                title: 'Loading...',
                allowOutsideClick: false

            });
            swal.showLoading()
        };

        function hide_loading() {
            swal.close()
        };


        $("#from,#to").datepicker({
            format: "MM-yyyy",
            // weekStart: 1,
            startView: 1,
            minViewMode: 1,
            todayBtn: "linked",
            todayHighlight: true,
            autoclose: true
        });

        $("#from,#to").on("propertychange change keyup paste input", function () {
            // alert('form change');
            $("#show_data,#download").removeAttr('disabled');
            $("#show_data,#download").removeClass('btn-default').addClass('btn-info');

        });


        let url_raw_report_show = "{{ route('raw-report-show') }}";
        let url_raw_report_pack = "{{ route('raw-report-pack') }}";
        let url_raw_report_pack_periode = "{{ route('raw-report-periode') }}";
        let url_raw_report_download = "{{ route('raw-report-download') }}"


        function initDrawTablePack(id) {

            // $('#pack_id').val('pack' + id);
            $('#pack_id').val(id);

            console.log('on click draw new myTable_pack');

            $("tr[id^=tr_pack]").removeClass('show-tr').addClass('hide');
            $('#tr_pack'+id).removeClass('hide').addClass('show-tr');

            drawPackTable(url_raw_report_pack);
        }


        function getMonitoringSite(site_oid) {
            console.log("getMonitoringSite for alarm log: " + site_oid);

            $('#site_oid').val(site_oid);

            // let form = $('#form_data').serialize();

            // var id = $('#device_id').val();
            $("li[id^=tab_pack]").addClass('hide');


            $.ajax({
                url: url_raw_report_show,
                data: {'site_oid': site_oid},
                type: "GET",
                success: function (data) {
                    // console.log('validasi_site', data);
                    if (data === "NOT VALID SITE") {
                        console.log('not valid site');

                        $('.site_name').text('Not Valid Site');
                        $('.site_address').text('-');
                        $('.site_longitude').text('0');
                        $('.site_latitude').text('0');
                        $('[id^=tab_pack]').addClass('hide').removeClass('show');
                        // $('#pack_id').val('pack1');
                        $('#pack_id').val('1');

                        $('[href="#nav-tab2-1"]').tab('show');

                        console.log('crate new myTable_' + $('#pack_id').val());
                        $('#myTable_' + $('#pack_id').val()).dataTable().fnDestroy();

                        var packTable = $('#myTable_' + $('#pack_id').val()).DataTable();
                        packTable.clear().draw();

                    } else {
                        console.log('show table pack');

                        $('.site_name').text(data.site.name);
                        $('#site_oid').val(data.site.oid);
                        $('#pack_id').val('1');
                        $('.site_address').text(data.site.address);
                        $('.site_longitude').text(data.site.longitude);
                        $('.site_latitude').text(data.site.latitude);
                        $('.last_updated').text(data.site.sn_pack.updated_at);
                        $('#gmap_address,#gmap_gps').attr("href", "http://maps.google.com/?q=" + data.site.latitude + "," + data.site.longitude);

                        var total_pack = data.site.total_pack;
                        console.log('total pack:', total_pack);

                        console.log('show Total Pack on Nav Tabs');
                        for (var i = 2; i <= total_pack; i++) {
                            // console.log('sho tab : ',i);
                            $('#tab_pack' + i).removeClass('hide');

                        }

                        console.log('Set tabDefault (tab_pack1) as active tab ');
                        $('[href="#nav-tab2-1"]').tab('show');

                        console.log('set pack_id on value input');
                        let packId = $('#pack_id').val();

                        console.log('call draw myTable_' + packId);

                        //for serial+batt_id
                       for (var i = 1; i < 16; i++) {
                            const pack = 'sn'+i;
                            const batt_id = 'batt_id'+i;
                            $('#sn'+i).text(data.site.sn_pack[pack]);
                            $('#batt_id'+i).text(data.site.sn_pack[batt_id]);
                        }

                        drawPackTable(url_raw_report_pack);

                    }
                },
                tryCount: 1,
                retryLimit: 3,
                error: function (xhr, textStatus, errorThrown) {
                    if (textStatus === 'timeout') {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            //try again
                            $.ajax(this);

                        }
                    } else {
                        if (xhr.status === 500) {
                            //handle error
                            this.tryCount++;
                            if (this.tryCount <= this.retryLimit) {
                                //try again
                                $.ajax(this);
                            }
                        }
                    }
                }

            });

        }

        function drawPackTable(url) {

            let formRequest = $('#form_data').serialize();
            let packId = $('#pack_id').val();
            $('#myTable_pack'+packId).dataTable().fnDestroy();

            console.log('draw new table ');

            var packTable = $('#myTable_pack'+packId).DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                "order": [[ 2, "asc" ]],
                // destroy:true,
                // ajax: url_manufature_show,
                ajax: {
                    url: url + '?' + formRequest,
                    type: 'GET',
                    dataType: 'json',
                    // data:formRequest,
                    tryCount: 1,
                    retryLimit: 3,
                    error: function (xhr, textStatus, errorThrown) {
                        if (textStatus === 'timeout') {
                            this.tryCount++;
                            if (this.tryCount <= this.retryLimit) {
                                packTable.draw();

                            }
                        } else {
                            if (xhr.status === 500) {
                                //handle error
                                this.tryCount++;
                                if (this.tryCount <= this.retryLimit) {
                                    packTable.draw();
                                }
                            }
                        }
                    }

                },
                columns: [
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

            packTable.draw();

            $('#from').val('Start Date');
            $('#to').val('End Date');
            $("#show_data,#download").attr('disabled', 'disabled');
            $("#show_data").addClass('btn-white').removeClass('btn-info');
            $("#download").addClass('btn-white').removeClass('btn-info');
        }


        function refreshTable() {
            console.log('refresh table');
            drawPackTable(url_raw_report_pack);
        }

        function showTable() {
            console.log("SHOW Click");
            drawPackTable(url_raw_report_pack_periode);
        }


        $('#download').click(function (e) {
            // var id = $('#device_id').val();
            let formRequest = $('#form_data').serialize();

            console.log("request ajax data in form" + formRequest);
            // $('#loading-text').html('loading');
            show_loading();
            $.ajax({
                url: url_raw_report_download,
                data: formRequest,
                type: 'GET',
                //if success
                complete: function (res) {
                    hide_loading();
                    // console.log('location path download:'+res.responseJSON);
                    var path = res.responseJSON.path;
                    location.href = path;
                    // $('#form_data').trigger('reset');
                    $('#from').val('Start Date');
                    $('#to').val('End Date');
                    $("#show_data,#download").attr('disabled');
                    $("#show_data,#download").addClass('btn-default').removeClass('btn-info');

                    // console.log(path);
                },
                //if error
                error: function (jqXhr) {
                    var errorHtml = '';
                    hide_loading();
                    $.each(jqXhr.responseJSON, function (index, value) {
                        errorHtml += '<div class="text-left col-sm-offset-1"><li>' + value + '</li></div>';

                    });
                    swal({
                        title: "Error!",
                        html: errorHtml,
                        type: 'error'
                    });
                }

            });

            e.preventDefault();

        });


    </script>

@endsection