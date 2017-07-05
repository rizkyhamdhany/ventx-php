<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('/smilemotion')->group(function () {
    Route::get('/', 'LandingController@index')->name('welcome');
    Route::get('/input_payment_code', 'PaymentController@inputPaymentCode')->name('payment.input.code');
});

Route::prefix('tickets')->group(function () {
    Route::get('/', 'HomeController@listTicket')->name('tickets');
    Route::get('/choose', 'HomeController@chooseTicket')->name('ticket.choose');
    Route::post('/order', 'HomeController@orderTicket')->name('ticket.choose.submit');
    Route::post('/order/submit', 'HomeController@orderTicketSubmit')->name('ticket.order.submit');
    Route::get('/invoice', 'HomeController@viewInvoice')->name('ticket.invoice');
//    Route::get('/order', 'HomeController@orderTicket')->name('ticket.order');
});