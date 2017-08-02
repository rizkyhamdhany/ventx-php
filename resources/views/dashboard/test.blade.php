@extends('layouts.dashboard')
@section('page_style')
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')
<div class="container-fluid container-lf-space margin-top-30">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered" id="form_wizard_1">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark sbold uppercase">Booking  tickets</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="horizontal-form" action="{{route('payment.testInsert')}}" method="POST">
                      {{ csrf_field() }}
                      <select name'bankName'>
                        <option value='BCA'>BCA</option>
                        <option value='Mandiri'>Bebas</option>
                        <option value='BNI'>BNI</option>
                      </select>
                      <input type='text' name='bankAccountName' placeholder='Insert Bank Account Name'>
                      <select name'tes'>
                        <option value='1'>Tes1</option>
                        <option value='2'>Tes2</option>
                        <option value='3'>Tes3</option>
                      </select>
                      <input type='text' name='bankAccountNumber' placeholder='Insert Bank Account Number'>
                      <button type='submit'>Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
