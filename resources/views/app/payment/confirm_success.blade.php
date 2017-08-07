@extends('layouts.landing_smilemo')
@section('content')
    <div class="user-login-5" id="confirm-payment-3">
        <div class="row bs-reset">
            <div class="col-md-4 bs-reset mt-login-5-bsfix">
                <div class="login-bg" style="background-image:url({{URL('/')}}/assets/pages/img/login/bg1.jpg)">
                    <img class="login-logo" src="{{URL('/')}}/assets/pages/img/login/logo.png" />
                    <div class="btn smilemo-color-rev presale_button">Presale 1</div>
                    <div class="presale-artist">
                        <p>
                            Pre-Sale <br>
                            Confirmed Artist
                        </p>
                        <h1>
                            Teddy <br>
                            Adhitya
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-8 login-container bs-reset mt-login-5-bsfix right-container">
                <div class="col-md-12 header">
                    <h1>Payment Confirmation</h1>
                </div>

                <div class="col-md-12 success">
                    <img src="{{URL('/')}}/assets/pages/img/illustration.png">
                    <h1>Success!</h1>
                    <div class="text">
                        <p>Your transaction is being processed and we'll deliver the ticket to your email address. It shouldn't take longer than 48 hours. Thank you for Waiting!</p>
                    </div>

                    <a href="{{route('welcome')}}">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection