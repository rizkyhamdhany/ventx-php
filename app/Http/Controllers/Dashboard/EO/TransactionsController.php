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
    public function __construct()
    {
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
        if ($order->event_id = 0){
            $order = $this->getTicketPrice($order);
        }else {
            $order = $this->getTicketPriceFTB($order);
        }
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

    private function getTicketPrice($order){
        if ($order->ticket_class == 'Reguler'){
            $order->price_item = 125000;
            $order->grand_total = $order->price_item * $order->ticket_ammount;
        } else if ($order->ticket_class == 'VVIP'){
            $order->price_item = 450000;
            $order->grand_total = $order->price_item * $order->ticket_ammount;
        }
        else {
            $order->price_item = 250000;
            $order->grand_total = $order->price_item * $order->ticket_ammount;
        }
        return $order;
    }

    private function getTicketPriceFTB($order){
        $order->price_item = 55000;
        $order->grand_total = $order->price_item * $order->ticket_ammount;
        return $order;
    }
}
