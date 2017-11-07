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
                        <a href="index.html">{{$page_state}}</a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> List Event
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
                                <span class="caption-subject font-red sbold uppercase">Event Table</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <a href="{{route('dashboard.event.add')}}" class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                        Add Event
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
                                        <th> Ticket Code </th>
                                        <th> Name </th>
                                        <th> Phone </th>
                                        <th> Ticket Class </th>
                                        <th> Seat </th>
                                        <th> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $number = 0; @endphp
                                    @foreach($orders as $order)

                                      @foreach($order->tickets as $indexKey => $ticket)
                                      @php $number += 1; @endphp
                                      @if(!empty($ticket->seat_no))
                                      <tr style="background-color: #F0F0F0;">
                                      @else
                                      <tr>
                                      @endif
                                        <td> {{$number}} </td>
                                        <td> {{$ticket->ticket_code}} </td>
                                        <td> {{$ticket->title}} {{$ticket->name}} </td>
                                        <td> {{$ticket->phonenumber}} </td>
                                        <td> {{$ticket->ticket_class}} </td>
                                        <td> {{$ticket->seat_no}} </td>
                                        <td>
                                            <a href="{{route('dashboard.event.details', [$ticket->id])}}" class="btn btn-success">
                                                Details
                                            </a>
                                        </td>
                                      </tr>
                                      @endforeach
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
