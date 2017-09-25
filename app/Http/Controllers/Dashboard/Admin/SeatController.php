<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventRepository;
use App\Models\SeatRepository;
use View;

class SeatController extends Controller
{

    protected $repository;
    protected $eventRepo;

    public function __construct(EventRepository $eventRepository, SeatRepository $repository)
    {
        $this->repository = $repository;
        $this->eventRepo = $eventRepository;
        $this->middleware('auth');
        View::share('page_state', 'Event');
    }

    public function index($id){
        View::share('page_state', 'Seat');
        return view('dashboard.admin.event.seat.index')
            ->with('id', $id);
    }
}