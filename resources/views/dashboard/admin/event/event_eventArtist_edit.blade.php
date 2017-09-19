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
                  <span>{{$page_state}}</span>
              </li>
            </ul>
        </div>
        <h1 class="page-title"> Add Artist for {{$page_title}}
        </h1>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-body form">
                      <!-- BEGIN FORM-->
                        <form method="POST" action="{{route('dashboard.event.eventArtist.edit.post',[$id,$artist])}}" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="form-group {{$errors->has('name') ? 'has-error' : ' ' }}">
                                    <label class="col-md-3 control-label">Artist Name</label>
                                    <div class="col-md-4">
                                        <input type="text" name="name" class="form-control" placeholder="Ex : Rizky Hamdhany" value="{{ $artistRepo->name }}">
                                        <span class="help-block"> Please Fill Artist Name </span>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('organizer') ? 'has-error' : ' ' }}">
                                    <label class="col-md-3 control-label">Image Artist</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="file" name="photo"/ value="<?php echo asset('storage/'.$artistRepo->url_img); ?>">
                                        </div>
                                        <span class="help-block"> Browse for image </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-4">
                                        <button type="submit" class="btn blue">Save</button>
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
