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
        RedisModel::cachingBookedSeat();
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
                View::share( 'page_state', 'book' );
                return view('app.ticket.ticket_book')->with('ticket', $ticket)->with('book', json_encode($ticket));
            } else {
                return back()->withInput();
            }
        } catch (Exception $e){
            $request->session()->flash('alert-danger', '');
            return back()->withInput();
        }
    }

    public function payTicketPost(Request $request)
    {
        try{
            $ticket = json_decode($request->input('book'));
            $ticket = $this->getTicketPrice($ticket);
            if ($this->validateTicket($request, $ticket)){
                $ticket->contact_name = $request->input('contact_name');
                $ticket->contact_phone = $request->input('contact_phone');
                $ticket->contact_email = $request->input('contact_email');
                $seat = $ticket->ticket;
                $array_ticket = array();
                for ($i = 0; $i < $ticket->ticket_ammount; $i++){
                    $ticket_items = new \stdClass();
                    $ticket_items->ticket_title = $request->input('ticket_title')[$i];
                    $ticket_items->ticket_name = $request->input('ticket_name')[$i];
                    $ticket_items->ticket_phone = $request->input('ticket_phone')[$i];
                    $ticket_items->ticket_email = $request->input('ticket_email')[$i];
                    if(isset($seat)){
                        $ticket_items->seat = $seat[$i];
                        if ($ticket->ticket_type != 'Reguler' && ($ticket_items->seat == '' || !isset($ticket_items->seat))){
                            $request->session()->flash('alert-danger', 'Please fill the from below !');
                            return redirect()->route('app.ticket.list');
                        }
                    }
                    if ($ticket_items->ticket_title == '' ||
                        $ticket_items->ticket_name == '' ||
                        $ticket_items->ticket_phone == '' ||
                        $ticket_items->ticket_email == '' ){
                        $request->session()->flash('alert-danger', 'Please fill the from below !');
                        return back()->withInput();
                    }
                    array_push($array_ticket, $ticket_items);
                }
                $ticket->ticket = $array_ticket;
                View::share( 'page_state', 'pay' );
                return view('app.ticket.ticket_pay')->with('ticket', $ticket)->with('book', json_encode($ticket));
            } else {
                return redirect()->route('app.ticket.list');
            }
        } catch (Exception $e){
            $request->session()->flash('alert-danger', 'Please fill the from below !');
            return back()->withInput();
        }

    }

    public function proceedBookTicketPost(Request $request)
    {
        try{
            $ticket = json_decode($request->input('book'));
            $ticket = $this->getTicketPrice($ticket);
            $ticket->bankopt = $request->input('bankopt');
            if ($this->validateTicket($request, $ticket)){
                if ($this->validateContactInfo($ticket)){
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
                    $preorder = new Preorder();
                    $preorder->submitPreorderWithTickets($ticket);
                    View::share( 'page_state', 'proceed' );
                    return view('app.ticket.ticket_proceed')->with('ticket', $ticket);
                } else {
                    return redirect()->route('app.ticket.list');
                }
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
        View::share( 'page_state', 'success' );
        return view('app.ticket.ticket_book_success');
    }

    private function getTicketObj(Request $request){
        $ticket = new \stdClass();
        $ticket->ticket_period = $request->input('ticket_period');
        $ticket->ticket_type = $request->input('ticket_type');
        $ticket->ticket_ammount = $request->input('ticket_ammount');
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

    private function validateContactInfo($ticket){
        if ($ticket->ticket_type == '' ||
            $ticket->ticket_period == '' ||
            $ticket->ticket_ammount == '' ||
            $ticket->contact_name == '' ||
            $ticket->contact_phone == '' ||
            $ticket->contact_email == ''
        ){
            return false;
        }
        foreach ($ticket->ticket as $item){
            if(isset($seat)){
                if ($ticket->ticket_type != 'Reguler' && ($item->seat == '' || !isset($item->seat))){
                    return false;
                }
            }
            if ($item->ticket_title == '' ||
                $item->ticket_name == '' ||
                $item->ticket_phone == '' ||
                $item->ticket_email == '' ){
                return false;
            }
        }
        return true;
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
