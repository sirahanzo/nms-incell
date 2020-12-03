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
                            <label class="col-md-3 control-label text-uppercase">Alarm Name</label>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-md-3 control-label text-uppercase">Alarm Alias Name</label>
                            <div class="col-md-6">
                                <input type="text" name="alias" id="alias" class="form-control" placeholder="Alias">
                            </div>
                        </div>

                        <input type="hidden" id="group" name="group" value="ALARM">
                        <input type="hidden" id="unit" name="unit" value="-">

                        <div class="form-group ">
                            <label class="col-md-3 control-label text-uppercase">severity</label>
                            <div class="col-md-3">
                                <select name="severity_id" id="severity_id" class=" selectpicker form-control">
                                    <option value=""> -- Select Severity --</option>
                                    @foreach($severities as $severity)
                                        <option value="{{ $severity->id }}">{{ $severity->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label text-uppercase">Send Notification By</label>
                            <div class="col-md-3">
                                <select name="notification_id" id="notification_id" class=" selectpicker form-control text-capitalize">
                                    <option value=""> -- Select Notifications --</option>
                                    @foreach($notifications as $notif)
                                        <option value="{{ $notif->id }}">{{ $notif->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

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
                                <th class="">Alarm Name</th>
                                <th class="">Alias Name</th>
{{--                                <th class="">OID</th>--}}
{{--                                <th class="">Trap Type</th>--}}
                                <th class="">Severity</th>
                                <th class="">Notification By</th>
                                <th class="">Created at</th>
                                <th class="">Updated at</th>
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


        var url_manufature_show = "{{ route('trap-object-list') }}";
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
                {data: 'name', name: 'name'},
                {data: 'alias', name: 'alias'},
                // {data: 'var_oid', name: 'var_oid'},
                // {data: 'type_trap', name: 'type_trap'},
                {data: 'severity.name', name: 'severity.name'},
                {data: 'notification_type', name: 'notification_type'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'option', name: 'option'}
            ],

        });


        $('#showForm').click(function () {
            $('#newRegionForm').toggle('slide');
            $('#newRegionForm').trigger("reset");
            $('#user-list').toggle('hide');
            $('#store').removeClass("hide");
            $('#update').addClass('hide');

            $('#device_id').val(null).trigger('change');

            // $('#var_type').val(null).trigger('change');

            $('#severity_id').val(null).trigger('change');

            $('#notification_id').val(null).trigger('change');

            // $('#type_trap').val(null).trigger('change');


        });

        $('#cancel').click(function () {
            $('#id').val('id');
            $('#newRegionForm').toggle('hide');
            $('#user-list').toggle('slide');
            $('#store').removeClass("hide");
            $('#update').addClass('hide');

        });

        function edit(id) {

            $.get("{{ url('trap-object-edit') .'/' }}" + id, function (data) {

                console.log(data);
                $('#newRegionForm').trigger("reset");

                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#alias').val(data.alias);
                // $('#var_oid').val(data.var_oid);

                $('#device_id').val(data.device_id);
                $('#device_id').val(data.device_id).trigger('change');

                // $('#var_type').val(data.var_type);
                // $('#var_type').val(data.var_type).trigger('change');

                // $('#type_trap').val(data.type_trap);
                // $('#type_trap').val(data.type_trap).trigger('change');

                $('#severity_id').val(data.severity_id);
                $('#severity_id').val(data.severity_id).trigger('change');

                $('#notification_id').val(data.notification_id);
                $('#notification_id').val(data.notification_id).trigger('change');

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
                url: "{{ url('trap-object-update').'/' }}" + id,
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

            var url = "{{ route('trap-object-create') }}";
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
                        url: "{{ url('trap-object-destroy').'/' }}" + id,
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

        $('#device_id').change(function(){
            // alert($(this).val());
            if($(this).val() === '5'){
                console.log('change lable oid');
                $('#lbl_oid').text('Trap Alarm Number');
                $('#lbl_oid2').text('Example OID: 12');
            }else{
                console.log('none');
            }
        })
    </script>
@endsection