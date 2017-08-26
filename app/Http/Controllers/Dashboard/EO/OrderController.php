<?php

namespace App\Http\Controllers\Dashboard\EO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Webpatser\Uuid\Uuid;
use App\Models\Seat;
use App\Models\TicketClass;
use Milon\Barcode\DNS2D;
use App\Models\RedisModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;
use App\Models\EmailSendStatus;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

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
        $event_id = Auth::user()->event_id;
        $ticket_class = TicketClass::where('event_id', $event_id)->get();
        return view('dashboard.choose_ticket')
                ->with('ticket_classes', $ticket_class);
    }

    public function orderTicket(Request $request)
    {

        $input = $request->input();
        $seat_available = Seat::where('ticket_class', $request->input('ticket_class'))->where('status', 'active')->get();
        return view('dashboard.order_ticket')
            ->with('ticket_period', $request->input('ticket_period'))
            ->with('ticket_class', $request->input('ticket_class'))
            ->with('ammount', $request->input('amount'))
            ->with('seat_available', $seat_available);
    }

    public function orderTicketSubmit(Request $request){

        $event = Event::find(Auth::user()->event_id);
        //create order
        $ammount = $request->input('ammount');
        $order = new Order();
        $order->createOrderFromManualInput($request, $event);
        $i = 0;
        $seats = [];
        foreach ($request->input('ticket_title') as $title_ticket) {
            $ticket = new Ticket();
            $uuid = Uuid::generate();
            $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
            $ticket->event_id = $event->id;
            $ticket->ticket_code = $event->initial.'T'.$code;
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

                /*
                 * check redis book before pay (time 30mnt)
                 */
                $keys_seat_booked = Redis::keys("smilemotion:seat_booked_short:*");
                $seat_booked = array();
                if (!empty($keys_seat_booked)){
                    $seat_booked = Redis::mget($keys_seat_booked);
                }
                if (in_array($seatupdate->id, $seat_booked)){
                    $request->session()->flash('alert-danger', 'Sorry, selected seat no longer available !');
                    Order::destroy($order->id);
                    return redirect()->route('tickets');
                }
                /*
                 * check redis book waiting payment (time 3 days)
                 */
                $keys_seat_booked = Redis::keys("smilemotion:seat_booked:*");
                $seat_booked = array();
                if (!empty($keys_seat_booked)){
                    $seat_booked = Redis::mget($keys_seat_booked);
                }
                if (in_array($seatupdate->id, $seat_booked)){
                    $request->session()->flash('alert-danger', 'Sorry, selected seat no longer available !');
                    return redirect()->route('tickets');
                }
            }
            $ticket->save();
            $ticket->order()->attach($order);

            /*
             * generate ticket
             */
            $pdf = \PDF::loadView('dashboard.tickets.download_ticket', compact('ticket'))->setPaper('A5', 'portrait');
            $output = $pdf->output();
            $ticket_url = 'ventex/ticket/'.$event->name.'/ticket_'.$ticket->ticket_code.'.pdf';
            $s3 = \Storage::disk('s3');
            $s3->put($ticket_url, $output, 'public');
            $ticket->url_ticket = $ticket_url;
            $ticket->save();

            if ($seatupdate != null){
                $seatupdate->status = 'unavailable';
                $seatupdate->save();
                array_push($seats, $seatupdate);
            }
            $i++;
        }
        foreach ($seats as $seat){
            RedisModel::removeCachingSeat($seat);
        }
        $request->session()->flash('alert-success', 'Ticket was successful added!');
        if ($event->id == 0){
            $this->createInvoice($order);
        }

        /*
         * send email ticket
         */
        Mail::to($order->email)->send(new TicketMail($order));
        if( count(Mail::failures()) > 0 ) {
            foreach(Mail::failures as $email_address) {
                $status = new EmailSendStatus();
                $status->email = $email_address;
                $status->type = 'order';
                $status->identifier = $order->order_code;
                $status->error = '';
                $status->save();
            }
        } else {
            $status = new EmailSendStatus();
            $status->email = $order->email;
            $status->type = 'order';
            $status->identifier = $order->order_code;
            $status->error = 'SUCCESS';
            $status->save();
        }

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

    public function sendEmail(Request $request, $id){
        $order = Order::find($id);
        Mail::to($order->email)->send(new TicketMail($order));
        if( count(Mail::failures()) > 0 ) {
            foreach(Mail::failures as $email_address) {
                $status = new EmailSendStatus();
                $status->email = $email_address;
                $status->type = 'order';
                $status->identifier = $order->order_code;
                $status->error = '';
                $status->save();
            }
        } else {
            $status = new EmailSendStatus();
            $status->email = $order->email;
            $status->type = 'order';
            $status->identifier = $order->order_code;
            $status->error = 'SUCCESS';
            $status->save();
        }
        return redirect()->route("ticket.order.detail", ['id' => $order->id]);
    }

    public function viewOrderDetail(Request $request, $id){

        $order = Order::find($id);
        return view('dashboard.orders.order_detail')
                ->with('order', $order);
    }

    public function testInvoice(){
        return view('dashboard.test_invoice');
    }
}
