@extends('layouts.landing')
@section('page_style_libs')
@endsection
@section('page_style')
    <link href="{{URL('/')}}/assets/pages/css/contact.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h1 class="color-prime">Contact Us</h1>
                <p>Here are some places where you can find us.</p>
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <div class="note note-{{ $msg }}">
                            <p>{{ Session::get('alert-' . $msg) }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="page-sub-title pull-right">
                <h1>
                    &nbsp;
                    <span></span>
                </h1>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="container">
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="c-content-contact-1 c-opt-1">
                    <div class="row" data-auto-height=".c-height">
                        <div class="col-lg-8 col-md-6 c-desktop"></div>
                        <div class="col-lg-4 col-md-6">
                            <div class="c-body">
                                <div class="c-section">
                                    <h3>Nalar</h3>
                                </div>
                                <div class="c-section">
                                    <div class="c-content-label uppercase bg-blue">Address</div>
                                    <p>Jl. Jend. A. Yani No.782, Cicaheum, Kiaracondong,
                                        <br/>Kota Bandung,
                                        <br/>Jawa Barat 40282</p>
                                </div>
                                <div class="c-section">
                                    <div class="c-content-label uppercase bg-blue">Contacts</div>
                                    <p>
                                        <strong>T</strong> (022) 20531755
                                        <br>
                                        <strong>E</strong> Ticket@nalar-ventex.com
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="gmapbg" class="c-content-contact-1-gmap" style="height: 615px;"></div>
                </div>
                <div class="clearfix"></div>
                <div class="c-content-feedback-1 c-option-1 margin-top-100">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="c-container bg-green">
                                <div class="c-content-title-1 c-inverse">
                                    <h3 class="uppercase">Need to know more?</h3>
                                    <div class="c-line-left"></div>
                                    <p class="c-font-lowercase">We get it, you need more information for assurance, here's where you can get it </p>
                                    <br>
                                    <a href="{{route('tnc')}}" class="btn grey-cararra font-dark">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="c-contact">
                                <div class="c-content-title-1">
                                    <h3 class="uppercase">Keep in touch</h3>
                                    <div class="c-line-left bg-dark"></div>
                                    <p class="c-font-lowercase">Leave your email address so you can get the latest news from us</p>
                                </div>
                                <form action="{{route('contact.post')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : ' ' }}">
                                        <input name="name" type="text" placeholder="Your Name" class="form-control input-md" required>
                                        <span class="help-block"> Please Fill Name </span>
                                    </div>
                                    <br>
                                    <div class="form-group {{$errors->has('email') ? 'has-error' : ' ' }}">
                                        <input name="email" type="text" placeholder="Your Email" class="form-control input-md" required>
                                        <span class="help-block"> Please Fill Email </span>
                                    </div>
                                    <br>
                                    <div class="form-group {{$errors->has('phone') ? 'has-error' : ' ' }}">
                                        <input name="phone" type="text" placeholder="Contact Phone" class="form-control input-md" required>
                                        <span class="help-block"> Please Fill Phone </span>
                                    </div>
                                    <br>
                                    <div class="form-group {{$errors->has('message') ? 'has-error' : ' ' }}">
                                        <textarea name="message" rows="8" name="message" placeholder="Write comment here ..." class="form-control input-md" required></textarea>
                                        <span class="help-block"> Please Fill Message </span>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn grey">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js_plugins')
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyBMecqKthwhr1QOmp0uAofyJ8kHhBxra-Y&sensor=false" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/gmaps/gmaps.min.js" type="text/javascript"></script>
@endsection
@section('page_js')
    <script src="{{URL('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/pages/scripts/contact.js" type="text/javascript"></script>
@endsection
