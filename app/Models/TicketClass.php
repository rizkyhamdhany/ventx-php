<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketClass extends Model
{
    protected $fillable = ['event_id', 'ticket_period_id', 'name','price', 'ammount', 'desc', 'status'];

    public function event(){
      return $this
        ->belongsTo('App\Models\Event')
        ->withTimestamp();
    }

    public function ticketPeriod(){
      return $this
        ->belongsTo('App\Models\TicketPeriod')
        ->withTimestamps();
    }
}
