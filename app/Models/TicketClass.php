<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketClass extends Model
{
    protected $fillable = ['event_id', 'ticket_period_id', 'name','price', 'ammount', 'desc', 'status'];
}
