@extends('layouts.dashboard')
@section('page_style')
    <link href="{{URL('/')}}/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/mapplic/mapplic/mapplic.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/pages/css/faq.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid container-lf-space margin-top-30">
        <div class="row">
            <div class="col-md-12">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <div class="note note-{{ $msg }}">
                            <p>{{ Session::get('alert-' . $msg) }}</p>
                        </div>
                    @endif
                @endforeach
                @if(isset($valid))
                  <div class="note note-info">{{$valid}}</div>
                @endif
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <a href="#">
                                <span class="caption-subject font-dark sbold uppercase">List Event</span>
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <div class="table-actions-wrapper">
                                <span> </span>
                                <select class="table-group-action-input form-control input-inline input-small input-sm">
                                    <option value="">Select...</option>
                                    <option value="Cancel">Cancel</option>
                                    <option value="Cancel">Hold</option>
                                    <option value="Cancel">On Hold</option>
                                    <option value="Close">Close</option>
                                </select>
                                <button class="btn btn-sm green table-group-action-submit">
                                    <i class="fa fa-check"></i> Submit
                                </button>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Name </th>
                                    <th> Date </th>
                                    <th> Location </th>
                                    <!--<th> Total Ticket Sold </th>-->
                                    <th>  </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($events as $keyIndex=>$event)
                                    <tr>
                                      <td>{{$keyIndex+1}}</td>
                                      <td>{{$event->name}}</td>
                                      <td>{{date('M d, Y', strtotime($event->date))}}</td>
                                      <td>{!! $event->location !!}</td>
                                      <td>
                                        <div class="clearfix">
                                            <div class="btn-group btn-group-solid">
                                                <a href="{{route('partner.ticket.buy', $event->id)}}" class="btn red">Buy Ticket</a>
                                            </div>
                                        </div>
                                      </td>
                                    </tr>
                                    @empty
                                    <!--<tr>
                                        <td> 1 </td>
                                        <td> Smilemotion </td>
                                        <td> Dec 9, 2017 </td>
                                        <td> Sasana Budaya Ganesha </td>
                                        <td> {{$count}} </td>
                                        <td>
                                            <div class="clearfix">
                                                <div class="btn-group btn-group-solid">
                                                    <a href="{{route('partner.ticket.buy', [0])}}" class="btn red">Buy Ticket</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> 2 </td>
                                        <td> Festival Budaya </td>
                                        <td> Sept 30, 2017 </td>
                                        <td> Lapangan Jalan Bali </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>-->
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js_plugins')
    <script src="{{URL('/')}}/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
@endsection
@section('page_js')
    <script src="{{URL('/')}}/assets/pages/scripts/table-datatables-colreorder.js" type="text/javascript"></script>
@endsection
