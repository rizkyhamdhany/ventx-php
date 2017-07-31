<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preorder extends Model
{
    public function tickets()
    {
        return $this
            ->belongsToMany('App\Models\Preticket')
            ->withTimestamps();
    }
}
