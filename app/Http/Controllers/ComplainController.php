<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use App\Models\Seat;
use App\Models\TicketClass;
use Milon\Barcode\DNS2D;

class ComplainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        return view('dashboard.home');
    }

    public function listComplain(Request $request){
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        $orders = Order::all();
        return view('dashboard.cs.complains')->with('orders', $orders);
    }
}