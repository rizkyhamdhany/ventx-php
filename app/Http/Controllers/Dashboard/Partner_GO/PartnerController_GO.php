<?php

namespace App\Http\Controllers\Dashboard\Partner;

use App\Http\Requests\PartnerBuyTicketRequest;
use App\Models\TicketBoxRepository;
use App\Models\TicketBoxTicket;
use App\Models\TicketBoxTicketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class PartnerController_GO extends Controller
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
        $count = TicketBoxTicket::where('status','=','CLOSED')->count();
        return view('dashboard.partner.home')->with('count', $count);
    }

    public function buyTicket($id){
        $tickets = $this->tbTicketRepo->findWhere([
            'status'=>'OPEN',
        ]);
        return view('dashboard.partner.buy_ticket')->with('tickets', $tickets);
    }

    public function buyTicketPost(PartnerBuyTicketRequest $request, $event_id){
        $id = $request->input("id");
        $ticket = $this->tbTicketRepo->find($id);
        if ($ticket->status == "CLOSED"){
            $request->session()->flash('alert-success', 'Event has been created !');
            return redirect()->route('partner.home.ticket.buy', [$event_id]);
        }
        $ticket->name = $request->input("name");
        $ticket->email = $request->input("email");
        $ticket->phonenumber = $request->input("phone");
        $ticket->status = 'CLOSED';
        $ticket->save();
        $request->session()->flash('alert-success', 'Ticket has been purchased !');
        return redirect()->route('partner.home', [$event_id]);
    }
}
