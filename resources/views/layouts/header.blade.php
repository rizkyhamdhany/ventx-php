<div class="page-header navbar-fixed-top blur hidden-print">
    <!-- BEGIN HEADER INNER -->
    <div class="clearfix">
        <!-- BEGIN BURGER TRIGGER -->
        <div class="burger-trigger">
            <button class="menu-trigger">
                <img src="{{URL('/')}}/assets/layouts/layout/img/sidebar-toggler.png" alt=""> </button>
            <div class="menu-overlay menu-overlay-bg-transparent">
                <div class="menu-overlay-content">
                    <ul class="menu-overlay-nav text-uppercase">
                        <li>
                            <a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li>
                            <a href="#">Reports</a>
                        </li>
                        <!--<li>
                            <a href="#">Templates</a>
                        </li>-->
                        <li>
                            <a href="#">Support</a>
                        </li>
                        <!--<li>
                            <a href="#">Settings</a>
                        </li>-->
                    </ul>
                </div>
            </div>
            <div class="menu-bg-overlay">
                <button class="menu-close">&times;</button>
            </div>
            <!-- the overlay element -->
        </div>
        <!-- END NAV TRIGGER -->
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html">
                <img src="{{URL('/')}}/assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        {{--<span class="badge badge-success"> 7 </span>--}}
                    </a>
                    {{--<ul class="dropdown-menu">--}}
                    {{--<li class="external">--}}
                    {{--<h3>--}}
                    {{--<span class="bold">12 pending</span> notifications</h3>--}}
                    {{--<a href="#">view all</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">--}}
                    {{--<li>--}}
                    {{--<a href="javascript:;">--}}
                    {{--<span class="time">just now</span>--}}
                    {{--<span class="details">--}}
                    {{--<span class="label label-sm label-icon label-success">--}}
                    {{--<i class="fa fa-plus"></i>--}}
                    {{--</span> New user registered. </span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="javascript:;">--}}
                    {{--<span class="time">3 mins</span>--}}
                    {{--<span class="details">--}}
                    {{--<span class="label label-sm label-icon label-danger">--}}
                    {{--<i class="fa fa-bolt"></i>--}}
                    {{--</span> Server #12 overloaded. </span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="javascript:;">--}}
                    {{--<span class="time">10 mins</span>--}}
                    {{--<span class="details">--}}
                    {{--<span class="label label-sm label-icon label-warning">--}}
                    {{--<i class="fa fa-bell-o"></i>--}}
                    {{--</span> Server #2 not responding. </span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="javascript:;">--}}
                    {{--<span class="time">14 hrs</span>--}}
                    {{--<span class="details">--}}
                    {{--<span class="label label-sm label-icon label-info">--}}
                    {{--<i class="fa fa-bullhorn"></i>--}}
                    {{--</span> Application error. </span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="javascript:;">--}}
                    {{--<span class="time">2 days</span>--}}
                    {{--<span class="details">--}}
                    {{--<span class="label label-sm label-icon label-danger">--}}
                    {{--<i class="fa fa-bolt"></i>--}}
                    {{--</span> Database overloaded 68%. </span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="javascript:;">--}}
                    {{--<span class="time">3 days</span>--}}
                    {{--<span class="details">--}}
                    {{--<span class="label label-sm label-icon label-danger">--}}
                    {{--<i class="fa fa-bolt"></i>--}}
                    {{--</span> A user IP blocked. </span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="javascript:;">--}}
                    {{--<span class="time">4 days</span>--}}
                    {{--<span class="details">--}}
                    {{--<span class="label label-sm label-icon label-warning">--}}
                    {{--<i class="fa fa-bell-o"></i>--}}
                    {{--</span> Storage Server #4 not responding dfdfdfd. </span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="javascript:;">--}}
                    {{--<span class="time">5 days</span>--}}
                    {{--<span class="details">--}}
                    {{--<span class="label label-sm label-icon label-info">--}}
                    {{--<i class="fa fa-bullhorn"></i>--}}
                    {{--</span> System Error. </span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="javascript:;">--}}
                    {{--<span class="time">9 days</span>--}}
                    {{--<span class="details">--}}
                    {{--<span class="label label-sm label-icon label-danger">--}}
                    {{--<i class="fa fa-bolt"></i>--}}
                    {{--</span> Storage server failed. </span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                </li>
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <div class="dropdown-user-inner">
                            <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                            <img alt="" src="{{URL('/')}}/assets/layouts/layout/img/avatar.jpg" /> </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        {{--<li>--}}
                        {{--<a href="extra_profile.html">--}}
                        {{--<i class="icon-user"></i> My Profile </a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="page_calendar.html">--}}
                        {{--<i class="icon-calendar"></i> My Calendar </a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="inbox.html">--}}
                        {{--<i class="icon-envelope-open"></i> My Inbox--}}
                        {{--<span class="badge badge-danger"> 3 </span>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="page_todo.html">--}}
                        {{--<i class="icon-rocket"></i> My Tasks--}}
                        {{--<span class="badge badge-success"> 7 </span>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="divider"> </li>--}}
                        {{--<li>--}}
                        {{--<a href="extra_lock.html">--}}
                        {{--<i class="icon-lock"></i> Lock Screen </a>--}}
                        {{--</li>--}}
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon-key"></i> Log Out </a>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
