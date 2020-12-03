@extends('layouts.nms_master2')

@section('css')
    <style>
        .mapping {
            position: absolute;
            top: 54px;
            bottom: 10px;
            left: 0;
            right: 0;
            z-index: 0;
        }


        .hot-panel {
            text-align: center;
            width: auto;
            height: 125px;
            border-radius: 10px;
            /* background-color: rgba(255, 255, 255, 0.5); */
            /*background-color: rgb(3 169 244 / 74%);;*/
            background-color: #607D8B;
            /* box-shadow: 0px 0px 3px rgba(0,0,0, 0.7); */
            margin: 0px 0px 15px 15px;
            padding: 10px 15px;
            cursor: pointer;
            color: white;
            line-height: 1.8em;
            grid-column-gap: 12px;
        }

        .floating-panel {
            /*display: flex;*/
            position: fixed;
            bottom: 50px;
            left: 5px;
        }

        .site-active {
            color: #59EA12;
        }

        .site-down {
            color: red;
        }

        .pln-down {
            color: yellow;
        }

        .commlost {
            color: black;
        }

        .legend-map {
            color: whitesmoke;
            /*width: auto;*/
            /*height: auto;*/
            /*border-radius: 5px;*/
            /* background-color: rgba(255, 255, 255, 0.5);*/
            /*background-color: rgb(3 169 244 / 74%);;*/
            /* box-shadow: 0px 0px 3px rgba(0,0,0, 0.7); */
            /*margin: 0px 0px 15px 15px;*/
            /*padding: 10px 15px;*/
            /*cursor: pointer;*/
            /*color: white;*/
            /*line-height: 1.8em;*/
            /*grid-column-gap: 12px;*/
        }

        .otto {
            /*background: #0e8dbc;*/
            /*color: black;*/
            /*text-shadow: 0 1px 0 #ccc,*/
            /*0 2px 0 #c9c9c9,*/
            /*0 3px 0 #bbb,*/
            /*0 4px 0 #b9b9b9,*/
            /*0 5px 0 #aaa,*/
            /*0 6px 1px rgba(0,0,0,.1),*/
            /*0 0 5px rgba(0,0,0,.1),*/
            /*0 1px 3px rgba(0,0,0,.3),*/
            /*0 3px 5px rgba(0,0,0,.2),*/
            /*0 5px 10px rgba(0,0,0,.25),*/
            /*0 10px 10px rgba(0,0,0,.2),*/
            /*0 20px 20px rgba(0,0,0,.15);*/

            /*color: rgba(0,0,0,0.6);*/
            /*text-shadow: 2px 8px 6px rgba(0,0,0,0.2),*/
            /*0px -5px 35px rgba(255,255,255,0.3);*/

            color:#2d353c;
            text-shadow: 0 0 0.5em #ddd, 0 0 0.5em #ddd, 0 0 0.5em #ddd;        }
    </style>
@endsection

@section('content')
    {{--<div id="content" class="content">

        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li><a href="javascript:;">Page Options</a></li>
            <li class="active">Page with Top Menu</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Page with Top Menu
            <small>header small text goes here...</small>
        </h1>
        <!-- end page-header -->

        <div class="row">
            <div class="col-md-12 ui-sortable">
                <div class="panel panel-inverse">
                    --}}{{--<div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Panel Title here</h4>
                    </div>--}}{{--
                    <div class="panel-body1" >
                        <div class="map">
                            <div id="sites-map" class="height-full width-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}

    <div id="content" class="content content-full-width">
        <!-- begin breadcrumb -->
    {{--        <ol class="breadcrumb pull-right">--}}
    {{--            <li><a href="javascript:;">Home</a></li>--}}
    {{--            <li><a href="javascript:;">Map</a></li>--}}
    {{--            <li class="active">Google Map</li>--}}
    {{--        </ol>--}}
    <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header legend-map otto">SITE MAP |
            <small class="legend-map otto">Last Updated at: <span id="updated_at">2020-12-01 00:00:00</span></small>
        </h1>
        <!-- end page-header -->

        <div class="map-content hide">
            <div class="btn-group map-btn pull-right">
                <button type="button" class="btn btn-sm btn-inverse" id="map-theme-text">Default Theme</button>
                <button type="button" class="btn btn-sm btn-inverse dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="map-theme-selection">
                    <li class="active"><a href="javascript:;" data-map-theme="default">Default</a></li>
                    <li><a href="javascript:;" data-map-theme="flat">Flat</a></li>
                    <li><a href="javascript:;" data-map-theme="turquoise-water">Turquoise Water</a></li>
                    <li><a href="javascript:;" data-map-theme="icy-blue">Icy Blue</a></li>
                    <li><a href="javascript:;" data-map-theme="cobalt">Cobalt</a></li>
                    <li><a href="javascript:;" data-map-theme="old-dry-mud">Old Dry Mud</a></li>
                    <li><a href="javascript:;" data-map-theme="dark-red">Dark Red</a></li>
                </ul>
            </div>
        </div>
        <div class="mapping">
            <div id="sites-map" class="height-full1 width-full1" style="position: absolute; overflow: hidden;height: 100%;width: 100%"></div>
        </div>

        <div class="floating-panel">
            <div class="hot-panel" style=" display: grid;align-content: space-evenly; grid-template-columns: auto auto;text-align: left;">
                <table class="table1 table-hover text-uppercase h5">
                    <tbody>
                    <tr>
                        <td>Total Site</td>
                        <td>:</td>
                        <td><span id="total_site">0</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-circle site-active"></i> UP</td>
                        <td>:</td>
                        <td><span id="site_up">0</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-circle pln-down"></i> PLN DOWN</td>
                        <td>:</td>
                        <td><span id="pln_down">0</span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-circle site-down"></i> DOWN</td>
                        <td>:</td>
                        <td><span id="site_down"></span></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-circle commlost"></i> COMM.LOST</td>
                        <td>:</td>
                        <td><span id="comm_lost">0</span></td>
                    </tr>
                    </tbody>
                </table>
                <table class="hide">
                    <tbody>
                    <tr>
                        <td>
                            <div style="width:12px;height:12px;border-radius:50%;background-color:#59EA12;margin: 8px 4px"></div>
                        </td>
                        <td>All Unit Running</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width:12px;height:12px;border-radius:50%;background-color:#F58400;margin: 8px 4px"></div>
                        </td>
                        <td>Partial Unit Run</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width:12px;height:12px;border-radius:50%;background-color:#FF0000;margin: 8px 4px"></div>
                        </td>
                        <td>All Unit Off</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width:12px;height:12px;border-radius:50%;background-color:#868A8B;margin: 8px 4px"></div>
                        </td>
                        <td>Not Connected</td>
                    </tr>
                    </tbody>
                </table>
                <!--
                <div style="width:12px;height:12px;border-radius:50%;background-color:#59EA12"></div> All Unit Running<br>
                <div style="width:12px;height:12px;border-radius:50%;background-color:#F58400"></div> Partial Unit Run<br>
                <div style="width:12px;height:12px;border-radius:50%;background-color:#FF0000"></div> All Unit Off<br>
                <div style="width:12px;height:12px;border-radius:50%;background-color:#868A8B"></div> Not Connected<br>
                -->
            </div>
            <div class="hot-panel hide" style=" display: grid;align-content: space-evenly; grid-template-columns: auto auto;text-align: left;">
                <table class="table1  table-hover text-uppercase">
                    <tbody>
                    <tr>
                        <td>Total alarm</td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td style="color:orange;"><i class="fa fa-bell"></i> major</td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td style="color: #D5F409"><i class="fa fa-bell"></i> minor</td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td style="color:lightgrey"><i class="fa fa-bell"> </i> warning</td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td style="color: red;font-weight: 900"><i class="fa fa-exclamation-triangle"></i> critical</td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    </tbody>
                </table>
                <table class="hide">
                    <tbody>
                    <tr>
                        <td>
                            <div style="width:12px;height:12px;border-radius:50%;background-color:#59EA12;margin: 8px 4px"></div>
                        </td>
                        <td>All Unit Running</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width:12px;height:12px;border-radius:50%;background-color:#F58400;margin: 8px 4px"></div>
                        </td>
                        <td>Partial Unit Run</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width:12px;height:12px;border-radius:50%;background-color:#FF0000;margin: 8px 4px"></div>
                        </td>
                        <td>All Unit Off</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width:12px;height:12px;border-radius:50%;background-color:#868A8B;margin: 8px 4px"></div>
                        </td>
                        <td>Not Connected</td>
                    </tr>
                    </tbody>
                </table>
                <!--
                <div style="width:12px;height:12px;border-radius:50%;background-color:#59EA12"></div> All Unit Running<br>
                <div style="width:12px;height:12px;border-radius:50%;background-color:#F58400"></div> Partial Unit Run<br>
                <div style="width:12px;height:12px;border-radius:50%;background-color:#FF0000"></div> All Unit Off<br>
                <div style="width:12px;height:12px;border-radius:50%;background-color:#868A8B"></div> Not Connected<br>
                -->
            </div>

            {{--<div class="hot-panel">
                <span class="big-detail" id="site-online">-</span>
                / <span id="site-total"> -</span><br>
                Site Connected<br>
                <span class="big-detail" id="genset-online">-</span>
                / <span id="genset-total">-</span><br>
                Unit Connected
            </div>--}}
            {{--<div class="hot-panel" style="font-size: 0.75em; display: grid;align-content: space-evenly; grid-template-columns: auto auto;text-align: left;align-items:center;">
                <table>
                    <tbody>
                    <tr>
                        <td><div class="panel-number" id="genset_summary_running" style="margin: 4px">-</div></td>
                        <td> Unit Running</td></tr>
                    <tr>
                        <td><div class="panel-number" id="genset_summary_off" style="margin: 4px">-</div></td>
                        <td> Unit Standby</td></tr>
                    <tr>
                        <td><div class="panel-number" id="genset_summary_standby" style="margin: 4px">-</div></td>
                        <td> Unit Off</td></tr>
                    </tbody>
                </table>
            </div>--}}
        </div>

    </div>

@endsection

@section('js')
{{--        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCAWXD0g0fbXbEkEmGP8_tJDDPtYt8S4DE&sensor=false"></script>--}}
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD4u_lX_IZbOICh0-rQMHB6_ENZuo2_opI"></script>

    {{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJB1_8d0bmX2YGZ3MV6WSqxleYvXPXfTY&callback=initMap"></script>--}}
{{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJB1_8d0bmX2YGZ3MV6WSqxleYvXPXfTY"></script>--}}

    {{--        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCAWXD0g0fbXbEkEmGP8_tJDDPtYt8S4DE"></script>--}}

    <script>
        let myInterval;


        // Creating a new map
        var start_point = new google.maps.LatLng(-2.548926, 118.0148634);

        // var map = new google.maps.Map(document.getElementById("map"), {
        var map = new google.maps.Map(document.getElementById("sites-map"), {
            // center: new google.maps.LatLng(-6.21462, 106.84513),
            center: start_point,
            zoom: 5,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
        });


        initMap();

        function initMap() {
            clearInterval(myInterval);

            $.ajax({
                url: '{{ route('coordinate-map') }}',
                // data: 'json',
                type: 'GET',
                success: function (data) {
                    var json = data.sites;

                    // Creating a global infoWindow object that will be reused by all markers
                    var infoWindow = new google.maps.InfoWindow();

                    $('#total_site').text(data.sites.length);
                    $('#updated_at').text(data.latest.updated_at);
                    $('#site_up').text(data.site_up);
                    $('#site_down').text(data.site_down);
                    $('#pln_down').text(data.pln_down);
                    $('#comm_lost').text(data.commlost);

                    // Looping through the JSON data
                    for (var i = 0, length = json.length; i < length; i++) {

                        var data = json[i],
                            // latLng = new google.maps.LatLng(data.lat, data.lng);
                            latLng = new google.maps.LatLng(data.latitude, data.longitude);

                        // Creating a marker and putting it on the map
                        var image = '{{ asset('img/tower3.png') }}';
                        var marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            icon: image,
                            title: data.name,

                        });

                        // Creating a closure to retain the correct data, notice how I pass the current data in the loop into the closure (marker, data)
                        (function (marker, data) {


                            // Attaching a click event to the current marker
                            google.maps.event.addListener(marker, "click", function (e) {

                                // console.log('on click  marker show data site:', data.oid);

                                if (!marker.open) {
                                    $.ajax({
                                        url: '{{ route('marker-information') }}',
                                        data: {'site_oid': data.oid},
                                        type: 'GET',
                                        success: function (val) {

                                            console.log('SITE INFORMATION:', val);
                                            var info = val.site;
                                            var avg = val.avg_data;


                                            //updated selected site
                                            let jstree = JSON.parse(localStorage.getItem('jstree'));
                                            jstree.state.core.selected[0] = info.oid;
                                            localStorage.setItem("jstree", JSON.stringify(jstree));


                                            var content_information1 = '<table class="table table-hover table-bordered"> ' +
                                                '<thead>' +
                                                '<tr>' +
                                                '<th>SITE NAME</th>' +
                                                '<th> <span id="site_name">' + info.name + '</span></th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>SITE ID</th>' +
                                                '<th> <span id="site_id">' + info.site_id_label + '</span></th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>ADDRESS</th>' +
                                                '<th><span id="site_address">' + info.address + '</span></th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>TOTAL BATTERY</th>' +
                                                '<th><span id="total_pack">' + info.total_pack + 'PACK </span></th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>AVG VOLTAGE</th>' +
                                                '<th>' + avg[1].value.toFixed() + 'V</th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>AVG SOC</th>' +
                                                '<th>' + avg[0].value + '%</th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>STATUS</th>' +
                                                '<th>' + "Not Available" + '</th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>LAST UPDATE</th>' +
                                                '<th>' + avg[0].updated_at + '</th>' +
                                                '</tr>' +
                                                '</thead>' +
                                                '</table>' +
                                                '<table class=" hide table table-hover table-bordered"> ' +
                                                '<thead>' +
                                                '<tr>' +
                                                '<th>RECTIFIER</th>' +
                                                '<th>PLN</th>' +
                                                '<th>BMS</th>' +
                                                '</tr>' +
                                                '</thead>' +
                                                '<tbody>' +
                                                '<tr>' +
                                                '<td>Vrect : ' + "00,00" + 'V</td>' +
                                                '<td>R : ' + "00,00" + 'V</td>' +
                                                '<td>Vbatt :' + "00,00" + ' V</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<td>Irect : ' + "00,00" + 'A</td>' +
                                                '<td>S : ' + "00,00" + 'V</td>' +
                                                '<td>Ibms :' + "00,00" + 'A</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<td>Iload : ' + "00,00" + 'A</td>' +
                                                '<td>T : ' + '00,00' + 'V</td>' +
                                                '<td>SOC :' + "soc" + ' %</td>' +
                                                '</tr>' +
                                                '</tbody>' +
                                                '</table>' +
                                                '<table class="table"> ' +
                                                '<thead> ' +
                                                '<tr> ' +
                                                '<th><a href="{{route('monitoring')}}">Details</a></th> ' +
                                                '</tr> ' +
                                                '</thead> ' +
                                                '</table>'
                                            ;


                                            // console.log('klik icon:', content_information1);
                                            infoWindow.setContent(content_information1);
                                            infoWindow.open(map, marker);


                                        },
                                        error: '',
                                    })
                                    // infoWindow.open(map,marker);
                                    marker.open = true;
                                } else {
                                    infoWindow.close();
                                    marker.open = false;
                                }
                                google.maps.event.addListener(map, 'click', function () {
                                    infoWindow.close();
                                    marker.open = false;
                                });

                            });


                        })(marker, data);

                    }


                },
                error: function () {
                    console.log('Please refresh the page and try again');
                },
            });

            // myInterval = setInterval(scheduledMonitoring, 10000);
            myInterval = setInterval(scheduledMonitoring, 300000);

        }


        function scheduledMonitoring() {
            console.log('Updated Map!');
            $.ajax({
                url: '{{ route('coordinate-map') }}',
                type: 'GET',
                success: function (data) {

                    var json = data.sites;

                    // Creating a global infoWindow object that will be reused by all markers
                    var infoWindow = new google.maps.InfoWindow();

                    $('#total_site').text(data.sites.length);
                    $('#updated_at').text(data.latest.updated_at);

                    // Looping through the JSON data
                    for (var i = 0, length = json.length; i < length; i++) {

                        var data = json[i],
                            // latLng = new google.maps.LatLng(data.lat, data.lng);
                            latLng = new google.maps.LatLng(data.latitude, data.longitude);

                        // Creating a marker and putting it on the map
                        var image = '{{ asset('img/tower3.png') }}';
                        var marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            icon: image,
                            title: data.name,

                        });

                        // Creating a closure to retain the correct data, notice how I pass the current data in the loop into the closure (marker, data)
                        (function (marker, data) {


                            // Attaching a click event to the current marker
                            google.maps.event.addListener(marker, "click", function (e) {

                                // console.log('on click  marker show data site:', data.oid);

                                if (!marker.open) {
                                    $.ajax({
                                        url: '{{ route('marker-information') }}',
                                        data: {'site_oid': data.oid},
                                        type: 'GET',
                                        success: function (val) {

                                            console.log('SITE INFORMATION:', val);
                                            var info = val.site;
                                            var avg = val.avg_data;


                                            //updated selected site
                                            let jstree = JSON.parse(localStorage.getItem('jstree'));
                                            jstree.state.core.selected[0] = info.oid;
                                            localStorage.setItem("jstree", JSON.stringify(jstree));


                                            var content_information1 = '<table class="table table-hover table-bordered"> ' +
                                                '<thead>' +
                                                '<tr>' +
                                                '<th>SITE NAME</th>' +
                                                '<th> <span id="site_name">' + info.name + '</span></th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>SITE ID</th>' +
                                                '<th> <span id="site_id">' + info.site_id_label + '</span></th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>ADDRESS</th>' +
                                                '<th><span id="site_address">' + info.address + '</span></th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>TOTAL BATTERY</th>' +
                                                '<th><span id="total_pack">' + info.total_pack + 'PACK </span></th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>AVG VOLTAGE</th>' +
                                                '<th>' + avg[1].value + 'V</th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>AVG SOC</th>' +
                                                '<th>' + avg[0].value + '%</th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>STATUS</th>' +
                                                '<th>' + "Not Available" + '</th>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<th>LAST UPDATE</th>' +
                                                '<th>' + avg[0].updated_at + '</th>' +
                                                '</tr>' +
                                                '</thead>' +
                                                '</table>' +
                                                '<table class=" hide table table-hover table-bordered"> ' +
                                                '<thead>' +
                                                '<tr>' +
                                                '<th>RECTIFIER</th>' +
                                                '<th>PLN</th>' +
                                                '<th>BMS</th>' +
                                                '</tr>' +
                                                '</thead>' +
                                                '<tbody>' +
                                                '<tr>' +
                                                '<td>Vrect : ' + "00,00" + 'V</td>' +
                                                '<td>R : ' + "00,00" + 'V</td>' +
                                                '<td>Vbatt :' + "00,00" + ' V</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<td>Irect : ' + "00,00" + 'A</td>' +
                                                '<td>S : ' + "00,00" + 'V</td>' +
                                                '<td>Ibms :' + "00,00" + 'A</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                '<td>Iload : ' + "00,00" + 'A</td>' +
                                                '<td>T : ' + '00,00' + 'V</td>' +
                                                '<td>SOC :' + "soc" + ' %</td>' +
                                                '</tr>' +
                                                '</tbody>' +
                                                '</table>' +
                                                '<table class="table"> ' +
                                                '<thead> ' +
                                                '<tr> ' +
                                                '<th><a href="{{route('monitoring')}}">Details</a></th> ' +
                                                '</tr> ' +
                                                '</thead> ' +
                                                '</table>'
                                            ;


                                            // console.log('klik icon:', content_information1);
                                            infoWindow.setContent(content_information1);
                                            infoWindow.open(map, marker);


                                        },
                                        error: '',
                                    })
                                    // infoWindow.open(map,marker);
                                    marker.open = true;
                                } else {
                                    infoWindow.close();
                                    marker.open = false;
                                }
                                google.maps.event.addListener(map, 'click', function () {
                                    infoWindow.close();
                                    marker.open = false;
                                });

                            });


                        })(marker, data);


                    }


                },
                error: function () {
                    console.log('Please refresh the page and try again');
                },
            });

        }


    </script>

@endsection