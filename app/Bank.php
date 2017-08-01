<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function transacts(){
      return $this->hasMany('App\Transaction');
    }
}
