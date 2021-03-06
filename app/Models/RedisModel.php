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
use App\Models\Bookseat;

class RedisModel
{
    public static function cachingSeatData(){
        $seats = Seat::where('status', 'active')->get();
        foreach ($seats as $seat){
            Redis::hset(CC::$EVENT_NAME.":".CC::$KEY_SEAT.":".$seat->ticket_class, $seat->no, $seat->id);
            Redis::expireat(CC::$EVENT_NAME.":".CC::$KEY_SEAT.":".$seat->ticket_class, strtotime("+1 day"));
        }
    }

    public static function removeCachingSeat($seat){
        Redis::hDel(CC::$EVENT_NAME.":".CC::$KEY_SEAT.":".$seat->ticket_class, $seat->no);
    }

    public static function cachingBookedSeat(){
        $preseats = Bookseat::whereDate('expire_at', '>', \Carbon\Carbon::now())->get();
        foreach ($preseats as $preseat){
            Redis::set(CC::$EVENT_NAME.":".CC::$KEY_SEAT_BOOKED.":".$preseat->ticket_class.":".$preseat->seat_no, $preseat->seat_id);
            Redis::expireat(CC::$EVENT_NAME.":".CC::$KEY_SEAT_BOOKED.":".$preseat->ticket_class.":".$preseat->seat_no, strtotime($preseat->expire_at));
        }
    }

    public static function cachingBookedSeatShort($seat_id){
        Redis::set(CC::$EVENT_NAME.":".CC::$KEY_SEAT_BOOKED_SHORT.":".$seat_id, $seat_id);
        Redis::expire(CC::$EVENT_NAME.":".CC::$KEY_SEAT_BOOKED_SHORT.":".$seat_id, 1800);
    }

}