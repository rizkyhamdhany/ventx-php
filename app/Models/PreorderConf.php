<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreorderConf extends Model
{
    public function preorder(){
      return $this->hasOne('App\Models\Preorder', 'id', 'preorder_id');
    }

    public function bank(){
      return $this->hasOne('App\Models\Bank', 'id', 'bank_id');
    }
}
