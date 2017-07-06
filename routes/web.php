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

Route::prefix('/tickets')->group(function () {
    Route::get('/', 'TicketController@listTicket')->name('tickets');
    Route::get('/choose', 'OrderController@chooseTicket')->name('ticket.choose');
    Route::get('/download/{id}', 'TicketController@downloadTicket')->name('ticket.download');
    Route::prefix('/order')->group(function () {
        Route::post('/', 'OrderController@orderTicket')->name('ticket.choose.submit');
        Route::post('/submit', 'OrderController@orderTicketSubmit')->name('ticket.order.submit');
        Route::get('/detail/{id}', 'OrderController@viewOrderDetail')->name('ticket.order.detail');
        Route::get('/invoice/{id}', 'OrderController@viewInvoice')->name('ticket.order.invoice');
    });
});