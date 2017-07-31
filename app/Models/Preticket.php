<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preticket extends Model
{
    public function order()
    {
        return $this
            ->belongsToMany('App\Models\Preorder')
            ->withTimestamps();
    }
}
