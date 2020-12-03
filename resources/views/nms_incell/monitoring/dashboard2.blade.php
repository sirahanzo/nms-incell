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


        .hot-panel{
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

        .floating-panel{
            /*display: flex;*/
            position: fixed;
            bottom: 50px;
            left: 5px;
        }
        .site-active{
            color: #59EA12;
        }

        .site-down{
            color: red;
        }

        .legend-map{
            color: whitesmoke ;
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
        <h1 class="page-header legend-map" >SITE MAP |
            <small class="legend-map">Last Updated at: 2020-12-01 00:00:00</small>
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
                        <td>Total Site </td>
                        <td>:</td>
                        <td><span id="total_site">0</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                    </tr>
                    <tr>
                        <td> <i class="fa fa-circle site-active"></i> UP</td>
                        <td>:</td>
                        <td>n/a</td>
                    </tr>
                    <tr>
                        <td> <i class="fa fa-circle site-down"></i> DOWN</td>
                        <td>:</td>
                        <td>n/a</td>
                    </tr>
                    </tbody>
                </table>
                <table class="hide">
                    <tbody>
                    <tr>
                        <td><div style="width:12px;height:12px;border-radius:50%;background-color:#59EA12;margin: 8px 4px"></div></td>
                        <td>All Unit Running</td></tr>
                    <tr>
                        <td><div style="width:12px;height:12px;border-radius:50%;background-color:#F58400;margin: 8px 4px"></div></td>
                        <td>Partial Unit Run</td></tr>
                    <tr>
                        <td><div style="width:12px;height:12px;border-radius:50%;background-color:#FF0000;margin: 8px 4px"></div></td>
                        <td>All Unit Off</td></tr>
                    <tr>
                        <td><div style="width:12px;height:12px;border-radius:50%;background-color:#868A8B;margin: 8px 4px"></div></td>
                        <td>Not Connected</td></tr>
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
                        <td>Total alarm </td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td style="color:orange;"> <i class="fa fa-bell"></i> major</td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td style="color: #D5F409"> <i class="fa fa-bell"></i> minor </td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td style="color:lightgrey"> <i class="fa fa-bell"> </i> warning </td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td style="color: red;font-weight: 900"><i class="fa fa-exclamation-triangle"></i>  critical </td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    </tbody>
                </table>
                <table class="hide">
                    <tbody>
                    <tr>
                        <td><div style="width:12px;height:12px;border-radius:50%;background-color:#59EA12;margin: 8px 4px"></div></td>
                        <td>All Unit Running</td></tr>
                    <tr>
                        <td><div style="width:12px;height:12px;border-radius:50%;background-color:#F58400;margin: 8px 4px"></div></td>
                        <td>Partial Unit Run</td></tr>
                    <tr>
                        <td><div style="width:12px;height:12px;border-radius:50%;background-color:#FF0000;margin: 8px 4px"></div></td>
                        <td>All Unit Off</td></tr>
                    <tr>
                        <td><div style="width:12px;height:12px;border-radius:50%;background-color:#868A8B;margin: 8px 4px"></div></td>
                        <td>Not Connected</td></tr>
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
{{--    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCAWXD0g0fbXbEkEmGP8_tJDDPtYt8S4DE&sensor=false"></script>--}}

{{--        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCAWXD0g0fbXbEkEmGP8_tJDDPtYt8S4DE&callback=initMap"></script>--}}

    <script>
        let map;
        function initMap() {
            /*var styledMapType = new google.maps.StyledMapType(
                [
                    {
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 13
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#000000"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#144b53"
                            },
                            {
                                "lightness": 14
                            },
                            {
                                "weight": 1.4
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#08304b"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#0c4152"
                            },
                            {
                                "lightness": 5
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#000000"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#0b434f"
                            },
                            {
                                "lightness": 25
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#000000"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#0b3d51"
                            },
                            {
                                "lightness": 16
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#000000"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#146474"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#021019"
                            }
                        ]
                    }
                ]
            );

            var lebar = window.innerWidth;
            var xZoom = 5;
            if (lebar >= 2500) {
                xZoom = 6;
            }
            if (lebar >= 3800) {
                xZoom = 7;
            }
            map = new google.maps.Map(document.getElementById('sites-map'), {
                center: {lat: -0.7, lng: 117.6},
                zoom: xZoom,
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: false
            });
            // map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');*/
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
        }

        function setMarker() {

        }


    </script>
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJB1_8d0bmX2YGZ3MV6WSqxleYvXPXfTY&callback=initMap"></script>--}}

        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCAWXD0g0fbXbEkEmGP8_tJDDPtYt8S4DE&callback=initMap"></script>

@endsection