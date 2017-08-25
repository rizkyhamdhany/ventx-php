<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PreorderConf;
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\Preorder;
use App\Models\Bank;

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

            if (isset($preorder)){
                $ticket = new \stdClass();
                $ticket->ticket_ammount = $preorder->ticket_ammount;
                $ticket->ticket_type = $preorder->ticket_class;
                if ($ticket->ticket_type == 'Presale 1'){
                    $ticket->price_item = 50000;
                    $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
                } else{
                    $ticket->price_item = 70000;
                    $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
                }
                $bank = Bank::all();
                return view('app.payment.input_payment_info')
                    ->with('preorder', $preorder)
                    ->with('ticket', $ticket)
                    ->with('banks', $bank)
                    ->with('order_code', $order_code);
            } else {
                $request->session()->flash('alert-danger', 'Reservation Code not Found !');
                return redirect()->route('app.ticket.payment.input.code');
            }
        }catch (Exception $e){
            $request->session()->flash('alert-danger', 'Reservation Code not Found !');
            return redirect()->route('app.ticket.payment.input.code');
        }


    }

    public function inputPaymentConfirmation(Request $request){
        $order_code = $request->input('order_code');
        $preorder = Preorder::where('order_code', $order_code)->first();
        $preorderConfs = new PreorderConf();
        $preorderConfs->order_code = $order_code;
        $preorderConfs->account_holder = $request->input('account_holder');
        $preorderConfs->transfer_date = $request->input('date');
        $preorderConfs->status = 'WAITING';
        $preorderConfs->bank_id = $request->input('bank');
        $preorderConfs->preorder_id = $preorder->id;
        $preorderConfs->save();
        return redirect()->route('app.ticket.payment.confirm.success');
    }

    public function confrimSuccess(Request $request){
        return view('app.payment.confirm_success');
    }
}
