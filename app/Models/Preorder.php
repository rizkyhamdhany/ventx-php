<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Preticket;

class Preorder extends Model
{
    public function submitPreorderWithTickets($ticket){
        $this->order_code = $ticket->order_code;
        $this->name = $ticket->contact_name;
        $this->phonenumber = $ticket->contact_phone;
        $this->email = $ticket->contact_email;
        $this->ticket_period = $ticket->ticket_period;
        $this->ticket_class = $ticket->ticket_type;
        $this->ticket_ammount = $ticket->ticket_ammount;
        $this->payment_status = 'UNPAID';
        $this->payment_code = '';
        $this->save();
        foreach ($ticket->ticket as $item){
            $preticket = new Preticket();
            $preticket->title = $item->ticket_title;
            $preticket->name = $item->ticket_name;
            $preticket->phonenumber = $item->ticket_phone;
            $preticket->email = $item->ticket_email;
            $preticket->ticket_period  = $ticket->ticket_period;
            $preticket->ticket_class = $ticket->ticket_type;;
            $preticket->seat_no = $item->seat;
            $preticket->save();
            $preticket->order()->attach($this);
        }
    }
    public function tickets()
    {
        return $this
            ->belongsToMany('App\Models\Preticket')
            ->withTimestamps();
    }
}
