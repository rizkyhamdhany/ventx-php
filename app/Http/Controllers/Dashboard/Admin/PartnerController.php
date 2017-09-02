<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\TicketBoxTicketRepository;
use App\Models\TicketBoxRepository;
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
        return view('dashboard.admin.partner.ticket_box_list');
    }
}