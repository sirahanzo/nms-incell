@extends('layouts.nms_master2')

@section('css')
    {{--note:(8/7/20), no use due to change to nms_master2 template--}}
    {{--    <link href="{{ asset('/') }}css/dataTables.bootstrap.min.css" rel="stylesheet"/>--}}
    {{--    <link href="{{ asset('/') }}css/responsive.bootstrap.min.css" rel="stylesheet"/>--}}
    {{--    <link href="{{ asset('/') }}css/bootstrap-select.css" rel="stylesheet"/>--}}

@endsection

@section('content')

    <!-- begin #content -->
    <div id="content" class="content">
        <h1 class="page-header text-uppercase">{{ Request::segment(1) }}
        </h1>
        <div class="row">
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
                    <h4 class="panel-title">Panel Title here</h4>
                </div>
                <div class="panel-body" id="monitoring_site">

                    <div id="user-list" class="panel-body">
                        <p>
                            <a href="javascript:;" class="btn width-200  btn-primary m-r-5" id="refreshInbox"><i class="fa fa-refresh"></i> Refresh</a>
                            <a href="javascript:;" class="btn width-200  btn-white " id="safeTimer">Auto refresh in : <span
                                        id="safeTimerDisplay">00 s</span></a>
                        </p>

                        <table id="myTable" class="table table-striped table-bordered table-responsive" width="100%">
                            <thead>
                            <tr>

                                <th class="">Date/Time</th>
                                <th class="">Type Data</th>
                                <th class=""> SIte ID</th>
                                <th class=""> SIte Name</th>
                                <th class="">Content</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <!-- end #content -->

@endsection
@section('js')
    {{--    <script src="{{ asset('/') }}js/jquery.dataTables.js"></script>--}}
    {{--    <script src="{{ asset('/') }}js/dataTables.bootstrap.min.js"></script>--}}
    {{--    <script src="{{ asset('/') }}js/dataTables.responsive.min.js"></script>--}}
    {{--    <script src="{{ asset('/') }}js/bootstrap-select.js"></script>--}}

    <script>

        let inboxInterval;
        let sec = 60;
        let myInterval;

        getInboxPost();

        $('#refreshInbox').click(function () {
            console.log('refresh table inbox');
            getInboxPost();
        });

        function getInboxPost() {
            clearInterval(myInterval);
            // sec =60;//reset counter

            var oTable = $('#myTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                destroy: true,
                // ajax: url_manufature_show,
                ajax: {
                    url: '{{route('log-inbox-show')}}',
                    type: 'GET',
                    dataType: 'json',
                    tryCount: 1,
                    retryLimit: 3,
                    error: function (xhr, textStatus, errorThrown) {
                        if (textStatus === 'timeout') {
                            this.tryCount++;
                            if (this.tryCount <= this.retryLimit) {
                                //try again
                                $.ajax(this);
                                // refreshJsTree()
                                oTable.draw();

                            }
                        } else {
                            if (xhr.status === 500) {
                                //handle error
                                this.tryCount++;
                                if (this.tryCount <= this.retryLimit) {
                                    //try again
                                    $.ajax(this);
                                    // refreshJsTree()
                                    oTable.draw();

                                }
                            }
                        }
                    }

                },
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'dtime', name: 'dtime'},
                    {data: 'type_message', name: 'type_message'},
                    {data: 'site_id', name: 'site_id'},
                    {data: 'site_name', name: 'site_name'},//site_id_label
                    {data: 'content_message', name: 'content_message'},
                ],

            });

            myInterval = setInterval(scheduledMonitoring, 1000);

        }

        function scheduledMonitoring() {
            $('#safeTimerDisplay').text(sec + 's');
            sec--;
            if (sec < 0) {
                sec = 60;
                getInboxPost();
            }
        }

    </script>
@endsection