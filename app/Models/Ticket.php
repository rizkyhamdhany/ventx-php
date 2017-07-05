<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function order()
    {
        return $this
            ->belongsToMany('App\Models\Order')
            ->withTimestamps();
    }

}
