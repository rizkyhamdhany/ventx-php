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
                        <div class="number font-blue"> {{$ticket_count}} </div>
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
                        <!--<div id="site_statistics_loading">
                            <img src="{{URL('/')}}/assets/global/img/loading.gif" alt="loading" />
                        </div>
                        <div id="site_statistics_content" class="display-none">
                            <div id="site_statistics" class="chart dashboard-chart"> </div>
                        </div>-->
                        <div id="orderChart" style="height: 300px;"></div>
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
    <script src="{{URL('/')}}/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/mapplic/js/hammer.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/mapplic/js/jquery.easing.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/mapplic/js/jquery.mousewheel.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/mapplic/mapplic/mapplic.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
@endsection
@section('page_js')
    <script src="{{URL('/')}}/assets/pages/scripts/dashboard.js" type="text/javascript"></script>
    <script>
      $(function(){
        var chart = AmCharts.makeChart("orderChart", {
          "type": "serial",
          "dataLoader": {
            "url": "http://localhost:88/nalar-tms/public/organizer/orders/0"
          },
          "valueAxes": [{
            "gridColor": "#FFFFFF",
            "gridAlpha": 0.2,
            "dashLength": 0
          }],
          "gridAboveGraphs": true,
          "startDuration": 1,
          "graphs": [{
            "balloonText": "[[category]]: <b>[[value]]</b>",
            "bullet": "round",
            "bulletSize": 8,
            "lineThickness": 2,
            "lineColor": "#d1655d",
            "type": "smoothedLine",
            "valueField": "sold"
          }],
          "chartScrollbar": {
              "graph":"g1",
              "gridAlpha":0,
              "color":"#888888",
              "scrollbarHeight":25,
              "backgroundAlpha":0,
              "selectedBackgroundAlpha":0.1,
              "selectedBackgroundColor":"#888888",
              "graphFillAlpha":0,
              "autoGridCount":true,
              "selectedGraphFillAlpha":0,
              "graphLineAlpha":0.2,
              "graphLineColor":"#c2c2c2"
          },
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "valueLineEnabled":true,
            "valueLineBalloonEnabled":true,
            "cursorAlpha": 0,
            "fullWidth":true
          },
          "categoryField": "date",
          "categoryAxis": {
            "parseDates": true,
            "minorGridAlpha": 0.1,
            "minorGridEnabled": true
          },
          "export": {
              "enabled": true
          }
        });
      });
    </script>
@endsection
