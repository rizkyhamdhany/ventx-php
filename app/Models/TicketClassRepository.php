<?php

namespace App\Models;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;

class TicketClassRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;

    protected $cacheMinutes = 1440;

    protected $cacheOnly = ['findWhere'];

    public function model()
    {
        return "App\\Models\\TicketClass";
    }

    public function ticketClassByEvent($event_id){
        return $this->findWhere([
            'event_id' => $event_id
        ]);
    }

    public function ticketPeriodNow($period_id){
        return $this->findWhere([
            'ticket_period_id' => $period_id
        ]);
    }

}
