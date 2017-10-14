<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ventex by Nalar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('assets_landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_landing/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_landing/css/style.css') }}">
</head>

<body class="dark">

<div class="into-page">
    <main>

        <header id="top">
            <!-- <div class="container"> -->
            <div class="row">
                <div class="col-xs-12 col-sm-6 logo">
                    <!-- <img src="img/svg/logo.svg" alt="" /> -->
                    <a class="logo-link" href="{{URL('/')}}">
                        <img src="{{URL('/')}}/assets_landing/img/logo-nalar.png" alt="" width="110" height="22">
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 buy">
                    <a class="button">Available Tickets</a>
                </div>
            </div>
            <!-- </div> -->
        </header>

        <div class="container-fluid">
            <div class="row">
                <div class="filter-button-group">
                    <a data-filter="*">All</a>
                    <a data-filter=".music">Music</a>
                    <a data-filter=".sport">Sport</a>
                    <a data-filter=".seminar">Seminar</a>
                    <a data-filter=".etc">Etc.</a>
                </div>
            </div>

            <div class="row min-height-500">
                <div class="grid">
                    @foreach($events as $event)
                    <div class="grid-item music col-md-3 col-sm-6 col-xs-12">
                        <a href="{{route('event.home', [$event->short_name])}}">
                            <img src="{{URL('/')}}/{{$event->thumbnail}}" alt=""/>
                            <div class="grid-item-hover">
                                <span class="grid-item-hover-icon grid-buy"><button class="btn-buy">Buy Ticket</button></span>
                                <span class="grid-item-hover-bottom">{{$event->name}}</span>
                                <span class="grid-item-hover-bg boysband"></span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="clearfix"></div>

            </div>
        </div>
        <div class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
                <p class="navbar-text pull-left">© 2017 - Nalar Ventex by
                    <a href="http://nalar.id" target="_blank" >Nalar</a>
                </p>

                <a href="{{route('tnc')}}" class="navbar-btn btn-danger btn pull-right">
                    Terms and Conditions
                </a>
                <a class="navbar-btn btn-danger btn pull-right border-none">
                    <span class="glyphicon glyphicon-star"></span>  | &nbsp;
                </a>
                <a href="{{route('contact')}}" class="navbar-btn btn-danger btn pull-right">
                    Contact Us
                </a>
                <a class="navbar-btn btn-danger btn pull-right border-none">
                    <span class="glyphicon glyphicon-star"></span>  | &nbsp;
                </a>
                <a href="{{URL('/')}}/login" class="navbar-btn btn-danger btn pull-right">
                    Login
                </a>
            </div>
        </div>

    </main>
</div>
<!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.js"></script>
<script src="{{ asset('assets_landing/js/classList.min.js') }}"></script>
<script src="{{ asset('assets_landing/js/main.js') }}"></script>

</body>

</html>