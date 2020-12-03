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
                        <div class="form-group">
                            <label class="col-md-3 control-label">DEVICE</label>
                            <div class="col-md-6">
                                <select name="device_id" id="device_id" class=" selectpicker form-control">
                                    <option value=""> -- Select Device --</option>
                                    @foreach($device_list as $device)
                                        <option value="{{ $device->id }}">{{ $device->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-md-3 control-label text-uppercase">Parameter Name</label>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label text-uppercase">Alias Name</label>
                            <div class="col-md-6">
                                <input type="text" name="alias" id="alias" class="form-control" placeholder="Name">
                            </div>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label class="col-md-3 control-label">Severities</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <select name="severity_id" id="severity_id" class=" selectpicker form-control">--}}
{{--                                    <option value=""> -- Select Device --</option>--}}
{{--                                    @foreach($severities as $severity)--}}
{{--                                        <option value="{{ $severity->id }}">{{ $severity->name }}</option>--}}
{{--                                    @endforeach--}}

{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <input type="hidden" name="group" id="group" value="POLLING">
                        <input type="hidden" name="severity_id" id="severity_id" value="1">
                        <input type="hidden" name="notification_id" id="notification_id" value="1">


{{--                        <div class="form-group">--}}
{{--                            <label class="col-md-3 control-label text-uppercase">object type</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <select name="var_type" id="var_type" class=" selectpicker form-control">--}}
{{--                                    <option value=""> -- Select Type Object --</option>--}}
{{--                                    <option value="integer">Integer</option>--}}
{{--                                    <option value="string">String</option>--}}
{{--                                    <option value="double">Double</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group ">
                            <label class="col-md-3 control-label text-uppercase">Unit</label>
                            <div class="col-md-6">
                                <input type="text" name="unit" id="unit" class="form-control" placeholder="Unit">
                            </div>
                        </div>
{{--                        <div class="form-group ">--}}
{{--                            <label class="col-md-3 control-label text-uppercase">OID</label>--}}
{{--                            <div class="col-md-5">--}}
{{--                                <input type="text" name="var_oid" id="var_oid" class="form-control" placeholder="OID">--}}
{{--                                <label for="">Example OID: .1.3.6.1.4.1.47865.3.20.10.30.10.0 </label>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-1">--}}
{{--                                <input type="text" name="var_instance" id="var_instance" class="form-control" placeholder="x" >--}}
{{--                                <label for="">instance </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group ">--}}
{{--                            <label class="col-md-3 control-label text-uppercase">devider</label>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <select name="var_devider" id="var_devider" class=" selectpicker form-control">--}}
{{--                                    <option value=""> -- Select Devider --</option>--}}
{{--                                    <option value="1">1</option>--}}
{{--                                    <option value="10">10</option>--}}
{{--                                    <option value="100">100</option>--}}
{{--                                    <option value="1000">1000</option>--}}
{{--                                    <option value="10000">10000</option>--}}

{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group hide ">--}}
{{--                            <label class="col-md-3 control-label text-uppercase">Object Name</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input type="text" name="polled_status" id="polled_status" class="form-control" placeholder="Name" value="1">--}}
{{--                            </div>--}}
{{--                        </div>--}}



                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <button type="button" class="btn width-100   btn-primary m-r-5 " id="store">Submit</button>
                                <button type="button" class="btn width-100  btn-primary m-r-5 hide" id="update">Update</button>
                                <button type="reset" class="btn  width-100 btn-default">Refresh</button>
                                <button type="button" class="btn width-100  btn-danger" id="cancel">Cancel</button>
                            </div>
                        </div>

                    </form>

                    <div id="user-list" class="panel-body">

                        <table id="myTable" class="table table-striped table-bordered" width="100%">
                            <thead>
                            <tr>
                                <th class="">Id</th>
                                <th class="">Device</th>
                                <th class="">Parameter Name</th>
                                <th class="">Alias</th>
{{--                                <th class="">Object Type</th>--}}
                                <th class="">Unit</th>
{{--                                <th class="">OID</th>--}}
{{--                                <th class="">Instance</th>--}}
{{--                                <th class="">Devider</th>--}}
                                {{--                                <th class="">Polled Status</th>--}}
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


        var url_manufature_show = "{{ route('polling-object-list') }}";
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
                {data: 'device.name', name: 'device.name'},
                // {data: 'manufacture.name', name: 'manufacture.name'},
                {data: 'name', name: 'name'},
                {data: 'alias', name: 'alias'},
                {data: 'unit', name: 'unit'},
                // {data: 'severity', name: 'severity'},
                // {data: 'var_oid', name: 'var_oid'},
                // {data: 'var_instance', name: 'var_instance'},
                // {data: 'var_devider', name: 'var_devider'},
                // {data: 'polled_status', name: 'polled_status'},

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

            // $('#var_devider').val(null).trigger('change');

            // $('#var_type').val(null).trigger('change');

            $('#device_id').val(null).trigger('change');


        });

        $('#cancel').click(function () {
            $('#id').val('id');
            $('#newRegionForm').toggle('hide');
            $('#user-list').toggle('slide');
            $('#store').removeClass("hide");
            $('#update').addClass('hide');

        });

        function edit(id) {

            $.get("{{ url('polling-object-edit') .'/' }}" + id, function (data) {

                console.log(data);
                $('#newRegionForm').trigger("reset");

                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#alias').val(data.alias);
                // $('#snmp_version').val(data.snmp_version);
                // $('#snmp_timeout').val(data.snmp_timeout);
                // $('#snmp_retries').val(data.snmp_retries);
                $('#unit').val(data.unit);
                // $('#var_oid').val(data.var_oid);
                // $('#var_instance').val(data.var_instance);

                // $('#var_devider').val(data.var_devider);
                // $('#var_devider').val(data.var_devider).trigger('change');

                // $('#var_type').val(data.var_type);
                // $('#var_type').val(data.var_type).trigger('change');

                $('#device_id').val(data.device_id);
                $('#device_id').val(data.device_id).trigger('change');

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
                url: "{{ url('polling-object-update').'/' }}" + id,
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

            var url = "{{ route('polling-object-create') }}";
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
                    )
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
                        url: "{{ url('polling-object-destroy').'/' }}" + id,
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