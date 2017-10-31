<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seat;

class Ticket extends Model
{
    public function createTicket($input){

    }
    public function order()
    {
        return $this
            ->belongsToMany('App\Models\Order')
            ->withTimestamps();
    }
    public function event(){
      return $this
          ->belongsTo('App\Models\Event')
          ->withTimestamps();
    }

}
