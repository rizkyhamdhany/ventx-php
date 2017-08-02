<?php
/**
 * Created by PhpStorm.
 * User: hamdhanywijaya@gmail.com
 * Date: 8/1/17
 * Time: 3:45 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\Redis;
use App\Models\TicketClass;


class RedisModel
{
    public static function cachingSeatData(){
        $ticketclasses = TicketClass::all();
        $areas = array();
        foreach ($ticketclasses as $ticketclass){
            $area = new \stdClass();
            $area->name = $ticketclass->name;
            $area->seats = Seat::select('id','no', 'status')->where('ticket_class', $ticketclass->name)->get();
            array_push($areas, $area);
        }
        Redis::set('area', json_encode($areas));
        echo '<pre>'; print_r(json_encode($areas)); exit;
        foreach ($seats as $seat){
            if ($seat->status == 'active'){
                Redis::hset("seat-".$seat->ticket_class, $seat->no, $seat->id);
                Redis::expireat("seat-".$seat->ticket_class, strtotime("+1 day"));
            }
        }
    }

    public static function cachingBookSeat($seat_no){

    }
}