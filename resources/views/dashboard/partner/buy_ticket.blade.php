@extends('layouts.dashboard')
@section('page_style')
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/mapplic/mapplic/mapplic.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container-fluid container-lf-space margin-top-30">
        <div class="row">
            <div class="col-md-12">
                @include('layouts.error_msg')
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <a href="{{route('partner.home')}}">
                                <i class="fa fa-chevron-left font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">Buy Ticket</span>
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <h3 class="form-section">{{$event->name}}</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Ticket Period</h4>
                                <h4><strong>{{$ticketPeriod->name}}</strong></h4>
                            </div>
                            <div class="col-md-3">
                                <h4>Price</h4>
                                <h4><strong>Rp{{number_format($ticketClass->price, 0 , '' , '.' )}}</strong></h4>
                            </div>
                            <div class="col-md-3">
                                <h4>Ticket Class</h4>
                                <h4><strong>{{$ticketClass->name}}</strong></h4>
                            </div>
                        </div>
                        <br>
                        <br>
                        <form class="horizontal-form"  action="{{route('partner.ticket.buy.post', $event->id)}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="ticket_period" value="{{$ticketPeriod->id}}">
                            <input type="hidden" name="ticket_class" value="{{$ticketClass->id}}">
                            <input type="hidden" name="ammount" value="1">
                            <div class="form-body">
                                <h3 class="form-section">Customer Information</h3>
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="control-label">Title</label>
                                            <select name="ticket_title" class="form-control">
                                                <option>Mr.</option>
                                                <option>Mrs.</option>
                                                <option>Ms.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('organizer') ? 'has-error' : ' ' }}">
                                            <label class="control-label" for="firstName">Full Name</label>
                                            <input value="{{old('name')}}" name="contact_fullname" type="text" id="firstName" class="form-control" placeholder="Fullname" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('organizer') ? 'has-error' : ' ' }}">
                                            <label class="control-label">Phone Number</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    +62
                                                </span>
                                                <input value="{{old('phone')}}" name="contact_phone" type="phone" class="form-control" placeholder="Phone Number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('organizer') ? 'has-error' : ' ' }}">
                                            <label class="control-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <input value="{{old('email')}}" name="contact_email" type="email" class="form-control" placeholder="Email Address" required> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-3">
                                        <a href="{{route('partner.home')}}" class="btn btn-outline red"> Cancel
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
    <script src="{{URL('/')}}/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
@endsection
@section('page_js')
    <script src="{{URL('/')}}/assets/pages/scripts/table-datatables-colreorder.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/pages/scripts/components-select2.js" type="text/javascript"></script>
@endsection
