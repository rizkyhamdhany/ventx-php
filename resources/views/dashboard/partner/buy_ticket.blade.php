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
                        <h3 class="form-section">Smilemotion 2017</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Ticket Period</h4>
                                <h4><strong>Presale 2</strong></h4>
                            </div>
                            <div class="col-md-3">
                                <h4>Price</h4>
                                <h4><strong>Rp. 125.000</strong></h4>
                            </div>
                            <div class="col-md-3">
                                <h4>Ticket Class</h4>
                                <h4><strong>Reguler</strong></h4>
                            </div>
                        </div>
                        <br>
                        <br>
                        <form class="horizontal-form"  action="{{route('partner.home.ticket.buy.post', [0])}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <h3 class="form-section">Customer Information</h3>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('organizer') ? 'has-error' : ' ' }}">
                                            <label for="single-append-text" class="control-label">Ticket Code</label>
                                            <div class="input-group select2-bootstrap-append">
                                                <select id="single-append-text" class="form-control select2-allow-clear" name="id">
                                                    @foreach($tickets as $ticket)
                                                    <option value="{{$ticket->id}}">{{$ticket->book_code}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('organizer') ? 'has-error' : ' ' }}">
                                            <label class="control-label">Full Name</label>
                                            <input value="{{old('name')}}" name="name" type="text" id="firstName" class="form-control" placeholder="Don Jon" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('organizer') ? 'has-error' : ' ' }}">
                                            <label class="control-label">Phone Number</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    +62
                                                </span>
                                                <input value="{{old('phone')}}" name="phone" type="phone" class="form-control" placeholder="Phone Number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('organizer') ? 'has-error' : ' ' }}">
                                            <label class="control-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <input value="{{old('email')}}" name="email" type="email" class="form-control" placeholder="Email Address" required> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-3">
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
    <script src="{{URL('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
@endsection
