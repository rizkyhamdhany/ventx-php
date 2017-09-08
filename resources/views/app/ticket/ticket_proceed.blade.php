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

                    4
                    <span>Proceed</span>
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
                            <h3 class="event-font-primary">Proceed Your Payment</h3>
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-body">
                                <p>Reservation Code</p>
                                <div class="note note-default note-bordered">
                                    <p> {{$ticket->order_code}}</p>
                                </div>
                                <p>
                                    Congratulations, your booking has been recorded!
                                    <br>The code written above will be used to verify your purchase.
                                </p>
                                <p>
                                    Please transfer the total amount to the account below.
                                </p>
                                <div class="note note-default note-bordered">
                                    <p> {{$ticket->bank_account}}</p>
                                </div>
                                <h4>Grand Total</h4>
                                <div class="note note-default note-bordered">
                                    <p> IDR {{$ticket->grand_total}}</p>
                                </div>
                                <p>
                                    We have sent step-by-step payment guide to your email address. Kindly check your inbox.
                                </p>
                            </div>
                            <a href="{{route('app.event.ticket.payment.input.code', [$event->short_name])}}" class="btn sm-button event-button-rev btn-block">Confirm My Purchase</a>
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