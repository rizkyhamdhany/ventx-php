<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEventRequest;
use App\Models\EventRepository;
use App\Models\TicketPeriod;
use App\Models\TicketClass;
use App\Models\EventArtist;
use App\Models\EventSponsor;
use App\Models\TicketPeriodRepository;
use App\Models\TicketClassRepository;
use App\Models\EventArtistRepository;
use App\Models\EventSponsorRepository;
use Validator;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\RedisModel;
use Illuminate\Support\Facades\Redis;
use View;
use LasseRafn\Initials\Initials;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    protected $eventRepo;
    protected $ticketPeriodRepo;
    protected $ticketClassRepo;
    protected $eventArtistRepo;
    protected $eventSponsorRepo;

    public function __construct(
        EventRepository $eventRepo,
        TicketPeriodRepository $ticketPeriodRepo,
    TicketClassRepository $ticketClassRepo,
        EventArtistRepository $eventArtistRepo,
        EventSponsorRepository $eventSponsorRepo
    ) {
        $this->eventRepo = $eventRepo;
        $this->ticketPeriodRepo = $ticketPeriodRepo;
        $this->ticketClassRepo = $ticketClassRepo;
        $this->eventArtistRepo = $eventArtistRepo;
        $this->eventSponsorRepo = $eventSponsorRepo;
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
        $input = $request->all();
        $input['date'] = date('Y-m-d', strtotime($request->input('date')));
        $input['initial'] = (new Initials)->name($input['name'])->generate();

        if ($request->hasFile('logo_color')){
          $color = $request->file('logo_color')->store('logos','public');
        }
        $input['logo_color'] = $color;
        if ($request->hasFile('logo_white')){
          $white = $request->file('logo_white')->store('logos','public');
        }
        $input['logo_white'] = $white;
        if ($request->hasFile('background_pattern')){
          $back = $request->file('background_pattern')->store('logos','public');
        }
        $input['background_pattern'] = $back;
        if ($request->hasFile('pattern_footer')){
          $foot = $request->file('pattern_footer')->store('logos','public');
        }
        $input['pattern_footer'] = $foot;
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

    public function ticketCategory($id)
    {
        $periodByEvent = TicketPeriod::where('event_id', $id)->get();
        View::share('page_state', 'Ticket Category');
        return view('dashboard.admin.event.event_ticketCategory')
          ->with('periods', $periodByEvent->all())
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
                        ->with('period_id', $dataPeriod->id)
                        ->with('period', null);
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

    public function ticketPeriodEdit($id, $period, Request $request)
    {
        $periodRepo = $this->ticketPeriodRepo->find($period);
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
                return redirect()->route('dashboard.event.ticketPeriod.edit', $id, $period)
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $input = $request->input();
                $input['name'] = $request->name;
                $input['start_date'] = date('Y-m-d', strtotime($request->startDate));
                $input['end_date'] = date('Y-m-d', strtotime($request->endDate));
                $dataPeriod = $this->ticketPeriodRepo->update($input, $period);
                if ($dataPeriod) {
                    $request->session()->flash('alert-success', 'Ticket Period has been created !');
                    $periodByEvent = TicketPeriod::where('event_id', $id)->get();
                    View::share('page_state', 'Ticket Category');
                    return view('dashboard.admin.event.event_ticketCategory')
                        ->with('periods', $periodByEvent->all())
                        ->with('id', $id);
                } else {
                    $request->session()->flash('alert-warning', 'Failed to create Ticket Period !');
                }
            }
        } else {
            return view('dashboard.admin.event.event_ticketPeriod_edit')
                ->with('name', $request->input('name'))
                ->with('start_date', date('Y-m-d', strtotime($request->input('startDate'))))
                ->with('end_date', date('Y-m-d', strtotime($request->input('endDate'))))
                ->with('id', $id)
                ->with('period', $periodRepo);
        }
    }

    public function ticketPeriodDelete($id, $period)
    {
        if ($this->ticketPeriodRepo->delete($period)) {
            session(['alert-success' => 'Ticket Period Deleted']);
            $periodByEvent = TicketPeriod::where('event_id', $id)->get();
            View::share('page_state', 'Ticket Category');
            return view('dashboard.admin.event.event_ticketCategory')
              ->with('periods', $periodByEvent->all())
              ->with('id', $id);
        } else {
            session(['alert-warning' => 'Failed to Delete Ticket Period']);
        }
    }

    public function ticketClassAdd($id, $period=null, Request $request)
    {
        if ($period!=null) {
            $periodRepo = $this->ticketPeriodRepo->find($period);
        }
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
                $input = $request->input();
                $input['event_id'] = $request->event_id;
                $input['ticket_period_id'] = $request->ticket_period_id;
                $input['name'] = $request->name;
                $input['price'] = $request->price;
                $input['ammount'] = $request->amount;
                if ($this->ticketClassRepo->create($input)) {
                    $request->session()->flash('alert-success', 'Ticket Class has been created !');
                } else {
                    $request->session()->flash('alert-warning', 'Failed to create Ticket Class !');
                }
            }
        } else {
            if ($period!=null) {
                return view('dashboard.admin.event.event_ticketClass_add')
                  ->with('id', $id)
                  ->with('name', $request->input('name'))
                  ->with('period', $period);
            } else {
                return view('dashboard.admin.event.event_ticketClass_add')
                  ->with('id', $id)
                  ->with('name', $request->input('name'));
            }
        }
    }

    public function ticketClassEdit($id, $class, Request $request)
    {
        $classRepo = $this->ticketClassRepo->find($class);
        View::share('page_state', 'Ticket Class');
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'price' => 'required',
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('dashboard.event.ticketClass.edit', $id, $class)
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $input = $request->input();
                $input['name'] = $request->name;
                $input['price'] = $request->price;
                $input['ammount'] = $request->amount;
                if ($this->ticketClassRepo->update($input, $class)) {
                    $request->session()->flash('alert-success', 'Ticket Class has been Edited !');
                    $periodByEvent = TicketPeriod::where('event_id', $id)->get();
                    View::share('page_state', 'Ticket Category');
                    return view('dashboard.admin.event.event_ticketCategory')
                        ->with('periods', $periodByEvent->all())
                        ->with('id', $id);
                } else {
                    $request->session()->flash('alert-warning', 'Failed to create Ticket Class !');
                }
            }
        } else {
            return view('dashboard.admin.event.event_ticketClass_edit')
                ->with('id', $id)
                ->with('class', $classRepo)
                ->with('name', $request->input('name'));
        }
    }

    public function ticketClassDelete($id, $class)
    {
        if ($this->ticketClassRepo->delete($class)) {
            session(['alert-success' => 'Ticket Class Deleted']);
            $periodByEvent = TicketPeriod::where('event_id', $id)->get();
            View::share('page_state', 'Ticket Category');
            return view('dashboard.admin.event.event_ticketCategory')
              ->with('periods', $periodByEvent->all())
              ->with('id', $id);
        } else {
            session(['alert-warning' => 'Failed to Delete Ticket Class']);
        }
    }

    ///////////////////////////////////////////////////////////////Artis///////
    public function eventArtist($id)
    {
        $artistRepo = EventArtist::where('event_id',$id)->get();
        View::share('page_state', 'Event Artist');
        return view('dashboard.admin.event.event_eventArtist_list')
          ->with('artists', $artistRepo->all())
          ->with('id', $id);
    }

    public function eventArtistAdd($id, Request $request)
    {
        View::share('page_state', 'Event Artist');
        View::share('page_title', $this->eventRepo->find($id)->name);
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'url_img' => 'image|mimes:jpeg,bmp,png|size:2000',
            ]);

            if ($validator->fails()) {
                return redirect()->route('dashboard.event.eventArtist.add', $id)
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $input = $request->all();
                $input['event_id'] = $id;
                $input['name'] = $request->name;
                $filename="";
                if ($request->hasFile('photo')){
                  $file = $request->file('photo')->store('artists','public');
                }
                $input['url_img'] = $file;
                if ($this->eventArtistRepo->create($input)) {
                    $request->session()->flash('alert-success', 'Artist has been added !');
                    return redirect()->route('dashboard.event.eventArtist',$id);
                } else {
                    $request->session()->flash('alert-warning', 'Failed to add Artist !');
                }
            }
        } else {
            return view('dashboard.admin.event.event_eventArtist_add')
                  ->with('id', $id);
        }
    }

    public function eventArtistEdit($id, $artist, Request $request)
    {
        $artistRepo = $this->eventArtistRepo->find($artist);
        View::share('page_state', 'Event Artist');
        View::share('page_title', $this->eventRepo->find($id)->name);
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
              'name' => 'required|max:50',
              'url_img' => 'image|mimes:jpeg,bmp,png|size:2000',
            ]);

            if ($validator->fails()) {
                return redirect()->route('dashboard.event.eventArtist.edit', $id, $class)
                    ->withErrors($validator)
                    ->withInput();
            } else {
              $input = $request->all();
              $input['event_id'] = $id;
              $input['name'] = $request->name;
              $filename="";
              if ($request->hasFile('photo')){
                $file = $request->file('photo')->store('artists','public');
              }
              $input['url_img'] = $file;
                if ($this->eventArtistRepo->update($input, $artist)) {
                    $request->session()->flash('alert-success', 'Artist has been Edited !');
                    return redirect()->route('dashboard.event.eventArtist',$id);
                } else {
                    $request->session()->flash('alert-warning', 'Failed to add Artist !');
                }
            }
        } else {
            return view('dashboard.admin.event.event_eventArtist_edit')
                ->with('id', $id)
                ->with('artist',$artist)
                ->with('artistRepo', $artistRepo);
        }
    }

    public function eventArtistDelete($id, $artist)
    {
        if ($this->eventArtistRepo->delete($artist)) {
            session(['alert-success' => 'Artist Deleted']);
            return redirect()->route('dashboard.event.eventArtist',$id);
        } else {
            session(['alert-warning' => 'Failed to Delete Artist']);
        }
    }
    //////////////////////////////////////////////////////////Sponsor//////////
    public function eventSponsor($id)
    {
        $sponsorRepo = EventSponsor::where('event_id',$id)->get();
        View::share('page_state', 'Event Sponsor');
        return view('dashboard.admin.event.event_eventSponsor_list')
          ->with('sponsors', $sponsorRepo->all())
          ->with('id', $id);
    }

    public function eventSponsorAdd($id, Request $request)
    {
        View::share('page_state', 'Event Sponsor');
        View::share('page_title', $this->eventRepo->find($id)->name);
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'url_img' => 'image|mimes:jpeg,bmp,png|size:2000',
            ]);

            if ($validator->fails()) {
                return redirect()->route('dashboard.event.eventSponsor.add', $id)
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $input = $request->all();
                $input['event_id'] = $id;
                $input['name'] = $request->name;
                $filename="";
                if ($request->hasFile('photo')){
                  $file = $request->file('photo')->store('sponsors','public');
                }
                $input['url_img'] = $file;
                if ($this->eventSponsorRepo->create($input)) {
                    $request->session()->flash('alert-success', 'Sponsor has been added !');
                    return redirect()->route('dashboard.event.eventSponsor',$id);
                } else {
                    $request->session()->flash('alert-warning', 'Failed to add Sponsor !');
                }
            }
        } else {
            return view('dashboard.admin.event.event_eventSponsor_add')
                  ->with('id', $id);
        }
    }

    public function eventSponsorEdit($id, $sponsor, Request $request)
    {
        $sponsorRepo = $this->eventSponsorRepo->find($sponsor);
        View::share('page_state', 'Event Sponsor');
        View::share('page_title', $this->eventRepo->find($id)->name);
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
              'name' => 'required|max:50',
              'url_img' => 'image|mimes:jpeg,bmp,png|size:2000',
            ]);

            if ($validator->fails()) {
                return redirect()->route('dashboard.event.eventSponsor.edit', $id, $sponsor)
                    ->withErrors($validator)
                    ->withInput();
            } else {
              $input = $request->all();
              $input['event_id'] = $id;
              $input['name'] = $request->name;
              $filename="";
              if ($request->hasFile('photo')){
                $file = $request->file('photo')->store('sponsors','public');
              }
              $input['url_img'] = $file;
                if ($this->eventSponsorRepo->update($input, $sponsor)) {
                    $request->session()->flash('alert-success', 'Sponsor has been Edited !');
                    return redirect()->route('dashboard.event.eventSponsor',$id);
                } else {
                    $request->session()->flash('alert-warning', 'Failed to add Sponsor !');
                }
            }
        } else {
            return view('dashboard.admin.event.event_eventSponsor_edit')
                ->with('id', $id)
                ->with('sponsor',$sponsor)
                ->with('sponsorRepo', $sponsorRepo);
        }
    }

    public function eventSponsorDelete($id, $sponsor)
    {
        if ($this->eventSponsorRepo->delete($sponsor)) {
            session(['alert-success' => 'Sponsor Deleted']);
            return redirect()->route('dashboard.event.eventSponsor',$id);
        } else {
            session(['alert-warning' => 'Failed to Delete Sponsor']);
        }
    }
}
