<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;

class GenerateTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Ticket';

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
        $tickets = Ticket::all();
        foreach ($tickets as $ticket){
            $pdf = \PDF::loadView('dashboard.tickets.download_ticket', compact('ticket'))->setPaper('A5', 'portrait');
            $output = $pdf->output();

            $ticket_url = 'ventex/ticket/ticket_'.$ticket->ticket_code.'.pdf';
            $s3 = \Storage::disk('s3');
            $s3->put($ticket_url, $output, 'public');
            $ticket->url_ticket = $ticket_url;
            $ticket->save();
        }
    }
}
