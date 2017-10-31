@extends('layouts.stakeholder_dashboard')
@section('sidebar')
    @include('layouts.stakeholder_dashboard_sidebar')
@endsection
@section('page_style')

@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Dashboard</span>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> Stakeholder Dashboard
                <small>statistics, charts, recent events and reports</small>
            </h1>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="1349">0</span>
                            </div>
                            <div class="desc"> New Feedbacks </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="12,5">0</span>M$ </div>
                            <div class="desc"> Total Profit </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="549">0</span>
                            </div>
                            <div class="desc"> New Orders </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number"> +
                                <span data-counter="counterup" data-value="89"></span>% </div>
                            <div class="desc"> Brand Popularity </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
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
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td>
                                    <div class="clearfix">
                                        <div class="btn-group btn-group-solid">
                                            <a href="" class="btn red">Buy Ticket</a>
                                        </div>
                                    </div>
                                  </td>
                                </tr>
                                <!--<tr>
                                    <td> 1 </td>
                                    <td> Smilemotion </td>
                                    <td> Dec 9, 2017 </td>
                                    <td> Sasana Budaya Ganesha </td>
                                    <td></td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js_plugins')
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
@endsection
@section('page_js')

@endsection
