<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;

class BookTicketSession
{

    protected $session;
    protected $timeout = 10000;

    public function __construct(Store $session){
        $this->session = $session;
    }

    public function handle($request, Closure $next)
    {
        if ($request->is('tickets/smilemotion')) {
            $this->session->put('lastActivityTime', time());
        }
        if(session('lastActivityTime')) {
            if(time() - $this->session->get('lastActivityTime') > $this->timeout){
                $this->session->forget('lastActivityTime');
                $request->session()->flash('alert-danger', "<strong>You've been inactive for too long ! </strong> <br> Sorry, to avoid faulty seat selection, please complete reservation within 15 minutes, thank you for your patience.!");
                return redirect()->route('app.ticket.list');
            }
        }
        $this->session->put('lastActivityTime', time());
        return $next($request);
    }
}
