<div class="page-header navbar-fixed-top hidden-print">
    <div class="clearfix">
        <div class="page-logo">
            <a href="{{route('welcome')}}">
                <img src="{{URL('/')}}/assets/pages/img/{{$logo}}" alt="logo" class="logo-default" /> </a>
        </div>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <span class="dropdown-toggle {{$page_state == 'pick_seat' ? 'active' : ''}}">
                        &#9679; 1 Pick Your Seat
                    </span>
                </li>
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <span class="dropdown-toggle {{$page_state == 'book' ? 'active' : ''}}">
                        &#9679; 2 Credential Input
                    </span>
                </li>
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <span class="dropdown-toggle {{$page_state == 'pay' ? 'active' : ''}}">
                        &#9679; 3 Payment Method
                    </span>
                </li>
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <span class="dropdown-toggle {{$page_state == 'proceed' ? 'active' : ''}}">
                        &#9679; 4 Proceed
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>