<!DOCTYPE html>
<!--
   _____ _____   ____________  __________   ______________ __ _   ______  __    ____  __________   __  ___________    __  ______
  / ___//  _/ | / / ____/ __ \/ ____/  _/  /_  __/ ____/ //_// | / / __ \/ /   / __ \/ ____/  _/  / / / /_  __/   |  /  |/  /   |
  \__ \ / //  |/ / __/ / /_/ / / __ / /     / / / __/ / ,<  /  |/ / / / / /   / / / / / __ / /   / / / / / / / /| | / /|_/ / /| |
 ___/ // // /|  / /___/ _, _/ /_/ // /     / / / /___/ /| |/ /|  / /_/ / /___/ /_/ / /_/ // /   / /_/ / / / / ___ |/ /  / / ___ |
/____/___/_/ |_/_____/_/ |_|\____/___/    /_/ /_____/_/ |_/_/ |_/\____/_____/\____/\____/___/   \____/ /_/ /_/  |_/_/  /_/_/  |_|

-->
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Haris Hanzo" name="author"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SINERGI') }}</title>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}img/favicon.png">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('/') }}css/jquery-ui.min.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/font-awesome.min.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/animate.min.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/style.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/style-responsive.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/theme/default.css" rel="stylesheet" id="theme"/>
    {{--<link href="/assets/css/theme/default.css" rel="stylesheet" id="theme"/>--}}
    <link href="{{ asset('/') }}css/theme/orange.css" rel="stylesheet" id="theme"/>
    <link href="{{ asset('/') }}css/essential.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/sweetalert2.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/ionicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/simple-line-icons.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/sinergi.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/jquery.gritter.css" rel="stylesheet"/>

    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    {{--<script src="{{ asset('/') }}js/pace.min.js"></script>--}}
    {{--<script src="assets/plugins/pace/pace.min.js"></script>--}}
    <link href="{{ asset('/') }}css/tree-pvr-style.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/jstree_style/style.min.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/dataTables.bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/responsive.bootstrap.min.css" rel="stylesheet"/>
    <style>
        .commlost{
            background-color: #BDBDBD  !important;
        }
        .table-device th a{
            color: whitesmoke !important;
        }

        .connect{
            background-color: #8BC34A  !important;
        }
    </style>


    <script>

        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- ================== END BASE JS ================== -->
    @yield('css')

</head>
<body>
<!-- begin #page-loader -->
{{--<div id="page-loader" class="fade in"><span class="spinner"></span></div>--}}
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="animated page-container fade page-without-sidebar page-header-fixed page-with-top-menu page-content-full-height">
    <!-- begin #header -->
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <a href="{{ route('dashboard') }}" class="navbar-brand" style="padding: 0px 22px;height: 65px"><img src="{{ asset('/') }}img/icon3.png" alt="logo"></a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{--                <button type="button" class="navbar-toggle p-0 m-r-5 collapsed" data-toggle="collapse" data-target="#top-navbar" aria-expanded="false">--}}
                <button type="button" class="navbar-toggle p-0 m-r-5 collapsed" data-toggle="dropdown" aria-expanded="false">
					    <span class="fa-stack fa-lg text-inverse">
                           {{-- <i class="fa fa-square-o fa-stack-2x m-t-2"></i>--}}
                            <i class="fa fa-th-large fa-stack-1x"></i>
                        </span>

                </button>
                {{--                todo: create separted file for included --}}
                @include('layouts._menu_to_pages')

{{--            @if(Auth::user()->region_oid == 'central')--}}
{{--                    @include('layouts._menu_to_pages')--}}
{{--                @else--}}
{{--                    @include('layouts._user_region_menu_to_pages')--}}
{{--                @endif--}}
            </div>
            <!-- end mobile sidebar expand / collapse button -->

            <!-- begin navbar-collapse -->
            <div class="navbar-collapse pull-left collapse" id="top-navbar" aria-expanded="false" style="height: 1px;">
                <ul class="nav navbar-nav">
                    <li class="dropdown dropdown-lg">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-th-large fa-fw"></i>
                            Menu <b class="caret"></b></a>
                        {{--                todo: create separted file for included --}}
                        @include('layouts._menu_to_pages')
                    </li>
                    <li class="hidden">
                        <a href="#">
                            <i class="fa fa-diamond fa-fw"></i> Client
                        </a>
                    </li>
                    <li class="dropdown hidden">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-database fa-fw"></i> New <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- end navbar-collapse -->

            <!-- begin header navigation right -->
            <ul class="nav navbar-nav navbar-right hidden-xs">
                <li class="dropdown"><a href="#"><span class="h4 semi-bold">{{ config('app.name') }}</span></a></li>
                <li><a href="#"> {{ date('D , d F Y') }} | <span id="clockDisplay"> {{ date('H:i:s') }} &nbsp;</span> </a></li>

{{--                @include('layouts._alarm_notification')--}}

                <li class="hidden">
                    <form class="navbar-form full-width hidden-sm">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter keyword for search">
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </li>
                <li class="dropdown hide">
                    <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="label">8</span>
                    </a>
                    <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                        <li class="dropdown-header">Notifications (5)</li>
                        <li class="media">
                            <a href="javascript:;">
                                <div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>
                                <div class="media-body">
                                    <h6 class="media-heading">Server Error Reports</h6>
                                    <div class="text-muted f-s-11">3 minutes ago</div>
                                </div>
                            </a>
                        </li>
                        <li class="media">
                            <a href="javascript:;">
                                <div class="media-left"><img src="assets/img/user-1.jpg" class="media-object" alt="">
                                </div>
                                <div class="media-body">
                                    <h6 class="media-heading">John Smith</h6>
                                    <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                    <div class="text-muted f-s-11">25 minutes ago</div>
                                </div>
                            </a>
                        </li>
                        <li class="media">
                            <a href="javascript:;">
                                <div class="media-left"><img src="assets/img/user-2.jpg" class="media-object" alt="">
                                </div>
                                <div class="media-body">
                                    <h6 class="media-heading">Olivia</h6>
                                    <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                    <div class="text-muted f-s-11">35 minutes ago</div>
                                </div>
                            </a>
                        </li>
                        <li class="media">
                            <a href="javascript:;">
                                <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
                                <div class="media-body">
                                    <h6 class="media-heading"> New User Registered</h6>
                                    <div class="text-muted f-s-11">1 hour ago</div>
                                </div>
                            </a>
                        </li>
                        <li class="media">
                            <a href="javascript:;">
                                <div class="media-left"><i class="fa fa-envelope media-object bg-blue"></i></div>
                                <div class="media-body">
                                    <h6 class="media-heading"> New Email From John</h6>
                                    <div class="text-muted f-s-11">2 hour ago</div>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-footer text-center">
                            <a href="javascript:;">View more</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown navbar-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('/') }}img/user-13.jpg" alt="">
                        <span class="hidden-xs">{{ Auth::user()->username }}</span> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="arrow"></li>
                        {{--                        <li><a href="javascript:;">Edit Profile</a></li>--}}
                        {{--                        <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>--}}
                        {{--                        <li><a href="javascript:;">Calendar</a></li>--}}
                        {{--                        <li><a href="javascript:;">Setting</a></li>--}}
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}">Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->    <!-- end #header -->

    <!-- begin #top-menu -->
    <!-- end #top-menu -->

    <!-- begin #content -->
{{--@yield('content')--}}
<!-- begin #content -->
    <div id="content" class="content content-full-width">
        <div class="vertical-box">
            <div class="vertical-box-column width-350">
                <div class="vertical-box ">
                    <div class="wrapper bg-black-darker text-white">
                        {{--Left Column Top Box--}}
                        <form class="form-horizontal form-bordered1">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="input-group m-t-10" id="search_site">
                                        <input type="text" class="form-control" id="search" placeholder="Enter keyword for search">
                                        <span class="input-group-addon">
                                                <i class=" fa fa-search"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="vertical-box-row bg-white  ">
                        <div class="vertical-box-cell">
                            <div class="vertical-box-inner-cell">
                                <div data-scrollbar="true" data-height="100%" class="wrapper m-r-5 ">
                                    <div id="jstree-ajax"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="wrapper bg-blue-darker text-white">--}}
                    {{--Left Column Bottom Box--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="vertical-box-column  ">
                <div class="vertical-box ">
                    <div class="vertical-box-row ">
                        <div class="vertical-box-cell">
                            <div class="vertical-box-inner-cell">
                                <div data-scrollbar="true" data-height="100%" class="wrapper">
                                    <!--content-->
                                @yield('content')
                                <!--/content-->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end #content -->


    <!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i
                class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->

{{--footer--}}

<div id="footer" class="footer fixed text-right ">
    © 2020 {{ config('app.name', 'SINERGI') }} - PT. BACH MULTI GLOBAL , All Rights Reserved
</div>
{{--footer--}}

{{--loading--}}
<div class="modal fade modal-m" tabindex="-1" role="dialog" id="progress">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div id="loading-wrapper" class="" style="margin-top: 50%">
                <div id="loading-text" class="text-uppercase">SAVING</div>
                <div id="loading-content"></div>
            </div>
        </div>
    </div>
</div>

{{--loading--}}

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('/') }}js/jquery-1.12.3.min.js"></script>
{{--<script src="{{ asset('/') }}js/jquery-1.9.1.min.js"></script>--}}
<script src="{{ asset('/') }}js/jquery-migrate-1.1.0.min.js"></script>
<script src="{{ asset('/') }}js/jquery-ui.min.js"></script>
<script src="{{ asset('/') }}js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="{{ asset('/') }}crossbrowserjs/html5shiv.js"></script>
<script src="{{ asset('/') }}crossbrowserjs/respond.min.js"></script>
<script src="{{ asset('/') }}crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="{{ asset('/') }}js/jquery.slimscroll.min.js"></script>
<script src="{{ asset('/') }}js/jquery.cookie.js"></script>
<script src="{{ asset('/') }}js/js.cookie.js"></script>
<script src="{{ asset('/') }}js/sweetalert2.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('/') }}js/jquery.dataTables.js"></script>
<script src="{{ asset('/') }}js/dataTables.bootstrap.min.js"></script>
<script src="{{ asset('/') }}js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/') }}js/jquery.gritter.js"></script>
<script src="{{ asset('/') }}js/app.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function () {
        App.init();
        // LoginV2.init();

        var d = new Date(Date.UTC(<?php echo date('Y') . ',' . date('m') . ',' . date('d') . ',' . (date('H') - 7) . ',' . date('i') . ',' . date('s')    ?>));


        setInterval(function () {
            d.setSeconds(d.getSeconds() + 1);
            var h = d.getHours();
            var i = d.getMinutes();
            var s = d.getSeconds();
            if (h === 0) {
                h === 00;
            }
            if (h < 10) {
                h = "0" + h;
            }
            if (i < 10) {
                i = "0" + i;
            }
            if (s < 10) {
                s = "0" + s;
            }

            //console.log(h +':' + i + ':' + s);
            $('#clockDisplay').text((h + ':' + i + ':' + s));

        }, 1000);


    });
    //==========

</script>

<script src="{{ asset('/') }}js/jstree.min.js"></script>
<script>

    function refreshJsTree() {
        console.log('tree refresh');
        $('#jstree-ajax').jstree().refresh();
    }

    $("#jstree-ajax")
        .jstree({
            core: {
                themes: {
                    responsive: !1,
                    // "variant" : "small",
                    // stripes : true,

                },
                check_callback: !0,
                data: {
                    url: '{{ route('node-tree') }}',
                    type: 'GET',
                    dataType: 'json',
                    tryCount: 1,
                    retryLimit: 3,
                    error: function (xhr, textStatus, errorThrown) {
                        if (textStatus === 'timeout') {
                            this.tryCount++;
                            if (this.tryCount <= this.retryLimit) {
                                //try again
                                // $.ajax(this);
                                refreshJsTree()
                            }
                        } else {
                            if (xhr.status === 500) {
                                //handle error
                                this.tryCount++;
                                if (this.tryCount <= this.retryLimit) {
                                    //try again
                                    // $.ajax(this);
                                    refreshJsTree()
                                }
                            }
                        }
                    }

                },

                // "dblclick_toggle" : false
            },
            types: {
                "default": {
                    icon: "fa fa-folder text-warning fa-lg"
                },
                file: {
                    icon: "fa fa-file text-warning fa-lg"
                }
            },
            plugins: ["dnd", "state", "types", "search", "wholerow"], //user wholerow to remove line node
            "search": {
                "case_insensitive": true,
                "show_only_matches": true
            },
        })
        .bind('select_node.jstree', function (e, data) {
            var i, j, r = [];
            for (i = 0, j = data.selected.length; i < j; i++) {
                r.push(data.instance.get_node(data.selected[i]).id);
            }
            // console.log('Selected: ' + r.join(', '));

            var site_oid = r.join(', ');

            // console.log('make requet to controller with data site_id :'+site_oid);
            // console.log('jika ok : store site_id to local_stroge');
            // getValidationSite(site_oid);
            localStorage.setItem("activeSite", JSON.stringify(site_oid));

            try {
                getMonitoringSite(site_oid);

            }catch (e) {
                console.log("refresh !!");
            }

        });

    $('#search').keyup(function () {
        $('#jstree-ajax').jstree('search', $(this).val());
    });

    let alarmInterval;


    // initAlarmNotif();

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function delayNotif(total_alarm, alarm) {
        for (let i = 0; i < total_alarm; i++) {
            await sleep(1000);
            console.log('notif:', alarm[i].trap_name);

            let site_name = alarm[i].site_name;
            let alarm_name = alarm[i].trap_name;
            let state = alarm[i].status_alarm;

            showNotif(site_name,alarm_name, state);
        }

    }

    {{--function initAlarmNotif() {--}}

    {{--    // console.log('get alarm notif');--}}
    {{--    $.ajax({--}}
    {{--        url: '{{ route('alarm-notification') }}',--}}
    {{--        type: 'GET',--}}
    {{--        success: function (data) {--}}
    {{--            console.log('NOTIFICATION :', data);--}}
    {{--            // $('#total_alarm').text(data.total_alarm);--}}
    {{--            $('#total_alarm_warning').text(data.total_alarm_warning);--}}
    {{--            $('#total_alarm_major').text(data.total_alarm_major);--}}
    {{--            $('#total_alarm_minor').text(data.total_alarm_minor);--}}
    {{--            $('#total_alarm_critical').text(data.total_alarm_critical);--}}

    {{--            // console.log('new alarm = ', data.new_alarm);--}}
    {{--            if (data.new_alarm > 0) {--}}

    {{--                delayNotif(data.new_alarm, data.alarm);--}}

    {{--                // call alarm site only on monitoring--}}
    {{--                console.log('calll alarmSite for update imediately');--}}
    {{--                if (typeof alarmSite === 'function'){--}}
    {{--                    alarmSite();--}}
    {{--                }--}}

    {{--            } else {--}}
    {{--                console.log('no new alarm');--}}
    {{--            }--}}

    {{--        },--}}
    {{--        error: function (e) {--}}
    {{--            console.log('error:', e);--}}
    {{--        },--}}
    {{--    });--}}

    {{--    alarmInterval = setInterval(function () {--}}
    {{--        checkAlarmNotif();--}}
    {{--    }, 30000);--}}

    {{--}--}}

    function showNotif(site_name,alarm_name, state) {
        return $.gritter.add({
            title: "New Alarm !: "+site_name,
            text: alarm_name + "  " + state,
            fade_in_speed: 'medium',
            time: 10000,
        }), !1
    }

    {{--function checkAlarmNotif() {--}}

    {{--    $.ajax({--}}
    {{--        url: '{{ route('alarm-notification') }}',--}}
    {{--        type: 'GET',--}}
    {{--        success: function (data) {--}}
    {{--            console.log('NOTIFICATION :', data);--}}
    {{--            $('#total_alarm_warning').text(data.total_alarm_warning);--}}
    {{--            $('#total_alarm_major').text(data.total_alarm_major);--}}
    {{--            $('#total_alarm_minor').text(data.total_alarm_minor);--}}
    {{--            $('#total_alarm_critical').text(data.total_alarm_critical);--}}

    {{--            // console.log('new alarm = ', data.new_alarm);--}}
    {{--            if (data.new_alarm > 0) {--}}

    {{--                // console.log('show alarm');--}}
    {{--                delayNotif(data.new_alarm, data.alarm);--}}

    {{--                console.log('calll alarmSite for update imediately');--}}
    {{--                if (typeof alarmSite === 'function'){--}}
    {{--                    alarmSite();--}}
    {{--                }--}}

    {{--            } else {--}}
    {{--                console.log('no new alarm');--}}
    {{--            }--}}

    {{--        },--}}
    {{--        error: function (e) {--}}
    {{--            console.log('error:', e);--}}
    {{--        },--}}
    {{--    });--}}

    {{--}--}}

    {{--function draw_WarningAlarm() {--}}

    {{--    var warningTable = $('#new_warning_alarm_list').DataTable({--}}
    {{--        responsive: true,--}}
    {{--        processing: false,--}}
    {{--        serverSide: true,--}}
    {{--        searching: false,--}}
    {{--        scrollY: "200px",--}}
    {{--        scrollCollapse: true,--}}
    {{--        paging: false,--}}
    {{--        destroy: true,--}}
    {{--        order: [[4, "desc"]],--}}
    {{--        ajax: {--}}
    {{--            url: '{{ route('new-warning-alarm-list') }}',--}}
    {{--            type: 'GET',--}}
    {{--            tryCount: 1,--}}
    {{--            retryLimit: 3,--}}
    {{--            error: function (xhr, textStatus, errorThrown) {--}}
    {{--                if (textStatus === 'timeout') {--}}
    {{--                    this.tryCount++;--}}
    {{--                    if (this.tryCount <= this.retryLimit) {--}}
    {{--                        //try again--}}
    {{--                        $.ajax(this);--}}
    {{--                    }--}}
    {{--                } else {--}}
    {{--                    if (xhr.status === 500) {--}}
    {{--                        //handle error--}}
    {{--                        this.tryCount++;--}}
    {{--                        if (this.tryCount <= this.retryLimit) {--}}
    {{--                            //try again--}}
    {{--                            $.ajax(this);--}}
    {{--                        }--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            }--}}
    {{--        },--}}
    {{--        columns: [--}}
    {{--            // {data: 'region_oid', name: 'region_oid'},--}}
    {{--            {data: 'region.name', name: 'region.name'},--}}
    {{--            {data: 'site_name', name: 'site_name'},--}}
    {{--            // {data: 'site_id_label', name: 'site_id_label'},--}}
    {{--            {data: 'device_node_name', name: 'device_node_name'},--}}
    {{--            {data: 'ipaddress', name: 'ipaddress'},--}}
    {{--            {data: 'updated_at', name: 'updated_at'},--}}
    {{--            {data: 'trap_name', name: 'trap_name'},--}}
    {{--            // {data: 'severity_id', name: 'severity_id'},--}}
    {{--            {data: 'severity_name', name: 'severity_name'},--}}
    {{--            {data: 'status_alarm', name: 'status_alarm'},--}}
    {{--            // {data: 'temporaryalarm.total_alarm', name: 'temporaryalarm.total_alarm'},--}}
    {{--        ]--}}
    {{--    });--}}
    {{--}--}}

    {{--function draw_MajorAlarm() {--}}

    {{--    var majorTable = $('#new_major_alarm_list').DataTable({--}}
    {{--        responsive: true,--}}
    {{--        processing: false,--}}
    {{--        serverSide: true,--}}
    {{--        searching: false,--}}
    {{--        scrollY: "200px",--}}
    {{--        scrollCollapse: true,--}}
    {{--        paging: false,--}}
    {{--        destroy: true,--}}
    {{--        order: [[4, "desc"]],--}}
    {{--        ajax: {--}}
    {{--            url: '{{ route('new-major-alarm-list') }}',--}}
    {{--            type: 'GET',--}}
    {{--            tryCount: 1,--}}
    {{--            retryLimit: 3,--}}
    {{--            error: function (xhr, textStatus, errorThrown) {--}}
    {{--                if (textStatus === 'timeout') {--}}
    {{--                    this.tryCount++;--}}
    {{--                    if (this.tryCount <= this.retryLimit) {--}}
    {{--                        //try again--}}
    {{--                        $.ajax(this);--}}
    {{--                    }--}}
    {{--                } else {--}}
    {{--                    if (xhr.status === 500) {--}}
    {{--                        //handle error--}}
    {{--                        this.tryCount++;--}}
    {{--                        if (this.tryCount <= this.retryLimit) {--}}
    {{--                            //try again--}}
    {{--                            $.ajax(this);--}}
    {{--                        }--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            }--}}
    {{--        },--}}
    {{--        columns: [--}}
    {{--            // {data: 'region_oid', name: 'region_oid'},--}}
    {{--            {data: 'region.name', name: 'region.name'},--}}
    {{--            {data: 'site_name', name: 'site_name'},--}}
    {{--            // {data: 'site_id_label', name: 'site_id_label'},--}}
    {{--            {data: 'device_node_name', name: 'device_node_name'},--}}
    {{--            {data: 'ipaddress', name: 'ipaddress'},--}}
    {{--            {data: 'updated_at', name: 'updated_at'},--}}
    {{--            {data: 'trap_name', name: 'trap_name'},--}}
    {{--            // {data: 'severity_id', name: 'severity_id'},--}}
    {{--            {data: 'severity_name', name: 'severity_name'},--}}
    {{--            {data: 'status_alarm', name: 'status_alarm'},--}}
    {{--            // {data: 'temporaryalarm.total_alarm', name: 'temporaryalarm.total_alarm'},--}}
    {{--        ]--}}
    {{--    });--}}

    {{--}--}}

    {{--function draw_MinorAlarm() {--}}

    {{--    var minorTable = $('#new_minor_alarm_list').DataTable({--}}
    {{--        responsive: true,--}}
    {{--        processing: false,--}}
    {{--        serverSide: true,--}}
    {{--        searching: false,--}}
    {{--        scrollY: "200px",--}}
    {{--        scrollCollapse: true,--}}
    {{--        paging: false,--}}
    {{--        destroy: true,--}}
    {{--        order: [[4, "desc"]],--}}
    {{--        ajax: {--}}
    {{--            url: '{{ route('new-minor-alarm-list') }}',--}}
    {{--            type: 'GET',--}}
    {{--            tryCount: 1,--}}
    {{--            retryLimit: 3,--}}
    {{--            error: function (xhr, textStatus, errorThrown) {--}}
    {{--                if (textStatus === 'timeout') {--}}
    {{--                    this.tryCount++;--}}
    {{--                    if (this.tryCount <= this.retryLimit) {--}}
    {{--                        //try again--}}
    {{--                        $.ajax(this);--}}
    {{--                    }--}}
    {{--                } else {--}}
    {{--                    if (xhr.status === 500) {--}}
    {{--                        //handle error--}}
    {{--                        this.tryCount++;--}}
    {{--                        if (this.tryCount <= this.retryLimit) {--}}
    {{--                            //try again--}}
    {{--                            $.ajax(this);--}}
    {{--                        }--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            }--}}
    {{--        },--}}
    {{--        columns: [--}}
    {{--            // {data: 'region_oid', name: 'region_oid'},--}}
    {{--            {data: 'region.name', name: 'region.name'},--}}
    {{--            {data: 'site_name', name: 'site_name'},--}}
    {{--            // {data: 'site_id_label', name: 'site_id_label'},--}}
    {{--            {data: 'device_node_name', name: 'device_node_name'},--}}
    {{--            {data: 'ipaddress', name: 'ipaddress'},--}}
    {{--            {data: 'updated_at', name: 'updated_at'},--}}
    {{--            {data: 'trap_name', name: 'trap_name'},--}}
    {{--            // {data: 'severity_id', name: 'severity_id'},--}}
    {{--            {data: 'severity_name', name: 'severity_name'},--}}
    {{--            {data: 'status_alarm', name: 'status_alarm'},--}}
    {{--            // {data: 'temporaryalarm.total_alarm', name: 'temporaryalarm.total_alarm'},--}}
    {{--        ]--}}
    {{--    });--}}

    {{--}--}}

    {{--function draw_CriticalAlarm() {--}}

    {{--    var criticalTable = $('#new_critical_alarm_list').DataTable({--}}
    {{--        responsive: true,--}}
    {{--        processing: false,--}}
    {{--        serverSide: true,--}}
    {{--        searching: false,--}}
    {{--        scrollY: "200px",--}}
    {{--        scrollCollapse: true,--}}
    {{--        paging: false,--}}
    {{--        destroy: true,--}}
    {{--        order: [[4, "desc"]],--}}
    {{--        ajax: {--}}
    {{--            url: '{{ route('new-critical-alarm-list') }}',--}}
    {{--            type: 'GET',--}}
    {{--            tryCount: 1,--}}
    {{--            retryLimit: 3,--}}
    {{--            error: function (xhr, textStatus, errorThrown) {--}}
    {{--                if (textStatus === 'timeout') {--}}
    {{--                    this.tryCount++;--}}
    {{--                    if (this.tryCount <= this.retryLimit) {--}}
    {{--                        //try again--}}
    {{--                        $.ajax(this);--}}
    {{--                    }--}}
    {{--                } else {--}}
    {{--                    if (xhr.status === 500) {--}}
    {{--                        //handle error--}}
    {{--                        this.tryCount++;--}}
    {{--                        if (this.tryCount <= this.retryLimit) {--}}
    {{--                            //try again--}}
    {{--                            $.ajax(this);--}}
    {{--                        }--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            }--}}
    {{--        },--}}
    {{--        columns: [--}}
    {{--            {data: 'region.name', name: 'region.name'},--}}
    {{--            {data: 'site_name', name: 'site_name'},--}}
    {{--            {data: 'device_node_name', name: 'device_node_name'},--}}
    {{--            {data: 'ipaddress', name: 'ipaddress'},--}}
    {{--            {data: 'updated_at', name: 'updated_at'},--}}
    {{--            {data: 'trap_name', name: 'trap_name'},--}}
    {{--            {data: 'severity_name', name: 'severity_name'},--}}
    {{--            {data: 'status_alarm', name: 'status_alarm'},--}}
    {{--        ]--}}
    {{--    });--}}
    {{--}--}}


    {{--$('#warning_notif').on('show.bs.dropdown', function () {--}}
    {{--    draw_WarningAlarm();--}}
    {{--});--}}
    {{--$('#major_notif').on('show.bs.dropdown', function () {--}}
    {{--    draw_MajorAlarm();--}}
    {{--});--}}

    {{--$('#minor_notif').on('show.bs.dropdown', function () {--}}
    {{--    draw_MinorAlarm();--}}
    {{--});--}}

    {{--$('#critical_notif').on('show.bs.dropdown', function () {--}}
    {{--    draw_CriticalAlarm();--}}
    {{--});--}}

</script>

@yield('js')
</body>

</html>