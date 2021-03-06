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

// Auth::routes();
 Route::get('/ticket/{id}', 'LandingController@index')->name('index');
// Route::post('/contact_post', 'LandingController@contactPost')->name('contact.post');
// Route::get('/tnc', 'LandingController@tnc')->name('tnc');

// Route::prefix('/doku')->group(function () {
//     Route::get('/test', 'App\PaymentController@testPay')->name('payment.doku.test');
// });

// Route::get('/testpay', 'App\PaymentController@testPay')->name('testpay');

// /*
//  * delete
//  */
// Route::prefix('/tickets')->middleware(['bookticketsession'])->group(function () {
//     Route::prefix('/smilemotion')->group(function () {
//         Route::get('/', 'App\TicketAppController@listTicketOld')->name('app.ticket.list');
//         Route::post('/book', 'App\TicketAppController@bookTicketPostOld')->name('app.ticket.book.post');
//         Route::get('/pay', 'App\TicketAppController@payTicketOld')->name('app.ticket.pay');
//         Route::post('/pay', 'App\TicketAppController@payTicketPostOld')->name('app.ticket.pay.post');
//         Route::get('/proceed', 'App\TicketAppController@proceedBookTicketOld')->name('app.ticket.proceed');
//         Route::post('/proceed', 'App\TicketAppController@proceedBookTicketPostOld')->name('app.ticket.proceed.post');
//         Route::get('/success', 'App\TicketAppController@successBookTicketOld')->name('app.ticket.success');
//         Route::prefix('/payment')->group(function () {
//             Route::prefix('/confirm')->group(function () {
//                 Route::get('/', 'App\PaymentController@inputPaymentCodeOld')->name('app.ticket.payment.input.code');
//                 Route::get('/input', 'App\PaymentController@inputPaymentDetailOld')->name('app.ticket.payment.input.detail');
//                 Route::post('/input', 'App\PaymentController@inputPaymentConfirmationOld')->name('app.ticket.payment.input.detail.input');
//                 Route::get('/success', 'App\PaymentController@confrimSuccessOld')->name('app.ticket.payment.confirm.success');
//             });
//         });
//     });
// });
// /*
//  * end delete
//  */

// /*
//  * delete
//  */
// Route::prefix('/smilemotion')->group(function () {
//     Route::get('/', 'LandingController@event')->name('welcome');
//     Route::get('/input_payment_code', 'App\PaymentController@inputPaymentCode')->name('payment.input.code');
// });
// /*
//  * end delete
//  */

// Route::prefix('/event')->group(function () {
//     Route::get('/{event}', 'App\EventController@index')->name('event.home');
//     Route::get('/{event}/input_payment_code', 'App\PaymentController@inputPaymentCode')->name('event.payment.input.code');

//     Route::prefix('/tickets/{event}')->middleware(['bookticketsession'])->group(function () {
//         Route::get('/', 'App\TicketAppController@listTicket')->name('app.event.ticket.list');
//         Route::post('/book', 'App\TicketAppController@bookTicketPost')->name('app.event.ticket.book.post');
//         Route::get('/pay', 'App\TicketAppController@payTicket')->name('app.event.ticket.pay');
//         Route::post('/pay', 'App\TicketAppController@payTicketPost')->name('app.event.ticket.pay.post');
//         Route::get('/proceed', 'App\TicketAppController@proceedBookTicket')->name('app.event.ticket.proceed');
//         Route::post('/proceed', 'App\TicketAppController@proceedBookTicketPost')->name('app.event.ticket.proceed.post');
//         Route::get('/success', 'App\TicketAppController@successBookTicket')->name('app.event.ticket.success');
//         Route::prefix('/payment')->group(function () {
//             Route::get('/redirect', 'App\TicketAppController@redirectPayment')->name('app.event.ticket.payment.redirect');
//             Route::prefix('/confirm')->group(function () {
//                 Route::get('/', 'App\PaymentController@inputPaymentCode')->name('app.event.ticket.payment.input.code');
//                 Route::get('/input', 'App\PaymentController@inputPaymentDetail')->name('app.event.ticket.payment.input.detail');
//                 Route::post('/input', 'App\PaymentController@inputPaymentConfirmation')->name('app.event.ticket.payment.input.detail.input');
//                 Route::get('/success', 'App\PaymentController@confrimSuccess')->name('app.event.ticket.payment.confirm.success');
//             });
//         });
//     });
// });

// Route::prefix('/festivalbudaya')->group(function () {
//     Route::get('/', function(){
//       echo "Not available right now";
//     })->name('fesbud');
//     Route::get('/input_payment_code', 'App\PaymentController@inputPaymentCode')->name('payment.input.code');
// });

// Route::group(['prefix' => '/organizer', 'middleware' => ['auth', 'role:eo']], function () {
//     Route::get('/', 'Dashboard\EO\HomeController@index')->name('organizer.home');
//     Route::get('/orders/{event_id}','Dashboard\EO\OrderController@show')->name('organizer.orders');
//     Route::get('/presale/{event_id}','Dashboard\EO\OrderController@presale')->name('organizer.presale');
//     Route::prefix('/tickets')->group(function () {
//         Route::get('/', 'Dashboard\EO\TicketDashboardController@listTicket')->name('tickets');
//         Route::get('/choose', 'Dashboard\EO\OrderController@chooseTicket')->name('ticket.choose');
//         Route::get('/download/{id}', 'Dashboard\EO\TicketDashboardController@downloadTicket')->name('ticket.download');
//         Route::prefix('/order')->group(function () {
//             Route::post('/', 'Dashboard\EO\OrderController@orderTicket')->name('ticket.choose.submit');
//             Route::post('/submit', 'Dashboard\EO\OrderController@orderTicketSubmit')->name('ticket.order.submit');
//             Route::get('/detail/{id}', 'Dashboard\EO\OrderController@viewOrderDetail')->name('ticket.order.detail');
//             Route::get('/invoice/{id}', 'Dashboard\EO\OrderController@viewInvoice')->name('ticket.order.invoice');
//             Route::get('/send_email/{id}', 'Dashboard\EO\OrderController@sendEmail')->name('ticket.order.email');
//         });
//     });

//     //DASHBOARD PAYMENTS
//     Route::prefix('/payments')->group(function () {
//         Route::get('/', 'Dashboard\EO\TransactionsController@listPayment')->name('dashboard.payments');

//         //Route::get('/add' , 'App\PaymentController@addTransaction')->name('payment.add');//AddTransaction
//         Route::prefix('/add')->group(function () {
//             Route::get('/', 'Dashboard\EO\TransactionsController@addTransaction')->name('payment.add');
//             Route::post('/submit', 'Dashboard\EO\TransactionsController@addTransactionSubmit')->name('payment.add.submit');
//         });
//         Route::prefix('/confirm')->group(function () {
//             //Route::get('/','Dashboard\EO\TransactionsController@orderTicket')->name('ticket.choose.submit');//orderView);
//             Route::get('/detail/{id}', 'Dashboard\EO\TransactionsController@viewOrderDetail')->name('payment.confirm.detail');//orderView);
//         });
//         Route::post('/verify', 'Dashboard\EO\TransactionsController@verifyPayment')->name('payment.verify');//orderView);
//         Route::get('/test', 'TestInsertController@testView')->name('payment.testView');
//         Route::post('/testInsert', 'TestInsertController@testInsert')->name('payment.testInsert');
//     });

//     Route::prefix('/complains')->group(function () {
//         Route::get('/', 'Dashboard\EO\ComplainController@listComplain')->name('complains');//viewList
//         Route::prefix('/followUp')->group(function () {
//         });
//     });
// });

// Route::group(['prefix' => '/dashboard', 'middleware' => ['auth', 'role:superadmin']], function () {
//     Route::get('/', 'Dashboard\Admin\HomeController@index')->name('dashboard.home');
//     Route::prefix('/event')->group(function () {
//         Route::get('/', 'Dashboard\Admin\EventController@index')->name('dashboard.event');
//         Route::get('/add', 'Dashboard\Admin\EventController@addEvent')->name('dashboard.event.add');
//         Route::post('/add', 'Dashboard\Admin\EventController@addEventPost')->name('dashboard.event.add.post');
//         Route::prefix('/edit')->group(function(){
//           Route::get('/{id}', 'Dashboard\Admin\EventController@editEvent')->name('dashboard.event.edit');
//           Route::post('/{id}', 'Dashboard\Admin\EventController@editEventPost')->name('dashboard.event.edit.post');
//         });
//         Route::get('/delete/{id}', 'Dashboard\Admin\EventController@deleteEvent')->name('dashboard.event.delete');
//         Route::prefix('/details')->group(function () {
//             Route::prefix('/{id}')->group(function ($id) {
//                 Route::get('/', 'Dashboard\Admin\EventController@detailEvent')->name('dashboard.event.details');
//                 Route::prefix('eventArtist')->group(function ($id){
//                   Route::get('/', 'Dashboard\Admin\EventController@eventArtist')->name('dashboard.event.eventArtist');
//                   Route::get('/add', 'Dashboard\Admin\EventController@eventArtistAdd')->name('dashboard.event.eventArtist.add');
//                   Route::post('/add', 'Dashboard\Admin\EventController@eventArtistAdd')->name('dashboard.event.eventArtist.add.post');
//                   Route::get('/edit/{artist}','Dashboard\Admin\EventController@eventArtistEdit')->name('dashboard.event.eventArtist.edit');
//                   Route::post('/edit/{artist}','Dashboard\Admin\EventController@eventArtistEdit')->name('dashboard.event.eventArtist.edit.post');
//                   Route::get('/del/{artist}','Dashboard\Admin\EventController@eventArtistDelete')->name('dashboard.event.eventArtist.delete');
//                 });
//                 Route::prefix('eventSponsor')->group(function ($id){
//                   Route::get('/', 'Dashboard\Admin\EventController@eventSponsor')->name('dashboard.event.eventSponsor');
//                   Route::get('/add', 'Dashboard\Admin\EventController@eventSponsorAdd')->name('dashboard.event.eventSponsor.add');
//                   Route::post('/add', 'Dashboard\Admin\EventController@eventSponsorAdd')->name('dashboard.event.eventSponsor.add.post');
//                   Route::get('/edit/{sponsor}','Dashboard\Admin\EventController@eventSponsorEdit')->name('dashboard.event.eventSponsor.edit');
//                   Route::post('/edit/{sponsor}','Dashboard\Admin\EventController@eventSponsorEdit')->name('dashboard.event.eventSponsor.edit.post');
//                   Route::get('/del/{sponsor}','Dashboard\Admin\EventController@eventSponsorDelete')->name('dashboard.event.eventSponsor.delete');
//                 });

//                 Route::prefix('/ticketCategory')->group(function () {
//                     Route::get('/', 'Dashboard\Admin\EventController@ticketCategory')->name('dashboard.event.ticketCategory');
//                     Route::prefix('/ticketPeriod')->group(function ($id) {
//                         Route::get('/add', 'Dashboard\Admin\EventController@ticketPeriodAdd')->name('dashboard.event.ticketPeriod.add');
//                         Route::post('/add', 'Dashboard\Admin\EventController@ticketPeriodAdd')->name('dashboard.event.ticketPeriod.add.post');
//                         Route::get('/edit/{period}','Dashboard\Admin\EventController@ticketPeriodEdit')->name('dashboard.event.ticketPeriod.edit');
//                         Route::post('/edit/{period}','Dashboard\Admin\EventController@ticketPeriodEdit')->name('dashboard.event.ticketPeriod.edit.post');
//                         Route::get('/del/{period}','Dashboard\Admin\EventController@ticketPeriodDelete')->name('dashboard.event.ticketPeriod.delete');
//                     });
//                     Route::prefix('/ticketClass')->group(function ($id) {
//                         Route::get('/add/{period?}', 'Dashboard\Admin\EventController@ticketClassAdd')->name('dashboard.event.ticketClass.add');
//                         Route::post('/add/{period?}', 'Dashboard\Admin\EventController@ticketClassAdd')->name('dashboard.event.ticketClass.add.post');
//                         Route::get('/edit/{class}','Dashboard\Admin\EventController@ticketClassEdit')->name('dashboard.event.ticketClass.edit');
//                         Route::post('/edit/{class}','Dashboard\Admin\EventController@ticketClassEdit')->name('dashboard.event.ticketClass.edit.post');
//                         Route::get('/del/{class}','Dashboard\Admin\EventController@ticketClassDelete')->name('dashboard.event.ticketClass.delete');
//                     });
//                 });

//                 Route::prefix('/ticketSold')->group(function($id){
//                     Route::get('/','Dashboard\Admin\TicketController@sold')->name('dashboard.event.tickets.sold');
//                 });

//                 Route::prefix('/seat')->group(function ($id){
//                     Route::get('/', 'Dashboard\Admin\SeatController@index')->name('dashboard.event.seat');
//                 });
//             });
//         });
//     });

//     Route::prefix('/partner')->group(function () {
//         Route::prefix('/ticket')->group(function () {
//             Route::get('/', 'Dashboard\Admin\PartnerController@index')->name('dashboard.partner.ticket_box');
//         });
//         Route::prefix('/counter')->group(function () {
//         });
//     });

//     Route::prefix('/users')->group(function () {
//         Route::get('/', 'Dashboard\Admin\UsersController@index')->name('dashboard.users');
//         Route::get('/create', 'Dashboard\Admin\UsersController@create')->name('dashboard.users.create');
//         Route::post('/create', 'Dashboard\Admin\UsersController@createUserPost')->name('dashboard.users.create.post');
//         Route::get('/privilege', 'Dashboard\Admin\UsersController@index')->name('dashboard.users.privilege');
//     });

//     Route::prefix('/payments')->group(function () {
//         Route::get('/', 'Dashboard\EO\TransactionsController@listPayment')->name('dashboard.payments');
//         Route::prefix('/add')->group(function () {
//             Route::get('/', 'Dashboard\EO\TransactionsController@addTransaction')->name('payment.add');
//             Route::post('/submit', 'Dashboard\EO\TransactionsController@addTransactionSubmit')->name('payment.add.submit');
//         });
//         Route::prefix('/confirm')->group(function () {
//             Route::get('/detail/{id}', 'Dashboard\EO\TransactionsController@viewOrderDetail')->name('payment.confirm.detail');//orderView);
//         });
//         Route::post('/verify', 'Dashboard\EO\TransactionsController@verifyPayment')->name('payment.verify');
//     });
// });
// //PARTNER GOTIX
// /*Route::group(['prefix' => '/partner', 'middleware' => ['auth', 'role:partner']], function () {
//     Route::get('/', 'Dashboard\Partner\PartnerController@index')->name('partner.home');
//     Route::get('event/{id}/buy/', 'Dashboard\Partner\PartnerController@buyTicket')->name('partner.home.ticket.buy');
//     Route::post('event/{id}/buy/', 'Dashboard\Partner\PartnerController@buyTicketPost')->name('partner.home.ticket.buy.post');
// });*/
// //ENDPARTNERGOTIX

// //Route::group(['prefix' => '/partner', 'middleware' => ['auth', 'role:partner']], function () {
// Route::prefix('/partner')->middleware(['auth', 'role:partner'])->group(function(){
//     Route::get('/', 'Dashboard\Partner\PartnerController@index')->name('partner.home');
//     Route::prefix('/event')->group(function(){
//       Route::get('/{id}/buy/', 'Dashboard\Partner\PartnerController@buyTicket')->name('partner.ticket.buy');
//       Route::post('/{id}/buy/', 'Dashboard\Partner\PartnerController@buyTicketPost')->name('partner.ticket.buy.post');
//     });
//     Route::get('/order/detail/{id}', 'Dashboard\Partner\PartnerController@viewOrderDetail')->name('partner.order.detail');
//     Route::prefix('/ticket')->group(function(){
//       Route::get('/choose/{event_id}', 'Dashboard\Partner\PartnerController@chooseTicket')->name('partner.ticket.choose');
//       Route::get('/download/{id}', 'Dashboard\Partner\TicketDashboardController@downloadTicket')->name('partner.ticket.download');
//       Route::get('/invoice/{id}', 'Dashboard\Partner\PartnerController@viewInvoice')->name('partner.ticket.invoice');
//       Route::get('/send_email/{id}', 'Dashboard\Partner\PartnerController@sendEmail')->name('partner.ticket.email');
//       Route::get('/download/{id}', 'Dashboard\Partner\PartnerController@downloadTicket')->name('partner.ticket.download');
//     });
//     Route::get('/report','Dashboard\Partner\PartnerController@viewReport')->name('report');
// });

// Route::prefix('/stakeholder')->middleware(['auth', 'role:stakeholder'])->group(function(){
//   Route::get('/','Dashboard\Stakeholder\HomeController@index')->name('stakeholder.home');
//   Route::prefix('/report')->group(function(){
//     Route::get('/','Dashboard\Stakeholder\OrderController@report')->name('stakeholder.report.all');
//     Route::get('/event/{id}','Dashboard\Stakeholder\OrderController@report')->name('stakeholder.report');
//     Route::get('/presale/{id}','Dashboard\Stakeholder\OrderController@presale')->name('stakeholder.presale');
//   });
// });
