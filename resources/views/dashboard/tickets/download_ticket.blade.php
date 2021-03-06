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
            left: 193px;

        }
        .scan_code_text{
            position: absolute;
            font-family: 'Work Sans', sans-serif;
            color:#514F9D;
            top: 500px;
            left: 180px;
        }
        .ticket_class{
            font-family: 'Work Sans', sans-serif;
            color:#514F9D;
            font-size: 20px;
            font-weight: bold;
        }
        .circle_reguler {
            color:#F9ACBC;
        }
        .circle_vip{
            color:#94D3BE;
        }
        .ticket_class_container{
            top: 603px;
            position: absolute;
            right: -20px;
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
            top: 660px;
            position:absolute;
            left: 0px;
            margin: 0 auto;
            text-align: center;
            font-size: 8px;
        }
        .align-right{
            text-align: right;
        }
        .seat_no{
            font-family: 'Work Sans', sans-serif;
            color:#514F9D;
            font-size: 30px;
        }
        .ticket_info_text{
            font-family: 'Work Sans', sans-serif;
            color:#514F9D;
            text-align: right;
            padding-right: 85px;
            line-height: 95%;
        }
    </style>
</head>
<body>
<div class="container">
    <img class="bg_template" src="{{URL('/')}}/assets/pages/img/dbl_ticket_template.jpeg" style="height: 210mm; width: 148.5mm;">
    <img class="barcode" src="data:image/png;base64,{{DNS2D::getBarcodePNG($ticket->ticket_code, "QRCODE", 9, 9)}}" alt="barcode"   />
    <h3 class="scan_code_text"> </h3>
    <div class="ticket_class_container">
        <table class="table-center">
            <tr>
                <td style="padding-right: 10px">
                    
                </td>
                <td style="vertical-align: middle" class="ticket_class">{{$ticket->ticket_name}}</td>
            </tr>
        </table>
    </div>
    <div class="ticket_info">
        <p class="ticket_info_text">
            {{$ticket->ticket_code}}
            <br>
            {{$ticket->name}}
            <br>
            {{$ticket->phone}}
            <br>
            {{$ticket->email}}
        </p>
    </div>
</div>
</body>
</html>
