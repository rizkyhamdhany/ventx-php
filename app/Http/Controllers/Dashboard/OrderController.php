<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use App\Models\Seat;
use App\Models\TicketClass;
use Milon\Barcode\DNS2D;

class OrderController extends Controller
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
        $order = new Order();
        $order->createOrder($request);
        $i = 0;
        foreach ($request->input('ticket_title') as $title_ticket) {
            $ticket = new Ticket();
            $uuid = Uuid::generate();
            $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
            $ticket->ticket_code = 'FTBT'.$code;
            $ticket->title = $request->input('ticket_title')[$i];
            $ticket->name = $request->input('ticket_name')[$i];
            $ticket->phonenumber = $request->input('ticket_phone')[$i];
            $ticket->email = $request->input('ticket_email')[$i];
            $ticket->ticket_period = $request->input('ticket_period');
            $ticket->ticket_class = $request->input('ticket_class');
            $seatupdate = null;
            if ($request->input('ticket_class') != "Reguler"){
                if ($ammount > 1){
                    $seatupdate = Seat::find($request->input('seat')[$i]);
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
        $this->createInvoice($order);
        return redirect()->route("ticket.order.detail", ['id' => $order->id]);
    }

    public function createInvoice(Order $order){
        $ticket_price = 0;
        if($order->ticket_period == 'Presale 1'){
          $ticket_price = 50000;
        }else{
          $ticket_price = 70000;
        }
        /*if ($order->ticket_class == 'Reguler'){
            $ticket_price = 70000;
        } else if ($order->ticket_class == 'VVIP'){
            $ticket_price = 400000;
        } else {
            $ticket_price = 200000;
        }*/
        $data = array();
        $data['order'] = $order;
        $data['ticket_price'] = $ticket_price;
        $pdf = \PDF::loadView('dashboard.view_invoice', compact('data'));
        $output = $pdf->output();

        $invoice_url = 'ventex/invoice/invoice_'.$order->order_code.'.pdf';
        $s3 = \Storage::disk('s3');
        $s3->put($invoice_url, $output, 'public');

//        $invoice_url = 'uploads/invoice/invoice_'.$order->order_code.'.pdf';
//        file_put_contents($invoice_url, $output);
        $order->url_invoice = $invoice_url;
        $order->save();
        return;
    }

    public function viewInvoice(Request $request, $id){
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        $order = Order::find($id);
        if ($order->url_invoice != ""){
            $s3 = \Storage::disk('s3');
            return redirect()->to($s3->url($order->url_invoice));
        } else {
            $ticket_price = 0;
            /*if ($order->ticket_class == 'Reguler'){
                $ticket_price = 70000;
            } else if ($order->ticket_class == 'VVIP'){
                $ticket_price = 400000;
            } else {
                $ticket_price = 200000;
            }*/
            if ($order->ticket_period == 'Presale 1'){
                $ticket_price = 50000;
            } else {
                $ticket_price = 70000;
            }
            $data = array();
            $data['order'] = $order;
            $data['ticket_price'] = $ticket_price;
            $pdf = \PDF::loadView('dashboard.view_invoice', compact('data'))->setPaper('A4', 'portrait');
            $output = $pdf->output();
            $invoice_url = 'ventex/invoice/invoice_'.$order->order_code.'.pdf';
            $s3 = \Storage::disk('s3');
            $s3->put($invoice_url, $output, 'public');
            $order->url_invoice = $invoice_url;
            $order->save();
            return redirect()->to($s3->url($order->url_invoice));
        }
    }

    public function viewOrderDetail(Request $request, $id){
        $request->user()->authorizeRoles(['superadmin', 'sm-operator']);
        $order = Order::find($id);
        return view('dashboard.orders.order_detail')
                ->with('order', $order);
    }

    public function testInvoice(){
        return view('dashboard.test_invoice');
    }
}
