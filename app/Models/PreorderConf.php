<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreorderConf extends Model
{
    public function preorder(){
      return $this->hasMany('App\Models\Preorder');
    }

    public function bank(){
      return $this->hasMany('App\Models\Bank');
    }
}
