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
                        {{--                        <input type="hidden" name="oid" id="oid">--}}
                        <div class="form-group">
                            <label class="col-md-3 control-label">NODE NAME</label>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">SERIAL NUMBER</label>
                            <div class="col-md-6">
                                <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">IPADDRESS</label>
                            <div class="col-md-6">
                                <input type="text" name="ipaddress" id="ipaddress" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-md-3 control-label">protocol</label>
                            <div class="col-md-6">
                                <input type="text" name="protocol_monitoring" id="protocol_monitoring" class="form-control" placeholder="Name" value="HTTP">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-md-3 control-label">status</label>
                            <div class="col-md-6">
                                <input type="text" name="status" id="status" class="form-control" placeholder="Name" value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label text-uppercase">SITE NAME</label>
                            <div class="col-md-6">
                                <select name="site_oid" id="site_oid" class=" selectpicker form-control">
                                    <option value=""> -- Select Site --</option>
                                    @foreach($sites as $site)
                                        <option value="{{ $site->oid }}">{{ $site->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="device_list">
                            <label class="col-md-3 control-label text-uppercase">DEVICE NAME</label>
                            <div class="col-md-6">
                                <select name="device_id" id="device_id" class=" selectpicker form-control">
                                    <option value=""> -- Select Device --</option>
                                    @foreach($devices as $device)
                                        <option value="{{ $device->id }}">{{ $device->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group hide">
                            <label class="col-md-3 control-label">ICON</label>
                            <div class="col-md-6">
                                <select name="icon" id="icon" class=" selectpicker form-control">
                                    <option value=""> -- Select Icon --</option>
                                    <option data-icon="fa fa-sitemap fa-lg" value="fa fa-sitemap fa-lg">Network</option>
                                    <option data-icon="icon-globe fa-lg" value="icon-globe fa-lg">Globe</option>
                                    <option data-icon="fa fa-flag fa-lg" value="fa fa-flag fa-lg">Flag</option>
                                    <option data-icon="fa fa-home fa-lg" value="fa fa-home fa-lg">Home</option>
                                    <option data-icon="fa fa-building fa-lg" value="fa fa-building fa-lg">Building</option>
                                    <option data-icon="fa fa-map-marker fa-lg" value="fa fa-map-marker fa-lg">Map Marker</option>
                                    <option data-icon="fa fa-folder text-warning fa-lg" value="fa fa-folder text-warning fa-lg">Folder</option>
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
                                <th class=""> Id</th>
                                <th class=""> Node</th>
                                <th class=""> Device</th>
{{--                                <th class=""> Poller</th>--}}
                                <th class=""> Serial Number</th>
                                <th class=""> IPAddress</th>
                                <th class=""> Site Origin</th>
                                <th class=""> Created at</th>
                                <th class=""> Updated at</th>
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


        var url_manufature_show = "{{ route('node-list') }}";
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
                {data: 'device.name', name: 'device.name'},
                // {data: 'poller_ipaddress', name: 'poller_ipaddress'},
                {data: 'serial_number', name: 'serial_number'},
                {data: 'ipaddress', name: 'ipaddress'},
                {data: 'site.name', name: 'site.name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                // {data: 'icon_default', name: 'icon_default'},
                {data: 'option', name: 'option'}
            ],

        });

        // oTable.on('order.dt search.dt', function () {
        //     oTable.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
        //         cell.innerHTML = i + 1;
        //     });
        // }).draw();



        $('#showForm').click(function () {
            $('#newRegionForm').toggle('slide');
            $('#newRegionForm').trigger("reset");
            $('#user-list').toggle('hide');
            $('#store').removeClass("hide");
            $('#update').addClass('hide');
            $('#device_id').val(null).trigger('change');
            $('#device_list').addClass('show').removeClass('hide');


            $('#site_oid').val(null).trigger('change');

            // $('#poller_ipaddress').val(null).trigger('change');


        });

        $('#cancel').click(function () {
            $('#id').val("id");
            $('#newRegionForm').toggle('hide');
            $('#user-list').toggle('slide');
            $('#store').removeClass("hide");
            $('#update').addClass('hide');

        });

        function edit(id) {

            $.get("{{ url('node-edit') .'/' }}" + id, function (data) {

                console.log(data);
                $('#newRegionForm').trigger("reset");

                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#serial_number').val(data.serial_number);
                $('#ipaddress').val(data.ipaddress);
                // $('#longitude').val(data.longitude);
                // $('#latitude').val(data.latitude);

                //due to no function to handle change this devicelist on update
                $('#device_list').addClass('hide').removeClass('show');

                $('#device_id').val(data.device_id);
                $('#device_id').val(data.device_id).trigger('change');


                $('#site_oid').val(data.site_oid);
                $('#site_oid').val(data.site_oid).trigger('change');

                // $('#poller_ipaddress').val(data.poller_ipaddress);
                // $('#poller_ipaddress').val(data.poller_ipaddress).trigger('change');

                $('#btn-save').val("update");

                $('#newRegionForm').toggle('slide');
                $('#user-list').toggle('hide');
                $('#update').removeClass("hide");
                $('#store').addClass('hide');

                // $('#store').toggle('hide');
                // $('#update').toggle('show');


            })
        }

        $('#update').click(function (e) {
            console.log('update user');
            var formData = $('#newRegionForm').serialize();

            var id = $('input[name=id]').val();

            show_loading();

            $.ajax({
                url: "{{ url('node-update').'/' }}" + id,
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

            var url = "{{ route('node-create') }}";
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
                        url: "{{ url('node-destroy').'/' }}" + id,
                        type: "DELETE",
                        data: {_token: _token},
                        //if success
                        success: function () {
                            hide_loading();
                            swal({
                                title: "Deleted",
                                text: "Node has been successfully deleted",
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