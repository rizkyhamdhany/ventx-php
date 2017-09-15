<?php

namespace App\Http\Controllers\App;

use App\CC;
use App\Http\Controllers\Controller;
use App\Models\BookConf;
use App\Models\EventRepository;
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\Book;
use App\Models\Bank;
use App\Models\DokuPaymentRepository;
use App\Models\Event;

class PaymentController extends Controller
{
    protected $dokuRepo;
    protected $eventRepo;

    public function __construct(DokuPaymentRepository $dokuPaymentRepository, EventRepository $eventRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->dokuRepo = $dokuPaymentRepository;
    }

    public function inputPaymentCode($event){
        $event = $this->eventRepo->findWhere([
            'short_name'=> $event,
        ])->first();
        return view('app.payment.input_payment_code')
                ->with('event', $event);
    }

    public function inputPaymentCodeOld(){
        return view('app.payment.old_input_payment_code');
    }

    public function inputPaymentDetail(Request $request, $event){
        $event = $this->eventRepo->findWhere([
            'short_name'=> $event,
        ])->first();
        try{
            $order_code = $request->input('order_code');
            $preorder = Book::where('order_code', $order_code)->first();

            if (isset($preorder)){
                $ticket = new \stdClass();
                $ticket->ticket_ammount = $preorder->ticket_ammount;
                $ticket->ticket_type = $preorder->ticket_class;
                if ($event->short_name == 'smilemotion'){
                    $ticket = $this->getTicketPrice($ticket);
                } else {
                    $ticket = $this->getTicketPriceFTB($ticket);
                }
                $bank = Bank::all();

                return view('app.payment.input_payment_info')
                    ->with('preorder', $preorder)
                    ->with('ticket', $ticket)
                    ->with('banks', $bank)
                    ->with('order_code', $order_code)
                    ->with('event', $event);
            } else {
                $request->session()->flash('alert-danger', 'Reservation Code not Found !');
                return redirect()->route('app.event.ticket.payment.input.code', [$event->short_name]);
            }
        }catch (Exception $e){
            $request->session()->flash('alert-danger', 'Reservation Code not Found !');
            return redirect()->route('app.event.ticket.payment.input.code' [$event->short_name]);
        }


    }

    public function inputPaymentDetailOld(Request $request){
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
                return view('app.payment.old_input_payment_info')
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

    public function inputPaymentConfirmation(Request $request, $event){
        $order_code = $request->input('order_code');
        $preorder = Book::where('order_code', $order_code)->first();
        $preorderConfs = new BookConf();
        $preorderConfs->order_code = $order_code;
        $preorderConfs->account_holder = $request->input('account_holder');
        $time = strtotime($request->input('date'));
        $newformat = date('Y-m-d',$time);
        $preorderConfs->transfer_date = $newformat;
        $preorderConfs->status = 'WAITING';
        $preorderConfs->bank_id = $request->input('bank');
        $preorderConfs->book_id = $preorder->id;
        $preorderConfs->save();
        return redirect()->route('app.event.ticket.payment.confirm.success', [$event]);
    }

    public function inputPaymentConfirmationOld(Request $request){
        $order_code = $request->input('order_code');
        $preorder = Book::where('order_code', $order_code)->first();
        $preorderConfs = new BookConf();
        $preorderConfs->payment_method = CC::PAYMENT_BANK_TRF;
        $preorderConfs->order_code = $order_code;
        $preorderConfs->account_holder = $request->input('account_holder');
        $preorderConfs->transfer_date = $request->input('date');
        $preorderConfs->status = 'WAITING';
        $preorderConfs->bank_id = $request->input('bank');
        $preorderConfs->book_id = $preorder->id;
        $preorderConfs->save();
        return redirect()->route('app.ticket.payment.confirm.success');
    }

    public function confrimSuccess(Request $request, $event){
        $event = $this->eventRepo->findWhere([
            'short_name'=> $event,
        ])->first();
        return view('app.payment.confirm_success')
            ->with('event', $event);
    }

    public function confrimSuccessOld(Request $request){
        return view('app.payment.old_confirm_success');
    }

    public function dokuVerify(Request $request){
        $mystore_id = env("APP_ENV", CC::ENV_LOCAL) == CC::ENV_LOCAL ? CC::DOKU_STORE_ID_DEV : CC::DOKU_STORE_ID_PROD;
        $myshared_key = env("APP_ENV", CC::ENV_LOCAL) == CC::ENV_LOCAL ? CC::DOKU_SHARED_KEY_DEV : CC::DOKU_SHARED_KEY_PROD;
        $store_id = $request->input('STOREID');
        $order_code = $request->input('TRANSIDMERCHANT');
        $ammount = $request->input('AMOUNT');
        $words = $request->input('WORDS');
        $book = Book::where('order_code', $order_code)->first();
        if ($mystore_id == $store_id){
            if (isset($book)){
                $event = substr($order_code, 0, 2);
                $ticket = new \stdClass();
                $ticket->ticket_type = $book->ticket_class;
                $ticket->ticket_ammount = $book->ticket_ammount;
                if ($event == 'FB'){
                    $ticket = $this->getTicketPriceFTB($ticket);
                } else if ($event == 'SM'){
                    $ticket = $this->getTicketPrice($ticket);
                } else {
                    return 'Stop';
                }
                if ($ticket->grand_total + 5000 == (int) $ammount){
                    if (sha1($ammount.$myshared_key.$book->order_code) == $words){
                        $this->dokuRepo->create([
                            'action' => 'verify' ,
                            'log' => json_encode($request->input())
                        ]);
                        return 'Continue';
                    }
                }
            }
        }
        return 'Stop';

    }

    public function dokuNotify(Request $request){
        $order_code = $request->input('TRANSIDMERCHANT');
        $ammount = $request->input('AMOUNT');
        $result = $request->input('RESULT');
        $payment_type = $request->input('PTYPE');

        $preorder = Book::where('order_code', $order_code)->first();
        $preorderConfs = new BookConf();
        $preorderConfs->payment_method = CC::PAYMENT_DOKU.'-'.$payment_type;
        $preorderConfs->order_code = $order_code;
        $newformat = date('Y-m-d');
        $preorderConfs->transfer_date = $newformat;
        if ($result == 'Success'){
            $preorderConfs->status = 'VERIFIED';
        } else {
            $preorderConfs->status = 'UNPAID';
        }
        $preorderConfs->total = $ammount;
        $preorderConfs->bank_id = 0;
        $preorderConfs->book_id = $preorder->id;
        $preorderConfs->save();

        $this->dokuRepo->create([
            'action' => 'notify' ,
            'log' => json_encode($request->input())
        ]);

        if ($result == 'Success') {
            $preorder->payment_status = 'PAID';
            $preorder->save();

            $event = Event::find($preorder->event_id);
            Order::createOrderFromBankTransferEvent($preorder, $event);
        }
        echo "notify";
    }

    public function dokuRedirectProcess(Request $request){
        $this->dokuRepo->create([
            'action' => 'redirect process' ,
            'log' => json_encode($request->input())
        ]);
        $order_code = $request->input('TRANSIDMERCHANT');
        $event = substr($order_code, 0, 2);
        if ($event == 'FB'){
            return redirect()->route('app.event.ticket.payment.confirm.success', ['festival_budaya']);
        } else if ($event == 'SM'){
            return redirect()->route('app.event.ticket.payment.confirm.success', ['smilemotion']);
        }
    }

    public function dokuCancel(Request $request){
        $this->dokuRepo->create([
            'action' => 'cancel' ,
            'log' => json_encode($request->input())
        ]);
        $order_code = $request->input('TRANSIDMERCHANT');
        $event = substr($order_code, 0, 2);
        if ($event == 'FB'){
            return redirect()->route('app.event.ticket.proceed', ['festival_budaya']);
        } else if ($event == 'SM'){
            return redirect()->route('app.event.ticket.proceed', ['smilemotion']);
        }

    }

    public function testPay(){
        return view('testpay')
            ->with("shared_key", env("APP_ENV", CC::ENV_LOCAL) == CC::ENV_LOCAL ? CC::DOKU_SHARED_KEY_DEV : CC::DOKU_SHARED_KEY_PROD)
            ->with("store_id", env("APP_ENV", CC::ENV_LOCAL) == CC::ENV_LOCAL ? CC::DOKU_STORE_ID_DEV : CC::DOKU_STORE_ID_PROD);
    }

    private function getTicketPrice($ticket){
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
        return $ticket;
    }

    private function getTicketPriceFTB($ticket){
        $ticket->price_item = 45000;
        $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        return $ticket;
    }
}
