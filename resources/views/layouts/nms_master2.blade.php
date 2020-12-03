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
    <title>{{ config('app.name', 'SINERGI') }}</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="nms,icon+2020,snmp monitoring" name="description"/>
    <meta content="haris hardianto" name="author"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">--}}

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
    <link href="{{ asset('/') }}css/essential.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/sweetalert2.css" rel="stylesheet"/>

    <link href="{{ asset('/') }}css/dataTables.bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/responsive.bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/bootstrap-select.css" rel="stylesheet"/>
    <link href="{{ asset('/') }}css/jquery.gritter.css" rel="stylesheet"/>

    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    {{--    <script src="assets/plugins/pace/pace.min.js"></script>--}}
    {{--    <link href="{{ asset('/') }}css/tree-style.css" rel="stylesheet"/>--}}
    <style>
        .dataTables_wrapper .dataTables_filter input{
            text-transform: uppercase;
        }
    </style>
@yield('css')

<!-- ================== END BASE JS ================== -->
</head>
<body class="  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in hide"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-without-sidebar page-header-fixed in">
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
                <button type="button" class="navbar-toggle p-0 m-r-5 collapsed"  data-toggle="dropdown" aria-expanded="false">
					    <span class="fa-stack fa-lg text-inverse">
                           {{-- <i class="fa fa-square-o fa-stack-2x m-t-2"></i>--}}
                            <i class="fa fa-th-large fa-stack-1x"></i>
                        </span>

                </button>
                {{--                todo: create separted file for included --}}
                @include('layouts._menu_to_pages')
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

{{--                    @if(Auth::user()->region_oid == 'admin')--}}
{{--                            @include('layouts._menu_to_pages')--}}
{{--                        @else--}}
{{--                            @include('layouts._user_region_menu_to_pages')--}}
{{--                        @endif                    --}}
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
            <ul class="nav navbar-nav navbar-right hidden-xs ">
                <li class="dropdown"><a href="#"><span class="h4 semi-bold">{{ config('app.name') }}</span></a></li>
                <li><a href="#"> {{ date('D , d F Y') }} | <span id="clockDisplay"> {{ date('H:i:s') }} &nbsp;</span> </a></li>
                <li class="hidden">
                    <form class="navbar-form full-width hidden-sm">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter keyword for search">
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </li>
{{--                @include('layouts._alarm_notification')--}}

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
    <!-- end #header -->

    <!-- begin #content -->
@yield('content')
{{--<div id="content" class="content">
    <!-- begin breadcrumb -->
--}}{{--        <ol class="breadcrumb pull-right">--}}{{--
--}}{{--            <li><a href="javascript:;">Home</a></li>--}}{{--
--}}{{--            <li><a href="javascript:;">Page Options</a></li>--}}{{--
--}}{{--            <li class="active">Page without Sidebar</li>--}}{{--
--}}{{--        </ol>--}}{{--
<!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">SURVAILANCE
        --}}{{--            <small>Updated at: 12-01-2020 11:11:11 WIB</small>--}}{{--
    </h1>



</div>--}}


<!-- end #content -->



    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->

    {{--footer--}}

    <div id="footer" class="footer fixed text-right ">
        © 2020 {{ config('app.name', 'SINERGI') }} - PT. BACH MULTI GLOBAL , All Rights Reserved
    </div>
    {{--footer--}}
</div>
<!-- end page container -->
<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('/') }}js/jquery-1.9.1.min.js"></script>
<script src="{{ asset('/') }}js/jquery-migrate-1.1.0.min.js"></script>
<script src="{{ asset('/') }}js/jquery-ui.min.js"></script>
<script src="{{ asset('/') }}js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="assets/crossbrowserjs/html5shiv.js"></script>
<script src="assets/crossbrowserjs/respond.min.js"></script>
<script src="assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="{{ asset('/') }}js/jquery.slimscroll.min.js"></script>
<script src="{{ asset('/') }}js/jquery.cookie.js"></script>
<script src="{{ asset('/') }}js/js.cookie.js"></script>
{{--<script src="{{ asset('/') }}js/jquery.sparkline.js"></script>--}}
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('/') }}js/app.js"></script>
<script src="{{ asset('/') }}js/sweetalert2.js"></script>
<script src="{{ asset('/') }}js/jquery.gritter.js"></script>

{{--<script src="{{ asset('/') }}js/jstree.min.js"></script>--}}
{{--<script src="{{ asset('/') }}js/ui_tree_demo.js"></script>--}}
{{--<script src="{{ asset('/') }}js/dashboard_demo.js"></script>--}}

<script src="{{ asset('/') }}js/jquery.dataTables.js"></script>
<script src="{{ asset('/') }}js/dataTables.bootstrap.min.js"></script>
<script src="{{ asset('/') }}js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/') }}js/bootstrap-select.js"></script>

@yield('js')
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function () {
        App.init();
        // TreeView.init();
        // Dashboard.init();

        var d = new Date(Date.UTC(<?php echo date('Y') . ',' . date('m') . ',' . date('d') . ',' . (date('H') - 7) . ',' . date('i') . ',' . date('s')    ?>));


        setInterval(function () {
            d.setSeconds(d.getSeconds() + 1);
            var h = d.getHours();
            var i = d.getMinutes();
            var s = d.getSeconds();
            if (h == 0) {
                h = 00;
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




</script>
</body>

</html>