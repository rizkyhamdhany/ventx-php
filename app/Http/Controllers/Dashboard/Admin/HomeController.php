<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Milon\Barcode\DNS2D;
use App\Models\RedisModel;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      return view('dashboard/admin');
    }

    public function event(){
      return view('dashboard/event');
    }
}
