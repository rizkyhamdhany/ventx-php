<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyOrderStatistic extends Model
{
    public function addDailyCounter($event_id){
        $bank = new Bank();

        $daily = self::where('event_id', $event_id)
            ->where('day', date("Y-m-d"))
            ->first();
        if (isset($daily)){
            $daily->count_ticket++;
        }else{
            $daily = $this;
            $daily->event_id = $event_id;
            $daily->count_ticket = 1;
            $daily->day = date("Y-m-d");
            $daily->week = $this->weekOfMonth(date("Y-m-d"));
            $daily->month = date("m");
        }
        $daily->save();
    }

    function weekOfMonth($date) {
        list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));
        $w = 1;
        for ($i = 1; $i <= $d; ++$i) {
            if ($i > 1 && date('w', strtotime("$y-$m-$i")) == 0) {
                ++$w;
            }
        }
        return $w;
    }
}
