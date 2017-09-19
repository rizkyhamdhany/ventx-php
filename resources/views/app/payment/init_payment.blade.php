<html>
<head>
    <script src="{{URL('/')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<p>Redirecting...</p>

<FORM id="myForm" NAME="order" METHOD="Post" ACTION="https://apps.myshortcart.com/payment/request-payment/" >
    <input type="hidden" name="BASKET" value="{{$data['BASKET']}}">
    <input type="hidden" name="STOREID" value="{{$data['STOREID']}}">
    <input type="hidden" name="TRANSIDMERCHANT" value="{{$data['TRANSIDMERCHANT']}}">
    <input type="hidden" name="AMOUNT" value="{{$data['AMOUNT']}}">
    <input type="hidden" name="URL" value="{{$data['URL']}}">
    <input type="hidden" name="WORDS" value="{{$data['WORDS']}}">
    <input type="hidden" name="CNAME" value="{{$data['CNAME']}}">
    <input type="hidden" name="CEMAIL" value="{{$data['CEMAIL']}}">
    <input type="hidden" name="CWPHONE"  value="{{$data['CWPHONE']}}">
    <input type="hidden" name="CHPHONE" value="{{$data['CHPHONE']}}">
    <input type="hidden" name="CMPHONE" value="{{$data['CMPHONE']}}">
    <input type="hidden" name="CCAPHONE"  value="{{$data['CCAPHONE']}}">
    <input type="hidden" name="CADDRESS" value="{{$data['CADDRESS']}}">
    <input type="hidden" name="CZIPCODE" value="{{$data['CZIPCODE']}}">
    <input type="hidden" name="SADDRESS" value="{{$data['SADDRESS']}}">
    <input type="hidden" name="SZIPCODE" value="{{$data['SZIPCODE']}}">
    <input type="hidden" name="SCITY" value="{{$data['SCITY']}}">
    <input type="hidden" name="SCOUNTRY" value="{{$data['SCOUNTRY']}}">
    <input type="hidden" name="BIRTHDATE" value="{{$data['BIRTHDATE']}}">
</FORM>
<script>
    $(document).ready(function(){
        $("form#myForm").submit();
    });
    onload = function () {
        var e = document.getElementById("refreshed");
        if (e.value == "no") e.value = "yes";
        else {
            e.value = "no";
            location.reload();
        }
    }
</script>
</body>
</html>