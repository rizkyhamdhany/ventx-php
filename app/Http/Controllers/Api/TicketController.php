<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderRepository;
use App\Models\TicketRepository;
use App\Models\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class TicketController extends Controller
{
    protected $ticketRepo;
    protected $userRepo;
    protected $orderRepo;

    /**
     * TicketController constructor.
     * @param $ticketRepo
     * @param $userRepo
     * @param $orderRepo
     */
    public function __construct(TicketRepository $ticketRepo, UserRepository $userRepo, OrderRepository $orderRepo)
    {
        $this->ticketRepo = $ticketRepo;
        $this->userRepo = $userRepo;
        $this->orderRepo = $orderRepo;
    }

    public function ticketByEO(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'invalid_credentials'], 404);
        }
        $event_id = $user->event_id;
        $tickets = $this->ticketRepo->findWhere(["event_id" => $event_id], ["ticket_code", "name", "phonenumber", "email"]);
        return response()->json(['status' => 'success', 'message' => 'login success','data' => compact('tickets')]);
    }
}
