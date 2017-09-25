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
                        <a href="index.html">{{$page_state}}</a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> List User
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
                                <span class="caption-subject font-red sbold uppercase">User Table</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <a href="{{route('dashboard.users.create')}}" class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                        Add User
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
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        <th> Privilege </th>
                                        <th> Status </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $indexKey => $user)
                                    <tr>
                                        <td> {{$indexKey + 1}} </td>
                                        <td> {{$user->name}} </td>
                                        <td> {{$user->email}} </td>
                                        <td> {{$user->event['name']}} </td>
                                        <td>
                                            <span class="label label-sm label-success"> Active </span>
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
