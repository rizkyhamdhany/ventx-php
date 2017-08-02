<?php
/**
 * Created by PhpStorm.
 * User: hamdhanywijaya@gmail.com
 * Date: 8/1/17
 * Time: 3:45 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\Redis;
use App\CC;
use App\Models\Preseat;

class RedisModel
{
    public static function cachingSeatData(){
        $seats = Seat::where('status', 'active')->get();
        foreach ($seats as $seat){
            Redis::hset(CC::$EVENT_NAME.":".CC::$KEY_SEAT.":".$seat->ticket_class, $seat->no, $seat->id);
            Redis::expireat(CC::$EVENT_NAME.":".CC::$KEY_SEAT.":".$seat->ticket_class, strtotime("+1 day"));
        }
    }

//                Redis::set("smilemotion:seat:".$seat->ticket_class.":".$seat->no, $seat->id);

    public static function cachingBookedSeat(){
        $preseats = Preseat::whereDate('expire_at', '>', \Carbon\Carbon::now())->get();
        foreach ($preseats as $preseat){
            Redis::set(CC::$EVENT_NAME.":".CC::$KEY_SEAT_BOOKED.":".$preseat->ticket_class.":".$preseat->seat_no, $preseat->seat_id);
            Redis::expireat(CC::$EVENT_NAME.":".CC::$KEY_SEAT_BOOKED.":".$preseat->ticket_class.":".$preseat->seat_no, strtotime($preseat->expire_at));
        }
    }
}