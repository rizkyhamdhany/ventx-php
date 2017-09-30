<?php

namespace App\Http\Controllers\Dashboard\EO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use App\Models\Seat;
use App\Models\TicketClass;
use Milon\Barcode\DNS2D;
use App\Models\DailyOrderStatistic;
use Illuminate\Support\Facades\Auth;

class TicketDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listTicket(Request $request)
    {
        $event_id = Auth::user()->event_id;
        $orders = Order::where('event_id', $event_id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.tickets')->with('orders', $orders);
    }

    public function downloadTicket(Request $request, $id){
        $ticket = Ticket::find($id);
        if ($ticket->url_ticket != ""){
            //$s3 = \Storage::disk('s3');
            $local = \Storage::disk('local');
            //Storage::disk('local')->put($invoice_url, $output, 'public');
            return redirect()->to($local->url($ticket->url_ticket));
        } else {
            $pdf = \PDF::loadView('dashboard.tickets.download_ticket', compact('ticket'))->setPaper('A5', 'portrait');
            $output = $pdf->output();

            $ticket_url = 'ventex/ticket/ticket_'.$ticket->ticket_code.'.pdf';
        //    $s3 = \Storage::disk('s3');
              $local = \Storage::disk('local');
        //    $s3->put($ticket_url, $output, 'public');
            $local->put($ticket_url, $output, 'public');
            $ticket->url_ticket = $ticket_url;
            $ticket->save();
            return redirect()->to($local->url($ticket->url_ticket));
        }
    }
}
