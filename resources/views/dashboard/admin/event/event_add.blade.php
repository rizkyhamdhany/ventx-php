@extends('layouts.admin_dashboard')
@section('sidebar')
    @include('layouts.admin_dashboard_sidebar')
@endsection
@section('page_style')
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('dashboard.event')}}">{{$page_state}}</a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> Create Event
            </h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Input Event Details</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form method="POST" action="{{route('dashboard.event.add.post')}}" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Event Name</label>
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control" placeholder="Ex : Guns and Roses Concert" value="{{ old('name') }}">
                                            <span class="help-block"> Please Fill Event Name </span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('short_name') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Event Short Name</label>
                                        <div class="col-md-4">
                                            <input type="text" name="short_name" class="form-control" placeholder="Ex : Guns and Roses" value="{{ old('short_name') }}">
                                            <span class="help-block"> Please Fill Event Short Name </span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('organizer') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Event Organizer</label>
                                        <div class="col-md-4">
                                            <input type="text" name="organizer" class="form-control" value="{{ old('organizer') }}">
                                            <span class="help-block"> Please Fill Event Organizer </span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('logo_color') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Event Logo (Color)</label>
                                        <div class="col-md-4">
                                            <input type="file" name="logo_color" class="form-control"/>
                                            <span class="help-block"> Please Fill Event Logo (Color)</span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('logo_white') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Event Logo (White)</label>
                                        <div class="col-md-4">
                                            <input type="file" name="logo_white" class="form-control"/>
                                            <span class="help-block"> Please Fill Event Logo (White)</span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('background_pattern') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Event Background Pattern</label>
                                        <div class="col-md-4">
                                            <input type="file" name="background_pattern" class="form-control"/>
                                            <span class="help-block"> Please Fill Event Background Pattern</span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('pattern_footer') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Event Pattern Footer</label>
                                        <div class="col-md-4">
                                            <input type="file" name="pattern_footer" class="form-control"/>
                                            <span class="help-block"> Please Fill Event Pattern Footer</span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('color_primary') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Event Color (Primary)</label>
                                        <div class="col-md-4">
                                            <input type="text" name="color_primary" class="form-control" value="{{ old('color_primary') }}">
                                            <span class="help-block"> Please Fill Event Color (Primary)</span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('color_secondary') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Event Color (Secondary)</label>
                                        <div class="col-md-4">
                                            <input type="text" name="color_secondary" class="form-control" value="{{ old('color_secondary') }}">
                                            <span class="help-block"> Please Fill Event Color (Secondary)</span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('color_accent') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Event Color (Accent)</label>
                                        <div class="col-md-4">
                                            <input type="text" name="color_accent" class="form-control" value="{{ old('color_accent') }}">
                                            <span class="help-block"> Please Fill Event Color (Accent)</span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('date') ? 'has-error' : ' ' }}">
                                        <label class="control-label col-md-3">Date</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{{ old('date') }}" name="date" />
                                            </div>
                                            <span class="help-block"> Select Date </span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('time') ? 'has-error' : ' ' }}">
                                        <label class="control-label col-md-3">Time</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <input class="form-control form-control-inline input-medium timepicker timepicker-24" size="16" type="text" value="{{ old('time') }}" name="time" />
                                            </div>
                                            <span class="help-block"> Select Time </span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('location') ? 'has-error' : ' ' }}">
                                        <label class="control-label col-md-3">Location</label>
                                        <div class="col-md-9">
                                            <textarea name="location" id="summernote_1">{{ old('location') }}</textarea>
                                            <span class="help-block"> Please Fill Location </span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('lat') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Latitude</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="lat" value="{{ old('lat') }}">
                                            <span class="help-block"> Please Fill Longitude </span>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('lon') ? 'has-error' : ' ' }}">
                                        <label class="col-md-3 control-label">Longitude</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="lon" value="{{ old('lon') }}">
                                            <span class="help-block"> Please Fill Latitude </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-4">
                                            <button type="submit" class="btn green">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
@section('page_js_plugins')
    <script src="{{URL('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
@endsection
@section('page_js')
    <script src="{{URL('/')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/pages/scripts/components-editors.js" type="text/javascript"></script>
@endsection
