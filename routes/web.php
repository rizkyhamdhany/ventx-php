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

Route::prefix('/tickets')->group(function () {
    Route::prefix('/smilemotion')->group(function () {
        Route::get('/', 'App\TicketAppController@listTicket')->name('app.ticket.list');
        Route::get('/book', 'App\TicketAppController@bookTicket')->name('app.ticket.book');
        Route::post('/book', 'App\TicketAppController@bookTicketPost')->name('app.ticket.book.post');
        Route::get('/pay', 'App\TicketAppController@payTicket')->name('app.ticket.pay');
        Route::post('/pay', 'App\TicketAppController@payTicketPost')->name('app.ticket.pay.post');
        Route::get('/proceed', 'App\TicketAppController@proceedBookTicket')->name('app.ticket.proceed');
        Route::post('/proceed', 'App\TicketAppController@proceedBookTicketPost')->name('app.ticket.proceed.post');
        Route::get('/success', 'App\TicketAppController@successBookTicket')->name('app.ticket.success');
    });
});

Route::prefix('/smilemotion')->group(function () {
    Route::get('/', 'LandingController@index')->name('welcome');
    Route::get('/input_payment_code', 'PaymentController@inputPaymentCode')->name('payment.input.code');
});

Route::prefix('/dashboard')->group(function () {
    Route::prefix('/tickets')->group(function () {
        Route::get('/', 'TicketDashboardController@listTicket')->name('tickets');
        Route::get('/choose', 'OrderController@chooseTicket')->name('ticket.choose');
        Route::get('/download/{id}', 'TicketDashboardController@downloadTicket')->name('ticket.download');
        Route::prefix('/order')->group(function () {
            Route::post('/', 'OrderController@orderTicket')->name('ticket.choose.submit');
            Route::post('/submit', 'OrderController@orderTicketSubmit')->name('ticket.order.submit');
            Route::get('/detail/{id}', 'OrderController@viewOrderDetail')->name('ticket.order.detail');
            Route::get('/invoice/{id}', 'OrderController@viewInvoice')->name('ticket.order.invoice');
        });
    });
});