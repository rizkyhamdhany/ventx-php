<?php

namespace App\Http\Controllers\Dashboard\EO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;
use App\Models\Seat;
use App\Models\TicketClass;
use Milon\Barcode\DNS2D;
use App\Models\BookConf;
use App\Models\RedisModel;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $event_id = Auth::user()->event_id;
        $ticket_count = count(Ticket::where('event_id', $event_id)->get());

        return view('dashboard.home')
            ->with('ticket_count', $ticket_count);
    }
}
