<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEventRequest;
use App\Models\EventRepository;
use App\Models\TicketPeriodRepository;
use App\Models\TicketClassRepository;
use Validator;
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
    protected $ticketPeriodRepo;
    protected $ticketClassRepo;

    public function __construct(EventRepository $eventRepo, TicketPeriodRepository $ticketPeriodRepo, TicketClassRepository $ticketClassRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->ticketPeriodRepo = $ticketPeriodRepo;
        $this->ticketClassRepo = $ticketClassRepo;
        $this->middleware('auth');
        View::share('page_state', 'Event');
    }

    public function index()
    {
        return view('dashboard.admin.event.event_list')
            ->with('events', $this->eventRepo->all());
    }

    public function addEvent()
    {
        return view('dashboard.admin.event.event_add');
    }

    public function addEventPost(CreateEventRequest $request)
    {
        $input = $request->input();
        $input['date'] = date('Y-m-d', strtotime($request->input('date')));
        $input['initial'] = (new Initials)->name($input['name'])->generate();
        if ($this->eventRepo->create($input)) {
            $request->session()->flash('alert-success', 'Event has been created !');
        } else {
            $request->session()->flash('alert-warning', 'Failed to create Event !');
        }
        return redirect()->route('dashboard.event');
    }

    public function detailEvent($id)
    {
        $event = $this->eventRepo->find($id);
        View::share('page_state', 'Event Details');
        return view('dashboard.admin.event.event_details')
            ->with('event', $event)
            ->with('id', $id);
    }

    public function ticketPeriodAdd($id, Request $request)
    {
        $event = $this->eventRepo->find($id);
        View::share('page_state', 'Ticket Period');
        View::share('page_title', $event->name);
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'startDate' => 'required',
                'endDate' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('dashboard.event.ticketPeriod.add', $id)
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $input = $request->input();
                $input['event_id'] = $event->id;
                $input['name'] = $request->name;
                $input['start_date'] = date('Y-m-d', strtotime($request->startDate));
                $input['end_date'] = date('Y-m-d', strtotime($request->endDate));
                $dataPeriod = $this->ticketPeriodRepo->create($input);

                if ($dataPeriod) {
                    $request->session()->flash('alert-success', 'Ticket Period has been created !');
                    return view('dashboard.admin.event.event_ticketClass_add')
                        ->with('id', $id)
                        ->with('name', $request->input('name'))
                        ->with('period_id', $dataPeriod->id);
                } else {
                    $request->session()->flash('alert-warning', 'Failed to create Ticket Perio !');
                }
            }
        } else {
            return view('dashboard.admin.event.event_ticketPeriod_add')
                ->with('name', $request->input('name'))
                ->with('start_date', date('Y-m-d', strtotime($request->input('startDate'))))
                ->with('end_date', date('Y-m-d', strtotime($request->input('endDate'))))
                ->with('id', $id);
        }
    }

    public function ticketClassAdd($id, Request $request)
    {
        $event = $this->eventRepo->find($id);
        View::share('page_state', 'Ticket Class');
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'price' => 'required',
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('dashboard.event.ticketClass.add', $id)
                    ->withErrors($validator)
                    ->withInput();
            } else {
                /*$input = $request->input();
                $input['event_id'] = $request->event_id;
                $input['ticket_period_id'] = $request->ticket_period_id;
                $input['name'] = $request->name;
                $input['price'] = $request->price;
                $input['ammount'] = $request->amount;*/
                $input = $request->input();
                $input['event_id'] = $event->id;
                $input['ticket_period_id'] = $request->ticket_period_id;
                $input['name'] = $request->name;
                $input['price'] = $request->price;
                $input['ammount'] = $request->amount;
                $class = $this->$ticketClassRepo->create($input);
                if ($class) {
                    $request->session()->flash('alert-success', 'Event has been created !');
                } else {
                    $request->session()->flash('alert-warning', 'Failed to create Event !');
                }
                //return $request->name;
                //return response()->json($request->name);
            }
        } else {
            return view('dashboard.admin.event.event_ticketClass_add.post')
                ->with('event_id', $id)
                ->with('name', $request->input('name'));
        }
    }

    public function ticketPeriodSave($request)
    {
        $input = $request->input();
        $input['event_id'] = $request->event_id;
        $input['name'] = $request->name;
        $input['start_date'] = date('Y-m-d', strtotime($request->startDate));
        $input['end_date'] = date('Y-m-d', strtotime($request->endDate));

        return $input;
    }

    public function ticketClassSave($request)
    {
        $input = $request->input();
        $input['event_id'] = $request->event_id;
        $input['ticket_period'] = $request->event_id;
        $input['name'] = $request->name;
        $input['start_date'] = date('Y-m-d', strtotime($request->startDate));
        $input['end_date'] = date('Y-m-d', strtotime($request->endDate));

        return $input;
    }
}
