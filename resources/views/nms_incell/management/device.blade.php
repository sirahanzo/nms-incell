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
        <!-- begin breadcrumb -->
    {{--        <ol class="breadcrumb pull-right">--}}
    {{--            <li><a href="javascript:;">Home</a></li>--}}
    {{--            <li><a href="javascript:;">Page Options</a></li>--}}
    {{--            <li class="active">Page without Sidebar</li>--}}
    {{--        </ol>--}}
    <!-- end breadcrumb -->
        <!-- begin page-header -->
        {{--        todo: get url name  --}}
        <h1 class="page-header text-uppercase">{{ Request::segment(1) }}
            {{--            <small>Updated at: 12-01-2020 11:11:11 WIB</small>--}}
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
                    <form class="form-horizontal form-bordered" id="newRegionForm" style="display: none">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id">
                        <div class="form-group ">
                            <label class="col-md-3 control-label">DEVICE NAME</label>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
{{--                        <div class="form-group hide ">--}}
{{--                            <label class="col-md-3 control-label">Protocol</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" name="protocol" id="protocol" class="form-control" placeholder="Protocol" value="snmp">--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label class="col-md-3 control-label">MANUFACTURE</label>
                            <div class="col-md-6">
                                <select name="manufacturer_id" id="manufacturer_id" class=" selectpicker form-control">
                                    <option value=""> -- Select Mandufacture --</option>
                                    @foreach($manufacture  as $brand)
                                        <option value="{{$brand->id }}">{{ $brand->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">DEVICE TYPE</label>
                            <div class="col-md-3">
                                <select name="device_type_id" id="device_type_id" class=" selectpicker form-control">
                                    <option value=""> -- Select Type --</option>
                                    @foreach($type  as $tp)
                                        <option value="{{$tp->id }}">{{ $tp->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="col-md-3 control-label">A.P.I LABEL </label>
                            <div class="col-md-6">
                                <input type="text" name="api_label" id="api_label" class="form-control" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="col-md-3 control-label">A.P.I KEY </label>
                            <div class="col-md-6">
                                <input  type="text" name="api_key" id="api_key" class="form-control"  readonly  placeholder="Name" value="{{ csrf_token() }}">
                            </div>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label class="col-md-3 control-label">SNMP VERSION</label>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <select name="snmp_version" id="snmp_version" class=" selectpicker form-control">--}}
{{--                                    <option value=""> -- Select Version --</option>--}}
{{--                                    <option value="1">V1</option>--}}
{{--                                    <option value="2">V2c</option>--}}
{{--                                    <option value="3">V3</option>--}}

{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="col-md-3 control-label">SNMP Timeout (s)</label>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <select name="snmp_timeout" id="snmp_timeout" class="selectpicker form-control">--}}
{{--                                    <option value=""> -- Select Seconds --</option>--}}
{{--                                    <option value="5">5</option>--}}
{{--                                    <option value="10">10</option>--}}
{{--                                    <option value="15">15</option>--}}
{{--                                    <option value="20">20</option>--}}

{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label class="col-md-3 control-label">SNMP Retries (x)</label>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <select name="snmp_retries" id="snmp_retries" class="selectpicker form-control">--}}
{{--                                    <option value=""> -- Select Retries --</option>--}}
{{--                                    <option value="1">1</option>--}}
{{--                                    <option value="2">2</option>--}}
{{--                                    <option value="3">3</option>--}}
{{--                                    <option value="4">4</option>--}}
{{--                                    <option value="5">5</option>--}}

{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group ">--}}
{{--                            <label class="col-md-3 control-label">SNMP Read</label>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <input type="text" name="snmp_read" id="snmp_read" class="form-control text-uppercase disabled" placeholder="SNMP Read" value="public">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group ">--}}
{{--                            <label class="col-md-3 control-label">SNMP Write</label>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <input type="text" name="snmp_write" id="snmp_write" class="form-control text-uppercase disabled" placeholder="SNMP Write" value="private">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group ">--}}
{{--                            <label class="col-md-3 control-label">SNMP Port</label>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <input type="text" name="snmp_port" id="snmp_port" class="form-control text-uppercase disabled" placeholder="SNMP Port" value="161">--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <button type="button" class="btn width-100   btn-primary m-r-5 " id="store">Submit</button>
                                <button type="button" class="btn width-100  btn-primary m-r-5 hide" id="update" >Update</button>
                                <button type="reset" class="btn  width-100 btn-default">Refresh</button>
                                <button type="button" class="btn width-100  btn-danger" id="cancel">Cancel</button>
                            </div>
                        </div>

                    </form>

                    <div id="user-list" class="panel-body">

                        <table id="myTable" class="table table-striped table-bordered" width="100%">
                            <thead>
{{--                            <tr>--}}
{{--                                <th class="" colspan="4"></th>--}}

{{--                                <th class="text-center" colspan="6">SNMP</th>--}}
{{--                                <th class=""></th>--}}

{{--                            </tr>--}}
                            <tr>
                                <th class="">Id</th>
                                <th class="">Name</th>
                                <th class="">Brand</th>
                                <th class="">Type</th>
                                <th class="">A.P.I Label</th>
{{--                                <th class="">Version</th>--}}
{{--                                <th class="">Timeout</th>--}}
{{--                                <th class="">Retries</th>--}}
{{--                                <th class="">Read</th>--}}
{{--                                <th class="">Write</th>--}}
{{--                                <th class="">Port</th>--}}
                                <th class="">Created at</th>
                                <th class="">Updated at</th>
                                {{--                                <th class="">Icon Default</th>--}}
                                <th class="text-center">Option</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <button type="button" class="btn width-150 btn-info" id="showForm">Add New <i class="fa fa-plus"></i></button>
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
        function show_loading() {
            swal({
                type: 'info',
                title: 'Loading...',
                allowOutsideClick: false

            });
            swal.showLoading()
        };

        function hide_loading() {
            swal.close()
        };


        var url_manufature_show = "{{ route('device-list') }}";
        console.log('owner id : {{ Auth::user()->owner_id }} ');

        var oTable = $('#myTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            // ajax: url_manufature_show,
            ajax: {
                url: url_manufature_show,
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
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'manufacture.name', name: 'manufacture.name'},
                {data: 'device_type.name', name: 'device_type.name'},
                {data: 'api_label', name: 'api_label'},

                // {data: 'snmp_version', name: 'snmp_version'},
                // {data: 'snmp_timeout', name: 'snmp_timeout'},
                // {data: 'snmp_retries', name: 'snmp_retries'},
                // {data: 'snmp_read', name: 'snmp_read'},
                // {data: 'snmp_write', name: 'snmp_write'},
                // {data: 'snmp_port', name: 'snmp_port'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                // {data: 'icon_default', name: 'icon_default'},
                {data: 'option', name: 'option'}
            ],

        });


        $('#showForm').click(function () {
            $('#newRegionForm').toggle('slide');
            $('#newRegionForm').trigger("reset");
            $('#user-list').toggle('hide');
            $('#store').removeClass("hide");
            $('#update').addClass('hide');

            $('#manufacturer_id').val(null).trigger('change');
            $('#device_type_id').val(null).trigger('change');
            // $('#snmp_version').val(null).trigger('change');
            // $('#snmp_timeout').val(null).trigger('change');
            // $('#snmp_retries').val(null).trigger('change');

        });

        $('#cancel').click(function () {
            $('#id').val("id");
            $('#newRegionForm').toggle('hide');
            $('#user-list').toggle('slide');
            $('#store').removeClass("hide");
            $('#update').addClass('hide');

        });

        function edit(id) {

            $.get("{{ url('device-edit') .'/' }}" + id, function (data) {

                console.log(data);
                $('#newRegionForm').trigger("reset");

                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#api_label').val(data.api_label);
                // $('#snmp_version').val(data.snmp_version);
                // $('#snmp_timeout').val(data.snmp_timeout);
                // $('#snmp_retries').val(data.snmp_retries);
                // $('#snmp_read').val(data.snmp_read);
                // $('#snmp_write').val(data.snmp_write);
                // $('#snmp_port').val(data.snmp_port);

                $('#manufacturer_id').val(data.manufacturer_id);
                $('#manufacturer_id').val(data.manufacturer_id).trigger('change');

                $('#device_type_id').val(data.device_type_id);
                $('#device_type_id').val(data.device_type_id).trigger('change');

                // $('#snmp_version').val(data.snmp_version);
                // $('#snmp_version').val(data.snmp_version).trigger('change');
                //
                // $('#snmp_timeout').val(data.snmp_timeout);
                // $('#snmp_timeout').val(data.snmp_timeout).trigger('change');
                //
                // $('#snmp_retries').val(data.snmp_retries);
                // $('#snmp_retries').val(data.snmp_retries).trigger('change');


                $('#btn-save').val("update");

                $('#newRegionForm').toggle('slide');
                $('#user-list').toggle('hide');
                $('#update').removeClass("hide");
                $('#store').addClass('hide');

            })
        }

        $('#update').click(function (e) {
            console.log('update user');
            var formData = $('#newRegionForm').serialize();

            var id = $('input[name=id]').val();

            show_loading();

            $.ajax({
                url: "{{ url('device-update').'/' }}" + id,
                data: formData,
                type: 'POST',
                //if success
                success: function () {
                    console.log('Update User success');
                    hide_loading();
                    swal({
                        type: 'success',
                        title: "Success!",
                        text: "Data Saved!",
                        timer: 1000,
                        showConfirmButton: false
                    }).then(
                        function () {
                        },
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                console.log('I was closed by the timer');

                            }
                        }
                    );
                    oTable.draw();

                    $('#newRegionForm').toggle('hide');
                    $('#user-list').toggle('slide');
                    $('#newRegionForm').trigger('reset');
                    $('#store').removeClass("hide");
                    $('#update').addClass('hide');
                    $('#id').val('id');

                    e.preventDefault();

                },
                //if error
                error: function (xhr) {
                    var jsonResponse = JSON.parse(xhr.responseText);
                    var errorHtml = '';
                    hide_loading();

                    $.each(jsonResponse, function (index, value) {
                        errorHtml += '<div class="text-left col-sm-offset-1"><li>' + value + '</li></div>';

                    });
                    swal({
                        title: "Error!",
                        html: errorHtml,
                        type: 'error'
                    });
                }

            });
        });

        $('#store').click(function (e) {
            //do something
            console.log('ajax request to store');

            var url = "{{ route('device-create') }}";
            var formData = $('#newRegionForm').serialize();

            // saveForm(url,formData);

            show_loading();

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                //if success
                success: function (data) {
                    console.log(data);
                    // $('#progress').modal('hide');
                    hide_loading();

                    console.log('reload page');

                    swal({
                        type: 'success',
                        title: "Success!",
                        text: "Data Saved!",
                        timer: 1000,
                        showConfirmButton: false
                    }).then(
                        function () {
                            reloadPage();
                        },
                        function (dismiss) {

                            if (dismiss === 'timer') {
                                console.log('I was closed by the timer');

                            }
                        }
                    );
                    oTable.draw();

                    $('#newRegionForm').toggle('hide');
                    $('#user-list').toggle('slide');
                    $('#newRegionForm').trigger("reset");


                },
                //if error
                error: function (xhr) {
                    var jsonResponse = JSON.parse(xhr.responseText);
                    var errorHtml = '';
                    hide_loading();

                    $.each(jsonResponse, function (index, value) {
                        errorHtml += '<div class="text-left col-sm-offset-1"><li>' + value + '</li></div>';

                    });
                    swal({
                        title: "Error!",
                        html: errorHtml,
                        type: 'error'
                    });
                }
            });

            // $('#newRegionForm').toggle('hide');
            // $('#user-list').toggle('slide');
            // $('#newRegionForm').trigger("reset");

            e.preventDefault(); //This is to Avoid Page Refresh and Fire the Event "Click"
        });


        function deleteData(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                // cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it !'
            }).then(
                function () {
                    console.log('Call ajax delete request');
                    show_loading();
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: "{{ url('device-destroy').'/' }}" + id,
                        type: "DELETE",
                        data: {_token: _token},
                        //if success
                        success: function () {
                            hide_loading();
                            swal({
                                title: "Deleted",
                                text: "User has been successfully deleted",
                                type: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(
                                function () {
                                },
                                function (dismiss) {
                                    if (dismiss === 'timer') {
                                        console.log('I was closed by the timer');

                                    }
                                }
                            );
                            oTable.draw();
                        },
                        //if error
                        error: function (xhr) {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            var errorHtml = '';
                            hide_loading();

                            $.each(jsonResponse, function (index, value) {
                                errorHtml += '<div class="text-left col-sm-offset-1"><li>' + value + '</li></div>';

                            });
                            swal({
                                title: "Error!",
                                html: errorHtml,
                                type: 'error'
                            });
                        }
                    })

                },
                function (dismiss) {
                    if (dismiss == 'cancel') {
                        console.log('Canceled');
                    }
                }
            )
        }


    </script>
@endsection