<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function tickets()
    {
        return $this
            ->belongsToMany('App\Models\Ticket')
            ->withTimestamps();
    }
}
