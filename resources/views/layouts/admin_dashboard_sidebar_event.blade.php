<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="heading">
                <h3 class="uppercase">&nbsp;</h3>
            </li>
            <li class="nav-item start">
                <a href="{{route('dashboard.event')}}" class="nav-link nav-toggle">
                    <i class="icon-action-undo"></i>
                    <span class="title">Event List</span>
                    {!! $page_state == 'home' ? '<span class="selected"></span>' : '' !!}
                </a>
            </li>
            <li class="nav-item start {{$page_state == 'Event Details' ? 'active' : ''}}">
                <a href="{{route('dashboard.event')}}" class="nav-link nav-toggle">
                    <i class="icon-calendar"></i>
                    <span class="title">Event Information</span>
                    {!! $page_state == 'Event Details' ? '<span class="selected"></span>' : '' !!}
                </a>
            </li>
            <li class="nav-item start {{$page_state == 'Event Artists' ? 'active' : ''}}">
                <a href="{{route('dashboard.event.eventArtist',$id)}}" class="nav-link nav-toggle">
                    <i class="icon-calendar"></i>
                    <span class="title">Event Artists</span>
                    {!! $page_state == 'Event Details' ? '<span class="selected"></span>' : '' !!}
                </a>
            </li>
            <li class="nav-item start {{$page_state == 'Event Sponsors' ? 'active' : ''}}">
                <a href="{{route('dashboard.event.eventSponsor',$id)}}" class="nav-link nav-toggle">
                    <i class="icon-calendar"></i>
                    <span class="title">Event Sponsors</span>
                    {!! $page_state == 'Event Details' ? '<span class="selected"></span>' : '' !!}
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Ticket</h3>
            </li>
            <li class="nav-item start {{$page_state == 'Ticket Category' ? 'active' : ''}}">
                <a href="{{route('dashboard.event.ticketCategory',$id)}}" class="nav-link">
                    <i class="icon-graph"></i>
                    <span class="title">Ticket Category</span>
                </a>
            </li>
            <li class="nav-item start">
                <a href="#" class="nav-link nav-toggle">
                    <i class="icon-bag"></i>
                    <span class="title">Ticket Partner</span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Settings</h3>
            </li>
            <li class="nav-item start">
                <a href="#" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Page Configuration</span>
                </a>
            </li>
        </ul>
    </div>
</div>
