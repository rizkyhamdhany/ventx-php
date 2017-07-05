<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use App\Models\Seat;
use App\Models\TicketClass;
use Milon\Barcode\DNS2D;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        return view('dashboard.home');
    }

    public function listTicket(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
//        $uuid = Uuid::generate();
//        $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
//        echo DNS2D::getBarcodeHTML('SMT'.$code, "QRCODE");
        $orders = Order::all();
        return view('dashboard.tickets')->with('orders', $orders);
    }

    public function chooseTicket(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        return view('dashboard.choose_ticket');
    }

    public function orderTicket(Request $request)
    {
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        $input = $request->input();
        $seat_available = Seat::where('ticket_class', $request->input('ticket_class'))->where('status', 'active')->get();
        return view('dashboard.order_ticket')
            ->with('ticket_period', $request->input('ticket_period'))
            ->with('ticket_class', $request->input('ticket_class'))
            ->with('ammount', $request->input('amount'))
            ->with('seat_available', $seat_available);
    }

    public function orderTicketSubmit(Request $request){
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        //create order
        $ammount = $request->input('ammount');
        $uuid = Uuid::generate();
        $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
        $order = new Order();
        $order->order_code = 'SMO'.$code;
        $order->name = $request->input('contact_fullname');
        $order->phonenumber = $request->input('contact_phone');
        $order->email = $request->input('contact_email');
        $order->ticket_period = $request->input('ticket_period');
        $order->ticket_class = $request->input('ticket_class');
        $order->ticket_ammount = $request->input('ammount');
        $order->payment_status = 'COMPLETE';
        $order->payment_code = 'test';
        $order->save();
        $i = 0;
        foreach ($request->input('ticket_title') as $title_ticket) {
            $ticket = new Ticket();
            $uuid = Uuid::generate();
            $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
            $ticket->ticket_code = 'SMT'.$code;
            $ticket->title = $request->input('ticket_title')[$i];
            $ticket->name = $request->input('ticket_name')[$i];
            $ticket->phonenumber = $request->input('ticket_phone')[$i];
            $ticket->email = $request->input('ticket_email')[$i];
            $ticket->ticket_period = $request->input('ticket_period');
            $ticket->ticket_class = $request->input('ticket_class');
            $seatupdate = null;
            if ($request->input('ticket_class') != "Reguler"){
                if ($ammount > 1){
                    $seatupdate = Seat::find($request->input('seat')[$i])->first();
                    $ticket->seat_no = $seatupdate->no;
                }
                else {
                    $seatupdate = Seat::find($request->input('seat'))->first();
                    $ticket->seat_no = $seatupdate->no;
                }
            }
            $ticket->save();
            $ticket->order()->attach($order);

            if ($seatupdate != null){
                $seatupdate->status = 'unavailable';
                $seatupdate->save();
            }
            $i++;
        }
        $request->session()->flash('alert-success', 'Ticket was successful added!');
        return redirect()->route("tickets");
    }

    public function viewInvoice(Request $request){
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
//        return view('dashboard.view_invoice');
        $pdf = \PDF::loadView('dashboard.view_invoice');
        return $pdf->download('invoice.pdf');
    }

    public function welcome(){
        return view('welcome');
    }
}
