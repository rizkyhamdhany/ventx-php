@extends('layouts.dashboard')
@section('page_style')
    <link href="{{URL('/')}}/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/mapplic/mapplic/mapplic.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
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
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <a href="{{route('dashboard.home')}}">
                                <i class="fa fa-chevron-left font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">List Ticket</span>
                            </a>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided">
                                <a href="{{route('ticket.choose')}}" class="btn red">
                                    <i class="fa fa-plus"></i> Add New Ticket
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <div class="table-actions-wrapper">
                                <span> </span>
                                <select class="table-group-action-input form-control input-inline input-small input-sm">
                                    <option value="">Select...</option>
                                    <option value="Cancel">Cancel</option>
                                    <option value="Cancel">Hold</option>
                                    <option value="Cancel">On Hold</option>
                                    <option value="Close">Close</option>
                                </select>
                                <button class="btn btn-sm green table-group-action-submit">
                                    <i class="fa fa-check"></i> Submit
                                </button>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Order Code </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Phone </th>
                                    <th> Ticket Period </th>
                                    <th> Payment Status </th>
                                    <td>  </td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td> {{$order->order_code}} </td>
                                        <td> {{$order->name}} </td>
                                        <td> {{$order->email}} </td>
                                        <td> {{$order->phonenumber}} </td>
                                        <td> {{$order->ticket_period}} </td>
                                        <td> {{$order->payment_status}} </td>
                                        <td>
                                            <div class="clearfix">
                                                <div class="btn-group btn-group-solid">
                                                    <a href="{{route("ticket.order.detail", ['id' => $order->id])}}" class="btn green">View Details</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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
@endsection
@section('page_js')
    <script src="{{URL('/')}}/assets/pages/scripts/table-datatables-colreorder.js" type="text/javascript"></script>
@endsection
