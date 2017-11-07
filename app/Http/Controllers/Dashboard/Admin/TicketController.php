<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use Illuminate\Support\Facades\Redis;
use App\Models\RedisModel;
use App\Models\TicketRepository;
use App\Models\OrderRepository;

class TicketController extends Controller
{
    protected $ticketRepo, $orderRepo;

    public function __construct(TicketRepository $ticketRepo, OrderRepository $orderRepo){
      $this->ticketRepo = $ticketRepo;
      $this->orderRepo = $orderRepo;
      $this->middleware('auth');
      View::share('page_state', 'Ticket Sold');
    }

    public function sold($id){
        $orders = $this->orderRepo->findWhere([
          'payment_status'=>'COMPLETE',
          'event_id'=>$id
        ]);
        return view('dashboard.admin.event.event_ticketSold')
        ->with('orders',$orders)
        ->with('id',$id);
    }
}
