<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class Order extends Model
{

    public function createOrderFromManualInput($input){
        $uuid = Uuid::generate();
        $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
        $this->order_code = 'SMO'.$code;
        $this->name = $input->input('contact_fullname');
        $this->phonenumber = $input->input('contact_phone');
        $this->email = $input->input('contact_email');
        $this->ticket_period = $input->input('ticket_period');
        $this->ticket_class = $input->input('ticket_class');
        $this->ticket_ammount = $input->input('ammount');
        $this->payment_status = 'COMPLETE';
        $this->payment_code = '';
        $this->payment_method = 'MANUAL INPUT';
        $this->user = Auth::user()->email;
        $this->save();
    }
    public function tickets()
    {
        return $this
            ->belongsToMany('App\Models\Ticket')
            ->withTimestamps();
    }

    public static function createOrderFromBankTransfer($preorder){
        $order = new Order();
        $order->order_code = $preorder->order_code;
        $order->name = $preorder->name;
        $order->phonenumber = $preorder->phonenumber;
        $order->email = $preorder->email;
        $order->ticket_period = $preorder->ticket_period;
        $order->ticket_class = $preorder->ticket_class;
        $order->ticket_ammount = $preorder->ticket_ammount;
        $order->payment_status = 'COMPLETE';
        $order->payment_code = '';
        $order->payment_method = 'BANK TRANSFER';
        $order->user = 'PAYMENT GATEWAY';
//        $order->save();
        foreach ($preorder->tickets as $ticket_item){
            $ticket = new Ticket();
            $ticket->ticket_code = $ticket_item->ticket_code;
            $ticket->title = $ticket_item->title;
            $ticket->name = $ticket_item->name;
            $ticket->phonenumber = $ticket_item->phonenumber;
            $ticket->email = $ticket_item->email;
            $ticket->ticket_period = $ticket_item->ticket_period;
            $ticket->ticket_class = $ticket_item->ticket_class;
            if ($ticket_item->ticket_class != "Reguler"){
                $ticket->seat_no = $ticket_item->seat_no;
                $seatupdate = Seat::where('ticket_class', $ticket->ticket_class)->where('seat_no', $ticket->seat_no)->first();
                echo '<pre>'; print_r($seatupdate);
            }
//            $ticket->save();
//            $ticket->order()->attach($order);
        }
        exit;
    }
}
