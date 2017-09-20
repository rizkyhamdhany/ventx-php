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
                        <a href="{{route('dashboard.event')}}">Event</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Event Details</span>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> Event Details
                <small>all information about this event</small>
            </h1>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.error_msg')
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">{{$event->name}} </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-body">
                                    <h3 class="form-section">About Event</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Name:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{$event->name}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Date :</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{$event->date}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Logo:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{$event->logo_color}} </p>
                                                    <p class="form-control-static"> {{$event->logo_white}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Background Pattern :</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{$event->background_pattern}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Pattern Footer:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{$event->pattern_footer}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Color Scheme :</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{$event->color_primary}} </p>
                                                    <p class="form-control-static"> {{$event->color_secondary}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Event Organizer:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{$event->organizer}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Time:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{$event->time}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <h3 class="form-section">Location</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Address:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {!! $event->location !!} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Latitude:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{$event->lat}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Longitude:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{$event->lon}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">
                                                        <i class="fa fa-pencil"></i> Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"> </div>
                                    </div>
                                </div>
                            </form>
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
