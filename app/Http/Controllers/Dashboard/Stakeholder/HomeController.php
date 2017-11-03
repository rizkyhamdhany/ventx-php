<?php

namespace App\Http\Controllers\Dashboard\Stakeholder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\RedisModel;
use App\Models\Ticket;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use View;

class HomeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        View::share( 'page_state', 'home' );
    }

    public function index()
    {
      $tickets = Ticket::all();
      $tickets = DB::table('tickets')->select(DB::raw('count(id) as totalTicket, event_id'))->groupBy('event_id')->get();
      return view('dashboard.stakeholder.stakeholder')
      ->with('eventTotal',$tickets);
    }
}
