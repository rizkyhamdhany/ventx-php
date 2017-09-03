<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookConf extends Model
{
    public function preorder(){
      return $this->hasOne('App\Models\Book', 'id', 'book_id');
    }

    public function bank(){
      return $this->hasOne('App\Models\Bank', 'id', 'bank_id');
    }
}
