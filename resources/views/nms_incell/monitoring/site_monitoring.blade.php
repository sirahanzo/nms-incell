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

    <section id="valid_site" class="hide">
        <div class="panel panel-inverse" data-sortable-id="ui-general-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">MONITORING DATA</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <legend class="pull-left width-full"><span id="site_name" class="site_name" >SITE NAME</span></legend>

                        <table class="table table-bordered">

                            <tbody>
                            <tr>
                                <td>Address</td>
                                <td id="site_address1"><a href="http://maps.google.com/?q=<LAT>,<LNG>" target="_blank" id="gmap_address" class="site_address">-</a></td>
                            </tr>
                            <tr>
                                <td>GPS</td>
                                <td><a href="http://maps.google.com/?q=<LAT>,<LNG>" target="_blank" id="gmap_gps"><span id="site_latitude" class="site_latitude">0</span> , <span
                                                id="site_longitude" class="site_longitude">0</span></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <legend class="pull-left width-full "  >LAST UPDATED AT:    <span id="last_updated" class="last_updated">-</span> </legend>


                        <div class="col-md-6"><table class="table table-bordered">

                                <tbody>
                                <tr>
                                    <td>DIGITAL INPUT 1</td>
                                    <td><span id="di1" class="DI-IN-ACTIVE">IN-ACTIVE</span></td>
                                </tr>
                                <tr>
                                    <td>DIGITAL INPUT 2</td>
                                    <td><span id="di2" class="DI-IN-ACTIVE">IN-ACTIVE</span></td>
                                </tr>
                                </tbody>
                            </table></div>
                        <div class="col-md-6">
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
                <div class="panel panel-default panel-with-tabs" data-sortable-id="ui-unlimited-tabs-2" style="">
                    <div class="panel-heading p-0">
                        <div class="panel-heading-btn m-r-10 m-t-10">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-inverse" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        </div>
                        <!-- begin nav-tabs -->
                        <div class="tab-overflow overflow-right" >
                            <ul class="nav nav-tabs" style="margin-left: 0px;" id="list_tab_pack">
                                <li class="prev-button" style=""><a href="javascript:;" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a>
                                </li>
                                <li id="" class="active"><a href="#nav-tab2-1" data-toggle="tab" aria-expanded="true">PACK 1</a></li>
                                <li id="tab_pack2" class="hide"><a href="#nav-tab2-2" data-toggle="tab">PACK 2</a></li>
                                <li id="tab_pack3" class="hide"><a href="#nav-tab2-3" data-toggle="tab">PACK 3</a></li>
                                <li id="tab_pack4" class="hide"><a href="#nav-tab2-4" data-toggle="tab">PACK 4</a></li>
                                <li id="tab_pack5" class="hide"><a href="#nav-tab2-5" data-toggle="tab">PACK 5</a></li>
                                <li id="tab_pack6" class="hide"><a href="#nav-tab2-6" data-toggle="tab">PACK 6</a></li>
                                <li id="tab_pack7" class="hide"><a href="#nav-tab2-7" data-toggle="tab">PACK 7</a></li>
                                <li id="tab_pack8" class="hide"><a href="#nav-tab2-8" data-toggle="tab" aria-expanded="false">PACK 8</a></li>
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
                                <li class="next-button" style=""><a href="javascript:;" data-click="next-tab" class="text-inverse"><i class="fa fa-arrow-right"></i></a>
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
                        {{--<div class="tab-pane fade" id="nav-tab2-16">
                            <h3 class="m-t-10">PACK 16</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing
                                porttitor,
                                est diam sagittis orci, a ornare nisi quam elementum tortor.
                                Proin interdum ante porta est convallis dapibus dictum in nibh.
                                Aenean quis massa congue metus mollis fermentum eget et tellus.
                                Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                                nec eleifend orci eros id lectus.
                            </p>
                            <p>
                                Aenean eget odio eu justo mollis consectetur non quis enim.
                                Vivamus interdum quam tortor, et sollicitudin quam pulvinar sit amet.
                                Donec facilisis auctor lorem, quis mollis metus dapibus nec. Donec interdum tellus vel
                                mauris vehicula,
                                at ultrices ex gravida. Maecenas at elit tincidunt, vulputate augue vitae, vulputate
                                neque.
                                Aenean vel quam ligula. Etiam faucibus aliquam odio eget condimentum.
                                Cras lobortis, orci nec eleifend ultrices, orci elit pellentesque ex, eu sodales felis
                                urna nec erat.
                                Fusce lacus est, congue quis nisi quis, sodales volutpat lorem.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="nav-tab2-17">
                            <h3 class="m-t-10">PACK 17</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing
                                porttitor,
                                est diam sagittis orci, a ornare nisi quam elementum tortor.
                                Proin interdum ante porta est convallis dapibus dictum in nibh.
                                Aenean quis massa congue metus mollis fermentum eget et tellus.
                                Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                                nec eleifend orci eros id lectus.
                            </p>
                            <p>
                                Aenean eget odio eu justo mollis consectetur non quis enim.
                                Vivamus interdum quam tortor, et sollicitudin quam pulvinar sit amet.
                                Donec facilisis auctor lorem, quis mollis metus dapibus nec. Donec interdum tellus vel
                                mauris vehicula,
                                at ultrices ex gravida. Maecenas at elit tincidunt, vulputate augue vitae, vulputate
                                neque.
                                Aenean vel quam ligula. Etiam faucibus aliquam odio eget condimentum.
                                Cras lobortis, orci nec eleifend ultrices, orci elit pellentesque ex, eu sodales felis
                                urna nec erat.
                                Fusce lacus est, congue quis nisi quis, sodales volutpat lorem.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="nav-tab2-18">
                            <h3 class="m-t-10">PACK 18</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing
                                porttitor,
                                est diam sagittis orci, a ornare nisi quam elementum tortor.
                                Proin interdum ante porta est convallis dapibus dictum in nibh.
                                Aenean quis massa congue metus mollis fermentum eget et tellus.
                                Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                                nec eleifend orci eros id lectus.
                            </p>
                            <p>
                                Aenean eget odio eu justo mollis consectetur non quis enim.
                                Vivamus interdum quam tortor, et sollicitudin quam pulvinar sit amet.
                                Donec facilisis auctor lorem, quis mollis metus dapibus nec. Donec interdum tellus vel
                                mauris vehicula,
                                at ultrices ex gravida. Maecenas at elit tincidunt, vulputate augue vitae, vulputate
                                neque.
                                Aenean vel quam ligula. Etiam faucibus aliquam odio eget condimentum.
                                Cras lobortis, orci nec eleifend ultrices, orci elit pellentesque ex, eu sodales felis
                                urna nec erat.
                                Fusce lacus est, congue quis nisi quis, sodales volutpat lorem.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="nav-tab2-19">
                            <h3 class="m-t-10">PACK 19</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing
                                porttitor,
                                est diam sagittis orci, a ornare nisi quam elementum tortor.
                                Proin interdum ante porta est convallis dapibus dictum in nibh.
                                Aenean quis massa congue metus mollis fermentum eget et tellus.
                                Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                                nec eleifend orci eros id lectus.
                            </p>
                            <p>
                                Aenean eget odio eu justo mollis consectetur non quis enim.
                                Vivamus interdum quam tortor, et sollicitudin quam pulvinar sit amet.
                                Donec facilisis auctor lorem, quis mollis metus dapibus nec. Donec interdum tellus vel
                                mauris vehicula,
                                at ultrices ex gravida. Maecenas at elit tincidunt, vulputate augue vitae, vulputate
                                neque.
                                Aenean vel quam ligula. Etiam faucibus aliquam odio eget condimentum.
                                Cras lobortis, orci nec eleifend ultrices, orci elit pellentesque ex, eu sodales felis
                                urna nec erat.
                                Fusce lacus est, congue quis nisi quis, sodales volutpat lorem.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="nav-tab2-20">
                            <h3 class="m-t-10">PACK 20</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing
                                porttitor,
                                est diam sagittis orci, a ornare nisi quam elementum tortor.
                                Proin interdum ante porta est convallis dapibus dictum in nibh.
                                Aenean quis massa congue metus mollis fermentum eget et tellus.
                                Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                                nec eleifend orci eros id lectus.
                            </p>
                            <p>
                                Aenean eget odio eu justo mollis consectetur non quis enim.
                                Vivamus interdum quam tortor, et sollicitudin quam pulvinar sit amet.
                                Donec facilisis auctor lorem, quis mollis metus dapibus nec. Donec interdum tellus vel
                                mauris vehicula,
                                at ultrices ex gravida. Maecenas at elit tincidunt, vulputate augue vitae, vulputate
                                neque.
                                Aenean vel quam ligula. Etiam faucibus aliquam odio eget condimentum.
                                Cras lobortis, orci nec eleifend ultrices, orci elit pellentesque ex, eu sodales felis
                                urna nec erat.
                                Fusce lacus est, congue quis nisi quis, sodales volutpat lorem.
                            </p>
                        </div>--}}
                    </div>
                </div>

            </div>
        </div>

    </section>
    <section id="none_site" class="show">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                       data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                       data-click="panel-reload" id="btn_refresh"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                       data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
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


    <div class="panel panel-inverse hide">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                   data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                   data-click="panel-reload" id="btn_refresh"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                   data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                   data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">SCHEMATIC DIAGRAM </h4>
        </div>
        <div class="panel-body" id="monitoring_site">

            <div id="none_site" class="show">
                <div class="col-md-12">
                    @include('nms_incell.schemes._none_site')
                </div>
            </div>


            <div id="valid_site1" class="hide">
                {{--                                                <legend class="pull-left width-full"><span id="site_name">SITE NAME</span></legend>--}}

                <h5 class="m-t-10 "><span id="">LAST UPDATE AT :</span><span id="last_updated" >-</span></h5>

                <div class="col-md-9 show" id="schematic">

                    {{--                    <div id="mini_pop" class="hide">--}}
                    {{--                        @include('nms_2020.schemes._mini_pop2')--}}
                    {{--                    </div>--}}
                    {{--                    <div id="micro_pop" class="hide">--}}
                    {{--                        @include('nms_2020.schemes._micro_pop2')--}}
                    {{--                    </div>--}}


                </div>
                <div class="col-md-3">
                    <fieldset>
                        <legend class="pull-left width-full"><span id="site_name" class="site_name">SITE NAME</span></legend>
                        <table class="table table-bordered">

                            <tbody>
                            <tr>
                                <td>Address</td>
                                {{--                                <td id="site_address1"><a href="http://maps.google.com/?q=<LAT>,<LNG>" target="_blank" id="gmap_address" class="site_address">-</a></td>--}}
                                <td id="site_address1"><a href="http://maps.google.com/" target="_blank" id="gmap_address" class="site_address">-</a></td>

                            </tr>
                            <tr>
                                <td>GPS</td>
                                <td><a href="http://maps.google.com/?q=<LAT>,<LNG>" target="_blank" id="gmap_gps"><span id="site_latitude" class="site_latitude">0</span> , <span
                                                id="site_longitude" class="site_longitude">0</span></a></td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-device hide " id="table1">

                            <tr class="">
                                <th colspan="2" class="text-center commlost " id="tr_ea"><a href="#" onclick="show_EADetail()">EA- <span id="node1_device_name">N/A</span></a>
                                </th>
                            </tr>
                            <tr>
                                <td id="node1_name">Node</td>
                                <td id=""><a href="#" id="node1_ipaddress" onclick="show_EADetail()">x.x.x.x</a></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center" id="node1_serialnumber">SN</td>
                            </tr>
                        </table>
                        <table class="table table-bordered table-device hide " id="table2">
                            <tr class="">
                                <th colspan="2" class="text-center commlost " id="tr_rectifier"><a href="#" onclick="show_RECTDetail()">RECT.- <span
                                                id="node2_device_name">N/A</span></a></th>
                            </tr>
                            <tr>
                                <td id="node2_name">Node</td>
                                <td id=""><a href="#" id="node2_ipaddress" onclick="show_RECTDetail()">x.x.x.x</a></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center" id="node2_serialnumber">SN</td>
                            </tr>
                        </table>
                        <table class="table table-bordered table-device hide " id="table3">
                            <tr class="">
                                <th colspan="2" class="text-center commlost" id="tr_bms"><a href="#" onclick="show_BMSDetail()">BMS- <span
                                                id="node3_device_name">N/A </span></a>
                                </th>
                            </tr>
                            <tr>
                                <td id="node3_name">Node</td>
                                <td><a href="#" id="node3_ipaddress" onclick="show_BMSDetail()">x.x.x.x</a></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center" id="node3_serialnumber">SN</td>
                            </tr>
                        </table>

                    </fieldset>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

        var time = new Date().getTime();
        $(document.body).bind("mousemove keypress", function (e) {
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

            for (var i = 0; i < 13; i++) {
                // var row = $('<tr><td>' + data.polling[i].id + '. &nbsp;' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                var row = $('<tr><td>' + data.polling[i].parameters.name + '</td><td>' + data.polling[i][pack] + ' &nbsp;' + data.polling[i].parameters.unit + '</td></tr>');
                $('#'+pack+'_tbl_1').append(row);
            }


            $('#'+pack+'_tbl_2 td').remove();

            for (var i = 13; i < 30; i++) {
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
                $('#schema_backuptime'+i).text(data.polling[6][schema+i]);
                $('#schema_min_temp'+i).text(data.polling[23][schema+i]);
                $('#schema_max_temp'+i).text(data.polling[24][schema+i]);
            }


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
    </script>
@endsection