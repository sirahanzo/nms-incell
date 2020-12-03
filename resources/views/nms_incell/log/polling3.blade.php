@extends('layouts.nms_master3')

@section('css')
    <link href="{{ asset('/') }}css/bootstrap-datepicker3.min.css" rel="stylesheet"/>

@endsection

@section('content')

    <div  class="panel panel-inverse m-t-10 show" data-sortable-id="ui-general-1">
        <div class="panel-heading">
            <div class="btn-group pull-left m-r-10" data-toggle="buttons">
                <button class="btn btn-info btn-xs" id="btn_show_table" onclick="show_table()">
                    <i class="fa fa-table"></i> Table
                </button>
                <button class="btn btn-default btn-xs " id="btn_show_chart" onclick="show_chart()">
                    <i class="fa fa-bar-chart"></i> Chart
                </button>
            </div>
            <div class="panel-heading-btn hide">
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title "> DATALOG MONITORING</h4>
        </div>
        <div class="panel-body">
            <div class="row border-bottom-1">
                <div class="col-md-12">
                    <legend class="pull-left width-full"><span id="site_name" class="site_name">SITE NAME</span></legend>

                    <table class="table table-bordered">

                        <thead>
                        <tr>
                            <th class="col-sm-1 text-center"><i class="fa fa-calendar"></i></th>
                            <th class="text-uppercase col-sm-2">Last updated at</th>
                            <th><span id="last_updated" class="last_updated">-</span></th>
                        </tr>
                        <tr>
                            <th class="col-sm-1 text-center"><i class="fa fa-flag"></i></th>
                            <th>SITE ID</th>
                            <th id="site_id"><span class="site_id_label" style="font-weight: bold">-</span></th>
                        </tr>
                        <tr>
                            <th class="col-sm-1 text-center"><i class="fa fa-archive"></i></th>
                            <th>Address</th>
                            <th id="site_address1"><a href="http://maps.google.com/?q=<LAT>,<LNG>" target="_blank" id="gmap_address" class="site_address">-</a></th>
                        </tr>
                        <tr>
                            <th class="col-sm-1 text-center"><i class="fa fa-map-marker"></i></th>

                            <th>GPS</th>
                            <th><a href="http://maps.google.com/?q=<LAT>,<LNG>" target="_blank" id="gmap_gps"><span id="site_latitude" class="site_latitude">0</span> , <span
                                            id="site_longitude" class="site_longitude">0</span></a></th>
                        </tr>
                        {{-- <tr>
                             <td class="text-uppercase">sim card 1</td>
                             <td > <span id="sim_card_number1" class="sim_card_number" style="font-weight: bold">-</span> </td>
                         </tr>
                         <tr>
                             <td class="text-uppercase">sim card 2</td>
                             <td > <span id="sim_card_number2" class="sim_card_number" style="font-weight: bold">-</span> </td>
                         </tr>--}}
                        </thead>
                    </table>
                </div>

            </div>

        </div>

        <div class="panel panel-default panel-with-tabs m-t-10" data-sortable-id="ui-unlimited-tabs-2">
            <div class="panel-heading p-0">
                <div class="panel-heading-btn m-r-10 m-t-10 hide">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-inverse" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <!-- begin nav-tabs -->
                <div class="tab-overflow overflow-right">
                    <ul class="nav nav-tabs" style="margin-left: 0px;" id="navTab">
                        <li class="prev-button" style=""><a href="javascript:;" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a>
                        </li>
                        @for ($i = 1; $i <= 15; $i++)
                            <li id="{{($i== 1)?'tabDefault':'tab_pack'.$i}}" class="{{ ($i == 1)?'active':'hide' }}" onclick="initDrawTablePack({{$i}})">
                                <a href="#nav-tab2-{{$i}}" data-toggle="tab" tab="pack{{$i}}">PACK {{$i}}</a>
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

                <form class="form-horizontal form-stripe" id="form_data">
                    {{csrf_field()}}
                    <input type="hidden" id="pack_id" name="pack_id" value="pack1">
                    <input type="hidden" id="site_oid" name="site_oid" value="site_oid">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Periode Time</label>
                                <div class="col-sm-9">
                                    <div class="input-daterange input-group" id="range-datepicker">
                                        <input type="text" class="input-sm form-control" name="from" id="from" placeholder="Start Date" value="Start Date"/>
                                        <span class="input-group-addon x-primary">to</span>
                                        <input type="text" class="input-sm form-control" name="to" id="to" placeholder="End Date" value="End Date"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            {{--<div class="btn-group btn-group-justified">
                                <a class="btn width-100 btn-default">Show Data</a>
                                <a class="btn width-100 btn-default" id="download">Download</a>
                                <a class="btn width-100 btn-default">Refresh Data</a>
                            </div>--}}
                            <section id="button_table" class="show">
                                <button class="btn btn-sm width-100 btn-white btn-outline " disabled="disabled" type="button" id="show_data_table" onclick="drawTableChart()">
                                    Show Table
                                </button>
                                <button class="btn btn-sm width-100 btn-white btn-outline " disabled="disabled" type="button" id="download">Download</button>
                                <button class="btn btn-sm width-100 btn-info btn-outline btn-loading" type="button" id="refresh" onclick="refreshTable()">Refresh Data
                                </button>
                            </section>
                            <section id="button_chart" class="hide">
                                <button class="btn btn-sm width-100 btn-white btn-outline " disabled="disabled" type="button" id="show_data_chart" onclick="drawTableChart()">
                                    Show Chart
                                </button>
{{--                                <button class="btn btn-sm width-100 btn-white btn-outline " disabled="disabled" type="button" id="download">Download</button>--}}
                                <button class="btn btn-sm width-100 btn-info btn-outline btn-loading" type="button" id="refresh_chart" onclick="refreshTable()">Refresh Data
                                </button>
                            </section>

                        </div>
                    </div>
                </form>
                <hr>
                @for ($i = 1; $i <= 15; $i++)
                    <div class="tab-pane fade {{ ($i ==1)?'active in':''  }}" id="nav-tab2-{{$i}}">

                        <section class="show" id="show_table_pack{{$i}}">
                            @include('nms_incell.log._table_poll_pack',['pack_id' => $i])
                        </section>

                        <section class="hide" id="show_chart_pack{{$i}}">
                            @include('nms_incell.log._chart',['pack_id' => $i])
                        </section>


                    </div>
                @endfor

            </div>
        </div>


    </div>
    <br>
    <br>


@endsection

@section('js')
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('/') }}js/echarts.min.js"></script>
    <script>

        localStorage.setItem('datalog','table');

        let datalog = localStorage.getItem('datalog');

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
            format: "yyyy-mm-dd",
            weekStart: 1,
            todayBtn: "linked",
            todayHighlight: true,
            autoclose: true
        });

        $("#from,#to").on("propertychange change keyup paste input", function () {
            // alert('form change');
            $("#show_data_table,#show_data_chart,#download").removeAttr('disabled');
            $("#show_data_table,#show_data_chart,#download").removeClass('btn-default').addClass('btn-info');

        });


        let url_log_data_show = "{{ route('log-data-show') }}";
        let url_log_data_pack = "{{ route('log-data-pack') }}";
        let url_log_data_chart = "{{ route('log-data-chart') }}"
        let url_log_data_chart_periode = "{{ route('log-data-chart-periode') }}"
        let url_log_data_pack_periode = "{{ route('log-data-pack-periode') }}";
        let url_log_data_download = "{{ route('log-data-download') }}"


        function initDrawTablePack(id) {

            $('#pack_id').val('pack' + id);
            console.log('on click draw new myTable_pack');

            // console.log('DATALOG:',localStorage.getItem('datalog'));


            if (localStorage.getItem('datalog') === 'table'){
                // drawPackTable(url_log_data_pack);
                show_table()
            }else {

                // drawPackChart(url_log_data_pack);
                show_chart()
            }
        }


        function getMonitoringSite(site_oid) {
            console.log("getMonitoringSite for alarm log: " + site_oid);

            $('#site_oid').val(site_oid);

            // let form = $('#form_data').serialize();

            // var id = $('#device_id').val();
            $("li[id^=tab_pack]").addClass('hide');


            $.ajax({
                url: url_log_data_show,
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
                        $('#pack_id').val('pack1');

                        $('[href="#nav-tab2-1"]').tab('show');

                        console.log('crate new myTable_' + $('#pack_id').val());
                        $('#myTable_' + $('#pack_id').val()).dataTable().fnDestroy();

                        var packTable = $('#myTable_' + $('#pack_id').val()).DataTable();
                        packTable.clear().draw();

                    } else {
                        console.log('show table pack');

                        $('.site_name').text(data.site.name);
                        $('#site_oid').val(data.site.oid);
                        $('#pack_id').val('pack1');
                        $('.site_address').text(data.site.address);
                        $('.site_longitude').text(data.site.longitude);
                        $('.site_latitude').text(data.site.latitude);
                        $('.last_updated').text(data.site.sn_pack.updated_at);
                        $('.site_id_label').text(data.site.site_id_label);

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

                        if (localStorage.getItem('datalog') === 'table'){
                            drawPackTable(url_log_data_pack);
                        }else {
                            drawPackChart(url_log_data_chart);
                        }

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

        // drawDeviceTable1(url,form);
        function drawPackTable(url) {

            let formRequest = $('#form_data').serialize();
            let packId = $('#pack_id').val();
            $('#myTable_' + packId).dataTable().fnDestroy();

            console.log('draw new table ');

            var packTable = $('#myTable_' + packId).DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
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
                                //try again
                                // $.ajax(this);
                                // refreshJsTree()
                                packTable.draw();

                            }
                        } else {
                            if (xhr.status === 500) {
                                //handle error
                                this.tryCount++;
                                if (this.tryCount <= this.retryLimit) {
                                    //try again
                                    // $.ajax(this);
                                    // refreshJsTree()
                                    packTable.draw();

                                }
                            }
                        }
                    }

                },
                columns: [
                    {data: 'updated_at', name: 'updated_at'},
                    // {data: 'value', name: 'value'},
                    {data: 'name', name: 'name'},
                    {data: 'value', name: 'value'},
                    {data: 'unit', name: 'unit'},
                ],

            });

            // packTable.draw();
            // devTable1.on('order.dt search.dt', function () {
            //     devTable1.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            //         cell.innerHTML = i + 1;
            //     });
            // }).draw();

            $('#from').val('Start Date');
            $('#to').val('End Date');
            $("#show_data_table,#show_data_chart,#download").attr('disabled', 'disabled');
            $("#show_data_table,#show_data_chart").addClass('btn-white').removeClass('btn-info');
            $("#download").addClass('btn-white').removeClass('btn-info');
        }

        function drawPackChart(url) {
            let formRequest = $('#form_data').serialize();
            let packId = $('#pack_id').val();

            // console.log('pack chart id :',packId);

            let tableChart = 'chart_pack' + packId

            let elementById = document.getElementById('chart_'+packId);
            var packChart = echarts.init(elementById);

            packChart.showLoading();

            $.ajax({
                url: url,
                data: formRequest,
                type: 'GET',
                dataType: "json",
                success: function (data) {
                    console.log('data chart:' , data);

                    // var SOC = data['soc'];
                    let legend_status = "\nStatus=1:Chg | 2:Dchg | 3:Ready | 4:Outage";
                    let rsize_legend = legend_status.fontsize(2);

                    let data_dummy = [0];

                    var SOC_dtime = (data['soc']).map(function (item) {
                        return item['updated_at'];
                    });


                    // var r_SOC_dtime = SOC_dtime.reverse();



                    var SOC = (data['soc']).map(function (item) {
                        try {
                            return item['value'];
                        } catch (err) {
                        }
                    });

                    console.log('DATA SOC :', data['soc']);


                    var VBatt = (data['vbatt']).map(function (item) {
                        try {
                            return item['value'];
                        } catch (err) {
                        }
                    });

                    var IBatt = (data['ibatt']).map(function (item) {
                        try {
                            return item['value'];
                        } catch (err) {
                        }
                    });

                    var BStatus = (data['batt_status']).map(function (item) {
                        try {

                            return item['value'];
                        } catch (err) {
                        }
                    });

                    console.log('BATTERY STATUS:',BStatus);

                    // let elementById = document.getElementById('chart_'+packId);
                    // var packChart = echarts.init(elementById);

                    // specify chart configuration item and data
                    option = {
                        title: {
                            text: 'Chart '+ packId.toUpperCase()+legend_status,
                            textStyle:{
                                fontSize:11
                            }
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'cross',
                                label: {
                                    backgroundColor: '#6a7985'
                                }
                            }
                        },
                        legend: {
                            // data: ['邮件营销', '联盟广告', '视频广告', '直接访问', '搜索引擎']
                            // data: ['SOC', 'VBatt', 'IBatt', 'Status','Other']
                            data: ['SOC', 'VBatt', 'IBatt','Status']
                        },
                        dataZoom: [
                            {
                                show: true,
                                realtime: true,
                                start: 75,
                                end: 100
                            },
                            {
                                type: 'inside',
                                realtime: true,
                                start: 65,
                                end: 85
                            }
                        ],
                        toolbox: {
                            feature: {
                                saveAsImage: {
                                    title: 'JPEG',
                                    type:'jpeg'
                                }
                            }
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '10%',
                            containLabel: true
                        },
                        xAxis: [
                            {
                                type: 'category',
                                boundaryGap: false,
                                data: SOC_dtime.map(function (str){
                                    return str.replace(' ', '\n');
                                }).reverse()
                            }
                        ],
                        yAxis: [
                            {
                                type: 'value'
                            }
                        ],
                        series: [
                            {
                                name: 'SOC',
                                type: 'line',
                                // stack: 'value',
                                // areaStyle: {},
                                data: SOC.reverse()
                            },
                            {
                                name: 'VBatt',
                                type: 'line',
                                // stack: 'value',
                                // areaStyle: {},
                                data: VBatt.reverse()
                            },
                            {
                                name: 'IBatt',
                                type: 'line',
                                // stack: 'value',
                                // areaStyle: {},
                                data: IBatt.reverse()
                            },
                            {
                                name: 'Status',
                                type: 'line',
                                // stack: 'value',
                                // areaStyle: {},
                                data: BStatus.reverse()
                            },
                            // {
                            //     name: 'IBatt',
                            //     type: 'line',
                            //     stack: 'sum',
                            //     label: {
                            //         normal: {
                            //             show: true,
                            //             position: 'top'
                            //         }
                            //     },
                            //     areaStyle: {},
                            //     data: IBatt
                            // }
                        ]
                    };


                    // use configuration item and data specified to show chart
                    packChart.setOption(option);

                    packChart.hideLoading();


                },
                error: function (err) {
                    console.log('error get data chart!');
                },
            })

        }


        function refreshTable() {
            console.log('refresh table');
            // drawPackTable(url_log_data_pack);
            if (localStorage.getItem('datalog') === 'table'){
                drawPackTable(url_log_data_pack);
            }else {

                drawPackChart(url_log_data_pack);
            }
        }

        function drawTableChart() {
            console.log("SHOW Click");
            //clear periode
            $('#form_data').trigger('reset');
            //reset show chart
            // $('#show_data_table').disabled(true);


            if (localStorage.getItem('datalog') === 'table'){
                drawPackTable(url_log_data_pack_periode);
            }else {
                drawPackChart(url_log_data_chart_periode);
            }
        }



        $('#download').click(function (e) {
            // var id = $('#device_id').val();
            let formRequest = $('#form_data').serialize();

            console.log("request ajax data in form" + formRequest);
            // $('#loading-text').html('loading');
            show_loading();
            $.ajax({
                url: url_log_data_download,
                data: formRequest,
                type: 'GET',
                //if success
                complete: function (res) {
                    hide_loading();
                    var path = res.responseJSON.path;
                    location.href = path;
                    // $('#form_data').trigger('reset');
                    $('#from').val('Start Date');
                    $('#to').val('End Date');
                    $("#show_data_chart,#show_data_table,#download").attr('disabled');
                    $("#show_data_chart,#show_data_table,#download").addClass('btn-default').removeClass('btn-info');

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

        function show_chart(){
            let packId = $('#pack_id').val();
            console.log('show chart :'+ packId+' , hide table');
            $('#show_chart_'+packId).addClass('show').removeClass('hide');
            $('#show_table_'+packId).addClass('hide').removeClass('show');

            $('#button_chart').removeClass('hide').addClass('show');
            $('#button_table').removeClass('show').addClass('hide');

            localStorage.setItem('datalog','chart');
            drawPackChart(url_log_data_chart);
        }

        function show_table(){
            let packId = $('#pack_id').val();
            console.log('show table:'+ packId+' , hide chart');
            $('#show_table_'+packId).addClass('show').removeClass('hide');
            $('#show_chart_'+packId).addClass('hide').removeClass('show');

            $('#button_chart').removeClass('show').addClass('hide');
            $('#button_table').removeClass('hide').addClass('show');

            localStorage.setItem('datalog','table');
            drawPackTable(url_log_data_pack);

        }


    </script>

@endsection