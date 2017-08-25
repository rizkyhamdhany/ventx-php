@extends('layouts.dashboard')
@section('css')

@endsection
@section('content')
<div class="portlet-body form">
    <form class="horizontal-form"  action="" method="POST">
        {{ csrf_field() }}
        <div class="form-body">
            <h3 class="form-section">Event Detail Information</h3>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Event Namee</label>
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
                        <input name="color_scheme" type="text" id="colorScheme" class="form-control" placeholder="Event Color Scheme" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Guest Star</label>
                        <input name="event_name" type="text" id="eventName" class="form-control" placeholder="Some Event" required>
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
