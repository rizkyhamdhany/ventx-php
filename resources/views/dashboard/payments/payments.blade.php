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
                                <span class="caption-subject font-dark sbold uppercase">Request for Confirmation</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <a href="{{route('payment.add')}}" class="btn red">
                                        <i class="fa fa-plus"></i> New Transaction Log
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
                                        <th> Date </th>
                                        <th> Order Code </th>
                                        <th> Account Holder </th>
                                        <th> Bank </th>
                                        <th> Transfer Date </th>
                                        <th> Status </th>
                                        <th>  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td> {{$order->created_at->toDateString()}} </td>
                                            <td> {{$order->order_code}} </td>
                                            <td> {{$order->account_holder}} </td>
                                            <td> {{$order->bank['name']}} </td>
                                            <td> {{$order->date}} </td>
                                            <td> {{$order->status}} </td>
                                            <td>
                                                <div class="clearfix">
                                                    <div class="btn-group btn-group-solid">
                                                        <a href="{{route("payment.confirm.detail", ['id' => $order->preorder['id']])}}" class="btn green">Confirm Transaction</a>
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
