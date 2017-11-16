<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>Ventex | {{$event->name}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Ventex - Nalar Event Experience " name="description"/>
    <meta content="Nalar" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{URL('/')}}/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{URL('/')}}/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{URL('/')}}/assets/pages/css/login-5.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN CUSTOM STYLES -->
    <link href="{{URL('/')}}/assets/global/css/smilemo.css" rel="stylesheet" type="text/css" />
    <!-- END CUSTOM STYLES -->
    <link rel="shortcut icon" href="{{URL('/')}}/favicon.ico" />
    @include('layouts.app_event_style')
    <!-- END HEAD -->
</head>
<body class=" login">
<!-- BEGIN : LOGIN PAGE 5-1 -->
@yield('content')
<!-- END : LOGIN PAGE 5-1 -->
<!--[if lt IE 9]>
<script src="{{URL('/')}}/assets/global/plugins/respond.min.js"></script>
<script src="{{URL('/')}}/assets/global/plugins/excanvas.min.js"></script>
<script src="{{URL('/')}}/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{URL('/')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{URL('/')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{URL('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="{{URL('/')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script>
    var Login = function() {

        var handleLogin = function() {

            $('.login-form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                    remember: {
                        required: false
                    }
                },

                messages: {
                    username: {
                        required: "Username is required."
                    },
                    password: {
                        required: "Password is required."
                    }
                },

                invalidHandler: function(event, validator) { //display error alert on form submit
                    $('.alert-danger', $('.login-form')).show();
                },

                highlight: function(element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                success: function(label) {
                    label.closest('.form-group').removeClass('has-error');
                    label.remove();
                },

                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.input-icon'));
                },

                submitHandler: function(form) {
                    form.submit(); // form validation success, call ajax form submit
                }
            });

            $('.login-form input').keypress(function(e) {
                if (e.which == 13) {
                    if ($('.login-form').validate().form()) {
                        $('.login-form').submit(); //form validation success, call ajax form submit
                    }
                    return false;
                }
            });

            $('.forget-form input').keypress(function(e) {
                if (e.which == 13) {
                    if ($('.forget-form').validate().form()) {
                        $('.forget-form').submit();
                    }
                    return false;
                }
            });

            $('#forget-password').click(function(){
                $('.login-form').hide();
                $('.forget-form').show();
            });

            $('#back-btn').click(function(){
                $('.login-form').show();
                $('.forget-form').hide();
            });
        }




        return {
            //main function to initiate the module
            init: function() {

                handleLogin();

                // init background slide images
                $('.login-bg').backstretch([
                        @foreach($event->artists as $artist)
                            '{{asset(('storage/'.$artist->url_img))}}',
                        @endforeach
                    ], {
                        fade: 1000,
                        duration: 1000
                    }
                );

                $('.forget-form').hide();

            }

        };

    }();

    jQuery(document).ready(function() {
        Login.init();
    });
</script>
</body>

</html>