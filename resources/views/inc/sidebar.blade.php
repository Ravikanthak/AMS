<a href="#" class="brand-link">
    <img src="{{ asset('/img/logo.png') }}" alt="SL ARMY" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">WTTAM System</span><br>
    <p style="font-size: 12px; text-align: center;margin-top: 5px; color: cadetblue; text-wrap: initial">{{ isset($userOrg)?$userOrg:'' }}</p>
</a>

<div class="sidebar">

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image text-white">
            <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
            {{ Auth::user()->name }}<br>

        </div>
        <div class="info">
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item dashboard_li">
                <a href="{{route('dashboard')}}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>


            @if(\Illuminate\Support\Facades\Auth::user()->user_type !=1)
            <li class="nav-item troops_transport_li">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-people-arrows"></i>
                    <p>Troops Transport
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('auth_req_ltr_troops')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Authority Req</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('auth_req_ltr_troops_view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Sent Requests</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('auth_req_ltr_troops_take_action_view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Take Action</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item weapon_transport_li">
                <a href="#" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M528 56c0-13.3-10.7-24-24-24s-24 10.7-24 24v8H32C14.3 64 0 78.3 0 96V208c0 17.7 14.3 32 32 32H42c20.8 0 36.1 19.6 31 39.8L33 440.2c-2.4 9.6-.2 19.7 5.8 27.5S54.1 480 64 480h96c14.7 0 27.5-10 31-24.2L217 352H321.4c23.7 0 44.8-14.9 52.7-37.2L400.9 240H432c8.5 0 16.6-3.4 22.6-9.4L477.3 208H544c17.7 0 32-14.3 32-32V96c0-17.7-14.3-32-32-32H528V56zM321.4 304H229l16-64h105l-21 58.7c-1.1 3.2-4.2 5.3-7.5 5.3zM80 128H464c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                    </svg>
                    <p>Weapon Transport
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('auth_req_ltr_weapons')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Authority Req</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('auth_req_ltr_weapons_view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Sent Requests</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('auth_req_ltr_weapons_take_action_view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Take Action</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item report_li">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>Report
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../tables/simple.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Troops Authority Reqs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../tables/data.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Weapon Authority Reqs</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            {{--@if (isset(auth()->user()->user_type) && auth()->user()->user_type == '1')--}}
            {{--<li class="nav-item settings_li">--}}
            {{--<a href="#" class="nav-link">--}}
            {{--<i class="nav-icon fas fa-cog"></i>--}}
            {{--<p>Settings--}}
            {{--<i class="fas fa-angle-left right"></i>--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--<ul class="nav nav-treeview">--}}
            {{--<li class="nav-item">--}}
            {{--<a href="{{route('create_user')}}" class="nav-link">--}}
            {{--<i class="far fa-circle nav-icon"></i>--}}
            {{--<p>Create Admin User</p>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--<ul class="nav nav-treeview">--}}
            {{--<li class="nav-item">--}}
            {{--<a href="../tables/simple.html" class="nav-link">--}}
            {{--<i class="far fa-circle nav-icon"></i>--}}
            {{--<p>Change Password</p>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--@else--}}
            {{--@endif--}}


            <li class="nav-item settings_li">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>User Management
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @if(Auth::user()->user_type ==1)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('org_armoury.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Organization Armoury</p>
                        </a>
                    </li>
                </ul>
                @endif
                @if(Auth::user()->user_type !=1 || auth()->user()->can('role-management'))
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('roles.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role Manage</p>
                            </a>
                        </li>
                    </ul>
                @endif
                @if(Auth::user()->user_type ==1 || Auth::user()->user_type ==2 || Auth::user()->user_type ==5 || Auth::user()->user_type ==8 || Auth::user()->user_type ==11 || Auth::user()->user_type ==17 || Auth::user()->user_type ==23 || auth()->user()->can('user-management'))
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('create_user')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Create</p>
                            </a>
                        </li>
                    </ul>
                @endif
                @if(Auth::user()->user_type !=1  || auth()->user()->can('view-organization-resources'))
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('resource.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Org Resources</p>
                            </a>
                        </li>
                    </ul>
                @endif

            </li>


        </ul>

    </nav>
</div>