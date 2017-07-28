@extends('layouts.app')
@section('page_style_libs')
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('page_style')
    <link href="{{URL('/')}}/assets/layouts/layout/css/app/ticket_list.css" rel="stylesheet" type="text/css" />
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
                        <i class="fa fa-ticket fa-stack-1x"></i>
                    </span>

                    1
                    <span>Pick Your Seat</span>
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
                            <span class="btn btn-circle">Presale 1</span>
                            <span>Presale 1</span>
                            <span>Reguler</span>
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption">
                                    <span class="caption-subject sm-font-accent bold uppercase">Select Your Seat</span>
                                </div>
                            </div>
                            <div class="portlet-body padding-bottom-30">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="seat-map">
                                        @include('app.ticket.ticket_seat_svg')
                                    </div>
                                    <div class="tab-pane" id="ticket-list-reguler">
                                        @include('app.ticket.ticket_list_reguler')
                                    </div>
                                    <div class="tab-pane" id="portlet_comments_3">
                                        <h4>Sorry this feature isn't available right now, please try again later</h4>
                                    </div>
                                    <div class="tab-pane" id="portlet_comments_4">
                                        <h4>Sorry this feature isn't available right now, please try again later</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="ticket-period-container-list">
                            <h3 class="sm-font">&nbsp;</h3>
                        </div>
                        <div class="portlet light bordered sm-bg-color" style="background-image: url('{{URL('/')}}/assets/pages/img/smilemo-theme.png'); background-repeat: no-repeat">
                            <div class="portlet-body ticket-summary">
                                <div class="pull-right">
                                    <h4 class="font-white"></h4>
                                </div>
                                <div class="event-details">
                                    <h1 class="font-white">Smilemotion 2017</h1>
                                    <p class="font-white">
                                        Sabtu, 9 Desember 2017
                                        <br>Sasana Budaya Ganesha
                                        <br>11.00 a.m. - 10.00 p.m.</p>
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
    <script>
        $( "#REG" ).click(function() {
            $('#seat-map').hide();
            $('#ticket-list-reguler').show();
        });
        $( "#VVIP" ).click(function() {
            alert( "VVIP" );
        });
        $( "#VIP_E" ).click(function() {
            alert( "VIP_E" );
        });
        $( "#VIP_D" ).click(function() {
            alert( "VIP_D" );
        });
        $( "#VIP_I" ).click(function() {
            alert( "VIP_I" );
        });
        $( "#VIP_H" ).click(function() {
            alert( "VIP_H" );
        });
        $('#reg-cancel').click(function(){
            $('#ticket-list-reguler').hide();
            $('#seat-map').show();
        });
    </script>
@endsection