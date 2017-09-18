<?php

namespace App\Http\Controllers\App;

use App\Models\EventRepository;
use App\Models\TicketClassRepository;
use App\Models\TicketPeriodRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    }

    public function index($event){
        $event = $this->eventRepo->findWhere([
            'short_name'=> $event,
        ])->first();
        $ticket_period = $this->ticketPeriodRepo->ticketPeriodNow($event->id);
        return view('app.event.index')
                ->with('event', $event)
                ->with('ticket_period', $ticket_period);
    }
}
