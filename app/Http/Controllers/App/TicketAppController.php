<?php

namespace App\Http\Controllers\App;

use App\CC;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProceesBookTicketRequest;
use App\Models\EventRepository;
use App\Models\TicketClassRepository;
use App\Models\TicketPeriodRepository;
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Ixudra\Curl\Facades\Curl;
use phpDocumentor\Reflection\Types\Array_;
use Webpatser\Uuid\Uuid;
use App\Models\Seat;
use App\Models\TicketClass;
use Milon\Barcode\DNS2D;
use App\Models\DailyOrderStatistic;
use View;
use App\Models\Bookticket;
use App\Models\Book;
use Illuminate\Support\Facades\Redis;
use App\Models\RedisModel;
use App\Models\Bookseat;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\BookTicketRequest;

class TicketAppController extends Controller
{

    protected $eventRepo;
    protected $ticketPeriodRepo;
    protected $ticketClassRepo;

    public function __construct(EventRepository $eventRepo, TicketPeriodRepository $ticketPeriodRepo, TicketClassRepository $ticketClassRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->ticketPeriodRepo = $ticketPeriodRepo;
        $this->ticketClassRepo = $ticketClassRepo;
        View::share( 'event_name', 'Smilemotion 2017' );
        View::share( 'logo', 'logo_smilemotion.png' );
        View::share( 'url_event', 'http://smilemotion.org' );
    }

    public function listTicket($event)
    {
        $event = $this->eventRepo->findWhere([
            'short_name'=> $event,
        ])->first();
        $ticket_period = $this->ticketPeriodRepo->ticketPeriodNow($event->id);
        $ticket_class = $this->ticketClassRepo->ticketPeriodNow($ticket_period->id);
        if ($event->short_name == "smilemotion"){
            $keys_seat_booked = Redis::keys("smilemotion:seat_booked:*");
            $seat_booked = array();
            if (!empty($keys_seat_booked)){
                $seat_booked = Redis::mget($keys_seat_booked);
            }

            if (!Redis::exists("seat-VVIP")){
                RedisModel::cachingSeatData();
            }
            View::share( 'page_state', 'pick_seat' );
            $seat = array();
            $seat['VVIP'] = Redis::hgetall('smilemotion:seat:VVIP');
            $seat['VIP E'] = Redis::hgetall('smilemotion:seat:VIP E');
            $seat['VIP D'] = Redis::hgetall('smilemotion:seat:VIP D');
            $seat['VIP I'] = Redis::hgetall('smilemotion:seat:VIP I');
            $seat['VIP H'] = Redis::hgetall('smilemotion:seat:VIP H');
            $event->count_ticket_class = 5;
            if (count($ticket_class) > 1){
                $event->price_reguler = $ticket_class->first()->price;
            } else {
                $event->price_reguler = $ticket_class->first()->price;
            }
        } else {
            $seat = new \stdClass();
            $seat_booked = new \stdClass();
            $event->count_ticket_class = 1;
            if (count($ticket_class) > 1){
                $event->price_reguler = $ticket_class->first()->price;
            } else {
                $event->price_reguler = $ticket_class->first()->price;
            }
        }

        View::share( 'page_state', 'pick_seat' );
        return view('app.ticket.ticket_list')
            ->with('event', $event)
            ->with('ticket_class', $ticket_class)
            ->with('ticket_period', $ticket_period)
            ->with('seat', $seat)
            ->with('seat_booked', $seat_booked);
    }

    public function bookTicketPost(Request $request, $event)
    {
        try{
            $event = $this->eventRepo->findWhere([
                'short_name'=> $event,
            ])->first();
            $ticket = json_decode($request->input('book'));
            $ticket_period = $this->ticketPeriodRepo->ticketPeriodNow($event->id);
            $ticket_class = $this->ticketClassRepo->ticketPeriodNowWithName($ticket_period->id, $ticket->ticket_type);
            if (!isset($ticket_class)){
                $request->session()->flash('alert-danger', '');
                return back()->withInput();
            }
            $ticket->price_item = $ticket_class->price;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
            if ($this->validateTicket($request, $ticket)){
                $request->session()->put('book', $ticket);
                return redirect()->route('app.event.ticket.pay', [$event->short_name]);
            } else {
                return back()->withInput();
            }
        } catch (Exception $e){
            $request->session()->flash('alert-danger', '');
            return back()->withInput();
        }
    }

    public function payTicket(Request $request, $event){
        $ticket = $request->session()->get('book');
        if (!isset($ticket)){
            return redirect()->route('app.event.ticket.list', [$event]);
        }
        if (isset($ticket->contact_name)){
            $request->session()->forget('book');
            return redirect()->route('app.event.ticket.list', [$event]);
        }
        View::share( 'page_state', 'book' );
        $event = $this->eventRepo->findWhere([
            'short_name'=> $event,
        ])->first();
        return view('app.ticket.ticket_book')
            ->with('ticket', $ticket)
            ->with('event', $event);
    }

    public function payTicketPost(BookTicketRequest $request, $event)
    {
        try{
            $event = $this->eventRepo->findWhere([
                'short_name'=> $event,
            ])->first();
            $ticket = $request->session()->get('book');
            if (!isset($ticket)){
                return redirect()->route('app.event.ticket.list', [$event->short_name]);
            }
            if (isset($ticket->contact_name)){
                $request->session()->forget('book');
                return redirect()->route('app.event.ticket.list', [$event->short_name]);
            }
            $ticket_items = $request->input('ticket');
            $ticket->contact_name = $request->input('contact_name');
            $ticket->contact_phone = $request->input('contact_phone');
            $ticket->contact_email = $request->input('contact_email');
            $ticket->contact_birthday_month = $request->input('contact_birthday_month');
            $ticket->contact_birthday_day = $request->input('contact_birthday_day');
            $ticket->contact_birthday_year = $request->input('contact_birthday_year');
            $ticket->contact_address = $request->input('contact_address');
            $ticket->contact_country = $request->input('contact_country');
            $ticket->contact_city = $request->input('contact_city');
            $ticket->contact_postal_code = $request->input('contact_postal_code');
            $i = 0;
            $temp = [];
            if ($ticket->ticket_type != 'Reguler'){
                foreach ($ticket->ticket as $item){
                    array_push($temp, array_merge((array) $item, $ticket_items[$i]));
                    $i++;
                }

                foreach ($temp as $ticket_temp){
                    $ticket_item = (object) $ticket_temp;
                    if (!isset($ticket_item->seat) || $ticket_item->seat == ''){
                        $request->session()->flash('alert-danger', 'Please fill the from below !');
                        return redirect()->route('app.event.ticket.list', [$event->short_name]);
                    } else {
                        /*
                         * check redis book before pay (time 30mnt)
                         */
                        $keys_seat_booked = Redis::keys("smilemotion:seat_booked_short:*");
                        $seat_booked = array();
                        if (!empty($keys_seat_booked)){
                            $seat_booked = Redis::mget($keys_seat_booked);
                        }
                        if (in_array($ticket_item->seat, $seat_booked)){
                            $request->session()->flash('alert-danger', 'Sorry, selected seat no longer available !');
                            return redirect()->route('app.event.ticket.list', [$event->short_name]);
                        }
                        /*
                         * check redis book waiting payment (time 3 days)
                         */
                        $keys_seat_booked = Redis::keys("smilemotion:seat_booked:*");
                        $seat_booked = array();
                        if (!empty($keys_seat_booked)){
                            $seat_booked = Redis::mget($keys_seat_booked);
                        }
                        if (in_array($ticket_item->seat, $seat_booked)){
                            $request->session()->flash('alert-danger', 'Sorry, selected seat no longer available !');
                            return redirect()->route('app.event.ticket.list' [$event->short_name]);
                        }
                        RedisModel::cachingBookedSeatShort($ticket_item->seat);
                    }
                }
                $ticket->ticket = $temp;
            } else {
                $ticket->ticket = $ticket_items;
            }
            View::share( 'page_state', 'pay' );
            $request->session()->put('book', $ticket);
            return redirect()->route('app.event.ticket.proceed', [$event->short_name]);
        } catch (Exception $e){
            $request->session()->flash('alert-danger', 'Please fill the from below !');
            return redirect()->route('app.event.ticket.list', [$event->short_name]);
        }

    }

    public function proceedBookTicket(Request $request, $event){
        $ticket = $request->session()->get('book');
        if (!isset($ticket)){
            return redirect()->route('app.ticket.list', [$event]);
        }
        View::share( 'page_state', 'pay' );
        $event = $this->eventRepo->findWhere([
            'short_name'=> $event,
        ])->first();
//        echo '<pre>'; print_r($ticket); exit;
        return view('app.ticket.ticket_pay')
            ->with('ticket', $ticket)
            ->with('event', $event);
    }

    public function proceedBookTicketPost(Request $request, $event)
    {
        try{
            $event = $this->eventRepo->findWhere([
                'short_name'=> $event,
            ])->first();
            $ticket = $request->session()->get('book');
            if (!isset($ticket)){
                return redirect()->route('app.event.ticket.list', [$event->short_name]);
            }

            $ticket_period = $this->ticketPeriodRepo->ticketPeriodNow($event->id);
            $ticket_class = $this->ticketClassRepo->ticketPeriodNowWithName($ticket_period->id, $ticket->ticket_type);
            if (!isset($ticket_class)){
                $request->session()->flash('alert-danger', '');
                return back()->withInput();
            }
            $ticket->price_item = $ticket_class->price;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;

            $ticket->payment_method = $request->input('payment_method');
            if ($ticket->payment_method == CC::PAYMENT_BANK_TRF){
                $ticket->bankopt = $request->input('bankopt');
                if ($this->validateTicket($request, $ticket)){
                    $uuid = Uuid::generate();
                    $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
                    $ticket->order_code = $event->initial.'O'.$code;
                    if($ticket->bankopt == 'BCA'){
                        $ticket->bank_account = 'BCA 4381411669 a.n. Sandika Ichsan Arafat';
                    } else if($ticket->bankopt == 'Mandiri'){
                        $ticket->bank_account = 'Mandiri 1320017379083 a.n Sandika Ichsan Arafat';
                    } else if($ticket->bankopt == 'BNI'){
                        $ticket->bank_account = 'BNI 0602257953 a.n. Sandika Ichsan Arafat';
                    } else if($ticket->bankopt == 'CIMB Niaga'){
                        $ticket->bank_account = 'CIMB Niaga 704205525500 a.n. Sandika Ichsan Arafat';
                    }
                    $preorder = new Book();
                    $preorder->submitPreorderWithTicketsEvent($ticket, $event);
                    $preorder->grand_total = $ticket->grand_total;
                    $preorder->bank_account = $ticket->bank_account;
                    $preorder->event_name = $event->name;
                    $preorder->short_name = $event->short_name;
                    View::share( 'page_state', 'proceed' );
                    Mail::to($preorder->email)->send(new OrderMail($preorder));
                    RedisModel::cachingBookedSeat();
                    $request->session()->put('book', $ticket);
                    return redirect()->route('app.event.ticket.success', [$event->short_name]);
                } else {
                    return redirect()->route('app.event.ticket.list', [$event->short_name]);
                }
            } else if ($ticket->payment_method == CC::PAYMENT_DOKU){
                if ($this->validateTicket($request, $ticket)){
                    $uuid = Uuid::generate();
                    $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
                    $ticket->order_code = $event->initial.'O'.$code;
                    $preorder = new Book();
                    $preorder->submitPreorderWithTicketsEvent($ticket, $event);
                    $request->session()->put('book', $ticket);
                    return redirect()->route('app.event.ticket.payment.redirect', [$event->short_name]);
                }
            }else {
                $request->session()->flash('alert-danger', '');
                return back()->withInput();
            }
        } catch (Exception $e){
            $request->session()->flash('alert-danger', '');
            return back()->withInput();
        }
    }

    public function successBookTicket(Request $request, $event)
    {
        $ticket = $request->session()->get('book');
        if (!isset($ticket)){
            return redirect()->route('app.event.ticket.list', [$event]);
        }
        $request->session()->forget('book');
        View::share( 'page_state', 'proceed' );
        $event = $this->eventRepo->findWhere([
            'short_name'=> $event,
        ])->first();
        return view('app.ticket.ticket_proceed')
            ->with('ticket', $ticket)
            ->with('event', $event);
    }

    public function submitBooking(){
        $preorders = Book::all();
        foreach ($preorders as $preorder){
            foreach ($preorder->tickets as $ticket){
                echo '<pre>'; print_r($ticket->title);
            }
        }
    }


    public function listTicketOld()
    {
//        echo '<pre>'; print_r(Redis::mget(Redis::keys("smilemotion:seat_booked:*"))); exit;

        $keys_seat_booked = Redis::keys("smilemotion:seat_booked:*");
        $seat_booked = array();
        if (!empty($keys_seat_booked)){
            $seat_booked = Redis::mget($keys_seat_booked);
        }

        if (!Redis::exists("seat-VVIP")){
            RedisModel::cachingSeatData();
        }
        View::share( 'page_state', 'pick_seat' );
        $ticket_class = TicketClass::all();
        $seat = array();
        $seat['VVIP'] = Redis::hgetall('smilemotion:seat:VVIP');
        $seat['VIP E'] = Redis::hgetall('smilemotion:seat:VIP E');
        $seat['VIP D'] = Redis::hgetall('smilemotion:seat:VIP D');
        $seat['VIP I'] = Redis::hgetall('smilemotion:seat:VIP I');
        $seat['VIP H'] = Redis::hgetall('smilemotion:seat:VIP H');

        View::share( 'page_state', 'pick_seat' );
        return view('app.ticket.old_ticket_list')->with('ticket_class', $ticket_class)
            ->with('seat', $seat)
            ->with('seat_booked', $seat_booked);
    }

    public function bookTicketPostOld(Request $request)
    {
        try{
            $ticket = json_decode($request->input('book'));
            $ticket = $this->getTicketPrice($ticket);
            if ($this->validateTicket($request, $ticket)){
                $request->session()->put('book', $ticket);
                return redirect()->route('app.ticket.pay');
            } else {
                return back()->withInput();
            }
        } catch (Exception $e){
            $request->session()->flash('alert-danger', '');
            return back()->withInput();
        }
    }

    public function payTicketOld(Request $request){
        $ticket = $request->session()->get('book');
        if (!isset($ticket)){
            return redirect()->route('app.ticket.list');
        }
        if (isset($ticket->contact_name)){
            $request->session()->forget('book');
            return redirect()->route('app.ticket.list');
        }
        View::share( 'page_state', 'book' );
        return view('app.ticket.old_ticket_book')->with('ticket', $ticket);
    }

    public function payTicketPostOld(BookTicketRequest $request)
    {
        try{
            $ticket = $request->session()->get('book');
            if (!isset($ticket)){
                return redirect()->route('app.ticket.list');
            }
            if (isset($ticket->contact_name)){
                $request->session()->forget('book');
                return redirect()->route('app.ticket.list');
            }
            $ticket_items = $request->input('ticket');
            $ticket->contact_name = $request->input('contact_name');
            $ticket->contact_phone = $request->input('contact_phone');
            $ticket->contact_email = $request->input('contact_email');
            $i = 0;
            $temp = [];
            if ($ticket->ticket_type != 'Reguler'){
                foreach ($ticket->ticket as $item){
                    array_push($temp, array_merge((array) $item, $ticket_items[$i]));
                    $i++;
                }

                foreach ($temp as $ticket_temp){
                    $ticket_item = (object) $ticket_temp;
                    if (!isset($ticket_item->seat) || $ticket_item->seat == ''){
                        $request->session()->flash('alert-danger', 'Please fill the from below !');
                        return redirect()->route('app.ticket.list');
                    } else {
                        /*
                         * check redis book before pay (time 30mnt)
                         */
                        $keys_seat_booked = Redis::keys("smilemotion:seat_booked_short:*");
                        $seat_booked = array();
                        if (!empty($keys_seat_booked)){
                            $seat_booked = Redis::mget($keys_seat_booked);
                        }
                        if (in_array($ticket_item->seat, $seat_booked)){
                            $request->session()->flash('alert-danger', 'Sorry, selected seat no longer available !');
                            return redirect()->route('app.ticket.list');
                        }
                        /*
                         * check redis book waiting payment (time 3 days)
                         */
                        $keys_seat_booked = Redis::keys("smilemotion:seat_booked:*");
                        $seat_booked = array();
                        if (!empty($keys_seat_booked)){
                            $seat_booked = Redis::mget($keys_seat_booked);
                        }
                        if (in_array($ticket_item->seat, $seat_booked)){
                            $request->session()->flash('alert-danger', 'Sorry, selected seat no longer available !');
                            return redirect()->route('app.ticket.list');
                        }
                        RedisModel::cachingBookedSeatShort($ticket_item->seat);
                    }
                }
                $ticket->ticket = $temp;
            } else {
                $ticket->ticket = $ticket_items;
            }
            View::share( 'page_state', 'pay' );
            $request->session()->put('book', $ticket);
            return redirect()->route('app.ticket.proceed');
        } catch (Exception $e){
            $request->session()->flash('alert-danger', 'Please fill the from below !');
            return redirect()->route('app.ticket.list');
        }

    }

    public function proceedBookTicketOld(Request $request){
        $ticket = $request->session()->get('book');
        if (!isset($ticket)){
            return redirect()->route('app.ticket.list');
        }
        View::share( 'page_state', 'pay' );
        return view('app.ticket.old_ticket_pay')->with('ticket', $ticket);
    }

    public function proceedBookTicketPostOld(Request $request)
    {
        try{
            $ticket = $request->session()->get('book');
            if (!isset($ticket)){
                return redirect()->route('app.ticket.list');
            }
            $ticket = $this->getTicketPrice($ticket);
            $ticket->bankopt = $request->input('bankopt');
            if ($this->validateTicket($request, $ticket)){
                $uuid = Uuid::generate();
                $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
                $ticket->order_code = 'SMO'.$code;
                if($ticket->bankopt == 'BCA'){
                    $ticket->bank_account = 'BCA 4381411669 a.n. Sandika Ichsan Arafat';
                } else if($ticket->bankopt == 'Mandiri'){
                    $ticket->bank_account = 'Mandiri 1320017379083 a.n Sandika Ichsan Arafat';
                } else if($ticket->bankopt == 'BNI'){
                    $ticket->bank_account = 'BNI 0602257953 a.n. Sandika Ichsan Arafat';
                } else if($ticket->bankopt == 'CIMB Niaga'){
                    $ticket->bank_account = 'CIMB Niaga 704205525500 a.n. Sandika Ichsan Arafat';
                }
                $preorder = new Book();
                $preorder->submitPreorderWithTickets($ticket);
                $preorder->grand_total = $ticket->grand_total;
                $preorder->bank_account = $ticket->bank_account;
                View::share( 'page_state', 'proceed' );
                Mail::to($preorder->email)->send(new OrderMail($preorder));
                RedisModel::cachingBookedSeat();
                $request->session()->put('book', $ticket);
                return redirect()->route('app.ticket.success');
            } else {
                return redirect()->route('app.ticket.list');
            }
        } catch (Exception $e){
            $request->session()->flash('alert-danger', '');
            return back()->withInput();
        }
    }

    public function successBookTicketOld(Request $request)
    {
        $ticket = $request->session()->get('book');
        if (!isset($ticket)){
            return redirect()->route('app.ticket.list');
        }
        $request->session()->forget('book');
        View::share( 'page_state', 'proceed' );
        return view('app.ticket.old_ticket_proceed')->with('ticket', $ticket);
    }

    private function getTicketPrice($ticket){
        if ($ticket->ticket_type == 'Reguler'){
            $ticket->price_item = 135000;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        } else if ($ticket->ticket_type == 'VIP I' || $ticket->ticket_type == 'VIP H' || $ticket->ticket_type == 'VIP E' || $ticket->ticket_type == 'VIP D'){
            $ticket->price_item = 300000;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        } else if ($ticket->ticket_type == 'VVIP'){
            $ticket->price_item = 500000;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        }
        return $ticket;
    }

    private function getTicketPriceFTB($ticket){
        $ticket->price_item = 55000;
        $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        return $ticket;
    }

    private function validateTicket($request, $ticket){
        if ($ticket->ticket_ammount < 5 && $ticket->ticket_ammount > 0){
            if ($ticket->ticket_type == 'Reguler' || $ticket->ticket_ammount == count($ticket->ticket)){
                return true;
            } else {
                $request->session()->flash('alert-danger', 'Please Choose Ticket Ammount !');
                return false;
            }
        } else {
            $request->session()->flash('alert-danger', 'Please Choose Ticket Ammount !');
            return false;
        }
    }

    public function submitBookingOld(){
        $preorders = Book::all();
        foreach ($preorders as $preorder){
            foreach ($preorder->tickets as $ticket){
                echo '<pre>'; print_r($ticket->title);
            }
        }
    }

    public function redirectPayment(Request $request, $event){
        $event = $this->eventRepo->findWhere([
            'short_name'=> $event,
        ])->first();
        $ticket = $request->session()->get('book');
        if (!isset($ticket)){
            return redirect()->route('app.event.ticket.list', [$event->short_name]);
        }

        $basket = $event->initial.','.$ticket->price_item.'.00'.','.$ticket->ticket_ammount.','.$ticket->grand_total.'.00;Administration fee,5000.00,1,5000.00';
        $ammount = $ticket->grand_total + 5000;
        $store_id = env("APP_ENV", CC::ENV_LOCAL) == CC::ENV_LOCAL ? CC::DOKU_STORE_ID_DEV : CC::DOKU_STORE_ID_PROD;
        $shared_key = env("APP_ENV", CC::ENV_LOCAL) == CC::ENV_LOCAL ? CC::DOKU_SHARED_KEY_DEV : CC::DOKU_SHARED_KEY_PROD;
        $url = 'https://apps.myshortcart.com/payment/request-payment/';
        $fields = array(
            'BASKET' => $basket,
            'STOREID' => $store_id,
            'TRANSIDMERCHANT' => $ticket->order_code,
            'AMOUNT' => $ammount.'.00',
            'URL' => 'nalar-ventex.com',
            'WORDS' => sha1($ammount.'.00'.$shared_key.$ticket->order_code),
            'CNAME' => $ticket->contact_name,
            'CEMAIL' => $ticket->contact_email,
            'CWPHONE' => $ticket->contact_phone,
            'CHPHONE' => $ticket->contact_phone,
            'CMPHONE' => $ticket->contact_phone,
            'CCAPHONE' => $ticket->contact_phone,
            'CADDRESS' => $ticket->contact_address,
            'CZIPCODE' => $ticket->contact_postal_code,
            'SADDRESS' => $ticket->contact_address,
            'SZIPCODE' => $ticket->contact_postal_code,
            'SCITY' => $ticket->contact_city,
            'SCOUNTRY' => $ticket->contact_country,
            'BIRTHDATE' => date('Y-m-d',strtotime($ticket->contact_birthday_year.'-'.$ticket->contact_birthday_month.'-'.$ticket->contact_birthday_day)),
        );
//        echo '<pre>'; print_r($fields); exit;
        return view('app.payment.init_payment')
            ->with('data', $fields);
    }

}