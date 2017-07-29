<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Seat;
use App\Models\TicketClass;
use App\Models\DailyOrderStatistic;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;

class TransactionController extends Controller{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function listPayment(Request $request)
  {
      $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
      $orders = Order::all();
      return view('dashboard.payments.payments')->with('orders', $orders);
  }

  public function addTransaction(Request $request){
    $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
    return view('dashboard.payments.add_transaction');
  }

  public function viewOrderDetail(Request $request, $id){
      $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
      $order = Order::find($id);
      return view('dashboard.payments.confirm_transaction')
              ->with('order', $order);
  }
}
