<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use phpDocumentor\Reflection\Types\Array_;
use Webpatser\Uuid\Uuid;
use App\Models\Seat;
use App\Models\TicketClass;
use Milon\Barcode\DNS2D;
use App\Models\DailyOrderStatistic;
use View;

class TicketAppController extends Controller
{
    public function __construct()
    {
        View::share( 'event_name', 'Smilemotion 2017' );
        View::share( 'logo', 'logo_smilemotion.png' );
        View::share( 'url_event', 'http://smilemotion.org' );
    }
    public function listTicket(Request $request)
    {
        View::share( 'page_state', 'pick_seat' );
        return view('app.ticket.ticket_list');
    }
    public function bookTicket(Request $request)
    {
        View::share( 'page_state', 'book' );
        return view('app.ticket.ticket_book');
    }
    public function bookTicketPost(Request $request)
    {
//        echo '<pre>'; print_r($request->input()); exit;
        $ticket = $this->getTicketObj($request);
        View::share( 'page_state', 'book' );
        return view('app.ticket.ticket_book')->with('ticket', $ticket);
    }
    public function payTicket(Request $request)
    {
        View::share( 'page_state', 'pay' );
        return view('app.ticket.ticket_pay');
    }
    public function payTicketPost(Request $request)
    {
        $ticket = $this->getTicketObj($request);
        View::share( 'page_state', 'pay' );
        return view('app.ticket.ticket_pay')->with('ticket', $ticket);
    }
    public function proceedBookTicket(Request $request)
    {
        View::share( 'page_state', 'proceed' );
        return view('app.ticket.ticket_proceed');
    }
    public function proceedBookTicketPost(Request $request)
    {
        $ticket = $this->getTicketObj($request);
        $ticket->bankopt = $request->input('bankopt');
        if($ticket->bankopt == 'BCA'){
            $ticket->bank_account = 'BCA 2831350697 a.n. Adzka Fairuz';
        } else if($ticket->bankopt == 'Mandiri'){
            $ticket->bank_account = 'Mandiri 130 001502303 2 a.n Arina Sani';
        } else if($ticket->bankopt == 'BNI'){
            $ticket->bank_account = 'BNI 0533301387 a.n. Adzka Fairuz';
        }
        View::share( 'page_state', 'proceed' );
        return view('app.ticket.ticket_proceed')->with('ticket', $ticket);
    }
    public function successBookTicket(Request $request)
    {
        View::share( 'page_state', 'success' );
        return view('app.ticket.ticket_book_success');
    }

    private function getTicketObj(Request $request){
        $ticket = new \stdClass();
        $ticket->ticket_period = $request->input('ticket_period');
        $ticket->ticket_type = $request->input('ticket_type');
        $ticket->ticket_ammount = $request->input('ticket_ammount');
        if ($ticket->ticket_type == 'Reguler'){
            $ticket->price_item = 70000;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        } else if ($ticket->ticket_type == 'VIP'){
            $ticket->price_item = 200000;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        } else if ($ticket->ticket_type == 'VVIP'){
            $ticket->price_item = 400000;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        }
        return $ticket;
    }
}