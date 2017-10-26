<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="heading">
                <h3 class="uppercase">Event</h3>
            </li>
            <li class="nav-item start {{$page_state == 'home' ? 'active' : ''}}">
                <a href="{{route('stakeholder.home')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    {!! $page_state == 'home' ? '<span class="selected"></span>' : '' !!}
                </a>
            </li>
            <li class="nav-item start {{$page_state == 'Event' ? 'active' : ''}}">
                <a href="{{route('stakeholder.report')}}" class="nav-link">
                    <i class="icon-calendar"></i>
                    <span class="title">Report</span>
                    {!! $page_state == 'Event' ? '<span class="selected"></span>' : '' !!}
                </a>
            </li>
            <!--START HIDE
            <li class="heading">
                <h3 class="uppercase">Users Setting</h3>
            </li>
            <li class="nav-item start {{$page_state == 'Users' ? 'active' : ''}}">
                <a href="{{route('dashboard.users')}}" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Users</span>
                    {!! $page_state == 'Users' ? '<span class="selected"></span>' : '' !!}
                </a>
            </li>
            <li class="nav-item start {{$page_state == 'users' ? 'active' : ''}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-paper-plane"></i>
                    <span class="title">Privilege</span>
                    {!! $page_state == 'users' ? '<span class="selected"></span>' : '' !!}
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Partner</h3>
            </li>
            <li class="nav-item start {{$page_state == 'Ticket Box' ? 'active' : ''}}">
                <a href="{{route('dashboard.partner.ticket_box')}}" class="nav-link nav-toggle">
                    <i class="icon-wallet"></i>
                    <span class="title">Ticket Box</span>
                    {!! $page_state == 'Ticket Box' ? '<span class="selected"></span>' : '' !!}
                </a>
            </li>
            <li class="nav-item start">
                <a href="#" class="nav-link nav-toggle">
                    <i class=" icon-bag"></i>
                    <span class="title">Counter</span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Transaction</h3>
            </li>
            <li class="nav-item start {{$page_state == 'Payments' ? 'active' : ''}}">
                <a href="{{route('dashboard.payments')}}" class="nav-link nav-toggle">
                    <i class="icon-wallet"></i>
                    <span class="title">Payment Confirmation</span>
                    {!! $page_state == 'Payments' ? '<span class="selected"></span>' : '' !!}
                </a>
            </li>
          END HIDE-->
        </ul>
    </div>
</div>
