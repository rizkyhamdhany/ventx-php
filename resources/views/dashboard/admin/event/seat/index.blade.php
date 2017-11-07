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
            <h1 class="page-title"> Seat
                <small>list</small>
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
                                <span class="caption-subject font-red sbold uppercase">Seat Table</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                          <div class="table-scrollable">
                              <table class="table table-hover table-light">
                                  <thead>
                                  <tr>
                                      <th> # </th>
                                      <th> Seat Number </th>
                                      <th> Ticket Class </th>
                                      <th> Status </th>
                                      <th> </th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($seats as $indexKey=>$seat)
                                      <tr>
                                        <td>{{++$indexKey}}</td>
                                        <td>{{$seat->no}}</td>
                                        <td>{{$seat->ticket_class}}</td>
                                        <td>{{$seat->status}}</td>
                                        <td>
                                          <a href="" class="btn btn-success">
                                              Button
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
