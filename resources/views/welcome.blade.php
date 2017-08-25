@extends('layouts.login')
@section('content')
    <style>
        .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 300px;
        }

        .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .card_container {
            padding: 2px 16px;
            background: #fff;
        }
        .col-centered{
            float: none;
            margin: 0 auto;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('assets/pages/img/sm_thumb.jpg') }}" alt="Avatar" style="width:100%">
                    <div class="card_container">
                        <h4><b>Smilemotion 2017</b></h4>
                        <p>
                            Saturday, December 9, 2017<br>
                            Sasana Budaya Ganesha<br>
                        </p>
                        <p>FKG Unpad</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('assets/pages/img/sm_thumb.jpg') }}" alt="Avatar" style="width:100%">
                    <div class="card_container">
                        <h4><b>Smilemotion 2017</b></h4>
                        <p>
                            Saturday, December 9, 2017<br>
                            Sasana Budaya Ganesha<br>
                        </p>
                        <p>FKG Unpad</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection