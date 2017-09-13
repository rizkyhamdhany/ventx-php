<FORM NAME="order" METHOD="Post" ACTION="https://apps.myshortcart.com/payment/request-payment/" >
    <input type=text" name="BASKET" value="Gold,70000.00,1,70000.00;Administration fee,5000.00,1,5000.00">
    <input type=text" name="STOREID" value="{{$store_id}}">
    <input type=text" name="TRANSIDMERCHANT" value="000002">
    <input type=text" name="AMOUNT" value="75000.00">
    <input type=text" name="URL" value="http://www.yourwebsite.com/ ">
    <input type=text" name="WORDS" value="{{sha1('75000.00'.$shared_key.'000002')}}">
    <input type=text" name="CNAME" value="Ismail Danuarta">
    <input type=text" name="CEMAIL" value="ismail@gmail.com">
    <input type=text" name="CWPHONE" value="0210000011">
    <input type=text" name="CHPHONE" value="0210980901">
    <input type=text" name="CMPHONE" value="081298098090">
    <input type=text" name="CCAPHONE" value="02109808009">
    <input type=text" name="CADDRESS" value="Jl. Jendral Sudirman Plaza Asia Office Park Unit 3">
    <input type=text" name="CZIPCODE" value="12345">
    <input type=text" name="SADDRESS" value="Pengadegan Barat V no 17F">
    <input type=text" name="SZIPCODE" value="12217">
    <input type=text" name="SCITY" value="JAKARTA">
    <input type=text" name="SSTATE" value="DKI">
    <input type=text" name="SCOUNTRY" value="784">
    <input type=text" name="BIRTHDATE" value="1988-06-16">
    <button type="submit">Pay</button>
</FORM>