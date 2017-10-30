<?php

namespace App\Http\Controllers\Dashboard\Partner;

use App\Http\Requests\PartnerBuyTicketRequest;
use App\Models\Order;
use App\Models\Event;
use App\Models\Ticket;
use App\CC;
use Webpatser\Uuid\Uuid;
use App\Models\EventRepository;
use App\Models\OrderRepository;
use App\Models\TicketPeriodRepository;
use App\Models\TicketClassRepository;
use App\Models\TicketBoxRepository;
use App\Models\TicketBoxTicket;
use App\Models\TicketBoxTicketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;
use App\Models\EmailSendStatus;
use View;

class PartnerController extends Controller
{
    protected $tbRepo, $tbTicketRepo, $orderRepo, $ticketPeriodRepo, $ticketClassRepo;

    public function __construct(EventRepository $eventRepo, OrderRepository $orderRepo, TicketPeriodRepository $ticketPeriodRepo,
    TicketClassRepository $ticketClassRepo)
    {
        //$this->tbRepo = $tbRepo;
        //$this->tbTicketRepo = $tbTicketRepo;
        $this->eventRepo = $eventRepo;
        $this->orderRepo = $orderRepo;
        $this->ticketPeriodRepo = $ticketPeriodRepo;
        $this->ticketClassRepo = $ticketClassRepo;
        $this->middleware('auth');
        View::share('page_state', 'Ticket Box');
    }

    public function index(){
        $user = Auth::user();
        $events = Event::all()->where('status','=','active');
        $count = Order::where('user','=',$user->email)->count();
        return view('dashboard.partner.home')
        ->with('events', $events)
        ->with('count', $count);
    }

    public function chooseTicket($event_id){
      $ticketPeriodRepo = $this->ticketPeriodRepo->findByField('event_id',$event_id);
      $eventRepo = $this->eventRepo->find($event_id);
      $todayDate = date('Y-m-d');
      $todayDate = date('Y-m-d', strtotime($todayDate));
      $ktp = NULL;
      foreach($ticketPeriodRepo as $key=>$ticketPeriod){
        $periodBegin = date('Y-m-d', strtotime($ticketPeriod->start_date));
        $periodEnd  = date('Y-m-d', strtotime($ticketPeriod->end_date));
        if (($todayDate >= $periodBegin) && ($todayDate <= $periodEnd)){
          $ktp = $key;break;
        }
      }
      if($ktp!=NULL){
        $ticketClassRepo = $this->ticketClassRepo->findByField('ticket_period_id',$ticketPeriodRepo[$ktp]['id']);
        return view('dashboard.partner.choose_ticket')
        ->with('ticketPeriod',$ticketPeriodRepo[$ktp])
        ->with('ticketClasses',$ticketClassRepo);
      }
    }

    public function buyTicket($id){
        $ticketPeriodRepo = $this->ticketPeriodRepo->findByField('event_id',$id);
        $eventRepo = $this->eventRepo->find($id);
        $todayDate = date('Y-m-d');
        $todayDate = date('Y-m-d', strtotime($todayDate));
        $ktp = NULL;
        foreach($ticketPeriodRepo as $key=>$ticketPeriod){
          $periodBegin = date('Y-m-d', strtotime($ticketPeriod->start_date));
          $periodEnd  = date('Y-m-d', strtotime($ticketPeriod->end_date));
          if (($todayDate >= $periodBegin) && ($todayDate <= $periodEnd)){
            $ktp = $key;break;
          }
        }
        if($ktp!=NULL){
          $ticketClassRepo = $this->ticketClassRepo->findByField('ticket_period_id',$ticketPeriodRepo[$ktp]['id']);
          //echo $ticketClassRepo;exit;
          $ktc = NULL;
          foreach($ticketClassRepo as $key=>$tc){
            if(strtolower($tc->name) == 'reguler'){
              $ktc = $key;
              //echo $ticketClassRepo[$ktc];exit;
            }
          }
          return view('dashboard.partner.buy_ticket')
          ->with('event',$eventRepo)
          ->with('ticketPeriod',$ticketPeriodRepo[$ktp])
          ->with('ticketClass',$ticketClassRepo[$ktc]);
        }else{
          return back()->with('valid','Invalid Date');
        }
    }

    public function buyTicketPost(PartnerBuyTicketRequest $request, $event_id){
        $ticket_period = $this->ticketPeriodRepo->find($request->input('ticket_period'));
        $ticket_class = $this->ticketClassRepo->find($request->input('ticket_class'));
        $event = Event::find(Auth::user()->event_id);
        //create order
        $ammount = $request->input('ammount');
        $order = new Order();
        $order->createOrderFromManualInput($request, $event, $ticket_period, $ticket_class);
        $seats = [];
        $ticket = new Ticket();
        $uuid = Uuid::generate();
        $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
        $ticket->event_id = $event->id;
        $ticket->ticket_code = $event->initial.'T'.$code;
        $ticket->title = $request->input('ticket_title');
        $ticket->name = $request->input('contact_fullname');
        $ticket->phonenumber = $request->input('contact_phone');
        $ticket->email = $request->input('contact_email');
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
                return redirect()->route('partner.ticket.buy',[$event_id]);
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
                return redirect()->route('partner.ticket.buy',[$event_id]);
            }
        }
        $ticket->save();
        $ticket->order()->attach($order);
        $env = env("APP_ENV", CC::ENV_LOCAL);
        if ($env != CC::ENV_TESTING){
            /*
             * generate ticket
             */
            $event = Event::find($ticket->event_id);
            $ticket->eticket_layout = $event->eticket_layout;
            $pdf = \PDF::loadView('dashboard.tickets.download_ticket', compact('ticket'))->setPaper('A5', 'portrait');
            $output = $pdf->output();
            unset($ticket->eticket_layout);
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
        $request->session()->flash('alert-success', 'Ticket has been purchased !');
        return redirect()->route('partner.home', [$event_id]);
        //  return redirect()->route("ticket.order.detail", ['id' => $order->id]);

        ///////////////////////////////////////////////////////////////////////
        /*$id = $request->input("id");
        $ticket = $this->tbTicketRepo->find($id);
        if ($ticket->status == "CLOSED"){
            $request->session()->flash('alert-success', 'Event has been created !');
            return redirect()->route('partner.home.ticket.buy', [$event_id]);
        }
        $ticket->name = $request->input("name");
        $ticket->email = $request->input("email");
        $ticket->phonenumber = $request->input("phone");
        $ticket->status = 'CLOSED';
        $ticket->save();
        $request->session()->flash('alert-success', 'Ticket has been purchased !');
        return redirect()->route('partner.home', [$event_id]);*/
    }

    public function viewInvoice(Request $request, $id){

        $order = Order::find($id);
        if ($order->url_invoice != ""){
            //$s3 = \Storage::disk('s3');
            $local = \Storage::disk('s3');
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
            $local = \Storage::disk('s3');
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
        return redirect()->route("partner.order.detail", ['id' => $order->id]);
    }

    public function viewOrderDetail($id){
        $order = Order::find($id);
        $ticket = $order->tickets()->first();
        return view('dashboard.partner.order_detail')
                ->with('order', $order)
                ->with('ticket',$ticket);
    }

    public function viewReport(){
      $user = Auth::user();
      $order = Order::where('user','=',$user->email)->get();
      return view('dashboard.partner.report')
      ->with('orders',$order);
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
        \Storage::disk('s3')->put($invoice_url, $output, 'public');
        $order->url_invoice = $invoice_url;
        $order->save();
        return;
    }

    public function downloadTicket(Request $request, $id){
        $ticket = Ticket::find($id);
        $env = env("APP_ENV", CC::ENV_LOCAL);
        if ($env == CC::ENV_OTS){
            return redirect()->to(URL('/').'/'.$ticket->url_ticket);
        } else {
            if ($ticket->url_ticket != ""){
                $s3 = \Storage::disk('s3');
                return redirect()->to($s3->url($ticket->url_ticket));
            } else {
                $event = Event::find($ticket->event_id);
                $ticket->eticket_layout = $event->eticket_layout;
                $pdf = \PDF::loadView('dashboard.tickets.download_ticket', compact('ticket'))->setPaper('A5', 'portrait');
                $output = $pdf->output();
                unset($ticket->eticket_layout);
                $ticket_url = 'ventex/ticket/ticket_'.$ticket->ticket_code.'.pdf';
                $s3 = \Storage::disk('s3');
                $s3->put($ticket_url, $output, 'public');
                $ticket->url_ticket = $ticket_url;
                $ticket->save();
                return redirect()->to($s3->url($ticket->url_ticket));
            }
        }
    }
}
