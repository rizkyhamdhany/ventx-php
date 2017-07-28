<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketClass;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use View;
use Illuminate\Support\Facades\Redis;

class LandingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share( 'event_name', 'Smilemotion 2017' );
        View::share( 'logo', 'logo_smilemotion.png' );
        View::share( 'url_event', 'http://smilemotion.org' );
    }

    public function index(){
        return view('welcome');
    }

    public function svgTest(){
        Redis::set('name', 'Taylor');
        View::share( 'page_state', 'pick_seat' );
        $ticket_class = TicketClass::all();
        return view('app.svg_test')->with('ticket_class', $ticket_class);
    }
}
