<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketClass;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use View;
use App\Models\Seat;
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
        if (!Redis::exists("seat-VVIP")){
            $this->cachingSeatData();
        }
        View::share( 'page_state', 'pick_seat' );
        $ticket_class = TicketClass::all();
        $seat = array();
        $seat['VVIP'] = Redis::hgetall('seat-VVIP');
        $seat['VIP E'] = Redis::hgetall('seat-VIP E');
        $seat['VIP D'] = Redis::hgetall('seat-VIP D');
        $seat['VIP I'] = Redis::hgetall('seat-VIP I');
        $seat['VIP H'] = Redis::hgetall('seat-VIP H');

        return view('app.svg_test')->with('ticket_class', $ticket_class)
            ->with('seat', $seat);
    }

    public function cachingSeatData(){
        $seats = Seat::all();
        foreach ($seats as $seat){
            if ($seat->status = 'active' || $seat->status = 'booked'){
                Redis::hset("seat-".$seat->ticket_class, $seat->no, $seat->id);
            }
        }
    }
}
