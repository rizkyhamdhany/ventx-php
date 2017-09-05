<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class GenerateInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $orders = Order::all();
        foreach ($orders as $order){
            if ($order->url_invoice == ""){
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
            }
        }
    }
}
