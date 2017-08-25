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
        .indo, .english{
            font-size: 10px;
            text-align: justify;
            text-justify: inter-word;
            font-family: 'Work Sans', sans-serif;
        }
        .indo{
            margin-top: 5px;
            margin-bottom: 0px;
        }
        .english{
            color:#514F9D;
            font-style: italic;
            margin-top: 0px !important;
            margin-bottom: 5px;
        }
        h1{
            color:#514F9D;
            font-family: 'Work Sans', sans-serif;
            font-size: 24px;
            padding : 5px 5px;
            margin-bottom: 0px;
        }
        .agree_indo, .agree_english{
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="page-break"></div>
    <div class="page_2">
        <img class="bg_template" src="{{URL('/')}}/assets/pages/img/invoice_template_2.jpg" style="width: 100%;">
        <div style="position:absolute; width: 100%; top: 50mm;">
            <table>
                <tr>
                    <td width="48%">
                        <h1>
                            Terms and Conditions
                        </h1>
                    </td>
                    <td width="4%"></td>
                    <td width="48%" style="text-align: right;padding-right: 10px;">
                        <p>Page 1/2</p>
                    </td>
                </tr>
                <tr>
                    <td width="48%" style="padding : 10px">
                        <p class="indo">1. E-ticket ini merupakan tiket pertunjukan. Bawalah e-Ticket ini pada hari H pertunjukan. </p>
                        <p class="english">E-tickets are the show's tickets. Please bring this E-ticket to the show. </p>
                        <p class="indo">2. Pembelian yang sah hanya dapat didapatkan secara online melalui smilemotion.org atau ticket box yang ditunjuk. </p>
                        <p class="english">Valid purchases can only be obtained online via smilemotion.org or any other chosen ticket boxes. </p>
                        <p class="indo">3. Kehilangan dan kerusakan e-Ticket bukan tanggung jawab promotor, harap perhatikan dengan baik e-Ticket anda.</p>
                        <p class="english"> Lost and damaged e-Tickets are NOT the responsibility of the promoter. Please check your e-Tickets carefully. </p>
                        <p class="indo">4. Penyelenggara berhak melarang masuk pengunjung yang tidak dapat menunjukan e-Ticket. </p>
                        <p class="english">The promoter reserves the right to forbid the entry of visitors who can not present their e-Tickets. </p>
                        <p class="indo">5. Pembeli hanya diperkenankan untuk menggunakan e-Ticket yang telah dibeli sebanyak satu kali, penggunaan yang berulang dan penggandaan e-Ticket merupakan perbuatan melanggar hukum. </p>
                        <p class="english">Purchasers only are allowed to use e-Ticket one time for each purchase, re-using and duplicating of e-Ticket are not allowed and is illegal. </p>
                        <p class="indo">6. Satu e-Ticket dengan satu kode QR unik ini hanya berlaku untuk satu orang. </p>
                        <p class="english">One e-Ticket with its own unique QR code is only valid for one person. </p>
                        <p class="indo">7. E-Ticket dengan kode QR yang telah dipergunakan sebelumnya tidak berlaku. </p>
                        <p class="english">An e-Ticket with used QR code is not valid. </p>
                    </td>
                    <td width="4%"></td>
                    <td width="48%" style="vertical-align: top; padding : 10px">
                        <p class="indo">8. Penyelenggara berhak untuk menolak penukaran e-Ticket dengan kode QR yang telah terdeteksi masuk sebelumnya oleh orang lain. </p>
                        <p class="english">The promoter reserves the right to refuse e-Ticket's exchange with QR code that has been detected to enter previously. </p>
                        <p class="indo">9. Penyelenggara berhak untuk memproses dan menuntut secara hukum sesuai dengan ketentuan perundangan yang berlaku baik secara perdata maupun secara pidana terhadap orang-orang yang memperoleh e-Ticket dengan cara yang tidak sah termasuk tapi tidak terbatas dengan cara melakukan pemalsuan atau menggandakan e-Ticket yang sah atau memperoleh e-Ticket dengan cara yang tidak sesuai dengan yang ditentukan oleh penyelenggara sebagaimana dalam butir (2) ketentuan ini. </p>
                        <p class="english">The promoter reserves the right to process and litigate in accordance with Indonesian regulations either in civil or criminal proceedings against people who get tickets in ways that are not valid, including but not limited to counterfeiting or copying a valid ticket or get a ticket in a way that do not match those specified by the Promoter as in item (2) of this provision </p>
                        <p class="indo">10. Penyelenggara tidak bertanggung jawab atas kelalaian pembeli tiket yang mengakibatkan tiket jatuh ke tangan orang lain (dalam penguasaan orang lain) untuk dipergunakan sebagai tanda masuk tempat pertunjukan yang menghilangkan hak dari pembeli e-Ticket. </p>
                        <p class="english">The promoter is not responsible for negligence of the ticket purchaser that resulted in the purchaser's ticket fell to the hands of others (in the possession of others) to be used as an admission that eliminates the ticket buyer from entering the venue </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    {{--<div class="page-break"></div>--}}
    {{--<div class="page_2">--}}
        {{--<img class="bg_template" src="{{URL('/')}}/assets/pages/img/invoice_template_2.jpg" style="width: 100%;">--}}
        {{--<div style="position:absolute; width: 100%; top: 50mm;">--}}

            {{--<table>--}}
                {{--<tr>--}}
                    {{--<td width="48%">--}}
                        {{--<h1>--}}
                            {{--Terms and Conditions--}}
                        {{--</h1>--}}
                    {{--</td>--}}
                    {{--<td width="4%"></td>--}}
                    {{--<td width="48%" style="text-align: right;padding-right: 10px;">--}}
                        {{--<p>Page 2/2</p>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td width="48%" style="padding : 10px">--}}
                        {{--<p class="indo">11. e-Ticket yang telah dibeli tidak dapat ditukar / divangkan kembali.</p>--}}
                        {{--<p class="english">E-Tickets are non-returnable and may not be redeemed for cashunder any circumstances. </p>--}}
                        {{--<p class="indo">12. Harap membawa kartu identitas diri yang sesuai dengan data yang didaftarkan pada saat reservasi. </p>--}}
                        {{--<p class="english">Purchasers must present identification cards according to the data registered during reservation. </p>--}}
                        {{--<p class="indo">13. Jika e-Ticket ini dipindahtangankan harus menyertakan surat kuasa yang ditandatangani pemesan dan bermaterai cukup. </p>--}}
                        {{--<p class="english">If the e-Ticket is transferable purchaser MUST present </p>--}}
                        {{--<p class="indo">14. Dilarang membawa makanan dan minuman dari luar.</p>--}}
                        {{--<p class="english">Food and drinks other than those which can be purchased fron the Venue concessionaires, shall be prohibited inside the Venue</p>--}}
                        {{--<p class="indo">15. Dilarang membawa obat-obatan terlarang, senjata api, senjata tajam, dan alkohol ke dalam tempat pertunjukan.</p>--}}
                        {{--<p class="english">Weapons, illegal drugs, and alcoholic beverages are prohibited inside the Venue.</p>--}}
                        {{--<p class="indo">16. Penyelenggara berhak mengeluarkan pengunjung yang membuat kegaduhan dan mengganggu kenyamanan pengunjung lain.</p>--}}
                        {{--<p class="english">The promoter reserves the right to reject audience who possess a clear and present danger or commotion to the public</p>--}}
                    {{--</td>--}}
                    {{--<td width="4%"></td>--}}
                    {{--<td width="48%" style="vertical-align: top; padding : 10px">--}}
                        {{--<p class="indo">17. Penyelenggara tidak menyediakan tempat penitipan barang dan tidak bertanggung jawab apabila terjadi kehilangan. </p>--}}
                        {{--<p class="english">The promoter does not provide care goods and not responsible in the event of loss. </p>--}}
                        {{--<p class="indo">18. Penyelenggara berhak tidak memberi izin penonton masuk ke dalam suatu ruangan karena sudah dianggap penuh sehingga menjadi tidak aman untuk pengunjung. </p>--}}
                        {{--<p class="english">The Promoter reserves the right to not give permission entry to the audience due to Venue's capacity that may present danger. </p>--}}
                        {{--<p class="indo agree_indo">SYARAT DAN KETENTUAN DI ATAS TELAH SAYA BACA, PAHAMI, MENGERTI DAN SAYA MENYETUJUI UNTUK TERIKAT SECARA HUKUM ATAS SYARAT DAN KETENTUAN DI ATAS</p>--}}
                        {{--<p class="english agree_english">I HAVE READ, UNDERSTAND, AND AGREE TO BE BOUND BY LAW TO THE THERMS AND CONDITIONS ABOVE.</p>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>
</body>
</html>