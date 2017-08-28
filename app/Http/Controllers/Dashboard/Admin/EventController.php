<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEventRequest;
use App\Models\EventRepository;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\RedisModel;
use Illuminate\Support\Facades\Redis;
use View;
use LasseRafn\Initials\Initials;

class EventController extends Controller
{

    protected $eventRepo;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->middleware('auth');
        View::share( 'page_state', 'Event' );
    }

    public function index()
    {
        return view('dashboard.admin.event.event_list')
            ->with('events', $this->eventRepo->all());
    }

    public function addEvent(){
        return view('dashboard.admin.event.event_add');
    }

    public function addEventPost(CreateEventRequest $request){
        $input = $request->input();
        $input['date'] = date('Y-m-d', strtotime($request->input('date')));
        $input['initial'] = (new Initials)->name($input['name'])->generate();
        if ($this->eventRepo->create($input)){
            $request->session()->flash('alert-success', 'Event has been created !');

        } else {
            $request->session()->flash('alert-warning', 'Failed to create Event !');
        }
        return redirect()->route('dashboard.event');
    }

    public function detailEvent($id){
        $event = $this->eventRepo->find($id);
        View::share( 'page_state', 'Event Details' );
        return view('dashboard.admin.event.event_details')
                ->with('event', $event);
    }
}
