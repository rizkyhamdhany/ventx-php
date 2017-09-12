<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketPeriod extends Model
{
    protected $fillable = ['event_id', 'name','start_date', 'end_date'];

    public function event(){
      return $this
        ->belongsTo('App\Models\Event');
    }

    public function ticketClass(){
      return $this
        ->hasMany('App\Models\TicketClass', 'ticket_period_id', 'id');
    }
}
