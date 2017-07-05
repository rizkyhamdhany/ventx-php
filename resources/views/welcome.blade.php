@extends('layouts.landing_smilemo')
@section('content')
    <div class="user-login-5" id="landing-page">
        <div class="row bs-reset">
            <div class="col-md-4 bs-reset mt-login-5-bsfix">
                <div class="login-bg" style="background-image:url(assets/pages/img/login/bg1.jpg)">
                    <img class="login-logo" src="assets/pages/img/login/logo.png" />
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
                <div class="col-md-12 conf-payment-container">
                    <a href="{{route('payment.input.code')}}" class="btn btn-circle buy-ticket-button top-button"><h5><strong>Confirm Payment</strong></h5></a>
                </div>
                <div class="col-md-12 conf-payment-container">
                    <div class="col-md-offset-1 col-md-5">
                        <h1 class="font-white title-smilemo">Smilemotion <br> 2017</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-offset-4 col-md-4 circle-date">
                            <p>Sat</p>
                            <h1>9</h1>
                            <p>Dec' 17</p>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-offset-1 col-md-8 location">
                        <div class="col-md-3 col-lg-2">
                            <img src="assets/pages/img/pin_fill_rounded_circle.png" class="img-responsive">
                        </div>
                        <div class="col-md-9 col-lg-10 font-white">
                            <strong>Sasana Budaya Ganessha</strong>
                            <p>Jl. Taman Sari No. 73, Lb. Siliwangi,</p>
                            <p>Coblong,</p>
                            <p>Kota Bandung, Jawa Barat</p>
                        </div>
                    </div>
                </div>

                <div class="login-footer">
                    <img src="assets/pages/img/pattern_smilemo.png" class="pattern-bottom">
                    <div class="row bs-reset">
                        <div class="col-xs-12 bs-reset">
                            <button class="btn btn-block buy-ticket-button padding-top-bot-10"><h4><strong>Buy Ticket</strong></h4></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection