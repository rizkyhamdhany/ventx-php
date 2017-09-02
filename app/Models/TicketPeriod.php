<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketPeriod extends Model
{
    protected $fillable = ['event_id', 'name','start_date', 'end_date'];
}
