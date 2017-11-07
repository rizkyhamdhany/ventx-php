<?php

namespace App\Http\Controllers\Dashboard\Stakeholder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use App\Models\OrderRepository;
use App\Models\Order;
use App\Models\TicketRepository;

class OrderController extends Controller
{
    protected $orderRepo;
    protected $ticketRepo;

    public function __construct(OrderRepository $orderRepo, TicketRepository $ticketRepo){
      $this->orderRepo = $orderRepo;
      $this->ticketRepo = $ticketRepo;
    }

    public function report($id=NULL){
      View::share('page_state','report');
      if($id==NULL){

        return view('dashboard.stakeholder.report');
      }else{

        return view('dashboard.stakeholder.report')
        ->with('event_id',$id);
      }
    }

    public function presale($event_id){
      $orders = Order::select(DB::raw('COUNT(ticket_ammount) as sold'),DB::raw('ticket_period as period'))->groupBy(DB::raw('ticket_period'))
      ->where('payment_status','COMPLETE')
      ->where('event_id',$event_id)
      ->get();
      return $orders->toJSON();
    }
}
