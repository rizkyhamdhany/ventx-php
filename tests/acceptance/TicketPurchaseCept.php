<?php
$I = new AcceptanceTester($scenario);
$I->amOnPage('/login');
$I->fillField('email', 'rizky@nalar.id');
$I->fillField('password', 'nalartms132');
$I->click('Login');
$I->see('Admin Nalar');
