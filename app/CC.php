<?php
/**
 * Created by PhpStorm.
 * User: hamdhanywijaya@gmail.com
 * Date: 8/3/17
 * Time: 2:49 AM
 */

namespace App;


class CC
{
    public static $EVENT_NAME = 'smilemotion';
    public static $KEY_SEAT = 'seat';
    public static $KEY_SEAT_BOOKED = 'seat_booked';
    public static $KEY_SEAT_BOOKED_SHORT = 'seat_booked_short';
    public static $REDIS_FLUSHALL = 'flushall';
    public static $EXPIRE_SEAT = 259200;

    const EVENT_NAME = 'smilemotion';
    const KEY_SEAT = 'seat';
    const KEY_SEAT_BOOKED = 'seat_booked';
    const KEY_SEAT_BOOKED_SHORT = 'seat_booked_short';
    const REDIS_FLUSHALL = 'flushall';
    const EXPIRE_SEAT = 259200;
    const DOKU_STORE_ID_DEV = '10997643';
    const DOKU_SHARED_KEY_DEV = 'E9E7o8D6R7d3';
    const DOKU_STORE_ID_PROD = '10589598';
    const DOKU_SHARED_KEY_PROD = 'J7h9X7i7F4D8';
    const ENV_LOCAL = 'local';
}