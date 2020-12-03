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

                    <form class="form-horizontal form-bordered" id="newUserForm" style="display: none">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label class="col-md-3 control-label">FULL NAME</label>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">USER NAME</label>
                            <div class="col-md-6">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">EMAIL</label>
                            <div class="col-md-6">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">PHONE</label>
                            <div class="col-md-6">
                                <input type="phone" name="phone" id="phone" class="form-control" placeholder="Phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">PASSWORD</label>
                            <div class="col-md-6">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">CONFIRM PASSWORD</label>
                            <div class="col-md-6">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">LEVEL</label>
                            <div class="col-md-6">
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value=""> -- Select Level --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->level }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">OWNERS</label>
                            <div class="col-md-6">
                                <select name="owner_id" id="owner_id" class="form-control">
                                    <option value=""> -- Select Owners --</option>
                                    @foreach($owners as $owner)
                                        <option value="{{ $owner->id }}">{{ $owner->corporation_name }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="col-md-3 control-label">USER REGION</label>
                            <div class="col-md-6">
                                <select name="region_oid" id="region_oid" class="form-control">
                                    <option value=""> -- Select User Regions --</option>
                                    @foreach($regions as $data)
                                        <option value="{{ $data->oid }}">{{ $data->name }} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">NOTIFCATIONS</label>
                            <div class="col-md-6">
                                <select name="notification_id" id="notification_id" class="form-control">
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
                                <th class="col-sm-5">Name</th>
                                <th class="col-lg-4">Username</th>
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
        var url_manufature_show = "{{ route('user-list') }}";

        var oTable = $('#myTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            {{--            ajax: '{{ route('user-list') }}',--}}
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
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'option', name: 'option'}
            ]
        });


        $('#showForm').click(function () {
            $('#newUserForm').toggle('slide');
            $('#newUserForm').trigger("reset");
            $('#user-list').toggle('hide');
            $('#store').removeClass("hide");
            $('#update').addClass('hide');

            $('#role_id').val(null).trigger('change');

            $('#owner_id').val(null).trigger('change');

            $('#notification_id').val(null).trigger('change');

            $('#region_oid').val(null).trigger('change');


        });

        $('#cancel').click(function () {
            $('#id').val('id');
            $('#newUserForm').toggle('hide');
            $('#user-list').toggle('slide');
            $('#store').removeClass("hide");
            $('#update').addClass('hide');

        });

        function edit(id) {

            $.get("{{ url('user-edit').'/'}}" + id, function (data) {
                console.log(data);
                $('#newUserForm').trigger("reset");

                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#username').val(data.username);
                $('#email').val(data.email);
                $('#phone').val(data.phone);

                $('#role_id').val(data.role_id);
                $('#role_id').val(data.role_id).trigger('change');

                $('#owner_id').val(data.owner_id);
                $('#owner_id').val(data.owner_id).trigger('change');

                $('#notification_id').val(data.notification_id);
                $('#notification_id').val(data.notification_id).trigger('change');

                $('#region_oid').val(data.region_oid);
                $('#region_oid').val(data.region_oid).trigger('change');

                // $('#email_group').addClass('hide');
                // $('#level').val(data.level);
                $('#btn-save').val("update");

                $('#newUserForm').toggle('slide');
                $('#user-list').toggle('hide');
                // $('#store').attr('id', 'update');

                $('#update').removeClass("hide");
                $('#store').addClass('hide');

            })
        }

        $('#update').click(function (e) {
            console.log('update user');
            var formData = $('#newUserForm').serialize();

            var id = $('input[name=id]').val();

            show_loading();

            $.ajax({
                url: "{{ url('user-update').'/' }}" + id,
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
                    $('#newUserForm').toggle('hide');
                    $('#user-list').toggle('slide');
                    $('#newUserForm').trigger("reset");
                    $('#id').val('id');


                    $('#store').removeClass("hide");
                    $('#update').addClass('hide');

                    e.preventDefault();

                },
                //if error
                error: function (xhr) {
                    var jsonResponse = JSON.parse(xhr.responseText);
                    var errorHtml = '';
                    hide_loading()

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

            var url = '{{ route('user-create') }}';
            var formData = $('#newUserForm').serialize();

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

                    $('#newUserForm').toggle('hide');
                    $('#user-list').toggle('slide');
                    $('#newUserForm').trigger('reset');


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


        function deleteData(userID) {
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
                        url: "{{ url('user-destroy') }}/" + userID,
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

                            // var jsonResponse = JSON.parse(xhr.responseText);
                            // var errorHtml = '';
                            // hide_loading();
                            //
                            // $.each(jsonResponse, function (index, value) {
                            //     errorHtml += '<div class="text-left col-sm-offset-1"><li>' + value + '</li></div>';
                            //
                            // });
                            swal({
                                title: "Error!",
                                html: '<li>Not Authorized</li>',
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