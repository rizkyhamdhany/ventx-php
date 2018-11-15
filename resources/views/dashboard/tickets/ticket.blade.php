<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="VENTX DASHBOARD">
    <meta name="keywords" content="dashboard, ticket, tiket, ecommerce">
    <meta name="author" content="Wision.id">
    <title>VENTX DASHBOARD</title>
    <link rel="apple-touch-icon" sizes="60x60" href="./app-assets/img/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./app-assets/img/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./app-assets/img/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./app-assets/img/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="./app-assets/img/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="./app-assets/img/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <style>
        html,body{
            width: 100%;
            /*height:1136px;*/
            /*width:640px;*/
            margin:0px;
            padding:0px
        }
        .container{
            position: relative;
            width: 50%;
            float:left;
        }
        .halfhalfpercent{
            position: relative;
            width: 25%;
            float:left;
        }
        .bg_template{
            width: 100%;
        }
        .layout{
            position: absolute;
            top: 0;
        }
        .guide{
            border: 1px solid red;
        }
        .col-1{
            width: 8.33%;
        }
        .col-2{
            width: 16.67%;
        }
        .col-3{
            width: 25%;
        }
        .col-4{
            width: 33.33%;
        }
        .col-12{
            width: 100%;
        }
        .row1{
            height: 380px;
        }
        .row2{
            height: 300px;
        }
        .row3{
            height: 80px;
        }
        .row4{
            height: 80px;
        }
        .row5{
            height: 80px;
        }
        .guide{
            border: 1px solid red;
            width: 100%;
        }
        .ticket_class{
            font-family: 'Work Sans', sans-serif;
            font-size: 20px;
            font-weight: bold;
            color: #514F9D;
        }
        .ticket_info{
            font-family: 'Work Sans', sans-serif;
            font-size: 10px;
            color: #514F9D;
        }
        .barcode{
            margin-left: 10px;
            width: 150px;
            height: 150px;

        }

        @media only screen and (max-width: 576px) {
            .container{
                position: relative;
                width: 100%;
                float:left;
            }
            .halfhalfpercent{
                position: relative;
                width: 0%;
                float:left;
            }
            .row1{
                height: 230px;
            }
            .row2{
                height: 150px;
            }
            .row3{
                height: 30px;
            }
            .row4{
                height: 50px;
            }
            .row5{
                height: 50px;
            }
            .ticket_class{
                font-size: 14px;
            }
            .ticket_info{
                font-size: 8px;
            }
            .barcode{
                margin-left: 10px;
                width: 120px;
                height: 120px;

            }
        }

        @media only screen and (max-width: 400px) {
            .container{
                position: relative;
                width: 100%;
                float:left;
            }
            .halfhalfpercent{
                position: relative;
                width: 0%;
                float:left;
            }
            .row1{
                height: 200px;
            }
            .row2{
                height: 150px;
            }
            .row3{
                height: 20px;
            }
            .row4{
                height: 50px;
            }
            .row5{
                height: 60px;
            }
            .ticket_class{
                font-size: 12px;
            }
            .ticket_info{
                font-size: 7px;
            }
            .barcode{
                margin-left: 10px;
                width: 100px;
                height: 100px;

            }
        }

        @media only screen and (max-width: 350px) {
            .container{
                position: relative;
                width: 100%;
                float:left;
            }
            .halfhalfpercent{
                position: relative;
                width: 0%;
                float:left;
            }
            .row1{
                height: 170px;
            }
            .row2{
                height: 130px;
            }
            .row3{
                height: 20px;
            }
            .row4{
                height: 40px;
            }
            .row5{
                height: 50px;
            }
            .ticket_class{
                font-size: 10px;
            }
            .ticket_info{
                font-size: 6px;
            }
            .barcode{
                margin-left: 10px;
                width: 100px;
                height: 100px;

            }
        }
    </style>
</head>
<body>
<div class="halfhalfpercent">&nbsp;</div>
<div class="container">
    <img class="bg_template" src="{{URL('/')}}/assets/pages/img/dbl_ticket_template.jpeg">
    <table class="layout" style="width: 100%;">
        <tr class="guide row1">
            <td class="col-2" colspan="12"></td>
        </tr>
        <tr class="guide row2">
            <td class="col-4" colspan="4"></td>
            <td class="col-4" colspan="4">
                <img class="barcode" src="data:image/png;base64,{{DNS2D::getBarcodePNG($res->data->TicketID, "QRCODE", 9, 9)}}" alt="barcode"   />
            </td>
            <td class="col-4" colspan="4"></td>
        </tr>
        <tr class="guide row3">
            <td class="col-4" colspan="4"></td>
            <td class="col-4" colspan="4"></td>
            <td class="col-4" colspan="4"></td>
        </tr>
        <tr class="guide row4">
            <td class="col-4" colspan="4"></td>
            <td class="col-4" colspan="4" align="center"><span class="ticket_class">Series Pass Tribun</span></td>
            <td class="col-4" colspan="4"></td>
        </tr>
        <tr class="guide row5" align="right">
            <td class="col-2" colspan="2"></td>
            <td class="col-4" colspan="4"></td>
            <td class="col-4" colspan="4" valign="top">
					<span class="ticket_info">
						{{$res->data->TicketID}}
						<br>
						{{$res->data->Order->Name}}
						<br>
						{{$res->data->Order->Phone}}
						<br>
						{{$res->data->Order->Email}}
						</span>
            </td>
            <td class="col-2" colspan="2"></td>
        </tr>
    </table>
</div>
<div class="halfhalfpercent">&nbsp;</div>
</body>
</html>