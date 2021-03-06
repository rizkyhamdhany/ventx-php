<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get('/test', function (Request $request) {
//     return "test";
// });

Route::post('/ticket/generate', 'Api\TicketController@index')->name('api.ticket.generate');
Route::post('/ticket/send/sms', 'Api\TicketController@sendTicketSMS')->name('api.ticket.send.sms');
Route::get('/ticket/{id}', 'Api\TicketController@viewTicket')->name('home');

// Route::prefix('/auth')->group(function () {
//     Route::post('/login', 'Api\AuthController@login')->name('api.auth.login');
//     Route::post('/check_login', 'Api\AuthController@checkLogin')->name('api.auth.login.check');
// });

// Route::prefix('/ticket')->group(function () {
//     Route::post('/', 'Api\TicketController@ticketByEO')->name('api.ticket');
//     Route::post('/check', 'Api\TicketController@ticketChecking')->name('api.ticket.check');
// });

// Route::prefix('/doku')->group(function () {
//     Route::post('/verifyDokuForVentex', 'App\PaymentController@dokuVerify')->name('payment.doku.verify');
//     Route::post('/notifyPaymentSuccessOrNot', 'App\PaymentController@dokuNotify')->name('payment.doku.notify');
//     Route::post('/redirectFromDoku', 'App\PaymentController@dokuRedirectProcess')->name('payment.doku.redirecprocess');
//     Route::post('/cancelPaymentWTF', 'App\PaymentController@dokuCancel')->name('payment.doku.cancel');
// });

// Route::get('/api/v1/products/{id?}', ['middleware' => 'auth.basic', function($id = null) {
//     if ($id == null) {
//         $products = App\Product::all(array('id', 'name', 'price'));
//     } else {
//         $products = App\Product::find($id, array('id', 'name', 'price'));
//     }
//     return Response::json(array(
//         'error' => false,
//         'products' => $products,
//         'status_code' => 200
//     ));
// }]);
