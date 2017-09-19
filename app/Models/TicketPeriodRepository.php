<?php

namespace App\Models;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;

class TicketPeriodRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;

    protected $cacheMinutes = 1440;

    protected $cacheOnly = ['findWhere'];

    public function model()
    {
        return "App\\Models\\TicketPeriod";
    }

    public function ticketPeriodNow($event_id){
        $date = date('Y-m-d');
        return $this->findWhere([
            'event_id' => $event_id,
            ['start_date','<=', $date],
            ['end_date','>=', $date]
        ])->first();
    }

    public function ticketPeriodByEvent($event_id){
        return $this->findWhere([
            'event_id' => $event_id,
        ]);
    }

}
