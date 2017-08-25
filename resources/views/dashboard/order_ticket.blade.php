@extends('layouts.dashboard')
@section('page_style')
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')
    <div class="container-fluid container-lf-space margin-top-30">
        <div class="row">
            <div class="col-md-12">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <div class="note note-{{ $msg }}">
                            <p>{{ Session::get('alert-' . $msg) }}</p>
                        </div>
                    @endif
                @endforeach
                <div class="portlet light bordered" id="form_wizard_1">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark sbold uppercase">Booking {{$ticket_period}}, for {{$ammount}} tickets</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="horizontal-form"  action="{{route('ticket.order.submit')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="ticket_period" value="{{$ticket_period}}">
                            <input type="hidden" name="ticket_class" value="{{$ticket_class}}">
                            <input type="hidden" name="ammount" value="{{$ammount}}">
                            <div class="form-body">
                                <h3 class="form-section">Contact Information</h3>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label">Full Name</label>
                                            <input name="contact_fullname" type="text" id="firstName" class="form-control" placeholder="Don Jon" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Phone Number</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    +62
                                                </span>
                                                <input name="contact_phone" type="phone" class="form-control" placeholder="Phone Number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <input name="contact_email" type="email" class="form-control" placeholder="Email Address" required> </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="form-section">Audience Details</h3>
                                @for ($i = 0; $i < $ammount; $i++)
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="control-label">Title</label>
                                            <select name="ticket_title[]" class="form-control">
                                                <option>Mr.</option>
                                                <option>Mrs.</option>
                                                <option>Ms.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Full Name</label>
                                            <input name="ticket_name[]" type="text" id="firstName" class="form-control" placeholder="Don Jon" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Phone Number</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    +62
                                                </span>
                                                <input name="ticket_phone[]" type="phone" class="form-control" placeholder="Phone Number" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <input name="ticket_email[]" type="email" class="form-control" placeholder="Email Address" required> </div>
                                        </div>
                                    </div>
                                    @if(!$seat_available->isEmpty())
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="control-label">Seat</label>
                                            <select class="form-control" name="seat[]">
                                                @foreach($seat_available as $seat)
                                                <option value="{{$seat->id}}">{{$seat->no}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endfor
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-3">
                                        <a href="{{route('tickets')}}" class="btn btn-outline red"> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-outline green"> Continue
                                            <i class="fa fa-angle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js_plugins')
    <script src="{{URL('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"
            type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js"
            type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"
            type="text/javascript"></script>
@endsection
@section('page_js')

@endsection
