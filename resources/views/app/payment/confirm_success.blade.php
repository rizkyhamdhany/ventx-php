@extends('layouts.app_event')
@section('content')
    <div class="user-login-5" id="confirm-payment-3">
        <div class="row bs-reset">
            @include('app.event.landing_left')
            <div class="col-md-8 login-container event-bg-color bs-reset mt-login-5-bsfix right-container">
                <div class="col-md-12 header">
                    <h1>Payment Confirmation</h1>
                </div>

                <div class="col-md-12 success">
                    <img src="{{URL('/')}}/assets/pages/img/illustration.png">
                    <h1>Success!</h1>
                    <div class="text">
                        <p>Your transaction is being processed and we'll deliver the ticket to your email address. It shouldn't take longer than 48 hours. Thank you for Waiting!</p>
                    </div>

                    <a href="{{route('home')}}">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
