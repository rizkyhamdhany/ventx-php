<?php

namespace App\Http\Controllers;

use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\Preorder;

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
        return view('app.payment.input_payment_code');
    }

    public function inputPaymentDetail(Request $request){
        try{
            $order_code = $request->input('order_code');
            $preorder = Preorder::where('order_code', $order_code)->first();
            $ticket = new \stdClass();
            $ticket->ticket_ammount = $preorder->ticket_ammount;
            $ticket->ticket_type = $preorder->ticket_class;
            if ($ticket->ticket_type == 'Reguler'){
                $ticket->price_item = 70000;
                $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
            } else if ($ticket->ticket_type == 'VIP I' || $ticket->ticket_type == 'VIP H' || $ticket->ticket_type == 'VIP E' || $ticket->ticket_type == 'VIP D'){
                $ticket->price_item = 200000;
                $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
            } else if ($ticket->ticket_type == 'VVIP'){
                $ticket->price_item = 400000;
                $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
            }
//            echo '<pre>'; print_r($ticket); exit;
            if (isset($preorder)){
                return view('app.payment.input_payment_info')->with('preorder', $preorder)->with('ticket', $ticket);
            } else {
                $request->session()->flash('alert-danger', 'Reservation Code not Found !');
                return redirect()->route('app.ticket.payment.input.code');
            }
        }catch (Exception $e){
            $request->session()->flash('alert-danger', 'Reservation Code not Found !');
            return redirect()->route('app.ticket.payment.input.code');
        }


    }

    public function confrimSuccess(){
        return view('app.payment.confirm_success');
    }
}
