<?php

namespace App\Http\Controllers\Dashboard\Stakeholder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use Illuminate\Support\Facades\Redis;
use App\Models\OrderRepository;
use App\Models\TicketRepository;

class OrderController extends Controller
{
    protected $orderRepo;
    protected $ticketRepo;

    public function __construct(OrderRepository $orderRepo, TicketRepository $ticketRepo){
      $this->orderRepo = $orderRepo;
      $this->ticketRepo = $ticketRepo;
    }

    public function report(){
      
    }
}
