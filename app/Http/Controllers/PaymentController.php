<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function inputPaymentCode(){
        return view('payment.input_payment_code');
    }
}
