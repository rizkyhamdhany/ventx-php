<?php
/**
 * Created by PhpStorm.
 * User: hamdhanywijaya@gmail.com
 * Date: 8/1/17
 * Time: 3:45 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\Redis;


class RedisModel
{
    public static function cachingSeatData(){
        $seats = Seat::all();
        foreach ($seats as $seat){
            if ($seat->status = 'active' || $seat->status = 'booked'){
                Redis::hset("seat-".$seat->ticket_class, $seat->no, $seat->id);
                Redis::expireat("seat-".$seat->ticket_class, strtotime("+1 day"));
            }
        }
    }
}