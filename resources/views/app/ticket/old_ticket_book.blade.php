@extends('layouts.app')
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
                <h1>Ticket Purchase</h1>
                <p>{{$event_name}} ticket(s)</p>
            </div>
            <div class="page-sub-title pull-right">
                <h1>
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-circle fa-stack-2x icon-background2"></i>
                        <i class="fa fa-user fa-stack-1x"></i>
                    </span>

                    2
                    <span>Credential Input</span>
                </h1>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="container">
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-7">
                        <div class="ticket-period-container">
                            <h3 class="sm-font">Fill Your Identity</h3>
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <div class="alert  alert-{{ $msg }}">
                                        <strong>Something went wrong !</strong> {{ Session::get('alert-' . $msg) }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <form class="horizontal-form"  action="{{route('app.ticket.pay.post')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="portlet light bordered">
                                <div class="portlet-body padding-bottom-30">
                                    <div>
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x icon-background2"></i>
                                        <i class="fa fa-user fa-stack-1x"></i>
                                    </span>
                                        <span class="sm-font-accent">Contact Information</span>
                                    </div>
                                    <div class="margin-top-10">
                                        <div class="col-md-12">
                                            <div class="form-group {{$errors->has('contact_name') ? 'has-error' : ' ' }}">
                                                <label class="control-label">Full Name</label>
                                                <input name="contact_name" value="{{ old('contact_name') }}" type="text" id="firstName" class="form-control" placeholder="Don Jon" required>
                                                <span class="help-block"> Please insert your name correctly </span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="margin-top-bottom-30">
                                        <div class="col-md-6">
                                            <div class="form-group {{$errors->has('contact_phone') ? 'has-error' : ' ' }}">
                                                <label class="control-label">Phone Number</label>
                                                <div class="input-group">
                                            <span class="input-group-addon">
                                                +62
                                            </span>
                                                    <input name="contact_phone" value="{{ old('contact_phone') }}" type="phone" class="form-control" placeholder="Phone Number" required> </div>
                                                <span class="help-block"> Please insert your phone correctly </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{$errors->has('contact_email') ? 'has-error' : ' ' }}">
                                                <label class="control-label">Email</label>
                                                <div class="input-group">
                                            <span class="input-group-addon addon-email">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                                    <input name="contact_email" value="{{ old('contact_email') }}" type="email" class="form-control" placeholder="Email Address" required> </div>
                                                <span class="help-block"> Please insert your email correctly </span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div>
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x icon-background2"></i>
                                        <i class="fa fa-envelope-o fa-stack-1x"></i>
                                    </span>
                                        <span class="sm-font-accent">Ticket Delivery</span>
                                    </div>
                                    @for($i = 0; $i < ($ticket->ticket_ammount); $i++)
                                        <div>
                                            <h4 class="margin-top-30">Person {{$i + 1}}</h4>
                                            <div class="margin-top-10">
                                                <div class="col-md-2 padding-right-10 title-container">
                                                    <div class="form-group">
                                                        <label class="control-label">Title</label>
                                                        <select name="ticket[{{$i}}][ticket_title]" class="form-control">
                                                            <option>Mr.</option>
                                                            <option>Mrs.</option>
                                                            <option>Ms.</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-10 no-padding-left name-container">
                                                    <div class="form-group {{$errors->has('ticket.'.$i.'.ticket_name') ? 'has-error' : ' ' }}">
                                                        <label class="control-label">Full Name</label>
                                                        <input name="ticket[{{$i}}][ticket_name]" type="text" id="firstName" class="form-control" placeholder="Don Jon" required>
                                                        <span class="help-block"> Please insert your name correctly </span>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="margin-top-30">
                                                <div class="col-md-6">
                                                    <div class="form-group {{$errors->has('ticket.'.$i.'.ticket_phone') ? 'has-error' : ' ' }}">
                                                        <label class="control-label">Phone Number</label>
                                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    +62
                                                </span>
                                                            <input name="ticket[{{$i}}][ticket_phone]" type="phone" class="form-control" placeholder="Phone Number" required> </div>
                                                        <span class="help-block"> Please insert your phone correctly </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{$errors->has('ticket.'.$i.'.ticket_email') ? 'has-error' : ' ' }}">
                                                        <label class="control-label">Email</label>
                                                        <div class="input-group">
                                                <span class="input-group-addon addon-email">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                            <input name="ticket[{{$i}}][ticket_email]" type="email" class="form-control" placeholder="Email Address" required> </div>
                                                        <span class="help-block"> Please insert your email correctly </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endfor
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <button type="submit" class="btn sm-button btn-block">Proceed</button>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <div class="ticket-period-container">
                            <h3 class="sm-font">&nbsp;</h3>
                        </div>
                        <div class="portlet light bordered sm-bg-color" style="background-image: url('{{URL('/')}}/assets/pages/img/smilemo-theme.png'); background-repeat: no-repeat;     background-repeat: no-repeat;background-position: center top;background-size: 100% auto;">
                            <div class="portlet-body ticket-summary">
                                <div class="pull-right">
                                    <h4 class="font-white">Ticket Summary</h4>
                                </div>
                                <div class="event-details">
                                    <h1 class="font-white">Festival Budaya 2017</h1>
                                    <p class="font-white">
                                        Sabtu, 9 Desember 2017
                                        <br>Sasana Budaya Ganesha
                                        <br>&nbsp;</p>
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
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <input type="hidden" id="refreshed" value="no">
@endsection
@section('page_js_plugins')
@endsection
@section('page_js')
    <script>
        onload=function(){
            var e=document.getElementById("refreshed");
            if(e.value=="no")e.value="yes";
            else{e.value="no";location.reload();}
        }
    </script>
@endsection
