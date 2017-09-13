<?php

namespace App;


class CC
{
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