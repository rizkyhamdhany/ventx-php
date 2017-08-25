<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\RedisModel;
use Illuminate\Support\Facades\Redis;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function addEvent(){
      return view('dashboard/event_add');
    }

    public function detailEvent(Request $request){
      return view('dashboard/event_submit')
      ->with('event_name',$request->input('event_name'))
      ->with('color_scheme',$request->input('color_scheme'))
      ->with('event_logo',$request->input('event_logo'))
      ->with('event_background',$request->input('event_background'))
      ->with('event_date',$request->input('event_date'))
      ->with('event_location',$request->input('event_location'));
    }

    public function submitEvent(Request $request){
      //return view('dashboard/event_add');
    }
}
