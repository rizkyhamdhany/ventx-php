@extends('layouts.admin_dashboard')
@section('sidebar')
    @include('layouts.admin_dashboard_sidebar_event')
@endsection
@section('page_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
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
                  <span>{{$cur_page}}</span>
              </li>
            </ul>
        </div>
        <h1 class="page-title"> Create Ticket Class
        </h1>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">Input Ticket Class Details</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form method="POST" action="" class="form-horizontal" id="formClass">
                            {{ csrf_field() }}
                            <input type="hidden" name="event_id" value="{{$id}}">
                            <input type="text" name="period_id" value="{{$period_id}}" readonly>
                            <input type="hidden" name="startDate" value="{{$start_date}}" readonly>
                            <input type="hidden" name="endDate" value="{{$end_date}}" readonly>
                            <div class="form-body">
                                <div class="form-group {{$errors->has('name') ? 'has-error' : ' ' }}">
                                    <label class="col-md-3 control-label">Class Name</label>
                                    <div class="col-md-4">
                                        <input type="text" name="name" class="form-control" placeholder="Ex : Guns and Roses Concert" value="{{ old('name') }}">
                                        <span class="help-block"> Please Fill Ticket Class Name </span>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('price') ? 'has-error' : ' ' }}">
                                    <label class="col-md-3 control-label">Price</label>
                                    <div class="col-md-4">
                                      <div class="input-group">
                                        <span class="input-group-addon">IDR</span>
                                        <input type="text" name="price" class="form-control" placeholder="Ex : 20.000" value="{{ old('name') }}">
                                        <span class="help-block"> Please Fill Ticket Price </span>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('amount') ? 'has-error' : ' ' }}">
                                    <label class="col-md-3 control-label">Amount</label>
                                    <div class="col-md-4">
                                        <input type="text" name="amount" class="form-control" placeholder="Ex : 1000" value="{{ old('name') }}">
                                        <span class="help-block"> Please Fill Ticket Amount </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-4">
                                        <button type="submit" class="btn green">Next</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script>
      $(function(){
        $('#formClass').submit(function(e){
          e.preventDefault();
          var data = $("#formClass").serialize();
          $.post("{{route('dashboard.event.ticketClass.add.post',$id)}}",data,function(){
          })
          .done(function(data){
            alert(data);
            var add = confirm('Data Submitted\nAdd another Ticket Class?');
            if (add == true) {
                $("input[name='name']").val('');
                $("input[name='price']").val('');
                $("input[name='amount']").val('');
            } else {
                window.location.href = "{{route('dashboard.event')}}";
            }
          })
          .fail(function(){
            alert('Fail');
          });
        });
      });
    </script>
@endsection
