@extends('layouts.app')
@section('page_style_libs')
@endsection
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
                        <i class="fa fa-ticket fa-stack-1x"></i>
                    </span>

                    1
                    <span>Pick Your Seat</span>
                </h1>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="container">
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="ticket-period-container">
                            <span class="btn btn-circle">Presale 1</span>
                            <span>Presale 1</span>
                            <span>Reguler</span>
                        </div>
                        <form class="horizontal-form"  action="{{route('app.ticket.book.post')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="ticket_type" value="Reguler">
                            <input type="hidden" name="ticket_period" value="Presale 1">
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
                                <div class="table-scrollable">
                                    <table class="table table-ticket table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th> Ticket Type </th>
                                            <th> Availability </th>
                                            <th> Price </th>
                                            <th> Quantity </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td> Reguler </td>
                                            <td> 700 </td>
                                            <td> IDR 700.000 </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" name="ticket_ammount">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                    </select>
                                                </div>
                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" href="{{route('app.ticket.book')}}" class="btn sm-button btn-block">Buy Ticket</button>
                        </form>
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