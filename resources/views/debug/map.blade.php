<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140796150-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-140796150-1');
        window.onerror = function (msg, url, lineNo, columnNo, error) {
            var string = msg.toLowerCase();
            var substring = "script error";
            if (string.indexOf(substring) > -1) {
                alert('Script Error: See Browser Console for Detail');
            } else {
                var message = [
                    'Message: ' + msg,
                    'URL: ' + url,
                    'Line: ' + lineNo,
                    'Column: ' + columnNo,
                    'Error object: ' + JSON.stringify(error)
                ].join(' - ');

                alert(message);
            }

            return false;
        };
    </script>

    <link rel="shortcut icon" href="https://safira.telkominfra.com/img/telkominfralogo.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="ui5i75PZg7cXjlszajH0o5AtNnz7lc0zlyqBDCa0">

    <title>LTSA</title>

    <!-- Styles -->
    <link href="https://nms.telkominfra.com/public/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body>
<style>
    #googleMap {
        height: 100% !important;
        width: 100% !important;
    }

    html, body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        font-family: 'Roboto', sans-serif;
    }

    div {
        white-space: nowrap;
    }

    .info-window {
        display: grid;
        width: auto;
        grid-template-columns: auto auto;
        grid-gap: 2px 5px;
        padding-bottom: 10px;
    }

    .table-window td {
        padding: 3px 5px;
    }

    .info-item {
        padding: 2px;
        font-size: 1em;
    }

    .navbar-default {
        /* background-color: #010917; */
        background: linear-gradient(90deg, rgba(1, 9, 48, 1) 75%, rgba(1, 9, 23, 1) 100%) !important;
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.7);
        border-color: transparent !important;
        color: white !important;
    }

    .navbar-text {
        color: white !important;
    }

    .nav-item a {
        border: 1px solid transparent;
        font-weight: bold;
        border-radius: 15px;
        margin: 10px 7px;
        padding: 5px 14px !important;
    }

    .nav-item a:hover {
        border: 1px solid #f92525;
    }

    .nav-item-active {
        background-color: #f92525;
    }

    .nav-item-active:hover {
        background-color: red !important;
        /* border: 1px solid blue; */
    }

    .logout-button {
        color: white !important;
        border: 1px solid red !important;
        border-radius: 15px;
        margin: 10px 7px;
        padding: 5px 14px !important;
    }

    .logout-button:hover {
        background-color: red !important;
    }

    /* SITE NAVIGATION STYLES */
    .status-green {
        background: #59EA12;
        width: 17px;
        height: 17px;
        border-radius: 50%;
        /*
        box-shadow: 0 0 5px rgba(0,255,0,0.6);
        -moz-box-shadow: 0 0 5px rgba(0,255,0,0.6);
        -webkit-box-shadow: 0 0 5px rgba(0,255,0,0.6);
        -o-box-shadow: 0 0 5px rgba(0,255,0,0.6);
        */
    }

    .status-red {
        background: #f92525;
        width: 17px;
        height: 17px;
        border-radius: 50%;
        /*
        box-shadow: 0 0 5px rgba(255, 0,0,0.6);
        -moz-box-shadow: 0 0 5px rgba(255, 0,0,0.6);
        -webkit-box-shadow: 0 0 5px rgba(255, 0,0,0.6);
        -o-box-shadow: 0 0 5px rgba(255, 0,0,0.6);
        */
    }

    @keyframes spinnerPanel {
        to {
            transform: rotate(360deg);
        }
    }

    .spinnerPanel:before {
        content: '';
        box-sizing: border-box;
        position: absolute;
        width: 50px;
        height: 50px;
        margin-left: 45vw;
        margin-top: 30vh;
        border-radius: 50%;
        border-top: 2px solid #07d;
        border-right: 2px solid transparent;
        animation: spinnerPanel .6s linear infinite;
        z-index: 1060;
    }

    .spinnerSmall:before {
        content: '';
        box-sizing: border-box;
        position: absolute;
        width: 50px;
        height: 50px;
        margin-left: 200px;
        margin-top: 75px;
        border-radius: 50%;
        border-top: 2px solid #07d;
        border-right: 2px solid transparent;
        animation: spinnerPanel .6s linear infinite;
        z-index: 1060;
    }

    .shadow {
        -moz-box-shadow: inset 0 0 10px #000000;
        -webkit-box-shadow: inset 0 0 10px #000000;
        box-shadow: inset 0 0 10px #000000;
    }

    .loader {
        position: fixed;
        z-index: 1060;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.2);
        transition: 0.5s;
    }

    .modal-header {
        border-bottom: 1px solid transparent;
        padding-bottom: 0px;
    }

    .btn-primary {
        color: mediumblue;
        background-color: transparent;
        border-color: #2a88bd;
    }

    .fa-spin {
        color: royalblue !important;
    }

    button.gm-ui-hover-effect img {
        width: 25px;
        height: 25px;
        margin-left: -8px;
    }

    .unit-info {
        color: #bbb !important;
    }

    a {
        color: inherit !important;
        text-decoration: inherit !important;
    }

    .unit-info-item {
        height: 25px;
        width: 50px;
        margin-right: -18px;
        text-align: right;
    }

    .btn-unit {
        height: 50px;
        width: 50px;
        color: #636b6f;
        font-size: 0.8em;
        padding: 5px 0px 0px 28px;
        vertical-align: top;
        text-align: left;
        font-weight: bold;
        font-size: 1.5em;
        border-radius: 0px !important;
        margin-right: 10px;
    }

    .btn-unit:hover {
        background-color: #e8e8e8 !important;
    }

    .btn-unit-action {
        margin: 2px 10px 2px 3px;
        font-size: 1.1em;
        font-weight: bold;
        padding: 4px 6px;
        background: #fff;
        /* border: 1px solid #2748FF; */
        color: #2748FF;
    }

    .btn-unit-action:visited {
        margin: 2px 10px 2px 3px;
        font-size: 1.1em;
        font-weight: bold;
        padding: 4px 6px;
        background: #fff;
        /* border: 1px solid #2748FF; */
        color: #2748FF;
    }

    .btn-unit-action-red {
        margin: 2px 10px 2px 3px;
        font-size: 1.1em;
        font-weight: bold;
        padding: 4px 6px;
        background: #fff;
        color: red;
    }

    .btn-unit-action-red:hover {
        color: white !important;
        background: red !important;
    }

    .unit-red {
        background: url(https://nms.telkominfra.com/public/img/unit-red.png) !important;
        background-position: 5px !important;
        background-size: 40% !important;
        background-repeat: no-repeat !important;
    }

    .unit-blue {
        background: url(https://nms.telkominfra.com/public/img/unit-blue.png);
        background-position: 5px !important;
        background-size: 40% !important;
        background-repeat: no-repeat !important;
    }

    .unit-green {
        background: url(https://nms.telkominfra.com/public/img/unit-green.png);
        background-position: 5px !important;
        background-size: 40% !important;
        background-repeat: no-repeat !important;
    }

    .unit-active {
        /* background-color: #2748FF !important; */
        border-bottom: 3px solid #1A73E8;
    }

    #button_genset {
        padding-left: 25px;
        border-bottom: 1px solid #EBEBEB;
        display: flex;
        flex-wrap: wrap;
        /* margin: 10px 20px 0xp 20px; */
        padding-left: 25px;
        border-bottom: 1px solid #EBEBEB;
    }

    button.gm-ui-hover-effect {

    }

    .engine-need-maintenance {
        background: url(https://nms.telkominfra.com/public/img/icon-warning-major.png) no-repeat center;
        height: 17px;
        width: 17px;
        margin-left: 10px;
    }

    .maintenance_sign {
        border: 1px solid #d6d2d2;
        padding: 2px 3px;
        font-size: 10px;
        font-weight: bold;
        background: #f1f1f1;
        margin-right: 5px;
        color: white;
    }

    button.close {
        font-size: 3.5em !important;
        margin-top: -15px !important;
        margin-right: -5px !important;
    }

    /* colors */
    .c-gray {
        color: #bbb;
    }

    .b-gray {
        background-color: #bbb;
    }

    .c-orange {
        color: #FF9800;
    }

    .b-orange {
        background-color: #FF9800;
    }

    .c-red {
        color: red;
    }

    .b-red {
        background-color: red;
    }


    .c-green {
        color: #009408 !important;
    }

    .b-green {
        background-color: #009408 !important;
    }

    .c-blue {
        color: #2748ff !important;
    }

    .b-blue {
        background-color: #2748ff !important;
    }


    .floating-panel {
        display: flex;
        position: fixed;
        bottom: 10px;
        left: 5px;
    }

    .input-group {
        position: fixed;
        top: 65px;
        left: 10px;
    }

    .hot-panel {
        text-align: center;
        width: auto;
        height: 125px;
        border-radius: 10px;
        /* background-color: rgba(255, 255, 255, 0.5); */
        background-color: rgba(0, 101, 255, 0.1);
        /* box-shadow: 0px 0px 3px rgba(0,0,0, 0.7); */
        margin: 0px 0px 15px 15px;
        padding: 10px 15px;
        cursor: pointer;
        color: white;
        line-height: 1.8em;
        grid-column-gap: 12px;
    }

    .panel-number {
        font-size: 1.6em;
        font-weight: bold;
        text-align: right;
    }

    .corrective-maintenance {
        width: 100%;
        margin: 15px;
        line-height: 2em;
    }

    .corrective-maintenance > td {
        width: 50%;
    }

    /* RESPONSIVE FOR MOBILE */

    @media only screen and (max-width: 600px) {
        .hot-panel {
            text-align: center;
            height: 70px;
            border-radius: 10px;
            padding: 5px;
            margin: 5px;
            cursor: pointer;
            font-size: 0.6em !important;
            grid-column-gap: 5px;
        }

        .floating-panel {
            bottom: 20px;
        }

        .logo-panel {
            text-align: center;
        }

        .table {
            font-size: 0.7em;
        }

        .panel-number {
            font-size: 1em;
        }

        .info-item {
            padding: 3px;
            font-size: 0.9em;
        }

        .btn-unit-action {
            font-size: 0.9em;
        }

        .big-detail {
            font-size: 1.2em !important;
        }
    }


    .hot-panel:hover {
        /* background-color: rgba(255, 255, 255, 0.7); */
        background-color: rgba(0, 101, 255, 0.5);
    }

    .big-detail {
        font-size: 1.5em;
        font-weight: bold;
    }

    .action-panel {
        display: flex;
        position: fixed;
        top: 65px;
        left: 10px;
    }

    .logo-panel {
        /* display: flex; */
        position: fixed;
        top: 8px;
        right: 50%;
        margin-right: -75px;
        z-index: 1040;
        background-color: white;
        height: 35px;
        padding: 5px 10px;
        border-radius: 25px;
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.7);
    }


    .input-group input {
        width: 220px;
        border-top-right-radius: 50px !important;
        border-bottom-right-radius: 50px !important;
        border: none;
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.7);
    }

    .input-group-addon {
        padding: 10px 15px;
        border-radius: 50px;
        border: none;
        width: 30px;
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.7);
    }

    .input-group-addon:hover {
        cursor: pointer;
    }

    .reset {
        position: fixed;
        top: 65px;
        right: 10px;
    }

    .reset .fa {
        background-color: white;
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.08);
        border-radius: 50px;
        height: 34px;
        width: 34px;
        font-size: 14px;
        text-align: center;
        line-height: 2.5;
        color: #555555;
    }

    .reset:hover {
        cursor: pointer;
        opacity: 0.9;
    }


    .fullscreen-button .fa {
        background-color: white;
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.08);
        border-radius: 50px;
        height: 34px;
        width: 34px;
        font-size: 14px;
        text-align: center;
        line-height: 2.5;
        color: #555555;
        margin-top: 10px;
    }

    .fullscreen-button:hover {
        cursor: pointer;
        opacity: 0.9;
    }

    .hide-sidebar-button .fa {
        background-color: white;
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.08);
        border-radius: 50px;
        height: 34px;
        width: 34px;
        font-size: 1.1em;
        text-align: center;
        line-height: 2.5;
        color: #555555;
        margin-top: 10px;
    }

    .hide-sidebar-button:hover {
        cursor: pointer;
        opacity: 0.9;
    }

    #inputSearch {
        transition: 0.25s;
        width: 200px;
    }

    td {
        vertical-align: middle !important;
    }

    .table-genset tr {
        display: flex;
        width: 100%;
    }

    .table-genset td {
        width: 33%;
    }

    .table-genset td:nth-child(2) {
        text-align: right;
    }

    .table-genset tbody {
        cursor: pointer;
        display: block;
        overflow-y: scroll;
        max-height: 45vh;
    }
</style>
<div style="position: absolute;width: 100%;" id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container" style="width: 100% !important;box-shadow: 0px 0px 3px rgba(0,0,0, 0.7);">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="#" style="font-size: 1.5em;font-weight: bold; color: white;">
                    LTSA
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                                <span href="#" style="color: white;display:flex;margin: 10px 7px;padding: 5px 14px !important;">
                                    <img src="https://nms.telkominfra.com/public/img/avatar.png" alt="avatar" style="height: 25px;margin-right:8px;">
                                    pln
                                </span>
                    </li>
                    <li class="nav-item">
                        <a href="https://nms.telkominfra.com/logout"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                           class="logout-button">
                            logout
                        </a>
                        <form id="logout-form" action="https://nms.telkominfra.com/logout" method="POST" style="display: none;">
                            <input type="hidden" name="_token" value="ui5i75PZg7cXjlszajH0o5AtNnz7lc0zlyqBDCa0">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</div>
<div id="googleMap">map fail to render, contact administrator</div>


<div class="input-group">
    <span class="input-group-addon"><i class="fa fa-search"></i></span>
    <input id="inputSearch" onfocus="$('input#inputSearch').css('width',document.body.clientWidth-110)" onblur="$('input#inputSearch').css('width','200px')"
           type="text" class="form-control typeahead" data-provide="typeahead" name="sitename" placeholder="Find Site ID or Site Name" autocomplete="off">
</div>
<div class="reset">
    <i class="fa fa-sync-alt fa-spin"></i>
</div>

<div class="floating-panel">
    <div class="hot-panel" style="font-size: 0.75em; display: grid;align-content: space-evenly; grid-template-columns: auto auto;text-align: left;">
        <table>
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
    <div class="hot-panel">
        <span class="big-detail" id="site-online">-</span>
        / <span id="site-total"> -</span><br>
        Site Connected<br>
        <span class="big-detail" id="genset-online">-</span>
        / <span id="genset-total">-</span><br>
        Unit Connected
    </div>
    <div class="hot-panel"
         style="font-size: 0.75em; display: grid;align-content: space-evenly; grid-template-columns: auto auto;text-align: left;align-items:center;">
        <table>
            <tbody>
            <tr>
                <td>
                    <div class="panel-number" id="genset_summary_running" style="margin: 4px">-</div>
                </td>
                <td> Unit Running</td>
            </tr>
            <tr>
                <td>
                    <div class="panel-number" id="genset_summary_off" style="margin: 4px">-</div>
                </td>
                <td> Unit Standby</td>
            </tr>
            <tr>
                <td>
                    <div class="panel-number" id="genset_summary_standby" style="margin: 4px">-</div>
                </td>
                <td> Unit Off</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="logo-panel">
    <img style="height: 100%;" src="https://nms.telkominfra.com/public/img/logo-pln.jpg" alt="pln">
    <img style="height: 100%;" src="https://nms.telkominfra.com/public/img/logo-telinfra.png" alt="telkom-infra">
</div>

<!-- Modal -->
<div id="modalSiteDetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="margin-left: 10px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="site-name">
                    <span style="font-weight: bold" class="site_name">loading..</span>
                    <span style="color: grey;font-size: 0.9em;">
                        <span class="site_id">loading..</span>
                    </span>
                </h4>
                <div style="color: #bbb">Unit Genset : <span class="genset_id" style="margin-right: 10px;">-</span> Serial number : <span
                            id="serial_number">-</span></div>
                <div style="color: #bbb">Last update : <span id="last_update">-</span></div>
            </div>
            <div class="modal-body" id="site_detail">
                <div class="row">
                    <div class="col-md-12">
                        <div id="loader-site-detail">
                            <br>
                            <center>loading..</center>
                            <br>
                        </div>
                        <div id="main-site-detail">
                            <div class="row" id="loader-site-header">
                                <br>
                                <center>loading button..</center>
                                <br>
                            </div>
                            <div id="site-header">
                                <div class="row">
                                    <div id="button_genset" class="button_genset">
                                        <center>loading button..</center>
                                    </div>
                                    <div id="button_action" style="display: flex;flex-wrap: wrap;margin: 5px 20px;">
                                    </div>
                                </div>
                                <table class="table table-hover table-genset">
                                    <thead style="display: block;">
                                    <tr>
                                        <th style="width: 33%">Parameter</th>
                                        <th colspan=2 style="width: 100%; text-align: center;padding-left: 30px;">Value</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody-preventive-maintenance-wrapper" data-dismiss="modal" data-toggle="modal"
                                           data-target="#modalMaintenanceDetail" style="display:none; overflow-y: hidden">
                                    <tr id="preventive_maintenance_onclick">
                                        <td>
                                            Preventive Maintenance
                                        </td>
                                        <td id="tosotomo_wrapper"
                                            colspan=2
                                            style="display: flex;width: 100%;justify-content: center;padding-left: 45px;">
                                            -
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tbody id="tbody-unit-value" data-dismiss="modal" data-toggle="modal" data-target="#modalParameterDetail"
                                           style="border: 0px;">
                                    <tr id="engine_run_time_onclick">
                                        <td>Engine Run Time</td>
                                        <td>
                                            <div id="maintenance_sign" style="display: flex;">

                                            </div>
                                            <span class="unit-value" id="engine_run_time"></span>
                                        </td>
                                        <td>hours</td>
                                    </tr>
                                    <tr id="engine_speed_onclick">
                                        <td>Engine Speed</td>
                                        <td><span class="unit-value" id="engine_speed"></span></td>
                                        <td>rpm</td>
                                    </tr>
                                    <tr id="gen_freq_onclick">
                                        <td>Genset Frequency</td>
                                        <td><span class="unit-value" id="gen_freq"></span></td>
                                        <td>Hz</td>
                                    </tr>
                                    <tr id="gen_volt_L1_L2_onclick">
                                        <td>Genset Volt L1 L2</td>
                                        <td><span class="unit-value" id="gen_volt_L1_L2"></span></td>
                                        <td>Volt AC</td>
                                    </tr>
                                    <tr id="gen_volt_L2_L3_onclick">
                                        <td>Genset Volt L2 L3</td>
                                        <td><span class="unit-value" id="gen_volt_L2_L3"></span></td>
                                        <td>Volt AC</td>
                                    </tr>
                                    <tr id="gen_volt_L3_L1_onclick">
                                        <td>Genset Volt L3 L1</td>
                                        <td><span class="unit-value" id="gen_volt_L3_L1"></span></td>
                                        <td>Volt AC</td>
                                    </tr>
                                    <tr id="gen_L1_current_onclick">
                                        <td>Genset L1 Current</td>
                                        <td><span class="unit-value" id="gen_L1_current"></span></td>
                                        <td>Amp. AC</td>
                                    </tr>
                                    <tr id="gen_L2_current_onclick">
                                        <td>Genset L2 Current</td>
                                        <td><span class="unit-value" id="gen_L2_current"></span></td>
                                        <td>Amp. AC</td>
                                    </tr>
                                    <tr id="gen_L3_current_onclick">
                                        <td>Genset L3 Current</td>
                                        <td><span class="unit-value" id="gen_L3_current"></span></td>
                                        <td>Amp. AC</td>
                                    </tr>
                                    <tr id="gen_total_VA_onclick">
                                        <td>Output KVA</td>
                                        <td><span class="unit-value" id="gen_total_VA"></span></td>
                                        <td>KVA</td>
                                    </tr>
                                    <tr id="gen_total_watt_onclick">
                                        <td>Output KWatt</td>
                                        <td><span class="unit-value" id="gen_total_watt"></span></td>
                                        <td>KWatt</td>
                                    </tr>
                                    <tr id="gen_total_Var_onclick">
                                        <td>Output KVAR</td>
                                        <td><span class="unit-value" id="gen_total_Var"></span></td>
                                        <td>KVAR</td>
                                    </tr>
                                    <tr id="gen_kvah_onclick">
                                        <td>Total KVA</td>
                                        <td><span class="unit-value" id="gen_kvah"></span></td>
                                        <td>KVAh</td>
                                    </tr>
                                    <tr id="gen_kwh_onclick">
                                        <td>Total KWatt</td>
                                        <td><span class="unit-value" id="gen_kwh"></span></td>
                                        <td>KWh</td>
                                    </tr>
                                    <tr id="gen_kvarh_onclick">
                                        <td>Total KVAR</td>
                                        <td><span class="unit-value" id="gen_kvarh"></span></td>
                                        <td>KVARh</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalParameterDetail" class="modal fade" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: flex;border-bottom: 1px solid transparent;padding-bottom: 0px;">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalSiteDetail"
                        onclick="$('#modalParameterDetail').modal('hide');">◀️ Back
                </button>
                <div style="text-align: right;width: 100%;">
                    <h5 class="modal-title">
                        <span style="font-weight: bold" class="site_name">site name</span>
                        <span style="color: grey;font-size: 0.9em;" class="site_id">-</span>
                    </h5>
                    <h4 class="modal-title">
                        <span style="font-weight: bold">Genset <span class="genset_id"></span></span>
                        -
                        <span class="parameter">parameter</span>
                    </h4>
                </div>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th class="parameter"></th>
                    </tr>
                    </thead>
                    <tbody id='site_detail_data'>
                    </tbody>
                </table>
                <center style="margin-top: -17px">For more data download data log
                    <button class="btn btn-xs" style="margin: 10px;"><a class="button-downloadcsv" href="http://153.92.4.172/mwinfra/api/download_csv"><i
                                    class="fas fa-file-download"></i> Quick Download</a></button>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalLogDetail" class="modal fade" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: flex;border-bottom: 1px solid transparent;padding-bottom: 0px;">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#modalSiteDetail">◀️ Back</button>
                <div style="text-align: right;width: 100%;">
                    <h4 class="modal-title">
                        <span style="font-weight: bold">Download Log Data</span>
                    </h4>
                    <h5 class="modal-title">
                        <span style="font-weight: bold" class="site_name">site name</span>
                        <span style="color: grey; font-size: 0.9em;" class="site_id">-</span>
                        , <span>Genset <span class="genset_id"></span>
                    </h5>
                </div>
            </div>
            <div class="modal-body">
                <button class="btn btn-md">
                    <i class="fas fa-file-download"></i> Quick Download
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalTroubleDetail" class="modal fade" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: flex;border-bottom: 1px solid transparent;padding-bottom: 0px;">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#modalSiteDetail">◀️ Back</button>
                <div style="text-align: right;width: 100%;">
                    <h4 class="modal-title">
                        <span style="font-weight: bold">Corrective History</span><br>
                    </h4>
                    <h5 class="modal-title">
                        <span style="font-weight: bold" class="site_name">site name</span>
                        <span style="color: grey;font-size: 0.9em;" class="site_id">-</span>
                        , <span>Genset <span class="genset_id"></span>
                    </h5>
                </div>
            </div>
            <div class="modal-body">
                <button class="btn btn-unit-action" data-dismiss="modal" data-toggle="modal" data-target="#modalAddCorrectiveMaintenance" type="button"><i
                            class="fas fa-plus-circle"></i> Add Corrective Report
                </button>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th colspan=2>Activity</th>
                    </tr>
                    </thead>
                    <tbody id='trouble_detail_data'>
                    <tr>
                        <td>23 July 2019 13:30</td>
                        <td>Monthly Periodic Maintenance</td>
                        <td>
                            <button
                                    class="btn btn-unit-action"
                                    onclick="Swal.fire({type: 'info', title: 'Check Detail', text: 'mengecek detail kejadian, fitur dalam pengembangan'})">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button
                                    class="btn btn-unit-action"
                                    onclick="Swal.fire({type: 'info', title: 'PRINT', text: 'membuka halaman baru untuk mencetak detail, fitur dalam pengembangan'})">
                                <i class="fas fa-print"></i>
                            </button>
                            <button
                                    class="btn btn-unit-action-red"
                                    onclick="Swal.fire({type: 'info', title: 'REMOVE', text: 'menghapus history, fitur dalam pengembangan'})">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                        </td>

                    </tr>
                    <tr>
                        <td colspan="3">No trouble report recorded yet</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalMaintenanceDetail" class="modal fade" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg" style="overflow: hidden;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: flex;border-bottom: 1px solid transparent;padding-bottom: 0px;">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#modalSiteDetail"
                        onclick="$('#modalParameterDetail').modal('hide');">◀️ Back
                </button>
                <div style="text-align: right;width: 100%;">
                    <h4 class="modal-title">
                        <span style="font-weight: bold">Maintenance Event</span><br>
                    </h4>
                    <h5 class="modal-title">
                        <span style="font-weight: bold" class="site_name">site name</span>
                        <span style="color: grey;font-size: 0.9em;" class="site_id">-</span>
                        , <span>Genset <span class="genset_id"></span>
                    </h5>
                </div>
            </div>
            <div class="modal-body" style="overflow-x: scroll;">
                <h5>Engine Running Hours Now : <span class="unit-value" id="latest_running_hours">-</span> Hours</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Level (Hours)</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id='trouble_detail_data'>
                    <tr>
                        <td><b>TO</b> (5000)</td>
                        <td id="preventive_maintenance_status_to">not reached yet</td>
                        <td id="preventive_maintenance_action_to"></td>
                    </tr>
                    <tr>
                        <td><b>SO</b> (10000)</td>
                        <td id="preventive_maintenance_status_so">not reached yet</td>
                        <td id="preventive_maintenance_action_so"></td>
                    </tr>
                    <tr>
                        <td><b>TO</b> (15000)</td>
                        <td id="preventive_maintenance_status_to_">not reached yet</td>
                        <td id="preventive_maintenance_action_to_"></td>
                    </tr>
                    <tr>
                        <td><b>MO</b> (20000)</td>
                        <td id="preventive_maintenance_status_mo">not reached yet</td>
                        <td id="preventive_maintenance_action_mo"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalSiteOnline" class="modal fade" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: flex;border-bottom: 1px solid transparent;padding-bottom: 0px;">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#modalSiteDetail">◀️ Back</button>
                <div style="text-align: right;width: 100%;">
                    <h5 class="modal-title">
                        <span style="font-weight: bold" class="site_name">site name</span>
                        <span style="color: grey;font-size: 0.9em;" class="site_id">-</span>
                    </h5>
                    <h4 class="modal-title">
                        <span style="font-weight: bold">Genset <span class="genset_id"></span></span>
                        -
                        <span class="parameter">parameter</span>
                    </h4>
                </div>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th class="parameter"></th>
                    </tr>
                    </thead>
                    <tbody id='site_detail_data'>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalAddCorrectiveMaintenance" class="modal fade" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: flex;border-bottom: 1px solid transparent;padding-bottom: 0px;">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#modalSiteDetail">◀️ Back</button>
                <div style="text-align: right;width: 100%;">
                    <h4 class="modal-title">
                        <span style="font-weight: bold">Corrective Maintenance</span><br>
                    </h4>
                    <h5 class="modal-title">
                        <span style="font-weight: bold" class="site_name">site name</span>
                        <span style="color: grey;font-size: 0.9em;" class="site_id">-</span>,
                        <span>Genset <span class="genset_id"></span>
                    </h5>
                </div>
            </div>
            <div class="modal-body">
                <table class="corrective-maintenance">
                    <tr>
                        <td style="font-weight: bold">No Unit / No Seri</td>
                        <td style="color: grey;font-size: 0.9em;">: 03 / 22062</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Merek / Type</td>
                        <td style="color: grey;font-size: 0.9em;">: MITSUBISHI S16R-PTA</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">Daya Terpasang</td>
                        <td style="color: grey;font-size: 0.9em;">: 1,240 kW</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold">JSB / JSMO</td>
                        <td style="color: grey;font-size: 0.9em;">: - Jam</td>
                    </tr>
                </table>
                <form>

                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Waktu Kejadian :</label>
                        <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Komponen SPD Rusak :</label>
                        <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Komponen yang Rusak :</label>
                        <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Gejala yang Timbul :</label>
                        <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Urutan Kejadian :</label>
                        <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Analisa Penyebab :</label>
                        <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Kesimpulan Kerusakan :</label>
                        <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Akibat Terhadap Sistem :</label>
                        <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Tindakan Penanggulangan :</label>
                        <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Rencana Perbaikan :</label>
                        <input type="text" class="form-control" id="" placeholder="" name="">
                    </div>
                    <div class="form-group" style="margin:  15px;">
                        <label class="control-label" for="">Pelapor :</label><br>
                        pln
                    </div>
                    <div class="form-group" style="padding:  15px;">
                        <button type="submit" style="width: 100%;" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Report</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://nms.telkominfra.com/public/js/app.js"></script>
<script>
    document.getElementById('googleMap').onerror = function (event) {
        alert(JSON.stringify(event))
    }
    // init function
    var map;

    function initMap() {
        var styledMapType = new google.maps.StyledMapType(
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
        map = new google.maps.Map(document.getElementById('googleMap'), {
            center: {lat: -0.7, lng: 117.6},
            zoom: xZoom,
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: false
        });
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
    }

    function setMarker(site_id, site_name, genset_unit, lat, lng, status, voltage, temperature, humidity) {

        // set infowindow detail
        var content = '<table class="table-window" style="margin-bottom: 10px;"><tbody>';
        content += '<tr><td>Site ID</td><td>:</td><td>' + site_id + '</td></tr>';
        content += '<tr><td>Site Name</td><td>:</td><td>' + site_name + '</td></tr>';
        content += '<tr><td>Genset ON (Total)</td><td>:</td><td>' + genset_unit + '</td></tr>';
        content += '</tbody></table>';
        content += '<table style="margin: auto;margin-bottom: 10px;">';
        content += '<tr><td style="padding-right: 12px;"><i class="fas fa-car-battery"></i> ' + makeOneDigitafterComma(voltage) + ' VDC </td>';
        content += '<td style="padding-right: 12px;"><i class="fas fa-thermometer-half"></i> ' + temperature + ' &#8451; </td>';
        content += '<td><i class="fas fa-tint"></i> ' + humidity + ' %</td></tr></table>';
        /*
        var content = '<div class="info-window"><div class="info-item">Site ID</div><div class="info-item">: '+site_id+'</div>';
        content += '<div class="info-item">Site Name</div><div class="info-item">: '+site_name+'</div>';
        content += '<div class="info-item">Genset ON (Total)</div><div class="info-item">: '+genset_unit+'</div></div>';
        content += '<div style="display: grid;grid-template-columns:auto auto auto; justify-content: space-evenly;align-items: center;margin-bottom: 10px;"><div style="margin-right: 5px;"><i class="fas fa-car-battery"></i> '+ makeOneDigitafterComma(voltage) +' VDC </div><div style="margin-right: 5px;"><i class="fas fa-thermometer-half"></i> '+temperature+' &#8451; </div><div><i class="fas fa-tint"></i> '+humidity+' %</div></div>';
        */
        var icon
        if (status == Number(3)) {
            icon = "https://nms.telkominfra.com/public/img/icon-circle-green.png"
            content += '<center><button data-dismiss="modal" data-toggle="modal" data-target="#modalSiteDetail" onclick=\'selectSite("' + site_id + '","' + site_id + '","' + genset_unit + '","' + site_name + '")\' class="btn btn-primary" style="margin-right: 15px;">Check Detail</button><button class="btn btn-danger" style="background: #fff;color:#F00;border: 1px solid #F00;" onclick="infowindow.close()">Close</button></center>';
        } else if (status == Number(2)) {
            icon = "https://nms.telkominfra.com/public/img/icon-circle-orange.png"
            content += '<center><button data-dismiss="modal" data-toggle="modal" data-target="#modalSiteDetail" onclick=\'selectSite("' + site_id + '","' + site_id + '","' + genset_unit + '","' + site_name + '")\' class="btn btn-primary" style="margin-right: 15px;">Check Detail</button><button class="btn btn-danger" style="background: #fff;color:#F00;border: 1px solid #F00" onclick="infowindow.close()">Close</button></center>';
        } else if (status == Number(1)) {
            icon = "https://nms.telkominfra.com/public/img/icon-circle-red.png"
            content += '<center><button data-dismiss="modal" data-toggle="modal" data-target="#modalSiteDetail" onclick=\'selectSite("' + site_id + '","' + site_id + '","' + genset_unit + '","' + site_name + '")\' class="btn btn-primary" style="margin-right: 15px;">Check Detail</button><button class="btn btn-danger" style="background: #fff;color:#F00;border: 1px solid #F00" onclick="infowindow.close()">Close</button></center>';
        } else {
            icon = "https://nms.telkominfra.com/public/img/icon-circle-grey.png";
            content += '<center><div style="margin: 10px; font-size: 14px; border-radius: 5px; background-color: rgb(197, 197, 197); padding: 10px;width: 100px">Site Offline</div></center>';
        }

        // init marker
        var iconMarker = new google.maps.Marker({
            position: {lat: Number(lat), lng: Number(lng)},
            map: map,
            icon: icon
        });

        infowindow = new google.maps.InfoWindow();

        google.maps.event.addListener(iconMarker, 'click', (function (iconMarker, i) {
            return function () {
                infowindow.setContent(content);
                infowindow.open(map, iconMarker);
            }
        })(iconMarker, i));
    };

    function focusMapView(lat, long, site_id) {
        console.log('focusMapView ' + site_id + ' - ' + Date.now())
        map.setZoom(10);
        var center = new google.maps.LatLng(lat, long);
        map.panTo(center);
        console.log('end execution ' + site_id + ' - ' + Date.now());
    }

    let stack

    function get_site_locs() {
        $.ajax({
            type: "GET",
            url: "https://nms.telkominfra.com/api/get_site_locs",
            success: function (result) {
                result = JSON.parse(result)
                markerEventArr = [];
                if (result) {
                    obj = result.data;
                    for (i = 0; i < obj.length; i++) {
                        setMarker(
                            obj[i]['site_id_camelcase'],
                            obj[i]['site_name'],
                            obj[i]['healthy'],
                            obj[i]['lat'],
                            obj[i]['long'],
                            obj[i]['status'],
                            obj[i]['voltage'],
                            obj[i]['temperature'],
                            obj[i]['humidity']
                        )
                    }
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Network Error',
                        text: 'Refresh Page or Contact Server Administrator'
                    })
                }
            }
        }).done(function () {
            $('.fa-sync-alt').removeClass('fa-spin')
        });
    }

    function get_site_summary() {
        $.ajax({
            type: "GET",
            url: "https://nms.telkominfra.com/api/site_summary",
            success: function (result) {
                obj = JSON.parse(result)
                if (JSON.parse(result)) {
                    stack = obj;
                    $('#site-online').html(obj.data[0].site_online)
                    $('#site-total').html(obj.data[0].site_total)
                    $('#genset-online').html(Number(obj.data[0].genset_online))
                    $('#genset-total').html(obj.data[0].genset_total)
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Network Error',
                        text: 'Refresh Page or Contact Server Administrator'
                    })
                }
            }
        });
    }

    function get_all_genset_status_summary() {
        $.ajax({
            type: "GET",
            url: "https://nms.telkominfra.com/api/all_genset_status_summary",
            success: function (result) {
                obj = JSON.parse(result)
                if (obj) {
                    $('#genset_summary_running').html(obj.data.running)
                    $('#genset_summary_standby').html(obj.data.standby)
                    $('#genset_summary_off').html(obj.data.off)
                    $('#genset_summary_need_maintenance').html(obj.data.need_maintenance)
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Network Error',
                        text: 'Refresh Page or Contact Server Administrator'
                    })
                }
            }
        });
    }


    // stack.get = get_site_summary

    $(".reset").click(function () {
        $('.fa-sync-alt').addClass('fa-spin')
        // initMap();
        if (typeof infowindow !== 'undefined') {
            infowindow.close()
        }
        map.setZoom(5);
        var center = new google.maps.LatLng(-0.7, 117.6);
        map.panTo(center);
        get_site_locs()
        get_site_summary()
        get_all_genset_status_summary()
        console.log(Date() + ' refreshing data')
    });


    // execute function
    console.log(Date())
    get_site_locs()
    get_site_summary()
    get_all_genset_status_summary()

    setInterval(function () {
        // initMap();
        console.log(Date() + ' system auto refresh')
        $('.fa-sync-alt').addClass('fa-spin')
        get_site_locs()
        get_site_summary()
        get_all_genset_status_summary()
    }, 1200000);
    // }, 60000);
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>

    // search box site id on map
    var $input = $(".typeahead");
    $input.typeahead({
        source: function (query, process) {
            return $.get('https://nms.telkominfra.com/api/site_list', {query: query}, function (data) {
                // console.log(data)
                return process(data);
            });
        },
        // autoSelect: true
    });

    $input.change(function (event) {
        var current = $input.typeahead("getActive");
        $.ajax({
            type: "GET",
            // url: "https://nms.telkominfra.com/api/get_site_locs/&quot;+current.id+&quot;",
            url: "https://nms.telkominfra.com/api/get_site_locs/" + current.id + "",
            success: function (result) {
                get = JSON.parse(result);
                if (get) {
                    obj = get.data[0];
                    if (obj.long == null || obj.lat == null) {
                        alert('Site coordinate invalid, please contact developer and check master data');
                    } else {
                        infowindow.close();
                        focusMapView(obj.lat, obj.long, obj.site_id)
                    }
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Network Error',
                        text: 'Refresh Page or Contact Server Administrator'
                    })
                }
            }
        });

    });

    // functions on site navigation
    function selectSite(site_id, site_id_camelcase, genset_unit, site_name) {
        $.ajax({
            type: 'GET',
            url: 'https://nms.telkominfra.com/api/site/' + site_id + '/1',
            beforeSend: function () {
                $('#app').before('<div class="loader spinnerPanel shadow"></div>');
                $('#button_genset').html('<center>loading button..</center>')
                $('#site-header').hide()
                $('#loader-site-header').show()
                $('#main-site-detail').hide()
                $('#loader-site-detail').show()

            },
            success: function (data) {
                obj = JSON.parse(data)
                if (obj) {
                    $('.genset_id').html('1')
                    $('.site_name').html(site_name)
                    $('.site_id').html(site_id)
                    getGensetList(site_id)
                } else {
                    $('#modalSiteDetail').modal('hide');
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'Network Error or Site not Available'
                    })
                }
            },
            error: function (e) {
                $('#main-site-detail').show()
                $('#loader-site-detail').hide()
                $('#site-header').show()
                $('#loader-site-header').hide()
                $('.loader').remove()
                $('#modalSiteDetail').modal('hide')
                Swal.fire({
                    type: 'error',
                    title: 'Sorry',
                    text: 'Network Error ' + e
                })
            }
        }).done(function () {
            selectGenset(site_id, 1)
            $('#main-site-detail').show()
            $('#loader-site-detail').hide()
            $('#site-header').show()
            $('#loader-site-header').hide()
            $('.loader').remove()
        });
    }

    function selectGenset(site, genset) {
        $.ajax({
            type: 'GET',
            url: "https://nms.telkominfra.com/api/site/" + site + '/' + genset,
            beforeSend: function () {
                $('#main-site-detail').hide();
                $('#loader-site-detail').show();
                $('#site-header').hide();
                $('#loader-site-header').show();
                $('#app').before('<div class="loader spinnerPanel shadow"></div>');

                $('#engine_speed_onclick').off()
                $('#gen_freq_onclick').off()
                $('#gen_volt_L1_L2_onclick').off()
                $('#gen_volt_L2_L3_onclick').off()
                $('#gen_volt_L3_L1_onclick').off()
                $('#gen_L1_current_onclick').off()
                $('#gen_L2_current_onclick').off()
                $('#gen_L3_current_onclick').off()
                $('#gen_total_watt_onclick').off()
                $('#gen_total_Var_onclick').off()
                $('#gen_total_VA_onclick').off()
                $('#engine_run_time_onclick').off()
                $('#gen_kwh_onclick').off()
                $('#gen_kvah_onclick').off()
                $('#gen_kvarh_onclick').off()
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj) {
                    obj = obj.data[0];

                    // jika alat monitoring sudah tidak kirim data > 72 jam, munculkan nilai 0 semua
                    if (obj.is_connected == 0) {
                        $('.unit-value').html(0);
                        // $('.unit-active').addClass('unit-red')
                        console.log('data not update: ' + obj.updated_at);
                    }
                    // cek level user
                    $("#tbody-preventive-maintenance-wrapper").hide();

                    $(".button-downloadcsv").attr('href', 'http://153.92.4.172/mwinfra/api/download_csv/' + site + '/' + genset)
                    $('.genset_id').html(genset)
                    gensetOffset = genset - 1
                    $(".btn").removeClass("unit-active")
                    $("#button_genset .btn:eq(" + gensetOffset + ")").addClass("unit-active")
                    $('#serial_number').html(obj.serial_number)
                    update_detail = obj.last_update + ' (' + obj.last_update_formated + ' WIB)'
                    $('#last_update').html(update_detail)
                    $('#engine_run_time').html(thousandsSeparators(obj.engine_run_time, false))

                    // add onclick eventListener to all parameter
                    $('#engine_speed_onclick').on("click", {site: site, genset: genset, parameter: 'engine_speed'}, showParameterData)
                    $('#gen_freq_onclick').on("click", {site: site, genset: genset, parameter: 'gen_freq'}, showParameterData)
                    $('#gen_volt_L1_L2_onclick').on("click", {site: site, genset: genset, parameter: 'gen_volt_L1_L2'}, showParameterData)
                    $('#gen_volt_L2_L3_onclick').on("click", {site: site, genset: genset, parameter: 'gen_volt_L2_L3'}, showParameterData)
                    $('#gen_volt_L3_L1_onclick').on("click", {site: site, genset: genset, parameter: 'gen_volt_L3_L1'}, showParameterData)
                    $('#gen_L1_current_onclick').on("click", {site: site, genset: genset, parameter: 'gen_L1_current'}, showParameterData)
                    $('#gen_L2_current_onclick').on("click", {site: site, genset: genset, parameter: 'gen_L2_current'}, showParameterData)
                    $('#gen_L3_current_onclick').on("click", {site: site, genset: genset, parameter: 'gen_L3_current'}, showParameterData)
                    $('#gen_total_watt_onclick').on("click", {site: site, genset: genset, parameter: 'gen_total_watt'}, showParameterData)
                    $('#gen_total_Var_onclick').on("click", {site: site, genset: genset, parameter: 'gen_total_Var'}, showParameterData)
                    $('#gen_total_VA_onclick').on("click", {site: site, genset: genset, parameter: 'gen_total_VA'}, showParameterData)
                    $('#engine_run_time_onclick').on("click", {site: site, genset: genset, parameter: 'engine_run_time'}, showParameterData)
                    $('#gen_kwh_onclick').on("click", {site: site, genset: genset, parameter: 'gen_kwh'}, showParameterData)
                    $('#gen_kvah_onclick').on("click", {site: site, genset: genset, parameter: 'gen_kvah'}, showParameterData)
                    $('#gen_kvarh_onclick').on("click", {site: site, genset: genset, parameter: 'gen_kvarh'}, showParameterData)
                    // tr_list = document.getElementById('tbody-unit-value').children
                    // for(i = 0; i < tr_list.length; i++){
                    // now = tr_list[i];
                    // if(now.id){
                    // () => {now.addEventListener("click", showParameterData(
                    // site,
                    // genset,
                    // now.id.replace('_onclick',''),
                    // now.children[0].innerText
                    // ));}
                    // }
                    // }
                    $('#engine_speed').html(thousandsSeparators(obj.engine_speed, false))
                    $('#gen_freq').html(thousandsSeparators(obj.gen_freq))
                    $('#gen_volt_L1_L2').html(thousandsSeparators(obj.gen_volt_L1_L2, false))
                    $('#gen_volt_L2_L3').html(thousandsSeparators(obj.gen_volt_L2_L3, false))
                    $('#gen_volt_L3_L1').html(thousandsSeparators(obj.gen_volt_L3_L1, false))
                    $('#gen_L1_current').html(thousandsSeparators(obj.gen_L1_current, false))
                    $('#gen_L2_current').html(thousandsSeparators(obj.gen_L2_current, false))
                    $('#gen_L3_current').html(thousandsSeparators(obj.gen_L3_current, false))
                    $('#gen_total_VA').html(thousandsSeparators(obj.gen_total_VA))
                    $('#gen_total_watt').html(thousandsSeparators(obj.gen_total_watt))
                    $('#gen_total_Var').html(thousandsSeparators(obj.gen_total_Var))
                    $('#gen_kvah').html(thousandsSeparators(obj.gen_kvah))
                    $('#gen_kwh').html(thousandsSeparators(obj.gen_kwh))
                    $('#gen_kvarh').html(thousandsSeparators(obj.gen_kvarh))
                } else {
                    $('#modalSiteDetail').modal('hide');
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'Network Error or Unit not Available'
                    })
                }
            },
            error: function (e) {
                Swal.fire({
                    type: 'error',
                    title: 'Sorry',
                    text: 'Network Error ' + e
                })
                $('#main-site-detail').show()
                $('#loader-site-detail').hide()
                $('#site-header').show()
                $('#loader-site-header').hide()
                $('.loader').remove()
                // hide modal after error
                $('#modalParameterDetail').modal('toggle')
            }
        }).done(function () {
            $('#main-site-detail').show()
            $('#loader-site-detail').hide()
            $('#site-header').show()
            $('#loader-site-header').hide()
            $('.loader').remove()
        });
    }

    function showParameterData(event) {
        let site = event.data.site;
        let genset = event.data.genset;
        let parameter = event.data.parameter;
        $.ajax({
            type: 'GET',
            url: "https://nms.telkominfra.com" + '/api/site/' + site + '/' + genset + '/' + parameter,
            beforeSend: function () {
                $('#site_detail_data').html('<tr><td colspan=2><br><center>loading..</center></td></tr>')
                $('#app').before('<div class="loader spinnerPanel shadow"></div>');
                console.log(site, genset, parameter);
            },
            success: function (data) {
                obj = JSON.parse(data)
                if (obj) {
                    var html = ''
                    var satuan = ''
                    switch (parameter) {
                        case 'temperature':
                            satuan = ' &#8451;'
                            parameter_name = 'Temperature';
                            break;
                        case 'voltage':
                            satuan = ' Volt DC';
                            parameter_name = 'Voltage';
                            break;
                        case 'humidity':
                            satuan = ' %'
                            parameter_name = 'Humidity';
                            break;
                        case 'engine_speed':
                            satuan = ' rpm'
                            parameter_name = 'Engine Speed';
                            break;
                        case 'gen_freq':
                            satuan = ' Hz'
                            parameter_name = 'Genset Frequency';
                            break;
                        case 'engine_run_time':
                            satuan = ' Hours'
                            parameter_name = 'Engine Run Time';
                            break;
                        case 'gen_volt_L1_L2':
                            satuan = ' Volt AC';
                            parameter_name = 'Genset Volt L1 L2';
                            break;
                        case 'gen_volt_L2_L3':
                            satuan = ' Volt AC'
                            parameter_name = 'Genset Volt L2 L3';
                            break;
                        case 'gen_volt_L3_L1':
                            satuan = ' Volt AC'
                            parameter_name = 'Genset Volt L3 L1';
                            break;
                        case 'gen_L1_current':
                            satuan = ' Amp. AC'
                            parameter_name = 'Genset L1 Current';
                            break;
                        case 'gen_L2_current':
                            satuan = ' Amp. AC'
                            parameter_name = 'Genset L2 Current';
                            break;
                        case 'gen_L3_current':
                            satuan = ' Amp. AC'
                            parameter_name = 'Genset L3 Current';
                            break;
                        case 'gen_total_watt':
                            satuan = ' KWatt'
                            parameter_name = 'Total KWatt';
                            break;
                        case 'gen_total_VA':
                            satuan = ' KVAR'
                            parameter_name = 'Total KVA';
                            break;
                        case 'gen_total_Var':
                            satuan = ' KVA';
                            parameter_name = 'Total KVAR';
                            break;
                        case 'gen_kwh':
                            satuan = ' KWh';
                            parameter_name = 'Output KWatt';
                            break;
                        case 'gen_kvah':
                            satuan = ' KVARh';
                            parameter_name = 'Output KVA';
                            break;
                        case 'gen_kvarh':
                            satuan = ' KVAh'
                            parameter_name = 'Output KVAR';
                            break;
                        default:
                            satuan = ''
                    }
                    for (i = 0; i < obj.data.length; i++) {
                        switch (parameter) {
                            case 'engine_speed':
                                value = thousandsSeparators(obj.data[i].value, false)
                                break;
                            case 'gen_freq':
                                value = thousandsSeparators(obj.data[i].value)
                                break;
                            case 'engine_run_time':
                                value = thousandsSeparators(obj.data[i].value, false)
                                break;
                            case 'gen_volt_L1_L2':
                                value = thousandsSeparators(obj.data[i].value, false)
                                break;
                            case 'gen_volt_L2_L3':
                                value = thousandsSeparators(obj.data[i].value, false)
                                break;
                            case 'gen_volt_L3_L1':
                                value = thousandsSeparators(obj.data[i].value, false)
                                break;
                            case 'gen_L1_current':
                                value = thousandsSeparators(obj.data[i].value, false)
                                break;
                            case 'gen_L2_current':
                                value = thousandsSeparators(obj.data[i].value, false)
                                break;
                            case 'gen_L3_current':
                                value = thousandsSeparators(obj.data[i].value, false)
                                break;
                            case 'gen_total_watt':
                                value = thousandsSeparators(obj.data[i].value)
                                break;
                            case 'gen_total_VA':
                                value = thousandsSeparators(obj.data[i].value)
                                break;
                            case 'gen_total_Var':
                                value = thousandsSeparators(obj.data[i].value)
                                break;
                            case 'gen_kwh':
                                value = thousandsSeparators(obj.data[i].value)
                                break;
                            case 'gen_kvah':
                                value = thousandsSeparators(obj.data[i].value)
                                break;
                            case 'gen_kvarh':
                                value = thousandsSeparators(obj.data[i].value)
                                break;
                            default:
                                satuan = ''
                        }
                        html += '<tr><td>' + obj.data[i].created_at.substring(0, 16) + '</td><td>' + value + ' ' + satuan + '</td></tr>'
                    }
                    $('.parameter').html(parameter_name)
                    $('#site_detail_data').html(html)
                } else {
                    $('#modalSiteDetail').modal('hide');
                    $('#modalParameterDetail').modal('hide')
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'Network Error or Unit not Available'
                    })
                }
            },
            error: function (e) {
                $('.loader').remove()
                Swal.fire({
                    type: 'error',
                    title: 'Sorry',
                    text: 'Network Error'
                })
                $('#modalParameterDetail').modal('hide')
            }
        }).done(function () {
            $('.loader').remove()
        });
    }

    // let get_data
    function getGensetList(site_id) {
        $.getJSON("https://nms.telkominfra.com/api/genset_list/" + site_id, function (result) {
            // SELECT GENSET BUTTON PART
            var html_button = ''
            $.each(result.data, function (i, field) {
                if (this.status == 3) {
                    genset_status = 'unit-green' // ok / normal
                } else if (this.status == 2) {
                    genset_status = 'unit-blue'
                } else if (this.status == 1) { // standby (engine speed off)
                    genset_status = 'unit-red'
                } else if (this.status == 0) { // disconnect
                    genset_status = 'unit-gray'
                }
                html_button += '<button  onclick=\'selectGenset("' + site_id + '",' + this.gen_id + ')\' type="button" class="btn ' + genset_status + ' btn-unit " >' + this.gen_id + '</button>'
            });
            action_button = ' <button type="button" class="btn btn-unit-action" >'
            action_button += '<a class="button-downloadcsv" href="http://153.92.4.172/mwinfra/api/download_csv/' + site_id + '/1">'
            action_button += '<i class="fas fa-file-download"></i>'
            action_button += ' Download Data Log</a></button>'
            // di hide buat user operator nanti
            $('#button_genset').html(html_button)
            $('#button_action').html(action_button)
            $("#button_genset .btn:eq('0')").addClass("unit-active")
        });
    }

    function clearMaintenanceSignColor(level = 'all') {
        if (level == 'all') {
            $('#to').removeClass('b-orange').removeClass('b-red').removeClass('b-green').removeClass('b-blue');
            $('#so').removeClass('b-orange').removeClass('b-red').removeClass('b-green').removeClass('b-blue');
            $('#to_').removeClass('b-orange').removeClass('b-red').removeClass('b-green').removeClass('b-blue');
            $('#mo').removeClass('b-orange').removeClass('b-red').removeClass('b-green').removeClass('b-blue');
        } else {
            $('#' + level).removeClass('b-orange').removeClass('b-red').removeClass('b-green').removeClass('b-blue');
        }
    }

    var jos

    function renderPreventiveMaintenanceJourney(site_id, gen_id) {
        $.getJSON("https://nms.telkominfra.com/api/preventive_maintenance_journey/" + site_id + "/" + gen_id, function (result) {
            console.log(result)
            if (result.data) {

                obj = result.data[0];
                if (obj.engine_run_time == 0) {
                    $('#latest_running_hours').html('unknown');
                } else {
                    $('#latest_running_hours').html(thousandsSeparators(obj.latest_engine_run_time, false));
                }
                // get the final status of preventive maintenance
                reached_score = obj.to_reached_status + obj.so_reached_status + obj.to2_reached_status + obj.mo_reached_status
                maintained_score = obj.to_maintained_status + obj.so_maintained_status + obj.to2_maintained_status + obj.mo_maintained_status
                console.log('score reached:' + reached_score + ' maintained:' + maintained_score)
                // render the default tosotomo template
                tosotomo_html = '<div id="to" class="maintenance_sign">TO</div><div id="so" class="maintenance_sign">SO</div><div id="to_" class="maintenance_sign">TO</div><div id="mo" class="maintenance_sign">MO</div>'
                $('#tosotomo_wrapper').html(tosotomo_html)
                // render the tosotomo status to template
                status_need_maintenance = '<i class="fas fa-exclamation-triangle c-orange"></i> Need Maintenance'
                // operator = 'pln'
                operator = 'Kinkin'
                button_start_maintenance_to = '<button class="btn btn-xs btn-default" onclick=\'update_maintenance_popup("' + site_id + '","' + gen_id + '","to","' + operator + '",1)\'>start maintenance</button>'
                button_start_maintenance_so = '<button class="btn btn-xs btn-default" onclick=\'update_maintenance_popup("' + site_id + '","' + gen_id + '","so","' + operator + '",1)\'>start maintenance</button>'
                button_start_maintenance_to_ = '<button class="btn btn-xs btn-default" onclick=\'update_maintenance_popup("' + site_id + '","' + gen_id + '","to2","' + operator + '",1)\'>start maintenance</button>'
                button_start_maintenance_mo = '<button class="btn btn-xs btn-default" onclick=\'update_maintenance_popup("' + site_id + '","' + gen_id + '","mo","' + operator + '",1)\'>start maintenance</button>'
                button_finish_maintenance_to = '<button class="btn btn-xs btn-default" onclick=\'update_maintenance_popup("' + site_id + '","' + gen_id + '","to","' + operator + '",2)\'>finish maintenance</button>'
                button_finish_maintenance_so = '<button class="btn btn-xs btn-default" onclick=\'update_maintenance_popup("' + site_id + '","' + gen_id + '","so","' + operator + '",2)\'>finish maintenance</button>'
                button_finish_maintenance_to_ = '<button class="btn btn-xs btn-default" onclick=\'update_maintenance_popup("' + site_id + '","' + gen_id + '","to2","' + operator + '",2)\'>finish maintenance</button>'
                button_finish_maintenance_mo = '<button class="btn btn-xs btn-default" onclick=\'update_maintenance_popup("' + site_id + '","' + gen_id + '","mo","' + operator + '",2)\'>finish maintenance</button>'

                switch (reached_score) {
                    case 1:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-orange')
                        $('#so').addClass('b-gray')
                        $('#to_').addClass('b-gray')
                        $('#mo').addClass('b-gray')
                        $('#preventive_maintenance_status_to').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to').html(button_start_maintenance_to)
                        break;
                    case 2:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-red')
                        $('#so').addClass('b-gray')
                        $('#to_').addClass('b-gray')
                        $('#mo').addClass('b-gray')
                        $('#preventive_maintenance_status_to').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to').html(button_start_maintenance_to)
                        break;
                    case 3:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-red')
                        $('#so').addClass('b-orange')
                        $('#to_').addClass('b-gray')
                        $('#mo').addClass('b-gray')
                        $('#preventive_maintenance_status_to').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to').html(button_start_maintenance_to)
                        $('#preventive_maintenance_status_so').html(status_need_maintenance)
                        $('#preventive_maintenance_action_so').html(button_start_maintenance_so)
                        break;
                    case 4:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-red')
                        $('#so').addClass('b-red')
                        $('#to_').addClass('b-gray')
                        $('#mo').addClass('b-gray')
                        $('#preventive_maintenance_status_to').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to').html(button_start_maintenance_to)
                        $('#preventive_maintenance_status_so').html(status_need_maintenance)
                        $('#preventive_maintenance_action_so').html(button_start_maintenance_so)
                        break;
                    case 5:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-red')
                        $('#so').addClass('b-red')
                        $('#to_').addClass('b-orange')
                        $('#mo').addClass('b-gray')
                        $('#preventive_maintenance_status_to').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to').html(button_start_maintenance_to)
                        $('#preventive_maintenance_status_so').html(status_need_maintenance)
                        $('#preventive_maintenance_action_so').html(button_start_maintenance_so)
                        $('#preventive_maintenance_status_to_').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to_').html(button_start_maintenance_to_)
                        break;
                    case 6:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-red')
                        $('#so').addClass('b-red')
                        $('#to_').addClass('b-red')
                        $('#mo').addClass('b-gray')
                        $('#preventive_maintenance_status_to').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to').html(button_start_maintenance_to)
                        $('#preventive_maintenance_status_so').html(status_need_maintenance)
                        $('#preventive_maintenance_action_so').html(button_start_maintenance_so)
                        $('#preventive_maintenance_status_to_').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to_').html(button_start_maintenance_to_)
                        break;
                    case 7:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-red')
                        $('#so').addClass('b-red')
                        $('#to_').addClass('b-red')
                        $('#mo').addClass('b-orange')
                        $('#preventive_maintenance_status_to').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to').html(button_start_maintenance_to)
                        $('#preventive_maintenance_status_so').html(status_need_maintenance)
                        $('#preventive_maintenance_action_so').html(button_start_maintenance_so)
                        $('#preventive_maintenance_status_to_').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to_').html(button_start_maintenance_to_)
                        $('#preventive_maintenance_status_mo').html(status_need_maintenance)
                        $('#preventive_maintenance_action_mo').html(button_start_maintenance_mo)
                    case 8:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-red')
                        $('#so').addClass('b-red')
                        $('#to_').addClass('b-red')
                        $('#mo').addClass('b-red')
                        $('#preventive_maintenance_status_to').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to').html(button_start_maintenance_to)
                        $('#preventive_maintenance_status_so').html(status_need_maintenance)
                        $('#preventive_maintenance_action_so').html(button_start_maintenance_so)
                        $('#preventive_maintenance_status_to_').html(status_need_maintenance)
                        $('#preventive_maintenance_action_to_').html(button_start_maintenance_to_)
                        $('#preventive_maintenance_status_mo').html(status_need_maintenance)
                        $('#preventive_maintenance_action_mo').html(button_start_maintenance_mo)
                        break;
                    default:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-gray')
                        $('#so').addClass('b-gray')
                        $('#to_').addClass('b-gray')
                        $('#mo').addClass('b-gray')
                }
                // setelah cek reached status, check maintenance nya
                switch (maintained_score) {
                    case 1:
                        clearMaintenanceSignColor('to');
                        $('#to').addClass('b-green');
                        $('#preventive_maintenance_status_to').html(status_maintenance(obj.to_maintenance_time_start, obj.to_maintained_operator))
                        $('#preventive_maintenance_action_to').html(button_finish_maintenance_to)
                        break;
                    case 2:
                        clearMaintenanceSignColor('to');
                        $('#to').addClass('b-blue')
                        $('#preventive_maintenance_status_to').html(status_maintenance(obj.to_maintenance_time_finish, obj.to_maintained_operator, true))
                        $('#preventive_maintenance_action_to').html('')
                        break;
                    case 3:
                        clearMaintenanceSignColor('to');
                        clearMaintenanceSignColor('so');
                        $('#to').addClass('b-blue')
                        $('#so').addClass('b-green');
                        $('#preventive_maintenance_status_to').html(status_maintenance(obj.to_maintenance_time_finish, obj.to_maintained_operator, true))
                        $('#preventive_maintenance_action_to').html('')
                        $('#preventive_maintenance_status_so').html(status_maintenance(obj.so_maintenance_time_start, obj.so_maintained_operator))
                        $('#preventive_maintenance_action_so').html(button_finish_maintenance_so)
                        break;
                    case 4:
                        clearMaintenanceSignColor('to');
                        clearMaintenanceSignColor('so');
                        $('#to').addClass('b-blue')
                        $('#so').addClass('b-blue')
                        $('#preventive_maintenance_status_to').html(status_maintenance(obj.to_maintenance_time_finish, obj.to_maintained_operator, true))
                        $('#preventive_maintenance_action_to').html('')
                        $('#preventive_maintenance_status_so').html(status_maintenance(obj.so_maintenance_time_finish, obj.so_maintained_operator, true))
                        $('#preventive_maintenance_action_so').html('')
                        break;
                    case 5:
                        clearMaintenanceSignColor('to');
                        clearMaintenanceSignColor('so');
                        clearMaintenanceSignColor('to_');
                        $('#to').addClass('b-blue')
                        $('#so').addClass('b-blue')
                        $('#to_').addClass('b-green')
                        $('#preventive_maintenance_status_to').html(status_maintenance(obj.to_maintenance_time_finish, obj.to_maintained_operator, true))
                        $('#preventive_maintenance_action_to').html('')
                        $('#preventive_maintenance_status_so').html(status_maintenance(obj.so_maintenance_time_finish, obj.so_maintained_operator, true))
                        $('#preventive_maintenance_action_so').html('')
                        $('#preventive_maintenance_status_to_').html(status_maintenance(obj.to2_maintenance_time_start, obj.to2_maintained_operator))
                        $('#preventive_maintenance_action_to_').html(button_finish_maintenance_to_)
                        break;
                    case 6:
                        clearMaintenanceSignColor('to');
                        clearMaintenanceSignColor('so');
                        clearMaintenanceSignColor('to_');
                        $('#to').addClass('b-blue')
                        $('#so').addClass('b-blue')
                        $('#to_').addClass('b-blue')
                        $('#preventive_maintenance_status_to').html(status_maintenance(obj.to_maintenance_time_finish, obj.to_maintained_operator, true))
                        $('#preventive_maintenance_action_to').html('')
                        $('#preventive_maintenance_status_so').html(status_maintenance(obj.so_maintenance_time_finish, obj.so_maintained_operator, true))
                        $('#preventive_maintenance_action_so').html('')
                        $('#preventive_maintenance_status_to_').html(status_maintenance(obj.to2_maintenance_time_finish, obj.to2_maintained_operator, true))
                        $('#preventive_maintenance_action_to_').html('')
                        break;
                    case 7:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-blue')
                        $('#so').addClass('b-blue')
                        $('#to_').addClass('b-blue')
                        $('#mo').addClass('b-green')
                        $('#preventive_maintenance_status_to').html(status_maintenance(obj.to_maintenance_time_finish, obj.to_maintained_operator, true))
                        $('#preventive_maintenance_action_to').html('')
                        $('#preventive_maintenance_status_so').html(status_maintenance(obj.so_maintenance_time_finish, obj.so_maintained_operator, true))
                        $('#preventive_maintenance_action_so').html('')
                        $('#preventive_maintenance_status_to_').html(status_maintenance(obj.to2_maintenance_time_finish, obj.to2_maintained_operator, true))
                        $('#preventive_maintenance_action_to_').html('')
                        $('#preventive_maintenance_status_mo').html(status_maintenance(obj.mo_maintenance_time_start, obj.mo_maintained_operator))
                        $('#preventive_maintenance_action_to').html(button_finish_maintenance_mo)
                    case 8:
                        clearMaintenanceSignColor();
                        $('#to').addClass('b-blue')
                        $('#so').addClass('b-blue')
                        $('#to_').addClass('b-blue')
                        $('#mo').addClass('b-blue')
                        $('#preventive_maintenance_status_to').html(status_maintenance(obj.to_maintenance_time_finish, obj.to_maintained_operator, true))
                        $('#preventive_maintenance_action_to').html('')
                        $('#preventive_maintenance_status_so').html(status_maintenance(obj.so_maintenance_time_finish, obj.so_maintained_operator, true))
                        $('#preventive_maintenance_action_so').html('')
                        $('#preventive_maintenance_status_to_').html(status_maintenance(obj.to2_maintenance_time_finish, obj.to2_maintained_operator, true))
                        $('#preventive_maintenance_action_to_').html('')
                        $('#preventive_maintenance_status_mo').html(status_maintenance(obj.mo_maintenance_time_finish, obj.mo_maintained_operator, true))
                        $('#preventive_maintenance_action_mo').html('')
                        break;
                    default:
                    // idk what default huh
                }
                status_on_maintenance = '<i class="fas fa-check-square c-green"></i> On Progress Maintenance on 15 July 2019, reported by Kinkin'
                status_maintained = '<i class="fas fa-check-square c-blue"></i> Maintained on 15 July 2019, reported by Kinkin'
                // status_not_reached = 'Engine Hours Not Reached Yet'
                switch (obj.to_maintained_status) {
                    case 1:
                        $('#preventive_maintenance_status_to').html(status_maintenance(obj.to_maintenance_time_start, obj.to_maintained_operator))
                        break;
                    case 2:
                        $('#preventive_maintenance_status_to').html(status_maintenance(obj.to_maintenance_time_finish, obj.to_maintained_operator, true))
                        break;
                    default:
                    // do nothing
                }
                switch (obj.so_maintained_status) {
                    case 1:
                        $('#preventive_maintenance_status_so').html(status_on_maintenance)
                        break;
                    case 2:
                        $('#preventive_maintenance_status_so').html(status_maintained)
                        break;
                    default:
                    // do nothing
                }
                switch (obj.to2_maintained_status) {
                    case 1:
                        $('#preventive_maintenance_status_to_').html(status_on_maintenance)
                        break;
                    case 2:
                        $('#preventive_maintenance_status_to_').html(status_maintained)
                        break;
                    default:
                    // do nothing
                }
                switch (obj.mo_maintained_status) {
                    case 1:
                        $('#preventive_maintenance_status_mo').html(status_on_maintenance)
                        break;
                    case 2:
                        $('#preventive_maintenance_status_mo').html(status_maintained)
                        break;
                    default:
                    // do nothing
                }
            }

            // when finish
            $("#tbody-preventive-maintenance-wrapper").show();
        })
    }

    function status_maintenance(date, reporter, finish = false) {
        if (date == null) {
            if (finish == true) {
                date_description = 'Maintained'
            } else {
                date_description = 'On Progress Maintenance'
            }
        } else {
            if (finish == true) {
                date_description = 'Maintained on ' + date
            } else {
                date_description = 'On Progress Maintenance started from  ' + date
            }
        }

        if (reporter == null) {
            report_description = ''
        } else {
            report_description = ', reported by ' + reporter
        }
        if (finish == true) {
            return '<i class="fas fa-check-square c-blue"></i> ' + date_description + report_description
        } else {
            return '<i class="fas fa-check-square c-green"></i> ' + date_description + report_description
        }
    }

    function update_maintenance_popup(site, unit, level, operator, status) {
        if (status == 1) {
            text1 = 'Start Maintenance?'
            text2 = 'Maintenance Start Recorded!'
            text3 = 'dont forget to report when maintenance finished'
        } else if (status == 2) {
            text1 = 'Finish Maintenance?'
            text2 = 'Maintenance Finished!'
            text3 = 'Maintenance finished and recorded in database'
        }
        // var: site, unit, level, time, operator
        Swal.fire({
            title: text1,
            // text: 'You wont be able to revert this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(function (result) {
            if (result.value) {
                update_maintenance_ajax(site, unit, level, operator, status, text2, text3)
            }
        })
    }

    function update_maintenance_ajax(site, unit, level, operator, status, text2, text3) {
        $.getJSON("https://nms.telkominfra.com/api/update_preventive_maintenance_status/" + site + "/" + unit + "/" + level + "/" + operator + "/" + status, function (result) {
            console.log(site, unit, level, operator, status)
            console.log(result)
        }).done(function () {
            renderPreventiveMaintenanceJourney(site, unit)
            Swal.fire(text2, text3, 'success')
        }).fail(function () {
            Swal.fire('Failed', 'Event error', 'error')
        });
    }

    function thousandsSeparators(num, floating = true) {
        var num_parts = num.toString().split(".");
        if (!num_parts[1]) {
            num_parts[1] = '0'
        }
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        if (floating) {
            return num_parts.join(".");
        } else {
            return num_parts[0];
        }

    }

    function makeOneDigitafterComma(a) {
        num = a.toString().split('.')
        if (num[1]) {
            end_num = num[1][0];
            return num[0] + '.' + end_num;
        } else {
            return a
        }
    }


    console.log('Hello Non Operator ' + 'pln')

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJB1_8d0bmX2YGZ3MV6WSqxleYvXPXfTY&callback=initMap"></script>
</body>
</html>