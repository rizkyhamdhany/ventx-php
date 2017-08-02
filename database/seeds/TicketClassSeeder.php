<?php

use Illuminate\Database\Seeder;
use App\Models\TicketClass;

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
        $ticket->row = 0;
        $ticket->col = 0;
        $ticket->have_seat = false;
        $ticket->save();
        $ticket = new TicketClass();
        $ticket->name = 'VIP E';
        $ticket->status = 'active';
        $ticket->row = 12;
        $ticket->col = 17;
        $ticket->have_seat = true;
        $ticket->save();
        $ticket = new TicketClass();
        $ticket->name = 'VIP D';
        $ticket->status = 'active';
        $ticket->row = 12;
        $ticket->col = 17;
        $ticket->have_seat = true;
        $ticket->save();
        $ticket = new TicketClass();
        $ticket->name = 'VIP I';
        $ticket->status = 'active';
        $ticket->row = 12;
        $ticket->col = 17;
        $ticket->have_seat = true;
        $ticket->save();
        $ticket = new TicketClass();
        $ticket->name = 'VIP H';
        $ticket->status = 'active';
        $ticket->row = 12;
        $ticket->col = 16;
        $ticket->have_seat = true;
        $ticket->save();
        $ticket = new TicketClass();
        $ticket->name = 'VVIP';
        $ticket->status = 'active';
        $ticket->row = 6;
        $ticket->col = 18;
        $ticket->have_seat = true;
        $ticket->save();
    }
}
