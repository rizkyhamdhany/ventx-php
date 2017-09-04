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

Route::get('/', 'LandingController@index')->name('home');
Route::get('/contact', 'LandingController@contact')->name('contact');
Route::get('/tnc', 'LandingController@tnc')->name('tnc');

Route::prefix('/doku')->group(function () {
    Route::get('/verify', 'App\PaymentController@dokuVerify')->name('payment.doku.verify');
    Route::get('/notify', 'App\PaymentController@dokuNotify')->name('payment.doku.notify');
    Route::get('/redirect', 'App\PaymentController@dokuRedirectProcess')->name('payment.doku.redirecprocess');
    Route::get('/cancel', 'App\PaymentController@dokuCancel')->name('payment.doku.cancel');
});

Route::get('/testpay', 'App\PaymentController@testPay')->name('testpay');

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
Route::get('/test/invoice', 'Dashboard\EO\OrderController@testInvoice')->name('invoice.test');

Route::prefix('/smilemotion')->group(function () {
    Route::get('/', 'LandingController@event')->name('welcome');
    Route::get('/input_payment_code', 'App\PaymentController@inputPaymentCode')->name('payment.input.code');
});

Route::prefix('/festivalbudaya')->group(function () {
    Route::get('/', function(){
      echo "Not available right now";
    })->name('welcome');
    Route::get('/input_payment_code', 'App\PaymentController@inputPaymentCode')->name('payment.input.code');
});

Route::group(['prefix' => '/organizer', 'middleware' => ['auth', 'role:eo']], function () {
    Route::get('/', 'Dashboard\EO\HomeController@index')->name('organizer.home');
    Route::prefix('/tickets')->group(function () {
        Route::get('/', 'Dashboard\EO\TicketDashboardController@listTicket')->name('tickets');
        Route::get('/choose', 'Dashboard\EO\OrderController@chooseTicket')->name('ticket.choose');
        Route::get('/download/{id}', 'Dashboard\EO\TicketDashboardController@downloadTicket')->name('ticket.download');
        Route::prefix('/order')->group(function () {
            Route::post('/', 'Dashboard\EO\OrderController@orderTicket')->name('ticket.choose.submit');
            Route::post('/submit', 'Dashboard\EO\OrderController@orderTicketSubmit')->name('ticket.order.submit');
            Route::get('/detail/{id}', 'Dashboard\EO\OrderController@viewOrderDetail')->name('ticket.order.detail');
            Route::get('/invoice/{id}', 'Dashboard\EO\OrderController@viewInvoice')->name('ticket.order.invoice');
            Route::get('/send_email/{id}', 'Dashboard\EO\OrderController@sendEmail')->name('ticket.order.email');
        });
    });

    //DASHBOARD PAYMENTS
    Route::prefix('/payments')->group(function () {
        Route::get('/', 'Dashboard\EO\TransactionsController@listPayment')->name('dashboard.payments');

        //Route::get('/add' , 'App\PaymentController@addTransaction')->name('payment.add');//AddTransaction
        Route::prefix('/add')->group(function () {
            Route::get('/', 'Dashboard\EO\TransactionsController@addTransaction')->name('payment.add');
            Route::post('/submit', 'Dashboard\EO\TransactionsController@addTransactionSubmit')->name('payment.add.submit');
        });
        Route::prefix('/confirm')->group(function () {
            //Route::get('/','Dashboard\EO\TransactionsController@orderTicket')->name('ticket.choose.submit');//orderView);
            Route::get('/detail/{id}', 'Dashboard\EO\TransactionsController@viewOrderDetail')->name('payment.confirm.detail');//orderView);
        });
        Route::post('/verify', 'Dashboard\EO\TransactionsController@verifyPayment')->name('payment.verify');//orderView);
        Route::get('/test', 'TestInsertController@testView')->name('payment.testView');
        Route::post('/testInsert', 'TestInsertController@testInsert')->name('payment.testInsert');
    });


    Route::prefix('/complains')->group(function () {
        Route::get('/', 'Dashboard\EO\ComplainController@listComplain')->name('complains');//viewList
        Route::prefix('/followUp')->group(function () {
        });
    });
});

Route::group(['prefix' => '/dashboard', 'middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('/', 'Dashboard\Admin\HomeController@index')->name('dashboard.home');
    Route::prefix('/event')->group(function () {
        Route::get('/', 'Dashboard\Admin\EventController@index')->name('dashboard.event');
        Route::get('/add', 'Dashboard\Admin\EventController@addEvent')->name('dashboard.event.add');
        Route::post('/add', 'Dashboard\Admin\EventController@addEventPost')->name('dashboard.event.add.post');
        Route::prefix('/details')->group(function () {
            Route::prefix('/{id}')->group(function ($id) {
                Route::get('/', 'Dashboard\Admin\EventController@detailEvent')->name('dashboard.event.details');
                Route::get('/ticketCategory','Dashboard\Admin\EventController@ticketPeriod')->name('dashboard.event.ticketCategory');
                Route::prefix('/ticketPeriod')->group(function ($id) {
                    Route::get('/add', 'Dashboard\Admin\EventController@ticketPeriodAdd')->name('dashboard.event.ticketPeriod.add');
                    Route::post('/add', 'Dashboard\Admin\EventController@ticketPeriodAdd')->name('dashboard.event.ticketPeriod.add.post');
                });
                Route::prefix('/ticketClass')->group(function ($id) {
                    Route::get('/add', 'Dashboard\Admin\EventController@ticketClassAdd')->name('dashboard.event.ticketClass.add');
                    Route::post('/add', 'Dashboard\Admin\EventController@ticketClassAdd')->name('dashboard.event.ticketClass.add.post');
                });
            });
        });
    });

    Route::prefix('/partner')->group(function(){
        Route::prefix('/ticket')->group(function(){
            Route::get('/','Dashboard\Admin\PartnerController@index')->name('dashboard.partner.ticket_box');
        });
        Route::prefix('/counter')->group(function(){

        });
    });

    Route::prefix('/users')->group(function(){
        Route::get('/','Dashboard\Admin\UsersController@index')->name('dashboard.users');
        Route::get('/create','Dashboard\Admin\UsersController@create')->name('dashboard.users.create');
        Route::post('/create','Dashboard\Admin\UsersController@createUserPost')->name('dashboard.users.create.post');
        Route::get('/privilege','Dashboard\Admin\UsersController@index')->name('dashboard.users.privilege');
    });

    Route::prefix('/payments')->group(function(){
        Route::get('/','Dashboard\EO\TransactionsController@listPayment')->name('dashboard.payments');
        Route::prefix('/add')->group(function(){
            Route::get('/','Dashboard\EO\TransactionsController@addTransaction')->name('payment.add');
            Route::post('/submit','Dashboard\EO\TransactionsController@addTransactionSubmit')->name('payment.add.submit');
        });
        Route::prefix('/confirm')->group(function(){
            Route::get('/detail/{id}','Dashboard\EO\TransactionsController@viewOrderDetail')->name('payment.confirm.detail');//orderView);
        });
        Route::post('/verify','Dashboard\EO\TransactionsController@verifyPayment')->name('payment.verify');
    });
});
