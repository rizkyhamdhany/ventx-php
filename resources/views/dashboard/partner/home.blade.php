@extends('layouts.dashboard')
@section('page_style')
    <link href="{{URL('/')}}/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/mapplic/mapplic/mapplic.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid container-lf-space margin-top-30">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
                <div class="dashboard-stat white">
                    <div class="visual">
                        <i class="fa fa-shopping-cart fa-icon-medium font-blue no-opacity"></i>
                    </div>
                    <div class="details">
                        <div class="number font-blue"> </div>
                        <div class="desc font-blue"> Total Tiket Sold </div>
                    </div>
                    <a class="more blue" href="{{route('tickets')}}" style="background-color: #3598dc; color:#fff;"> View Details
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat white">
                    <div class="visual">
                        <i class="fa fa-briefcase fa-icon-medium font-red no-opacity"></i>
                    </div>
                    <div class="details">
                        <div class="number font-red"> 0</div>
                        <div class="desc font-red"> Request Payment Confirmation </div>
                    </div>
                    <a class="more" href="#" style="background-color: #e7505a; color:#fff;"> Confirm Payment
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat white">
                    <div class="visual">
                        <i class="fa fa-group fa-icon-medium font-yellow-lemon no-opacity"></i>
                    </div>
                    <div class="details">
                        <div class="number font-yellow-lemon"> 0 </div>
                        <div class="desc font-yellow-lemon"> Customer Complains </div>
                    </div>
                    <a class="more" href="#" style="background-color: #f7ca18; color:#fff;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Sold Ticket</span>
                            <span class="caption-helper">weekly stats...</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided">
                                <a href="{{route('tickets')}}">
                                    <label class="btn red btn-outline btn-circle btn-sm active">
                                        View Details
                                    </label>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="site_statistics_loading">
                            <img src="{{URL('/')}}/assets/global/img/loading.gif" alt="loading" /> </div>
                        <div id="site_statistics_content" class="display-none">
                            <div id="site_statistics" class="chart dashboard-chart"> </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">Presale Statistic</span>
                            <span class="caption-helper">ticket stats...</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided">
                                <a href="{{route('tickets')}}">
                                    <label class="btn green-haze btn-outline btn-circle btn-sm active">
                                        View Details
                                    </label>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="dashboard_amchart_4" class="CSSAnimationChart dashboard-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js_plugins')
@endsection
@section('page_js')
@endsection
