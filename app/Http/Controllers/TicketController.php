<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use App\Models\Seat;
use App\Models\TicketClass;
use Milon\Barcode\DNS2D;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listTicket(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        $orders = Order::all();
        return view('dashboard.tickets')->with('orders', $orders);
    }

    public function downloadTicket(Request $request, $id){
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        $ticket = Ticket::find($id);
//        return view('dashboard.tickets.download_ticket')->with('ticket', $ticket);
        if ($ticket->url_ticket != ""){
            return redirect()->to(url('/').'/'.$ticket->url_ticket);
        } else {
            $pdf = \PDF::loadView('dashboard.tickets.download_ticket', compact('ticket'))->setPaper('A5', 'portrait');
            $output = $pdf->output();
            $ticket_url = 'uploads/ticket/ticket_'.$ticket->ticket_code.'.pdf';
            file_put_contents($ticket_url, $output);
            $ticket->url_ticket = $ticket_url;
            $ticket->save();
            return redirect()->to(url('/').'/'.$ticket_url);
        }
    }
}
