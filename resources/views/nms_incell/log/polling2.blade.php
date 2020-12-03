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
                <th  class="col-sm-1">SITE NAME</th>
                <th colspan="5"> <span class="site_name">SITE NAME</span></th>

            </tr>

            <tr>
                <th class="col-sm-1 text-center"><i class="fa fa-archive"></i></th>
                <th>ADDRESS</th>
                <th colspan="5"><a href="http://maps.google.com/?q=<LAT>,<LNG>" target="_blank" id="gmap_address" class="site_address">-</a></th>
            </tr>
            <tr>
                <th class="col-sm-1 text-center"><i class="fa fa-map-marker"></i></th>
                <th>GPS </th>
                <th colspan="5"><a href="http://maps.google.com/?q=<LAT>,<LNG>" target="_blank" id="gmap_gps"><span id="site_latitude" class="site_latitude">0</span> , <span
                                id="site_longitude" class="site_longitude">0</span></a>
                </th>
            </tr>
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
                        <li id="{{($i== 1)?'tabDefault':'tab_pack'.$i}}" class="{{ ($i == 1)?'active':'hide' }}" onclick="initDrawTablePack({{$i}})" >
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

                    @include('nms_incell.log._table_poll_pack',['pack_id' => $i])

                </div>
            @endfor

        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>
    <script>

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
            $("#show_data,#download").removeAttr('disabled');
            $("#show_data,#download").removeClass('btn-default').addClass('btn-info');

        });



        let url_log_data_show="{{ route('log-data-show') }}";
        let url_log_data_pack ="{{ route('log-data-pack') }}";
        let url_log_data_pack_periode ="{{ route('log-data-pack-periode') }}";
        let url_log_data_download ="{{ route('log-data-download') }}"


        function initDrawTablePack(id) {

            $('#pack_id').val('pack'+id);
            console.log('on click draw new myTable_pack');
            drawPackTable(url_log_data_pack);
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
                    if(data === "NOT VALID SITE"){
                        console.log('not valid site');

                        $('.site_name').text('Not Valid Site');
                        $('.site_address').text('-');
                        $('.site_longitude').text('0');
                        $('.site_latitude').text('0');
                        $('[id^=tab_pack]').addClass('hide').removeClass('show');
                        $('#pack_id').val('pack1');

                        $('[href="#nav-tab2-1"]').tab('show');

                        console.log('crate new myTable_'+$('#pack_id').val());
                        $('#myTable_'+$('#pack_id').val()).dataTable().fnDestroy();

                        var packTable = $('#myTable_'+$('#pack_id').val()).DataTable();
                        packTable.clear().draw();

                    }else{
                        console.log('show table pack');

                        $('.site_name').text(data.site.name);
                        $('#site_oid').val(data.site.oid);
                        $('#pack_id').val('pack1');
                        $('.site_address').text(data.site.address);
                        $('.site_longitude').text(data.site.longitude);
                        $('.site_latitude').text(data.site.latitude);
                        $('.last_updated').text(data.site.sn_pack.updated_at);
                        $('#gmap_address,#gmap_gps').attr("href","http://maps.google.com/?q="+data.site.latitude+","+data.site.longitude);

                        var total_pack = data.site.total_pack;
                        console.log('total pack:',total_pack);

                        console.log('show Total Pack on Nav Tabs');
                        for (var i = 2; i <= total_pack; i++) {
                            // console.log('sho tab : ',i);
                            $('#tab_pack'+i).removeClass('hide');

                        }

                        console.log('Set tabDefault (tab_pack1) as active tab ');
                        $('[href="#nav-tab2-1"]').tab('show');

                        console.log('set pack_id on value input');
                        let packId = $('#pack_id').val();

                        console.log('call draw myTable_'+packId);
                        drawPackTable(url_log_data_pack);

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
            $('#myTable_'+packId).dataTable().fnDestroy();

            console.log('draw new table ');

            var packTable = $('#myTable_'+packId).DataTable({
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
            $("#show_data,#download").attr('disabled', 'disabled');
            $("#show_data").addClass('btn-white').removeClass('btn-info');
            $("#download").addClass('btn-white').removeClass('btn-info');
        }



        function refreshTable() {
            console.log('refresh table');
            drawPackTable(url_log_data_pack);
        }

        function showTable() {
            console.log("SHOW Click");
            drawPackTable(url_log_data_pack_periode);
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