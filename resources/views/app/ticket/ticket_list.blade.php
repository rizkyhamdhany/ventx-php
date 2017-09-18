@extends('layouts.app.app')
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
                <h1 class="event-font-primary">Ticket Purchase</h1>
                <p>{{$event->name}} ticket(s)</p>
            </div>
            <div class="page-sub-title pull-right">
                <h1 class="event-font-secondary">
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-circle fa-stack-2x icon-background2 event-font-secondary"></i>
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
                @if($event->count_ticket_class > 1)
                <div class="row">
                    <div>
                        <div class="ticket-period-container">
                            <h3 class="sm-font event-font-primary">Select Your Seat</h3>
                            @include('layouts.error_msg_app')

                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-body padding-bottom-30">
                                <div class="col-md-6 sm-border-right">
                                    @include('app.ticket.old_ticket_seat_svg')
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
                @endif
                <div class="row">
                    <div>
                        <div class="ticket-period-container">
                            <h3 class="sm-font event-font-primary">Selected Seat</h3>
                            @if($event->count_ticket_class == 1)
                                @include('layouts.error_msg_app')
                                <br>
                                <br>
                                <br>
                            @endif
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-body no-padding-bottom">
                                @include('app.ticket.old_ticket_list_reguler')
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
        @foreach($ticket_class as $indexTicket => $TC)
            {{str_replace(' ', '_', '#'.$TC->name)}}:hover{
            background-color: #000000;
            opacity: 0.3;
            cursor: pointer;
        }
        @endforeach

    </style>
    <script>
        @foreach($ticket_class as $indexTicket => $TC)
            @if($indexTicket < 1)
                var seat_dict = {};
                var seats = [];
                var seat = new Object();
                var book = new Object();
                book.step = 'book';
                book.ticket_type = 'Reguler';
                book.ticket_class = '{{$TC->id}}';
                book.ticket_period = 'Presale 2';
                book.ticket_ammount = '0';
                book.ticket = [];
                $('#book').val(JSON.stringify(book));
                $( "#{{str_replace(' ', '_', $TC->name)}}" ).click(function() {
                    $('.seats').hide();
                    $('#seat-map-{{$TC->id}}').show();
                    $('#ticket-class').text('{{$TC->name}}');
                    $('#ticket_type').val('{{$TC->name}}');
                    $('#ticket-price').text('IDR {{$TC->price}}');
                    $('#ticket_ammount').prop("disabled", false);
                    book.ticket_type = '{{$TC->name}}';
                    book.ticket_class = '{{$TC->id}}';
                    resetSeat();
                });
            @else
                $( "#{{str_replace(' ', '_', $TC->name)}}" ).click(function() {
                    $('.seats').hide();
                    $('#seat-map-{{$TC->id}}').show();
                    $('#ticket-class').text('{{$TC->name}}');
                    $('#ticket_type').val('{{$TC->name}}');
                    $('#ticket-price').text('IDR {{$TC->price}}');
                    $('#ticket_ammount').prop("disabled", true);
                    book.ticket_type = '{{$TC->name}}';
                    book.ticket_class = '{{$TC->id}}';
                    resetSeat();
                });
            @endif

        @endforeach

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