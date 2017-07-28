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
                    <div>
                        <div class="ticket-period-container">
                            <h3 class="sm-font">Select Your Seat</h3>
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-body padding-bottom-30">
                                <div class="col-md-6 sm-border-right">
                                    @include('app.ticket.ticket_seat_svg')
                                </div>
                                <div class="col-md-6">
                                    <div class="tab-content">
                                        @php($is_first = true)
                                        @php($alphabet = range('A', 'Z'))
                                        @foreach($ticket_class as $area)
                                            <div class="tab-pane seats {{$is_first ? 'active' : ' '}} @php($is_first = false)" id="seat-map-{{$area->id}}">
                                                @if($area->have_seat)
                                                    @for ($i = 0; $i < $area->row; $i++)
                                                        @if($i == 0)
                                                            <div class="seat-row">
                                                                <div class="seat-col">&nbsp </div>
                                                                @for ($j = 0; $j < $area->col; $j++)
                                                                    <div class="seat-col">{{$j < 10 ? '&nbsp;'.$j : $j }}</div>
                                                                @endfor
                                                            </div>
                                                        @endif
                                                        <div class="seat-row">
                                                            <div class="seat-col">{{$alphabet[($area->row - $i) - 1]}}</div>
                                                            @for ($j = 0; $j < $area->col; $j++)
                                                                <div class="seat-col seat-ava">&nbsp;</div>
                                                            @endfor
                                                        </div>
                                                    @endfor
                                                    <div class="seat-info-container">
                                                        <div class="seat-info-item">{{$area->name}}</div>
                                                        <div style="clear: both"></div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <div class="ticket-period-container">
                            <h3 class="sm-font">Selected Seat</h3>
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-body padding-bottom-30">
                                @include('app.ticket.ticket_list_reguler')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js_plugins')
    <script src="{{URL('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
@endsection
@section('page_js')
    <script src="{{URL('/')}}/assets/pages/scripts/form-wizard.min.js" type="text/javascript"></script>
    <style>
        #REG:hover, #VIP_E:hover, #VIP_D:hover, #VIP_I:hover, #VIP_H:hover, #VVIP:hover{
            background-color: #000000;
            opacity: 0.3;
            cursor: pointer;
        }
    </style>
    <script>
        $( "#REG" ).click(function() {
            $('.seats').hide();
            $('#seat-map-13').show();
        });
        $( "#VVIP" ).click(function() {
            $('.seats').hide();
            $('#seat-map-18').show();
        });
        $( "#VIP_E" ).click(function() {
            $('.seats').hide();
            $('#seat-map-14').show();
        });
        $( "#VIP_D" ).click(function() {
            $('.seats').hide();
            $('#seat-map-15').show();
        });
        $( "#VIP_I" ).click(function() {
            $('.seats').hide();
            $('#seat-map-16').show();
        });
        $( "#VIP_H" ).click(function() {
            $('.seats').hide();
            $('#seat-map-17').show();
        });
    </script>
@endsection