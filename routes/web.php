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

Route::get('/', 'Dashboard\HomeController@index')->name('home');

Route::prefix('/tickets')->middleware(['bookticketsession'])->group(function () {
    Route::prefix('/smilemotion')->group(function () {
        Route::get('/', 'App\TicketAppController@listTicket')->name('app.ticket.list');
        Route::post('/book', 'App\TicketAppController@bookTicketPost')->name('app.ticket.book.post');
        Route::get('/pay', 'App\TicketAppController@payTicket')->name('app.ticket.pay');
        Route::post('/pay', 'App\TicketAppController@payTicketPost')->name('app.ticket.pay.post');
        Route::get('/proceed', 'App\TicketAppController@proceedBookTicket')->name('app.ticket.proceed');
        Route::post('/proceed', 'App\TicketAppController@proceedBookTicketPost')->name('app.ticket.proceed.post');
        Route::get('/success', 'App\TicketAppController@successBookTicket')->name('app.ticket.success');
        Route::prefix('/payment')->group(function () {
            Route::prefix('/confirm')->group(function () {
                Route::get('/', 'App\PaymentController@inputPaymentCode')->name('app.ticket.payment.input.code');
                Route::get('/input', 'App\PaymentController@inputPaymentDetail')->name('app.ticket.payment.input.detail');
                Route::post('/input', 'App\PaymentController@inputPaymentConfirmation')->name('app.ticket.payment.input.detail.input');
                Route::get('/success', 'App\PaymentController@confrimSuccess')->name('app.ticket.payment.confirm.success');
            });
        });
    });
});

Route::prefix('/smilemotion')->group(function () {
    Route::get('/', 'LandingController@index')->name('welcome');
    Route::get('/input_payment_code', 'App\PaymentController@inputPaymentCode')->name('payment.input.code');
});

Route::prefix('/dashboard')->group(function () {
    Route::prefix('/tickets')->group(function () {
        Route::get('/', 'Dashboard\TicketDashboardController@listTicket')->name('tickets');
        Route::get('/choose', 'Dashboard\OrderController@chooseTicket')->name('ticket.choose');
        Route::get('/download/{id}', 'Dashboard\TicketDashboardController@downloadTicket')->name('ticket.download');
        Route::prefix('/order')->group(function () {
            Route::post('/', 'Dashboard\OrderController@orderTicket')->name('ticket.choose.submit');
            Route::post('/submit', 'Dashboard\OrderController@orderTicketSubmit')->name('ticket.order.submit');
            Route::get('/detail/{id}', 'Dashboard\OrderController@viewOrderDetail')->name('ticket.order.detail');
            Route::get('/invoice/{id}', 'Dashboard\OrderController@viewInvoice')->name('ticket.order.invoice');
        });
    });

    //DASHBOARD PAYMENTS
    Route::prefix('/payments')->group(function(){
        Route::get('/','Dashboard\TransactionsController@listPayment')->name('dashboard.payments');

        //Route::get('/add' , 'App\PaymentController@addTransaction')->name('payment.add');//AddTransaction
        Route::prefix('/add')->group(function(){
            Route::get('/','Dashboard\TransactionsController@addTransaction')->name('payment.add');
            Route::post('/submit','Dashboard\TransactionsController@addTransactionSubmit')->name('payment.add.submit');
        });
        Route::prefix('/confirm')->group(function(){
            //Route::get('/','Dashboard\TransactionsController@orderTicket')->name('ticket.choose.submit');//orderView);
            Route::get('/detail/{id}','Dashboard\TransactionsController@viewOrderDetail')->name('payment.confirm.detail');//orderView);
        });
        Route::post('/verify','Dashboard\TransactionsController@verifyPayment')->name('payment.verify');//orderView);
        Route::get('/test','TestInsertController@testView')->name('payment.testView');
        Route::post('/testInsert','TestInsertController@testInsert')->name('payment.testInsert');
    });


    Route::prefix('/complains')->group(function(){
        Route::get('/','Dashboard\ComplainController@listComplain')->name('complains');//viewList
        Route::prefix('/followUp')->group(function(){
        });
    });
});
