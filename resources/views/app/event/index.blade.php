@extends('layouts.app_event')
@section('content')
    <div class="user-login-5" id="landing-page">
        <div class="row bs-reset">
            @include('app.event.landing_left')
            <div class="col-md-8 event-bg-color bs-reset mt-login-5-bsfix right-container">
                <div class="col-md-12 conf-payment-container">
                    <a href="{{route('app.event.ticket.payment.input.code', [$event->short_name])}}" class="btn btn-circle event-button top-button"><h5><strong>Confirm Payment</strong></h5></a>
                </div>
                <div class="col-md-12 conf-payment-container">
                    <div class="col-md-offset-1 col-md-5">
                        <h1 class="font-white title-smilemo event-name">{{$event->name}}</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-offset-4 col-md-4 circle-date">
                            <p>{{date('D', strtotime($event->date))}}</p>
                            <h1>{{date('d', strtotime($event->date))}}</h1>
                            <p>{{date('M', strtotime($event->date))}}' {{date('Y', strtotime($event->date))}}</p>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-offset-1 col-md-8 location">
                        <div class="col-md-3 col-lg-2">
                            <img src="{{asset('assets/pages/img/pin_fill_rounded_circle.png')}}" class="img-responsive">
                        </div>
                        <div class="col-md-9 col-lg-10 font-white event-location">
                            {!! $event->location !!}
                        </div>
                    </div>
                </div>

                <div class="login-footer event-bg-color" style="position:absolute;right:0;bottom:0;">
                    <img src="{{asset($event->pattern_footer)}}" class="pattern-bottom" style="margin-top : 40px">
                    <div class="row bs-reset">
                        <div class="col-xs-12 bs-reset buy-button">
                            <a href="{{route('app.event.ticket.list', [$event->short_name])}}" class="btn btn-block event-button padding-top-bot-10"><h4><strong>Buy Ticket</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
