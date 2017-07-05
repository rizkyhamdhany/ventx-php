<?php

use Illuminate\Database\Seeder;
use App\TicketClass;

class TicketClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticket = new TicketClass();
        $ticket->name = 'Reguler';
        $ticket->status = 'active';
        $ticket->save();
        $ticket = new TicketClass();
        $ticket->name = 'VIP E';
        $ticket->status = 'active';
        $ticket->save();
        $ticket = new TicketClass();
        $ticket->name = 'VIP D';
        $ticket->status = 'active';
        $ticket->save();
        $ticket = new TicketClass();
        $ticket->name = 'VIP I';
        $ticket->status = 'active';
        $ticket->save();
        $ticket = new TicketClass();
        $ticket->name = 'VIP H';
        $ticket->status = 'active';
        $ticket->save();
        $ticket = new TicketClass();
        $ticket->name = 'VVIP';
        $ticket->status = 'active';
        $ticket->save();
    }
}
