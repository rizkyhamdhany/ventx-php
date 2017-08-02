<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  public function bank(){
    return $this->hasOne('App\Models\Bank','id','bank');
  }

    public function insertTransact($input){
      $this->bank = $input->input('bank_name');
      $this->account_holder = $input->input('inputAccount_holder');
      $this->account_number = $input->input('inputAccount_number');
      $this->total = $input->input('inputTotal');
      $this->save();
    }
}
