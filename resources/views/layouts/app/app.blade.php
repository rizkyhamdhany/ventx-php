<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>{{$event->name}} | Ventex</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Ventex - Nalar Event Experience " name="description"/>
    <meta content="Nalar" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="{{URL('/')}}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    @yield('page_style_libs')
    <link href="{{URL('/')}}/assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{URL('/')}}/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/layouts/layout/css/app/layout.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/layouts/layout/css/app/custom.css" rel="stylesheet" type="text/css" />
    @yield('page_style')
    @include('layouts.app_event_style')
    <link rel="shortcut icon" href="favicon.ico" /> </head>

<body class="page-container-bg-solid">
@include('layouts.app.app_header')
<div class="clearfix"> </div>
<div class="page-container page-content-inner page-container-bg-solid">
    @yield('content')
</div>
<div class="clearfix"> </div>
<div class="page-footer hidden-print event-bg-color">
    <div class="page-footer-inner container-fluid container-lf-space pull-right">
        <div class="pull-right org-logo">
            @foreach($event->sponsors as $sponsor)
            <img src="{{asset($sponsor->url_img)}}">
            @endforeach
        </div>
        <div class="clearfix"> </div>
        <p class="page-footer-copyright font-white"> &copy; <a target="_blank" class="font-yellow-soft" href="http://nalar.id"> Nalar Creative Solution</a> 2017.
        </p>
    </div>
    <div class="go2top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!--[if lt IE 9]>
<script src="{{URL('/')}}/assets/global/plugins/respond.min.js"></script>
<script src="{{URL('/')}}/assets/global/plugins/excanvas.min.js"></script>
<script src="{{URL('/')}}/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<script src="{{URL('/')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/bootstrap-birthday.js" type="text/javascript"></script>
@yield('page_js_plugins')
<script src="{{URL('/')}}/assets/global/scripts/app.js" type="text/javascript"></script>
@yield('page_js')
<script src="{{URL('/')}}/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
</body>

</html>