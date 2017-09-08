@extends('layouts.app_event')
@section('content')
    <form class="horizontal-form"  action="{{route('app.event.ticket.payment.input.detail', [$event->short_name])}}" method="GET">
        <div class="user-login-5" id="confirm-payment-1">
            <div class="row bs-reset">
                @include('app.event.landing_left')
                <div class="col-md-8 login-container event-bg-color bs-reset mt-login-5-bsfix right-container">
                    <div class="col-md-12 header">
                        <div class="back-button"><a href="{{route('home')}}"><i class="fa fa-arrow-left"></i></a></div>
                        <h1>Payment Confirmation</h1>
                    </div>

                    <div class="col-md-12 aligner">
                        <div class="enter-code col-md-10">
                            <p>Input Your Reservation Code</p>
                            <input name="order_code" type="text" class="code event-border" maxlength="20" style="text-transform:uppercase">
                        </div>
                    </div>
                    <div class="col-md-12 aligner">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="font-red-pink"> <strong>{{ Session::get('alert-' . $msg) }}</strong> Please input yours !</p>
                            @endif
                        @endforeach
                    </div>

                    <div class="login-footer event-bg-color">
                        <div class="row bs-reset">
                            <div class="col-xs-12 bs-reset">
                                <button type="submit" class="btn btn-block event-button padding-top-bot-10"><h4><strong>Submit</strong></h4></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection