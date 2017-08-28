@extends('layouts.dashboard')
@section('css')

@endsection
@section('content')
<div class="portlet-body form">
    <form class="horizontal-form" action="{{route('dashboard.event.detail.post')}}" method="POST">
        {{ csrf_field() }}
        <div class="form-body">
            <h3 class="form-section">Event Detail Information</h3>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Event Name</label>
                        <input name="event_name" type="text" id="eventName" class="form-control" placeholder="Some Event" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Color Scheme</label>
                        <input name="color_scheme" type="text" id="colorScheme" class="form-control" placeholder="Event Color Scheme" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Event Logo</label>
                        <input name="event_logo" type="text" id="eventLogo" class="form-control" placeholder="Event Logo" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Event Background</label>
                        <input name="event_background" type="text" id="eventBackground" class="form-control" placeholder="Event Background" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Event Date</label>
                        <input name="event_date" type="text" id="eventDate" class="form-control" placeholder="Event Date" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Event Location</label>
                        <input name="event_location" type="text" id="eventLocation" class="form-control" placeholder="Event Location" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-3">
                    <a href="{{route('dashboard.home')}}" class="btn btn-outline red"> Cancel
                    </a>
                    <button type="submit" class="btn btn-outline green"> Submit
                        <i class="fa fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
