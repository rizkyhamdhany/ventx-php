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
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <div class="alert  alert-{{ $msg }}">
                                        {!!Session::get('alert-' . $msg) !!}
                                    </div>
                                @endif
                            @endforeach


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
                                                    <button class="btn btn-circle sm-button-small margin-bottom-10">{{$area->name}} - Available Seat</button>
                                                    @for ($i = 0; $i < $area->row; $i++)
                                                        @if($i == 0)
                                                            <div class="seat-row">
                                                                <div class="seat-col">&nbsp </div>
                                                                @for ($j = 1; $j < ($area->col + 1); $j++)
                                                                    <div class="seat-col">{{$j < 10 ? '&nbsp;'.$j : $j }}</div>
                                                                @endfor
                                                            </div>
                                                        @endif
                                                        <div class="seat-row">
                                                            @php($row = $alphabet[($area->row - $i) - 1])
                                                            <div class="seat-col">{{$row}}</div>
                                                            @for ($j = 0; $j < $area->col; $j++)
                                                                <div class="seat-col {{isset($seat[$area->name][$row.($j+1)]) && !in_array($seat[$area->name][$row.($j+1)], $seat_booked)  ? 'seat-ava' : 'seat-una'}}"
                                                                     onclick="{{isset($seat[$area->name][$row.($j+1)]) && !in_array($seat[$area->name][$row.($j+1)], $seat_booked)  ? 'selectSeat('.$seat[$area->name][$row.($j+1)].')' : ''}}"
                                                                     id="{{isset($seat[$area->name][$row.($j+1)]) && !in_array($seat[$area->name][$row.($j+1)], $seat_booked) ? 'seat_'.$seat[$area->name][$row.($j+1)] : ''}}">
                                                                    &nbsp;
                                                                </div>
                                                            @endfor
                                                        </div>
                                                    @endfor
                                                    <div class="seat-info-container">

                                                        <div class="seat-info-item">
                                                            <div class="seat-info-item seat-col seat-info-sel"></div>
                                                            <p>Selected</p>
                                                        </div>
                                                        <div class="seat-info-item">
                                                            <div class="seat-info-item seat-col seat-info-ava"></div>
                                                            <p>Available</p>
                                                        </div>
                                                        <div class="seat-info-item">
                                                            <div class="seat-info-item seat-col seat-info-una"></div>
                                                            <p>Sold</p>
                                                        </div>
                                                        <div style="clear: both"></div>
                                                    </div>
                                                @else
                                                    <p class="no-seat-text">Selecting Seat Only Available for VVIP & VIP</p>
                                                @endif
                                                <div class="clearfix"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <div class="ticket-period-container">
                            <h3 class="sm-font">Selected Seat</h3>
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-body no-padding-bottom">
                                @include('app.ticket.ticket_list_reguler')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="refreshed" value="no">
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
        var seat_dict = {};
        var seats = [];
        var seat = new Object();
        var book = new Object();
        book.step = 'book';
        book.ticket_type = 'Reguler';
        book.ticket_period = 'Presale 1';
        book.ticket_ammount = '0';
        book.ticket = [];
        $('#book').val(JSON.stringify(book));
        $( "#REG" ).click(function() {
            $('.seats').hide();
            $('#seat-map-13').show();
            $('#ticket-class').text('Reguler');
            $('#ticket_type').val('Reguler');
            $('#ticket-price').text('IDR 70.000');
            $('#ticket_ammount').prop("disabled", false);
            book.ticket_type = 'Reguler';
            resetSeat();
        });
        $( "#VVIP" ).click(function() {
            $('.seats').hide();
            $('#seat-map-18').show();
            $('#ticket-class').text('VVIP');
            $('#ticket_type').val('VVIP');
            $('#ticket-price').text('IDR 400.000');
            $('#ticket_ammount').prop("disabled", true);
            book.ticket_type = 'VVIP';
            resetSeat();
        });
        $( "#VIP_E" ).click(function() {
            $('.seats').hide();
            $('#seat-map-14').show();
            $('#ticket-class').text('VIP E');
            $('#ticket_type').val('VIP E');
            $('#ticket-price').text('IDR 200.000');
            $('#ticket_ammount').prop("disabled", true);
            book.ticket_type = 'VIP E';
            resetSeat();
        });
        $( "#VIP_D" ).click(function() {
            $('.seats').hide();
            $('#seat-map-15').show();
            $('#ticket-class').text('VIP D');
            $('#ticket_type').val('VIP D');
            $('#ticket-price').text('IDR 200.000');
            $('#ticket_ammount').prop("disabled", true);
            book.ticket_type = 'VIP D';
            resetSeat();
        });
        $( "#VIP_I" ).click(function() {
            $('.seats').hide();
            $('#seat-map-16').show();
            $('#ticket-class').text('VIP I');
            $('#ticket_type').val('VIP I');
            $('#ticket-price').text('IDR 200.000');
            $('#ticket_ammount').prop("disabled", true);
            book.ticket_type = 'VIP I';
            resetSeat();
        });
        $( "#VIP_H" ).click(function() {
            $('.seats').hide();
            $('#seat-map-17').show();
            $('#ticket-class').text('VIP H');
            $('#ticket_type').val('VIP H');
            $('#ticket-price').text('IDR 200.000');
            $('#ticket_ammount').prop("disabled", true);
            book.ticket_type = 'VIP H';
            resetSeat();
        });
        function selectSeat($i) {
            if(seat_dict[$i] === undefined ) {
                if (Object.keys(seat_dict).length < 4){
                    seat_dict[$i] = $i;
                    $('#seat_'+$i).addClass('seat-sel');
                    $('#ticket_ammount').val(Object.keys(seat_dict).length.toString());
                }
            } else {
                $('#seat_'+$i).removeClass('seat-sel');
                delete seat_dict[$i];
                $('#ticket_ammount').val(Object.keys(seat_dict).length.toString());
            }
            book.ticket = [];
            for (var $x in seat_dict) {
                seat = new Object();
                seat.seat = $x;
                book.ticket.push(seat);
            }
            book.ticket_ammount = Object.keys(seat_dict).length.toString();
            $('#book').val(JSON.stringify(book));
        }

        function resetSeat(){
            for (var $x in seat_dict) {
                $('#seat_'+$x).removeClass('seat-sel');
            }
            seat_dict = {};
            book.ticket = [];
            book.ticket_ammount = Object.keys(seat_dict).length.toString();
            $('#ticket_ammount').val('0');
            $('#book').val(JSON.stringify(book));
        }

        $( "#ticket_ammount" ).change(function() {
            book.ticket_ammount = $( this ).val();
            $('#book').val(JSON.stringify(book));
        });

        onload=function(){
            var e=document.getElementById("refreshed");
            if(e.value=="no")e.value="yes";
            else{e.value="no";location.reload();}
        }
    </script>
@endsection