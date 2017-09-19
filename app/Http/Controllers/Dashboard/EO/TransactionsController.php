<?php
/**
 * Created by PhpStorm.
 * User: hamdhanywijaya@gmail.com
 * Date: 8/7/17
 * Time: 6:50 PM
 */

namespace App\Http\Controllers\Dashboard\EO;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Event;
use App\Models\EventRepository;
use App\Models\TicketClassRepository;
use App\Models\TicketPeriodRepository;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Seat;
use App\Models\TicketClass;
use App\Models\DailyOrderStatistic;
use App\Models\Transaction;
use App\Models\Bank;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\BookConf;
use View;


class TransactionsController extends Controller
{
    protected $eventRepo;
    protected $ticketPeriodRepo;
    protected $ticketClassRepo;

    public function __construct(EventRepository $eventRepo, TicketPeriodRepository $ticketPeriodRepo, TicketClassRepository $ticketClassRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->ticketPeriodRepo = $ticketPeriodRepo;
        $this->ticketClassRepo = $ticketClassRepo;
        $this->middleware('auth');
        View::share( 'page_state', 'Payments' );
    }

    public function listPayment(Request $request)
    {

        $orders = BookConf::where('status', '!=', 'VERIFIED')->get();
        return view('dashboard.payments.payments')->with('orders', $orders);
    }

    public function addTransaction(Request $request){

        $bank = Bank::all();
        return view('dashboard.payments.add_transaction')->with('banks',$bank);
    }

    public function addTransactionSubmit(Request $request){

        $transaction = new Transaction();
        $transaction->insertTransact($request);
        return redirect()->route('dashboard.payments');
    }

    public function viewOrderDetail(Request $request, $id){

        $order = Book::find($id);
        $transaction = Transaction::where('status', '!=', 'USED')->get();
        $ordersconf = BookConf::where('book_id', $id)->first();
        $ticket_period = $this->ticketPeriodRepo->findWhere([ 'event_id' => $order->event_id,'name' => $order->ticket_period])->first();
        $ticket_class = $this->ticketClassRepo->findWhere(['event_id' => $order->event_id, 'ticket_period_id' => $ticket_period->id, 'name' => $order->ticket_class])->first();
        $order->price_item = $ticket_class->price;
        $order->grand_total = $order->price_item * $order->ticket_ammount;
        return view('dashboard.payments.confirm_transaction')
            ->with('order', $order)
            ->with('ordersconf', $ordersconf)
            ->with('transactions',$transaction);
    }

    public function verifyPayment(Request $request){
        $transaction = Transaction::find($request->input('transaction_id'));
        $transaction->status = 'USED';
        $transaction->save();
        $preorder = Book::find($request->input('book_id'));
        $preorder->payment_status = 'PAID';
        $preorder->save();
        $ordersconf = BookConf::find($request->input('ordersconf_id'));
        $ordersconf->status = 'VERIFIED';
        $ordersconf->save();
        $event = Event::find($preorder->event_id);
        Order::createOrderFromBankTransferEvent($preorder, $event);
        return redirect()->route('dashboard.payments');
    }
}
