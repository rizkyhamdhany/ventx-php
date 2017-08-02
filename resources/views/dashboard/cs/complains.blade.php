@extends('layouts.app')
@section('title', 'Customer Complains')
@section('page_style')
    <link href="./assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="./assets/global/plugins/mapplic/mapplic/mapplic.css" rel="stylesheet" type="text/css"/>
    <link href="./assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="./assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
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
                            <a href="{{route('home')}}">
                                <i class="fa fa-chevron-left font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">Dashboard</span>
                            </a>
                        </div>
                        <!--<div class="actions">
                            <div class="btn-group btn-group-devided">
                                <a href="{{route('payment.add')}}" class="btn red">
                                    <i class="fa fa-plus"></i> New Transaction Log
                                </a>
                            </div>
                        </div>-->
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
                                    <th> Invoice # </th>
                                    <th> Name </th>
                                    <th> Account Number </th>
                                    <th> Account Holder </th>
                                    <th> Bank Name </th>
                                    <th> Date </th>
                                    <th> Total </th>
                                    <th>  </th>
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
                                        <td> {{$order->ticket_class}} </td>
                                        <td> {{$order->payment_status}} </td>
                                        <td>
                                            <div class="clearfix">
                                                <div class="btn-group btn-group-solid">
                                                    <a href="{{route("ticket.order.detail", ['id' => $order->id])}}" class="btn green">Follow Up</a>
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
    <script src="./assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="./assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="./assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="./assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="./assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="./assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
@endsection
@section('page_js')
    <script src="./assets/pages/scripts/table-datatables-colreorder.js" type="text/javascript"></script>
@endsection
