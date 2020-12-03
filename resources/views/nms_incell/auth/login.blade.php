<!DOCTYPE html>
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
    <link href="{{ asset('/') }}css/theme/orange.css" rel="stylesheet" id="theme"/>
    <link href="{{ asset('/') }}css/essential.css" rel="stylesheet"/>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
{{--<script src="{{ asset('/') }}js/pace.min.js"></script>--}}
<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
<!-- begin #page-loader -->
{{--<div id="page-loader" class="fade in"><span class="spinner"></span></div>--}}
<!-- end #page-loader -->

<div class="login-cover">
        <div class="login-cover-image"><img src="{{ asset('/') }}/img/login-bg/{{ 'bg-'.rand(11,14).'.jpg' }}" data-id="login-cover-image" alt=""/></div>
{{--    <div class="login-cover-image"><img src="{{ asset('/') }}/img/login-bg/icon_bg.jpg" data-id="login-cover-image" alt=""/></div>--}}
    <div class="login-cover-bg"></div>
</div>
<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login login-v2" data-pageload-addclass="animated fadeIn">
        <!-- begin brand -->
        <div class="login-header">
            <div class="brand">
                {{--<img src="{{ asset('/') }}/img/login-bg/logo_icon2.png" alt="logo">--}} {{ config('app.name', 'SINERGI') }}
                <small>SITES MONITORING SYSTEM</small>
            </div>
            <div class="icon">
                <i class="fa fa-sign-in"></i>
                {{--<i class="fa fa-calendar-o"></i>--}}
            </div>
        </div>
        <!-- end brand -->
        <div class="login-content">
            <form action="{{ route('signin') }}" method="POST" class="margin-bottom-0">
                {{ csrf_field() }}
                <div class="form-group m-b-20 {{ $errors->has('username') ? ' has-error' : '' }}">
                    <input type="text" name="username" class="form-control input-lg" placeholder="Username" value="{{ old('username') }}" required/>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group m-b-20 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="form-control input-lg" placeholder="Password" value="{{ old('password') }}" required/>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="checkbox m-b-20">
                    <label>
                        <input type="checkbox"/> Remember Me
                    </label>
                </div>
                <div class="login-buttons">
                    <button type="submit" class="btn btn-warning btn-block btn-lg">Login</button>
                </div>
                <div class="m-t-20 text-center">
                    &copy;2020 | Powered By &nbsp;<a href="#">SINERGI TEKNOLOG UTAMA</a>.
                </div>
            </form>
        </div>
    </div>
    <!-- end login -->

    <ul class="login-bg-list clearfix hide">
        <li class=""><a href="#" data-click="change-bg"><img src="{{ asset('/') }}/img/login-bg/bg-13.jpg" alt=""/></a></li>
        <li class=""><a href="#" data-click="change-bg"><img src="{{ asset('/') }}/img/login-bg/bg-11.jpg" alt=""/></a></li>
        <li><a href="#" data-click="change-bg"><img src="{{ asset('/') }}/img/login-bg/bg-12.jpg" alt=""/></a></li>
        <li><a href="#" data-click="change-bg"><img src="{{ asset('/') }}/img/login-bg/bg-14.jpg" alt=""/></a></li>
        {{--        <li><a href="#" data-click="change-bg"><img src="{{ asset('/') }}/img/login-bg/bg-15.jpg" alt=""/></a></li>--}}
        {{--        <li><a href="#" data-click="change-bg"><img src="{{ asset('/') }}/img/login-bg/bg-16.jpg" alt=""/></a></li>--}}
    </ul>

    <!-- begin theme-panel -->
    <!-- end theme-panel -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('/') }}js/jquery-1.9.1.min.js"></script>
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
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('/') }}js/login_v2_demo.js"></script>
<script src="{{ asset('/') }}js/app.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function () {
        App.init();
        LoginV2.init();
    });
</script>
<script>
    var d = new Date(Date.UTC(<?php echo date('Y') . ',' . date('m') . ',' . date('d') . ',' . (date('H')-7) . ',' . date('i') . ',' . date('s')    ?>));


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
        $('#clockDisplay').text((h + ':' + i + ':' + s ));

    }, 1000);


    var time = new Date().getTime();
    $(document.body).bind("mousemove keypress", function (e) {
        time = new Date().getTime();
    });

    function refresh() {
        console.log('refresh page');
        if (new Date().getTime() - time >= 1200000)  // 20 Menit
            window.location.reload(true);
        else
            setTimeout(refresh, 10000);
    }

    setTimeout(refresh, 10000);


</script>
</body>
</html>