<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function transaction(){
      return $this->hasMany('App\Transaction','bank','id');
    }

    public function preorderConf(){
      return $this->hasMany('App\PreorderConf');
    }

    public function insertBank($input){
      $this->name = $input->input('bankName');
      $this->account_name = $input->input('bankAccountName');
      $this->account_number = $input->input('bankAccountNumber');
      $this->save();
    }
}
