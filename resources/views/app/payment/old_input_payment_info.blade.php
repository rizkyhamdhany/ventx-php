@extends('layouts.landing_smilemo')
@section('content')
    <form class="horizontal-form"  action="{{route('app.ticket.payment.input.detail.input')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="order_code" value="{{$order_code}}">
    <div class="user-login-5" id="confirm-payment-2">
        <div class="row bs-reset">
            <div class="col-md-4 bs-reset mt-login-5-bsfix">
                <div class="login-bg" style="background-image:url({{URL('/')}}/assets/pages/img/login/bg1.jpg)">
                    <img class="login-logo" src="{{URL('/')}}/assets/pages/img/login/logo.png" />
                    <div class="btn smilemo-color-rev presale_button">Presale 2</div>
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
                <div class="col-mgd-12 header">
                    <div class="back-button"><a href="{{route('home')}}"><i class="fa fa-arrow-left"></i></a></div>
                    <h1>Payment Confirmation</h1>
                </div>

                <div class="col-md-12 aligner">
                    <div class="confirm col-md-10">
                        <strong>Name : {{$preorder->name}}</strong>
                        <p>Ticket Detail :</p>
                        <table class="details">
                            <tbody>
                            <tr>
                                <td class="type-icon"><span class="type {{$ticket->ticket_type == 'Reguler' ? 'festival' : 'vipd'}}"></span></td>
                                <td class="type">{{$ticket->ticket_type}}</td>
                                <td class="amount">{{$ticket->ticket_ammount}}</td>
                                <td class="total">IDR {{$ticket->grand_total}}</td>
                            </tr>
                        </table>

                        <strong>Confirm Payment</strong>
                        <div class="confirm-payment">
                            <span class="label">Bank Transfer</span>
                            <p>Transfered to: </p>
                            <div class="row">
                                <div class="col-md-3 bank">
                                    <img src="{{URL('/')}}/assets/pages/img/BCA.png">
                                    <p>Sandika Ichsan Arafat - 4381411669</p>
                                </div>
                                <div class="col-md-3 bank">
                                    <img src="{{URL('/')}}/assets/pages/img/Mandiri.png">
                                    <p>Sandika Ichsan Arafat - 1320017379083</p>
                                </div>
                                <div class="col-md-3 bank">
                                    <img src="{{URL('/')}}/assets/pages/img/BNI.png">
                                    <p>Sandika Ichsan Arafat - 0602257953</p>
                                </div>
                                <div class="col-md-3 bank">
                                    <img src="{{URL('/')}}/assets/pages/img/cimb-logo.png">
                                    <p>Sandika Ichsan Arafat - 11290001012569</p>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3">
                                    <select name="bank" required>
                                        <option disabled selected>Bank Name</option>
                                        @foreach($banks as $bank)
                                        <option value="{{$bank->id}}">{{$bank->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" placeholder="Account Holder" name="account_holder" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" data-provide="datepicker" placeholder="Transfer Date" name="date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login-footer">
                    <div class="row bs-reset">
                        <div class="col-xs-12 bs-reset">
                            <button type="submit" class="btn btn-block buy-ticket-button padding-top-bot-10"><h4><strong>Confirm</strong></h4></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection