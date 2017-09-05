@extends('layouts.dashboard')
@section('page_style')
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid container-lf-space margin-top-30">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="form_wizard_1">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark sbold uppercase">Choose Ticket</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" action="{{route('ticket.choose.submit')}}" id="submit_form" method="POST">
                            {{ csrf_field() }}
                            <div class="form-wizard">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Period Ticket</label>
                                        <div class="col-md-4">
                                            <select class="form-control" name="ticket_period">
                                                <option value="Presale 2">Presale 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="ticket_class" value="Reguler">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Ticket Class</label>
                                        <div class="col-md-4">
                                            <select class="form-control" name="ticket_class">
                                                @foreach($ticket_classes as $ticket_classes)
                                                    <option value="{{$ticket_classes->name}}">{{$ticket_classes->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Amount</label>
                                        <div class="col-md-4">
                                            <select class="form-control" name="amount">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
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
    <script src="{{URL('/')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
@endsection
@section('page_js')

@endsection
