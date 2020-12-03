<div class="dropdown-menu dropdown-menu-lg animated fadeInLeft">
    <div class="row">
            <div class="col-sm-3">
                <h4 class="dropdown-header">MONITORING</h4>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('dashboard') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Dashboard</a>
                            </li>
                            <li>
                                {{--                            <a href="{{ route('survailance') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Survailance</a>--}}
                            </li>
                            <li>
                                <a href="{{ route('monitoring') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Site Monitoring</a>
                            </li>
                            {{--<li>
                                <a href="{{ route('log-data') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Log Files</a>
                            </li>--}}
                            {{--<li>
                                <a href="#{{ route('map') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>MAP</a>
                            </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <h4 class="dropdown-header">LOG FILES</h4>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('log-inbox') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Inbox Received Data</a>
                            </li>
                            <li>
                                <a href="{{ route('log-data') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Data
                                    Monitoring</a>
                            </li>
                            <li>
                                <a href="{{ route('log-event') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Data Event/Alarm</a>
                            </li>
                            {{--                        <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>--}}
                            {{--                                Unlimited Nav Tabs</a></li>--}}
                            {{--                        <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Modal &amp;--}}
                            {{--                                Notification</a></li>--}}
                            {{--                        <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Buttons</a>--}}
                            {{--                        </li>--}}
                        </ul>
                    </div>
                </div>
            </div>

        <div class="col-sm-3">
            <h4 class="dropdown-header">REPORT</h4>
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('raw-report') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Raw Report</a>
                        </li>
                        <li>
                            {{--                            <a href="{{ route('survailance') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Survailance</a>--}}
                        </li>
                        <li>
                            <a href="{{ route('summary-report') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Summary Monthly Report</a>
                        </li>
                        {{--<li>
                            <a href="{{ route('log-data') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Log Files</a>
                        </li>--}}
                        {{--<li>
                            <a href="#{{ route('map') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>MAP</a>
                        </li>--}}
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="row m-t-50">
            <div class="col-sm-3">
                <h4 class="dropdown-header">DEVICE MANAGEMENT</h4>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('manufacturer') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Brand
                                    Manufacture</a>
                            </li>
                            <li>
                                <a href="{{ route('device-type') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Device Type</a>
                            </li>
                            <li>
                                <a href="{{ route('device') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Device List</a>
                            </li>
                            <li>
                                <a href="{{ route('parameter-polling') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Parameter
                                    Polling Register</a>
                            </li>
                            <li>
                                <a href="{{ route('parameter-alarm') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Parameter
                                    Alarm Register</a>
                            </li>
                        </ul>
                    </div>
                    {{--<div class="col-md-6 col-xs-6">
                        <ul class="nav">
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>
                                    Unlimited Nav Tabs</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Modal &amp;
                                    Notification</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Buttons</a>
                            </li>
                        </ul>
                    </div>--}}
                </div>
            </div>
            <div class="col-sm-3">
                <h4 class="dropdown-header">SITE MANAGEMENT {{--<span class="label label-inverse">11</span>--}}
                </h4>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <ul class="nav">
                            <li><a href="{{route('region')}}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Region</a></li>
                            <li><a href="{{ route('city') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> City </a></li>
                            <li><a href="{{ route('site') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Site</a></li>
                            <li><a href="{{ route('node') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Node</a></li>
                        </ul>
                    </div>
                    {{--<div class="col-md-6 col-xs-6">
                        <ul class="nav">
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Full
                                    Height Content</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Page
                                    with Mega Menu</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Page
                                    with Light Sidebar</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Page
                                    with Large Sidebar</a></li>
                        </ul>
                    </div>--}}
                </div>
            </div>

            <div class="col-sm-3">
                <h4 class="dropdown-header">USER MANAGEMENT {{--<span class="label label-inverse">11</span>--}}
                </h4>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <ul class="nav">
                            <li><a href="{{ route('user-management') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>User
                                    Administration</a></li>
                            {{--                                                <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Cities </a></li>--}}
                            {{--                                                <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Sites</a></li>--}}
                        </ul>
                    </div>
                    {{--<div class="col-md-6 col-xs-6">
                        <ul class="nav">
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Full
                                    Height Content</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Page
                                    with Mega Menu</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Page
                                    with Light Sidebar</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Page
                                    with Large Sidebar</a></li>
                        </ul>
                    </div>--}}
                </div>
            </div>
            <div class="col-sm-6">
                {{--<h4 class="dropdown-header">SITE MANAGEMENT --}}{{--<span class="label label-inverse">11</span>--}}{{--
                </h4>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <ul class="nav">
                            <li><a href="{{route('region')}}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Region</a></li>
                            <li><a href="{{ route('city') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> City </a></li>
                            <li><a href="{{ route('site') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Site</a></li>
                            <li><a href="{{ route('node') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Node</a></li>
                        </ul>
                    </div>
                    --}}{{--<div class="col-md-6 col-xs-6">
                        <ul class="nav">
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Full
                                    Height Content</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Page
                                    with Mega Menu</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Page
                                    with Light Sidebar</a></li>
                            <li><a href="#" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Page
                                    with Large Sidebar</a></li>
                        </ul>
                    </div>--}}{{--
                </div>--}}
            </div>
    </div>
</div>