<?php
$I = new AcceptanceTester($scenario);

$datajson =
'
[ { "email": "saraswati@smilemotion.org", "password": "smilemotion132", "name": "Saraswati", "tickets": { "max_amount": "5", "periods": [ { "name": "Presale 1", "classes": [ { "name": "Reguler", "price": "70000" } ] }, { "name": "Presale 2", "classes": [ { "name": "Reguler", "price": "125000" } ] } ] } }, { "email": "naufal@festivalbudaya.org", "password": "festivalbudaya132", "name": "Naufal", "tickets": { "max_amount": "5", "periods": [ { "name": "Presale 1", "classes": [ { "name": "Reguler", "price": "35000" } ] }, { "name": "Presale 2", "classes": [ { "name": "Reguler", "price": "45000" } ] }, { "name": "Reguler", "classes": [ { "name": "Reguler", "price": "55000" } ] } ] } } ]
';

$data = json_decode($datajson);

foreach ($data as $indexKey => $item){
    $I->wantTo('Login #'.$indexKey);
    $I->amOnPage('/login');
    $I->fillField('email', $item->email);
    $I->fillField('password', $item->password);
    $I->click('Login');
    $I->see($item->name);

    $max_amount = (int) $item->tickets->max_amount;

    foreach ($item->tickets->periods as $i => $period){
        foreach ($period->classes as $j => $class){
            for($k = 1; $k <= $max_amount; $k++){
                $I->amOnPage('/organizer/tickets/choose');
                $I->selectOption('ticket_period',$period->name);
                $I->selectOption('ticket_class',$class->name);
                $I->selectOption('amount', $k);
                $I->click('Continue');

                $I->see(strtoupper('BOOKING '.$period->name.', FOR '.$k.' TICKETS'));

                $I->fillField('contact_fullname', 'Name #'.$i);
                $I->fillField('contact_phone', '+62811000'.$i);
                $I->fillField('contact_email', $i.'e@gmail.com');

                for($y=0; $y < $k; $y++){
                    $I->fillField('#ticket_name_'.$y, 'Ticket Name #'.$y);
                    $I->fillField('#ticket_phone_'.$y, '+62822000'.$y);
                    $I->fillField('#ticket_email_'.$y, $y.'tickete@gmail.com');
                }

                $I->click('Continue');

                $I->see('Name #'.$i);
                $I->see('+62811000'.$i);
                $I->see($i.'e@gmail.com');
                $I->see((string)($k * (int) $class->price));

                for($y=0; $y < (int) $k; $y++){
                    $I->see('Ticket Name #'.$y);
                    $I->see('+62822000'.$y);
                    $I->see($y.'tickete@gmail.com');
                }

            }
        }
    }

    $I->submitForm('#logout-form', array());
}



