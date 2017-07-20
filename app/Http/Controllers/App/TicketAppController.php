<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
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
    public function payTicket(Request $request)
    {
        View::share( 'page_state', 'pay' );
        return view('app.ticket.ticket_pay');
    }
    public function successBookTicket(Request $request)
    {
        View::share( 'page_state', 'success' );
        return view('app.ticket.ticket_book_success');
    }
}
