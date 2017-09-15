<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bookticket;
use App\Models\Bookseat;
use App\Models\Seat;
use App\Constants;
use App\CC;
use Illuminate\Support\Facades\Redis;

class Book extends Model
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
            $preticket = new Bookticket();
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

                $preseat = new Bookseat();
                $preseat->bookticket_id = $preticket->id;
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

    public function submitPreorderWithTicketsEvent($ticket, $event){
        $this->order_code = $ticket->order_code;
        $this->name = $ticket->contact_name;
        $this->phonenumber = $ticket->contact_phone;
        $this->email = $ticket->contact_email;
        $this->birthday = date('Y-m-d',strtotime($ticket->contact_birthday_year.'-'.$ticket->contact_birthday_month.'-'.$ticket->contact_birthday_day));
        $this->address = $ticket->contact_address;
        $this->country = $ticket->contact_country;
        $this->city = $ticket->contact_city;
        $this->postal_code = $ticket->contact_postal_code;
        $this->ticket_period = $ticket->ticket_period;
        $this->ticket_class = $ticket->ticket_type;
        $this->ticket_ammount = $ticket->ticket_ammount;
        $this->payment_method = $ticket->payment_method;
        $this->payment_status = 'UNPAID';
        $this->payment_code = '';
        $this->event_id = $event->id;
        $this->save();
        foreach ($ticket->ticket as $ticket_obj){
            $item = (object) $ticket_obj;
            $preticket = new Bookticket();
            $preticket->title = $item->ticket_title;
            $preticket->name = $item->ticket_name;
            $preticket->phonenumber = $item->ticket_phone;
            $preticket->email = $item->ticket_email;
            $preticket->ticket_period  = $ticket->ticket_period;
            $preticket->ticket_class = $ticket->ticket_type;
            $preticket->event_id = $event->id;
            $preticket->save();

            if (isset($item->seat)){
                $seat = Seat::find($item->seat);

                $preticket->seat_no = $seat->no;

                $preseat = new Bookseat();
                $preseat->bookticket_id = $preticket->id;
                $preseat->seat_id = $seat->id;
                $preseat->seat_no = $seat->no;
                $preseat->ticket_class = $ticket->ticket_type;
                $preseat->expire_time = 259200;
                $preseat->expire_at = \Carbon\Carbon::now()->addSeconds($preseat->expire_time);
                $preseat->status = 'BOOKED';
                $preseat->event_id = $event->id;
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
            ->belongsToMany('App\Models\Bookticket')
            ->withTimestamps();
    }

    public function preorderConf(){
      return $this->hasOne('App\PreorderConf');
    }
}
