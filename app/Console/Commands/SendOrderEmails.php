<?php

namespace App\Console\Commands;

use App\Mail\OrderMail;
use App\Mail\TicketMail;
use App\Models\Ticket;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\EmailSendStatus;

class SendOrderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Order Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orders = Order::where('ticket_class', 'Reguler')->get();
        foreach ($orders as $order){
            Mail::to($order->email)->send(new TicketMail($order));
            if( count(Mail::failures()) > 0 ) {
                foreach(Mail::failures as $email_address) {
                    $status = new EmailSendStatus();
                    $status->email = $email_address;
                    $status->type = 'order';
                    $status->identifier = $order->order_code;
                    $status->error = $e->getMessage();
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
}
