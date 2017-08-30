@extends('layouts.admin_dashboard')
@section('sidebar')
    @include('layouts.admin_dashboard_sidebar')
@endsection
@section('page_style')
    <link href="{{URL('/')}}/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/mapplic/mapplic/mapplic.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="#">Payments</a>
                    </li>
                    <li>
                        <span>Payment Confirmation</span>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> Payment Confirmation
                <small>statistics, charts and reports</small>
            </h1>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.error_msg')
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <a href="{{route('dashboard.payments')}}">
                                    <i class="fa fa-chevron-left font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">Payments</span>
                                </a>
                            </div>
                            <div class="actions">
                                <form action="{{route('payment.verify')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="book_id" value="{{$order->id}}">
                                    <input type="hidden" name="ordersconf_id" value="{{$ordersconf->id}}">
                                    <div class="btn-group btn-group-devided">
                                        <select class="form-control" name="transaction_id">
                                            @foreach($transactions as $transaction)
                                                <option value="{{$transaction->id}}">{{$transaction->bankData->name}} - {{$transaction->account_holder}}- {{$transaction->total}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-warning" style="width:100px;">Verify</button>
                                </form>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <h3 class="form-section">Transaction Information</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Order Code</h4>
                                    <h4><strong>{{$order->order_code}}</strong></h4>
                                </div>
                                <div class="col-md-3">
                                    <h4>Name</h4>
                                    <h4><strong>{{$order->name}}</strong></h4>
                                </div>
                                <div class="col-md-3">
                                    <h4>Bank</h4>
                                    <?php
                                    //ifthen for image
                                    ?>
                                    <h4><strong>{{$ordersconf->bank['name']}}</strong></h4>
                                </div>
                                <div class="col-md-3">
                                    <h4>Account Holder</h4>
                                    <h4><strong>{{$ordersconf->account_holder}}</strong></h4>
                                </div>
                                <div class="col-md-3">
                                    <h4>Total</h4>
                                    <h4><strong>IDR {{$order->grand_total}}</strong></h4>
                                </div>
                                <div class="col-md-3">
                                    <h4>Status</h4>
                                    <h4><strong>UNVERIFIED</strong></h4>
                                </div>
                            </div>
                            <br>
                            <br>
                            <h3 class="form-section">Ticket Details</h3>
                            <div class="table-container">
                                <div class="table-actions-wrapper">
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Phone </th>
                                        <th> Ticket Period </th>
                                        <th> Ticket Class </th>
                                        <th> Seat </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->tickets as $ticket)
                                        <tr>
                                            <td>{{$ticket->name}}</td>
                                            <td>{{$ticket->email}}</td>
                                            <td>{{$ticket->phonenumber}}</td>
                                            <td>{{$ticket->ticket_class}}</td>
                                            <td>{{$ticket->ticket_period}}</td>
                                            <td>{{$ticket->seat_no}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
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
