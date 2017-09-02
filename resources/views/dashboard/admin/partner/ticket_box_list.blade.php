@extends('layouts.admin_dashboard')
@section('sidebar')
    @include('layouts.admin_dashboard_sidebar')
@endsection
@section('page_style')

@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="#">Partner</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Ticket Box</span>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> Partner
                <small>statistics, charts and reports</small>
            </h1>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.error_msg')
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">Ticket Box List</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <a href="{{route('dashboard.event.add')}}" class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                        Add Ticket Box
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable">
                                <table class="table table-hover table-light">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th> Logo </th>
                                        <th> Phone </th>
                                        <th> Email </th>
                                        <th> Status </th>
                                    </tr>
                                    </thead>
                                    <tbody>
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
@section('page_js')
@endsection
