@extends('layouts.admin_dashboard')
@section('sidebar')
    @include('layouts.admin_dashboard_sidebar_event')
@endsection
@section('page_style')
@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="#">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">Event</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">Ticket Category</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>{{$page_state}}</span>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> List Ticket Period
                <small>statistics, charts, recent events and reports</small>
            </h1>
            <div class="row">
                <div class="col-md-12">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <div class="note note-{{ $msg }}">
                                <p>{{ Session::get('alert-' . $msg) }}</p>
                            </div>
                        @endif
                    @endforeach
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">Ticket Period Table</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <a href="{{route('dashboard.event.ticket.add')}}" class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                        Add Ticket Period
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
                                        <th> Start Date </th>
                                        <th> End Date </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($events as $indexKey => $event)
                                            <tr>
                                                <td> {{$indexKey + 1}} </td>
                                                <td> {{$event->name}} </td>
                                                <td> {{$event->organizer}} </td>
                                                <td> {!! $event->location !!} </td>
                                                <td>
                                                    <a href="{{route('dashboard.event.details', [$event->id])}}" class="btn btn-success">
                                                        Details
                                                    </a>
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
@section('page_js')
@endsection
