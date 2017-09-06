<?php

namespace App\Http\Controllers\Dashboard\Partner;

use App\Models\TicketBoxRepository;
use App\Models\TicketBoxTicketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class PartnerController extends Controller
{
    protected $tbRepo, $tbTicketRepo;

    public function __construct(TicketBoxRepository $tbRepo, TicketBoxTicketRepository $tbTicketRepo)
    {
        $this->tbRepo = $tbRepo;
        $this->tbTicketRepo = $tbTicketRepo;
        $this->middleware('auth');
        View::share('page_state', 'Ticket Box');
    }

    public function index(){
        return view('dashboard.partner.home');
    }
}