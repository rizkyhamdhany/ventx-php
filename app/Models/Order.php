<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;
use App\Models\EmailSendStatus;

class Order extends Model
{

    public function createOrderFromManualInput($input, $event, $ticket_period, $ticket_class){
        $uuid = Uuid::generate();
        $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
        $this->event_id = $event->id;
        $this->order_code = $event->initial.'O'.$code;
        $this->name = $input->input('contact_fullname');
        $this->phonenumber = $input->input('contact_phone');
        $this->email = $input->input('contact_email');
        $this->ticket_period = $ticket_period->name;
        $this->ticket_class = $ticket_class->name;
        $this->ticket_ammount = $input->input('ammount');
        $this->grand_total = $this->ticket_ammount * $ticket_class->price;
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
        $order->event_id = $preorder->event_id;
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
        $order->save();
        foreach ($preorder->tickets as $ticket_item){
            $ticket = new Ticket();
            $uuid = Uuid::generate();
            $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
            $ticket->event_id = $preorder->event_id;
            $ticket->ticket_code = 'SMT'.$code;
            $ticket->title = $ticket_item->title;
            $ticket->name = $ticket_item->name;
            $ticket->phonenumber = $ticket_item->phonenumber;
            $ticket->email = $ticket_item->email;
            $ticket->ticket_period = $ticket_item->ticket_period;
            $ticket->ticket_class = $ticket_item->ticket_class;
            if ($ticket_item->ticket_class != "Reguler"){
                $ticket->seat_no = $ticket_item->seat_no;
                $seatupdate = Seat::where('ticket_class', $ticket->ticket_class)->where('no', $ticket->seat_no)->first();
                $seatupdate->status = 'unavailable';
                $seatupdate->save();
            }
            $ticket->save();
            $ticket->order()->attach($order);

            /*
             * generate ticket
             */
            $pdf = \PDF::loadView('dashboard.tickets.download_ticket', compact('ticket'))->setPaper('A5', 'portrait');
            $output = $pdf->output();
            $ticket_url = 'ventex/ticket/ticket_'.$ticket->ticket_code.'.pdf';
            $s3 = \Storage::disk('s3');
            $s3->put($ticket_url, $output, 'public');
            $ticket->url_ticket = $ticket_url;
            $ticket->save();
        }

        /*
         * generate invoice
         */
        $ticket_price = 0;
        if ($order->ticket_class == 'Reguler'){
            $ticket_price = 125000;
        } else if ($order->ticket_class == 'VVIP'){
            $ticket_price = 450000;
        } else {
            $ticket_price = 250000;
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

    public static function createOrderFromBankTransferEvent($preorder, $event){
        $order = new Order();
        $order->event_id = $preorder->event_id;
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
        $order->event_id = $event->id;
        $order->save();
        foreach ($preorder->tickets as $ticket_item){
            $ticket = new Ticket();
            $uuid = Uuid::generate();
            $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
            $ticket->event_id = $preorder->event_id;
            $ticket->ticket_code = $event->initial.'T'.$code;
            $ticket->title = $ticket_item->title;
            $ticket->name = $ticket_item->name;
            $ticket->phonenumber = $ticket_item->phonenumber;
            $ticket->email = $ticket_item->email;
            $ticket->ticket_period = $ticket_item->ticket_period;
            $ticket->ticket_class = $ticket_item->ticket_class;
            if ($ticket_item->ticket_class != "Reguler"){
                $ticket->seat_no = $ticket_item->seat_no;
                $seatupdate = Seat::where('ticket_class', $ticket->ticket_class)->where('no', $ticket->seat_no)->first();
                $seatupdate->status = 'unavailable';
                $seatupdate->save();
            }
            $ticket->event_id = $event->id;
            $ticket->save();
            $ticket->order()->attach($order);

            /*
             * generate ticket
             */
            $pdf = \PDF::loadView('dashboard.tickets.download_ticket', compact('ticket'))->setPaper('A5', 'portrait');
            $output = $pdf->output();
            $ticket_url = 'ventex/ticket/ticket_'.$ticket->ticket_code.'.pdf';
            $s3 = \Storage::disk('s3');
            $s3->put($ticket_url, $output, 'public');
            $ticket->url_ticket = $ticket_url;
            $ticket->save();
        }

        /*
         * generate invoice
         */
        $ticket_price = 0;
        if($event->id == 0){
            if ($order->ticket_class == 'Reguler'){
                $ticket_price = 125000;
            } else if ($order->ticket_class == 'VVIP'){
                $ticket_price = 450000;
            } else {
                $ticket_price = 250000;
            }
        } else {
            $ticket_price = 55000;
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
}
