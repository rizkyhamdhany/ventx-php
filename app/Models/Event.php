<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'short_name', 'initial','organizer', 'logo_color', 'logo_white', 'background_pattern', 'pattern_footer', 'eticket_layout', 'invoice_layout', 'color_primary', 'color_secondary', 'color_accent', 'date', 'time', 'location', 'lat', 'lon'];

    public function ticketPeriod(){
      return $this->hasMany('App\Models\TicketPeriod');
    }

    public function ticketPeriodNow(){
        $date = date('Y-m-d');
        return $this->ticketPeriod()
            ->where('start_date','<=', $date)
            ->where('end_date','>=', $date);
    }

    public function ticketClass(){
      return $this->hasMany('App\Models\TicketClass');
    }

    public function artists()
    {
        return $this->hasMany('App\Models\EventArtist');
    }

    public function sponsors()
    {
        return $this->hasMany('App\Models\EventSponsor');
    }
}
