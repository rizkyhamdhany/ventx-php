<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\BookConf;
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\Book;
use App\Models\Bank;
use App\Models\DokuPaymentRepository;

class PaymentController extends Controller
{
    protected $dokuRepo;

    public function __construct(DokuPaymentRepository $dokuPaymentRepository)
    {
        $this->dokuRepo = $dokuPaymentRepository;
    }

    public function inputPaymentCode(){
        return view('app.payment.input_payment_code');
    }

    public function inputPaymentDetail(Request $request){
        try{
            $order_code = $request->input('order_code');
            $preorder = Book::where('order_code', $order_code)->first();

            if (isset($preorder)){
                $ticket = new \stdClass();
                $ticket->ticket_ammount = $preorder->ticket_ammount;
                $ticket->ticket_type = $preorder->ticket_class;
                if ($ticket->ticket_type == 'Reguler'){
                    $ticket->price_item = 125000;
                    $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
                } else if ($ticket->ticket_type == 'VIP I' || $ticket->ticket_type == 'VIP H' || $ticket->ticket_type == 'VIP E' || $ticket->ticket_type == 'VIP D'){
                    $ticket->price_item = 250000;
                    $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
                } else if ($ticket->ticket_type == 'VVIP'){
                    $ticket->price_item = 450000;
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
        $preorder = Book::where('order_code', $order_code)->first();
        $preorderConfs = new BookConf();
        $preorderConfs->order_code = $order_code;
        $preorderConfs->account_holder = $request->input('account_holder');
        $preorderConfs->transfer_date = $request->input('date');
        $preorderConfs->status = 'WAITING';
        $preorderConfs->bank_id = $request->input('bank');
        $preorderConfs->book_id = $preorder->id;
        $preorderConfs->save();
        return redirect()->route('app.ticket.payment.confirm.success');
    }

    public function confrimSuccess(Request $request){
        return view('app.payment.confirm_success');
    }

    public function dokuVerify(Request $request){
        $this->dokuRepo->create([
            'action' => 'verify' ,
            'log' => json_encode($request->input())
        ]);
        echo "Continue";
    }

    public function dokuNotify(Request $request){
        $this->dokuRepo->create([
            'action' => 'notify' ,
            'log' => json_encode($request->input())
        ]);
        echo "notify";
    }

    public function dokuRedirectProcess(Request $request){
        $this->dokuRepo->create([
            'action' => 'redirect process' ,
            'log' => json_encode($request->input())
        ]);
        echo "redirect process";
    }

    public function dokuCancel(Request $request){
        $this->dokuRepo->create([
            'action' => 'cancel' ,
            'log' => json_encode($request->input())
        ]);
        echo "cancel";
    }

    public function testPay(){
        return view('testpay');
    }
}
