<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketClass;
use App\Models\Seat;
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
        View::share( 'color_prime', '#236E89' );
    }

    public function index(){
        return view('welcome');
    }
    public function event(){
        return view('app.app_landing');
    }
    public function contact(){
        View::share( 'page_state', 'Contact Us' );
        return view('contact');
    }
    public function tnc(){
        View::share( 'page_state', 'Terms and Conditions' );
        return view('tnc');
    }
}
