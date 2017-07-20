@extends('layouts.app')
@section('page_style')
@endsection
@section('content')
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h1>Ticket Purchase</h1>
                <p>{{$event_name}} ticket(s)</p>
            </div>
            <div class="page-sub-title pull-right">
                <h1>
                    <span class="fa-stack fa-2x">
                        <i class="fa fa-circle fa-stack-2x icon-background2"></i>
                        <i class="fa fa-user fa-stack-1x"></i>
                    </span>

                    2
                    <span>Credential Input</span>
                </h1>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="container">
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ticket-period-container">
                            <h3 class="sm-font">Fill Your Identity</h3>
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-body">

                            </div>
                        </div>
                        <button class="btn sm-button btn-block">Button</button>
                    </div>
                    <div class="col-md-6">
                        <div class="ticket-period-container">
                            <h3 class="sm-font">&nbsp;</h3>
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject sm-font-accent bold uppercase">Sort by</span>
                                </div>
                                <div class="tools">
                                    <span class="caption-subject sm-font-accent bold uppercase">Ticket Type</span>
                                </div>
                            </div>
                            <div class="portlet-body">

                            </div>
                        </div>
                        <button class="btn sm-button btn-block">Buy</button>
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