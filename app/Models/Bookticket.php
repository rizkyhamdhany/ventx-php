<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookticket extends Model
{
    public function order()
    {
        return $this
            ->belongsToMany('App\Models\Book')
            ->withTimestamps();
    }
}
