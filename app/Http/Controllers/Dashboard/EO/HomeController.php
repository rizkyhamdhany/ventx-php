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
use App\Models\PreorderConf;
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
        $payment_conf_conf = count(PreorderConf::where('status', '!=', 'VERIFIED')->get());
        $ticket_count = count(Ticket::all());

        return view('dashboard.home')
            ->with('payment_conf_conf', $payment_conf_conf)
            ->with('ticket_count', $ticket_count);

        
    }
}