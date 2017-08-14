<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Preticket;
use App\Models\Preseat;
use App\Models\Seat;
use App\Constants;
use App\CC;
use Illuminate\Support\Facades\Redis;

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
        foreach ($ticket->ticket as $ticket_obj){
            $item = (object) $ticket_obj;
            $preticket = new Preticket();
            $preticket->title = $item->ticket_title;
            $preticket->name = $item->ticket_name;
            $preticket->phonenumber = $item->ticket_phone;
            $preticket->email = $item->ticket_email;
            $preticket->ticket_period  = $ticket->ticket_period;
            $preticket->ticket_class = $ticket->ticket_type;
            $preticket->save();

            if (isset($item->seat)){
                $seat = Seat::find($item->seat);

                $preticket->seat_no = $seat->no;

                $preseat = new Preseat();
                $preseat->preticket_id = $preticket->id;
                $preseat->seat_id = $seat->id;
                $preseat->seat_no = $seat->no;
                $preseat->ticket_class = $ticket->ticket_type;
                $preseat->expire_time = 259200;
                $preseat->expire_at = \Carbon\Carbon::now()->addSeconds($preseat->expire_time);
                $preseat->status = 'BOOKED';
                $preseat->save();

                Redis::set(CC::$EVENT_NAME.":".CC::$KEY_SEAT_BOOKED.":".$preseat->ticket_class.":".$preseat->seat_no, $preseat->seat_id);
                Redis::expireat(CC::$EVENT_NAME.":".CC::$KEY_SEAT_BOOKED.":".$preseat->ticket_class.":".$preseat->seat_no, strtotime($preseat->expire_at));
            }
            $preticket->save();
            $preticket->order()->attach($this);
        }
        return $ticket;
    }
    public function tickets()
    {
        return $this
            ->belongsToMany('App\Models\Preticket')
            ->withTimestamps();
    }

    public function preorderConf(){
      return $this->hasOne('App\PreorderConf');
    }
}
