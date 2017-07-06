<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <style>
        html,body{
            height: 210mm;
            width: 148.5mm;
            /*height:1136px;*/
            /*width:640px;*/
            margin:0px;
            padding:0px
        }
        .container{
            position: relative;
        }
        .bg_template{
            position: absolute;
        }
        .barcode{
            position: absolute;
            top: 320px;
            left: 176px;

        }
        .scan_code_text{
            position: absolute;
            font-family: 'Work Sans', sans-serif;
            color:#514F9D;
            top: 500px;
            left: 160px;
        }
        .ticket_class{
            font-family: 'Work Sans', sans-serif;
            color:#514F9D;
            font-size: 45px;
            font-weight: bold;
        }
        .circle_reguler {
            color:#F9ACBC;
        }
        .circle_vip{
            color:#94D3BE;
        }
        .ticket_class_container{
            top: 580px;
            position: absolute;
            left: -50px;
            right: 0;
            margin: 0 auto;
            text-align: center;
        }
        .table-center{
            margin: 0 auto;
        }
        .align-center{
            text-align: center;
        }
        table{
            font-family: 'Work Sans', sans-serif;
            color:#514F9D;
        }
        .ticket_info{
            top: 670px;
            position:absolute;
            left: 380px;
            margin: 0 auto;
            text-align: center;
            font-size: 14px;
        }
        .align-right{
            text-align: right;
        }
        .seat_no{
            font-family: 'Work Sans', sans-serif;
            color:#514F9D;
            font-size: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <img class="bg_template" src="{{URL('/')}}/assets/pages/img/ticket_template.jpg" style="height: 210mm; width: 148.5mm;">
    <img class="barcode" src="data:image/png;base64,{{DNS2D::getBarcodePNG($ticket->ticket_code, "QRCODE", 9, 9)}}" alt="barcode"   />
    <h3 class="scan_code_text">Scan The Code for Entry</h3>
    <div class="ticket_class_container">
        <table class="table-center">
            <tr>
                <td>
                    @if($ticket->ticket_class === 'Reguler')
                        <img style="margin-top: 5px; margin-right: 20px" src="{{URL('/')}}/assets/pages/img/circle_reguler.png">
                    @else
                        <img style="margin-top: 5px; margin-right: 20px" src="{{URL('/')}}/assets/pages/img/circle_vip.png">
                    @endif
                </td>
                <td style="vertical-align: middle" class="ticket_class">{{$ticket->ticket_class}}{{$ticket->seat_no != '' ? ' Seat '.$ticket->seat_no : ' Ticket'}}</td>
            </tr>
        </table>
    </div>
    <div class="ticket_info">
        <table class="table-center">
            <tr>
                <td class="align-right">{{$ticket->ticket_code}}</td>
            </tr>
            <tr>
                <td class="align-right">{{$ticket->name}}</td>
            </tr>
            <tr>
                <td class="align-right">(+62){{$ticket->phonenumber}}</td>
            </tr>
            <tr>
                <td class="align-right">{{$ticket->email}}</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>