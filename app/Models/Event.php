<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'initial','organizer', 'logo_color', 'logo_white', 'background_pattern', 'color_primary', 'color_secondary', 'color_accent', 'date', 'time', 'location', 'lat', 'lon'];

    public function artists()
    {
        return $this->hasMany('App\Models\EventArtist');
    }

    public function sponsors()
    {
        return $this->hasMany('App\Models\EventSponsor');
    }
}
