@extends('layouts.dashboard')
@section('title', 'Add Transaction')
@section('page_style')
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid container-lf-space margin-top-30">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="form_wizard_1">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark sbold uppercase">Input Transaction</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" action="{{route('payment.add.submit')}}" id="submit_form" method="POST">
                            {{ csrf_field() }}
                            <div class="form-wizard">
                                <div class="form-body">
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Bank</label>
                                      <div class="col-md-4">
                                          <select class="form-control" name="bank_name">
                                              <option value="bca">Bank Central Asia</option>
                                              <option value="bni">Bank Negara Indonesia</option>
                                              <option value="mandiri">Mandiri</option>
                                              <option value="other">Others</option>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Account Holder</label>
                                      <div class="col-md-4">
                                          <input type="text" name="inputAccount_holder" class="form-control" placeholder="Insert Account Holder">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Total</label>
                                        <div class="col-md-4">
                                            <input type="text" name="inputTotal" class="form-control" placeholder="Insert Total">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-3">
                                            <a href="{{route('payments')}}" class="btn btn-outline red"> Cancel
                                            </a>
                                            <button type="submit" class="btn btn-outline green"> Submit
                                                <i class="fa fa-angle-right"></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js_plugins')
    <script src="{{URL('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="{{URL('/')}}/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
@endsection
@section('page_js')

@endsection
