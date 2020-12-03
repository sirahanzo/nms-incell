@extends('layouts.nms_master3')
@section('css')
    <link href="{{ asset('/') }}css/bootstrap-datepicker3.min.css" rel="stylesheet"/>

@endsection
@section('content')

    <div class="panel panel-default panel-with-tabs" data-sortable-id="ui-unlimited-tabs-2" style="">
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

                <ul class="nav nav-tabs" style="margin-left: 0px;" id="list_tab_pack">
                    <li class="prev-button" style=""><a href="javascript:;" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a>
                    </li>
                    @for ($i = 1; $i <= 15; $i++)
                        <li id="{{($i== 1)?'tabDefault':'tab_pack'.$i}}" class="{{ ($i == 1)?'active':'hide' }}"><a href="#nav-tab2-{{$i}}" data-toggle="tab" tab="pack{{$i}}" >Pack{{$i}}</a></li>
                    @endfor
                    {{--<li class="active"><a href="#nav-tab2-1" data-toggle="tab" aria-expanded="true">Pack1</a></li>
                    <li class=""><a href="#nav-tab2-2" data-toggle="tab" tab="pack2">Pack2</a></li>
                    <li class=""><a href="#nav-tab2-3" data-toggle="tab">Pack3</a></li>
                    <li class=""><a href="#nav-tab2-4" data-toggle="tab">Pack4</a></li>
                    <li class=""><a href="#nav-tab2-5" data-toggle="tab">Pack5</a></li>
                    <li class=""><a href="#nav-tab2-6" data-toggle="tab">Pack6</a></li>
                    <li class=""><a href="#nav-tab2-7" data-toggle="tab">Pack7</a></li>
                    <li class=""><a href="#nav-tab2-8" data-toggle="tab">Pack8</a></li>
                    <li class=""><a href="#nav-tab2-9" data-toggle="tab">Pack8</a></li>
                    <li class=""><a href="#nav-tab2-10" data-toggle="tab">Pack10</a></li>
                    <li class=""><a href="#nav-tab2-11" data-toggle="tab">Pack11</a></li>
                    <li class=""><a href="#nav-tab2-12" data-toggle="tab" aria-expanded="false">Pack12</a></li>
                    <li class=""><a href="#nav-tab2-13" data-toggle="tab">Pack13</a></li>
                    <li class=""><a href="#nav-tab2-14" data-toggle="tab">Pack14</a></li>
                    <li class=""><a href="#nav-tab2-15" data-toggle="tab">Pack15</a></li>--}}
{{--                    <li class=""><a href="#nav-tab2-11" data-toggle="tab">Pack16</a></li>--}}
{{--                    <li class=""><a href="#nav-tab2-17" data-toggle="tab">Pack17</a></li>--}}
{{--                    <li class=""><a href="#nav-tab2-18" data-toggle="tab">Pack18</a></li>--}}
{{--                    <li class=""><a href="#nav-tab2-19" data-toggle="tab">Pack19</a></li>--}}
{{--                    <li class=""><a href="#nav-tab2-20" data-toggle="tab">Pack20</a></li>--}}
                    <li class="next-button" style=""><a href="javascript:;" data-click="next-tab" class="text-inverse"><i class="fa fa-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <form class="form-horizontal form-stripe" id="form_data">
                {{csrf_field()}}
                {{--    <input type="hidden" id="device_id" name="device_id" value="1">--}}
                <input type="text" id="site_oid" name="site_oid" value="site_oid">
                <input type="text" id="pack_id" name="pack_id" value="pack1">

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
                        <button class="btn btn-sm width-100 btn-default btn-outline " disabled="disabled" type="button" id="show_data" onclick="showTable()">
                            Show Data
                        </button>
                        <button class="btn btn-sm width-100 btn-default btn-outline " disabled="disabled" type="button" id="download">Download</button>
                        <button class="btn btn-sm width-100 btn-info btn-outline btn-loading" type="button" id="refresh" onclick="refreshTable()">Refresh Data
                        </button>
                    </div>
                </div>
            </form>
            <div class="tab-pane fade active in" id="nav-tab2-1">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 1])
            </div>
            <div class="tab-pane fade" id="nav-tab2-2">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 2])
            </div>
            <div class="tab-pane fade" id="nav-tab2-3">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 3])

            </div>
            <div class="tab-pane fade" id="nav-tab2-4">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 4])

            </div>
            <div class="tab-pane fade" id="nav-tab2-5">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 5])

            </div>
            <div class="tab-pane fade" id="nav-tab2-6">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 6])

            </div>
            <div class="tab-pane fade" id="nav-tab2-7">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 7])

            </div>
            <div class="tab-pane fade" id="nav-tab2-8">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 8])

            </div>
            <div class="tab-pane fade" id="nav-tab2-9">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 9])

            </div>
            <div class="tab-pane fade" id="nav-tab2-10">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 10])

            </div>
            <div class="tab-pane fade" id="nav-tab2-11">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 11])

            </div>
            <div class="tab-pane fade" id="nav-tab2-12">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 12])

            </div>
            <div class="tab-pane fade" id="nav-tab2-13">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 13])

            </div>
            <div class="tab-pane fade" id="nav-tab2-14">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 14])

            </div>
            <div class="tab-pane fade" id="nav-tab2-15">
                @include('nms_incell.log._table_poll_pack',['pack_id' => 15])

            </div>
            {{--<div class="tab-pane fade" id="nav-tab2-16">
                <h3 class="m-t-10">Pack16</h3>
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
                <h3 class="m-t-10">Pack17</h3>
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
                <h3 class="m-t-10">Pack18</h3>
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
                <h3 class="m-t-10">Pack19</h3>
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
                <h3 class="m-t-10">Pack20</h3>
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
    
@endsection
@section('js')
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>

    <script>

        // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        //     var target = $(e.target).attr("tab"); // activated tab
        //     // alert($(e.target).attr("tab"));
        //     let site_oid = localStorage.getItem('activeSite');
        //     createTablePack(site_oid,target);
        //
        // });

        function createTablePack() {

            // console.log('CREATE TABLE LOG:'+data+',PACK:'+packId);
            let formRequest = $('#form_data').serialize();
            // $('#myTable').dataTable().fnDestroy();

            {{--$.ajax({--}}
            {{--    url: '{{ route('log-data-pack') }}',--}}
            {{--    data: formRequest,--}}
            {{--    type: 'GET',--}}
            {{--    success: function (data) {--}}

            {{--        console.log('DATA PACK:',data);--}}
            {{--    },--}}
            {{--    error: '',--}}
            {{--})--}}

            var devTable1 = $('#myTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                destroy:true,
                // ajax: url_manufature_show,
                ajax: {
                    url: "{{ route('log-data-pack') }}"+'?'+formRequest,
                    // data:formRequest,
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
                                devTable1.draw();

                            }
                        } else {
                            if (xhr.status === 500) {
                                //handle error
                                this.tryCount++;
                                if (this.tryCount <= this.retryLimit) {
                                    //try again
                                    // $.ajax(this);
                                    // refreshJsTree()
                                    devTable1.draw();

                                }
                            }
                        }
                    }

                },
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'updated_at', name: 'updated_at'},
                    // {data: 'value', name: 'value'},
                    {data: 'name', name: 'name'},
                    {data: 'value', name: 'value'},
                    {data: 'unit', name: 'unit'},
                ],

            });
            $('#myTable').css('width','100%');

            // devTable1.on('order.dt search.dt', function () {
            //     devTable1.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            //         cell.innerHTML = i + 1;
            //     });
            // }).draw();
            devTable1.draw();

        }

        function getMonitoringSite(site_oid) {

            console.log('get LOG monitoring site:', site_oid);
            // clearInterval(myInterval);
            $("li[id^=tab_pack]").addClass('hide');
            // $('[href="#nav-tab2-1"]').tab('show');
            // clearAllMonitoringValue();

            $.ajax({
                url: '{{ route('log-data-show') }}',
                data: {'site_oid': site_oid},
                type: 'GET',
                success: function (data) {


                    if (data === 'NOT VALID SITE') {

                        console.log("show none site");
                        // $('#none_site').removeClass('hide').addClass('show');
                        // $('#valid_site').removeClass('show').addClass('hide');
                        $('.site_name').text('Not Valid Site');
                        $('.site_address').text('-');
                        $('.site_longitude').text('0');
                        $('.site_latitude').text('0');

                    } else {
                        // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                        //     var target = $(e.target).attr("href") // activated tab
                        //     alert($(e.target).attr("tab"));
                        //
                        // });


                        /*show data site*/
                        // $('#none_site').removeClass('show').addClass('hide');
                        // $('#valid_site').removeClass('hide').addClass('show');

                        console.log('data site:', data);

                        $('.site_name').text(data.site.name);
                        $('#site_oid').val(data.site.oid);
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

                        // createTablePack(data.site.oid,'pack1');
                        $('[href="#nav-tab2-1"]').tab('show');

                        $( "#tabDefault" ).on( "click", function() {
                            createTablePack();
                        });
                        $( "#tabDefault" ).trigger( "click" );


                        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                            var tabSelected = $(e.target).attr("tab"); // activated tab
                            let site_oid = localStorage.getItem('activeSite');
                            $('#pack_id').val(tabSelected);
                            createTablePack();
                            // $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();


                        });


                    }
                },
                error: function (err) {
                    console.log('err:', err);

                },
            });

            // myInterval = setInterval(scheduledMonitoring, 30000);
        }




    </script>
    @endsection