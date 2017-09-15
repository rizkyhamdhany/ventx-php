@extends('layouts.app.app')
@section('page_style_libs')
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('page_style')
    <link href="{{URL('/')}}/assets/layouts/layout/css/app/ticket_book.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h1 class="event-font-primary">Ticket Purchase</h1>
                <p>{{$event->name}} ticket(s)</p>
            </div>
            <div class="page-sub-title pull-right">
                <h1 class="event-font-secondary">
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-circle fa-stack-2x icon-background2 event-font-secondary"></i>
                        <i class="fa fa-money fa-stack-1x"></i>
                    </span>

                    3
                    <span>Payment Method</span>
                </h1>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="container">
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-7">
                        <div class="ticket-period-container">
                            <h3 class="event-font-primary">Choose Your Payment Method</h3>
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <div class="alert  alert-{{ $msg }}">
                                        <strong>Something went wrong !</strong> {{ Session::get('alert-' . $msg) }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <ul class="nav nav-tabs pull-left">
                                        <li class="active">
                                            <a href="#portlet_comments_1" data-toggle="tab" aria-expanded="true"> Bank Transfer </a>
                                        </li>
                                        <li class="">
                                            <a href="#portlet_comments_2" data-toggle="tab" aria-expanded="false"> Credit Card </a>
                                        </li>
                                        <li class="">
                                            <a href="#portlet_comments_3" data-toggle="tab" aria-expanded="false"> E-Wallet </a>
                                        </li>
                                        <li class="">
                                            <a href="#portlet_comments_4" data-toggle="tab" aria-expanded="false"> Alfamart / Indomaret </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body padding-bottom-30">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="portlet_comments_1">
                                            <form class="horizontal-form"  action="{{route('app.event.ticket.proceed.post', [$event->short_name])}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="payment_method" value="BANK_TRANSFER">
                                            <h4 class="margin-top-bottom-30">Select Bank</h4>
                                            <div class="table-scrollable">
                                                <table class="table table-bank">
                                                        <tr>
                                                            <td>
                                                                <div class="radio">
                                                                    <label><input type="radio" id='regular' name="bankopt" checked value="BCA"><span class="bank-name">BCA</span></label>
                                                                </div>
                                                            </td>
                                                            <td class="vertical-middle">
                                                                <div class="radiotext text-align-right">
                                                                    <img src="{{URL('/')}}/assets/pages/img/BCA.png">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="radio">
                                                                    <label><input type="radio" id='express' name="bankopt" value="Mandiri"><span class="bank-name">Mandiri</span></label>
                                                                </div>
                                                            </td>
                                                            <td class="vertical-middle">
                                                                <div class="radiotext text-align-right">
                                                                    <img src="{{URL('/')}}/assets/pages/img/Mandiri.png">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="radio">
                                                                    <label><input type="radio" id='express' name="bankopt" value="BNI" ><span class="bank-name">BNI</span></label>
                                                                </div>
                                                            </td>
                                                            <td class="vertical-middle">
                                                                <div class="radiotext text-align-right">
                                                                    <img src="{{URL('/')}}/assets/pages/img/BNI.png">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="radio">
                                                                    <label><input type="radio" id='express' name="bankopt" value="CIMB Niaga" ><span class="bank-name">CIMB Niaga</span></label>
                                                                </div>
                                                            </td>
                                                            <td class="vertical-middle">
                                                                <div class="radiotext text-align-right">
                                                                    <img src="{{URL('/')}}/assets/pages/img/cimb-logo.png">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                </table>
                                            </div>
                                            <button type="submit" class="btn sm-button btn-block event-button-rev">Pay With Transfer</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="portlet_comments_2">
                                            {{--<form class="horizontal-form"  action="{{route('app.event.ticket.proceed.post', [$event->short_name])}}" method="POST">--}}
                                                {{--{{ csrf_field() }}--}}
                                                {{--<input type="hidden" name="payment_method" value="DOKU">--}}
                                                {{--<button type="submit" class="btn sm-button btn-block event-button-rev">Pay With Credit Card</button>--}}
                                            {{--</form>--}}
                                        </div>
                                        <div class="tab-pane" id="portlet_comments_3">
                                            {{--<form class="horizontal-form"  action="{{route('app.event.ticket.proceed.post', [$event->short_name])}}" method="POST">--}}
                                                {{--{{ csrf_field() }}--}}
                                                {{--<input type="hidden" name="payment_method" value="DOKU">--}}
                                                {{--<button type="submit" class="btn sm-button btn-block event-button-rev">Pay With E-Wallet</button>--}}
                                            {{--</form>--}}
                                        </div>
                                        <div class="tab-pane" id="portlet_comments_4">
                                            {{--<form class="horizontal-form"  action="{{route('app.event.ticket.proceed.post', [$event->short_name])}}" method="POST">--}}
                                                {{--{{ csrf_field() }}--}}
                                                {{--<input type="hidden" name="payment_method" value="DOKU">--}}
                                                {{--<button type="submit" class="btn sm-button btn-block event-button-rev">Pay With Alfamart / Indomaret</button>--}}
                                            {{--</form>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-5">
                        <div class="ticket-period-container">
                            <h3 class="event-font-primary">&nbsp;</h3>
                        </div>
                        <div class="portlet light bordered event-bg-color" style="background-image: url('{{asset($event->background_pattern)}}'); background-repeat: no-repeat;     background-repeat: no-repeat;background-position: center top;background-size: 100% auto;">
                            <div class="portlet-body ticket-summary">
                                <div class="pull-right">
                                    <h4 class="font-white">Ticket Summary</h4>
                                </div>
                                <div class="event-details">
                                    <h1 class="font-white">{{$event->name}}</h1>
                                    <p class="font-white">
                                        {{date('D, d M Y', strtotime($event->date))}}
                                        <br>
                                    <div class="font-white">
                                        {!! $event->location !!}
                                    </div>
                                    <br>&nbsp;
                                    </p>
                                </div>
                                <div class="ticket-item-container">
                                    <table class="ticket-table">
                                        <tr>
                                            <td><div class="circle circle-{{$ticket->ticket_type == 'Reguler' ? 'reguler' : 'vip'}}"></div></td>
                                            <td>{{$ticket->ticket_type}}</td>
                                            <td>{{$ticket->ticket_ammount}}</td>
                                            <td>IDR {{$ticket->price_item}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="ticket-price margin-top-30">
                                    <h4 class="font-white no-margin">Grand Total</h4>
                                    <h1 class="font-white">IDR {{$ticket->grand_total}}</h1>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js_plugins')
@endsection
@section('page_js')
@endsection