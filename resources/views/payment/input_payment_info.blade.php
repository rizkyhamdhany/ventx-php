@extends('layouts.landing_smilemo')
@section('content')
    <div class="user-login-5" id="confirm-payment-2">
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
                    <div class="confirm col-md-10">
                        <strong>Name : Daniel Brighton</strong>
                        <p>Ticket Detail :</p>
                        <table class="details">
                            <tbody>
                            <tr>
                                <td class="type-icon"><span class="type festival"></span></td>
                                <td class="type">Festival</td>
                                <td class="amount">2</td>
                                <td class="total">IDR 250,000.00</td>
                            </tr>
                            <tr>
                                <td class="type-icon"><span class="type vipd"></span></td>
                                <td class="type">VIP D</td>
                                <td class="amount">1</td>
                                <td class="total">IDR 150,000.00</td>
                            </tr>
                            </tbody>
                        </table>

                        <strong>Confirm Payment</strong>
                        <div class="confirm-payment">
                            <span class="label">Bank Transfer</span>
                            <p>Transfered to: </p>
                            <div class="row">
                                <div class="col-md-4 bank">
                                    <img src="{{URL('/')}}/assets/pages/img/BCA.png">
                                    <p>Violet Goodman - 95609</p>
                                </div>
                                <div class="col-md-4 bank">
                                    <img src="{{URL('/')}}/assets/pages/img/Mandiri.png">
                                    <p>Ruth Hicks - 98282</p>
                                </div>
                                <div class="col-md-4 bank">
                                    <img src="{{URL('/')}}/assets/pages/img/BNI.png">
                                    <p>Minnie Newman - 77064</p>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3">
                                    <select class="">
                                        <option disabled selected>Bank Name</option>
                                        <option>BCA</option>
                                        <option>BNI</option>
                                        <option>Mandiri</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" placeholder="Account Holder">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" data-provide="datepicker" placeholder="Transfer Date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login-footer">
                    <div class="row bs-reset">
                        <div class="col-xs-12 bs-reset">
                            <a href="#" class="btn btn-block buy-ticket-button padding-top-bot-10"><h4><strong>Confirm</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection