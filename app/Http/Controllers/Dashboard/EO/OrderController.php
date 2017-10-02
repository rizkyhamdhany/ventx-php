<?php

namespace App\Http\Controllers\Dashboard\EO;

use App\CC;
use App\Http\Controllers\Controller;
use App\Models\EventRepository;
use App\Models\TicketClassRepository;
use App\Models\TicketPeriodRepository;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Validator;
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
use Illuminate\Support\Facades\DB;
use App\Models\Event;

use Illuminate\Support\Facades\Storage;


class OrderController extends Controller
{
    protected $eventRepo;
    protected $ticketPeriodRepo;
    protected $ticketClassRepo;

    public function __construct(EventRepository $eventRepo, TicketPeriodRepository $ticketPeriodRepo, TicketClassRepository $ticketClassRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->ticketPeriodRepo = $ticketPeriodRepo;
        $this->ticketClassRepo = $ticketClassRepo;
        $this->middleware('auth');
    }

    public function chooseTicket(Request $request)
    {
        $event_id = Auth::user()->event_id;
        $ticket_periods = $this->ticketPeriodRepo->ticketPeriodByEvent($event_id);
        $ticket_classes = $this->ticketClassRepo->ticketClassByEvent($event_id);
        return view('dashboard.eo.choose_ticket')
            ->with('ticket_periods', $ticket_periods)
            ->with('ticket_classes', $ticket_classes);
    }

    public function orderTicket(Request $request)
    {
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'ticket_period' => 'required',
                'ticket_class' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('ticket.choose')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $ticket_period = $this->ticketPeriodRepo->find($request->input('ticket_period'));
                $ticket_class = $this->ticketClassRepo->find($request->input('ticket_class'));
                $seat_available = Seat::where('ticket_class', $ticket_class->name)->where('status', 'active')->get();
                return view('dashboard.order_ticket')
                    ->with('ticket_period', $ticket_period)
                    ->with('ticket_class', $ticket_class)
                    ->with('ammount', $request->input('amount'))
                    ->with('seat_available', $seat_available);
            }
        }

    }

    public function orderTicketSubmit(Request $request){
        $ticket_period = $this->ticketPeriodRepo->find($request->input('ticket_period'));
        $ticket_class = $this->ticketClassRepo->find($request->input('ticket_class'));
        $event = Event::find(Auth::user()->event_id);
        //create order
        $ammount = $request->input('ammount');
        $order = new Order();
        $order->createOrderFromManualInput($request, $event, $ticket_period, $ticket_class);
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
            $ticket->ticket_period = $ticket_period->name;
            $ticket->ticket_class = $ticket_class->name;
            $seatupdate = null;
            if ($ticket_class->have_seat == 1){
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
                $keys_seat_booked = Redis::keys($event->shortname.":seat_booked_short:*");
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
                $keys_seat_booked = Redis::keys($event->shortname.":seat_booked:*");
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
            $env = env("APP_ENV", CC::ENV_LOCAL);
            if ($env != CC::ENV_TESTING){
                /*
                 * generate ticket
                 */
                $pdf = \PDF::loadView('dashboard.tickets.download_ticket', compact('ticket'))->setPaper('A5', 'portrait');
                $output = $pdf->output();
                $ticket_url = 'ventex/ticket/'.$event->short_name.'/ticket_'.$ticket->ticket_code.'.pdf';
                if ($env == CC::ENV_OTS){
                    file_put_contents($ticket_url, $output);
                } else {
                    $s3 = \Storage::disk('s3');
                    $s3->put($ticket_url, $output, 'public');
                }

                $ticket->url_ticket = $ticket_url;
                $ticket->save();
            }

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
            $env = env("APP_ENV", CC::ENV_LOCAL);
            if ($env != CC::ENV_TESTING || $env = CC::ENV_OTS){
                $this->createInvoice($order, $ticket_class);
            }
        }

        $env = env("APP_ENV", CC::ENV_LOCAL);
        if ($env != CC::ENV_TESTING && $env != CC::ENV_OTS){
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
        }


        return redirect()->route("ticket.order.detail", ['id' => $order->id]);
    }

    public function createInvoice(Order $order, $ticket_class){
        $ticket_price = $ticket_class->price;
        $data = array();
        $data['order'] = $order;
        $data['ticket_price'] = $ticket_price;
        $pdf = \PDF::loadView('dashboard.view_invoice', compact('data'));
        $output = $pdf->output();

        $invoice_url = 'ventex/invoice/invoice_'.$order->order_code.'.pdf';
        //$s3 = \Storage::disk('s3');
        //$s3->put($invoice_url, $output, 'public');
        \Storage::disk('local')->put($invoice_url, $output, 'public');
        $order->url_invoice = $invoice_url;
        $order->save();
        return;
    }

    public function viewInvoice(Request $request, $id){

        $order = Order::find($id);
        if ($order->url_invoice != ""){
            //$s3 = \Storage::disk('s3');
            $local = \Storage::disk('local');
            //Storage::disk('local')->put($invoice_url, $output, 'public');
            //return redirect()->to($s3->url($order->url_invoice));
            return redirect()->to($local->url($order->url_invoice));
        } else {
            $ticket_period = $this->ticketPeriodRepo->findWhere([ 'event_id' => $order->event_id,'name' => $order->ticket_period])->first();
            $ticket_class = $this->ticketClassRepo->findWhere(['event_id' => $order->event_id, 'ticket_period_id' => $ticket_period->id, 'name' => $order->ticket_class])->first();
            $ticket_price = $ticket_class->price;
            $data = array();
            $data['order'] = $order;
            $data['ticket_price'] = $ticket_price;
            $pdf = \PDF::loadView('dashboard.view_invoice', compact('data'))->setPaper('A4', 'portrait');
            $output = $pdf->output();
            $invoice_url = 'ventex/invoice/invoice_'.$order->order_code.'.pdf';
      //      $s3 = \Storage::disk('s3');
      //      $s3->put($invoice_url, $output, 'public');
            $local = \Storage::disk('local');
            $local->put($invoice_url, $output, 'public');
            $order->url_invoice = $invoice_url;
            $order->save();
            return redirect()->to($local->url($order->url_invoice));
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

    public function show($event_id){
      $orders = Order::select(DB::raw('COUNT(ticket_ammount) as sold'),DB::raw('DATE(updated_at) as date'))->groupBy(DB::raw('DATE(updated_at)'))
      //$orders =  Order::select(DB::raw('COUNT(ticket_ammount) as sold'),DB::raw('CONCAT(YEAR(updated_at),"-",MONTHNAME(updated_at)) as date'))->groupBy(DB::raw('MONTH(updated_at)'))->groupBy(DB::raw('YEAR(updated_at)'))
      ->where('payment_status','COMPLETE')
      ->where('event_id',$event_id)
      ->get();
      return $orders->toJSON();


    }
}
