<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class TestInsertController extends Controller
{
    function testView(){
      return view('dashboard.test');
    }

    function testInsert(Request $request){
      $input = $request->input();
      var_dump($input);
      //print_r($input);
      /*$bank = new Bank();
      $bank->insertBank($request);*/
      //Bank::insertBank($input);
      print "Success";
    }
}
