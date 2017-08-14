<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use phpDocumentor\Reflection\Types\Array_;
use Webpatser\Uuid\Uuid;
use App\Models\Seat;
use App\Models\TicketClass;
use Milon\Barcode\DNS2D;
use App\Models\DailyOrderStatistic;
use View;
use App\Models\Preticket;
use App\Models\Preorder;
use Illuminate\Support\Facades\Redis;
use App\Models\RedisModel;
use App\Models\Preseat;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\BookTicketRequest;

class TicketAppController extends Controller
{

    public function __construct()
    {
        View::share( 'event_name', 'Smilemotion 2017' );
        View::share( 'logo', 'logo_smilemotion.png' );
        View::share( 'url_event', 'http://smilemotion.org' );
    }

    public function listTicket()
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
        return view('app.ticket.ticket_list')->with('ticket_class', $ticket_class)
            ->with('seat', $seat)
            ->with('seat_booked', $seat_booked);
    }

    public function bookTicketPost(Request $request)
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

    public function payTicket(Request $request){
        $ticket = $request->session()->get('book');
        if (!isset($ticket)){
            return redirect()->route('app.ticket.list');
        }
        if (isset($ticket->contact_name)){
            $request->session()->forget('book');
            return redirect()->route('app.ticket.list');
        }
        View::share( 'page_state', 'book' );
        return view('app.ticket.ticket_book')->with('ticket', $ticket);
    }

    public function payTicketPost(BookTicketRequest $request)
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

    public function proceedBookTicket(Request $request){
        $ticket = $request->session()->get('book');
        if (!isset($ticket)){
            return redirect()->route('app.ticket.list');
        }
        View::share( 'page_state', 'pay' );
        return view('app.ticket.ticket_pay')->with('ticket', $ticket);
    }

    public function proceedBookTicketPost(Request $request)
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
                    $ticket->bank_account = 'BCA 2831350697 a.n. Adzka Fairuz';
                } else if($ticket->bankopt == 'Mandiri'){
                    $ticket->bank_account = 'Mandiri 130 001502303 2 a.n Arina Sani';
                } else if($ticket->bankopt == 'BNI'){
                    $ticket->bank_account = 'BNI 0533301387 a.n. Adzka Fairuz';
                }
                if ($ticket->ticket_type != 'Reguler'){
                    foreach ($ticket->ticket as $ticket){
                        $seat = $ticket->seat;
                    }
                }
                $preorder = new Preorder();
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
    public function successBookTicket(Request $request)
    {
        $ticket = $request->session()->get('book');
        if (!isset($ticket)){
            return redirect()->route('app.ticket.list');
        }
        $request->session()->forget('book');
        View::share( 'page_state', 'proceed' );
        return view('app.ticket.ticket_proceed')->with('ticket', $ticket);
    }

    private function getTicketPrice($ticket){
        if ($ticket->ticket_type == 'Reguler'){
            $ticket->price_item = 70000;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        } else if ($ticket->ticket_type == 'VIP I' || $ticket->ticket_type == 'VIP H' || $ticket->ticket_type == 'VIP E' || $ticket->ticket_type == 'VIP D'){
            $ticket->price_item = 200000;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        } else if ($ticket->ticket_type == 'VVIP'){
            $ticket->price_item = 400000;
            $ticket->grand_total = $ticket->price_item * $ticket->ticket_ammount;
        }
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

    public function submitBooking(){
        $preorders = Preorder::all();
        foreach ($preorders as $preorder){
            foreach ($preorder->tickets as $ticket){
                echo '<pre>'; print_r($ticket->title);
            }
        }
    }
}
