<?php
$I = new AcceptanceTester($scenario);

$datajson =
'
[ { "email": "saraswati@smilemotion.org", "password": "smilemotion132", "name": "Saraswati", "tickets": [ { "ticket_period": "Presale 1", "ticket_class": "Reguler", "ammount": "1", "total_price": "70000" }, { "ticket_period": "Presale 1", "ticket_class": "Reguler", "ammount": "2", "total_price": "140000" }, { "ticket_period": "Presale 1", "ticket_class": "Reguler", "ammount": "3", "total_price": "210000" }, { "ticket_period": "Presale 1", "ticket_class": "Reguler", "ammount": "4", "total_price": "280000" }, { "ticket_period": "Presale 1", "ticket_class": "Reguler", "ammount": "5", "total_price": "350000" }, { "ticket_period": "Presale 2", "ticket_class": "Reguler", "ammount": "1", "total_price": "125000" }, { "ticket_period": "Presale 2", "ticket_class": "Reguler", "ammount": "2", "total_price": "250000" }, { "ticket_period": "Presale 2", "ticket_class": "Reguler", "ammount": "3", "total_price": "375000" }, { "ticket_period": "Presale 2", "ticket_class": "Reguler", "ammount": "4", "total_price": "500000" }, { "ticket_period": "Presale 2", "ticket_class": "Reguler", "ammount": "5", "total_price": "625000" } ] }, { "email": "naufal@festivalbudaya.org", "password": "festivalbudaya132", "name": "Naufal", "tickets": [ { "ticket_period": "Presale 1", "ticket_class": "Reguler", "ammount": "1", "total_price": "35000" }, { "ticket_period": "Presale 1", "ticket_class": "Reguler", "ammount": "2", "total_price": "70000" }, { "ticket_period": "Presale 1", "ticket_class": "Reguler", "ammount": "3", "total_price": "105000" }, { "ticket_period": "Presale 1", "ticket_class": "Reguler", "ammount": "4", "total_price": "140000" }, { "ticket_period": "Presale 1", "ticket_class": "Reguler", "ammount": "5", "total_price": "175000" }, { "ticket_period": "Presale 2", "ticket_class": "Reguler", "ammount": "1", "total_price": "45000" }, { "ticket_period": "Presale 2", "ticket_class": "Reguler", "ammount": "2", "total_price": "90000" }, { "ticket_period": "Presale 2", "ticket_class": "Reguler", "ammount": "3", "total_price": "135000" }, { "ticket_period": "Presale 2", "ticket_class": "Reguler", "ammount": "4", "total_price": "180000" }, { "ticket_period": "Presale 2", "ticket_class": "Reguler", "ammount": "5", "total_price": "225000" }, { "ticket_period": "Reguler", "ticket_class": "Reguler", "ammount": "1", "total_price": "55000" }, { "ticket_period": "Reguler", "ticket_class": "Reguler", "ammount": "2", "total_price": "110000" }, { "ticket_period": "Reguler", "ticket_class": "Reguler", "ammount": "3", "total_price": "165000" }, { "ticket_period": "Reguler", "ticket_class": "Reguler", "ammount": "4", "total_price": "220000" }, { "ticket_period": "Reguler", "ticket_class": "Reguler", "ammount": "5", "total_price": "275000" } ] } ]
';

$data = json_decode($datajson);

foreach ($data as $indexKey => $item){
    $I->wantTo('Login #'.$indexKey);
    $I->amOnPage('/login');
    $I->fillField('email', $item->email);
    $I->fillField('password', $item->password);
    $I->click('Login');
    $I->see($item->name);

    foreach ($item->tickets as $i => $ticket){
        $I->amOnPage('/organizer/tickets/choose');
        $I->selectOption('ticket_period',$ticket->ticket_period);
        $I->selectOption('ticket_class',$ticket->ticket_class);
        $I->selectOption('amount',$ticket->ammount);
        $I->click('Continue');
        $I->see(strtoupper('BOOKING '.$ticket->ticket_period.', FOR '.$ticket->ammount.' TICKETS'));

        $I->fillField('contact_fullname', 'Name #'.$i);
        $I->fillField('contact_phone', '+62811000'.$i);
        $I->fillField('contact_email', $i.'e@gmail.com');

        for($y=0; $y < (int) $ticket->ammount; $y++){
            $I->fillField('#ticket_name_'.$y, 'Ticket Name #'.$y);
            $I->fillField('#ticket_phone_'.$y, '+62822000'.$y);
            $I->fillField('#ticket_email_'.$y, $i.'tickete@gmail.com');
        }

        $I->click('Continue');

        $I->see('Name #'.$i);
        $I->see('+62811000'.$i);
        $I->see($i.'e@gmail.com');
        $I->see($ticket->total_price);

        for($y=0; $y < (int) $ticket->ammount; $y++){
            $I->see('Ticket Name #'.$y);
            $I->see('+62822000'.$y);
            $I->see($i.'tickete@gmail.com');
        }
    }

    $I->submitForm('#logout-form', array());
}



