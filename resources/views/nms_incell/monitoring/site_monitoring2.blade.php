@extends('layouts.nms_master3')

@section('css')
    <style>
        .ACTIVE{
            color: red;
            font-weight: 900;
            -webkit-animation-name: blinker;
            -webkit-animation-duration: 1s;
            -webkit-animation-timing-function: linear;
            -webkit-animation-iteration-count: infinite;

            -moz-animation-name: blinker;
            -moz-animation-duration: 1s;
            -moz-animation-timing-function: linear;
            -moz-animation-iteration-count: infinite;

            animation-name: blinker;
            animation-duration: 1s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }
        .DI-IN-ACTIVE{
            color: forestgreen;
            /*display: none;*/
        }
        .IN-ACTIVE{
            color: forestgreen;
            display: none;
        }
        @-moz-keyframes blinker {
            0% { opacity: 1.0; }
            50% { opacity: 0.0; }
            100% { opacity: 9.0; }
        }

        @-webkit-keyframes blinker {
            0% { opacity: 1.0; }
            50% { opacity: 0.0; }
            100% { opacity: 9.0; }
        }

        @keyframes blinker {
            0% { opacity: 1.0; }
            50% { opacity: 0.0; }
            100% { opacity: 9.0; }
        }

    </style>
@endsection

@section('content')

    <section id="valid_site" class="show">
        <div class="panel panel-inverse m-t-10" data-sortable-id="ui-general-1">
            <div class="panel-heading">
                <div class="panel-heading-btn hide">
                    <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">MONITORING DATA</h4>
            </div>
            <div class="panel-body">
                <div class="row border-bottom-1">
                    <div class="col-md-8">
                        <legend class="pull-left width-full"><span id="site_name" class="site_name" >SITE NAME</span></legend>

                        <table class="table table-bordered">

                            <thead>
                            <tr>
                                <th class="col-sm-1 text-center"><i class="fa fa-calendar"></i></th>
                                <th class="text-uppercase col-sm-3">Last updated at</th>
                                <th > <span id="last_updated" class="last_updated">-</span> </th>
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
                    <div class="col-md-4">

                        {{--                        <legend class="pull-left width-full "  >LAST UPDATED AT:    <span id="last_updated" class="last_updated">-</span> </legend>--}}
                        {{--                        <legend class="pull-left width-full "  >  External Alarm    </legend>--}}


                        <div class="col-md-12 m-t-55">
                            <table class="table table-bordered">

                                <tbody>
                                <tr>
                                    <td>DIGITAL INPUT 1</td>
                                    <td><span id="di1" class="DI-IN-ACTIVE">IN-ACTIVE</span></td>
                                </tr>
                                <tr>
                                    <td>DIGITAL INPUT 2</td>
                                    <td><span id="di2" class="DI-IN-ACTIVE">IN-ACTIVE</span></td>
                                </tr>
                                <tr>
                                    <td>DIGITAL INPUT 3</td>
                                    <td><span id="di3" class="DI-IN-ACTIVE">IN-ACTIVE</span></td>
                                </tr>
                                <tr>
                                    <td>DIGITAL INPUT 4</td>
                                    <td><span id="di4" class="DI-IN-ACTIVE">IN-ACTIVE</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 hide">
                            {{--                            <legend class="pull-left width-full"><span>&nbsp;</span></legend>--}}

                            <table class="table table-bordered">

                                <tbody>
                                <tr>
                                    <td>DIGITAL INPUT 3</td>
                                    <td><span id="di3" class="DI-IN-ACTIVE">IN-ACTIVE</span></td>
                                </tr>
                                <tr>
                                    <td>DIGITAL INPUT 4</td>
                                    <td><span id="di4" class="DI-IN-ACTIVE">IN-ACTIVE</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

            <div class="panel panel-default panel-with-tabs bor " data-sortable-id="ui-unlimited-tabs-2" >
                <div class="panel-heading p-0">
                    <div class="panel-heading-btn m-r-10 m-t-10 hide">
                        <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-inverse" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    </div>
                    <!-- begin nav-tabs -->
                    <div class="tab-overflow overflow-right" >
                        <ul class="nav nav-tabs" style="margin-left: 0px;" id="list_tab_pack">
                            <li class="prev-button" style=""><a href="javascript:" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a>
                            </li>
                            {{--                                <li id="" ><a  data-toggle="tab" aria-expanded="true">&nbsp;</a></li>--}}
                            <li id="default_tab" class="active"><a href="#nav-tab2-1" data-toggle="tab" aria-expanded="true">PACK 1</a></li>
                            <li id="tab_pack2" class="hide"><a href="#nav-tab2-2" data-toggle="tab">PACK 2</a></li>
                            <li id="tab_pack3" class="hide"><a href="#nav-tab2-3" data-toggle="tab">PACK 3</a></li>
                            <li id="tab_pack4" class="hide"><a href="#nav-tab2-4" data-toggle="tab">PACK 4</a></li>
                            <li id="tab_pack5" class="hide"><a href="#nav-tab2-5" data-toggle="tab">PACK 5</a></li>
                            <li id="tab_pack6" class="hide"><a href="#nav-tab2-6" data-toggle="tab">PACK 6</a></li>
                            <li id="tab_pack7" class="hide"><a href="#nav-tab2-7" data-toggle="tab">PACK 7</a></li>
                            <li id="tab_pack8" class="hide"><a href="#nav-tab2-8" data-toggle="tab" aria-expanded="false">PACK 8</a></li>
                            {{--                                <li id="tab_pack8" class="hide"><a href="#nav-tab2-8" data-toggle="tab" >PACK 8</a></li>--}}
                            <li id="tab_pack9" class="hide"><a href="#nav-tab2-9" data-toggle="tab"  >PACK 9</a></li>
                            <li id="tab_pack10" class="hide"><a href="#nav-tab2-10" data-toggle="tab">PACK 10</a></li>
                            <li id="tab_pack11" class="hide"><a href="#nav-tab2-11" data-toggle="tab">PACK 11</a></li>
                            <li id="tab_pack12" class="hide"><a href="#nav-tab2-12" data-toggle="tab">PACK 12</a></li>
                            <li id="tab_pack13" class="hide"><a href="#nav-tab2-13" data-toggle="tab">PACK 13</a></li>
                            <li id="tab_pack14" class="hide"><a href="#nav-tab2-14" data-toggle="tab">PACK 14</a></li>
                            <li id="tab_pack15" class="hide"><a href="#nav-tab2-15" data-toggle="tab">PACK 15</a></li>
                            {{--                    <li class=""><a href="#nav-tab2-11" data-toggle="tab">PACK 16</a></li>--}}
                            {{--                    <li class=""><a href="#nav-tab2-17" data-toggle="tab">PACK 17</a></li>--}}
                            {{--                    <li class=""><a href="#nav-tab2-18" data-toggle="tab">PACK 18</a></li>--}}
                            {{--                    <li class=""><a href="#nav-tab2-19" data-toggle="tab">PACK 19</a></li>--}}
                            {{--                    <li class=""><a href="#nav-tab2-20" data-toggle="tab">PACK 20</a></li>--}}
                            <li class="next-button" style=""><a href="javascript:" data-click="next-tab" class="text-inverse"><i class="fa fa-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="nav-tab2-1">

                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 1])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-2">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 2])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-3">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 3])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-4">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 4])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-5">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 5])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-6">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 6])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-7">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 7])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-8">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 8])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-9">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 9])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-10">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 10])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-11">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 11])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-12">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 12])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-13">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 13])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-14">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 14])
                    </div>
                    <div class="tab-pane fade" id="nav-tab2-15">
                        @include('nms_incell.monitoring.pack._pack1', ['pack_id' => 15])
                    </div>
                </div>
            </div>

        </div>

    </section>

    <section id="none_site" class="hide">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-default"
                       data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-success"
                       data-click="panel-reload" id="btn_refresh"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-warning"
                       data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:" class="btn btn-xs btn-icon btn-circle btn-danger"
                       data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">MONITORING DATA</h4>
            </div>
            <div class="panel-body" id="monitoring_site">

                <div id="none_site1" class="show">
                    <div class="col-md-12">
                        @include('nms_incell.schemes._none_site')
                    </div>
                </div>

            </div>
        </div>

    </section>

{{--    <i class="fa fa-ambulance"></i>--}}


@endsection

@section('js')
    <script>

        var time = new Date().getTime();
        $(document.body).bind("mousemove keypress", function () {
            time = new Date().getTime();
        });

        function refresh() {
            // console.log('refresh page');
            if (new Date().getTime() - time >= 1200000)  // 20 Menit
                window.location.reload(true);
            else
                setTimeout(refresh, 10000);
        }

        setTimeout(refresh, 10000);

        function reloadPage() {
            location.reload();

        }

        let myInterval;


        function createTablePack(data,packId) {

            // console.log('soc pack 1:',data.polling[0].pack1);
            const pack= 'pack'+packId;
            $('#'+pack+'_tbl_1 td').remove();

            for (var i = 0; i < 7; i++) {
                // var row = $('<tr><td>' + data.polling[i].id + '. &nbsp;' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                if(i === 6){

                    if(data.polling[6][pack] > data.polling[28][pack] ){
                        var row = $('<tr><td>' + "BACKUP_TIME" + '</td><td>' + data.polling[28][pack] + ' &nbsp;' + "H" + '</td></tr>');
                        $('#'+pack+'_tbl_1').append(row);
                    }else{
                        var row = $('<tr><td>' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                        $('#'+pack+'_tbl_1').append(row);
                    }

                }else{
                    var row = $('<tr><td>' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                    $('#'+pack+'_tbl_1').append(row);
                }



            }
            for (var i = 22; i < 26; i++) {
                // var row = $('<tr><td>' + data.polling[i].id + '. &nbsp;' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                var row = $('<tr><td>' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                $('#'+pack+'_tbl_1').append(row);
            }

            for (var i = 28; i < 29; i++) {
                // var row = $('<tr><td>' + data.polling[i].id + '. &nbsp;' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                var row = $('<tr><td>' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                $('#'+pack+'_tbl_1').append(row);
            }

            /*
             //BATTERY STATUS
             for (var i = 27; i < 28; i++) {
                 // var row = $('<tr><td>' + data.polling[i].id + '. &nbsp;' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                 var row = $('<tr><td>' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                 $('#'+pack+'_tbl_1').append(row);
             }*/


            $('#'+pack+'_tbl_2 td').remove();

            for (var i = 7; i < 22; i++) {
                // var row = $('<tr><td>' + data.polling[i].id + '. &nbsp;' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                try{
                    var row = $('<tr><td>' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                    $('#'+pack+'_tbl_2').append(row);
                }
                catch (e) {
                    console.log('ignore out of id on :',pack);

                }
            }

            for (var i = 26; i < 27; i++) {
                // var row = $('<tr><td>' + data.polling[i].id + '. &nbsp;' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                try{
                    var row = $('<tr><td>' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                    $('#'+pack+'_tbl_2').append(row);
                }
                catch (e) {
                    console.log('ignore out of id on :',pack);

                }
            }


            //FOR ALARM
            $('#'+pack+'_tbl_3 td').remove();
            var counts = 0;

            for (var i = 0; i < 11; i++) {

                try {
                    // var row = $('<tr><td>' + data.alarm[i].id + '. &nbsp;' + data.alarm[i].parameters.name + '</td><td>' + data.alarm[i][pack] + ' &nbsp;</td></tr>');
                    // var row = $('<tr class="'+ data.alarm[i][pack]+'"><td>' + data.alarm[i].parameters.name + '</td><td class="'+ data.alarm[i][pack]+'">' + data.alarm[i][pack] + ' &nbsp;</td></tr>');

                    var row = $('<tr class="'+ data.alarm[i][pack]+'"><td>' + data.alarm[i].parameters.name + '</td></tr>');
                    $('#'+pack+'_tbl_3').append(row);

                    if(data.alarm[i][pack] === 'ACTIVE'){
                        counts += 1;
                    }

                }
                catch (e) {
                    // console.log('err table:',e);
                    console.log('ignore out of id on :',pack);
                }
            }

            if(counts === 0){
                var row_none = "<tr><td>NONE</td></tr>";
                $('#'+pack+'_tbl_3').append(row_none);
            }

            //FOR DIGITAL INPUT
            console.log('digtal input:',data.digital_input);
            var di;
            for (di = 0; di < 4; di++) {
                if (data.digital_input[di].pack1 === 'ACTIVE'){
                    $('#di'+(di+1)).text(data.digital_input[di].pack1).addClass('ACTIVE').removeClass('DI-IN-ACTIVE');
                }else{
                    $('#di'+(di+1)).text(data.digital_input[di].pack1).removeClass('ACTIVE').addClass('DI-IN-ACTIVE');

                }
            }

            // FOR SOC,TEMP,CYCLE
            const schema = 'pack';
            for(var i =0;i < 15;i++){
                // console.log('soc pack '+i+':',data.polling[0][schema+i]);
                $('#schema_soc'+i).text(data.polling[0][schema+i]);
                $('#schema_voltage'+i).text(data.polling[1][schema+i]);
                $('#schema_current'+i).text(data.polling[2][schema+i]);
                $('#schema_cycle'+i).text(data.polling[5][schema+i]);
                // $('#schema_backuptime'+i).text(data.polling[6][schema+i]);


                $('#schema_min_temp'+i).text(data.polling[23][schema+i]);
                $('#schema_max_temp'+i).text(data.polling[24][schema+i]);
                // $('#battery_status'+i).text(data.polling[27][schema+i]);

                if (data.polling[27][schema+i] === 1){
                    $('#battery_status'+i).text("CHARGE");

                }else if (data.polling[27][schema+i] === 2){
                    $('#battery_status'+i).text("DISCHARGE");

                }else if (data.polling[27][schema+i] === 3){
                    $('#battery_status'+i).text("READY");

                }else {
                    $('#battery_status'+i).text("BATT.OUTAGE");

                }

                if(data.polling[6][schema+i] > data.polling[28][schema+i] ){
                    $('#schema_backuptime'+i).text(data.polling[28][schema+i]);

                }else{
                    $('#schema_backuptime'+i).text(data.polling[6][schema+i]);

                }

            }

            //FOR BATTERY STATUS


        }


        function getMonitoringSite(site_oid) {

            console.log('get monitoring site:', site_oid);
            clearInterval(myInterval);
            $("li[id^=tab_pack]").addClass('hide');
            $('[href="#nav-tab2-1"]').tab('show');
            // clearAllMonitoringValue();

            $.ajax({
                url: '{{ route('monitoring-show') }}',
                data: {'site_oid': site_oid},
                type: 'GET',
                success: function (data) {


                    if (data === 'NOT VALID SITE') {

                        console.log("show none site");
                        $('#none_site').removeClass('hide').addClass('show');
                        $('#valid_site').removeClass('show').addClass('hide');
                        // $('#nav_tab_pack').removeClass('show').addClass('hide');

                    } else {
                        /*show data site*/
                        $('#none_site').removeClass('show').addClass('hide');
                        $('#valid_site').removeClass('hide').addClass('show');
                        // $('#nav_tab_pack').removeClass('hide').addClass('show');

                        console.log('data site:', data);

                        $('.site_name').text(data.site.name);
                        $('.site_address').text(data.site.address);
                        $('.site_longitude').text(data.site.longitude);
                        $('.site_latitude').text(data.site.latitude);
                        $('.last_updated').text(data.site.sn_pack.updated_at);
                        $('.site_id_label').text(data.site.site_id_label);
                        // $('.sim_card_number').text(data.site.node[0].serial_number);//temporary
                        $('.sim_card_number').text("08XX-XXXX-XXXX");//temporary
                        $('#gmap_address,#gmap_gps').attr("href","http://maps.google.com/?q="+data.site.latitude+","+data.site.longitude);

                        var total_pack = data.site.total_pack;
                        console.log('total pack:',total_pack);

                        for (var i = 2; i <= total_pack; i++) {
                            console.log('sho tab : ',i);
                            $('#tab_pack'+i).removeClass('hide');

                        }


                        console.log('length:',data.polling);


                        //DIGITAL ALARM


                        for (var i = 1; i < 16; i++) {
                            // var row = $('<tr><td>' + data.polling[i].id + '. &nbsp;' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                            // $('#'+pack+'_tbl_1').append(row);
                            const pack = 'sn'+i;
                            $('#sn'+i).text(data.site.sn_pack[pack]);
                            console.log('sn:'+data.site.sn_pack[pack] );

                            createTablePack(data,i);
                            $("#default_tab").trigger("click");


                        }

                        // createTablePack(data,1);
                        // createTablePack(data,2);
                        // createTablePack(data,3);
                        // createTablePack(data,4);
                        // createTablePack(data,5);
                        // createTablePack(data,6);
                        // createTablePack(data,7);
                        // createTablePack(data,8);
                        // createTablePack(data,9);
                        // createTablePack(data,10);
                        // createTablePack(data,11);
                        // createTablePack(data,12);
                        // createTablePack(data,13);
                        // createTablePack(data,14);
                        // createTablePack(data,15);

                    }
                },
                error: function (err) {
                    console.log('err:', err);

                },
            });

            myInterval = setInterval(scheduledMonitoring, 30000);
        }

        function scheduledMonitoring() {
            console.log('## SCHEDULING REQUEST ##');

            var site_oid = JSON.parse(localStorage.getItem("activeSite"));

            $.ajax({
                url: '{{ route('monitoring-show') }}',
                data: {'site_oid': site_oid},
                type: 'GET',
                success: function (data) {


                    if (data === 'NOT VALID SITE') {

                        console.log("show none site");
                        $('#none_site').removeClass('hide').addClass('show');
                        $('#valid_site').removeClass('show').addClass('hide');

                    } else {
                        /*show data site*/
                        $('#none_site').removeClass('show').addClass('hide');
                        $('#valid_site').removeClass('hide').addClass('show');

                        console.log('data site:', data);

                        $('.site_name').text(data.site.name);
                        $('.site_address').text(data.site.address);
                        $('.site_longitude').text(data.site.longitude);
                        $('.site_latitude').text(data.site.latitude);
                        $('.last_updated').text(data.site.sn_pack.updated_at);
                        $('#gmap_address,#gmap_gps').attr("href","http://maps.google.com/?q="+data.site.latitude+","+data.site.longitude);


                        console.log('length:',data.polling);



                        for (var i = 1; i < 16; i++) {
                            // var row = $('<tr><td>' + data.polling[i].id + '. &nbsp;' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                            // $('#'+pack+'_tbl_1').append(row);
                            const pack = 'sn'+i;
                            $('#sn'+i).text(data.site.sn_pack[pack]);
                            // console.log('sn:'+data.site.sn_pack[sn] );
                            createTablePack(data,i);

                        }

                        // createTablePack(data,1);
                        // createTablePack(data,2);
                        // createTablePack(data,3);
                        // createTablePack(data,4);
                        // createTablePack(data,5);
                        // createTablePack(data,6);
                        // createTablePack(data,7);
                        // createTablePack(data,8);
                        // createTablePack(data,9);
                        // createTablePack(data,10);
                        // createTablePack(data,11);
                        // createTablePack(data,12);
                        // createTablePack(data,13);
                        // createTablePack(data,14);
                        // createTablePack(data,15);

                    }
                },
                error: function (err) {
                    console.log('err:', err);

                },
            });
        }

        // function tableCreate(el, data)
        // {
        //     var tbl  = document.createElement("table");
        //     tbl.style.width  = "70%";
        //
        //     for (var i = 0; i < data.length; ++i)
        //     {
        //         var tr = tbl.insertRow();
        //         for(var j = 0; j < data[i].length; ++j)
        //         {
        //             var td = tr.insertCell();
        //             td.appendChild(document.createTextNode(data[i][j].toString()));
        //         }
        //     }
        //     el.appendChild(tbl);
        // }
        // $("#jstree-ajax").jstree(true).set_icon("02cb9166-7929-4b1f-ae80-b460828e871e", "fa fa-calendar");
        // $("#7cc1e0b0-5bd5-4d71-90ea-ef78877478b9_anchor").find('i.jstree-icon.jstree-themeicon.fa.fa-flag.jstree-themeicon-custom').remove().prepend('<i class="jstree-icon jstree-themeicon fa fa-calculator fa-lg jstree-themeicon-custom" role="presentation"></i>');
        $("#7cc1e0b0-5bd5-4d71-90ea-ef78877478b9_anchor").text('<i class="jstree-icon jstree-themeicon fa fa-calculator fa-lg jstree-themeicon-custom" role="presentation"></i>');


    </script>
@endsection