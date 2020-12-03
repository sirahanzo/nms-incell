
{{--<h4 class="m-t-10">PACK {{ $pack_id }}  | SERIAL NUMBER: <span id="sn{{$pack_id}}">0000</span></h4>--}}
<h4 class="m-t-10"> SERIAL NUMBER: <span id="sn{{$pack_id}}">0000</span></h4>
<h4 class="m-t-10">BATTERY ID: <span id="battery_id{{$pack_id}}">0000</span></h4>
<div class="row">
    <div class="col-md-2">
        @include('nms_incell.monitoring.schematic._soc2')
    </div>
    <div class="col-md-2">
        @include('nms_incell.monitoring.schematic._voltage')
    </div>
    <div class="col-md-2">
        @include('nms_incell.monitoring.schematic._current')
    </div>
    <div class="col-md-2">
        @include('nms_incell.monitoring.schematic._cycle_count')
    </div>
    <div class="col-md-2">
        @include('nms_incell.monitoring.schematic._backup_time')
    </div>
    <div class="col-md-2">
        @include('nms_incell.monitoring.schematic._cell_temperature')
    </div>



</div>
<br>
<div class="row">
    <div class="col-md-4">
        <table id="pack{{ $pack_id }}_tbl_1" class="table table-bordered">
            <tr>
                <th>Parameter</th>
                <th>Value</th>
                {{--                <th>County</th>--}}
            </tr>
        </table>
    </div>
    <div class="col-md-4">
        <table id="pack{{ $pack_id }}_tbl_2" class="table table-bordered">
            <tr>
                <th>Parameter</th>
                <th>Value</th>
                {{--                <th>County</th>--}}
            </tr>

        </table>
        <table class="table table-bordered hide">
            <tr>
                <th>Battery status</th>
                <th>floating</th>
                {{--                <th>County</th>--}}
            </tr>
        </table>
    </div>

    <div class="col-md-4">
        <table id="pack{{ $pack_id }}_tbl_3" class="table table-bordered">
            <tr>
                <th>Alarm</th>
{{--                <th>Status</th>--}}
                {{--                <th>County</th>--}}
            </tr>
        </table>

    </div>

</div>