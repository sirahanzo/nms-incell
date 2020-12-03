<div class="dropdown-menu dropdown-menu-lg animated fadeInLeft">
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <h4 class="dropdown-header">MONITORING</h4>
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Dashboard</a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="{{ route('survailance') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Survailance</a>--}}
{{--                        </li>--}}
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
                    {{--                </div>--}}
                    {{--                <div class="col-md-6 col-xs-6">--}}
                    <p/>

                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-3">
            <h4 class="dropdown-header">LOG FILES</h4>

            <ul class="nav">
                <li>
                    <a href="{{ route('log-data') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Data Monitoring</a>
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

        <div class="col-md-3 col-sm-3">
            <h4 class="dropdown-header">SITE MANAGEMENT {{--<span class="label label-inverse">11</span>--}}
            </h4>
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <ul class="nav">
                        {{--                        <li><a href="{{route('region')}}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>Regions</a></li>--}}
                        <li><a href="{{ route('city') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Sub Regions </a></li>
                        <li><a href="{{ route('site') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Sites</a></li>
                        <li><a href="{{ route('node') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i> Nodes</a></li>
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
        <div class="col-md-3 col-sm-3">
            <h4 class="dropdown-header">USER MANAGEMENT {{--<span class="label label-inverse">11</span>--}}
            </h4>
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <ul class="nav">
                        <li><a href="{{ route('user-management') }}" class="text-ellipsis"><i class="fa fa-angle-right fa-fw fa-lg text-inverse"></i>User Administration</a></li>
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
        {{--<div class="col-md-4 col-sm-4">
            <h4 class="dropdown-header">Paragraph</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis libero purus,
                fermentum at libero convallis, auctor dignissim mauris. Nunc laoreet
                pellentesque turpis sodales ornare. Nunc vestibulum nunc lorem, at sodales velit
                malesuada congue. Nam est tortor, tincidunt sit amet eros vitae, aliquam finibus
                mauris.
            </p>
            <p>
                Fusce ac ligula laoreet ante dapibus mattis. Nam auctor vulputate aliquam.
                Suspendisse efficitur, felis sed elementum eleifend, ipsum tellus sodales nisi,
                ut condimentum nisi sem in nibh. Phasellus suscipit vulputate purus at
                venenatis. Quisque luctus tincidunt tempor.
            </p>
        </div>--}}
    </div>
</div>