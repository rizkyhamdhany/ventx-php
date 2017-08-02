<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <style>
        html,body{
            height:550mm;
            width:185mm;
        }
        .container{
            position: relative;
        }
        .bg_template{
            position: absolute;
        }
        .tbl_contact_info{
            z-index: 99;
            margin-top: 75mm;
            position: absolute;
            font-size: 3.5mm;
            margin-left: 15mm;
            font-family: 'Work Sans', sans-serif;
        }
        .tbl_contact_space{
            padding-left: 4mm;
            padding-right: 4mm;
        }
        .tbl_order_item, .tbl_order_item_2{
            z-index: 99;
            margin-top: 130mm;
            position: absolute;
            font-size: 3.5mm;
            margin-left: 15mm;
            font-family: 'Work Sans', sans-serif;
            padding: 0;
        }
        .tbl_order_item_space{
            padding-right: 25mm;
        }
        .tbl_order_item_space_vertical{
            padding: 5mm 0;
        }
        tr.border_bottom td {
            border-bottom:1pt solid black;
        }
        .text-bold{
            font-weight: bold;
        }
        .color-grand-total{
            color:#514F9D;
        }
        .page-break {
            page-break-after: always;
        }
        .page_2{
            height: 50%;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <img class="bg_template" src="{{URL('/')}}/assets/pages/img/invoice_template.jpg" style="width: 100%;">
    <table class="tbl_contact_info">
        <tr>
            <td>Order Number</td>
            <td class="tbl_contact_space"> : </td>
            <td>{{$data['order']->order_code}}</td>
            <td>Phone Number</td>
            <td class="tbl_contact_space"> : </td>
            <td>{{$data['order']->phonenumber}}</td>
        </tr>
        <tr>
            <td>Billed to</td>
            <td class="tbl_contact_space"> : </td>
            <td>{{$data['order']->name}}</td>
            <td>Email</td>
            <td class="tbl_contact_space"> : </td>
            <td>{{$data['order']->email}}</td>
        </tr>
    </table>
    <table class="tbl_order_item" cellspacing="0">
        <tr>
            <th class="tbl_order_item_space_vertical"></th>
            <th class="tbl_order_item_space">Ticket Type</th>
            <th class="tbl_order_item_space">Ammount</th>
            <th class="tbl_order_item_space">Price</th>
            <th class="tbl_order_item_space">Total Price</th>
        </tr>
        <tr class="border_bottom">
            <td class="tbl_order_item_space_vertical"></td>
            <td>{{$data['order']->ticket_class}}</td>
            <td>{{$data['order']->ticket_ammount}}</td>
            <td>IDR {{number_format( $data['ticket_price'] , 0 , '' , '.' )}}</td>
            <td>IDR {{number_format( $data['ticket_price'] * $data['order']->ticket_ammount , 0 , '' , '.' )}}</td>
        </tr>
        <tr>
            <td class="tbl_order_item_space_vertical"></td>
            <td></td>
            <td></td>
            <td class="text-bold">Total</td>
            <td class="text-bold">IDR {{number_format( $data['ticket_price'] * $data['order']->ticket_ammount , 0 , '' , '.' )}}</td>
        </tr>
    </table>
    <div class="page-break"></div>
    <div class="page_2">
        <img class="bg_template" src="{{URL('/')}}/assets/pages/img/invoice_template_2.jpg" style="width: 100%;">
        <img class="bg_template" src="{{URL('/')}}/assets/pages/img/t&c.jpg" style="width: 100%; top: 50mm;">
    </div>
    <div class="page-break"></div>
    <div class="page_2">
        <img class="bg_template" src="{{URL('/')}}/assets/pages/img/invoice_template_2.jpg" style="width: 100%;">
        <img class="bg_template" src="{{URL('/')}}/assets/pages/img/t&c_2.jpg" style="width: 100%; top: 50mm;">
    </div>
</div>
</body>
</html>