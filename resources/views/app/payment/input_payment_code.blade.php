@extends('layouts.landing_smilemo')
@section('content')
    <form class="horizontal-form"  action="{{route('app.ticket.payment.input.detail')}}" method="GET">
    <div class="user-login-5" id="confirm-payment-1">
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
                    <div class="back-button"><a href="{{route('welcome')}}"><i class="fa fa-arrow-left"></i></a></div>
                    <h1>Payment Confirmation</h1>
                </div>

                <div class="col-md-12 aligner">
                    <div class="enter-code col-md-10">
                        <p>Input Your Reservation Code</p>
                        <input name="order_code" type="text" class="code" maxlength="20" style="text-transform:uppercase">
                    </div>
                </div>
                <div class="col-md-12 aligner">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                           <p class="font-red-pink"> <strong>{{ Session::get('alert-' . $msg) }}</strong> Please input yours !</p>
                        @endif
                    @endforeach
                </div>

                <div class="login-footer">
                    <div class="row bs-reset">
                        <div class="col-xs-12 bs-reset">
                            <button type="submit" class="btn btn-block buy-ticket-button padding-top-bot-10"><h4><strong>Submit</strong></h4></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <button href="{{route('app.ticket.payment.input.detail', ['order_code' => '12312312'])}}" class="btn btn-block buy-ticket-button padding-top-bot-10"><h4><strong>Submit</strong></h4></button>
@endsection