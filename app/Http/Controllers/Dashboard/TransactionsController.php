<?php
/**
 * Created by PhpStorm.
 * User: hamdhanywijaya@gmail.com
 * Date: 8/7/17
 * Time: 6:50 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Preorder;
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
use App\Models\PreorderConf;


class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listPayment(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        $orders = PreorderConf::where('status', '!=', 'VERIFIED')->get();
        return view('dashboard.payments.payments')->with('orders', $orders);
    }

    public function addTransaction(Request $request){
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        $bank = Bank::all();
        return view('dashboard.payments.add_transaction')->with('banks',$bank);
    }

    public function addTransactionSubmit(Request $request){
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        $transaction = new Transaction();
        $transaction->insertTransact($request);
        return redirect()->route('dashboard.payments');
    }

    public function viewOrderDetail(Request $request, $id){
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        $order = Preorder::find($id);
        $transaction = Transaction::where('status', '!=', 'USED')->get();
        $ordersconf = PreorderConf::where('preorder_id', $id)->first();
        if ($order->ticket_class == 'Reguler'){
            $order->price_item = 70000;
            $order->grand_total = $order->price_item * $order->ticket_ammount;
        } else if ($order->ticket_class == 'VIP I' || $order->ticket_class == 'VIP H' || $order->ticket_class == 'VIP E' || $order->ticket_class == 'VIP D'){
            $order->price_item = 200000;
            $order->grand_total = $order->price_item * $order->ticket_ammount;
        } else if ($order->ticket_class == 'VVIP'){
            $order->price_item = 400000;
            $order->grand_total = $order->price_item * $order->ticket_ammount;
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
        $preorder = Preorder::find($request->input('preorder_id'));
        $preorder->payment_status = 'PAID';
        $preorder->save();
        $ordersconf = PreorderConf::find($request->input('ordersconf_id'));
        $ordersconf->status = 'VERIFIED';
        $ordersconf->save();
        return redirect()->route('dashboard.payments');
    }
}