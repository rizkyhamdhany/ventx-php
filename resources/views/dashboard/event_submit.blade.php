@extends('layouts.dashboard')
@section('css')

@endsection
@section('content')
<div class="portlet-body form">
    <form class="horizontal-form"  action="{{route('dashboard.event.submit.post')}}" method="POST">
        {{ csrf_field() }}
        <div class="form-body">
            <h3 class="form-section">Event Detail Information</h3>
            <input type="hidden" name="event_name" value="{{$event_name}}">
            <input type="hidden" name="color_scheme" value="{{$color_scheme}}">
            <input type="hidden" name="event_logo" value="{{$event_logo}}">
            <input type="hidden" name="event_background" value="{{$event_background}}">
            <input type="hidden" name="event_date" value="{{$event_date}}">
            <input type="hidden" name="event_location" value="{{$event_location}}">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Event Price</label>
                        <input name="event_price" type="text" id="eventPrice" class="form-control" placeholder="Event Price" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Event Period</label>
                        <input name="event_period" type="text" id="eventPeriod" class="form-control" placeholder="Event Period" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">Event Amount</label>
                        <input name="event_amount" type="text" id="eventAmount" class="form-control" placeholder="Event Amount" required>
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
