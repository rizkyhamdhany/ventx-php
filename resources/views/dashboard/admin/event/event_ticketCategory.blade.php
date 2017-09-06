@extends('layouts.admin_dashboard')
@section('sidebar')
    @include('layouts.admin_dashboard_sidebar_event')
@endsection
@section('page_style')

@endsection
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html">{{$page_state}}</a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> List Ticket Period
                <small>statistics, charts, recent events and reports</small>
            </h1>
            <div class="row">
                <div class="col-md-12">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <div class="note note-{{ $msg }}">
                                <p>{{ Session::get('alert-' . $msg) }}</p>
                            </div>
                        @endif
                    @endforeach
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                          @forelse($arrRoot as $r)
                            <?php print_r($r); print "<br>";?>
                            @empty
                            <?php echo "There is Nothing"; ?>
                          @endforelse
                            <div class="caption">
                                <i class="icon-settings font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">Ticket Category Table</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <a href="{{route('dashboard.event.ticketPeriod.add',$id)}}" class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                        Add Ticket Category
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                              @forelse($arrRoot as $root)
                              <div class="col-lg-3 col-md-4 col-xs-12">
                                  <div class="mt-element-ribbon bg-grey-steel">
                                      <div class="ribbon ribbon-color-warning uppercase">{{$root['name']}}</div>
                                      @foreach($root['class'] as $class)
                                        <div class="ribbon-content">{{$class}}</div>
                                      @endforeach
                                  </div>
                              </div>
                              @empty
                                <p>There is no Ticket Period yet</p>
                              @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
@section('page_js')
@endsection
